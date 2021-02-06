<?php
$errors = [];
$regStr = '/^[a-zA-Zéèàùûêâôëç \'-]+$/';
$regDate = '/^([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))$/';
$regPhone = '/^[0-9 ]+$/';


if (isset($_GET['id'])) {

    $id = trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));

    // Afficher et éditer le patient sélectionné
    try {
        $sql = "SELECT * FROM `patients` WHERE `id` = $id";
        $query = $pdo->query($sql);
        $patient = $query->fetchAll();

    } catch (PDOException $e) {
        echo '<div class="alert alert-danger">La requête  échouée: '.$e->getMessage().'</div>';

    }

} 

include ('views/view-patient.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($errors)) {

    $lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));
    $firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));
    $birthdate = trim(filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_STRING));
    $phone = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING));
    $mail = trim(filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL));


    // Champs Nom
    if (empty($lastname)) {
        $lastname = $data->lastname;

    }   else {
        if (!preg_match($regStr, $lastname)) {
            $errors['lastnameError'] = 'Veuillez respecter le format requis';

        }
    }

    // Champs Prénom
    if (empty($firstname)) {
        $firstname = $data->firstname;

    }   else {
        if (!preg_match($regStr, $firstname)) {
            $errors['firstnameError'] = 'Veuillez respecter le format requis';

        }
    }

    // Champs Date de naissance
    if (empty($birthdate)) {
        $birthdate = $data->birthdate;

    }   else {
        if (!preg_match($regDate, $birthdate)) {
            $errors['birthdateError'] = 'Veuillez respecter le format requis';

        }
    }

    // Champs Téléphone
    if (!empty($phone)) {
        if (!preg_match($regPhone, $phone)) {
            $errors['phoneError'] = 'Veuillez respecter le format requis';

        }
    }   

    // Champs Email
    if (empty($mail)) {
        $mail = $data->mail;

    }   
    

    if (empty($errors)) {
        // Préparation de la requete d'ajout d'un nouveau patient
        $updatePatient = "UPDATE `patients` SET `lastname` = '$lastname', `firstname` = '$firstname', `birthdate` = '$birthdate', `phone` = '$phone', `mail` = '$mail' WHERE `id` = $id";

        // Exécution de la requête
        try {
            $query = $pdo->query($updatePatient);
            echo '<div class="alert alert-success">Patient modifié</div>';
            

        } catch (PDOException $e){
            echo '<div class="alert alert-danger">La requête  échouée: '.$e->getMessage().'</div>';
        }

    } else {
        if (!empty($errors)) {
            echo '<div class="alert alert-warning">Aucune modification effectuée</div>';
            include ('views/view-patient.php');
        }
        
    }
}

?>
