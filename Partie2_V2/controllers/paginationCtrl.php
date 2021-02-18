<?php
session_start();

if (isset($_GET['limit']) && !empty($_GET['limit'])) {
    $limitSelected = intval(trim(filter_input(INPUT_GET, 'limit', FILTER_SANITIZE_NUMBER_INT)));
    $_SESSION['limit'] = $limitSelected;

    } else {
        $_SESSION['limit'] = 5;

    }

if (isset($_GET['page']) && !empty($_GET['page'])) {
    $currentPageAptmt = intval(trim(filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT)));

    }else{
        $currentPage = 1;
        
}

$result = Appointment::nbAppointment();

$nb = intval($result->nb_aptmt);

$limite = $limitSelected;

$pages = ceil($nbAptmt / $limite);

$firstpage = ($currentPage * $limite) - $limite;