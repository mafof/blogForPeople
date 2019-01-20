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

Router::get('/category/{categoryName}', function($categoryName) {
    $GLOBALS['categoryName'] = $categoryName;
    include_once "app/controllers/controller_show_post_category.php";
    (new App\Controllers\ControllerShowPostToCategory())->action();
});

Router::post('/sendComment', function () {
    include_once "app/controllers/controller_show_post.php";
    (new App\Controllers\ControllerShowPost())->action();
});

Router::get('/confirmAccount/{uniqueId}', function ($uniqueId) {
    $GLOBALS['uniqueId'] = $uniqueId;
    include_once "app/controllers/controller_confirm_account.php";
    (new App\Controllers\ControllerConfirmAccount())->action();
});

Router::error(function(\Pecee\Http\Request $request, \Exception $exception) {

    if($exception instanceof \Pecee\SimpleRouter\Exceptions\NotFoundHttpException && $exception->getCode() === 404) {
        include_once "app/controllers/controller_error_404.php";
        (new \App\Controllers\ControllerError404())->action();
        die();
    } else {
        echo $exception->getMessage();
    }
});