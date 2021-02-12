<!-- Vue affichage liste des rendez-vous -->
<div class="row">
    <h2 class="text-center">Liste des rendez-vous</h2>
    <div class="col mx-auto view-div">
        

        <table class="table table-hover mt-4">
            <thead>
                <th scope="col"></th>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Date</th>
                <th scope="col">Heure</th>
                <th scope="col"></th>
            </thead>
            <tbody>

                <?php foreach($aptmtList as $aptmt): ?>
                <tr>
                <td><a type="button" class="btn btn-primary btn-sm" href="/controllers/rendezvousCtrl.php?aptmt_id=<?=htmlentities($aptmt->idAptmt)?>"><i class="fal fa-calendar-edit"></i></a></td>
                    <td><?= htmlentities($aptmt->lastname) ?></td>
                    <td><?= htmlentities($aptmt->firstname)?></td>
                    <td><?= htmlentities($aptmt->date) ?></td>
                    <td><?= htmlentities($aptmt->hour) ?></td>
                    <td><a href="/controllers/liste-rendezvousCtrl.php?aptmt_id=<?=htmlentities($aptmt->idAptmt)?>&delete=1"><i class="fas fa-minus-circle text-danger"></i></a></td>
                </tr>
                <?php endforeach ?>

            </tbody>
        </table>
    </div>

    <div class="col-md-12 text-center mt-3">
        <a href="/controllers/ajout-rendezvousCtrl.php" type="button" class="btn btn-primary">Ajouter un rendez-vous</a>
    </div>

</div>