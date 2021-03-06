<?php
namespace App\Models;

use App\Core\BaseModel;
use App\Core\DB\PostDB;

class ModelShowPost extends BaseModel {

    private function getDataPost($postId) {
        $postDb = new PostDB(true);
        $data = $postDb->getPost($postId);
        $postDb->closeDB();

        if(isset($data)) {
            if($data['isShow'] == 0) {
                return null;
            }
        }

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
        if(!empty($GLOBALS['postId'])) $postId = $GLOBALS['postId'];

        if($_SERVER['REQUEST_METHOD'] != 'POST') {
            $postDb = new PostDB(true);
            $listComments = $postDb->getComments($postId);

            $userData = parent::getDataUser();
            $userData = ($userData === null) ? ['errors' => ['Что бы оставлять комментарии необходимо авторизоваться!']] : $userData;

            $dataPost = $this->getDataPost($postId);
            if(is_null($dataPost)) return array_merge(['errors' => ['Данного поста не существует']], $userData);
            if(!isset($userData['errors']) && $userData['isConfirm'] == 0) return array_merge(['errors' => ['Для того что бы оставлять комментарии необходимо подтвердить аккаунт']], $dataPost, $userData, ['comments' => $listComments]);

            return array_merge($dataPost, $userData, ['comments' => $listComments]);
        } else {
            if(!parent::isAuth()) header('Location: '. $_SERVER['HTTP_REFERER']);

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