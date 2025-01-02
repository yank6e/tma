<?php
$servername = "tmareg"; // Имя сервера базы данных
$username = "root";     // Имя пользователя базы данных
$password = "";         // Пароль пользователя базы данных
$dbname = "tma";        // Имя базы данных

// Создаем соединение
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем соединение
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Обработка данных заказа
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $address = $_POST['address'];
    $comments = $_POST['comments'];
    $payment = $_POST['payment'];

    // Сохраняем заказ в базу данных
    $sql = "INSERT INTO orders (fullname, address, comments, payment_method) VALUES ('$fullname', '$address', '$comments', '$payment')";

    if ($conn->query($sql) === TRUE) {
        $order_id = $conn->insert_id; // Получаем ID заказа

        if ($payment === 'card') {
            // Перенаправляем на оплату через ЮKassa
            $redirect_url = "https://yoomoney.ru/quickpay/confirm.xml?" . http_build_query([
                'receiver' => '1007962', // Ваш shopId
                'formcomment' => 'Оплата заказа',
                'short-dest' => 'Оплата заказа',
                'label' => 'order_' . $order_id, // Уникальный идентификатор заказа
                'quickpay-form' => 'shop',
                'targets' => 'Оплата заказа',
                'sum' => 100, // Сумма оплаты
                'paymentType' => 'AC' // Способ оплаты (банковская карта)
            ]);
            header("Location: $redirect_url");
            exit();
        } else {
            echo "Заказ успешно оформлен! Оплата наличными при получении.";
        }
    } else {
        echo "Ошибка при оформлении заказа: " . $conn->error;
    }
}

$conn->close();
?>