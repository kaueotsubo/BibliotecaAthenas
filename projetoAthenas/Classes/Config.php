<?php

    $dbHost = 'Localhost';
    $dbUsername = 'root';
    $dbpassword = '';
    $dbName = 'dbathenas'; 

    $conn = new PDO("mysql:dbname=". $dbName.";host=".$dbHost, $dbUsername, $dbpassword);

?>