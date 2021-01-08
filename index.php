<?php
	include 'Card.php';


	// Demarrage session
	session_start();
	//session_destroy();


				///////// Initialisation partie //////////

	// Si début de partie, utiliser le GET (level) pour créer la grille
	if (isset($_GET['level']) && !isset($_SESSION['grid'])) {
		$_SESSION['grid'] = new Memory($_GET['level'], );
		// enregistrement du niveau
		$_SESSION['level'] = $_GET['level'];

	}
	// Si information de mode de jeu
	if (isset($_GET['mode'])) {
		// enregistrement chelem
		$_SESSION['mode'] = $_GET['mode'];
	}
	// Sinon c'est que la partie est en cours et on la récupère de la session
	$grid = $_SESSION['grid'];


				////////// Options de partie ///////

	// Si le user veut rejouer la partie
	if (isset($_POST['restart'])) {
		session_destroy();
		if (isset($_SESSION['mode']) && $_SESSION['mode'] == 'chelem') {
			header('Location: ?level=3');
		}else {
			header('Location: ?level='.$_SESSION['level']);
		}
	}

	// Si le user a gagné -> retour au menu principal
	if (isset($_POST['menu'])) {
		session_destroy();
		header('Location: index.php');
	}

	// Si le user a gagné et est dans un grand chelem
	// On passe au niveau suivant en automatique
	if (isset($_POST['next']) && isset($_SESSION['mode']) && $_SESSION['mode'] == 'chelem') {
		session_destroy();
		header('Location: ?level='.($_SESSION['level']+1));
	}

				////////// Update de la partie ///////////

	// Si retour de carte cliquée
	if (isset($_POST['card'])) {
		// Mise à jour de la grille en envoyant la position de la carte sélectionnée
		$finished = $grid->update($_POST['card']);
		// Vérif si grille terminée
		if ($finished) {
			// Récupération du temps / coups / score de la partie

			// Si utilisateur connecté
				// On ajoute la partie à la base

			// Suppression de la partie
			$_SESSION['grid'] = Null;

			// Redirection sur le wall of fame
		}
	}



	echo "<pre>";
	//echo "Get :";
	//var_dump($_GET);
	//echo "Post :";
	//var_dump($_POST);
	//echo "Session :";
	//var_dump($_SESSION);
	echo "</pre>";


?>

<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<base href="/">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="memory/master.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<title>Play !</title>
</head>
<body>
	<form action="memory/#" method="post">
		<?php
		if (isset($finished) && $finished) {
			echo "Bravo !";
			if (isset($_SESSION['mode']) && $_SESSION['mode'] == 'chelem') {
				echo "<button class='btn btn-primary' name='next' type='submit' value='1'>Niveau suivant</button>";
			}
			else {
				echo "<button class='btn btn-primary' name='menu' type='submit' value='1'>Retourner au menu</button>";
			}

		}
		else {
			$grid->printMemory();
			echo "<button class='btn btn-primary' name='restart' type='submit' value='1'>Rejouer</button>";
		}
		?>

	</form>


	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
