<?php
/** Иницилизирует загрузку приложения подключая все необходимые файлы */
require_once __DIR__.'/../vendor/autoload.php';
require_once "core/model.php";
require_once "core/controller.php";
require_once "core/view.php";
require_once "core/translate_convertor_cirillic.php";
require_once "core/transform_special_tags.php";

// Подключаем конфигурационный файл и файлы БД =>
require_once "core/config.php";
require_once "core/DB/base_db.php";
require_once "core/DB/user_db.php";
require_once "core/DB/post_db.php";
require_once "core/email.php";

// Подключаем роуты =>
require_once "core/routes/main.php";
require_once "core/routes/auth.php";
require_once "core/routes/profile.php";
require_once "core/routes/admin.php";

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::start();