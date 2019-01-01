<?php
namespace App\Models;

use App\Core\BaseModel;
use App\Core\DB\PostDB;

class ModelShowPost extends BaseModel {
    public function get_data() {
        if(!parent::isAuth()) return ['errors' => ['Вы не авторизованы, и не можете смотреть полный пост, пожалуйста авторизируйтесь, для комментирования и полного просмотра поста']];
        $postId = $GLOBALS['postId'];

        $postDb = new PostDB(true);
        $data = $postDb->getPost($postId);
        $postDb->closeDB();

        return array_merge($data, parent::getDataUser());
    }
}