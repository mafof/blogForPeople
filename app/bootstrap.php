<?php
/** Иницилизирует загрузку приложения подключая все необходимые файлы */
require_once __DIR__.'/../vendor/autoload.php';
require_once "core/model.php";
require_once "core/controller.php";
require_once "core/view.php";

// Подключаем роуты =>
require_once "core/routes/main.php";
require_once "core/routes/auth.php";

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::start();