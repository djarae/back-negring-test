<?php

$dbhost = "127.0.0.1";
$dbuser = "root";
$dbpass = "";
$dbname = "negring-test";
$conn = new mysqli($dbhost, $dbuser, $dbpass,$dbname) or die("Connect failed: %s\n". $conn -> error);

?>