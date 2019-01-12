<?php

namespace App\Core\DB;

class PostDB extends BaseDB {
    public function __construct($isConnecting = false) {
        parent::__construct($isConnecting);
    }

    public function createPost($author, $title, $prevText, $text, $categoryName, $inputImageFileName = "") {
        $time = new \DateTime();
        $formatTime = $time->format("Y-m-d");
        return parent::sendSql('INSERT INTO `posts_info`(`author`, `title`, `prevImage`, `prevText`, `text`, `categoryName`, `dateCreate`, `isShow`) VALUES (:author, :title, :prevImg, :prevText, :text, :categoryName, :dateCreate, :isShow)',
            [
                'title' => $title,
                'prevImg' => $inputImageFileName,
                'prevText' => $prevText,
                'text' => $text,
                'categoryName' => $categoryName,
                'dateCreate' => $formatTime,
                'author' => $author,
                'isShow' => 1
            ]
        );
    }

    public function getPostsLimit($numberOfPosts, $offset = 0) {
        // Костыль для того что бы работали инструкции LIMIT и OFFSET =>
        parent::getInstanceDB()->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
        $result = parent::sendSqlAndGetData("SELECT * FROM `posts_info` LIMIT ? OFFSET ?", [$numberOfPosts, $offset]);
        parent::getInstanceDB()->setAttribute(\PDO::ATTR_EMULATE_PREPARES, true);

        return $result;
    }

    public function getPosts() {
        return parent::sendSqlAndGetData("SELECT * FROM `posts_info`");
    }

    public function getPostsByUserNickname($userNickname) {
        return parent::sendSqlAndGetData("SELECT * FROM `posts_info` WHERE `author`=:author", ['author' => $userNickname]);
    }

    public function getPostsToCategory($categoryName) {
        return parent::sendSqlAndGetData("SELECT * FROM `posts_info` WHERE `categoryName`=:categoryName", ['categoryName' => $categoryName]);
    }

    public function getPost($id) {
        $data = parent::sendSqlAndGetData("SELECT * FROM `posts_info` WHERE `id`= :id", ['id' => $id]);
        return empty($data) ? null : $data[0];
    }

    public function removePost($id) {
        $postPrevImg = $this->getPost($id)['prevImage'];
        if(!empty($postPrevImg)) {
            unlink('upload/'.$postPrevImg);
        }
        $result = parent::sendSql("DELETE FROM `posts_info` WHERE `id`=:id", ['id' => $id]);
        return $result;
    }

    public function updatePost($id, $title, $prevText, $text, $categoryName, $prevImg = null) {
        $result = false;

        parent::getInstanceDB()->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);

        if(is_null($prevImg)) {
            $result = parent::sendSql("UPDATE `posts_info` SET `title`=:title, `prevText`=:prevText, `text`=:text, `categoryName`=:categoryName WHERE `id`=:id",
                [
                    'id' => $id,
                    'title' => $title,
                    'prevText'=> $prevText,
                    'text'=> $text,
                    'categoryName' => $categoryName
                ]);
        } else {
            $postPrevImg = $this->getPost($id)['prevImage'];
            if(!empty($postPrevImg)) {
                unlink('upload/'.$postPrevImg);
            }

            $result = parent::sendSql("UPDATE `posts_info` SET `title`=:title, `prevText`=:prevText, `text`=:text, `categoryName`=:categoryName, `prevImage`=:prevImg WHERE `id`=:id",
                [
                    'id' => $id,
                    'title' => $title,
                    'prevText'=> $prevText,
                    'text'=> $text,
                    'categoryName' => $categoryName,
                    'prevImg' => $prevImg
                ]);
        }

        parent::getInstanceDB()->setAttribute(\PDO::ATTR_EMULATE_PREPARES, true);

        return $result;
    }

    public function updateHiddenPost($postId) {
        $post = $this->getPost($postId);

        if(isset($post)) {
            $isShow = $post['isShow'];
            $isShow = ($isShow == true || $isShow == 1) ? 0 : 1;

            return parent::sendSql("UPDATE `posts_info` SET `isShow`=:isShow WHERE `id`=:id", ['isShow' => $isShow, 'id' => $postId]);
        }
        return false;
    }

    public function createComment($author, $text, $postId) {
        $time = new \DateTime();
        $formatTime = $time->format("Y-m-d");

        return parent::sendSql('INSERT INTO `comments_info`(`idPost`, `author`, `text`, `dateCreate`) VALUES(:idPost, :author, :text, :dateCreate)', [
            'idPost' => $postId,
            'author' => $author,
            'text' => $text,
            'dateCreate' => $formatTime
        ]);
    }

    public function getComments($postId) {
        return parent::sendSqlAndGetData('SELECT * FROM `comments_info` WHERE `idPost`=:idPost', [
            'idPost' => $postId
        ]);
    }

    public function getAllCommentsForAdmin() {
        return parent::sendSqlAndGetData("SELECT `comments_info`.`id`, `comments_info`.`author`, `comments_info`.`text`, `comments_info`.`dateCreate`, `comments_info`.`idPost`, `posts_info`.`title` FROM `comments_info` LEFT JOIN `posts_info` ON `comments_info`.`idPost` = `posts_info`.`id`");
    }

    public function getCommentsForProfilePageByUserNickname($userNickname) {
        $sql = <<<EOT
            SELECT `title`, `comments_info`.`text`, `comments_info`.`dateCreate`, `comments_info`.`idPost`
            FROM `comments_info`
            INNER JOIN `posts_info`
            ON `comments_info`.`idPost` = `posts_info`.`id`
            WHERE `comments_info`.`author`=:author
EOT;
        return parent::sendSqlAndGetData($sql, ['author' => $userNickname]);
    }

    public function removeComment($idComment) {
        return parent::sendSql("DELETE FROM `comments_info` WHERE `id`=:id", ['id' => $idComment]);
    }

    public function getAllCategorySortForPopular() {
        return parent::sendSqlAndGetData('SELECT DISTINCT `categoryName` FROM `posts_info` ORDER BY `categoryName` DESC');
    }
}