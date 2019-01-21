<?php
namespace App\Models\Admin;

use App\Core\BaseModel;
use App\Core\DB\UserDB;

class ModelAdminGetAllGroups extends BaseModel {
    public function get_data() {
        if(parent::isAuth()) {
            $dataUser = parent::getDataUser();
            if($dataUser['userGroup'] != 0) return "access closed";

            $userDB = new UserDB(true);
            $res = $userDB->getAllGroups();
            $userDB->closeDB();
            return $res;
        }
    }
}