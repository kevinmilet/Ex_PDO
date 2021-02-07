<h1 class="text-center">Modification du patient</h1>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <form action="" method="POST">
                <?php foreach ($patient as $data): ?>
                    <p><strong>Nom: </strong><?=htmlentities($data->lastname)?></p>
                    <input class="form-control mb-3" type="text" name="lastname">
                    <p><strong>Prénom: </strong><?=htmlentities($data->firstname)?></p>
                    <input class="form-control mb-3" type="text" name="firstname">
                    <p><strong>Date de naissance: </strong><?=htmlentities($data->birthdate)?></p>
                    <input class="form-control mb-3" type="date" name="birthdate">
                    <p><strong>Téléphone: </strong><?=htmlentities($data->phone)?></p>
                    <input class="form-control mb-3" type="text" minlentght="10" maxlength="10" name="phone">
                    <p><strong>Email: </strong><?=htmlentities($data->mail)?></p>
                    <input class="form-control mb-3" type="email" name="mail">
                    <p>Remplissez les champs à modifier</p>
                <?php endforeach ?>
                <div class="m-3">
                    <a href="liste-patient.php" type="button" class="btn btn-secondary">Annuler</a>
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
                
            </form>
        </div>
        <div class="col-md-6">
        </div>
    </div>
    
</div>