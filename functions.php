<?php
require_once "db.php";

$i = 1;

function get_course_by_id( $id ){
	global $connection;

	$query = "SELECT * FROM goods WHERE id=" . $id;
	$req = mysqli_query($connection, $query);
	$resp = mysqli_fetch_assoc($req);

	return $resp;
}

function add_to_db($id, $order_name, $order_number) {
	if ( isset($_SESSION['cart_list']) && !empty($_SESSION['cart_list']) ) {
		while($_SESSION['cart_list']) {
			$query = "INSERT INTO orders VALUES (NULL, $i, $id, $order_name, $order_number);";
		}
	}
}