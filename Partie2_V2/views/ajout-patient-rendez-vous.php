<div class="row">
    <div class="row">
        <h2 class="text-center">Ajouter un nouveau patient et un rendez-vous</h2>
        <form action="" method="POST">
            <div class="col-md-6 mx-auto">
                <div class="row view-div">
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
                </div>
            </div>
            <div class="col-md-6 mt-3 mx-auto">
                <h3 class="text-center">Rendez-vous</h3>
                <div class="row view-div">
                    <div class="col-md-6 mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" name="date" id="date"
                            value="<?=isset($_POST['date']) ? $_POST['date'] : ''?>" required>
                        <p class="text-danger fst-italic"><?= $errors['dateError'] ?? '' ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="hour" class="form-label">Heure</label>
                        <input type="time" class="form-control" min="08:00" max="20:00" name="hour" id="hour"
                            value="<?=isset($_POST['hour']) ? $_POST['hour'] : ''?>" required>
                        <p class="text-danger fst-italic"><?= $errors['hourError'] ?? '' ?></p>
                    </div>
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Ajouter le patient et le rendez-vous</button>
                    </div>
                </div>
        </form>
    </div>
</div>
