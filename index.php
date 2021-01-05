<?php
	include 'Card.php';


	// Demarrage session
	session_start();
	//session_destroy();

	// Si début de partie, utiliser le GET (nb de paires) pour créer la grille
	if (isset($_GET['pair']) && !isset($_SESSION['grid'])) {
		$_SESSION['grid'] = new Memory($_GET['pair']);
	}
	// Sinon c'est que la partie est en cours et on la récupère de la session
	$grid = $_SESSION['grid'];

	// Si retour de carte cliquée
	if (isset($_POST['card'])) {
		// Mise à jour de la grille en envoyant la position de la carte sélectionnée
		$grid->update($_POST['card']);
		// Vérif si grille terminée
			// Si oui -> niveau suivant?
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

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="master.css">
	<title>Play !</title>
</head>
<body>
	<form action="#" method="post">
		<?php $grid->printMemory() ?>

	</form>


	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
