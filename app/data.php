<?php
    require 'db.php';

    $stmt = $pdo->query('
        SELECT 
            delivery_number, client_fullname, courier_fullname, delivery_city, delivery_street, delivery_house, 
            delivery_entrance, delivery_apartment, delivery_floor, delivery_intercome_code, delivery_date, delivery_price 
        FROM delivery d join client cl on d.client_id = cl.client_id join courier cr on d.courier_id = cr.courier_id');
    $deliveries = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Данные</title>
    <style>
        table {
    width: 100%;
    max-width: 90%;
    border-collapse: collapse;
    margin: 20px 0;
    background: white;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

table th, table td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

table th {
    background-color: #007bff;
    color: white;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 16px;
}

table tr:nth-child(even) {
    background-color: #f9f9f9;
}

table tr:hover {
    background-color: #f1f1f1;
}

table td {
    color: #333;
    font-size: 14px;
}

table td:empty::before {
    content: "—";
    color: #999;
}
    </style>
</head>
<body>
    <h2>Список доставок</h2>
    <table>
        <tr>
            <th>ID доставки</th>
            <th>ФИО клиента</th>
            <th>ФИО курьера</th>
            <th>Город</th>
            <th>Улица</th>
            <th>Дом</th>
            <th>Подъезд</th>
            <th>Квартира</th>
            <th>Этаж</th>
            <th>Код домофона</th>
            <th>Дата доставки</th>
            <th>Стоимость доставки</th>
        </tr>
        <?php foreach($deliveries as $delivery): ?>
            <tr>
                <td><?= $delivery['delivery_number'] ?></td>
                <td><?= $delivery['client_fullname'] ?></td>
                <td><?= $delivery['courier_fullname'] ?></td>
                <td><?= $delivery['delivery_city'] ?></td>
                <td><?= $delivery['delivery_street'] ?></td>
                <td><?= $delivery['delivery_house'] ?></td>
                <td><?= empty($delivery['delivery_entrance']) ? "Не указан" : $delivery['delivery_entrance'] ?></td>
                <td><?= empty($delivery['delivery_apartment']) ? "Не указан" : $delivery['delivery_apartment']  ?></td>
                <td><?= empty($delivery['delivery_floor']) ? "Не указан" : $delivery['delivery_floor'] ?></td>
                <td><?= empty($delivery['delivery_intercome_code']) ? "Не указан" : $delivery['delivery_intercome_code'] ?></td>
                <td><?= $delivery['delivery_date'] ?></td>
                <td><?= $delivery['delivery_price'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>