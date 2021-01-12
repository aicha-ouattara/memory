<?php
require_once 'wof.php';
require_once 'class/user.php';
session_start(); //Session connexion



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

?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

	<link rel="stylesheet" href="css/index.css">
	<link rel="stylesheet" href="css/wof.css">
	<title>top 10</title>
</head>

<body>
	<header>
		<?php include "includes/header.php"; ?>
	</header>
	<main class="main_wof">

		<article class="best-user-score">
			<h2><span class="top-10-1">Top 10</span> des meilleurs petit monstres !</h2>
		</article>

		<form action="wall-of-fame.php" method="post">
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

			<div>
				<table>
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

			<div>

				<?php

				if (isset($_POST['nb_paires'])) {
					echo "<div class=\"div_data\" ><table class=\"table_data\">";
					$tab = Wof::top_10_score($_POST['nb_paires']);
					//var_dump($tab);
					if ($tab) {
						//echo "<h3 class='best-user-score'> Tes meilleures scores</h3><article class='table_class'>";
						print_users_progress_score($tab);
					}
				} else {
					echo "<div class=\"div_data\" ><table class=\"table_data\">";
					$tab = Wof::top_10_score(3);
					//var_dump($tab);
					if ($tab) {
						//echo "<h3 class='best-user-score'> Tes meilleures scores</h3><article class='table_class'>";
						print_users_progress_score($tab);
					}
				}

				?>

			</div>

		</section>
	</main>
	<footer>
		
		<?php include("includes/footer.php"); ?>
	</footer>
</body>

</html>