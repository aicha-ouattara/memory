<?php
require_once 'class/user.php';

session_start();

$user = new user;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css">
    <title>Connexion</title>
</head>

<body class="body-connexion">

    <header>
        <?php include("includes/header.php"); ?>
    </header>

    <main>

    <div class="row align-items-center">
        <h4 class="titreconn">Connexion à ton compte de petit monstre !</h4>
    </div>
        <div class="row align-items-center">
       
            <div class="col-4 ">
                <div class="container align-item center">
                    <?php

                    if (isset($_POST['submit'])) {
                        $user->connect($_POST['login'], $_POST['password']);
                        $_SESSION['user'] = $user;
                        header("location: profil-utilisateur.php");
                    }

                    ?>
                </div>
            </div>
          
            <div class="col-5 ">
                <div class="container">
        
                    <form action="connexion.php" method="POST">
                        <div class="form-group">
                            <label>Pseudo</label>
                            <input type="text" class="form-control" name="login" placeholder="Entre ton Pseudo">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Mot de passe</label>
                            <input type="password" class="form-control" name="password" placeholder="Entre ton mot de passe"><br>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Se connecter</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <?php include("includes/footer.php"); ?>
    </footer>

</body>

</html>