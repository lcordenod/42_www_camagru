<?php

require_once 'database.php';

$DB_NAME = "camagru";

try
{
    $DB = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $DB->query("CREATE DATABASE IF NOT EXISTS $DB_NAME");
    $DB->query("use $DB_NAME");
    if ($DB)
        echo "Connected to the <strong>camagru</strong> database successfully";
}
catch(Exception $e)
{
        exit('<b>Catched exception at line '.$e->getLine().' :</b> '. $e->getMessage());
}

$DB = null;

?>