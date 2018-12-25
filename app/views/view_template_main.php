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
            <div class="container-right">
                <?php if(!empty($data['nickname'])): ?>
                    <li class="dropdown-button"><i class="fas fa-user"></i><a href="/profile/<?=$data['nickname'];?>">Профиль: <?=$data['nickname'];?></a>
                        <ul class="dropdown">
                            <li><a href="/profile/<?=$data['nickname'];?>/posts">Список моих постов</a></li>
                            <li><a href="/createpost">Создать пост</a></li>
                            <?php if($data['userGroup'] == 0): ?>
                                <li><a href="/admin">Админ панель</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <li><i class="fas fa-sign-out-alt"></i></i><a href="/logout">Выйти</a></li>
                <?php else: ?>
                    <li><i class="fas fa-sign-in-alt"></i><a href="/login">Войти</a></li>
                    <li><i class="fas fa-user-plus"></i><a href="/register">Регистрация</a></li>
                <?php endif; ?>
            </div>
        </ul>
    </nav>
    <!-- BODY -->
    <?php
        include 'app/views/'.$content_view;
    ?>
    <!-- FOOTER -->
</body>
</html>