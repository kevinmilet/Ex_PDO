<?php
include ('views/templates/head.php');
?>
<h1 class="text-center m-3">Cabinet du Dr Lapeluche</h1>

<div >
    <ul class="nav flex-column">
        <li>
            <a class="nav-link" href="ajout-patient.php"><i class="fas fa-users-medical"></i> Ajouter un patient</a>
        </li>
        <li>
            <a class="nav-link" href="liste-patient.php"><i class="far fa-list-alt"></i> Liste des patients</a>
        </li>

    </ul>
    
</div>

<?php
include ('views/templates/footer.php');
?>