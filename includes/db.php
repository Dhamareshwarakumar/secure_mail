<?php

require __DIR__ . '/../env.php';

$host = $MYSQL_DB_HOST;
$dbuname = $MYSQL_DB_USER;
$dbpassword = $MYSQL_DB_PASSWORD;
$dbname = "capstone";


$conn = mysqli_connect($host, $dbuname, $dbpassword, $dbname);

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}
