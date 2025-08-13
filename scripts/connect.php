<?php
    $dotenv = parse_ini_file('.env');

    $servername = $dotenv["SERVER"];
    $username = $dotenv["USERNAME"];
    $password = $dotenv["PASSWORD"];
    $database = $dotenv["DATABASE"];

    // $servername = getenv("SERVER");
    // $username = getenv("USERNAME");
    // $password = getenv("PASSWORD");
    // $database = getenv("DATABASE");

    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    }
?>
