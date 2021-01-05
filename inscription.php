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
    <title>Inscription</title>
</head>

<style>

.gifmonster{
    width: 93%;
}

body{
    background-image: linear-gradient(to right top, #a1bfec, #7abadc, #5db2c4, #54a9a5, #5b9d84);
}


</style>

<body>

    <header>
        <?php include("header.php"); ?>
    </header>

    <main>


        <div class="row ">

            <div class="col-4">
                <div class="container align-items center">
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
                    }?>
                </div>
            </div>
            <div class="col-5 ">
                <div class="container">

                    <form action="inscription.php" method="POST">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Login</label>
                            <input type="text" class="form-control" name="login" placeholder="Enter Login">
                        </div><br>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password"><br>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Confirmation Password</label>
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
                        <button type="submit" name="submit" class="btn btn-primary">S'inscrire</button>
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