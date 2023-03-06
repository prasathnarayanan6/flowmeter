<?php
$config = parse_ini_file('./config.ini');

$connection = mysqli_connect($config['host'],$config['userName'],$config['password'],$config['dbName']);


if ($connection->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>