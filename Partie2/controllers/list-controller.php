<?php

// Afficher la liste des patients
try {
    $sql = 'SELECT * FROM `patients`';
    $query = $pdo->query($sql);
    $patients = $query->fetchAll();

} catch (PDOException $e) {
    echo '<div class="alert alert-danger">La requête  échouée: '.$e->getMessage().'</div>';

}

?>

<div>

    <table class="table table-hover mt-4">
        <thead>
            <th scope="col"></th>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
            <th scope="col">Prénom</th>
            <th scope="col">Date de naissance</th>
            <th scope="col">Téléphone</th>
            <th scope="col">Email</th>
        </thead>
        <tbody>

            <?php foreach($patients as $patient): ?>
            <tr>
                <td><a href="profil-patient.php?id=<?=htmlentities($patient->id)?>"><i class="far fa-edit"></i></a></td>
                <td><?= htmlentities($patient->id) ?></th>
                <td><?= htmlentities($patient->lastname) ?></td>
                <td><?= htmlentities($patient->firstname)?></td>
                <td><?= htmlentities($patient->birthdate) ?></td>
                <td><?= htmlentities($patient->phone) ?></td>
                <td><?= htmlentities($patient->mail) ?></td>
                
            </tr>
            <?php endforeach ?>
            
        </tbody>
    </table>

</div>


