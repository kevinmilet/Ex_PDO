<!-- Affichage des erreurs et des messages -->
<?php
if(!empty($code) || $code = trim(filter_input(INPUT_GET, 'code', FILTER_SANITIZE_STRING))) {
    if(!array_key_exists($code, $msg)){
        $code = 0;
    }
    echo '<div class="alert '.$msg[$code]['type'].'">'.$msg[$code]['msg'].'</div>';
}
?>

<!-- Vue affichage liste des patients -->
<h2 class="text-center">Liste des patients</h2>

<form action="" class="row m-3 align-items-center" method="GET">
    <div class="col-auto">
        <input type="search" class="form-control" name="search" id="search">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary">Rechercher</button>
    </div>
</form>

<div class="row">
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
                <th scope="col"></th>
            </thead>
            <tbody>

                <?php foreach($patientsList as $patient): ?>
                <tr>
                    <td><a type="button" class="btn btn-primary btn-sm"
                            href="/controllers/profil-patientCtrl.php?id=<?=htmlentities($patient->id)?>"><i
                                class="far fa-user-edit"></i></a></td>
                    <td><?= htmlentities($patient->id) ?></th>
                    <td><?= htmlentities($patient->lastname) ?></td>
                    <td><?= htmlentities($patient->firstname)?></td>
                    <td><?= strftime('%d %B %Y', strtotime(htmlentities($patient->birthdate))) ?></td>
                    <td><?= htmlentities($patient->phone) ?></td>
                    <td><?= htmlentities($patient->mail) ?></td>
                    <td><a href="/controllers/liste-patientsCtrl.php?id=<?=htmlentities($patient->id)?>&delete=1"><i
                                class="fas fa-minus-circle text-danger"></i></a></td>
                    <!-- <td><button type="button" class="btn" data-mdb-toggle="modal" data-mdb-target="#patient-del-confirm"><i class="fas fa-minus-circle text-danger"></i></a></td> -->
                </tr>
                <?php endforeach ?>

            </tbody>
        </table>
    </div>
    <nav class="pt-3">
        <ul class="pagination justify-content-center">
            <li>
                <form action="" methode="GET" class="row">
                    <div class="col-auto">
                        <select name="limit" id="limit" class="form-control">
                            <option value="5" <?= $limitSelected == 5 ? 'selected' : '';?>>5</option>
                            <option value="10" <?= $limitSelected == 10 ? 'selected' : '';?>>10</option>
                            <option value="15" <?= $limitSelected == 15 ? 'selected' : '';?>>15</option>
                            <option value="20" <?= $limitSelected == 20 ? 'selected' : '';?>>20</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Changer</button>
                    </div>
                </form>
                
            </li>
            <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                <a class="page-link" href="?page=<?=$currentPage - 1 ?>&limit=<?= $limitSelected ?>" tabindex="-1">Précedent</a>
            </li>
            <?php for ($page = 1; $page <= $pages; $page++): ?>
                <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                    <a href="?page=<?= $page ?>&limit=<?= $limitSelected ?>" class="page-link"><?= $page ?></a>
                </li>
            <?php endfor ?>
            <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
                <a class="page-link" href="?page=<?=$currentPage + 1 ?>&limit=<?= $limitSelected ?>">Suivant</a>
            </li>
        </ul>
    </nav>
</div>

<!-- Modale confirmation suppression patient -->

<div class="modal fade" id="patient-del-confirm" tabindex="-1" aria-labelledby="patient-del-confirm-Label"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="modal-title" id="patient-del-confirm-Label">Voulez-vous vraiment supprimer ce patientet ses
                    rendez-vous ?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Annuler</button>
                <a type="button" class="btn btn-primary"
                    href="/controllers/liste-patientsCtrl.php?id=<?=htmlentities($patient->id)?>&delete=1">Confirmer</a>
            </div>
        </div>
    </div>
</div>