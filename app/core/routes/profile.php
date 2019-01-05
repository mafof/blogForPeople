<?php
use Pecee\SimpleRouter\SimpleRouter as Router;

Router::match(['get', 'post'], '/createpost', function () {
    include_once "app/controllers/controller_create_post.php";
    (new App\Controllers\ControllerCreatePost())->action();
});

Router::get('/profile/{profile}', function ($profile) {
    include_once "app/controllers/controller_profile_main.php";
    (new App\Controllers\ControllerProfileMain())->action();
});