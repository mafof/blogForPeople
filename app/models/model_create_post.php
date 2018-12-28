<?php
namespace App\Models;

use App\Core\BaseModel;
use App\Core\DB\PostDB;
use App\Core\DB\UserDB;

class ModelCreatePost extends BaseModel {

    private function getUrlImage($text, $tagsImage) {
        if(empty($tagsImage)) return $text;
        $offset = 0;
        $resultString = '';

        foreach ($tagsImage as $key => $item) {
            $url = explode('=', $tagsImage[$key][0])[1];
            $url = substr($url, 0, strlen($url)-1);

            $resultString .= substr($text, $offset, $tagsImage[$key][1] - $offset) . "<img src='". $url ."'>";
            $offset += $tagsImage[$key][1] + strlen($tagsImage[$key][0]);
        }

        return $resultString;
    }

    private function transformSpecialTags($text) {
        $text = preg_replace(['/(\[b\])/', '/(\[\/b\])/'], ['<b>', '</b>'], $text);
        $text = preg_replace(['/(\[s\])/', '/(\[\/s\])/'], ['<s>', '</s>'], $text);
        $text = preg_replace(['/(\[h\])/', '/(\[\/h\])/'], ['<div class="spoiler">', '</div>'], $text);

        preg_match_all('/\[inpImg=[a-zA-Zа-яА-Я0-9:\/.]+\]/', $text, $resultTagImage, PREG_OFFSET_CAPTURE);
        $text = $this->getUrlImage($text, $resultTagImage[0]);

        return $text;
    }

    private function checkFileAndGetUnicalName() {
        if(empty($_FILES['photo']['size'])) return true;

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

        if(strlen($title) > 50) {
            return array_merge(['errors' => ['Длина заголовка не может быть больше 50 символов']], $data);
        } else if (strlen($prevText) > 255) {
            return array_merge(['errors' => ['Длина предпросмотренного текста не должна превышать 255 символов']], $data);
        }

        $data['prevText'] = $this->transformSpecialTags($prevText);
        $data['text'] = $this->transformSpecialTags($text);
        return $data;
    }

    public function get_data() {
        if(!parent::isAuth()) header('Location: /'); // Если не авторизирован

        if($_SERVER['REQUEST_METHOD'] != 'POST') {
            return parent::getDataUser();
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