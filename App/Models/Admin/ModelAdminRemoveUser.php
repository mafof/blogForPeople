<?php
namespace App\Models\Admin;

use App\Core\BaseModel;
use App\Core\DB\UserDB;

class ModelAdminRemoveUser extends BaseModel {
    public function get_data() {
        if(parent::isAuth()) {
            $dataUser = parent::getDataUser();
            if($dataUser['userGroup'] != 0) header("Location: /");

            $userDB = new UserDB(true);
            $userDB->removeUser($GLOBALS['userId']);
            $userDB->closeDB();

            header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            header("Location: /");
        }
    }
}