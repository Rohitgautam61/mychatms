<?php

    // Database configuration
    // $dbHost = "localhost"; // Replace with your database host
    // $dbUsername = "your_username"; // Replace with your database username
    // $dbPassword = "your_password"; // Replace with your database password
    //The name of the database.
    $db='ms_chat';

    // Create a new mysqli connection
    // $con=mysqli_connect();
    $con=mysqli_connect("localhost","root","","$db");
    if(mysqli_connect_errno()){
        echo "The connection is failed".mysqli_connect_errno();
        exit();
    }
    else{
        // echo "connection successful.";
    }
    // Session started.
    session_start();
?>