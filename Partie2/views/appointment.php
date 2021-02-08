<div class="container">
    <div class="row mx-5">
        <form action="" method="POST" id="add-patient-form">
            <div class="row">
                <div class="col">
                    <label for="patient" class="form-label">Patient</label>
                    <select class="form-control" name="patient" id="patient">
                            <option value=""></option>
                        <?php foreach ($patients as $patient): ?>
                            <option value="<?=htmlentities($patient->id)?>"><?=htmlentities($patient->lastname)?> <?=htmlentities($patient->firstname)?></option>
                        <?php endforeach ?>
                    </select>
                    <p class="text-danger fst-italic"><?= $errors['idPatientsError'] ?? '' ?></p>
                </div>
                <div class="col">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" class="form-control" name="date" id="date">
                    <p class="text-danger fst-italic"><?= $errors['dateError'] ?? '' ?></p>
                </div>
                <div class="col">
                    <label for="hour" class="form-label">Heure</label>
                    <input type="time" class="form-control" min="08:00" max="20:00" name="hour" id="hour">
                    <p class="text-danger fst-italic"><?= $errors['hourError'] ?? '' ?></p>
                </div>
            </div>
            <div class="mt-3">
                <a href="index.php" type="button" class="btn btn-secondary">Retour à l'accueil</a>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>
        </form>
    </div>       
</div>