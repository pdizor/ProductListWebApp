<?php

$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "project2";

// connect to database
$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

if (!$conn) {
    die("Database connection failed");
}

?>