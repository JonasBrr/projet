<?php session_start(); 
if($_SERVER['REQUEST_URI'] === "/login.php"){
    #l'utilisateur souhaite accéder à la page de login, on le laisse faire
}
else if(isset($_SESSION['logon']) &&  $_SESSION['logon'] === true){
    # l'utilisateur demande une page différente de /login.php et il est authentifié
    # on le laisse passer
} else {
    # sinon on le redirige vers /login.php et ON ARRÊTE l'exécution du script
    header('Location: /index.php');
    die();
}
    require('../helper/connection.php');
    $L = $pdo->prepare('SELECT * FROM etablissement');
    $successl = $L->execute();
    $lycees = $L->fetchAll(PDO::FETCH_ASSOC);
    require('../helper/head.php')
?>
<body style="background-image: url('/assets/fond.jpeg'); background-repeat: no-repeat; background-attachment: fixed; background-size: 100% 100%;">
    <nav class="navbar navbar-expand-lg bg-light" style="position: relative; top: 0px;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Liste des lycées</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="index.php">Accueil</a>
                    <a href="/logout.php" class="nav-link">Se deconnecter</a>
                </div>
            </div>
        </div>
    </nav>
    <div style="width:auto;margin-left:3%; margin-top:2%; font-size:20px;">
        <h2>Lycées<br></h2>
        <ul>
            <?php foreach ($lycees as $key => $lycee): ?>
                <li><a href="/lycee_edit.php?id=<?= $lycee['id']?>"><?= $lycee['nom'] ?></a></li>
            <?php endforeach ?> 
        </ul>
    </div>