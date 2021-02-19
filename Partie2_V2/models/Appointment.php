<?php
// inclusion de la connection à la BDD
require_once(dirname(__FILE__).'/../utils/Database.php');

class Appointment {

    private $_dateHour;
    private $_idPatients;
    private $_pdo;

    // methode constructeur
    public function __construct($dateHour = null, $idPatients = null) {
        $this->_dateHour = $dateHour;
        $this->_idPatients = $idPatients;
        $this->_pdo = Database::dbconnect();
    }

    // methode ajout rendez-vous
    public function addAppointment() {

        // préparation de la requète
        $sql = "INSERT INTO `appointments` (`dateHour`, `idPatients`)
        VALUES (:dateHour, :idPatients);";

        // execution de la requète
        try {
            $stmt = $this->_pdo->prepare($sql);

            $stmt->bindValue(':dateHour', $this->_dateHour, PDO::PARAM_STR);
            $stmt->bindValue(':idPatients', $this->_idPatients, PDO::PARAM_INT);

            return $stmt->execute();

        } catch (PDOException $e){
            return false;
        }
    }

    // méthode donnant le nombre de rdv
    public static function nbAppointment() {

        $pdo = Database::dbconnect();

        $sql = "SELECT COUNT(*) AS 'nb_aptmt' FROM `appointments`;";

        try {
            $stmt = $pdo->query($sql);
            $result = $stmt->fetch();
            return $result;

        } catch (PDOException $e) {
            return false;

        }
    }

    // methode liste des rendez-vous
    public static function listAppointments($firstpageAptmt, $limiteAptmt) {

        $pdo = Database::dbconnect();

        // préparation de la requète
        $sqllocale = "SET lc_time_names = 'fr_FR';";
        $sql = "SELECT `appointments`.`id` AS 'idAptmt', `patients`.`id` AS 'IdPatient', `patients`.`lastname` AS 'lastname', `patients`.`firstname` AS 'firstname', DATE_FORMAT(DATE(`dateHour`), '%a %e %M %Y') AS 'date', DATE_FORMAT(TIME(`dateHour`), '%H:%i') AS 'hour' FROM `appointments` LEFT JOIN `patients` ON `appointments`.`idPatients` = `patients`.`id` LIMIT :firstpage, :limite;";

        // execution de la requete
        try {
            $stmt1 = $pdo->exec($sqllocale);
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':firstpage', $firstpageAptmt, PDO::PARAM_INT);
            $stmt->bindValue(':limite', $limiteAptmt, PDO::PARAM_INT);
            $stmt->execute();
            $aptmtList = $stmt->fetchAll();
            
            return $aptmtList;

        } catch (PDOException $e) {
            return false;
        }
    }

    // methode affichage d'un rendez-vous
    public static function getAppointment($idAptmt) {

        $pdo = Database::dbconnect();

        // préparation de la requete
        $sqllocale = "SET lc_time_names = 'fr_FR';";
        $sql = "SELECT *, DATE_FORMAT(DATE(`dateHour`), '%a %e %M %Y') AS 'date', DATE_FORMAT(TIME(`dateHour`), '%H:%i') AS 'hour' FROM `appointments` LEFT JOIN `patients` ON `appointments`.`idPatients` = `patients`.`id` WHERE `appointments`.`id` = :aptmt_id;";

        // execution de la requete
        try {
            $stmt1 = $pdo->exec($sqllocale);
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':aptmt_id', $idAptmt, PDO::PARAM_INT);
            $stmt->execute();
            $appointment = $stmt->fetch();
            return $appointment;

        } catch (PDOException $e) {
            return false;
        }
    }

    // methode de modification de rendez-vous
    public function updateAppointment($dateHour, $idAptmt) {

        // préparation de la requete
        $sql = "UPDATE `appointments` SET `dateHour` = :dateHour WHERE `id` = :idAptmt;";

        // Execution de la requete
        try {
            $stmt = $this->_pdo->prepare($sql);

            $stmt->bindValue(':dateHour', $dateHour, PDO::PARAM_STR);
            $stmt->bindValue(':idAptmt', $idAptmt, PDO::PARAM_INT);

            return $stmt->execute();
        
        } catch (PDOException $e) {
            return false;
        }
    }


    // afficher les rendez-vous d'un patient
    public static function getPatientAppointment($id) {

        $pdo = Database::dbconnect();

        // préparation de la requete
        $sqllocale = "SET lc_time_names = 'fr_FR';";
        $sql = "SELECT DATE_FORMAT(DATE(`dateHour`), '%a %e %M %Y') AS 'date', DATE_FORMAT(TIME(`dateHour`), '%H:%i') AS 'hour', `appointments`.`id` AS 'aptmtID' FROM `appointments` LEFT JOIN `patients` ON `appointments`.`idPatients` = `patients`.`id` WHERE `appointments`.`idPatients` = :id ORDER BY `dateHour`;";

        // execution de la requete
        try {
            $stmt1 = $pdo->exec($sqllocale);
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $patientAppointment = $stmt->fetchAll();
            return $patientAppointment;

        } catch (PDOException $e) {
            return false;
        }
    }

    // supprimer un rendez-vous
    public static function deleteAppointment($idAptmt) {

        $pdo = Database::dbconnect();

        $sql = "DELETE FROM `appointments` WHERE `id` = :idAptmt;";

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':idAptmt', $idAptmt, PDO::PARAM_INT);
            return $stmt->execute();

        } catch (PDOException $e) {
            return false;
        }
    }
}