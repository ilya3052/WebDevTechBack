<?php 
    require 'db.php';

    $file = fopen('new.csv', 'r');

    fgetcsv($file); // пропуск заголовка если имеется

    while (($data = fgetcsv($file, 1000, ','))) {
        $stmt = $pdo->prepare("INSERT INTO users (name, email, age) VALUES (?, ?, ?)");
        $stmt->execute([$data[0], $data[1], $data[2]]);
    }

    fclose($file);

?>