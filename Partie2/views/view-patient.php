<h1 class="text-center">Modification du patient</h1>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <form action="" method="POST">
                <?php foreach ($patient as $data): ?>
                    <input class="form-control mb-3" type="text" value="<?=htmlentities($data->lastname)?>" name="lastname">
                    <input class="form-control mb-3" type="text" value="<?=htmlentities($data->firstname)?>" name="firstname"> 
                    <input class="form-control mb-3" type="date" value="<?=htmlentities($data->birthdate)?>" name="birthdate">
                    <input class="form-control mb-3" type="text" value="<?=htmlentities($data->phone)?>" minlentght="10" maxlength="10" name="phone">
                    <input class="form-control mb-3" type="email" value="<?=htmlentities($data->mail)?>" name="mail">
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