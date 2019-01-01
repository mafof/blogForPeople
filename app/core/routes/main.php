<?php
/**
 * Основные маршруты в системе
 */

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::get('/', function() {
    include_once "app/controllers/controller_main.php";
    (new App\Controllers\ControllerMain())->action();
});

Router::get('/about', function() {
    include_once "app/controllers/controller_about.php";
    (new App\Controllers\ControllerAbout())->action();
});

Router::get('/post/{id}', function ($id) {
    $GLOBALS['postId'] = $id;
    include_once "app/controllers/controller_show_post.php";
    (new App\Controllers\ControllerShowPost())->action();
});

Router::post('/sendComment', function () {
    include_once "app/controllers/controller_show_post.php";
    (new App\Controllers\ControllerShowPost())->action();
});

Router::error(function() {
    include_once "app/controllers/controller_error_404.php";
    (new \App\Controllers\ControllerError404())->action();
    exit(); // хак что бы не было ошибки при 404
});