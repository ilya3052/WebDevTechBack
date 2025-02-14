<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
      <div class="text">
         Курьерская служба
      </div>
      <form action="form.php" method="POST">
         <div class="form-row">
            <div class="input-data">
            <label for="courier">ФИО курьера</label>
            <div class="underline"></div>
            <input type="text" name="name" id="name">
            </div>
            <div class="input-data">
                <label for="client">ФИО клиента</label>
                <div class="underline"></div>
                <input type="text" name="client" id="client">
            </div>
         </div>
         <div class="form-row">
            <div class="input-data">
                <label for="client_mail">Почта клиента</label>
                <div class="underline"></div>
                <input type="email" name="client_mail" id="client_mail">
            </div>
            <div class="input-data">
                <label for="product">Товар</label>
                <div class="underline"></div>
                <input type="text" name="product" id="product">
            </div>
         </div>
         <div class="form-row">
            <div class="input-data">
                <label for="product_price">Стоимость товара</label>
                <div class="underline"></div>
                <input type="number" name="product_price" id="product_price">
            </div>
            <div class="input-data">
                <label for="address">Адрес доставки</label>
                <div class="underline"></div>
                <input type="text" name="address" id="address">
            </div>
         </div>
         <div class="form-row">
            <div class="input-data">
                <label for="date">Дата доставки</label>
                <div class="underline"></div>
                <input type="date" name="date" id="date">
            </div>
            <div class="input-data">
                <label for="delivery_price">Стоимость доставки</label>
                <div class="underline"></div>
                <input type="number" name="delivery_price" id="delivery_price">
            </div>
         </div>
         <div class="form-row submit-btn">
               <div class="input-data">
                  <div class="inner"></div>
                  <input type="submit" value="Отправить">
               </div>
            </div>
      </form>
      </div>
</body>
</html>