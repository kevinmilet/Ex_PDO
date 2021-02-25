<?php
require_once(dirname(__FILE__).'/../utils/config.php');
require_once(dirname(__FILE__).'/../models/Patient.php');

if (isset($_GET['pageType']) && !empty($_GET['pageType'])) {
    $pageType = intval(trim(filter_input(INPUT_GET, 'pageType', FILTER_SANITIZE_NUMBER_INT)));
    

    } else {
        $pageType = 1;

    }

//*****************************************************************************************************
//
// Suppression d'un patient
//
//*****************************************************************************************************
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id']) && isset($_GET['delete'])) {

    $id = intval(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));
    $delete = intval(trim(filter_input(INPUT_GET, 'delete', FILTER_SANITIZE_NUMBER_INT)));

    if ($id <= 0 && $delete != 1) {
        header('location: /controllers/liste-patientsCtrl.php?code=8');

    } else {
        if ($delete == 1) {
            
            $delPatient = Patient::deletePatient($id);
            header('location: /controllers/liste-patientsCtrl.php?code=13');

        }

        if (!$patientsList) {
            header('location: /controllers/liste-patientsCtrl.php?code=8');
        }
    
    }
}

switch ($pageType) {
    case 1:
        header('location: /controllers/liste-patientsCtrl.php');
        break;
    case 2:
        header('location: /controllers/liste-rendezvousCtrl.php');
        break;
}