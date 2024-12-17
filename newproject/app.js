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

function addToCart(itemName,itemPrice){
    const cartItems= document.getElementById('cart-items').getElementsByTagName('tbody')[0];
    const existingItem=Array.from(cartItems.getElementsByTagName('tr')).find(item=>item.cells[0].textContent==itemName);
    if(existingItem){
        const itemCount=parseInt(existingItem.querySelector('.item-count').textContent) + 1;
        existingItem.querySelector('.item-count').textContent=itemCount;

        const itemTotal=parseFloat(existingItem.querySelector('.item-total').textContent)+parseFloat(itemPrice);
        existingItem.querySelector('.item-total').textContent=itemTotal.toFixed(2);

    }
    else{
        const newRow=cartItems.insertRow();
        newRow.innerHTML= `
        <td>${itemName}</td>
        <td class='item-count'>1</td>
        <td class='item-price'>${itemPrice}</td>
        <td class='item-total'>${itemPrice}</td>
        `;
    }
    updateCartCountAndTotal();
}

//update cart count and total
function updateCartCountAndTotal(){
    const cartCount=document.getElementById('cart-count');
    const cartTotal=document.getElementById('cart-total');
    const cartItems=document.querySelectorAll('#cart-items tbody tr');
    let totalCount=0;
    let total=0;
    cartItems.forEach(item=>{
        const itemCount=parseInt(item.querySelector('.item-count').textContent);
        const itemTotal=parseFloat(item.querySelector('.item-total').textContent);
        totalCount+=itemCount;
        total+=itemTotal;
    });
    cartCount.textContent=totalCount;
    cartTotal.textContent=total.toFixed(2);
}

function renderCartItems() {
    const cartItemsElement = $('#cart-items tbody');
    const cart = getCartItems(); // Assuming this is the function you use to get cart items

    // clear the cart items
    cartItemsElement.empty();

    if (cart.length == 0) {
        cartItemsElement.html(`
        <div class="cart-empty">
            <p>Your Cart is Empty</p>
        </div>
        `);
    } else {
        cart.forEach(function (item) {
            const cartItemElement = $('<div class="cart-item"></div>');
            cartItemElement.html(`
                <div class="cart-item-desc">
                    <div class="cart-item-title">${item.name}</div>
                    <div class="cart-item-quantity">
                        <button class="change-quantity" data-id="${item.id}" data-action="decrement">-</button>
                        <span class="quantity">${item.quantity}</span>
                        <button class="change-quantity" data-id="${item.id}" data-action="increment">+</button>
                    </div>
                </div>
                <div class="cart-item-price">$${(item.price * item.quantity).toFixed(2)}</div>
                <button class="cart-item-remove" data-id="${item.id}"><i class="fa solid fa-trash"></i></button>
            `);
            cartItemsElement.append(cartItemElement);
        });
    }
    updateCartCountAndTotal();
}

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

