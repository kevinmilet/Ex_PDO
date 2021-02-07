<?php
include ('views/templates/head.php');
?>
<h1>Cabinet du Dr Lapeluche</h1>

<div >
    <ul>
        <li>
            <a href="ajout-patient.php"><i class="fas fa-users-medical"></i> Ajouter un patient</a>
        </li>
        <li>
            <a href="liste-patient.php"><i class="far fa-list-alt"></i> Liste des patients</a>
        </li>
        <li>
            <a href="ajout-rendezvous.php"><i class="far fa-calendar-plus"></i> Nouveau rendez-vous</a>
        </li>

    </ul>
    
</div>

<?php
include ('views/templates/footer.php');
?>