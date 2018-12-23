<?php

namespace App\Models;


use App\Core\BaseModel;
use App\Core\DB\UserDB;

class ModelLogin extends BaseModel {
    private function checkStringToRussianLaungage($val) {
        preg_match_all('/[а-яА-Я\s]/m', $val, $matches, PREG_SET_ORDER, 0);
        return !empty($matches);
    }

    private function checkFirstSymbolToNumber($firstVal) {
        preg_match_all('/[0-9]/m', $firstVal, $matches, PREG_SET_ORDER, 0);
        return !empty($matches);
    }

    /**
     * Метод проверяет входные данные и возвращает результат
     * @return array либо с ошибками, либо с данными
     */
    private function checkData() {
        $login = trim($_POST['nickname']);
        $password = trim($_POST['password']);

        if(empty($login) || empty($password)) return ["errors" => ["Некорректны введенные данные"]]; // Проверка на пустоту

        $login = htmlspecialchars($login);
        $password = htmlspecialchars($password);

        if($this->checkStringToRussianLaungage($login) ||
           $this->checkFirstSymbolToNumber($login[0]))
        {
            return ["errors" => ["Некорректный ник"]];
        }
        return [
            'login' => $login,
            'password' => $password
        ];
    }

    public function get_data() {
        if(parent::isAuth()) header('Location: /'); // Если авторизирован, то перенаправляет на главную старницу

        if($_SERVER['REQUEST_METHOD'] != 'POST') {
            return null;
        } else {
            $result = $this->checkData();

            if(!empty($result['errors'])) {
                return $result;
            } else {
                $db = new UserDB(true);

                $idUser = $db->getIdByNickname($result['login']);

                if(!empty($idUser)) {
                    $user = $db->getUser($idUser['id']);
                    $db->closeDB();

                    if(password_verify($_POST['password'], $user['password'])) {
                        $_SESSION['id'] = $idUser['id'];
                        header('Location: /');
                    } else {
                        return ['errors' => ['Не верный пароль']];
                    }
                } else {
                    $db->closeDB();
                    return ['errors' => ['Данный пользователь не зарегистрирован']];
                }
            }
        }
    }
}