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

// Обработка добавления товара в корзину
if (isset($_POST['product_name']) && isset($_POST['product_price']) && isset($_POST['quantity'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $quantity = $_POST['quantity'];

    $sql = "INSERT INTO cart (product_name, product_price, quantity) VALUES ('$product_name', $product_price, $quantity)";

    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "error";
    }
}

// Обработка удаления товара из корзины
if (isset($_POST['remove_id'])) {
    $id = $_POST['remove_id'];

    $sql = "DELETE FROM cart WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "error";
    }
}

// Обработка обновления количества товара в корзине
if (isset($_POST['update_id']) && isset($_POST['update_quantity'])) {
    $id = $_POST['update_id'];
    $quantity = $_POST['update_quantity'];

    $sql = "UPDATE cart SET quantity = $quantity WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "error";
    }
}

$conn->close();
?>