<?php
use Pecee\SimpleRouter\SimpleRouter as Router;

Router::match(['get', 'post'], '/createpost', function () {
    include_once "App/controllers/ControllerCreatePost.php";
    (new App\Controllers\ControllerCreatePost())->action();
});

Router::get('/profile/{profile}', function ($profile) {
    $GLOBALS['profileNickname'] = $profile;
    include_once "App/controllers/ControllerProfileMain.php";
    (new App\Controllers\ControllerProfileMain())->action();
});

Router::get('/removePost/{idPost}', function ($idPost) {
    $GLOBALS['idPost'] = $idPost;
    include_once "App/controllers/ControllerProfileRemovePost.php";
    (new App\Controllers\ControllerProfileRemovePost())->action();
});

Router::match(['get', 'post'], '/editPost/{idPost}', function ($idPost) {
    $GLOBALS['idPost'] = $idPost;
    include_once "App/controllers/ControllerProfileEditPost.php";
    (new App\Controllers\ControllerProfileEditPost())->action();
});