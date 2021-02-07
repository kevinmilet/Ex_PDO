<div class="container">
    <div class="row mx-5">
        <form action="" method="POST" id="add-patient-form">

            <div class="row">
                
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="lastname">Nom</label>
                    <input class="form-control" type="text" name="lastname" id="lastname">
                    <p class="text-danger fst-italic"><?= $errors['lastnameError'] ?? '' ?></p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="firstname">Prénom</label>
                    <input class="form-control" type="text" name="firstname" id="firstname">
                    <p class="text-danger fst-italic"><?= $errors['firstnameError'] ?? '' ?></p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="birthdate">Date de naissance</label>
                    <input class="form-control" type="date" name="birthdate" id="birthdate">
                    <p class="text-danger fst-italic"><?= $errors['birthdateError'] ?? '' ?></p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="phone">Téléphone</label>
                    <input class="form-control" type="text" minlenght="10" maxlength="10" name="phone" id="phone">
                    <p class="text-danger fst-italic"><?= $errors['phoneError'] ?? '' ?></p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="mail">Email</label>
                    <input class="form-control" type="email" name="mail" id="mail">
                    <p class="text-danger fst-italic"><?= $errors['mailError'] ?? '' ?></p>
                </div>
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </div>
        </form>    
    </div>
</div>
