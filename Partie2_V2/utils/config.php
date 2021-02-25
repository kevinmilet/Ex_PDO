<?php
// fichier de configuration
session_start();
$_SESSION['limit'] = $_SESSION['limit'] ?? 5;

define('DB_DATABASE_NAME', 'hospitale2n');
define('DB_USER_NAME', 'kevin_hospital');
define('DB_PWD', 'Lou26032016!');
// define('DB_DATABASE_NAME', 'dbs1481248'); 
// define('DB_USER_NAME', 'dbu1319761');
// define('DB_PWD', 'NyVrvTsCu9-SM-4');

setlocale(LC_TIME, 'fr_FR.utf8','fra.utf8');

$msg = array(
    '0' => ['type' => 'alert-danger', 'msg' => 'Une erreur inconnue s\'est produite'],
    '1' => ['type' => 'alert-success', 'msg' => 'Le patient a bien été ajouté'],
    '2' => ['type' => 'alert-success', 'msg' => 'Le patient a bien été mis à jour'],
    '3' => ['type' => 'alert-danger', 'msg' => 'Le patient n\'a pas été trouvé'],
    '4' => ['type' => 'alert-danger', 'msg' => 'Le patient n\'a pas été enregistré en base de données'],
    '5' => ['type' => 'alert-danger', 'msg' => 'Le patient n\'a pas été mis à jour'],
    '6' => ['type' => 'alert-success', 'msg' => 'Le rdv a bien été mis à jour'],
    '7' => ['type' => 'alert-danger', 'msg' => 'Le rdv n\'a pas été mis à jour'],
    '8' => ['type' => 'alert-danger', 'msg' => 'Le patient n\'a pas été supprimé'],
    '9' => ['type' => 'alert-danger', 'msg' => 'Le rendez-vous n\'a pas été ajouté'],
    '10' => ['type' => 'alert-success', 'msg' => 'Le rendez-vous a été ajouté'],
    '11' => ['type' => 'alert-success', 'msg' => 'Le patient et le rendez-vous ont été ajoutés'],
    '12' => ['type' => 'alert-success', 'msg' => 'Le rendez-vous a été supprimé'],
    '13' => ['type' => 'alert-success', 'msg' => 'Le patient et ses rendez-vous ont été supprimé'],
    '14' => ['type' => 'alert-danger', 'msg' => 'Le rendez-vous n\'a été supprimé'],
    '23000' => ['type' => 'alert-danger', 'msg' => 'Le mail est déjà existant'],
    
);
