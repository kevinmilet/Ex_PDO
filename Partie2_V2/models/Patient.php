<?php

include(dirname(__FILE__).'/../utils/Database.php');

class Patient {
    
    private $_id;
    private $_lastname;
    private $_firstname;
    private $_birthdate;
    private $_phone;
    private $_mail;
    private $_pdo;

    public function __construct($lastname, $firstname, $birthdate, $phone, $mail) {
        $this->_lastname = $lastname;
        $this->_firstname = $firstname;
        $this->_birthdate = $birthdate;
        $this->_phone = $phone;
        $this->_mail = $mail;
        $this->_pdo = Database::dbconnect();

    }

    public function savePatient($lastname, $firstname, $birthdate, $phone, $mail) {
        $addPatient = "INSERT INTO `patients` (`lastname`, `firstname`, `birthdate`, `phone`, `mail`)
                        VALUES (:lastname, :firstname, :birthdate, :phone, :mail)";

        try {
            $sth = $this->_pdo->prepare($addPatient);
            $sth->execute([
                'lastname' => $lastname,
                'firstname' => $firstname,
                'birthdate' => $birthdate,
                'phone' => $phone,
                'mail' => $mail
            ]);

            echo '<div class="alert alert-success">Nouveau patient ajouté</div>';

        }   catch (PDOException $e) {

            echo '<div class="alert alert-danger">La requête  échouée: '.$e->getMessage().'</div>';
        }
        
        return $sth;
    }

}