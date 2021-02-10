<div class="row">
    <div class="col-md-6 mx-auto">
        <h2 class="text-center">Modifier un patient</h2>
        <form action="" method="POST" class="view-div">
            <div class="row p-3">
                <label class="form-label" for="lastname">Nom</label>
                <input class="form-control mb-3" type="text" id="lastname name="lastname" value="<?=htmlentities($patientSelected->lastname)?>">
                <label class="form-label" for="firstname">Prénom</label>
                <input class="form-control mb-3" type="text" id="firstname" name="firstname" value="<?=htmlentities($patientSelected->firstname)?>">
                <label class="form-label" for="birthdate">Date de naissance:</label>
                <input class="form-control mb-3" type="date" id="birthdate" name="birthdate" value="<?=htmlentities($patientSelected->birthdate)?>">
                <label class="form-label" for="phone">Téléphone:</label>
                <input class="form-control mb-3" type="text" minlentght="10" maxlength="14" id="phone" name="phone" value="<?=htmlentities($patientSelected->phone)?>">
                <label class="form-label" for="mail">Email:</label>
                <input class="form-control mb-3" type="email" id="mail" name="mail" value="<?=htmlentities($patientSelected->mail)?>">
                <p class="text-center">Remplissez les champs à modifier</p>
            </div>
            <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Modifier les informations</button>
                </div>
        </form>
        <div class="text-center m-3">
            <?= $feedback ?? ''?>
        </div>
    </div>
</div>