<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Блог для народа</title>

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/navigation.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
</head>
<body>
    <!-- NAVIGATION -->
    <nav>
        <ul>
            <li><i class="fas fa-home"></i><a href="/">Главная</a></li>
            <li><i class="fab fa-facebook-messenger"></i><a href="/about">О блоге</a></li>
            <li class="auth"><i class="fas fa-user-plus"></i><a href="/register">Зарегистрироваться</a></li>
            <li class="auth"><i class="fas fa-sign-in-alt"></i><a href="/login">Войти</a></li>
        </ul>
    </nav>
    <!-- HEADER -->
    <header>
        <div class="text">
            <p>Блог для...</p>
            <p>...народа</p>
        </div>
    </header>
    <!-- BODY -->
    <?php
        include 'app/views/'.$content_view;
    ?>
    <!-- FOOTER -->
</body>
</html>