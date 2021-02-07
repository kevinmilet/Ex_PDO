<?php
include ('views/templates/head.php');

// Afficher la liste des patients
try {
    $sql = 'SELECT * FROM `patients`';
    $query = $pdo->query($sql);
    $patients = $query->fetchAll();

} catch (PDOException $e) {
    echo '<div class="alert alert-danger">La requête  échouée: '.$e->getMessage().'</div>';

}
?>

<h1 class="text-center m-3">Ajout d'un nouveau rendez-vous</h1>

<div class="container-form p-3">
    <form action="" method="POST">
        <label for="patient" class="form-label">Patient</label>
        <select class="form-control" name="patient" id="patient">
                <option value=""></option>
            <?php foreach ($patients as $patient): ?>
                <option value="<?=htmlentities($patient->id)?>"><?=htmlentities($patient->lastname)?> <?=htmlentities($patient->firstname)?></option>
            <?php endforeach ?>
        </select>
        <label for="date" class="form-label">Date</label>
        <input type="date" class="form-control name="meetDate">
        <label for="hour" class="form-label">Heure</label>
        <input type="time" class="form-control" min="08:00" max="20:00">
        
</div>
    <div class="mt-3">
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </div>
    </form>



<?php
include ('views/templates/footer.php');
?>