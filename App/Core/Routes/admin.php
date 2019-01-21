<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::get('/admin', function() {
    (new App\Controllers\ControllerAdminMain())->action();
});

Router::get('/hiddenPost/{id}', function ($id) {
    $GLOBALS['postId'] = $id;
    (new App\Controllers\ControllerAdminHiddenPost())->action();
});

Router::get('/removeComment/{id}', function ($id) {
    $GLOBALS['commentId'] = $id;
    (new App\Controllers\ControllerAdminRemoveComment())->action();
});

Router::get('/removeUser/{id}', function ($id) {
    $GLOBALS['userId'] = $id;
    (new App\Controllers\ControllerAdminRemoveUser())->action();
});

Router::get('/getAllGroups', function () {
    (new App\Controllers\ControllerAdminGetAllGroups())->action();
});

Router::get('/setUserGroup/{idGroup}/{userId}', function($idGroup, $userId) {
    $GLOBALS['idGroup'] = $idGroup;
    $GLOBALS['userId'] = $userId;
    (new App\Controllers\ControllerAdminSetUserGroup())->action();
});