<?php
    require('../helper/connection.php');
    $L = $pdo->prepare('SELECT * FROM etablissement WHERE id=:id');
    $successl = $L->execute([
            "id" => $_GET["id"]
    ]);
    $lycee = $L->fetch(PDO::FETCH_ASSOC);
    $F = $pdo->prepare('SELECT * FROM formations WHERE id_etablissement=:id');
    $successf = $F->execute([
        "id" => $_GET["id"]
    ]);
    $forms = $F->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <title><?= $lycee["nature"]?> <?= $lycee["nom"]?></title>
</head>
    <body style="background-image: url('/assets/fond.jpeg'); background-repeat: no-repeat; background-attachment: fixed; background-size: 100% 100%;">
        <nav class="navbar navbar-expand-lg bg-light" style="position: relative; top: 0px;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Détails du lycée</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link" href="index.php">Accueil</a>
                        <a class="nav-link" href="#contact">Contact</a>
                    </div>
                </div>
            </div>
        </nav>
        <div>
            <div style="width:auto;margin-left:3%; margin-top:2%; font-size:20px;">
                <h2><?= $lycee["nature"]?> <?= $lycee["nom"]?><br></h2>
                <p>Adresse : <?= $lycee["adresse"]?>, <?= $lycee["ville"]?><br></p>
                <p>Téléphone : <?= $lycee["tel"]?><br></p>
                <p>Mail : <a href="mailto:<?= $lycee["mail"]?>" target="blank"><?= $lycee["mail"]?></a><br></P>
                <p>Site web : <a href="<?= $lycee["site_web"]?>"><?= $lycee["site_web"]?></a><br></p>
                <p>Proviseur : <?= $lycee["chef"]?><br></p>
                <p>Proviseur Adjoint : <?= $lycee["chef_adj"]?><br></p>
                <p>DDF : <?= $lycee["ddfpt"]?><br></p>
                <p>REE : <?= $lycee["ree"]?><br></p>
            </div>
            <div style="text-align:center;">
                <div id="map" style="height:350px; width:55%; margin-left:auto; margin-right:auto; margin-top:20px; margin-bottom:20px;"></div>
                <script >
                    var map = L.map('map').setView([<?= $lycee["latitude"]?>, <?= $lycee["longitude"]?>], 12);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                    }).addTo(map);

                    L.marker([<?= $lycee["latitude"]?>, <?= $lycee["longitude"]?>]).addTo(map)
                        .bindPopup('Lycée <?= $lycee["nom"]?><br> Adresse :<?= $lycee["adresse"]?>')
                </script> 
            </div>
            <div id="formations" style="width:auto;margin-left:3%; margin-top:2%; font-size:20px;">
                <h2>Formations<br></h2>
                <ul>
                    <?php foreach ($forms as $key => $form): ?>
                        <li><?= $form['nom'] ?></li>
                    <?php endforeach ?> 
                </ul>
            </div>
        </div>
        <?php require '../helper/bas.php'; ?>
</body>
</html>