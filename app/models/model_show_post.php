<?php
namespace App\Models;

use App\Core\BaseModel;
use App\Core\DB\PostDB;

class ModelShowPost extends BaseModel {

    private function getDataPost($postId) {
        $postDb = new PostDB(true);
        $data = $postDb->getPost($postId);
        $postDb->closeDB();
        return $data;
    }

    private function getIdPostAtRequestMethodPost() {
        if(empty($_SERVER['HTTP_REFERER']) || $_SERVER['REQUEST_METHOD'] != 'POST') return null;

        $arrayUri = explode("/", $_SERVER['HTTP_REFERER']);
        $postId = $arrayUri[count($arrayUri)-1];

        return is_numeric($postId) ? $postId : null;
    }

    private function checkData() {
        if(($postId = $this->getIdPostAtRequestMethodPost()) == null) return false;
        $textComment = trim(htmlspecialchars($_POST['message']));

        if(empty($textComment)) return false;

        return [
            'postId' => $postId,
            'messageComment' => $textComment
        ];
    }

    public function get_data() {
        if(!parent::isAuth()) return ['errors' => ['Вы не авторизованы, и не можете смотреть полный пост, пожалуйста авторизируйтесь, для комментирования и полного просмотра поста']];
        if(!empty($GLOBALS['postId'])) $postId = $GLOBALS['postId'];

        if($_SERVER['REQUEST_METHOD'] != 'POST') {
            $postDb = new PostDB(true);
            $listComments = $postDb->getComments($postId);

            return array_merge($this->getDataPost($postId), parent::getDataUser(), ['comments' => $listComments]);
        } else {
            $result = $this->checkData();

            if(is_array($result)) {
                $postDb = new PostDB(true);
                $postDb->createComment(parent::getDataUser()['nickname'], $result['messageComment'], $result['postId']);
                $postDb->closeDB();

                header('Location: '. $_SERVER['HTTP_REFERER']);
            } else {
                if(($postId = $this->getIdPostAtRequestMethodPost()) == null) header('Location: /');

                return array_merge(['errors' => ['Данные введены не корректно']], $this->getDataPost($postId), parent::getDataUser());
            }
        }
    }
}