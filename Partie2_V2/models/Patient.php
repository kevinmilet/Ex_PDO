<?php

require_once(dirname(__FILE__).'/../utils/Database.php');

class Patient {
    
    private $_id;
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

    // fonction testant si un patient existe dans la base de donnée
    public function isExist($mail) {

        $sql = "SELECT `id` FROM `patients` WHERE `mail`= :mail;";

        try {
            $stmt = $this->_pdo->prepare($sql);
            $stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
            
            $stmt->execute();

            $isExist = $stmt->fetch();

            if(!empty($isExist)) {
                return true;

            } else {
                return false;
            }

            return $isExist;
        
        } catch (PDOException $e) {
            return false;
        }

    }


    // fonction ajoutant un patient
    public function addPatient() {

        // $obj = new StdClass();
        // $obj->result = null;
        // $obj->error = false;
        // $obj->msg = '';

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
                // $obj->msg = 'insert_patient_ok';
                // return $obj;
                return $stmt->execute();
                
            } catch (PDOException $e) {
                // $obj->msg = '<div class="alert alert-danger">Erreur de requete</div>';
                // $obj->error = true;
                // return $obj;
                return false;
            }

        } else {
            // $obj->value = '<div class="alert alert-danger">Le patient existe déjà</div>';
            // $obj->type = false;
            // return $obj;//
            return false;
        }
        
    }

    // fonction donnant le nombre de patients
    public function nbPatient() {

        $sql = "SELECT COUNT(*) AS 'nb_patients' FROM `patients`;";

        try {
            $stmt = $this->_pdo->query($sql);
            $result = $stmt->fetch();
            return $result;

        } catch (PDOException $e) {
            return false;

        }
    }

    // fonction listant les patients
    public function listPatient($firstpage, $limite) {

        $sql = "SELECT * FROM `patients` LIMIT :firstpage, :limite;";
        
        try {
            $stmt = $this->_pdo->prepare($sql);
            $stmt->bindValue(':firstpage', $firstpage, PDO::PARAM_INT);
            $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
            $stmt->execute();
            $patientList = $stmt->fetchAll();
        
            return $patientList;

        } catch (PDOException $e) {
            return false;
        }
    }
    
    // fonction affichage d'un patient
    public function getPatient($id) {
        
        // Afficher le patient sélectionné
        try {
            $sql = "SELECT * FROM `patients` WHERE `id` = :id;";
            $stmt = $this->_pdo->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();

        } catch (PDOException $e) {
            return false;
    
        }
    
    }

    // fonction modification patient
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
    
    // fonction supression patient
    public function deletePatient($id) {

        $sql = "DELETE FROM `patients` WHERE `id` = :id;";

        try {
            $stmt = $this->_pdo->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();

        } catch (PDOException $e) {
            return false;
        }
    }

    // fonction recherche d'un patient
    public function searchPatient($search) {

        $sql = "SELECT * FROM `patients` WHERE `lastname` LIKE :search OR `firstname` LIKE :search;";

        try {
            $stmt = $this->_pdo->prepare($sql);
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