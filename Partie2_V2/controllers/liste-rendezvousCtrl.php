<?php
require_once(dirname(__FILE__).'/../models/Appointment.php');

// nouvelle instance
$aptmt = new Appointment();

$aptmtList = $aptmt->listAppointments();

include(dirname(__FILE__).'/../views/templates/header.php');

include(dirname(__FILE__).'/../views/liste-rendezvous.php');

include(dirname(__FILE__).'/../views/templates/footer.php');
