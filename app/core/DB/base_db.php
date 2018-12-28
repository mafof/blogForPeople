<?php
namespace App\Core\DB;

use PDO;

class BaseDB {
    private $db = null;

    public function __construct($isConnecting = false) {
        if($isConnecting) $this->connectDB();
    }

    public function connectDB() {
        global $CONFIG_DATABASE;
        $this->db = new PDO('mysql:host='.$CONFIG_DATABASE['host'].';dbname='.$CONFIG_DATABASE['dbname'] . ';charset=utf8', $CONFIG_DATABASE['login'], $CONFIG_DATABASE['password']);
    }

    public function closeDB() {
        $this->db = null;
    }

    public function getInstanceDB() {
        return $this->db;
    }

    public function sendSqlAndGetData($sql, $inputData = null) {
        if(is_null($this->db)) return null;

        $statement = $this->db->prepare($sql);
        $statement->execute($inputData);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function sendSql($sql, $inputData = null) {
        if(is_null($this->db)) return false;

        $statement = $this->db->prepare($sql);
        return $statement->execute($inputData);
    }
}