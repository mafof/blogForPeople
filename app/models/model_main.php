<?php
namespace App\Models;

use App\Core\BaseModel;
use App\Core\DB\PostDB;

class ModelMain extends BaseModel {
    public function get_data() {
        $dataUser = array();
        if(parent::isAuth()) $dataUser = parent::getDataUser();

        $postDB = new PostDB(true);
        $listPosts = $postDB->getPosts(10, 0);
        $popularCategorys = $postDB->getAllCategorySortForPopular();
        $postDB->closeDB();

        if(!empty($listPosts)) {
            return array_merge($dataUser, ['posts' => $listPosts, 'categories' => $popularCategorys]);
        } else {
            return $dataUser;
        }
    }
}