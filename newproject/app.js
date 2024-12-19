d//showing navbar when click menu on mobile view
const mobile = document.querySelector('.menu-toggle');
const mobileLink=document.querySelector('.sidebar');

mobile.addEventListener("click", function(){
    mobile.classList.toggle("is-active");
    mobileLink.classList.toggle("active");

});

//close menu when click
mobileLink.addEventListener("click",function(){
    const menuBars=document.querySelector(".is-active");
    if(window.innerWidth<=768 && menuBars){
        mobile.classList.toggle("is-active");
        mobileLink.classList.toggle("active");
    }
});

// move menu to right and left
var step=100;
var stepFilter=60;
var scrolling=true;

$(".back").bind("click",function(e){
    e.preventDefault();
    $(".highlight-wrapper").animate({
        scrollLeft:"-="+step+"px"
    });
});

$(".next").bind("click",function(e){
    e.preventDefault();
    $(".highlight-wrapper").animate({
        scrollLeft:"+="+step+"px"
    });
});

$(".back-menus").bind("click",function(e){
    e.preventDefault();
    $(".filter-wrapper").animate({
        scrollLeft:"-="+step+"px"
    });
});

$(".next-menus").bind("click",function(e){
    e.preventDefault();
    $(".filter-wrapper").animate({
        scrollLeft:"+="+step+"px"
    });
});



//for shopping cart part
// for cart popup
function toggleCartPopup(){
    const cartPopup=document.getElementById('cart-popup');
    cartPopup.classList.toggle('active');
}

//for close cart popup
function closeCart(){
    const cartPopup=document.getElementById('cart-popup');
    cartPopup.classList.remove('active')
}

//for add to cart button

function addToCart(itemName, price) {
    const cartItems = document.getElementById('cart-items').getElementsByTagName('tbody')[0];

    // Проверяем, есть ли товар в корзине
    const existingRow = Array.from(cartItems.getElementsByTagName('tr')).find(row => {
        return row.querySelector('.item-name').textContent === itemName;
    });

    if (existingRow) {
        // Если товар уже в корзине, увеличиваем количество
        const countElement = existingRow.querySelector('.item-count');
        countElement.textContent = parseInt(countElement.textContent) + 1;
        updateRowTotal(existingRow, price);
    } else {
        // Добавляем новый товар в корзину
        const newRow = `
            <tr>
                <td class="item-name">${itemName}</td>
                <td>
                    <button class="decrease-qty">-</button>
                    <span class="item-count">1</span>
                    <button class="increase-qty">+</button>
                </td>
                <td class="item-price">${price.toFixed(2)}</td>
                <td class="item-total">${price.toFixed(2)}</td>
            </tr>
        `;
        cartItems.insertAdjacentHTML('beforeend', newRow);
    }

    updateCartTotal();
}

function updateRowTotal(row, price) {
    const count = parseInt(row.querySelector('.item-count').textContent);
    const totalElement = row.querySelector('.item-total');
    totalElement.textContent = (count * price).toFixed(2);
    updateCartTotal();
}

function updateCartTotal() {
    let totalSum = 0;
    document.querySelectorAll('.item-total').forEach(el => {
        totalSum += parseFloat(el.textContent);
    });
    document.getElementById('cart-total').textContent = totalSum.toFixed(2);
}

document.addEventListener('DOMContentLoaded', () => {
    // Это слушатель кликов на всех элементах корзины
    document.getElementById('cart-items').addEventListener('click', function(event) {
        const target = event.target;

        // Проверяем, была ли нажата кнопка "increase-qty"
        if (target.classList.contains('increase-qty')) {
            handleQuantityChange(target, 1);
        }
        // Проверяем, была ли нажата кнопка "decrease-qty"
        else if (target.classList.contains('decrease-qty')) {
            handleQuantityChange(target, -1);
        }
    });
});


function handleQuantityChange(button, change) {
    const row = button.closest('tr'); // Находим родительскую строку
    const countElement = row.querySelector('.item-count'); // Элемент количества
    const price = parseFloat(row.querySelector('.item-price').textContent); // Цена товара
    let currentCount = parseInt(countElement.textContent) + change;

    if (currentCount > 0) {
        countElement.textContent = currentCount; // Обновляем количество
        row.querySelector('.item-total').textContent = (price * currentCount).toFixed(2); // Обновляем стоимость
    } else {
        row.remove(); // Удаляем строку, если количество 0
    }

    updateCartTotal(); // Обновляем итоговую сумму корзины
}



//update cart count and total
// function updateCartCountAndTotal() {
//     const cartItems = document.getElementById('cart-items').getElementsByTagName('tbody')[0];
//     let totalSum = 0;

//     Array.from(cartItems.getElementsByTagName('tr')).forEach(row => {
//         const total = parseFloat(row.querySelector('.item-total').textContent);
//         totalSum += total;
//     });

//     document.getElementById('cart-total').textContent = totalSum.toFixed(2);
// }



//поиск
function searchMenu() {
    var input = document.getElementById("searchInput").value.toLowerCase(); // Получаем текст из поля ввода
    var menuItems = document.querySelectorAll(".detail-card"); // Получаем все карточки

    menuItems.forEach(function(item) {
        var productName = item.querySelector(".detail-name h4").innerText.toLowerCase(); // Название блюда

        if (productName.includes(input)) {
            item.style.display = ""; // Показываем элемент
        } else {
            item.style.display = "none"; // Скрываем элемент
        }
    });
}

function redirectToCheckout() {
    const cartItems = document.getElementById('cart-items').getElementsByTagName('tbody')[0];
    if (cartItems && cartItems.getElementsByTagName('tr').length > 0) {
        window.location.href = 'checkout.php';
    } else {
        alert('Your cart is empty. Please add items to the cart before proceeding to checkout.');
    }
}

