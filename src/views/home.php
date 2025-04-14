<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Добро пожаловать</h1>
    <?php if (isset($_SESSION['user_id'])): ?>
        <p>Вы вошли как <?= htmlspecialchars($_SESSION['email']); ?></p>
        <p><a href="/profile">Профиль</a></p>
        <p><a href="/deliveries">Доставки</a></p>
        <p><a href="/logout">Выйти</a></p>
    <?php else: ?>
        <p><a href="/login">Войти</a></p>
        <p><a href="/register">Зарегистрироваться</a></p>
    <?php endif; ?>
</body>
</html>