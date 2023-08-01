<?php

function getDB()
{

    $host = 'localhost';
    $db = 'lillshop';
    $user = 'root';
    $pass = '';


    try {
        $pdo = new PDO('mysql:host=' . $host . ';dbname=' . $db, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Connected successfully
    } catch (PDOException $e) {
        // Not conencteed successfully
        echo 'Database connectie error: ' . $e->getMessage();
    }

    return $pdo;
}

// Data uit de database halen met deze handige functie. 
function getFromDB($what = "*", $table = "users", $where = "1", $debug = false)
{
    try {
        $db = getDB();

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
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    } catch (PDOException $e) {
        echo 'Database gegevens ophalen error: ' . $e->getMessage();
    }
}

function postToDB($data, $table = "users", $where = "1", $debug = false)
{
    try {
        $db = getDB();

        // If the $data is an array, we need to build the SET clause for the SQL query.
        if (is_array($data)) {
            $columns = implode(', ', array_keys($data));
            $placeholders = ':' . implode(', :', array_keys($data));
        } else {
            throw new Exception('$data should be an associative array.');
        }

        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";

        // query

        if ($debug) {
            echo $sql;
        }

        // prepare and execute query with the data array
        $stmt = $db->prepare($sql);
        $stmt->execute($data);

        // Return the last inserted ID after a successful INSERT operation.
        return $db->lastInsertId();
    } catch (PDOException $e) {
        echo 'Fout met gegevens opslaan in database: ' . $e->getMessage();
        return false;
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
        return false;
    }
}



/**
 * INSERT INTO products
 *  (`id`,
 *  `product_name`,
 *  `product_description`,
 *  `product_price`,
 *  `product_old_price`,
 *  `created_at`,
 *  `updated_at`,
 *  `published_at`,
 *  `created_by_id`,
 *  `updated_by_id`,
 *  `slug`,
 *  `product_quantity`) 
 * VALUES 
 * (NULL,
 *  'banana',
 *  'Dit is dus een banaan',
 *  '5',
 *  '4',
 *  '2023-05-16 23:27:59.000000',
 *  '2023-05-16 23:27:59.000000',
 *  '2023-05-16 23:27:59.000000',
 *  '1',
 *  '1',
 *  'banana',
 *  '4');
 */


//  EditARowInDB function
function updateARowInDB($what = "*", $table = "users", $where = "1", $debug = false)
{
    try {
        $db = getDB();

        // If the $what is an array, we need to implode it with a comma.
        if (is_array($what)) {
            $what = implode(', ', $what);
        }

        // query
        $sql = "UPDATE $table SET $what WHERE $where";
        if ($debug) {
            echo $sql;
        }

        // prepare and execute query. Then fetch all the results and retype them as an array
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    } catch (PDOException $e) {
        echo 'Database gegevens ophalen error: ' . $e->getMessage();
    }
}
