<?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $courier_name = trim($_POST['name'] ?? '');
            $client_name = trim($_POST['client'] ?? '');
            $client_mail = trim($_POST['mail'] ?? '');
            $product = trim($_POST['product'] ?? '');
            $product_price = trim($_POST['product_price'] ?? '');
            $address = trim($_POST['address'] ?? '');
            $date = trim($_POST['date'] ?? '');
            $delivery_price = trim($_POST['delivery_price'] ?? '');

            $csv_file = 'data.csv';
            $dataRow = [
                $courier_name,
                $client_name,
                $client_mail,
                $product,
                $product_price,
                $address,
                $date,
                $delivery_price
            ];

            if (($file = fopen($csvFile, 'a'))) {
                fputcsv($file, $dataRow);
                fclose($file);
                $message = 'Даныне успешно сохранены';
            }
            else {
                $message = 'Ошибка при сохранении данных';
            }
        }
    ?>