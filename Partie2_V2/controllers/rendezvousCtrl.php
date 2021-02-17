<?php
require_once(dirname(__FILE__).'/../models/Appointment.php');


// On récupére les rendez-vous d'un patient
if (isset($_GET['aptmt_id'])) {
    $idAptmt = intval(trim(filter_input(INPUT_GET, 'aptmt_id', FILTER_SANITIZE_NUMBER_INT)));
    $appointment = Appointment::getAppointment($idAptmt);
}


$errors = [];


// Modification d'un rendez-vous
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['aptmt_id'])) {
    $idAptmt = intval(trim(filter_input(INPUT_GET, 'aptmt_id', FILTER_SANITIZE_NUMBER_INT)));
    $date = trim(filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING));
    $hour = trim(filter_input(INPUT_POST, 'hour', FILTER_SANITIZE_STRING));

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
        
        $aptmt = new Appointment();
        $result = $aptmt->updateAppointment($dateHour, $idAptmt);

        if ($result === true) {
            // $feedback = '<div class="alert alert-success">Rendez-vous modifié</div>';
            header('location: /controllers/liste-rendezvousCtrl.php?code=6');

        }   else {
            // $feedback = '<div class="alert alert-danger">Une erreur est survenue</div>';
            header('location: /controllers/liste-rendezvousCtrl.php?code=7');
        }
    }
}


include(dirname(__FILE__).'/../views/templates/header.php');

include(dirname(__FILE__).'/../views/rendezvous.php');

include(dirname(__FILE__).'/../views/templates/footer.php');