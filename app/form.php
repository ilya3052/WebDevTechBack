<?php
    $white_list_email_domains = ["yandex.ru", "yandex.by", "yandex.kz", "ya.ru", "mail.ru", "internet.ru", "list.ru", "bk.ru", "inbox.ru", "vk.com", 
    "rambler.ru"];
    function hasNumber($str) {
        return preg_match('/\d/', $str);
    }

    function hasLetter($str) {
        return preg_match('/[a-zA-Zа-яА-Я]/u', $str);
    }

    function hasSpecial($str) {
        return preg_match('/[^a-zA-Z0-9а-яА-Я]/u', $str);
    }

    function isValidEmailDomain($email) {
        $domain = explode('@', $email)[1];
        return in_array($domain, $white_list_email_domains);
    }         
?>


<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $client_name = trim($_POST['client_name'] ?? '');
        $client_phone = str_replace([' ', '(', ')', '-'], '', trim($_POST['client_phone'] ?? ''));
        $client_mail = trim($_POST['client_mail'] ?? '');
        $courier_name = trim($_POST['courier_name'] ?? '');

        $product = trim($_POST['product'] ?? '');
        $product_price = trim($_POST['product_price'] ?? '');

        $city = trim($_POST['city'] ?? '');
        $street = trim($_POST['street'] ?? '');
        $house = trim($_POST['house'] ?? '');

        $entrance = trim($_POST['entrance'] ?? '');
        $apartment = trim($_POST['apartment'] ?? '');
        $floor = trim($_POST['floor'] ?? '');
        $intercome_code = trim($_POST['intercome_code'] ?? '');

        $delivery_date = trim($_POST['delivery_date'] ?? '');
        $delivery_price = trim($_POST['delivery_price'] ?? '');
        $errors = [];
        if (empty($client_name) || strlen($client_name) > 100 || hasNumber($client_name)) {
            $errors[] = 'Укажите корректное имя клиента';
        }
        if (empty($client_phone) || strlen($client_phone) < 11) {
            $errors[] = 'Укажите корректный номер телефона';
        }
        if (empty($courier_name) || strlen($courier_name) > 100 || hasNumber($courier_name)) {
            $errors[] = 'Укажите корректное имя курьера';
        }
        if (empty($product)) {
            $errors[] = 'Укажите коректное название товара';
        }
        if (empty($product_price) || hasLetter($product_price) || $product_price < 1) {
            $errors[] = 'Укажите корректную цену';
        }
        if (empty($city)) {
            $errors[] = 'Укажите город';
        }
        if (empty($street)) {
            $errors[] = 'Укажите улицу';
        }   
        if (empty($house) || hasLetter($house[0]) || !hasNumber($house) || hasSpecial($house[0])) {
            $errors[] = 'Укажите корректный номер дома';
        }   
        if ((strlen($entrance) > 0 && $entrance < 1) || hasLetter($entrance) || hasSpecial($entrance)) {
            $errors[] = 'Укажите корректный номер подъезда';
        }
        if ((strlen($apartment) > 0 && $apartment < 1) || hasLetter($apartment) || hasSpecial($apartment)) {
            $errors[] = 'Укажите корректный номер квартиры';
        }
        if ((strlen($floor) > 0 && $floor < 1) || hasLetter($floor) || hasSpecial($floor)) {
            $errors[] = 'Укажите корректный этаж';
        }
        if (empty($delivery_date)) {
            $errors[] = 'Укажите дату доставки';
        }
        if (empty($delivery_price) || $delivery_price < 1 || hasLetter($delivery_price) || hasSpecial($delivery_price)) {
            $errors[] = 'Укажите корректную цену доставки';
        }
        $csvFile = 'data.csv';
        $dataRow = [
            $client_name,
            $client_phone,
            $client_mail,
            $courier_name,
            $product,
            $product_price,
            $city,
            $street,
            $house,
            $entrance,
            $apartment,
            $floor,
            $intercome_code,
            $delivery_date,
            $delivery_price
        ];
        if (!empty($errors)) {
            echo 'Данные не сохранены' . "\n";
            foreach ($errors as $error) {
                echo $error . "\n";
            }
            exit();
        }
        if (($file = fopen($csvFile, 'a'))) {
            fputcsv($file, $dataRow);
            fclose($file);
            $message = 'Даныне успешно сохранены';
        }
        echo $message . "\n";
    }
?>