<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $csv_file = 'data.csv';
            $dataRow = [$name, $email];

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
    <h1>Введите данные</h1>
    <?php if (!empty($message)): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    
    <form action="form.php" method="POST">
        <label for="name">Имя:</label>
        <input type="text" name="name" id="name">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email">
        <input type="submit" value="Отправить">
    </form>
</body>
</html>