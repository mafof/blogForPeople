<?php
namespace App\Models\Admin;

use App\Core\BaseModel;
use App\Core\DB\PostDB;
use App\Core\DB\UserDB;

class ModelAdminMain extends BaseModel {
    private function getAllUsers() {
        $userDB = new UserDB(true);
        $usersList = $userDB->getUsers();
        $userDB->closeDB();

        return $usersList;
    }

    private function getAllComments() {
        $postDB = new PostDB(true);
        $commentsList = $postDB->getAllCommentsForAdmin();
        $postDB->closeDB();

        return $commentsList;
    }

    private function getAllPosts() {
        $postDB = new PostDB(true);
        $postsList = $postDB->getPosts();
        $postDB->closeDB();

        return $postsList;
    }

    public function get_data() {
        if(parent::isAuth()) {
            $dataUser = parent::getDataUser();
            if($dataUser['userGroup'] != 0) return array_merge(['errors' => ['Доступ запрещен']], $dataUser);

            $data = array();

            $data['users'] = $this->getAllUsers();
            $data['posts'] = $this->getAllPosts();
            $data['comments'] = $this->getAllComments();

            return array_merge($data, parent::getDataUser());
        } else {
            header("Location: /error404");
        }
    }
}