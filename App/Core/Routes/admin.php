<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::get('/admin', function() {
    (new App\Controllers\Admin\ControllerAdminMain())->action();
});

Router::get('/hiddenPost/{id}', function ($id) {
    $GLOBALS['postId'] = $id;
    (new App\Controllers\Admin\ControllerAdminHiddenPost())->action();
});

Router::get('/removeComment/{id}', function ($id) {
    $GLOBALS['commentId'] = $id;
    (new App\Controllers\Admin\ControllerAdminRemoveComment())->action();
});

Router::get('/removeUser/{id}', function ($id) {
    $GLOBALS['userId'] = $id;
    (new App\Controllers\Admin\ControllerAdminRemoveUser())->action();
});

Router::get('/getAllGroups', function () {
    (new App\Controllers\Admin\ControllerAdminGetAllGroups())->action();
});

Router::get('/setUserGroup/{idGroup}/{userId}', function($idGroup, $userId) {
    $GLOBALS['idGroup'] = $idGroup;
    $GLOBALS['userId'] = $userId;
    (new App\Controllers\Admin\ControllerAdminSetUserGroup())->action();
});