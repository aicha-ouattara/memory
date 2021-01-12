<?php
require_once 'Wof.php';
require_once 'class/user.php';
session_start(); //Session connexion

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

function print_users_progress_score($tab)
{
	foreach ($tab[0] as $key => $value) {
		echo "<th class=\"key\">$key</th>";
	}

	echo "<tr>";
	foreach ($tab as $key => $line) {
		foreach ($line as $print) {
			echo "<td>" . $print . "</td>";
		}
		//echo "<td>" . $value . "</td>";
		echo "</tr>";
	}

	echo "</div></table>";
}

function print_users_progress($tab2)
{
	foreach ($tab2[0] as $key => $value) {
		echo "<th class=\"key\">$key</th>";
	}

	echo "<tr>";
	var_dump($tab2);
	foreach ($tab2 as $key => $line) {
		foreach ($line as $print) {
			echo "<td>" . $print . "</td>";
		}
		echo "</tr>";
	}
	echo "</div></table>";
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



            <!-- <div>
                <table class="table_classement">
                    <tr>
                        <th>Classement</th>
                    </tr>


                    // for ($i = 1; $i <= 3; $i++) {
                    //     echo "<tr>";
                    //     echo "<td>" . $i . "<td>";
                    //     echo "</tr>";
                    //}

                </table>
            </div> -->

			<?php
			echo "<div class=\"div_data\" ><table class=\"table_data\">";
			$tab = Wof::users_progress_score($id);
			//var_dump($tab);
			if ($tab) {
				echo "<h3 class='best-user-score'> Tes meilleures scores</h3><article class='table_class'>";
				print_users_progress_score($tab);
			}


			?>

        </article>




			<?php
			echo "<div class=\"div_data\" ><table class=\"table_data\">";
			$tab2 = Wof::users_progress($id);
			var_dump($tab2);
			if ($tab2) {
				echo "<h3 class='best-user-score'> Ta progression</h3><article class='table_class'>";
				print_users_progress($tab2);
			}




		// foreach ($tab2 as $key => $value) {
		//
		// 	if ($key == 0) {
		// 		foreach ($value as $col) {
		// 			echo "<th class=\"key\">$col</th>";
		// 		}
		// 	}else {
		// 		foreach ($value as $col) {
		// 			echo "<td>" . $col . "</td>";
		// 		}
		// 	}
		// 	echo "</tr>";
		// }



       // echo "<tr>";
       // foreach ($tab2 as $value) {
       //     echo "<td>" . $value . "</td>";
       // }


       //echo "</tr>";
       //echo "</div></table>";?>

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
