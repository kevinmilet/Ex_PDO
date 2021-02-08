<?php
    $dsn = 'mysql:dbname=colyseum;host=localhost';
    $user = 'colyseum';
    $password = 'Zlwry3IY88iH31qB';

    try {
        $pdo = new PDO($dsn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

    } catch (PDOException $e) {
        echo 'Echec de la connexion à la base de donnée: '.$e->getMessage();

    }


    // Ex 1 - Afficher tous les clients
    try {
        $sql = 'SELECT * FROM `clients`';
        $query = $pdo->query($sql);
        $clients = $query->fetchAll();

    } catch (PDOException $e) {
        echo 'La requête a échouée: '.$e->getMessage();

    }
    
    

    // Ex 2 - Afficher tout les types de spectacles
    try {
        $sql = 'SELECT * FROM `showtypes`';
        $query = $pdo->query($sql);
        $showTypes = $query->fetchAll();

    } catch (PDOException $e) {
        echo 'La requête a échouée: '.$e->getMessage();

    }

        // Bonus - Afficher tout les évenements

        try {
            $sql = 'SELECT * FROM `shows` LEFT JOIN `showtypes` ON `showtypes`.`id` = `shows`.`showTypesId` LEFT JOIN `genres` AS `firstGenre` ON `shows`.`firstGenresId` = `firstGenre`.`id` LEFT JOIN `genres` AS `secondGenre` ON `shows`.`secondGenreId` = `secondGenre`.`id`';
            $query = $pdo->query($sql);
            $shows = $query->fetchAll();
            
        } catch (PDOException $e) {
            echo 'La requête a échouée: '.$e->getMessage();
    
        }


    // Ex 3 - Afficher les 20 premiers clients
    try {
        $sql = 'SELECT * FROM `clients` LIMIT 20';
        $query = $pdo->query($sql);
        $first20Clients = $query->fetchAll();

    } catch (PDOException $e) {
        echo 'La requête a échouée: '.$e->getMessage();

    }
    
    
    // Ex 4 - Afficher que les clients qui ont une carte de fidélité
    try {
        $sql = 'SELECT * FROM `clients` WHERE `card` = 1';
        $query = $pdo->query($sql);
        $cardHolder = $query->fetchAll();

    } catch (PDOException $e) {
        echo 'La requête a échouée: '.$e->getMessage();
        
    }

    // Ex 5 - Afficher les clients sont le nom commence par M, Trier les noms par ordre alphabétique.

    try {
        $sql = 'SELECT * FROM `clients` WHERE `lastName` LIKE "M%" ORDER BY `lastName`';
        $query = $pdo->query($sql);
        $clientsByM = $query->fetchAll();

    } catch (PDOException $e) {
        echo 'La requête a échouée: '.$e->getMessage();
        
    }

    // Ex 6 - Afficher le titre de tous les spectacles ainsi que l'artiste, la date et l'heure. Trier les titres par ordre alphabétique. Afficher les résultat comme ceci : Spectacle par artiste, le date à heure.
    
    try {
        $sql = 'SELECT `title`, `performer`, `date`, `startTime` FROM `shows` ORDER BY `title`';
        $query = $pdo->query($sql);
        $events = $query->fetchAll();

    } catch (PDOException $e) {
        echo 'La requête a échouée: '.$e->getMessage();
        
    }


    // Ex 7 - Afficher tous les clients comme ceci :
    // Nom : Nom de famille du client
    // Prénom : Prénom du client
    // Date de naissance : Date de naissance du client
    // Carte de fidélité : Oui (Si le client en possède une) ou Non (s'il n'en possède pas)
    // Numéro de carte : Numéro de la carte fidélité du client s'il en possède une.
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>PDO - Partie 1</title>
</head>

<body>
    <div class="container-fluid">

        <div class="d-flex align-items-start">
            <div class="nav flex-column nav-pills me-3"  id="v-pills-tab" role="tablist">
                <a class="nav-link active" id="v-pills-clients-tab" data-bs-toggle="pill" href="#v-pills-clients" role="tab">Ex 1 - Liste des clients</a>
                <a class="nav-link" id="v-pills-shows-tab" data-bs-toggle="pill" href="#v-pills-shows" role="tab">Ex 2 - Types de spectacles</a>
                <a class="nav-link" id="v-pills-first20Clients-tab" data-bs-toggle="pill" href="#v-pills-first20Clients" role="tab">Ex 3 - 20 Premiers clients</a>
                <a class="nav-link" id="v-pills-cardHolder-tab" data-bs-toggle="pill" href="#v-pills-cardHolder" role="tab">Ex 4 - Porteurs de carte</a>
                <a class="nav-link" id="v-pills-clientsByM-tab" data-bs-toggle="pill" href="#v-pills-clientsByM" role="tab">Ex 5 - Nom commence par M</a>
                <a class="nav-link" id="v-pills-events-tab" data-bs-toggle="pill" href="#v-pills-events" role="tab">Ex 6 - Evénement</a>
                <a class="nav-link" id="v-pills-clientsFull-tab" data-bs-toggle="pill" href="#v-pills-clientsFull" role="tab">Ex 7 - Liste clients détaillée</a>
            </div>
        

            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-clients" role="tabpanel">

                    <table class="table table-striped">
                        <thead>
                            <th scope="col">ID</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                        </thead>
                        <tbody>

                            <?php foreach($clients as $client): ?>
                            <tr>
                                <th scope="row"><?= $client->id ?></th>
                                <td><?= $client->lastName ?></td>
                                <td><?= $client->firstName?></td>
                            </tr>
                            <?php endforeach ?>

                        </tbody>
                    </table>

                </div>

                <div class="tab-pane fade" id="v-pills-shows" role="tabpanel">

                    <table class="table table-striped">
                        <thead>
                            <th scope="col">ID</th>
                            <th scope="col">Type de spectacle</th>
                        </thead>
                        <tbody>

                            <?php foreach($showTypes as $type): ?>

                            <tr>
                                <th scope="row"><?= $type->id ?></th>
                                <td><?= $type->type ?></td>
                            </tr>

                            <?php endforeach ?>

                        </tbody>
                    </table>

                    <hr>

                    <!-- <table class="table table-striped">
                        <thead>
                            <th scope="col">Titre</th>
                            <th scope="col">Artiste</th>
                            <th scope="col">Date</th>
                            <th scope="col">Type de spectacle</th>
                            <th scope="col">Genre principal</th>
                            <th scope="col">Genre secondaire</th>
                            <th scope="col">Durée</th>
                            <th scope="col">Heure de début</th>
                        </thead>
                        <tbody>

                            <?php foreach($shows as $show): ?>
                            <tr>
                                <td><?= $show->title ?></th>
                                <td><?= $show->performer ?></td>
                                <td><?= $show->date?></td>
                                <td><?= $show->type ?></td>
                                <td><?= $show->firstgenre->id ?></td>
                                <td><?= $show->secondGenre->id ?></td>
                                <td><?= $show->duration ?></td>
                                <td><?= $show->startTime ?></td>
                            </tr>
                            <?php endforeach ?>

                        </tbody>
                    </table> -->

                </div>

                <div class="tab-pane fade" id="v-pills-first20Clients" role="tabpanel">

                    <table class="table table-striped">
                        <thead>
                            <th scope="col">ID</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">Date de naissance</th>
                            <th scope="col">Carte</th>
                            <th scope="col">Numéro de carte</th>
                        </thead>
                        <tbody>

                            <?php foreach($first20Clients as $client): ?>
                            <tr>
                                <th scope="row"><?= $client->id ?></th>
                                <td><?= $client->lastName ?></td>
                                <td><?= $client->firstName?></td>
                                <td><?= $client->birthDate ?></td>
                                <td><?= $client->card == '1'? 'Oui' : 'Non' ?></td>
                                <td><?= $client->cardNumber ?></td>
                            </tr>
                            <?php endforeach ?>

                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade" id="v-pills-cardHolder" role="tabpanel">

                    <table class="table table-striped">
                        <thead>
                            <th scope="col">ID</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">Date de naissance</th>
                            <th scope="col">Carte</th>
                            <th scope="col">Numéro de carte</th>
                        </thead>
                        <tbody>

                            <?php foreach($cardHolder as $holder): ?>
                            <tr>
                                <th scope="row"><?= $client->id ?></th>
                                <td><?= $holder->lastName ?></td>
                                <td><?= $holder->firstName?></td>
                                <td><?= $holder->birthDate ?></td>
                                <td><?= $holder->card == '1'? 'Oui' :'Non' ?></td>
                                <td><?= $holder->cardNumber ?></td>
                            </tr>
                            <?php endforeach ?>

                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade" id="v-pills-clientsByM" role="tabpanel">

                    <?php foreach($clientsByM as $client): ?>

                    <div>
                        <p><strong>Nom : </strong><?= $client->lastName ?></p>
                        <p><strong>Prénom : </strong><?= $client->firstName ?></p>
                        <hr>
                    </div>

                    <?php endforeach ?>

                </div>

                <div class="tab-pane fade" id="v-pills-events" role="tabpanel">

                    <?php foreach($events as $event): ?>

                    <ul>
                        <li><?= $event->title ?> par <?= $event->performer?>, le <?= $event->date ?> à <?= $event->startTime ?></li>
                    </ul>
                                    
                    <?php endforeach ?>

                </div>

                <div class="tab-pane fade" id="v-pills-clientsFull" role="tabpanel">

                    <table class="table table-striped">
                        <thead>
                            <th scope="col">ID</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">Date de naissance</th>
                            <th scope="col">Carte</th>
                            <th scope="col">Numéro de carte</th>
                        </thead>
                        <tbody>

                            <?php foreach($clients as $client): ?>
                            <tr>
                                <th scope="row"><?= $client->id ?></th>
                                <td><?= $client->lastName ?></td>
                                <td><?= $client->firstName?></td>
                                <td><?= $client->birthDate ?></td>
                                <td><?= $client->card == '1'? 'Oui' : 'Non' ?></td>
                                <td><?= $client->cardNumber ?></td>
                            </tr>
                            <?php endforeach ?>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous">
    </script>
</body>

</html>
