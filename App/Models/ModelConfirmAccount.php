<?php
namespace App\Models;

use App\Core\BaseModel;
use App\Core\DB\UserDB;

class ModelConfirmAccount extends BaseModel {
    public function get_data() {
        if(parent::isAuth()) {
            $userData = parent::getDataUser();
            if(is_null($userData)) header("Location: /");
            if($userData['isConfirm'] == 1) return ['errors' => ['Вы уже подтвердили аккаунт']];

            $userDB = new UserDB(true);
            $tempLink = $userDB->getTempLink($userData['nickname']);

            if(!empty($tempLink)) {
                $tempLink = $tempLink[0]['urn'];

                if($tempLink == $GLOBALS['uniqueId']) {
                    $userDB->removeConfirmUrn($userData['nickname']);
                    $userDB->updateConfirmUser($userData['nickname']);
                    $userDB->closeDB();
                    return ['errors' => ['Вы успешно подтвердили аккаунт, вернитесь на главную страницу']];
                } else {
                    $userDB->closeDB();
                    return ['errors' => ['Ошибка ссылки, повторите снова']];
                }
            } else {
                return ['errors' => ['Упс, что то пошло не так, обратитесь к администратору']];
            }
        }
    }
}