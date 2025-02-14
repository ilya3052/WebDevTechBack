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
        <label for="courier">ФИО курьера</label>
        <input type="text" name="name" id="name">
        <br><br>
        <label for="client">ФИО клиента</label>
        <input type="text" name="client" id="client">
        <br><br>
        <label for="client_mail">Почта клиента</label>
        <input type="email" name="client_mail" id="client_mail">
        <br><br>
        <label for="product">Товар</label>
        <input type="text" name="product" id="product">
        <br><br>
        <label for="product_price">Стоимость товара</label>
        <input type="number" name="product_price" id="product_price">
        <br><br>
        <label for="address">Адрес доставки</label>
        <input type="text" name="address" id="address">
        <br><br>
        <label for="date">Дата доставки</label>
        <input type="date" name="date" id="date">
        <br><br>
        <label for="delivery_price">Стоимость доставки</label>
        <input type="number" name="delivery_price" id="delivery_price">
        <br><br>
        <input type="submit" value="Отправить">
    </form>
</body>
</html>