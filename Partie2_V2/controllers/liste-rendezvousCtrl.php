<?php
require_once(dirname(__FILE__).'/../models/Appointment.php');

// Affichage de la liste des rendez-vous

if (isset($_GET['limitAptmt']) && !empty($_GET['limitAptmt'])) {
    $limitSelectedAptmt = intval(trim(filter_input(INPUT_GET, 'limitAptmt', FILTER_SANITIZE_NUMBER_INT)));

} else {
    $limitSelectedAptmt = 5;

}

if (isset($_GET['pageAptmt']) && !empty($_GET['pageAptmt'])) {
    $currentPageAptmt = intval(trim(filter_input(INPUT_GET, 'pageAptmt', FILTER_SANITIZE_NUMBER_INT)));

    }else{
        $currentPageAptmt = 1;
        
}

// on récupére le nombre de rdv et on le convertit en entier
$resultAptmt = Appointment::nbAppointment();
$nbAptmt = intval($resultAptmt->nb_aptmt);

// on fixe la limite de patients à afficher
$limiteAptmt = $limitSelectedAptmt;

// On détermine le nombre pages qu'il y aura
$pagesAptmt = ceil($nbAptmt / $limiteAptmt);

//  on détermine la première page
$firstpageAptmt = ($currentPageAptmt * $limiteAptmt) - $limiteAptmt;

// on affiche la liste des patients
$aptmtList = Appointment::listAppointments($firstpageAptmt, $limiteAptmt);

// Gestion suppression rendez-vous
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['aptmt_id']) && isset($_GET['delete'])) {

    $idAptmt = intval(trim(filter_input(INPUT_GET, 'aptmt_id', FILTER_SANITIZE_NUMBER_INT)));
    $delete = intval(trim(filter_input(INPUT_GET, 'delete', FILTER_SANITIZE_NUMBER_INT)));

    if ($delete == '1') {

        $delAptmt = Appointment::deleteAppointment($idAptmt);
        $aptmtList = Appointment::listAppointments($firstpageAptmt, $limiteAptmt);

    }
}

// Affichage des vues
include(dirname(__FILE__).'/../views/templates/header.php');

include(dirname(__FILE__).'/../views/liste-rendezvous.php');

include(dirname(__FILE__).'/../views/templates/footer.php');
