<?php
require_once(dirname(__FILE__).'/../models/Patient.php');
require_once(dirname(__FILE__).'/../models/Appointment.php');


// nouvelle instance de Patient()
$patient = new Patient();
$aptmt = new Appointment();

// On récupère la liste des patients sous forme de tableau
$patientsList = $patient->listPatient();

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['delete'])) {

    $id = intval(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));
    $delete = intval(trim(filter_input(INPUT_GET, 'delete', FILTER_SANITIZE_NUMBER_INT)));

    if ($id <= 0 && $delete != 1) {
        header('location: /index.php');

    } else {
        if ($delete == 1) {
            
            $delPatient = $patient->deletePatient($id);
            $patientsList = $patient->listPatient();

        }

        if (!$patientsList) {
            header('location: /index.php');
        }
        
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['search'])) {

    $search = trim(filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));
var_dump($search);
    $searhPatient = $patient->searchPatient($search);
    var_dump($searhPatient);

}




include(dirname(__FILE__).'/../views/templates/header.php');

include(dirname(__FILE__).'/../views/liste-patients.php');

include(dirname(__FILE__).'/../views/templates/footer.php');