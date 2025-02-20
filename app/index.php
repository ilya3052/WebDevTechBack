<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .client_name_error, .courier_name_error, .email_error, .entrance_error, .apartment_error, .floor_error, .house_error, .client_phone_error {
            color: red;
            margin: 0;
        }
    </style>
</head>
<body>
    <h1>Курьерская служба</h1>
    <form action="form.php" method="POST">
        <h3>Информация о клиенте</h3>
        <label for="client_name">ФИО клиента*</label>
        <input type="text" name="client_name" id="client_name" required maxlength=100>
        <p class="client_name_error"></p>
        <br>
        <label for="client_phone">Номер телефона клиента*</label>
        <input type="tel" name="client_phone" id="client_phone" data-tel-input maxlength=18 required>
        <p class="client_phone_error"></p>
        <br>
        <label for="client_mail">Почта клиента</label>
        <input type="email" name="client_mail" id="client_mail" placeholder="some@some.some">
        <p class="email_error"></p>
        <h3>Курьер</h3>
        <label for="courier">ФИО курьера*</label>
        <input type="text" name="courier_name" id="courier_name" required maxlength=100>
        <p class="courier_name_error"></p>
        <h3>Информация о товаре</h3>
        <label for="product">Товар*</label>
        <input type="text" name="product" id="product" required>
        <br><br>
        <label for="product_price">Стоимость товара*</label>
        <input type="number" name="product_price" id="product_price" required min="1">
        <h3>Адрес доставки</h3>
        <label for="city">Город*</label>
        <input type="text" name="city" id="city" required>
        <br><br>
        <label for="street">Улица*</label>
        <input type="text" name="street" id="street" required>
        <br><br>
        <label for="house">Дом*</label>
        <input type="number" name="house" id="house" required>
        <p class="house_error"></p>
        <br>
        <label for="corpus" class="corpus">Корпус</label>
        <input type="text" name="corpus" id="corpus">
        <br><br>
        <label for="entrance">Подъезд</label>
        <input type="number" name="entrance" id="entrance">
        <p class="entrance_error"></p>
        <br>
        <label for="apartment">Квартира</label>
        <input type="number" name="apartment" id="apartment" min="1">
        <p class="apartment_error"></p>
        <br>
        <label for="floor">Этаж</label>
        <input type="number" name="floor" id="floor" min="1">
        <p class="floor_error"></p>
        <br>
        <label for="intercome_code">Код домофона</label>
        <input type="text" name="intercome_code" id="intercome_code">
        <h3>Информация о доставке</h3>
        <label for="delivery_date">Дата доставки*</label>
        <input type="date" name="delivery_date" id="delivery_date" required>
        <br><br>
        <label for="delivery_price">Стоимость доставки*</label>
        <input type="number" name="delivery_price" id="delivery_price" required min="1">
        <br><br>
        <input type="submit" value="Отправить">
    </form>
    <script src="phoneinput.js"></script>
    <script src="index.js"></script>
</body>
</html>