<?php
	include 'Card.php';


	// Demarrage session
	session_start();
	//session_destroy();


				///////// Initialisation partie //////////

	// Si memory dans la session
	if (isset($_SESSION['grid']) && $_SESSION['grid'] != Null) {
		// Récupération de la partie débutée ou en cours
		$memory = $_SESSION['grid'];
	}
	// Sinon on génère une nouvelle grille avec le get
	else {
		if (isset($_GET['level']) && isset($_GET['mode'])) {
			$_SESSION['grid'] = new Memory($_GET['level'], $_GET['mode']);
			$memory = $_SESSION['grid'];
			$memory->beginGame();
		}
		else {
			$_SESSION['grid'] = new Memory(3, 'one');
			$memory = $_SESSION['grid'];
			$memory->beginGame();
		}
	}

				////////// Options de partie ///////

	// Si le user veut rejouer la partie
	if (isset($_POST['restart'])) {
		$memory->restart();
	}

	// Si le user a gagné -> retour au menu principal
	if (isset($_POST['menu'])) {
		$_SESSION['grid'] = Null;
		header('Location: index.php');
	}

	// Si le user a gagné et est dans un grand chelem
	// On passe au niveau suivant en automatique
	if (isset($_POST['next']) && $memory->getMode() == 'chelem') {
		//$_SESSION['grid'] = Null;
		$memory->nextLevel();
	}

				////////// Update de la partie ///////////

	// Si retour de carte cliquée
	if (isset($_POST['card'])) {
		// Mise à jour de la grille en envoyant la position de la carte sélectionnée
		$finished = $memory->update($_POST['card']);
		// Récupération du temps / tour / score de la partie
		$time = $memory->getTime();
		$turn = $memory->getTurn();
		$score = $memory->getScore();

		// Vérif si grille terminée
		if ($finished) {
			// Si utilisateur connecté
				// On ajoute la partie à la base

			// Suppression de la partie
			//$_SESSION['grid'] = Null;

			// Redirection sur le wall of fame
		}
	}


	//
	// echo "<pre>";
	// if (isset($turn)) {
	// 	echo 'Tour : '.$turn.'</br>';
	// }
	// if (isset($time)) {
	// 	echo 'Temps : '.$time.'</br>';
	// }
	// if (isset($score)) {
	// 	echo 'Score : '.$score.'</br>';
	// }
	//
	//
	// echo "memory :";
	// //var_dump($memory->getGrid());
	// //echo "Session :";
	// //var_dump($_SESSION);
	// echo "</pre>";


?>

<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- <base href="/"> -->
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="css/memory.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<title>Play !</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<form action="memory.php" method="post">

		<div class="container">

			<div class="row">
			<?php foreach ($memory->getGrid() as $key => $card): ?>
				<?php if ($card->flip && $card->validated): ?>
					<div class="col"><button class='btn btn-primary <?php echo $card->value ?>' name='card' type='submit' value='<?php echo $key ?>' disabled></button></div>
				<?php elseif ($card->flip && !$card->validated): ?>
					<div class="col"><button class='btn btn-primary <?php echo $card->value ?>' name='card' type='submit' value="<?php echo $key ?>"></button></div>
				<?php else: ?>
					<div class="col"><button class='btn btn-primary hidden' name='card' type='submit' value="<?php echo $key ?>"></button></div>
				<?php endif; ?>

			<?php endforeach; ?>
			</div>

			<div class="d-flex justify-content-center">
				<?php if (isset($finished) && $finished): ?>
					<h1>Bravo!</h1>
					<h2>Partie terminée</h2>
					<?php if ($memory->getMode() == 'chelem'): ?>
						<div class="col"><button class='btn btn-primary' name='next' type='submit' value='1'>Niveau suivant</button></div>
					<?php else: ?>
						<div class="col"><button class='btn btn-primary' name='menu' type='submit' value='1'>Retourner au menu</button></div>
					<?php endif; ?>
				<?php else: ?>
					<div class="col"><button class='btn btn-primary' name='restart' type='submit' value='1'>Rejouer</button></div>
				<?php endif; ?>
			</div>

		</div>
	</form>


	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<?php include "includes/footer.php"; ?>
</body>
</html>
