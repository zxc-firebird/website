<?php

$host = 'std-mysql';
$user = 'std_1419_practice';
$pass = 'zxcKingg123';
$db_name = 'std_1419_practice';
$connection = mysqli_connect($host, $user, $pass, $db_name);

if (mysqli_connect_errno()) {
	die("Data Base connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")");
} else {
	# echo "Connection = success!\n" . mysqli_get_host_info($connection) . "<br />";
}

mysqli_query($connection, "SET NAMES utf8");