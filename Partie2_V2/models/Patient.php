<?php

require_once(dirname(__FILE__).'/../utils/Database.php');

class Patient {
    
    private $_lastname;
    private $_firstname;
    private $_birthdate;
    private $_phone;
    private $_mail;
    private $_pdo;

    // methode constructeur qui hydrate l'objet patient
    public function __construct($lastname = null, $firstname = null, $birthdate = null, $phone = null, $mail = null) {
        $this->_lastname = $lastname;
        $this->_firstname = $firstname;
        $this->_birthdate = $birthdate;
        $this->_phone = $phone;
        $this->_mail = $mail;
        $this->_pdo = Database::dbconnect();

    }

    // methode testant si un patient existe dans la base de donnée
    public function isExist($mail) {

        $sql = "SELECT `id` FROM `patients` WHERE `mail`= :mail;";

        try {
            $stmt = $this->_pdo->prepare($sql);
            $stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
            
            $stmt->execute();

            $isExist = $stmt->fetch();
            
            return $isExist;
        
        } catch (PDOException $e) {
            return false;
        }

    }


    // methode ajoutant un patient
    public function addPatient() {

        if(!$this->isExist($this->_mail)) { // teste si le patient existe ou non dans la bdd
            
            // préparation de la requète
            $sql = "INSERT INTO `patients` (`lastname`, `firstname`, `birthdate`, `phone`, `mail`)
                            VALUES (:lastname, :firstname, :birthdate, :phone, :mail);";

            // execution de la requète
            try {
                $stmt = $this->_pdo->prepare($sql);

                $stmt->bindValue(':lastname', $this->_lastname, PDO::PARAM_STR);
                $stmt->bindValue(':firstname', $this->_firstname, PDO::PARAM_STR);
                $stmt->bindValue(':birthdate', $this->_birthdate, PDO::PARAM_STR);
                $stmt->bindValue(':phone', $this->_phone, PDO::PARAM_STR);
                $stmt->bindValue(':mail', $this->_mail, PDO::PARAM_STR);
                return $stmt->execute();
                
            } catch (PDOException $e) {
                return false;
            }

        } else {
            return 23000;
        }
        
    }

    // methode donnant le nombre de patients
    public static function nbPatient() {

        $pdo = Database::dbconnect();

        $sql = "SELECT COUNT(*) AS 'nb_patients' FROM `patients`;";

        try {
            $stmt = $pdo->query($sql);
            $result = $stmt->fetch();
            return $result;

        } catch (PDOException $e) {
            return false;

        }
    }

    // methode listant les patients
    public static function listPatient($firstpage, $limite) {

        $pdo = Database::dbconnect();

        $sql = "SELECT * FROM `patients` LIMIT :firstpage, :limite;";
        
        try {
            $stmt =$pdo->prepare($sql);
            $stmt->bindValue(':firstpage', $firstpage, PDO::PARAM_INT);
            $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
            $stmt->execute();
            $patientList = $stmt->fetchAll();
        
            return $patientList;

        } catch (PDOException $e) {
            return false;
        }
    }
    
    // methode affichage d'un patient
    public static function getPatient($id) {
        
        $pdo = Database::dbconnect();

        try {
            $sql = "SELECT * FROM `patients` WHERE `id` = :id;";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();

        } catch (PDOException $e) {
            return false;
    
        }
    
    }

    // methode modification patient
    public function updatePatient($id) {

        // Préparation de la requete d'ajout d'un nouveau patient
        $sql = "UPDATE `patients` SET `lastname` = :lastname, `firstname` = :firstname, `birthdate` = :birthdate, `phone` = :phone, `mail` = :mail WHERE `id` = :id;";

        // Exécution de la requête
        try {
            $stmt = $this->_pdo->prepare($sql);

            $stmt->bindValue(':lastname', $this->_lastname, PDO::PARAM_STR);
            $stmt->bindValue(':firstname', $this->_firstname, PDO::PARAM_STR);
            $stmt->bindValue(':birthdate', $this->_birthdate, PDO::PARAM_STR);
            $stmt->bindValue(':phone', $this->_phone, PDO::PARAM_STR);
            $stmt->bindValue(':mail', $this->_mail, PDO::PARAM_STR);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

            return $stmt->execute();
            
        } catch (PDOException $e){
            return false;
        }
        
    }
    
    // methode supression patient
    public static function deletePatient($id) {

        $pdo = Database::dbconnect();

        $sql = "DELETE FROM `patients` WHERE `id` = :id;";

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();

        } catch (PDOException $e) {
            return false;
        }
    }

    // methode recherche d'un patient
    public static function searchPatient($search) {

        $pdo = Database::dbconnect();

        $sql = "SELECT * FROM `patients` WHERE `lastname` LIKE :search OR `firstname` LIKE :search;";

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':search', '%'.$search.'%', PDO::PARAM_STR);
            $stmt->execute();
            $count = $stmt->rowCount();
        
            if ($count != 0) {
                $result = $stmt->fetchAll();
                return $result;

            } else {
                return false;
            }
        
        } catch (PDOException $e) {
            return false;
        }

    }
}