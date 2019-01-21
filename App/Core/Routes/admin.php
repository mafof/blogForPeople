<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::get('/admin', function() {
    include_once "App/controllers/ControllerAdminMain.php";
    (new App\Controllers\ControllerAdminMain())->action();
});

Router::get('/hiddenPost/{id}', function ($id) {
    $GLOBALS['postId'] = $id;
    include_once "App/controllers/ControllerAdminHiddenPost.php";
    (new App\Controllers\ControllerAdminHiddenPost())->action();
});

Router::get('/removeComment/{id}', function ($id) {
    $GLOBALS['commentId'] = $id;
    include_once "App/controllers/ControllerAdminRemoveComment.php";
    (new App\Controllers\ControllerAdminRemoveComment())->action();
});

Router::get('/removeUser/{id}', function ($id) {
    $GLOBALS['userId'] = $id;
    include_once "App/controllers/ControllerAdminRemoveUser.php";
    (new App\Controllers\ControllerAdminRemoveUser())->action();
});

Router::get('/getAllGroups', function () {
    include_once "App/controllers/ControllerAdminGetAllGroups.php";
    (new App\Controllers\ControllerAdminGetAllGroups())->action();
});

Router::get('/setUserGroup/{idGroup}/{userId}', function($idGroup, $userId) {
    $GLOBALS['idGroup'] = $idGroup;
    $GLOBALS['userId'] = $userId;
    include_once "App/controllers/ControllerAdminSetUserGroup.php";
    (new App\Controllers\ControllerAdminSetUserGroup())->action();
});