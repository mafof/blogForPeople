<?php
namespace App\Models;

use App\Core\BaseModel;
use App\Core\DB\PostDB;

class ModelProfileRemovePost extends BaseModel {
    public function get_data() {
        $postDB = new PostDB(true);
        $postDB->removePost($GLOBALS['idPost']);
        $postDB->closeDB();

        header('Location: '. $_SERVER['HTTP_REFERER']);
    }
}