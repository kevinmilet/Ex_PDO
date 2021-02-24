<?php
require_once(dirname(__FILE__).'/../utils/config.php');

class Database {

    public static $pdo = null;

    public static function dbconnect(){
        if (is_null(self::$pdo)) {

            try {
            self::$pdo = new PDO('mysql:dbname='.DB_DATABASE_NAME.';host=localhost', DB_USER_NAME, DB_PWD);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
var_dump(self::$pdo);
            } catch (PDOException $e) {
                echo '<div class="alert alert-danger">'.$e->getMessage().'</div>';

            }
        }
        
        return self::$pdo;
    }
}