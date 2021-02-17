<?php
// Inclusion des models
require_once(dirname(__FILE__).'/../models/Patient.php');
require_once(dirname(__FILE__).'/../models/Appointment.php');

// Nettoyage de l'id passé dans l'url
$id = intval(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));

// on teste si le patient existe et on l'affiche sinon on rédirige
if ($id <= 0) {
    header('location: /controllers/liste-patientsCtrl.php?code=3');
    
} else {

    $patientSelected = Patient::getPatient($id);
    $patientAppointments = Appointment::getPatientAppointment($id);

    if (!$patientSelected) {
        header('location: /controllers/liste-patientsCtrl.php?code=3');
    }
}

// Affichage des vues
include(dirname(__FILE__).'/../views/templates/header.php');

include(dirname(__FILE__).'/../views/profil-patient.php');

include(dirname(__FILE__).'/../views/templates/footer.php');