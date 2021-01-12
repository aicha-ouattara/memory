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
	<link rel="stylesheet" href="css/wof.css">
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
			<?php echo $avatar ; ?>
			<a href="profil_update.php">Modifie ton profil</a>
	

		</article>





		<article class="title_hall">
			<h1>Check ta progression dans l'univers des petits monstres</h1>
		</article>


		<form action="profil-utilisateur.php" method="post">
			<div class="form_level form-group col-md-4">
				<label for="nb_paires">Choisir le niveau</label>
				<select name="nb_paires" class="form-control">
					<option selected>3</option>
					<option>4</option>
					<option>5</option>
					<option>6</option>
					<option>7</option>
					<option>8</option>
					<option>9</option>
					<option>10</option>
					<option>11</option>
					<option>12</option>
				</select>
			</div>

			<div class="btn_level">
				<button type="submit" class="btn_level btn btn-primary">Sélectionner</button>
			</div>
		</form>

		<section class="container_table">

			<?php

			if (isset($_POST['nb_paires'])) {
				echo "<div class=\"div_data\" ><table class=\"table_data\">";
				$tab = Wof::users_progress_nb_paires($id, $_POST['nb_paires']);
				//var_dump($tab);
				if ($tab) {
					echo "<h3 class='best-user-score'> Ta progression</h3>";
					print_users_progress_score($tab);
				}
			} else {
				echo "<div class=\"div_data\" ><table class=\"table_data\">";
				$tab = Wof::users_progress_nb_paires($id, 3);
				//var_dump($tab);
				if ($tab) {
					echo "<h3 class='best-user-score'> Tes meilleures scores</h3>";
					print_users_progress_score($tab);
				}
			}

			echo "</div></table>";
			?>






		</section>



		<div class="play">
			<a href="level_choice.php">
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