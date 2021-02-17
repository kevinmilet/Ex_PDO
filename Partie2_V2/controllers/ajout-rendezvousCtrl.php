<?php

require_once(dirname(__FILE__).'/../models/Patient.php');
require_once(dirname(__FILE__).'/../models/Appointment.php');


$errors = [];

// On récupère la liste des patients pour les insérer dans le select
$firstpage = 0;

$limite = Patient::nbPatient();
$limite = intval($limite->nb_patients);

$patients = Patient::listPatient($firstpage, $limite);

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
        $result = $aptmt->addAppointment();

        if ($result === true) {
            // $feedback = '<div class="alert alert-success">Nouveau rendez-vous ajouté le '.$date.' à '.$hour.'</div>';
            header('location: /controllers/ajout-rendezvousCtrl.php?code=10');

        }   else {
            // $feedback = '<div class="alert alert-danger">Une erreur est survenue</div>';
            header('location: /controllers/ajout-rendezvousCtrl.php?code=9');
        }
    }


}


include(dirname(__FILE__).'/../views/templates/header.php');

include(dirname(__FILE__).'/../views/ajout-rendezvous.php');

include(dirname(__FILE__).'/../views/templates/footer.php');