<?php

ini_set("display_errors", 1);

require_once("vendor/autoload.php");
require_once $_SERVER['DOCUMENT_ROOT'].'/../config.php';

try{



    $f3 = Base::instance();

    $f3->route('GET||POST /', function($f3) {

        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            var_dump($_POST);
            $dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
            $sql = "INSERT INTO student (sid, last, first, birthdate ,gpa, advisor) VALUES (:sid, :last, :first, :birthdate, :gpa, :advisor)";

            $statement = $dbh->prepare($sql);
            $statement->bindParam(':sid', $_POST['SID']);
            $statement->bindParam(':last', $_POST['Last']);
            $statement->bindParam(':first', $_POST['First']);
            $statement->bindParam(':birthdate', $_POST['BirthDate']);
            $statement->bindParam(':gpa', $_POST['GPA']);
            $statement->bindParam(':advisor', $_POST['Advisor']);

            $statement->execute();


            $f3->reroute('students');
        }

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