<?php

session_start();

require_once "db.php";

if (isset($_GET['delete_id'])) {
	$data = $_GET['delete_id'];
    $query = "DELETE FROM orders WHERE order_id = $data";
    $req = mysqli_query($connection, $query);
}

if(isset($_GET['search_order']) && !empty($_GET['search_order'])) {
	$query = "SELECT * FROM orders, goods, sex, brands WHERE order_id = $data AND orders.good_id = goods.id AND goods.sex = sex.id AND goods.brand = brands.id ORDER BY orders.order_time";
    $req = mysqli_query($connection, $query);
} else {
    $query = "SELECT * FROM orders, goods, sex, brands WHERE orders.good_id = goods.id AND goods.sex = sex.id AND goods.brand = brands.id ORDER BY orders.order_time" ;
    $req = mysqli_query($connection, $query);
}

$resp = [];

while ($result = mysqli_fetch_assoc($req)) {
	$resp[] = $result;
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel</title>
</head>
<body>

    <div class="search">
        <form method="GET">
            <label for="search_order"> Введите номер заказа:
                <input type="text" name="search_order">
                <input type="submit">
            </label>
        </form>
    </div>

    <div class="orders">
        <?php foreach($resp as $orders) { ?> 
                <div class="order_info">
                    <h3>Информация о заказе:</h3>
                    <?php printf("Номер заказа: %s", $orders['order_id']); ?>
                    <ul>
                        <li><?php printf("Имя заказчика: %s", $orders['order_name']); ?></li>
                        <li><?php printf("Номер телефона заказчика: %s", $orders['order_number']); ?></li>
                    </ul>
                    <br>
                    <h3>Основная информация: </h3>
                    <ul>
                        <li><?php printf("Дата заказа: %s", $orders['order_time']); ?></li>
                        <li><?php printf("Стоимость: %s", $orders['cost']); ?></li>

                    </ul>
                    <ul>
                        <li><?php printf("Наименование: %s", $orders['name']); ?></li>
                        <li><?php printf("Бренд: %s", $orders['brand']); ?></li>
                    </ul>
                    <a href="admin.php?delete_id=<?php echo $orders['order_id'];?>" class="total_button">Заказ выполнен</a>
                </div>
        <?php } ?>
    </div>
</body>
</html>