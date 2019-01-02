<?php
namespace App\Models;

use App\Core\BaseModel;
use App\Core\DB\PostDB;
use App\Core\TranslateConverterCirricle;

class ModelShowPostToCategory extends BaseModel {
    public function get_data() {
        $postDb = new PostDB(true);
        $data = $postDb->getPostsToCategory(TranslateConverterCirricle::translateToRussian($GLOBALS['categoryName']));
        return array_merge(['posts' => $data], parent::getDataUser());
    }
}