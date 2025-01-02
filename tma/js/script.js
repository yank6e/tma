// Обработчик для открытия/закрытия бокового меню
document.getElementById('menu-icon').addEventListener('click', function() {
    document.getElementById('sidebar').classList.toggle('active');
});

// Функция для показа уведомлений
function showNotification(message) {
    var notification = document.getElementById('notification');
    notification.textContent = message;
    notification.classList.add('show');
    setTimeout(function() {
        notification.classList.remove('show');
    }, 3000); // Уведомление будет видимым в течение 3 секунд
}

// Инициализация обработчиков событий после загрузки DOM
document.addEventListener('DOMContentLoaded', function() {
    // Обработчик для кнопок увеличения и уменьшения количества товара
    document.querySelectorAll('.decrease-btn, .increase-btn').forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.stopPropagation(); // Останавливаем всплытие события

            var quantityInput = this.parentElement.querySelector('.quantity');
            var quantity = parseInt(quantityInput.value);

            if (this.classList.contains('decrease-btn') && quantity > 1) {
                quantity--;
            } else if (this.classList.contains('increase-btn')) {
                quantity++;
            }

            quantityInput.value = quantity;
        });
    });

    // Обработчик для форм добавления товара в корзину
    document.querySelectorAll('.add-to-cart-form').forEach(function(form) {
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Предотвращаем стандартное поведение формы

            var formData = new FormData(this);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', this.action, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    if (xhr.responseText === 'success') {
                        showNotification('Товар успешно добавлен в корзину!');
                    } else {
                        showNotification('Ошибка при добавлении товара в корзину.');
                    }
                } else {
                    showNotification('Ошибка при отправке запроса.');
                }
            };
            xhr.send(formData);
        });
    });
});