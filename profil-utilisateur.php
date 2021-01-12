<?php
require_once 'Wof.php';
require_once 'class/user.php';

session_start(); //Session connexion

//$card = new Card;
//$wof = new Wof;
//var_dump($wof);
//$user = new User;

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}

$id = $user->getId();

// RECUP AVATAR
$db = new PDO("mysql:host=" . MYSQL_SERVEUR . ";dbname=" . MYSQL_BASE . "", MYSQL_UTILISATEUR, MYSQL_MOTDEPASSE);
$data = $db->prepare("SELECT avatar FROM utilisateurs WHERE id = $id");
$data->execute(array($id));
$result = $data->fetch(PDO::FETCH_ASSOC);

foreach ($result as $value) {
    $avatar = "<img class=\"avatar_profil\" src=\"img/$value.png\">";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link rel="stylesheet" href="css/index.css">
    <title>profil utilisateur</title>
</head>

<body>
    <header>
        <?php include("includes/header.php"); ?>
    </header>
    <main>

        <article class="title_hall">
            <h1>Profil</h1>
        </article>


        <article class="info">
            <h2><?php echo $user->getLogin(); ?> ! </h2>
            <h2>Ton Classement</h2>
        </article>

        <?php echo $avatar . "<br>"; ?>

        <div class="info_user">
            <a href="profil_update.php">Modifie ton profil</a>
        </div>

        <article class="title_hall">
            <h1>Check ta progression dans l'univers des petits monstres</h1>
        </article>

        <h3 class="best-user-score"> Tes meilleures scores</h3>
        <article class="table_class">

            <div>
                <table class="table_classement">
                    <tr>
                        <th>Classement</th>
                    </tr>

                    <?php
                    for ($i = 1; $i <= 3; $i++) {
                        echo "<tr>";
                        echo "<td>" . $i . "<td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
            <?php
            $db = new PDO("mysql:host=" . MYSQL_SERVEUR . ";dbname=" . MYSQL_BASE . "", MYSQL_UTILISATEUR, MYSQL_MOTDEPASSE);
            $req= $db->prepare("SELECT time as temps, score as nb_coup, grille as pairs , datetime as date  FROM games WHERE id_utilisateur = ? ORDER BY games.score asc limit 3");
            $req->execute([$id]);

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


        <h3 class="best-user-score"> Ta progression par temps</h3>

        <article class="table_class">
            <?php
            $db = new PDO("mysql:host=" . MYSQL_SERVEUR . ";dbname=" . MYSQL_BASE . "", MYSQL_UTILISATEUR, MYSQL_MOTDEPASSE);
            $req= $db->prepare("SELECT time as temps, score as nb_coup, grille as pairs , datetime as date  FROM games WHERE id_utilisateur = ? ORDER BY games.time asc limit 3");
            $req->execute([$id]);

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
                <br>
                <h4 class="title_play">A toi de jouer ! </h4>
            </a>
            <a href="#begin"><img src="img/arrowred.png" class="arrowred"></a>
        </div>


    </main>
    <footer>
        <?php include("includes/footer.php"); ?>
    </footer>
</body>

</html>
