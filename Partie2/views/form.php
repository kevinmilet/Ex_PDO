<h1 class="text-center m-3">Ajout d'un nouveau patient</h1>

<div class="container-form p-3">
    <form action="" method="POST">

        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-3 mb-3">
                <label class="form-label" for="lastname">Nom</label>
                <input class="form-control" type="text" name="lastname" id="lastname">
                <p class="text-danger fst-italic"><?= $errors['lastnameError'] ?? '' ?></p>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label" for="firstname">Prénom</label>
                <input class="form-control" type="text" name="firstname" id="firstname">
                <p class="text-danger fst-italic"><?= $errors['firstnameError'] ?? '' ?></p>
            </div>
            <div class="col-md-3"></div>
        </div>

        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-3 mb-3">
                <label class="form-label" for="birthdate">Date de naissance</label>
                <input class="form-control" type="date" name="birthdate" id="birthdate">
                <p class="text-danger fst-italic"><?= $errors['birthdateError'] ?? '' ?></p>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label" for="phone">Téléphone</label>
                <input class="form-control" type="text" minlenght="10" maxlength="10" name="phone" id="phone">
                <p class="text-danger fst-italic"><?= $errors['phoneError'] ?? '' ?></p>
            </div>
            <div class="col-md-3"></div>
        </div>

        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-3 mb-3">
                <label class="form-label" for="mail">Email</label>
                <input class="form-control" type="email" name="mail" id="mail">
                <p class="text-danger fst-italic"><?= $errors['mailError'] ?? '' ?></p>
            </div>
        </div>
        <div class="col-md-4"></div>
</div>
<div class="mt-3">
    <button type="submit" class="btn btn-primary">Enregistrer</button>
</div>
</form>

