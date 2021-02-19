<?php
$pageTitle = "Cabinet médical - Ajout Patient et Rendez-vous";
// inclusion des models et des regex pour les validations
require_once(dirname(__FILE__).'/../utils/regex.php');
require_once(dirname(__FILE__).'/../models/Patient.php');
require_once(dirname(__FILE__).'/../models/Appointment.php');



// Affichage des vues
include(dirname(__FILE__).'/../views/templates/header.php');

include(dirname(__FILE__).'/../views/ajout-patient-rendez-vous.php');

include(dirname(__FILE__).'/../views/templates/footer.php');


