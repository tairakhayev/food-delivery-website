<!-- checkout.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="styles/checkout.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title> Checkout </title>
</head>
<body>
    <div class="row">
    <div class="col-75">
        <div class="container-checkout">
            <div class="row">
            <div class="col-50">
                <h3>Billing address</h3>
                <label for="fname"><i class="fa fa-user"></i> Name</label>
                <input type="text" id="fname" name="firstname" placeholder="First Name Last Name">
                <label for="email"><i class="fa fa-envelope"></i> Email</label>
                <input type="text" id="email" name="email" placeholder="Your email">
                <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                <input type="text" id="adr" name="address" placeholder="Via">
                <label for="city"><i class="fa fa-institution"></i> City</label>
                <input type="text" id="city" name="city" placeholder="Your City">

                <div class="row">
                <div class="col-50">
                    <label for="state">Country</label>
                    <input type="text" id="state" name="state" placeholder="Delivery address">
                </div>
                <div class="col-50">
                    <label for="zip">Zip</label>
                    <input type="text" id="zip" name="zip" placeholder="10001">
                </div>
                </div>
            </div>

            <div class="col-50">
                <h3>Payment</h3>
                <label for="fname">Cards</label>
                <div class="icon-container">
                <i class="fa fa-cc-visa" style="color:navy;"></i>
                <i class="fa fa-cc-amex" style="color:blue;"></i>
                <i class="fa fa-cc-mastercard" style="color:red;"></i>
                <i class="fa fa-cc-paypal" style="color:orange;"></i>
                </div>
                <label for="cname">Name on card</label>
                <input type="text" id="cname" name="cardname" placeholder="First Name Last Name" required>
                <label for="ccnum">Card number</label>
                <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444" required>
                <label for="expmonth">MM</label>
                <input type="text" id="expmonth" name="expmonth" placeholder="Month" required>

                <div class="row">
                <div class="col-50">
                    <label for="expyear">YY</label>
                    <input type="text" id="expyear" name="expyear" placeholder="Year" required>
                </div>
                <div class="col-50">
                    <label for="cvv">CVV</label>
                    <input type="text" id="cvv" name="cvv" placeholder="CVV*" required>
                </div>
                </div>
            </div>

            </div>
            <label>
            <input type="checkbox" checked="checked" name="sameadr"> Shipping address matches billing address
            </label>
            <form method="post">
                <input type="submit" value="Continue" class="btn" formaction="thankyou.php">
            </form>
            <form action="index.php">
                    <button type="submit" class="btn">Back to Home</button>
            </form>
        </div>
    </div>
</div>
<script src="app.js"></script> 
<script>
    // Функция для проверки номера карты
    function validateCardNumber(cardNumber) {
        const regex = /^[0-9]{13,19}$/;  // Проверка на 13-19 цифр
        return regex.test(cardNumber);
    }

    // Функция для проверки даты истечения срока
    function validateExpirationDate(month, year) {
        const currentYear = new Date().getFullYear();
        const currentMonth = new Date().getMonth() + 1;  // Месяцы начинаются с 0

        if (month < 1 || month > 12) {
            return false;  // Некорректный месяц
        }

        if (year < currentYear || (year === currentYear && month < currentMonth)) {
            return false;  // Карта уже просрочена
        }

        return true;
    }

    // Основная функция валидации формы
    function validateForm(event) {
        const cardNumber = document.getElementById("ccnum").value;
        const expirationMonth = document.getElementById("expmonth").value;
        const expirationYear = document.getElementById("expyear").value;
        const cvv = document.getElementById("cvv").value;

        // Валидация номера карты
        if (!validateCardNumber(cardNumber)) {
            alert("Номер карты должен содержать от 13 до 19 цифр.");
            event.preventDefault(); // Останавливает отправку формы
            return;
        }

        // Валидация даты истечения
        if (!validateExpirationDate(expirationMonth, expirationYear)) {
            alert("Дата истечения срока карты некорректна.");
            event.preventDefault();
            return;
        }

        // Валидация CVV
        if (cvv.length !== 3) {
            alert("CVV должен состоять из 3 цифр.");
            event.preventDefault();
            return;
        }
    }

    // Привязка валидации к отправке формы
    document.querySelector("form").addEventListener("submit", validateForm);
</script>
</body>
</html>