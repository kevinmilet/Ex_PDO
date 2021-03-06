<input type="hidden" id="pageType" value="2">

<!-- Affichage des erreurs et des messages -->
<?php
if(!empty($code) || $code = trim(filter_input(INPUT_GET, 'code', FILTER_SANITIZE_STRING))) {
    if(!array_key_exists($code, $msg)){
        $code = 0;
    }
    echo '<div class="alert '.$msg[$code]['type'].'">'.$msg[$code]['msg'].'</div>';
}
?>

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
                    <td><a type="button" class="btn btn-primary btn-sm"
                            href="/controllers/rendezvousCtrl.php?aptmt_id=<?=htmlentities($aptmt->idAptmt)?>"><i
                                class="fal fa-calendar-edit"></i></a></td>
                    <td><?= htmlentities($aptmt->lastname) ?></td>
                    <td><?= htmlentities($aptmt->firstname)?></td>
                    <td><?= ucwords(htmlentities($aptmt->date)) ?></td>
                    <td><?= htmlentities($aptmt->hour) ?></td>
                    <!-- <td><a href="/controllers/liste-rendezvousCtrl.php?aptmt_id=<?=htmlentities($aptmt->idAptmt)?>&delete=1"><i class="fas fa-minus-circle text-danger"></i></a></td> -->
                    <td><button type="button" class="btn del-btn" data-mdb-toggle="modal" data-mdb-target="#aptmt-del-confirm" data="<?=htmlentities($aptmt->idAptmt)?>"><i class="fas fa-minus-circle text-danger"></i></button></td>
                </tr>
                <?php endforeach ?>

            </tbody>
        </table>
    </div>
    <nav class="pt-3">
        <ul class="pagination">
            <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                <a class="page-link" href="?pageType=2&page=<?=$currentPage - 1 ?>&limit=<?= $_SESSION['limit'] ?>" tabindex="-1">Précedent</a>
            </li>
            <?php for ($page = 1; $page <= $pages; $page++): ?>
                <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                    <a href="?pageType=2&page=<?= $page ?>&limit=<?= $_SESSION['limit'] ?>" class="page-link"><?= $page ?></a>
                </li>
            <?php endfor ?>
            <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
                <a class="page-link" href="?pageType=2&page=<?=$currentPage + 1 ?>&limit=<?= $_SESSION['limit'] ?>">Suivant</a>
            </li>
            <li>
                <select name="limit" id="limit" class="form-control">
                    <option value="5" <?= $_SESSION['limit'] == 5 ? 'selected' : '';?>>5</option>
                    <option value="10" <?= $_SESSION['limit'] == 10 ? 'selected' : '';?>>10</option>
                    <option value="15" <?= $_SESSION['limit'] == 15 ? 'selected' : '';?>>15</option>
                    <option value="20" <?= $_SESSION['limit'] == 20 ? 'selected' : '';?>>20</option>
                </select>
            </li>
        </ul>
    </nav>

    <div class="col-md-12 text-center mt-3">
        <a href="/controllers/ajout-rendezvousCtrl.php" type="button" class="btn btn-primary">Ajouter un rendez-vous</a>
    </div>

</div>

<!-- Modale confirmation suppression rdv -->

<div class="modal fade" id="aptmt-del-confirm" tabindex="-1" aria-labelledby="aptmt-del-confirm-Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="modal-title" id="aptmt-del-confirm-Label">Voulez-vous vraiment supprimer ce rendez-vous ?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Annuler</button>
                <a type="button" class="btn btn-primary" id="confirm2">Confirmer</a>
            </div>
        </div>
    </div>
</div>