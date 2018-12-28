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

    public function getPosts($numberOfPosts, $offset = 0) {}
}