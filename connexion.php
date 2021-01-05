<?php
session_start();

require_once 'class/user.php';

$user = new user;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>Connexion</title>
</head>

<body>

    <header>
        <?php include("header.php"); ?>
    </header>

    <main>
        <div class="row align-items-center">

            <div class="col-3">
                <?php

                if (isset($_POST['submit'])) {
                    $user->connect($_POST['login'], $_POST['password']);
                    $_SESSION['user'] = $user;
                }

                ?>
            </div>
            <div class="col-5 offset-1">
                <div class="container">

                    <form action="connexion.php" method="POST">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Login</label>
                            <input type="text" class="form-control" name="login" placeholder="Enter Login" >
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password"><br>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Se connecter</button>
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