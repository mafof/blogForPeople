<?php
use Pecee\SimpleRouter\SimpleRouter as Router;

Router::match(['get', 'post'], '/createpost', function () {
    (new App\Controllers\ControllerCreatePost())->action();
});

Router::get('/profile/{profile}', function ($profile) {
    $GLOBALS['profileNickname'] = $profile;
    (new App\Controllers\Profile\ControllerProfileMain())->action();
});

Router::get('/removePost/{idPost}', function ($idPost) {
    $GLOBALS['idPost'] = $idPost;
    (new App\Controllers\Profile\ControllerProfileRemovePost())->action();
});

Router::match(['get', 'post'], '/editPost/{idPost}', function ($idPost) {
    $GLOBALS['idPost'] = $idPost;
    (new App\Controllers\Profile\ControllerProfileEditPost())->action();
});