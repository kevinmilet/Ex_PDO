<?php
require_once(dirname(__FILE__).'/../models/Patient.php');
require_once(dirname(__FILE__).'/../models/Appointment.php');

// nouvelle instance de Patient()
$patient = new Patient();

$patientSelected = $patient->getPatient();

$aptmt = new Appointment();

$patientAppointments = $aptmt->getPatientAppointment();

include(dirname(__FILE__).'/../views/templates/header.php');

include(dirname(__FILE__).'/../views/profil-patient.php');

include(dirname(__FILE__).'/../views/templates/footer.php');