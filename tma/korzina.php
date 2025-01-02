<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Корзина</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <div class="menu-icon" id="menu-icon">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Поиск...">
        </div>
        <div class="profile-icon">
            <img src="img/profile.png" alt="Profile">
        </div>
    </header>
    <div class="sidebar" id="sidebar">
        <a href="index.php"><div class="sidebar-function">
            <h3>Главная страница</h3>
        </div></a>
        <a href="drink.php"><div class="sidebar-content">
            <h2>НАПИТКИ</h2>
            <img src="img/drinks.jpg" alt="Напитки">
        </div></a>
        <a href="salat.php"><div class="sidebar-content">
            <h2>САЛАТЫ</h2>
            <img src="img/salat.jpg" alt="САЛАТЫ">
        </div></a>
        <a href="hot.php"><div class="sidebar-content">
            <h2>ГОРЯЧЕЕ</h2>
            <img src="img/meet.png" alt="ГОРЯЧЕЕ">
        </div></a>
        <a href="order.php"><div class="sidebar-function">
            <h3>Заказы</h3>
        </div></a>
        <a href="korzina.php"><div class="sidebar-function">
            <h3>Корзина</h3>
        </div></a>
    </div>
    <main>
        <form id="cart-form" action="checkout.php" method="POST">
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

            // Запрос для получения всех товаров из корзины
            $sql = "SELECT id, product_name, product_price, quantity FROM cart";
            $result = $conn->query($sql);

            // Проверка наличия данных
            if ($result->num_rows > 0) {
                // Вывод данных в HTML
                while($row = $result->fetch_assoc()) {
                    echo "<div class='card'>
                            <div class='select-product'>
                                <input type='checkbox' name='selected_products[]' value='" . $row["id"] . "'>
                            </div>
                            <div class='image-placeholder'></div>
                            <div class='details'>
                                <h2>" . $row["product_name"] . "</h2>
                                <p>" . $row["product_price"] . "</p>
                                <p>Количество: " . $row["quantity"] . "</p>
                                <div class='quantity-control'>
                                    <button type='button' class='decrease-btn' data-id='" . $row["id"] . "'>-</button>
                                    <input type='number' class='quantity' value='" . $row["quantity"] . "' min='1'>
                                    <button type='button' class='increase-btn' data-id='" . $row["id"] . "'>+</button>
                                </div>
                                <button type='button' class='remove-btn' data-id='" . $row["id"] . "'>Удалить</button>
                            </div>
                          </div>";
                }
            } else {
                echo "<p>Ваша корзина пуста</p>";
            }

            $conn->close();
            ?>
            <button type="submit" class="checkout-btn">Перейти к оформлению заказа</button>
        </form>
    </main>
    <script src="js/script.js"></script>
</body>
</html>