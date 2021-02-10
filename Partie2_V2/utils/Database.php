<?php
require_once(dirname(__FILE__).'/../utils/config.php');

class Database {

    public static function dbconnect(){
        try {
            $pdo = new PDO('mysql:dbname='.DB_DATABASE_NAME.';host=localhost', DB_USER_NAME, DB_PWD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

        } catch (PDOException $e) {
            echo '<div class="alert alert-danger">'.$e->getMessage().'</div>';

        }

        return $pdo;
    }
}