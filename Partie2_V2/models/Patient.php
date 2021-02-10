<?php

require_once(dirname(__FILE__).'/../utils/Database.php');

class Patient {
    
    // private $_id;
    private $_lastname;
    private $_firstname;
    private $_birthdate;
    private $_phone;
    private $_mail;
    private $_pdo;

    // fonction constructeur
    public function __construct($lastname = null, $firstname = null, $birthdate = null, $phone = null, $mail = null) {
        $this->_lastname = $lastname;
        $this->_firstname = $firstname;
        $this->_birthdate = $birthdate;
        $this->_phone = $phone;
        $this->_mail = $mail;
        $this->_pdo = Database::dbconnect();

    }

    // fonction ajoutant un patient
    public function addPatient() {
        $sql = "INSERT INTO `patients` (`lastname`, `firstname`, `birthdate`, `phone`, `mail`)
                        VALUES (:lastname, :firstname, :birthdate, :phone, :mail)";

        try {
            $stmt = $this->_pdo->prepare($sql);

            $stmt->bindValue(':lastname', $this->_lastname, PDO::PARAM_STR);
            $stmt->bindValue(':firstname', $this->_firstname, PDO::PARAM_STR);
            $stmt->bindValue(':birthdate', $this->_birthdate, PDO::PARAM_STR);
            $stmt->bindValue(':phone', $this->_phone, PDO::PARAM_STR);
            $stmt->bindValue(':mail', $this->_mail, PDO::PARAM_STR);

            return $stmt->execute();
            
        }   catch (PDOException $e) {

            return false;
        }

    }

    // fonction listant les patients
    public function listPatient() {
        $sql = "SELECT * FROM `patients`";

        try {
            $stmt = $this->_pdo->query($sql);
            $patientList = $stmt->fetchAll();
        
            return $patientList;

        } catch (PDOException $e) {
            return false;
        }
        
    }   
        
}