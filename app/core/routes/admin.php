<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::get('/admin', function() {
    include_once "app/controllers/controller_admin_main.php";
    (new App\Controllers\ControllerAdminMain())->action();
});

Router::get('/hiddenPost/{id}', function ($id) {
    $GLOBALS['postId'] = $id;
    include_once "app/controllers/controller_admin_hidden_post.php";
    (new App\Controllers\ControllerAdminHiddenPost())->action();
});

Router::get('/removeComment/{id}', function ($id) {
    $GLOBALS['commentId'] = $id;
    include_once "app/controllers/controller_admin_remove_comment.php";
    (new App\Controllers\ControllerAdminRemoveComment())->action();
});

Router::get('/removeUser/{id}', function ($id) {
    $GLOBALS['userId'] = $id;
    include_once "app/controllers/controller_admin_remove_user.php";
    (new App\Controllers\ControllerAdminRemoveUser())->action();
});

Router::get('/getAllGroups', function () {
    include_once "app/controllers/controller_admin_get_all_groups.php";
    (new App\Controllers\ControllerAdminGetAllGroups())->action();
});

Router::get('/setUserGroup/{idGroup}/{userId}', function($idGroup, $userId) {
    $GLOBALS['idGroup'] = $idGroup;
    $GLOBALS['userId'] = $userId;
    include_once "app/controllers/controller_admin_set_user_group.php";
    (new App\Controllers\ControllerAdminSetUserGroup())->action();
});