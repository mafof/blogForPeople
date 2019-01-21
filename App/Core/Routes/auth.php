<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::match(['get', 'post'], '/login', function() {
   include_once "App/controllers/ControllerLogin.php";
   (new App\Controllers\ControllerLogin())->action();
});

Router::match(['get', 'post'], '/register', function() {
    include_once "App/controllers/ControllerRegister.php";
    (new App\Controllers\ControllerRegister())->action();
});

Router::get('/logout', function () {
   session_destroy();
   setcookie('PHPSESSID', null);
   header('Location: /');
});