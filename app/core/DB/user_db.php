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
        $res = parent::sendSqlAndGetData("SELECT * FROM `users_info` WHERE `id`=:id", ['id' => $id]);
        if(empty($res)) return [];
        else return $res[0];
    }

    public function getUsers() {
        return parent::sendSqlAndGetData("SELECT `users_info`.`id`, `nickname`, `email`, `groups_users_list`.`nameGroup`, `isConfirm` FROM `users_info` LEFT JOIN `groups_users_list` ON `users_info`.`userGroup` = `groups_users_list`.`unicalId`");
    }

    public function getIdByNickname($nickname) {
        $res = parent::sendSqlAndGetData("SELECT `id` FROM `users_info` WHERE `nickname`=:nick", ['nick' => $nickname]);
        if(empty($res)) return [];
        else return $res[0];
    }

    public function getIdByEmail($email) {
        $res = parent::sendSqlAndGetData("SELECT `id` FROM `users_info` WHERE `email`=:email", ['email' => $email]);
        if(empty($res)) return [];
        else return $res[0];
    }

    public function removeUser($id) {
        return parent::sendSql("DELETE FROM `users_info` WHERE `id`=:id", ['id' => $id]);
    }

    public function updateGroupUser($userId, $groupId) {
        return parent::sendSql("UPDATE `users_info` SET `userGroup`=:groupId WHERE `id`=:userId", ['groupId' => $groupId, 'userId' => $userId]);
    }

    public function updateConfirmUser($nickname) {
        return parent::sendSql("UPDATE `users_info` SET `isConfirm`='1' WHERE `nickname`=:nickname", ['nickname' => $nickname]);
    }

    public function getAllGroups() {
        return parent::sendSqlAndGetData("SELECT `unicalId`, `nameGroup` FROM `groups_users_list`");
    }

    public function createTempLink($nickname, $link) {
        return parent::sendSql("INSERT INTO `temp_urn_for_accept_account`(`nickname`, `urn`) VALUES (:nickname, :link)", ['nickname' => $nickname, 'link' => $link]);
    }

    public function getTempLink($nickname) {
        return parent::sendSqlAndGetData("SELECT `urn` FROM `temp_urn_for_accept_account` WHERE `nickname`=:nickname", ['nickname' => $nickname]);
    }

    public function removeConfirmUrn($nickname) {
        return parent::sendSql("DELETE FROM `temp_urn_for_accept_account` WHERE `nickname`=:nickname", ['nickname' => $nickname]);
    }
}