<?php
include ('views/templates/head.php');
?>

<div>
    <h1 class="text-center m-3">Ajout d'un nouveau patient</h1>
</div>

<?php
include ('controllers/add-patient-controller.php');
?>


<div class="text-center mt-3">
    <a href="index.php" type="button" class="btn btn-secondary mt-3">Retour à l'accueil</a>
</div>

<?php
include ('views/templates/footer.php');
?>