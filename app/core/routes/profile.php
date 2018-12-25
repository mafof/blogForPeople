<?php
use Pecee\SimpleRouter\SimpleRouter as Router;

Router::match(['get', 'post'], '/createpost', function () {
    include_once "app/controllers/controller_create_post.php";
    (new App\Controllers\ControllerCreatePost())->action();
});