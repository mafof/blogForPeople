<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::match(['get', 'post'], '/login', function() {
   (new App\Controllers\ControllerLogin())->action();
});

Router::match(['get', 'post'], '/register', function() {
    (new App\Controllers\ControllerRegister())->action();
});

Router::get('/logout', function () {
   session_destroy();
   setcookie('PHPSESSID', null);
   header('Location: /');
});