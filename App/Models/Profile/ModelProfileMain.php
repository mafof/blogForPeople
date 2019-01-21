<?php
namespace App\Models\Profile;

use App\Core\BaseModel;
use App\Core\DB\UserDB;
use App\Core\DB\PostDB;

class ModelProfileMain extends BaseModel {
    private function getPostsProfile() {
        $postDb = new PostDB(true);
        $postsList = $postDb->getPostsByUserNickname($GLOBALS['profileNickname']);
        $postDb->closeDB();
        return ['posts' => $postsList];
    }

    private function getCommentsProfile() {
        $postDb = new PostDB(true);
        $postsList = $postDb->getCommentsForProfilePageByUserNickname($GLOBALS['profileNickname']);
        $postDb->closeDB();
        return ['comments' => $postsList];
    }

    private function checkHaveUserAndGetProfileId() {
        $userDb = new UserDB(true);
        $result = $userDb->getIdByNickname($GLOBALS['profileNickname']);
        $userDb->closeDB();
        return !empty($result) ? $result['id'] : null;
    }

    public function get_data() {
        if(!parent::isAuth()) return ['errors' => ['Для просмотра профиля нужно быть авторизированным']];

        if(($profileUserId = $this->checkHaveUserAndGetProfileId()) === null) return ['errors' => ['Данного пользователя не существует']];

        $data = array();
        $data = array_merge($data, parent::getDataUser());
        $data = array_merge($data, $this->getPostsProfile());
        $data = array_merge($data, $this->getCommentsProfile());

        $data['isAuthor'] = $profileUserId == $data['id']; // Проверка является ли пользователь владельцом данного профиля
        $data['profileNickname'] = $GLOBALS['profileNickname'];
        return $data;
    }
}