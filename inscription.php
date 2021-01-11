<?php
require_once 'class/user.php';

$user = new user();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css">
    <title>Inscription</title>
</head>


<body>

    <header>
        <?php include("includes/header.php"); ?>
    </header>

    <main>


        <div class="row">

            <div class="col-5">
                <div class="mess container align-items center">
                    <h4>Inscription au pays des monstres gentils !</h4><br>

                    <?php

                    if (isset($_POST['submit'])) {
                        $errors = [];
                        $login = htmlspecialchars($_POST['login']);
                        $password = htmlspecialchars($_POST['password']);
                        $password_check = htmlspecialchars($_POST['password_check']);
                        $password_hash =  password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));
                        $avatar = $_POST['avatar'];

                        $user->register($login, $password, $password_check, $avatar);
                    }
                    else{
                        echo "<img src=\"img/hellobluemonster.png\" class=\"hellobluemonster_inscr\">";
                    }
                        
                        ?>
                  
                </div>
            </div>
            <div class="col-5">
                <div class="container">

                    <form action="inscription.php" method="POST">

                        <div class="form-group">
                            <label>Pseudo</label>
                            <input type="text" class="form-control" name="login" placeholder="Entre le pseudo">
                        </div><br>

                        <div class="form-group">
                            <label>Mot de Passe</label>
                            <input type="password" class="form-control" name="password" placeholder="Entre le mot de passe"><br>
                        </div>

                        <div class="form-group">
                            <label>Confirmation du mot de passe</label>
                            <input type="password" class="form-control" name="password_check" placeholder="Entre la confirmation du mot de passe"><br>
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
                        <br><button type="submit" name="submit" class="btn btn-primary">S'inscrire</button>
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