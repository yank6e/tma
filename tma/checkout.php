<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Оформление заказа</title>
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
        <form id="checkout-form" action="process_order.php" method="POST">
            <h2>Оформление заказа</h2>
            <div class="form-group">
                <label for="fullname">ФИО:</label>
                <input type="text" id="fullname" name="fullname" required>
            </div>
            <div class="form-group">
                <label for="address">Адрес доставки:</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="comments">Комментарии к заказу (по желанию):</label>
                <textarea id="comments" name="comments" rows="4"></textarea>
            </div>
            <div class="form-group">
                <label for="payment">Оплата:</label>
                <select id="payment" name="payment" required>
                    <option value="card">Оплата картой</option>
                    <option value="cash">Оплата наличными</option>
                </select>
            </div>
            <button type="submit" class="submit-order-btn">Оформить заказ</button>
        </form>

        <!-- Форма для оплаты через ЮKassa -->
        <form id="yookassa-payment-form" action="https://yoomoney.ru/quickpay/confirm.xml" method="POST" style="display: none;">
            <input type="hidden" name="receiver" value="1007962">
            <input type="hidden" name="formcomment" value="Оплата заказа">
            <input type="hidden" name="short-dest" value="Оплата заказа">
            <input type="hidden" name="label" value="order_id">
            <input type="hidden" name="quickpay-form" value="shop">
            <input type="hidden" name="targets" value="Оплата заказа">
            <input type="hidden" name="sum" value="100" data-type="number">
            <input type="hidden" name="paymentType" value="AC">
            <input type="submit" value="Оплатить">
        </form>
    </main>
    <script src="js/script.js"></script>
    <script>
        document.getElementById('checkout-form').addEventListener('submit', function(event) {
            event.preventDefault();

            // Получаем выбранный способ оплаты
            const paymentMethod = document.getElementById('payment').value;

            if (paymentMethod === 'card') {
                // Показываем форму оплаты через ЮKassa
                document.getElementById('yookassa-payment-form').style.display = 'block';
                document.getElementById('yookassa-payment-form').submit();
            } else {
                // Если оплата наличными, отправляем форму на сервер
                event.target.submit();
            }
        });
    </script>
</body>
</html>