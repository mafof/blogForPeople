<?php

namespace App\Core\DB;

class PostDB extends BaseDB {
    public function __construct($isConnecting = false) {
        parent::__construct($isConnecting);
    }

    public function createPost($author, $title, $prevText, $text, $categoryName, $inputImageFileName = null) {
        $time = new \DateTime();
        $formatTime = $time->format("Y-m-d");
        return parent::sendSql('INSERT INTO `posts_info`(`author`, `title`, `prevImage`, `prevText`, `text`, `categoryName`, `dateCreate`) VALUES (:author, :title, :prevImg, :prevText, :text, :categoryName, :dateCreate)',
            [
                'title' => $title,
                'prevImg' => ($inputImageFileName !== null) ? $inputImageFileName : "",
                'prevText' => $prevText,
                'text' => $text,
                'categoryName' => $categoryName,
                'dateCreate' => $formatTime,
                'author' => $author
            ]
        );
    }

    public function getPosts($numberOfPosts, $offset = 0) {
        // Костыль для того что бы работали инструкции LIMIT и OFFSET =>
        parent::getInstanceDB()->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
        $result = parent::sendSqlAndGetData("SELECT * FROM `posts_info` LIMIT ? OFFSET ?", [$numberOfPosts, $offset]);
        parent::getInstanceDB()->setAttribute(\PDO::ATTR_EMULATE_PREPARES, true);

        return $result;
    }

    public function getPostsToCategory($categoryName) {
        return parent::sendSqlAndGetData("SELECT * FROM `posts_info` WHERE `categoryName`=:categoryName", ['categoryName' => $categoryName]);
    }

    public function getPost($id) {
        return parent::sendSqlAndGetData("SELECT * FROM `posts_info` WHERE `id`= :id", ['id' => $id])[0];
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

    public function getAllCategorySortForPopular() {
        return parent::sendSqlAndGetData('SELECT DISTINCT `categoryName` FROM `posts_info` ORDER BY `categoryName` DESC');
    }
}