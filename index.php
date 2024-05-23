<?php

ini_set("display_errors", 1);

require_once $_SERVER['DOCUMENT_ROOT'].'/../config.php';

try{
    $dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
}
catch(PDOException $e){
    die($e->getMessage());
}