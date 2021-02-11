<?php
require_once(dirname(__FILE__).'/../models/Appointment.php');

// nouvelle instance
$aptmt = new Appointment();

$appointment = $aptmt->getAppointment();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['aptmt_id'])) {
    $idAptmt = trim(filter_input(INPUT_GET, 'aptmt_id', FILTER_SANITIZE_STRING));
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
        
        $aptmt = new Appointment($dateHour, $idAptmt);

        if ($aptmt->updateAppointment() == true) {
            $feedback = '<div class="alert alert-success">Rendez-vous modifié</div>';

        }   else {
            $feedback = '<div class="alert alert-danger">Une erreur est survenue</div>';
        }
    }
}
// $updateAptmt = $aptmt->updateAppointment();

include(dirname(__FILE__).'/../views/templates/header.php');

include(dirname(__FILE__).'/../views/rendezvous.php');

include(dirname(__FILE__).'/../views/templates/footer.php');