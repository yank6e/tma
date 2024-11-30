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
