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

// Обработка выбранных товаров
if (isset($_POST['selected_products'])) {
    $selected_products = $_POST['selected_products'];

    foreach ($selected_products as $product_id) {
        // Здесь можно добавить логику для обработки выбранных товаров
        // Например, удаление из корзины или изменение статуса
        $sql = "DELETE FROM cart WHERE id = $product_id";

        if ($conn->query($sql) !== TRUE) {
            echo "Ошибка при обработке товара с ID: $product_id";
        }
    }

    echo "Выбранные товары успешно обработаны!";
} else {
    echo "Нет выбранных товаров для обработки.";
}

$conn->close();
?>