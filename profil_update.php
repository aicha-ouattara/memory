<?php
require_once 'class/user.php';

session_start();

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}

$id = $user->getId();
$db = new PDO("mysql:host=" . MYSQL_SERVEUR . ";dbname=" . MYSQL_BASE . "", MYSQL_UTILISATEUR, MYSQL_MOTDEPASSE);

$data = $db->prepare("SELECT avatar FROM utilisateurs WHERE id = $id");
$data->execute(array($id));
$result = $data->fetch(PDO::FETCH_ASSOC);

foreach ($result as $value) {
    $avatar = "<img class=\"avatar\" src=\"img/$value.png\">";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>Modification profil</title>
</head>

<body>

    <header>
        <?php include("header.php"); ?>
    </header>

    <main>


        <div class="row justify-content-center">

            <div class="col-3">

                <h3> BONJOUR <?php echo $user->getLogin(); ?> ! </h3><br><br>

                <?php

                echo $avatar;

                if (isset($_POST['submit'])) {
                    $login = htmlspecialchars($_POST['login']);
                    $password = htmlspecialchars($_POST['password']);
                    $password_check = htmlspecialchars($_POST['password_check']);
                    $avatar =  $_POST['avatar'];

                    $user->update_profile($login, $password, $password_check, $avatar);
                } ?>

            </div>

            <div class="col-5 offset-1">
                <div class="container">
                    <h1>Modifier les données de votre profil</h1>

                    <form action="profil_update.php" method="POST">

                        <div class="form-group">
                            <label>Login</label>
                            <input type="text" class="form-control" name="login" placeholder="Enter Login">
                        </div><br>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password"><br>
                        </div>

                        <div class="form-group">
                            <label>Confirmation Password</label>
                            <input type="password" class="form-control" name="password_check" placeholder="Confirmation Password"><br>
                        </div><br>

                        <div class="form-group form-group-image-checkbox is-invalid">
                            <label>Choisis ton avatar</label>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="custom-control custom-radio image-checkbox">
                                        <input type="radio" class="custom-control-input" id="av1" name="avatar" value="1" checked>
                                        <label class="custom-control-label" for="av1">
                                            <img src="img/1.png" alt="#" class="img-fluid">
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="custom-control custom-radio image-checkbox">
                                        <input type="radio" class="custom-control-input" id="av2" name="avatar" value="2">
                                        <label class="custom-control-label" for="av2">
                                            <img src="img/2.png" alt="#" class="img-fluid">
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="custom-control custom-radio image-checkbox">
                                        <input type="radio" class="custom-control-input" id="av3" name="avatar" value="3">
                                        <label class="custom-control-label" for="av3">
                                            <img src="img/3.png" alt="#" class="img-fluid">
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="custom-control custom-radio image-checkbox">
                                        <input type="radio" class="custom-control-input" id="av4" name="avatar" value="4">
                                        <label class="custom-control-label" for="av4">
                                            <img src="img/4.png" alt="#" class="img-fluid">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Modifier mon profil</button>
                    </form>

                </div>
            </div>
        </div>
    </main>

    <footer>
        <?php include("footer.php"); ?>
    </footer>

</body>

</html>