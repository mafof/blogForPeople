<?php
/**
 * Основные маршруты в системе
 */

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::get('/', function() {
    (new App\Controllers\ControllerMain())->action();
});

Router::get('/about', function() {
    (new App\Controllers\ControllerAbout())->action();
});

Router::get('/post/{id}', function ($id) {
    $GLOBALS['postId'] = $id;
    (new App\Controllers\ControllerShowPost())->action();
});

Router::get('/category/{categoryName}', function($categoryName) {
    $GLOBALS['categoryName'] = $categoryName;
    (new App\Controllers\ControllerShowPostToCategory())->action();
});

Router::post('/sendComment', function () {
    (new App\Controllers\ControllerShowPost())->action();
});

Router::get('/confirmAccount/{uniqueId}', function ($uniqueId) {
    $GLOBALS['uniqueId'] = $uniqueId;
    (new App\Controllers\ControllerConfirmAccount())->action();
});

Router::error(function(\Pecee\Http\Request $request, \Exception $exception) {

    if($exception instanceof \Pecee\SimpleRouter\Exceptions\NotFoundHttpException && $exception->getCode() === 404) {
        (new \App\Controllers\ControllerPageNotFound())->action();
        die();
    } else {
        echo $exception->getMessage();
    }
});