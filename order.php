<?php 
session_start();


$total_cost = 0;

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

	<div class="order">
		<div class="order_banner">
			<h1>Order</h1>
		</div>
		<div class="order_total">
			<form action="thanks.php" method="POST">
				
				<?php if ( isset($_GET['name']) ) : ?>
					<p>Вы заказываете: <?php echo $_GET['name']; ?></p>
				<?php elseif ( isset($_SESSION['cart_list']) ) : ?>
					<ul>
						<?php foreach( $_SESSION['cart_list'] as $course ) :  $total_cost = $total_cost + $course['cost'] ?>

							<li><?php echo $course['name']; ?> | <?php echo $course['cost']; ?> Руб.</li>

						<?php endforeach; ?>
					</ul>

					<div>
						<h2>Total cost: <?php echo $total_cost; ?> Руб.</h2>
					</div>
					
					<div>
						<a href="cart.php" class="total_button">Change order</a>
					</div>
				<?php endif; ?>

				
				<div class="form_inputs">
					<p>Заполните форму для завершения заказа!</p>
					<input type="text" name="order_name" placeholder="Name"><br>
					<input type="text" name="order_number" placeholder="Phone number"><br>
					<input type="submit">
				</div>
			</form>
		</div>
		<div class="total_buttons">
			
		</div>
	</div>

	

	
	
</body>
</html>