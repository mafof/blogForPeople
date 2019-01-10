<?php
namespace App\Models;

use App\Core\BaseModel;
use App\Core\TransformSpecialTags;
use App\Core\DB\PostDB;

class ModelProfileEditPost extends BaseModel {
    private function checkData() {
        $title        = trim(strip_tags($_POST['title']));
        $prevText     = trim(strip_tags($_POST['prev-text']));
        $text         = trim(strip_tags($_POST['text']));
        $categoryName = trim(strip_tags($_POST['category-name']));

        if(empty($title) || empty($prevText) || empty($text) || empty($categoryName)) return ['errors' => ['Данные не валидны']];

        $data = [
            'title' => $title,
            'prevText' => $prevText,
            'text' => $text,
            'categoryName' => $categoryName,
        ];

        if(mb_strlen($title) > 50) {
            return array_merge(['errors' => ['Длина заголовка не может быть больше 50 символов']], $data);
        } else if (mb_strlen($prevText) > 255) {
            return array_merge(['errors' => ['Длина предпросмотренного текста не должна превышать 255 символов']], $data);
        }

        $data['prevText'] = TransformSpecialTags::transformSpecialTagsToHtmlTags($prevText);
        $data['text'] = TransformSpecialTags::transformSpecialTagsToHtmlTags($text);

        return $data;
    }

    private function checkFileAndGetUnicalName() {
        if(empty($_FILES['photo']['size'])) return "";

        $fileFormat = preg_split('/\//m', $_FILES['photo']['type'])[1];
        $fileName = uniqid();

        $result = move_uploaded_file($_FILES['photo']['tmp_name'], 'upload/' . $fileName . '.' . $fileFormat);

        if($result) {
            return $fileName . "." . $fileFormat;
        } else {
            return false;
        }
    }

    public function get_data() {
        if($_SERVER['REQUEST_METHOD'] != 'POST') {
            $postDB = new PostDB(true);
            $post = $postDB->getPost($GLOBALS['idPost']);
            $postDB->closeDB();
            $dataUser = parent::getDataUser();

            if($dataUser['userGroup'] != 0) { // Проверка на группу(админ или нет)
                if($post['author'] != $dataUser['nickname']) {
                    return array_merge(['errors' => ['Вы не можете редактировать данный пост']], $dataUser);
                }
            }


            $post['prevText'] = TransformSpecialTags::transformHtmlTagsToSpecialTags($post['prevText']);
            $post['text'] = TransformSpecialTags::transformHtmlTagsToSpecialTags($post['text']);

            return array_merge($post, $dataUser);
        } else {
            $inputData = $this->checkData();
            if(!empty($inputData['errors'])) header('Location: /');

            $postDB = new PostDB(true);
            $post = $postDB->getPost($GLOBALS['idPost']);
            $dataUser = parent::getDataUser();

            if($dataUser['userGroup'] != 0) { // Проверка на группу(админ или нет)
                if($post['author'] != $dataUser['nickname']) {
                    return array_merge(['errors' => ['Вы не можете редактировать данный пост']], $dataUser);
                }
            }

            $image = $this->checkFileAndGetUnicalName();

            if($image != false) {
                if(mb_strlen($image) >= 1) {
                    $postDB->updatePost($GLOBALS['idPost'], $inputData['title'], $inputData['prevText'], $inputData['text'], $inputData['categoryName'], $image);
                    $postDB->closeDB();
                    header('Location: /');
                }
            }

            $postDB->updatePost($GLOBALS['idPost'], $inputData['title'], $inputData['prevText'], $inputData['text'], $inputData['categoryName']);
            $postDB->closeDB();
            header('Location: /');
        }
    }
}
