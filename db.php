<?php

/**
 * Método para conectar no banco.
 */
function connect_db()
{
    $dbHost = "localhost:3306";
    $dbUser = "aula_php_user";
    $dbPass = "123456";
    $dbName = "aula_php_db";

    $conn = null;
    try {
        $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    return $conn;
}

function error_db($e) {
    echo '<pre>' . $sql . "<br>" . $e->getMessage() . '</pre>';
}

/**
 * Método para inserir dados.
 */
function insert_db($sql)
{
    try {
        $conn = connect_db();
        $inserido = false;
        if ($conn->exec($sql) === 1) {
            return $conn->lastInsertId();
        }
    } catch (PDOException $e) {
        error_db($e);
    }
    return false;
}

function select_db($sql)
{
    try {
        $conn = connect_db();
        $select = $conn->prepare($sql); 
        $select->execute();
    
        $result = $select->setFetchMode(PDO::FETCH_OBJ); 
        return $select->fetchAll();
    } catch(PDOException $e) {
        error_db($e);
    }
    return false;
}


function delete_db($sql)
{
    try {
        $conn = connect_db();
        // use exec() because no results are returned
        if ($conn->exec($sql) == 1) {
            return true;
        }
    } catch(PDOException $e) {
        error_db($e);
    }
    return false;
}


function update_db($sql)
{
    try {
        $conn = connect_db();
        $update = $conn->prepare($sql);
        
        if ($update->execute() == 1) {
            return $update->rowCount();
        }
    
    } catch(PDOException $e) {
        error_db($e);
    }
    return false;
}
?>