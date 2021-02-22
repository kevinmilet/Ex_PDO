<?php
require_once(dirname(__FILE__).'/../utils/config.php');

// On récupére la limite choisie et on nettoie les données réçues
if (isset($_GET['limit']) && !empty($_GET['limit'])) {
    $_SESSION['limit'] = intval(trim(filter_input(INPUT_GET, 'limit', FILTER_SANITIZE_NUMBER_INT)));

    } else {
        $_SESSION['limit'] = 5;

    }

// On récupére le type de page et on nettoie les données réçues
// pageType = 1 : Liste patients
// pageType = 2 : Liste rdv
if (isset($_GET['pageType']) && !empty($_GET['pageType'])) {
    $pageType = intval(trim(filter_input(INPUT_GET, 'pageType', FILTER_SANITIZE_NUMBER_INT)));
    

    } else {
        $pageType = 1;

    }

// on redirige en fonction de la page
switch ($pageType) {
    case 1:
        header('location: /controllers/liste-patientsCtrl.php');
        break;
    case 2:
        header('location: /controllers/liste-rendezvousCtrl.php');
        break;
}