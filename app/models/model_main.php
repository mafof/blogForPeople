<?php
namespace App\Models;

use App\Core\BaseModel;
use App\Core\DB\PostDB;

class ModelMain extends BaseModel {
    public function get_data() {
        if(parent::isAuth()) {
            $postDB = new PostDB(true);
            $listPosts = $postDB->getPosts(10, 0);
            $postDB->closeDB();

            if(!empty($listPosts)) {
                return array_merge(parent::getDataUser(), ['posts' => $listPosts]);
            } else {
                return parent::getDataUser();
            }
        }
    }
}