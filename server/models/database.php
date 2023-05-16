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

// postToDB function
function postToDB($what = "*", $table = "users", $where = "1", $debug = false)
{
    try {
        $db = getDB();

        // If the $what is an array, we need to implode it with a comma.
        if (is_array($what)) {
            $what = implode(', ', $what);
        }

        // query
        $sql = "INSERT INTO $table SET $what";
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
