<?php

namespace App\Core\DB;

/**
 * Class UserDB - Используется для создания/удаления пользователей в системе
 * @package App\Core\DB
 */
class UserDB extends BaseDB {
    public function __construct($isConnecting = false) {
        parent::__construct($isConnecting);
    }

    private function getConvertBooleanToNumber($val) {
        if(is_bool($val)) {
            if ($val === true) return 1;
            else return 0;
        } else {
            return null;
        }
    }

    public function createUser($nickname, $email, $hashPassword, $group = 1, $isConfirm = false) {
        $date = new \DateTime();
        $time = $date->format('Y-m-d');
        return parent::sendSql(
            "INSERT INTO `users_info`(`nickname`, `email`, `password`, `userGroup`, `isConfirm`) VALUES (:nickname, :email, :password, :userGroup, :confirm)",
            [
                'nickname' => $nickname,
                'email' => $email,
                'password' => $hashPassword,
                'userGroup' => $group,
                'confirm' => $this->getConvertBooleanToNumber($isConfirm)
            ]
        );
    }

    public function getUser($id) {
        return parent::sendSqlAndGetData("SELECT * FROM `users_info` WHERE `id`=:id", ['id' => $id]);
    }

    public function removeUser($id) {}
}