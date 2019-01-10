<?php
namespace App\Models;

use App\Core\BaseModel;
use App\Core\TransformSpecialTags;

class ModelProfileEditPost extends BaseModel {
    public function get_data() {
        if($_SERVER['REQUEST_METHOD'] != 'POST') {
            return parent::getDataUser();
        } else {
            return null;
        }
    }
}
