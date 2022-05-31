<?php 
session_start();

require_once "db.php";

$i = rand();


$session = $_SESSION['cart_list'];



$name = $_POST['order_name'];
$number = $_POST['order_number'];

foreach( $session as $key => $value ) {
    
    $id = $value['id'];
    $query = "INSERT INTO `orders` VALUES (NULL, $i, $id, '$name', $number, now());";
    mysqli_query($connection, $query);

}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Спасибо за заказ!</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="thanks_info">
        <h2>Спасибо за заказ!</h2>
        <h2>В ближайшее время с Вами свяжется наш менеджер для уточнения деталей заказа!</h2>
        <h2>В течении 10 секунд Вы будете перенаправлены на главную страницу!</h2>
    </div>

    <script>
        function callBack() {
            document.location.assign("index.php");
        }

        setTimeout(() => {
            callBack();
        }, 10000);
    </script>
</body>
</html>