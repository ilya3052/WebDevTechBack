<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Курьерская служба</h1>
    <form action="form.php" method="POST">
        <h3>Информация о клиенте</h3>
        <label for="client">ФИО клиента*</label>
        <input type="text" name="client" id="client" required maxlength=100>
        <br><br>
        <label for="client_phone">Номер телефона клиента*</label>
        <input type="tel" name="client_phone" id="client_phone" placeholder="+7(000)000-00-00" required>
        <br><br>
        <label for="client_mail">Почта клиента</label>
        <input type="email" name="client_mail" id="client_mail" placeholder="some@some.some">
        <h3>Курьер</h3>
        <label for="courier">ФИО курьера*</label>
        <input type="text" name="name" id="name" required maxlength=100>
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
        <input type="text" name="house" id="house" required min="1">
        <br><br>
        <label for="entrance">Подъезд</label>
        <input type="number" name="entrance" id="entrance">
        <br><br>
        <label for="apartment">Квартира</label>
        <input type="text" name="apartment" id="apartment" min="1">
        <br><br>
        <label for="floor">Этаж</label>
        <input type="text" name="floor" id="floor" min="1">
        <br><br>
        <label for="intercome_code">Код домофона</label>
        <input type="text" name="intercome_code" id="intercome_code">
        <br><br>
        <label for="date">Дата доставки*</label>
        <input type="date" name="date" id="date" required>
        <br><br>
        <label for="delivery_price">Стоимость доставки*</label>
        <input type="number" name="delivery_price" id="delivery_price" required min="1">
        <br><br>
        <input type="submit" value="Отправить">
    </form>
</body>
</html>