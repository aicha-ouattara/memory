<?php
require_once 'wof.php';
session_start(); //Session connexion

$bdd =new PDO("mysql:host=localhost;dbname=memory","root","");

$req = $bdd->prepare( "SELECT avatar, login, time, score, grille, datetime as date FROM games INNER JOIN utilisateurs WHERE games.id_utilisateur = utilisateurs.id" );
$req->execute();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
    <title>top 10</title>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg ">
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link active" href="profil-utilisateur.php">Accueil </a>
                <a class="nav-item nav-link" href="inscription.php">Inscription</a>
                <a class="nav-item nav-link" href="connexion.php">Connexion</a>
                <a class="nav-item nav-link" href="connexion.php">Jouer</a>
            </div>
        </div>
    </nav>
</header>
<main>

<article class="best-user-score">
   <h2><span class="top-10-1">Top 10</span> des meilleurs petit monstres !</h2>
</article>
    <article class="table_class">
        <div>
            <table class="table_classement">
                <tr>
                    <th>Classement</th>
                </tr>
                <?php
                for ($i = 1; $i <= 10; $i++) {
                    echo "<tr>";
                    echo "<td class='td'>" . $i . "<td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>

        <?php
        $i = 0;

        echo "<div class=\"div_data\" ><table class=\"table_data\">";
        while ($result = $req->fetch(PDO::FETCH_ASSOC)) {
            if ($i == 0) {
                foreach ($result as $key => $value) {
                    echo "<th class=\"key\">$key</th>";
                }
                $i++;
            }
            echo "<tr>";
            foreach ($result as $key => $value) {
                echo "<td>" . $value . "</td>";
            }
            echo "</tr>";
        }

        echo "</div></table>";
        ?>

    </article>

    <div class="play">
        <a href="memory.php">
            <br><h4 class="title_play">A toi de jouer ! </h4>
        </a>
        <a href="#begin"><img src="img/arrowred.png" class="arrowred"></a>
    </div>



</main>
<footer></footer>
</body>
</html>

