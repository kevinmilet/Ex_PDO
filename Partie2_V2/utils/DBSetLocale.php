<?php
require_once(dirname(__FILE__).'/../utils/Database.php');

class DBSetLocale {

    private $_pdo;

    public function __construct() {
        $this->_pdo = Database::dbconnect();
    }

    public static function dbsetlocale(){
        try {
            $sqllocale = "SET lc_time_names = 'fr_FR';";
            $stmt = $this->_pdo->exec($sqllocale);

        } catch (PDOException $e) {
            return false;

        }
    }
}