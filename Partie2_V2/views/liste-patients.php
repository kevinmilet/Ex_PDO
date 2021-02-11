<!-- Vue affichage liste des patients -->
<div class="row">
    <h2 class="text-center">Liste des patients</h2>
    <div class="col mx-auto view-div">
        

        <table class="table table-hover mt-4">
            <thead>
                <th scope="col"></th>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Date de naissance</th>
                <th scope="col">Téléphone</th>
                <th scope="col">Email</th>
            </thead>
            <tbody>

                <?php foreach($patientsList as $patient): ?>
                <tr>
                    <td><a type="button" class="btn btn-primary btn-sm" href="/controllers/profil-patientCtrl.php?id=<?=htmlentities($patient->id)?>"><i class="far fa-user-edit"></i></a></td>
                    <td><?= htmlentities($patient->id) ?></th>
                    <td><?= htmlentities($patient->lastname) ?></td>
                    <td><?= htmlentities($patient->firstname)?></td>
                    <td><?= strftime('%d %B %Y', strtotime(htmlentities($patient->birthdate))) ?></td>
                    <td><?= htmlentities($patient->phone) ?></td>
                    <td><?= htmlentities($patient->mail) ?></td>

                </tr>
                <?php endforeach ?>

            </tbody>
        </table>
    </div>
</div>
