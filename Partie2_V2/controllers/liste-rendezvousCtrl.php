<?php
require_once(dirname(__FILE__).'/../models/Appointment.php');

// nouvelle instance de Patient()
$aptmt = new Appointment();

// On récupère la liste des patients sous forme de tableau
$aptmtList = $aptmt->listAppointments();

include(dirname(__FILE__).'/../views/templates/header.php');

include(dirname(__FILE__).'/../views/liste-rendezvous.php');

include(dirname(__FILE__).'/../views/templates/footer.php');
