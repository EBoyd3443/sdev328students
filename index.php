<?php

ini_set("display_errors", 1);

require_once $_SERVER['DOCUMENT_ROOT'].'/../config.php';

try{
    $dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);


    $f3 = Base::instance();

    $f3->route('GET||POST /', function($f3) {



        $view = new Template();
        echo $view->render("views/form.html");
    });

    $f3->route('GET /students', function($f3, $dbh) {
        $sql = "SELECT * FROM pets";

        $statement = $dbh->prepare($sql);

        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        $f3->set("students", $result);

        $view = new Template();
        echo $view->render("views/studentList.html");
    });
}
catch(PDOException $e){
    die("<h1>Database Missing!</h1>");
}