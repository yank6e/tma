<?php
$servername = "tmareg";
$username = "root";
$password = "";
$dbname = "tma";

// Создаем соединение
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем соединение
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];
$quantity = $_POST['quantity'];

$sql = "INSERT INTO cart (product_name, product_price, quantity) VALUES ('$product_name', $product_price, $quantity)";

if ($conn->query($sql) === TRUE) {
    echo "Товар добавлен в корзину";
} else {
    echo "Ошибка: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
