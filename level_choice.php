<?php

session_start();
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

<header>
	<?php include "includes/header.php"; ?>
</header>

<main class="main_level">
	<div class="container">
		<h1 class="title_level">Choisissez le niveau : Nombre de pairs</h1><br>
	</div>

<div class="container">
	<article class="level"> 

	<a href="memory.php?level=3&mode=one">3</a> 
	<a href="memory.php?level=4&mode=one">4</a>
	<a href="memory.php?level=5&mode=one">5</a>
	<a href="memory.php?level=6&mode=one">6</a>
	<a href="memory.php?level=7&mode=one">7</a>
	<a href="memory.php?level=8&mode=one">8</a>
	<a href="memory.php?level=9&mode=one">9</a>
	<a href="memory.php?level=10&mode=one">10</a>
	<a href="memory.php?level=11&mode=one">11</a>
	<a href="memory.php?level=12&mode=one">12</a>

	</article>
</div>

</main>


	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<?php include "includes/footer.php"; ?>

</body>

</html>