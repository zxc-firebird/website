<?php
session_start();

require_once "db.php";


$query = "SELECT * FROM goods";

if(isset($_GET['sex'])) {
	$data = $_GET['sex'];
	$query = "SELECT * FROM goods WHERE sex = $data";
}
if(isset($_GET['brand'])) {
	$data = $_GET['brand'];
	$query = "SELECT * FROM goods WHERE brand = $data";
}
$req = mysqli_query($connection, $query);
$data_from_db = [];

while ($result = mysqli_fetch_assoc($req)) {
	$data_from_db[] = $result;
}





$query_brands = "SELECT * FROM brands";
$req_brands = mysqli_query($connection, $query_brands);

$query_sex = "SELECT * FROM sex";
$req_sex = mysqli_query($connection, $query_sex);

# var_dump($data_from_db);


?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="style.css">
</head>

<style>

</style>

<body>

	<div class="box-area">
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

		<div class="banner-area">
			<h2></h2>
		</div>

		<div class="content-area">
			<div class="left-side" >
				<div class="forms">
				<h3>FILTERS</h3>
				<hr>
					<div class="brands">
						<h3>Brands: </h3>
						<form class="categories" action="" method="GET">
							<?php while($value = mysqli_fetch_object($req_brands)) { ?>
								<p><input type="radio" name="brand" class="radio" value="<?php echo $value->id ?>"> <?php echo $value->brand ?></p>
							<?php } ?>
							<p><input type="submit" value="Выбрать"></p>
						</form>
					</div>
								<br>
					<div class="sex">
						<h3>Sex:</h3>
						<form class="categories" action="" method="GET">
							<?php while($value = mysqli_fetch_object($req_sex)) { ?>
								<p><input type="radio" name="sex" class="radio" value="<?php echo $value->id ?>"> <?php echo $value->sex ?></p>
							<?php } ?>
							<p><input type="submit" value="Выбрать"></p>
						</form>
					</div>
				</div>
					
			</div>

			<div class="right-side" >
				<div class="product-wrap">

					<?php foreach($data_from_db as $item): ?>
					<div class="product-item">
						<img src="images/<?php echo $item['img'] ?>" alt="">
						
						<div class="product-buttons">
							<a href="cart.php?item_id=<?php echo $item['id']?>" class="button">
								В корзину
							</a>
						</div>

						<div class="product-title">
							<h2>
								<?php echo $item['name']?>
							</h2>

							<p><strong>
								<?php echo $item['cost']?> Руб.
							</strong></p>
						</div>
					</div>			
				<?php endforeach;?>
				</div>
			</div>
			
		</div>

</body>
</html>