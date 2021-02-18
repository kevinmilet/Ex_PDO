<!-- Affichage des erreurs et des messages -->
<?php
if(!empty($code) || $code = trim(filter_input(INPUT_GET, 'code', FILTER_SANITIZE_STRING))) {
    if(!array_key_exists($code, $msg)){
        $code = 0;
    }
    echo '<div class="alert '.$msg[$code]['type'].'">'.$msg[$code]['msg'].'</div>';
}
?>

<!-- Vue ajout de rdv -->
<div class="row">
    <div class="col-md-6 mx-auto">
        <h2 class="text-center">Ajouter un nouveau rendez-vous</h2>
        <form action="" method="POST" class="view-div">

            <div class="row">

                <div class="col-md-4 mb-3">
                    <label for="patient" class="form-label">Patient</label>
                    <select class="form-control" name="patient" id="patient" required>
                            <option value="">Choisissez un patient</option>
                        <?php foreach ($patients as $patient): ?>
                            <option value="<?=htmlentities($patient->id)?>" <?=isset($_POST['patient']) && ($_POST['patient'] == $patient->id) ? 'selected' : ''?>><?=htmlentities($patient->firstname)?> <?=htmlentities($patient->lastname)?></option>
                        <?php endforeach ?>
                    </select>
                    <p class="text-danger fst-italic"><?= $errors['idPatientsError'] ?? '' ?></p>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" class="form-control" name="date" id="date" value="<?=isset($_POST['date']) ? $_POST['date'] : ''?>" required>
                    <p class="text-danger fst-italic"><?= $errors['dateError'] ?? '' ?></p>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="hour" class="form-label">Heure</label>
                    <input type="time" class="form-control" min="08:00" max="20:00" name="hour" id="hour" value="<?=isset($_POST['hour']) ? $_POST['hour'] : ''?>" required>
                    <p class="text-danger fst-italic"><?= $errors['hourError'] ?? '' ?></p>
                </div>
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Ajouter le rendez-vous</button>
                </div>

            </div>
        </form>
        <div class="text-center m-3">
            <?= $feedback ?? ''?>
        </div>
    </div>
</div>
