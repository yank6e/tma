document.getElementById('menu-icon').addEventListener('click', function() {
    document.getElementById('sidebar').classList.toggle('active');
});

document.querySelectorAll('.increase-btn').forEach(button => {
    button.addEventListener('click', function() {
        let quantityInput = this.previousElementSibling;
        quantityInput.value = parseInt(quantityInput.value) + 1;
    });
});

document.querySelectorAll('.decrease-btn').forEach(button => {
    button.addEventListener('click', function() {
        let quantityInput = this.nextElementSibling;
        if (parseInt(quantityInput.value) > 1) {
            quantityInput.value = parseInt(quantityInput.value) - 1;
        }
    });
});

document.querySelectorAll('.add-to-cart-btn').forEach(button => {
    button.addEventListener('click', function() {
        let productName = this.getAttribute('data-product-name');
        let productPrice = this.getAttribute('data-product-price');
        let quantity = this.previousElementSibling.previousElementSibling.querySelector('.quantity').value;

        fetch('C:\ospanel\domains\tma\add_to_cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `product_name=${productName}&product_price=${productPrice}&quantity=${quantity}`
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});
