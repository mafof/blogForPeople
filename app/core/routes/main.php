<?php
/**
 * Основные маршруты в системе
 */

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::get('/', function() {
    include_once "app/controllers/controller_main.php";
    (new App\Controllers\ControllerMain())->action();
});

Router::error(function() {
    include_once "app/controllers/controller_error_404.php";
    (new \App\Controllers\ControllerError404())->action();
    exit(); // хак что бы не было ошибки
});