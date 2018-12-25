<?php
namespace App\Models;

use App\Core\BaseModel;

class ModelCreatePost extends BaseModel {

    private function checkData() {

    }

    public function get_data() {
        if(!parent::isAuth()) header('Location: /'); // Если не авторизирован

        if($_SERVER['REQUEST_METHOD'] != 'POST') {
            return parent::getDataUser();
        } else {
            $result = $this->checkData();

            if(!empty($result['errors'])) {
                return $result;
            } else {
                header('Location: /');
            }
        }
    }
}