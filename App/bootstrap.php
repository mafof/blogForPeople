<?php
/** Иницилизирует загрузку приложения подключая все необходимые файлы */
require_once __DIR__.'/../vendor/autoload.php';

// Подключаем конфигурационный файл и файлы БД =>
require_once "Core/config.php";

// Подключаем роуты =>
require_once "Core/Routes/main.php";
require_once "Core/Routes/auth.php";
require_once "Core/Routes/profile.php";
require_once "Core/Routes/admin.php";

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::start();