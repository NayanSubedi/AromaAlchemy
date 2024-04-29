<?php

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "AromaAlchemy";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("Error;");
}

?>