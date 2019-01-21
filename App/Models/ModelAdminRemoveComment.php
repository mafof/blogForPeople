<?php
namespace App\Models;

use \App\Core\BaseModel;
use App\Core\DB\PostDB;

class ModelAdminRemoveComment extends BaseModel {
    public function get_data() {
        if(parent::isAuth()) {
            $dataUser = parent::getDataUser();
            if($dataUser['userGroup'] != 0) header("Location: /");

            $postDB = new PostDB(true);
            $postDB->removeComment($GLOBALS['commentId']);
            $postDB->closeDB();

            header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            header("Location: /");
        }
    }
}