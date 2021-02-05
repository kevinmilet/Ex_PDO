<h1 class="text-center">Modification du patient</h1>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <form action="" method="POST">
                <?php foreach ($patient as $data): ?>
                    <input class="form-control mb-3" type="text" value="<?=$data->lastname?>" name="lastname">
                    <input class="form-control mb-3" type="text" value="<?=$data->firstname?>" name="firstname"> 
                    <input class="form-control mb-3" type="date" value="<?=$data->birthdate?>" name="birthdate">
                    <input class="form-control mb-3" type="text" value="<?=$data->phone?>" name="phone">
                    <input class="form-control mb-3" type="email" value="<?=$data->mail?>" name="mail">
                <?php endforeach ?>
                <a href="liste-patient.php" type="button" class="btn btn-secondary">Annuler</a>
                <button type="submit" class="btn btn-primary">Modifier</button>
            </form>
        </div>
        <div class="col-md-6">
        </div>
    </div>
    
</div>