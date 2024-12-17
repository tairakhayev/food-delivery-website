<?php
session_start();
// Проверка, авторизован ли пользователь
if (!isset($_SESSION['id'])) {
    // Если не авторизован, перенаправляем на страницу входа
    header("Location: login.php");
    exit();
}
// Подключаем базу данных
include_once "php/conn.php";  // Убедитесь, что файл подключения к базе данных указан правильно
// Получаем id пользователя из сессии
$user_id = $_SESSION['id'];
// Выполняем запрос к базе данных для получения данных пользователя
$sql = "SELECT name FROM users WHERE id = '$user_id'";
$result = mysqli_query($conn, $sql);
// Проверяем, есть ли результат
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $name = $row['name']; // Сохраняем имя пользователя
} else {
    die("Ошибка запроса: " . mysqli_error($conn)); // Если ошибка в запросе, выводим ошибку
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title> Food Delivery </title>
</head>
<body>
    <!--sidebar-->
    <div class="sidebar">
        <!--Logo-->
        <h1 class="logo">FoodTime</h1>
        <div class="sidebar-menus">
            <a href="#"><ion-icon name="storefront-outline"></ion-icon>Home</a>
            <a href="contact.php"><ion-icon name="chatbubbles-outline"></ion-icon>Contact Us</a>
            <a href="#"><ion-icon name="settings-outline"></ion-icon>Settings</a>
        </div>
        <div class="sidebar-logout">
            <a href="utils/logout.php"><ion-icon name="log-out-outline"></ion-icon>Logout</a>
        </div>
    </div>
    <!--main-->
    <div class="main">
        <!--main naavbar-->
        <div class="main-navbar">
            <!--menu when appear on mobile version-->
            <ion-icon class="menu-toggle" name="menu-outline"></ion-icon>
            <!--search bar-->
            <div class="search">
                <input type="text" id="searchInput" placeholder="What you want to eat?" oninput="searchMenu()">
                <button class="search-btn" onclick="searchMenu()">Search</button>
            </div>
            <!--profile icon on left side of navbar-->
            <div class="profile">
                <a class="cart" href="#" onclick="toggleCartPopup()">
                    <ion-icon name="cart-outline"></ion-icon>
                    <span class="cart-count" id="cart-count">0</span>
                </a>
                <a class="user" href="login.php"><ion-icon name="person-outline"></ion-icon></a>
                <div class="top">
                    <div>
                        <?php 
                            echo "<h2>Welcome, $name!</h2>"; 
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- shopping cart section -->
        <div id="cart-popup" class="cart-popup">
            <h4>Shopping Cart</h4>
            <table id="cart-items">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>#</th>
                        <th>Price($)</th>
                        <th>Total($)</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            <p>Total($)<span id="cart-total">0.00</span></p>
            <a class="cart-close" onclick="closeCart()"><ion-icon name="close-circle"></ion-icon></a>
        </div>


        <div class="main-highlight">
            <div div class="main-header">
                <h2 class="main-title">Recommendations</h2>
                <div class="main-arrow">
                    <ion-icon class="back" name="chevron-back-circle-outline"></ion-icon>
                    <ion-icon class="next" name="chevron-forward-circle-outline"></ion-icon>
                </div>
            </div>
            <div class="highlight-wrapper">
                <div class="highlight-card">
                    <img class="highlight-img" src="images/salad.jpg">
                    <div class="highlight-desc">
                        <h4>Fresh Salad</h4>
                        <p>$15</p>
                    </div>
                </div>
                <div class="highlight-card">
                    <img class="highlight-img" src="images/coffee.jpg">
                    <div class="highlight-desc">
                        <h4>Cappuccino</h4>
                        <p>$2.50</p>
                    </div>
                </div>
                <div class="highlight-card">
                    <img class="highlight-img" src="images/steak.jpg">
                    <div class="highlight-desc">
                        <h4>Premium Steak</h4>
                        <p>$35.90</p>
                    </div>
                </div>
                <div class="highlight-card">
                    <img class="highlight-img" src="images/burger.jpg">
                    <div class="highlight-desc">
                        <h4>Cheeseburger</h4>
                        <p>$22.90</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-menus">
            <!--filter section-->
            <div class="main-filter">
                <div>
                    <h2 class="main-title">Menu <br></h2>
                    <div class="main-arrow">
                        <ion-icon class="back-menus" name="chevron-back-circle-outline"></ion-icon>
                        <ion-icon class="next-menus" name="chevron-forward-circle-outline"></ion-icon>
                    </div>
                </div>
                <div class="filter-wrapper">
                    <div class="filter-card">
                        <div class="filter-icon">
                            <ion-icon name="restaurant-outline"></ion-icon>
                        </div>
                        <p>All Menus</p>
                    </div>
                    <div class="filter-card">
                        <div class="filter-icon">
                            <ion-icon name="fast-food-outline"></ion-icon>
                        </div>
                        <p>Burger</p>
                    </div>
                    <div class="filter-card">
                        <div class="filter-icon">
                            <ion-icon name="pizza-outline"></ion-icon>
                        </div>
                        <p>Pizza</p>
                    </div>
                    <div class="filter-card">
                        <div class="filter-icon">
                            <ion-icon name="wine-outline"></ion-icon>
                        </div>
                        <p>Wine</p>
                    </div>
                    <div class="filter-card">
                        <div class="filter-icon">
                            <ion-icon name="ice-cream-outline"></ion-icon>
                        </div>
                        <p>Ice Cream</p>
                    </div>
                    <div class="filter-card">
                        <div class="filter-icon">
                            <ion-icon name="cafe-outline"></ion-icon>
                        </div>
                        <p>Coffee</p>
                    </div>
                    <div class="filter-card">
                        <div class="filter-icon">
                            <ion-icon name="fish-outline"></ion-icon>
                        </div>
                        <p>Seafood</p>
                    </div>
                    <div class="filter-card">
                        <div class="filter-icon">
                            <ion-icon name="nutrition-outline"></ion-icon>
                        </div>
                        <p>Healthy Food</p>
                    </div>
                </div>
            </div>
            <hr class="divider">
            <!--list of food menus-->
            <div class="main-detail">
                <h2 class="main-title">Choose Order</h2>
                <div class="detail-wrapper">
                    <div class="detail-card">
                        <img class="detail-img" src="images/shrimpsoup.png">
                        <div class="detail-desc">
                            <div class="detail-name">
                                <h4>Shrimp Soup</h4>
                                <p class-="detail-sub">Delicious</p>
                                <p class="price">$17</p>
                                <button class="add-to-cart-btn" onclick="addToCart('Shrimp Soup',17.00)">Add to Cart</button>
                            </div>
                            <ion-icon class="detail-favorite" name="bookmark-outline"></ion-icon>
                        </div>
                    </div>
                    <div class="detail-card">
                        <img class="detail-img" src="images/pizza.jpg">
                        <div class="detail-desc">
                            <div class="detail-name">
                                <h4>Pizza Pepperoni</h4>
                                <p class-="detail-sub">Spicy</p>
                                <p class="price">$20</p>
                                <button class="add-to-cart-btn" onclick="addToCart('Pizza Pepperoni',20.00)">Add to Cart</button>
                            </div>
                            <ion-icon class="detail-favorite" name="bookmark-outline"></ion-icon>
                        </div>
                    </div>
                    <div class="detail-card">
                        <img class="detail-img" src="images/wine.jpg">
                        <div class="detail-desc">
                            <div class="detail-name">
                                <h4>Wine</h4>
                                <p class-="detail-sub">Dry/Dolce</p>
                                <p class="price">$25</p>
                                <button class="add-to-cart-btn" onclick="addToCart('Wine',25.00)">Add to Cart</button>
                            </div>
                            <ion-icon class="detail-favorite" name="bookmark-outline"></ion-icon>
                        </div>
                    </div>
                    <div class="detail-card">
                        <img class="detail-img" src="images/burgerfries.jpg">
                        <div class="detail-desc">
                            <div class="detail-name">
                                <h4>Burger and Fries</h4>
                                <p class-="detail-sub">Delicious</p>
                                <p class="price">$20</p>
                                <button class="add-to-cart-btn" onclick="addToCart('Burger and Fries',20.00)">Add to Cart</button>
                            </div>
                            <ion-icon class="detail-favorite" name="bookmark-outline"></ion-icon>
                        </div>
                    </div>
                    <div class="detail-card">
                        <img class="detail-img" src="images/kebab.jpg">
                        <div class="detail-desc">
                            <div class="detail-name">
                                <h4>Kebab</h4>
                                <p class-="detail-sub">Chicken/Meat</p>
                                <p class="price">$15</p>
                                <button class="add-to-cart-btn" onclick="addToCart('Kebab',15.00)">Add to Cart</button>
                            </div>
                            <ion-icon class="detail-favorite" name="bookmark-outline"></ion-icon>
                        </div>
                    </div>
                    <div class="detail-card">
                        <img class="detail-img" src="images/sushi.jpg">
                        <div class="detail-desc">
                            <div class="detail-name">
                                <h4>Sushi</h4>
                                <p class-="detail-sub">Seafood</p>
                                <p class="price">$30</p>
                                <button class="add-to-cart-btn" onclick="addToCart('Sushi',30.00)">Add to Cart</button>
                            </div>
                            <ion-icon class="detail-favorite" name="bookmark-outline"></ion-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="app.js"></script> 
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>

