<?php

    ob_start(); //Turns on output buffering
    session_start(); //starts a session
    date_default_timezone_set("America/Toronto"); //set default timezone

    try {
        // create new connection to DB, PDO = PHP Data Object
        $con = new PDO("mysql:host=localhost;dbname=reeceflix", "root", "");
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);//set error reporting of database
    }
    catch (PDOException $e){
        exit("Connection failed: " . $e -> getMessage());
    }


?>
