<?php

function    db_connect() {
    $DB_DSN_LONG = 'mysql:host=127.0.0.1:3306;dbname=camagru;charset=utf8mb4';
    $DB_USER = 'root';
    $DB_PASSWORD = 'azerty123';
    try
    {
        $DB_con = new PDO($DB_DSN_LONG, $DB_USER, $DB_PASSWORD);
        if ($DB_con)
            return ($DB_con);
    }
    catch(Exception $e)
    {
        exit('<b> Catched exception at line '.$e->getLine().' :</b> '. $e->getMessage());
    }
}

?>