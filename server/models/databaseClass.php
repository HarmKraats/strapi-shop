<?php

class DatabaseConnection
{
    private $pdo;

    public function __construct($host, $database, $user, $password)
    {
        try {
            $this->pdo = new PDO('mysql:host=' . $host . ';dbname=' . $database, $user, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Connected successfully
        } catch (PDOException $e) {
            // Not conencteed successfully
            echo 'Database connectie error: ' . $e->getMessage();
        }
    }

    public function getFromDB($what = '*', $table = 'users', $where = '1', $debug = false)
    {
        try {
            // If the $what is an array, we need to implode it with a comma.
            if (is_array($what)) {
                $what = implode(', ', $what);
            }

            // query
            $sql = "SELECT $what FROM $table WHERE $where";
            if ($debug) {
                echo $sql;
            }

            // prepare and execute query. Then fetch all the results and retype them as an array
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        } catch (PDOException $e) {
            echo 'Database gegevens ophalen error: ' . $e->getMessage();
        }
    }

    public function postToDB($data, $table = 'users', $debug = false)
    {
        try {
            // If the $data is not an array, throw an exception
            if (!is_array($data)) {
                throw new Exception('$data should be an associative array.');
            }

            // Build the SQL query
            $columns = implode(', ', array_keys($data));
            $placeholders = ':' . implode(', :', array_keys($data));
            $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";

            if ($debug) {
                echo $sql;
            }

            // Prepare and execute the query
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($data);

            // No need to fetch results for an INSERT operation
            return true;
        } catch (PDOException $e) {
            echo 'Database gegevens opslaan error: ' . $e->getMessage();
            return false;
        }
    }


    public function updateARowInDB($data, $table = 'users', $where = '1', $debug = false)
    {
        try {
            // If the $what is an array, we need to implode it with a comma.
            if (is_array($data)) {
                $data = implode(', ', $data);
            }

            // query
            $sql = "UPDATE $table SET $data WHERE $where";
            if ($debug) {
                echo $sql;
            }

            // prepare and execute query. Then fetch all the results and retype them as an array
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        } catch (PDOException $e) {
            echo 'Database gegevens updaten error: ' . $e->getMessage();
        }
    }
}
