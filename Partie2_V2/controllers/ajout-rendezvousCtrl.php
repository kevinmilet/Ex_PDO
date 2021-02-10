<?php

require_once(dirname(__FILE__).'/../models/Patient.php');

$errors = [];

// nouvelle instance de Patient()
$patient = new Patient();

// On récupère la liste des patients sous forme de tableau
$patients = $patient->listPatient();

include(dirname(__FILE__).'/../views/templates/header.php');

include(dirname(__FILE__).'/../views/ajout-rendezvous.php');

include(dirname(__FILE__).'/../views/templates/footer.php');