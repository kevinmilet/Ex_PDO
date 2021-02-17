<?php
require_once(dirname(__FILE__).'/../models/Patient.php');


//*****************************************************************************************************
//
// Affichage de la liste des patients avec pagination
//
//*****************************************************************************************************
if (isset($_GET['page']) && !empty($_GET['page'])) {
    $currentPage = intval(trim(filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT)));

    }else{
        $currentPage = 1;
        
}

// on récupére le nombre de patients et on le convertit en entier
$result = Patient::nbPatient();
$nbPatients = intval($result->nb_patients);

// on fixe la limite de patients à afficher
$limite = 5;

// On détermine le nombre pages qu'il y aura
$pages = ceil($nbPatients / $limite);

//  on détermine la première page
$firstpage = ($currentPage * $limite) - $limite;

// on affiche la liste des patients
$patientsList = Patient::listPatient($firstpage, $limite);
//*****************************************************************************************************


//*****************************************************************************************************
//
// Suppression d'un patient
//
//*****************************************************************************************************
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['delete'])) {

    $id = intval(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));
    $delete = intval(trim(filter_input(INPUT_GET, 'delete', FILTER_SANITIZE_NUMBER_INT)));

    if ($id <= 0 && $delete != 1) {
        header('location: /controllers/liste-patientsCtrl.php?code=8');

    } else {
        if ($delete == 1) {
            
            $delPatient = Patient::deletePatient($id);
            $patientsList = Patient::listPatient($firstpage, $limite);

        }

        if (!$patientsList) {
            header('location: /controllers/liste-patientsCtrl.php?code=0');
        }
    
    }
}
//*****************************************************************************************************


//*****************************************************************************************************
//
// recherche de patients
//
//*****************************************************************************************************
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['search'])) {

    $search = trim(filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));

    $patientsList = Patient::searchPatient($search);
}
//*****************************************************************************************************


// Affichage des vues
include(dirname(__FILE__).'/../views/templates/header.php');

include(dirname(__FILE__).'/../views/liste-patients.php');

include(dirname(__FILE__).'/../views/templates/footer.php');