<?php

require_once(dirname(__FILE__).'/../models/Patient.php');
require_once(dirname(__FILE__).'/../models/Appointment.php');


$errors = [];

// nouvelle instance de Patient()
$patient = new Patient();

// On récupère la liste des patients sous forme de tableau
$patients = $patient->listPatient();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $idPatients = intval(trim(filter_input(INPUT_POST, 'patient', FILTER_SANITIZE_NUMBER_INT)));
    $date = trim(filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING));
    $hour = trim(filter_input(INPUT_POST, 'hour', FILTER_SANITIZE_STRING));

    if (empty($idPatients)) {
        $errors['idPatientsError'] = 'Ce champs est requis';
    
    }   else {

        if (!preg_match('/^[0-9]+$/', $idPatients)) {
            $errors['idPatientsError'] = 'ID patient invalide';
        }
    }

    if (empty($date)) {
        $errors['dateError'] = 'Ce champs est requis';

    }   else {
        if (!preg_match('/^([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))$/', $date)) {
            $errors['dateError'] = 'Date invalide';

        }
    }

    if (empty($hour)) {
        $errors['hourError'] = 'Ce champs est requis';

    }   else {
        if (!preg_match('/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/', $hour))
        $errors['hourError'] = 'Heure invalide';
        
    }

    if (empty($errors)) {
        $dateHour = $date.' '.$hour.':00';
        
        $aptmt = new Appointment($dateHour, $idPatients);

        if ($aptmt->addAppointment() == true) {
            $feedback = '<div class="alert alert-success">Nouveau rendez-vous ajouté le '.$date.' à '.$hour.'</div>';

        }   else {
            $feedback = '<div class="alert alert-danger">Une erreur est survenue</div>';
        }
    }


}


include(dirname(__FILE__).'/../views/templates/header.php');

include(dirname(__FILE__).'/../views/ajout-rendezvous.php');

include(dirname(__FILE__).'/../views/templates/footer.php');