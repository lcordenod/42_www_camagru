<?php

require_once 'database.php';

$DB_NAME = "camagru";

function    db_connect() {
    $DB_con = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
}

?>