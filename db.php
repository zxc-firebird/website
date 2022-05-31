<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$db_name = 'online_shop';
$connection = mysqli_connect($host, $user, $pass, $db_name);

if (mysqli_connect_errno()) {
	die("Data Base connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")");
}

mysqli_query($connection, "SET NAMES utf8");