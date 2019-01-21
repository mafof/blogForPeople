<?php
namespace App\Models\Profile;

use App\Core\BaseModel;
use App\Core\DB\PostDB;

class ModelProfileRemovePost extends BaseModel {
    public function get_data() {
        if(parent::isAuth()) {
            $postDB = new PostDB(true);

            $post = $postDB->getPost($GLOBALS['idPost']);

            if(isset($post)) {
                $authorPost = $post['author'];
                $dataUser = parent::getDataUser();

                if($dataUser['userGroup'] == 0 || $authorPost == $dataUser['nickname']) {
                    $postDB->removePost($GLOBALS['idPost']);
                }
            } else {
                $postDB->closeDB();
                header('Location: /');
            }

            $postDB->closeDB();
            $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/';
            header('Location: ' . $referer);
        } else {
            header('Location: /');
        }
    }
}