document.addEventListener('DOMContentLoaded', () => {
    console.log('DOM fully loaded and parsed');
    document.getElementById('cart-items').addEventListener('click', function(event) {
        const target = event.target;

        if (target.classList.contains('increase-qty')) {
            console.log('Increase button clicked');
            handleQuantityChange(target, 1);
        } else if (target.classList.contains('decrease-qty')) {
            console.log('Decrease button clicked');
            handleQuantityChange(target, -1);
        }
    });
});
