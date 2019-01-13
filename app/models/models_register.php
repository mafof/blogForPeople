<?php
namespace App\Models;

use App\Core\BaseModel;
use App\Core\DB\UserDB;
use App\Core\Mail;

class ModelRegister extends BaseModel {

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
        $nickname = trim($_POST['nickname']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        if(empty($nickname) || empty($email) || empty($password)) return ["errors" => ["Некорректны введенные данные"]]; // Проверка на пустоту

        $nickname = htmlspecialchars($nickname);
        $email = htmlspecialchars($email);
        $password = htmlspecialchars($password);

        if($this->checkStringToRussianLaungage($nickname) ||
           $this->checkStringToRussianLaungage($email) ||
           $this->checkStringToRussianLaungage($password) ||
           $this->checkFirstSymbolToNumber($nickname[0]) ||
           strlen($nickname) > 50 ||
           strlen($password) < 8)
        {
            return ["errors" => ["Некорректны введенные данные"]];
        }

        return [
            'nickname' => $nickname,
            'email' => $email,
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

                if(!empty($db->getIdByNickname($result['nickname'])) || !empty($db->getIdByEmail($result['email']))) return ['errors' => ['Данный аккаунт уже зарегестрирован']];

                $resultRequest = $db->createUser($result['nickname'], $result['email'], password_hash($result['password'], PASSWORD_DEFAULT));

                if($resultRequest) {
                    $_SESSION['id'] = ($db->getIdByNickname($result['nickname']))['id'];

                    $tempLink = uniqid();
                    $db->createTempLink($result['nickname'], $tempLink);
                    $mail = new Mail();
                    $mail->sendEmail($result['email'], $result['nickname'], "Confirm account", "For confirm account follow the link ".$_SERVER['HTTP_HOST'] . "/confirmAccount/" . $tempLink);

                    $db->closeDB();
                    header('Location: /');
                } else {
                    $db->closeDB();
                    return ['errors' => ['Упс, что то пошло не так, попробуйте еще раз']];
                }
            }
        }
    }
}