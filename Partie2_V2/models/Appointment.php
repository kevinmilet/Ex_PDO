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

    // fonction affichage d'un rendez-vous
    public function getAppointment() {

        if (isset($_GET['aptmt_id'])) {
            $idAptmt = trim(filter_input(INPUT_GET, 'aptmt_id', FILTER_SANITIZE_STRING));

            // préparation de la requete
            $sqllocale = "SET lc_time_names = 'fr_FR';";
            $sql = "SELECT *, DATE_FORMAT(DATE(`dateHour`), '%a %e %M %Y') AS 'date', DATE_FORMAT(TIME(`dateHour`), '%H:%i') AS 'hour' FROM `appointments` LEFT JOIN `patients` ON `appointments`.`idPatients` = `patients`.`id` WHERE `appointments`.`id` = :aptmt_id;";

            // execution de la requete
            try {
                $stmt1 = $this->_pdo->exec($sqllocale);
                $stmt = $this->_pdo->prepare($sql);
                $stmt->bindValue(':aptmt_id', $idAptmt, PDO::PARAM_STR);
                $stmt->execute();
                $appointment = $stmt->fetch();
                return $appointment;

            } catch (PDOException $e) {
                return false;
            }
        }
        
    }

    // fonction de modification de rendez-vous
    public function updateAppointment($dateHour, $idAptmt) {

        // préparation de la requete
        $sql = "UPDATE `appointments` SET `dateHour` = :dateHour WHERE `id` = :idAptmt;";

        // Execution de la requete
        try {
            $stmt = $this->_pdo->prepare($sql);

            $stmt->bindValue(':dateHour', $dateHour, PDO::PARAM_STR);
            $stmt->bindValue(':idAptmt', $idAptmt, PDO::PARAM_STR);

            return $stmt->execute();
        
        } catch (PDOException $e) {
            return false;
        }
    }


    // afficher les rendez-vous d'un patient
    public function getPatientAppointment() {

        if (isset($_GET['id'])) {

            $id = trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));

            // préparation de la requete
            $sqllocale = "SET lc_time_names = 'fr_FR';";
            $sql = "SELECT DATE_FORMAT(DATE(`dateHour`), '%a %e %M %Y') AS 'date', DATE_FORMAT(TIME(`dateHour`), '%H:%i') AS 'hour' FROM `appointments` LEFT JOIN `patients` ON `appointments`.`idPatients` = `patients`.`id` WHERE `appointments`.`idPatients` = :id ORDER BY `dateHour`;";

            // execution de la requete
            try {
                $stmt1 = $this->_pdo->exec($sqllocale);
                $stmt = $this->_pdo->prepare($sql);
                $stmt->bindValue(':id', $id, PDO::PARAM_STR);
                $stmt->execute();
                $patientAppointment = $stmt->fetchAll();
                return $patientAppointment;

            } catch (PDOException $e) {
                return false;
            }
            
        }
        
    }

    // supprimer un rendez-vous
    public function deleteAppointment() {

        if (isset($_GET['aptmt_id']) && isset($_GET['delete'])) {

            $idAptmt = trim(filter_input(INPUT_GET, 'aptmt_id', FILTER_SANITIZE_STRING));
            $delete = trim(filter_input(INPUT_GET, 'delete', FILTER_SANITIZE_STRING));

            $sql = "DELETE FROM `appointments` WHERE `id` = :idAptmt;";

            try {
                $stmt = $this->_pdo->prepare($sql);
                $stmt->bindValue(':idAptmt', $idAptmt, PDO::PARAM_STR);
                return $stmt->execute();

            } catch (PDOException $e) {
                return false;
            }
        }
    }
}