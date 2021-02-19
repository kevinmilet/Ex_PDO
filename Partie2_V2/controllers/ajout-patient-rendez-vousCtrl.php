<?php
$pageTitle = "Cabinet médical - Ajout Patient et Rendez-vous";
// inclusion des models et des regex pour les validations
require_once(dirname(__FILE__).'/../utils/config.php');
require_once(dirname(__FILE__).'/../utils/regex.php');
require_once(dirname(__FILE__).'/../models/Patient.php');
require_once(dirname(__FILE__).'/../models/Appointment.php');

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];

    // Nettoyage des données reçues
    $lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));
    $firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));
    $birthday = trim(filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_STRING));
    $phone = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING));
    $mail = trim(filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL));
    $birthdate = trim(filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_STRING));
    $date = trim(filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING));
    $hour = trim(filter_input(INPUT_POST, 'hour', FILTER_SANITIZE_STRING));

    // Champs Nom
    if (empty($lastname)) {
        $errors['lastnameError'] = 'Ce champs est requis';

    }   else {
        if (!preg_match(REG_STR_NO_INT, $lastname)) {
            $errors['lastnameError'] = 'Veuillez respecter le format requis';

        }
    }

    // Champs Prénom
    if (empty($firstname)) {
        $errors['firstnameError'] = 'Ce champs est requis';

    }   else {
        if (!preg_match(REG_STR_NO_INT, $firstname)) {
            $errors['firstnameError'] = 'Veuillez respecter le format requis';

        }
    }

    // Champs Date de naissance
    if (empty($birthdate)) {
        $errors['birthdateError'] = 'Ce champs est requis';

    }   else {
        if (!preg_match(REG_DATE, $birthdate)) {
            $errors['birthdateError'] = 'Veuillez respecter le format requis';

        }
    }

    // Champs Téléphone
    if (!empty($phone)) {
        if (!preg_match(REG_PHONE, $phone)) {
            $errors['phoneError'] = 'Veuillez respecter le format requis';

        }
    }   

    // Champs Email
    if (empty($mail)) {
        $errors['mailError'] = 'Ce champs est requis';

    }   else {
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                $errors['mailError'] = 'Email non valide';

        }        
    }

    // Champs Date
    if (empty($date)) {
        $errors['dateError'] = 'Ce champs est requis';

    }   else {
        if (!preg_match(REG_DATE, $date)) {
            $errors['dateError'] = 'Date invalide';

        }
    }

    // Champs Heure
    if (empty($hour)) {
        $errors['hourError'] = 'Ce champs est requis';

    }   else {
        if (!preg_match(REG_HOUR, $hour))
        $errors['hourError'] = 'Heure invalide';
        
    }

    // Enregistrement en BDD
    if (empty($errors)) {
        $dateHour = $date.' '.$hour.':00'; // YYYY-MM-DD HH:MM:SS
        
        // Enregistrement dans la table Patients
        $patient = new Patient($lastname, $firstname, $birthdate, $phone, $mail);
        $result = $patient->addPatient();

        if ($result === true) {
            $idPatients = Patient::getPatient($id);
            $aptmt = new Appointment($dateHour, $idPatients);
            $resultAptmt = $aptmt->addAppointment();

            if ($resultAptmt === true) {
                header('location: /controllers/liste-patientsCtrl.php?code=11');
            }   
        } 
    } else {
        $code = $result;
    }
}



// Affichage des vues
include(dirname(__FILE__).'/../views/templates/header.php');

include(dirname(__FILE__).'/../views/ajout-patient-rendez-vous.php');

include(dirname(__FILE__).'/../views/templates/footer.php');


