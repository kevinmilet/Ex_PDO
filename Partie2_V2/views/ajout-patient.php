<?php
if(!empty($code) || $code = trim(filter_input(INPUT_GET, 'code', FILTER_SANITIZE_STRING))) {
    if(!array_key_exists($code, $msg)){
        $code = 0;
    }
    echo '<div class="alert '.$msg[$code]['type'].'">'.$msg[$code]['msg'].'</div>';
}
?>

<!-- Vue ajout de patient -->
<div class="row">
    <div class="col-md-6 mx-auto">
        <h2 class="text-center">Ajouter un nouveau patient</h2>
        <form action="" method="POST" class="view-div">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label" for="lastname">Nom</label>
                    <input class="form-control" type="text" name="lastname" id="lastname" required
                        pattern="[A-Za-z-éèêëàâäôöûüùç\'. ]+" value="<?= $_POST['lastname'] ?? '' ?>">
                    <p class="text-danger fst-italic"><?= $errors['lastnameError'] ?? '' ?></p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="firstname">Prénom</label>
                    <input class="form-control" type="text" name="firstname" id="firstname" required
                        pattern="[A-Za-z-éèêëàâäôöûüùç\'. ]+" value="<?= $_POST['firstname'] ?? '' ?>">
                    <p class="text-danger fst-italic"><?= $errors['firstnameError'] ?? '' ?></p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="birthdate">Date de naissance</label>
                    <input class="form-control" type="date" name="birthdate" id="birthdate" required
                        value="<?= $_POST['birthdate'] ?? '' ?>">
                    <p class="text-danger fst-italic"><?= $errors['birthdateError'] ?? '' ?></p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="phone">Téléphone</label>
                    <input class="form-control" type="text" minlenght="10" maxlength="14" name="phone" id="phone"
                        pattern="(01|02|03|04|05|06|07|08|09)[ .-]?[0-9]{2}[ .-]?[0-9]{2}[ .-]?[0-9]{2}[ .-]?[0-9]{2}"
                        value="<?= $_POST['phone'] ?? '' ?>">
                    <p class="text-danger fst-italic"><?= $errors['phoneError'] ?? '' ?></p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="mail">Email</label>
                    <input class="form-control" type="email" name="mail" id="mail" required
                        value="<?= $_POST['mail'] ?? '' ?>">
                    <p class="text-danger fst-italic"><?= $errors['mailError'] ?? '' ?></p>
                </div>
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>

            </div>
        </form>
        <!-- <div class="text-center m-3">
            <?= $feedback ?? ''?>
        </div> -->
    </div>
</div>
