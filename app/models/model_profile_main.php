<?php
namespace App\Models;

use App\Core\BaseModel;

class ModelProfileMain extends BaseModel {
    public function get_data() {
        return parent::getDataUser();
    }
}