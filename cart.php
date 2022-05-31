<?php
session_start();

$total_cost = 0;


require_once "db.php";
require_once "functions.php";


if ( isset($_GET['delete_id']) && isset($_SESSION['cart_list']) ) {
	foreach ($_SESSION['cart_list'] as $key => $value) {
		if ( $value['id'] == $_GET['delete_id'] ) {
			unset($_SESSION['cart_list'][$key]);
		}		
	}
}


if ( isset($_GET['course_id']) && !empty($_GET['course_id']) ) {

	$current_added_course = get_course_by_id($_GET['course_id']);

	// ...
	if ( !empty($current_added_item) ) {

		if ( !isset($_SESSION['cart_list'])) {
			$_SESSION['cart_list'][] = $current_added_item;
		}


		$course_check = false;

		if ( isset($_SESSION['cart_list']) ) {
			foreach ($_SESSION['cart_list'] as $value) {
				if ( $value['id'] == $current_added_item['id'] ) {
					$course_check = true;
				}
			}
		}


		if ( !$course_check ) {
			$_SESSION['cart_list'][] = $current_added_item;
		}

	} else {
		header("Location: 404.php");
	}
	
}




?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>

		<header>	
			<div class="wrapper">
				<div class="logo">
					<a href="index.php">ONLINE SHOP</a>
				</div>
				<nav>
					<a href="#">Для мужчин</a>
					<a href="#">Для женщин</a>
					<a href="cart.php"><?php if (isset($_SESSION['cart_list'])) {
										echo "Корзина: " . count($_SESSION['cart_list']);
									} else {
										echo "Корзина: 0";
									}?>
						</a>
				</nav>
			</div>
		</header>

	<?php if ( isset($_SESSION['cart_list']) && count($_SESSION['cart_list']) !=0 ) : ?>
	<div class="cart_list">
		<div class="cart">
			<?php foreach( $_SESSION['cart_list'] as $item ) : $total_cost = $total_cost + $item['cost']?>
				<div class="cart_item">
				<img src="images/<?php echo $item['img'] ?>" alt="">

						<h1><?php echo $item['name']; ?></h1>
						<p><?php echo $item['cost']; ?> Руб. </p><br>
						<a href="cart.php?delete_id=<?php echo $item['id'];?>" class="delete_button">Удалить из корзины</a>
				</div>

			<?php endforeach; ?>
		</div>
		<div class="order_buttons">
			<div class="total_cost">
				<h2><?php printf('Общая стоимость: %s', $total_cost); ?></h2>
			</div>
			<div class="total_buttons">
				<a href="index.php" class="total_button">Back to catalog</a>
				<a href="order.php" class="total_button">Checkout</a>
			</div>
		</div>
	</div>
	
	<?php else : ?>
		<div class="empty__cart_list">
			<h2>
				Cart is empty now!
			</h2>
		</div>

	<?php endif; ?>

	
</body>
</html>