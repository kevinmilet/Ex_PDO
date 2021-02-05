<?php
$errors = [];
$regStr = '/^[a-zA-Zéèàùûêâôëç \'-]+$/';
$regDate = '/^([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))$/';
$regPhone = '/^[0-9 ]+$/';
$regMail = '/^[a-z0-9_.-]+@[a-z0-9]+.[a-z]{2,6}$/';


// Envoi du formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($errors)) {

    $lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));
    $firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));
    $birthdate = trim(filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_STRING));
    $phone = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING));
    $mail = trim(filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL));

    // Champs Nom
    if (empty($lastname)) {
        $errors['lastnameError'] = 'Ce champs est requis';

    }   else {
        if (!preg_match($regStr, $lastname)) {
            $errors['lastnameError'] = 'Veuillez respecter le format requis';

        }
    }

    // Champs Prénom
    if (empty($firstname)) {
        $errors['firstnameError'] = 'Ce champs est requis';

    }   else {
        if (!preg_match($regStr, $firstname)) {
            $errors['firstnameError'] = 'Veuillez respecter le format requis';

        }
    }

    // Champs Date de naissance
    if (empty($birthdate)) {
        $errors['birthdateError'] = 'Ce champs est requis';

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
        $errors['mailError'] = 'Ce champs est requis';

    }   else {
        if (!preg_match($regMail, $mail)) {
            $errors['mailError'] = 'Veuillez respecter le format requis';

        }
    }

    if (empty($errors)) {
        // Préparation de la requete d'ajout d'un nouveau patient
        $addPatient = "INSERT INTO `patients` (`lastname`, `firstname`, `birthdate`, `phone`, `mail`)
                        VALUES ('$lastname', '$firstname', '$birthdate', '$phone', '$mail')";

        // Exécution de la requête
        try {
            $query = $pdo->query($addPatient);
            echo '<div class="alert alert-success">Nouveau patient ajouté</div>';
            include ('views/form.php');

        } catch (PDOException $e){
            echo '<div class="alert alert-danger">'.$e->getMessage().'</div>';
        }

    } else {
        if (!empty($errors)) {
            echo '<div class="alert alert-warning">Aucun patient ajouté</div>';
            include ('views/form.php');
        }
        
    }
        
} else {

    include ('views/form.php');
}