<?php

require_once(dirname(__FILE__).'/../utils/Database.php');

class Appointment {

    private $_id;
    private $_dateHour;
    private $_idPatients;
    private $_pdo;

    // fonction constructeur
    public function __construct($dateHour = null, $idPatients = null) {
        $this->_dateHour = $dateHour;
        $this->_idPatients = $idPatients;
        $this->_pdo = Database::dbconnect();
    }

    // fonction ajout rendez-vous
    public function addAppointment() {

        // préparation de la requète
        $sql = "INSERT INTO `appointments` (`dateHour`, `idPatients`)
        VALUES (:dateHour, :idPatients);";

        // execution de la requète
        try {
            $stmt = $this->_pdo->prepare($sql);

            $stmt->bindValue(':dateHour', $this->_dateHour, PDO::PARAM_STR);
            $stmt->bindValue(':idPatients', $this->_idPatients, PDO::PARAM_STR);

            return $stmt->execute();

        } catch (PDOException $e){
            return false;
        }
    }

    // fonction liste des rendez-vous
    public function listAppointments() {

        // préparation de la requète
        $sqllocale = "SET lc_time_names = 'fr_FR';";
        $sql = "SELECT `appointments`.`id` AS 'idAptmt', `patients`.`id` AS 'IdPatient', `patients`.`lastname` AS 'lastname', `patients`.`firstname` AS 'firstname', DATE_FORMAT(DATE(`dateHour`), '%a %e %M %Y') AS 'date', DATE_FORMAT(TIME(`dateHour`), '%H:%i') AS 'hour' FROM `appointments` LEFT JOIN `patients` ON `appointments`.`idPatients` = `patients`.`id`;";

        // execution de la requete
        try {
            $stmt1 = $this->_pdo->exec($sqllocale);
            $stmt = $this->_pdo->query($sql);
            
            $aptmtList = $stmt->fetchAll();
            
            return $aptmtList;

        } catch (PDOException $e) {
            return false;
        }
        
    }

}