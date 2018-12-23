<?php
namespace App\Core;

use App\Core\DB\UserDB;

class BaseModel {

    public function get_data() {}

    public function isAuth() {
        return !empty($_SESSION['id']);
    }

    public function getDataUser() {
        if($this->isAuth()) {
            $db = new UserDB(true);
            $dataUser = $db->getUser($_SESSION['id']);
            $db->closeDB();
            return $dataUser;
        }
        return null;
    }
}
?>