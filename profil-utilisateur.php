<?php
require_once 'wof.php';
session_start(); //Session connexion

$bdd =new PDO("mysql:host=localhost;dbname=memory","root","");

$req = $bdd->prepare( "SELECT  avatar, login, time, score, grille, datetime as date  FROM games INNER JOIN utilisateurs WHERE games.id_utilisateur = utilisateurs.id" );
$req->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
    <title>profil utilisateur</title>
</head>
<body>
<header>
    <nav>
    </nav>
</header>
<main>
    <article class="title_hall">
        <h1>Check ta progression dans l'univers des petits monstres</h1>

    </article>

    <article class="info">
        <h1>Ton Nom</h1>
        <h2>Ton Classement</h2>
    </article>
    <h3 class="best-user-score"> Tes meilleures scores</h3>
    <article class="table_class">
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

    <article class="detail-button">
      <img class="retour-button" src="images/retour.png">
        <a href="profil_update.php">Modifie ton profil</a>
    </article>

    <h3 class="best-user-score"> Ta progression</h3>

    <article class="table_class">
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

