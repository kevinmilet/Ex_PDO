<?php
$pageTitle = "Cabinet médical - Liste des patients";

// inclusion du fichier de config
require_once(dirname(__FILE__).'/../utils/config.php');
require_once(dirname(__FILE__).'/../models/Patient.php');


//*****************************************************************************************************
//
// Affichage de la liste des patients avec pagination
//
//*****************************************************************************************************

// on récupére la valeur du champs search
$search = trim(filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));

if (isset($_GET['page']) && !empty($_GET['page'])) {
    $currentPage = intval(trim(filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT)));

    if ($currentPage <= 0) {
        $currentPage = 1;
    }

    }else{
        $currentPage = 1;
        
}

// on récupére le nombre de patients et on le convertit en entier
// $result = Patient::nbPatient();
$nbPatients = Patient::nbPatient();

// on fixe la limite de patients à afficher
$limite = $_SESSION['limit'];

// On détermine le nombre pages qu'il y aura
$pages = ceil($nbPatients / $limite);

if ($currentPage > $pages) {

    $currentPage = 1;
}

//  on détermine la première page
$firstpage = ($currentPage * $limite) - $limite;
// $firstpage = $limite * ($currentPage - 1);

// on affiche la liste des patients
$patientsList = Patient::listPatient($search, $firstpage, $limite);

echo json_encode($patientsList);


//*****************************************************************************************************


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
//*****************************************************************************************************

// Affichage des vues
include(dirname(__FILE__).'/../views/templates/header.php');

include(dirname(__FILE__).'/../views/liste-patients.php');

include(dirname(__FILE__).'/../views/templates/footer.php');
