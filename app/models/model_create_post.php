<?php
namespace App\Models;

use App\Core\BaseModel;
use App\Core\DB\PostDB;
use App\Core\DB\UserDB;
use App\Core\TransformSpecialTags;

class ModelCreatePost extends BaseModel {
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

    private function checkData() {
        $title        = trim(strip_tags($_POST['title']));
        $prevText     = trim(strip_tags($_POST['prev-text']));
        $text         = trim(strip_tags($_POST['text']));
        $categoryName = trim(strip_tags($_POST['category-name']));
        $author = (new UserDB(true))->getUser($_SESSION['id'])['nickname'];

        if(empty($title) || empty($prevText) || empty($text) || empty($categoryName)) return ['errors' => ['Данные не валидны']];

        $data = [
            'title' => $title,
            'prevText' => $prevText,
            'text' => $text,
            'categoryName' => $categoryName,
            'author' => $author
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

    public function get_data() {
        if(!parent::isAuth()) header('Location: /'); // Если не авторизирован

        if($_SERVER['REQUEST_METHOD'] != 'POST') {
            $userData = parent::getDataUser();
            if($userData['isConfirm'] == 0) return array_merge(['errors' => ['Для того что бы писать посты, нужно подтвердить аккаунт']], ['criticalError' => true], $userData);

            return $userData;
        } else {
            $result = $this->checkData();

            if(!empty($result['errors'])) {
                return $result;
            } else {
                $fileName = $this->checkFileAndGetUnicalName();

                if($fileName === false) {
                    return array_merge(['errors' => ['Вложенная картинка не загрузилась, попробуйте снова']], $result);
                } else {
                    $postDB = new PostDB(true);
                    $resSQL = $postDB->createPost($result['author'], $result['title'], $result['prevText'], $result['text'], $result['categoryName'], $fileName);
                    if($resSQL) {
                        header('Location: /');
                    } else {
                        return array_merge(['errors' => ['Ошибка публикации поста, попробуйте снова']], $result);
                    }
                }
            }
        }
    }
}