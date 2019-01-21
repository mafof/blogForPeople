<?php
namespace App\Models;

use App\Core\BaseModel;
use App\Core\DB\PostDB;
use App\Core\TranslateConverterCyrillic;

class ModelShowPostToCategory extends BaseModel {
    public function get_data() {
        $postDb = new PostDB(true);
        $data = $postDb->getPostsToCategory(TranslateConverterCyrillic::translateToRussian($GLOBALS['categoryName']));
        if(empty($data)) $data = $postDb->getPostsToCategory($GLOBALS['categoryName']);

        $userData = parent::getDataUser();
        $userData = ($userData == null) ? [] : $userData;

        return array_merge(['posts' => $data], $userData);
    }
}