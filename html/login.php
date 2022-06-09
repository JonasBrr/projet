<?php require '../helper/head.php'; ?>
<body>
    <div class="pure-g">
        <!-- Page -->
        <div class="pure-u-7-8">
            <div class="container">
                <div style="color:red;">
                <?php if(isset($_POST['username']) && isset($_POST['passwd'])){ 
                    include('../helper/connection.php');
                    $query = $pdo->prepare('SELECT passwd FROM users WHERE username=:username');

                    $success = $query->execute([
                        "username" => $_POST['username']
                    ]);
                    $user = $query->fetch(PDO::FETCH_ASSOC);
                    if($user){
                        if($_POST['passwd'] === $user['passwd']){
                            session_start();
                            $_SESSION['logon'] = true;
                            header('Location: /lycee_list.php');
                        } else {
                            echo "Identifiant ou mot de passe erroné"; 
                        }
                    } else {
                        echo "Identifiant ou mot de passe erroné"; 
                    }
                }?></div>
                <?php if(isset($_SESSION['logon']) && $_SESSION['logon'] === true): ?> 
                    Vous êtes connecté !<br>
                    <a href="/logout.php" class="pure-button pure-button-primary">Se deconnecter</a>
                <?php else: ?>
                <h2>Connexion</h2>
                <form class="pure-form pure-form-aligned" action="/login.php" method="post">
                    <fieldset>
                        <div class="form-floating mb-3">
                            <input id="floatingInput" type="text" name="username" class="form-control" placeholder="Identifiant" />
                            <label for="floatingInput">Identifiant</label>
                        </div>
                        <div class="form-floating">
                            <input id="floatingPassword" type="password" name="passwd" class="form-control" placeholder="Mot de passe"/>
                            <label for="floatingPassword">Mot de passe</label>
                        </div>
                        <div class="pure-controls" style="margin-top:15px;">
                            <button type="submit" class="pure-button pure-button-primary">Connexion</button>
                        </div>
                    </fieldset>
                </form>
                <?php endif ?>
            </div>
        </div>
    </div>
</body>
</html>