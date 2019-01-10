<?php
use Pecee\SimpleRouter\SimpleRouter as Router;

Router::match(['get', 'post'], '/createpost', function () {
    include_once "app/controllers/controller_create_post.php";
    (new App\Controllers\ControllerCreatePost())->action();
});

Router::get('/profile/{profile}', function ($profile) {
    $GLOBALS['profileNickname'] = $profile;
    include_once "app/controllers/controller_profile_main.php";
    (new App\Controllers\ControllerProfileMain())->action();
});

Router::get('/removePost/{idPost}', function ($idPost) {
    $GLOBALS['idPost'] = $idPost;
    include_once "app/controllers/controller_profile_remove_post.php";
    (new App\Controllers\ControllerProfileRemovePost())->action();
});

Router::get('/editPost/{idPost}', function ($idPost) {
    $GLOBALS['idPost'] = $idPost;
    include_once "app/controllers/controller_profile_edit_post.php";
    (new App\Controllers\ControllerProfileEditPost())->action();
});