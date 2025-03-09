<?php
    require 'db.php';

    $stmt = $pdo->query('SELECT * FROM client');
    $client = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $stmt = $pdo->query('SELECT * FROM product');
    $product = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $pdo->query('SELECT * FROM delivery');
    $delivery = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $pdo->query('SELECT * FROM courier');
    $courier = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Данные</title>
</head>
<body>
</body>
</html>