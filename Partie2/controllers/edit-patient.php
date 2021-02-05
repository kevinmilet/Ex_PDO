<?php

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
?>
<h1 class="text-center">Modification du patient</h1>

<div class="container mt-5">
    <?php foreach ($patient as $data): ?>
        <input class="form-control mb-3" type="text" value="<?=$data->lastname?>" readonly>
        <input class="form-control mb-3" type="text" value="<?=$data->firstname?>" readonly>
        <input class="form-control mb-3" type="text" value="<?=$data->birthdate?>" readonly>
        <input class="form-control mb-3" type="text" value="<?=$data->phone?>" readonly>
        <input class="form-control mb-3" type="text" value="<?=$data->mail?>" readonly>
    <?php endforeach ?>
</div>


