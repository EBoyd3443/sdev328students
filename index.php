<?php

ini_set("display_errors", 1);

require_once("vendor/autoload.php");
require_once $_SERVER['DOCUMENT_ROOT'].'/../config.php';

try{



    $f3 = Base::instance();

    $f3->route('GET||POST /', function($f3) {

        $dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);

        $view = new Template();
        echo $view->render("views/form.html");
    });

    $f3->route('GET /students', function($f3) {
        $dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);

        $sql = "SELECT * FROM student";

        $statement = $dbh->prepare($sql);

        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        $f3->set("students", $result);
        echo $result;

        $view = new Template();
        echo $view->render("views/studentList.html");
    });
    $f3->run();
}
catch(PDOException $e){
    echo "<p>OH SNAP</p>";
    die("<h1>Database Missing!</h1>");
}