<!-- Vue affichage d'un rendez-vous -->
<div class="row">
    <h2 class="text-center">Détail du rendez-vous de <?=$appointment->firstname?> <?=$appointment->lastname?></h2>
    <div class="col-md-6 mx-auto">

        <div class="card mt-5">
            <div class="card-header">
                <h5 class="card-title">Le <?= $appointment->date?></h5>
                <div class="card-text">
                    <h6>à <?= $appointment->hour?> heure</h6>
                </div>
            </div>
            <div class="card-body">
                <h6>Détails du patient:</h6>
                <p>Nom: <?= $appointment->lastname?></p>
                <p>Prénom: <?= $appointment->firstname?></p>
                <p>Date de naissance: <?=strftime('%d %B %Y', strtotime($appointment->birthdate))?></p>
                <p>Téléphone: <?= $appointment->phone?></p>
                <p>Email: <?= $appointment->mail?></p>
            </div>
        </div>

    <!-- <div class="text-center m-3">
        <?= $feedback ?? ''?>
    </div> -->

    </div>

    <!-- Fenetre collapse pour modification rdv -->
    <div class="col-md-12 text-center mt-3">
        <a href="#update-rendezvousCtrl" data-mdb-toggle="collapse" type="button" class="btn btn-primary">Modifier le
            rendez-vous</a>
    </div>
    
    <div>
        <div class="collapse" id="update-rendezvousCtrl">
            <?php include(dirname(__FILE__).'/../views/update-rendezvous.php') ?>
        </div>
    </div>

</div>