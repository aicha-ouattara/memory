<?php
require_once 'class/user.php';

session_start();

if (isset($_SESSION['grid']) && $_SESSION['grid'] != Null) {
	$_SESSION['grid'] = Null;
}

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}


$bd = new PDO("mysql:host=" . MYSQL_SERVEUR . ";dbname=" . MYSQL_BASE . "", MYSQL_UTILISATEUR, MYSQL_MOTDEPASSE);

$req = $bd->prepare("SELECT utilisateurs.login as Pseudo,  games.datetime as Date, games.grille as Grille, DATE_FORMAT(time, '%i:%s') AS Chrono, games.score as Score  FROM games inner join utilisateurs on games.id_utilisateur =  utilisateurs.id ORDER BY games.score DESC LIMIT 10 ");
$req->execute();





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css">
    <title>Accueil</title>
</head>

<body>

    <header>
        <div id="begin"></div>

        <?php include("includes/header.php"); ?>

        <section class="home">

            <div><img src="img/monsterred.png" class="monster"></div>
            <div>
                <h1>MONSTER MEMORY</h1>
                <a href="memory.php">
                    <h4 class="button_play">JOUER !</h4>
                </a>
            </div>
            <div><img src="img/yellow.png" class="monster"></div>
        </section>

        <a href="#container_home"><img src="img/arrow.png" class="arrow"></a>

    </header>

    <main>

        <section id="container_home">
            <article class="presentation">
                <div class="dialogue">
                    <h2> <br>Bienvenue sur la planête des monstres gentils ! </h2>
                    <p>J'espere que tu a fais bon voyage jusqu'a notre planète... Nous sommes ici, moi et mes copains monstres, pour entrainer ta mémoire tout en s'amusant ! <br> Amuse toi bien et reviens nous voir quand tu veux! </p>
                </div>
            </article>

            <article>
                <img src="img/green.png" class="poulpevert">
            </article>

            <a href="#classement"><img src="img/arrow2.png" class="arrow2"></a>
        </section>

        <section id="classement">

            <article class="title_class">
                <div class="monster_class">
                    <img src="img/bluemonster.png" class="bluemonster">
                </div>
                <div class="container_title">
                    <h2>WALK OF FAME</h2>
                    <h3>Le classement des meilleurs petit monstres !</h3>
                </div>
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
                            echo "<td>" . $i . "<td>";
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


        </section>

    </main>

    <footer>
        <?php include("includes/footer.php"); ?>
    </footer>

</body>

</html>
