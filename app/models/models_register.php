<?php
namespace App\Models;

use App\Core\BaseModel;

class ModelRegister extends BaseModel {
    private function checkData() {
        return true;
    }

    public function get_data() {
        if($_SERVER['REQUEST_METHOD'] != 'POST') {
            return null;
        } else {
            $this->checkData();
            header('Location: /');
        }
    }
}