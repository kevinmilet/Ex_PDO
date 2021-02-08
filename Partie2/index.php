<?php
include ('views/templates/head.php');
?>
<h1 class="text-center m-3">Cabinet du Dr Lapeluche</h1>

<div class="row mt-5">
    <div class="col text-center">
        <img src="assets/img/1h697p.jpg" alt="Docteur Lapeluche">
    </div>
    <div class="col">
        <ul class="nav flex-column">
            <li>
                <a class="nav-link" href="ajout-patient.php"><i class="fas fa-users-medical"></i> Ajouter un patient</a>
            </li>
            <li>
                <a class="nav-link" href="liste-patient.php"><i class="far fa-list-alt"></i> Liste des patients</a>
            </li>
            <li>
                <a class="nav-link" href="ajout-rendezvous.php"><i class="far fa-calendar-plus"></i> Nouveau rendez-vous</a>
            </li>

        </ul>
    </div>
</div>


<?php
include ('views/templates/footer.php');
?>