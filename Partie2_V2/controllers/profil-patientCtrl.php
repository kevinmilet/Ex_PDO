<?php
require_once(dirname(__FILE__).'/../models/Patient.php');
require_once(dirname(__FILE__).'/../models/Appointment.php');

$id = intval(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));

if ($id <= 0) {
    header('location: /index.php');
    
} else {

    $patient = new Patient();
    $aptmt = new Appointment();

    $patientSelected = $patient->getPatient($id);
    $patientAppointments = $aptmt->getPatientAppointment($id);

    if (!$patientSelected && !$patientAppointments) {
        header('location: /index.php');
    }
}


include(dirname(__FILE__).'/../views/templates/header.php');

include(dirname(__FILE__).'/../views/profil-patient.php');

include(dirname(__FILE__).'/../views/templates/footer.php');