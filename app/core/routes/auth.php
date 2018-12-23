<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::get('/login', function() {
   include_once "app/controllers/controller_login.php";
   (new App\Controllers\ControllerLogin())->action();
});

Router::match(['get', 'post'], '/register', function() {
    include_once "app/controllers/controller_register.php";
    (new App\Controllers\ControllerRegister())->action();
});