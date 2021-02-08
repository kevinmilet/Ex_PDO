<?php
$errors = [];

try {
    $sql = 'SELECT * FROM `patients`';
    $query = $pdo->query($sql);
    $patients = $query->fetchAll();

} catch (PDOException $e) {
    echo '<div class="alert alert-danger">La requête  échouée: '.$e->getMessage().'</div>';

}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($errors)) {

    $idPatients = trim(filter_input(INPUT_POST, 'patient', FILTER_SANITIZE_NUMBER_INT));
    $date = trim(filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING));
    var_dump($date);
    $hour = trim(filter_input(INPUT_POST, 'hour', FILTER_SANITIZE_STRING));

    if (empty($idPatients)) {
        $errors['idPatientsError'] = 'Ce champs est requis';
    
    }   else {

        if (!preg_match('/^[0-9]+$/', $idPatients)) {
            $errors['idPatientsError'] = 'ID patient invalide';
        }
    }

    if (empty($date)) {
        $errors['dateError'] = 'Ce champs est requis';

    }   else {
        if (!preg_match('/^([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))$/', $date)) {
            $errors['dateError'] = 'Date invalide';

        }
    }

    if (empty($hour)) {
        $errors['hourError'] = 'Ce champs est requis';

    }   else {
        if (!preg_match('/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/', $hour))
        $errors['hourError'] = 'Heure invalide';
        
    }

    if (empty($errors)) {
        // $dateHour = $date.' - '.$hour;
        $dateHour = new DateTime($date);
        var_dump($dateHour->format('Y-m-d H:i:s'));

        $addApptm = "INSERT INTO `appointments` (`dateHour`, `idPatients`)
                    VALUES ($dateHour, '$idPatients')";

        try {
            $query = $pdo->query($addApptm);
            echo '<div class="alert alert-success">Nouveau rendez-vous ajouté</div>';
            
        } catch (PDOException $e) {
            echo '<div class="alert alert-danger">La requête  échouée: '.$e->getMessage().'</div>';

        }

    }


}


