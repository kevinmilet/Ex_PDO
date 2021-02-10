<?php

require_once(dirname(__FILE__).'/../utils/regex.php');
require_once(dirname(__FILE__).'/../models/Patient.php');

$errors = [];
$isSuccess = false;

// Envoi du formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));
    $firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));
    $birthdate = trim(filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_STRING));
    $phone = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING));
    $mail = trim(filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL));

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
        if (!preg_match(REG_BIRTH_DATE, $birthdate)) {
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

    if (empty($errors)) {

        $patient = new Patient($lastname, $firstname, $birthdate, $phone, $mail);
        
        if ($patient->addPatient() == true) {
            $feedback = '<div class="alert alert-success">Nouveau patient ajouté</div>';

        }   else {
            $feedback = '<div class="alert alert-danger">Une erreur est survenue</div>';
        }
    }

}


include(dirname(__FILE__).'/../views/templates/header.php');

include(dirname(__FILE__).'/../views/ajout-patient.php');

include(dirname(__FILE__).'/../views/templates/footer.php');