<?php
$serverName = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "PROJECT";

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
    die("Connection Failed" . mysqli_connect_error());
}
