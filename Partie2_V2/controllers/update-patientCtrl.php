<?php
require_once(dirname(__FILE__).'/../utils/config.php');
require_once(dirname(__FILE__).'/../utils/regex.php');
require_once(dirname(__FILE__).'/../models/Patient.php');



if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['id'])) {

    // on vérifie l'existence des données et on les nettoies
    $lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));
    $firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));
    $birthdate = trim(filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_STRING));
    $phone = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING));
    $mail = trim(filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL));
    $id = intval(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));


    // Champs Nom
    if (empty($lastname)) {
        $lastname = htmlentities($patientSelected->lastname);

    }   else {
        if (!preg_match(REG_STR_NO_INT, $lastname)) {
            $errors['lastnameError'] = 'Veuillez respecter le format requis';

        }
    }

    // Champs Prénom
    if (empty($firstname)) {
        $firstname = htmlentities($patientSelected->firstname);

    }   else {
        if (!preg_match(REG_STR_NO_INT, $firstname)) {
            $errors['firstnameError'] = 'Veuillez respecter le format requis';

        }
    }

    // Champs Date de naissance
    if (empty($birthdate)) {
        $birthdate = htmlentities($patientSelected->birthdate);

    }   else {
        if (!preg_match(REG_DATE, $birthdate)) {
            $errors['birthdateError'] = 'Veuillez respecter le format requis';

        }
    }

    // Champs Téléphone
    if (!empty($phone)) {
        if (!preg_match(REG_PHONE, $phone)) {
            $errors['phoneError'] = 'Veuillez respecter le format requis';

        } else {
            if (empty($phone)) {
                $phone = htmlentities($patientSelected->phone);
            }
        }
    }   

    // Champs Email
    if (empty($mail)) {
        $mail = htmlentities($patientSelected->mail);

    } else {
        if (!empty($mail)) {
            if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                $errors['mailError'] = 'Email non valide';
            }
        }
    }
    

    // On update le patient dans la BDD
    if (empty($errors)) {
        
        $patient = new Patient($lastname, $firstname, $birthdate, $phone, $mail);
        $result = $patient->updatePatient($id);

        if ($result === true) {
            // $feedback = '<div class="alert alert-success">Informations du patient modifiées</div>';
            // $patientSelected = $patient->getPatient($id);
            header('location: /controllers/liste-patientsCtrl.php?code=2');

        }   else {
            header('location: /controllers/liste-patientsCtrl.php?code=5');
            
        }

    }
    
}