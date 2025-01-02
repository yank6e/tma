<?php
$servername = "tmareg";
$username = "root";
$password = "";
$dbname = "food_delivery";

// Создаем соединение
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем соединение
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT d.name AS dish_name, d.price, d.popularity
        FROM categories c
        JOIN dishes d ON c.id = d.category_id
        WHERE c.name = 'Напитки'
        ORDER BY d.name";

$result = $conn->query($sql);

// Проверка наличия данных
if ($result->num_rows > 0) {
    // Вывод данных в HTML
    while($row = $result->fetch_assoc()) {
        echo "<div class='card'>
                <div class='image-placeholder'></div>
                <div class='details'>
                    <h2>" . $row["dish_name"] . "</h2>
                    <p>" . $row["price"] . "</p>
                    <p>Популярность</p>
                    <div class='rating'>";
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $row["popularity"]) {
                echo "<span class='star'>&#9733;</span>";
            } else {
                echo "<span class='star'>&#9734;</span>";
            }
        }
        echo "</div>
                    <form class='add-to-cart-form' action='add_to_cart.php' method='POST'>
                    <div class='quantity-control'>
                        <button type='button' class='decrease-btn'>-</button>
                        <input type='number' name='quantity' class='quantity' value='1' min='1'>
                        <button type='button' class='increase-btn'>+</button>
                    </div>
                    <input type='hidden' name='product_name' value='" . $row['dish_name'] . "'>
                    <input type='hidden' name='product_price' value='" . $row['price'] . "'>
                    <button type='submit' class='add-to-cart-btn'>В корзину</button>
                    </form>
                </div>
              </div>
            <div id='notification' class='notification'>Товар успешно добавлен в корзину!</div>";
    }
} else {
    echo "<p>Нет данных для отображения</p>";
}

$conn->close();
?>