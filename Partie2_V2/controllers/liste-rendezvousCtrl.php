<?php
$pageTitle = "Cabinet médical - Liste des rendes-vous";

require_once(dirname(__FILE__).'/../utils/config.php');
require_once(dirname(__FILE__).'/../models/Appointment.php');

// Affichage de la liste des rendez-vous

if (isset($_GET['page']) && !empty($_GET['page'])) {
    $currentPage = intval(trim(filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT)));

    }else{
        $currentPage = 1;
        
}

// on récupére le nombre de rdv et on le convertit en entier
$result = Appointment::nbAppointment();
$nbAptmt = intval($result->nb_aptmt);

// on fixe la limite de patients à afficher
$limite = $_SESSION['limit'];

// On détermine le nombre pages qu'il y aura
$pages = ceil($nbAptmt / $limite);

//  on détermine la première page
$firstpage = ($currentPage * $limite) - $limite;

// on affiche la liste des patients
$aptmtList = Appointment::listAppointments($firstpage, $limite);

// Gestion suppression rendez-vous
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['aptmt_id']) && isset($_GET['delete'])) {

    $idAptmt = intval(trim(filter_input(INPUT_GET, 'aptmt_id', FILTER_SANITIZE_NUMBER_INT)));
    $delete = intval(trim(filter_input(INPUT_GET, 'delete', FILTER_SANITIZE_NUMBER_INT)));

    if ($delete == 1) {

        $delAptmt = Appointment::deleteAppointment($idAptmt);
        header('location: /controllers/liste-rendezvousCtrl.php?code=12');

    } else {
        if ($delAptmt === false || $delete != 1) {

            header('location: /controllers/liste-rendezvousCtrl.php?code=14');
        }
    }
}

// Affichage des vues
include(dirname(__FILE__).'/../views/templates/header.php');

include(dirname(__FILE__).'/../views/liste-rendezvous.php');

include(dirname(__FILE__).'/../views/templates/footer.php');
