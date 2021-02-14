<?php
require_once(dirname(__FILE__).'/../models/Appointment.php');

// nouvelle instance
$aptmt = new Appointment();

$aptmtList = $aptmt->listAppointments();

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['aptmt_id']) && isset($_GET['delete'])) {

    $idAptmt = trim(filter_input(INPUT_GET, 'aptmt_id', FILTER_SANITIZE_STRING));
    $delete = trim(filter_input(INPUT_GET, 'delete', FILTER_SANITIZE_STRING));

    if ($delete == '1') {

        
        $aptmt = new Appointment();
        $delAptmt = $aptmt->deleteAppointment();
        $aptmtList = $aptmt->listAppointments();

    }
}

include(dirname(__FILE__).'/../views/templates/header.php');

include(dirname(__FILE__).'/../views/liste-rendezvous.php');

include(dirname(__FILE__).'/../views/templates/footer.php');
