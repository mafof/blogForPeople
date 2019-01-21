<?php
namespace App\Models\Admin;

use App\Core\BaseModel;
use App\Core\DB\PostDB;

class ModelAdminHiddenPost extends BaseModel {
    public function get_data() {
        if(parent::isAuth()) {
            $dataUser = parent::getDataUser();
            if($dataUser['userGroup'] != 0) header("Location: /");

            $postDB = new PostDB(true);
            $res = $postDB->updateHiddenPost($GLOBALS['postId']);

            header("Location: ". $_SERVER['HTTP_REFERER']);
        } else {
            header("Location: /");
        }
    }
}