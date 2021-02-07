<?php
include ('views/templates/head.php');
?>

<div>
    <h1 class="text-center">Liste des patients</h1>
</div>

<?php
include ('controllers/list.php');
?>

<div class="text-center">
    <a href="#add-patient-form-collapse" role="button" data-bs-toggle="collapse"><i class="fas fa-plus"></i> Ajouter un nouveau patient</a>
    <a href="#" class="m-3"><i class="fas fa-sync-alt"></i> Recharger la liste</a>
    <div class="collapse" id="add-patient-form-collapse">
        <?php
        include ('controllers/add-patients.php');
        ?>
    </div>
</div>

<div class="text-center mt-3">
    <a href="index.php" type="button" class="btn btn-secondary mt-3">Retour à l'accueil</a>
</div>

<?php
include ('views/templates/footer.php');
?>