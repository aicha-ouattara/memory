<?php
require_once 'class/user.php';


if (isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
}

?>

<nav class="navbar navbar-expand-lg ">
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link active" href="index.php">Accueil </a>
      <a class="nav-item nav-link" href="level_choice.php">Jouer</a>
      <a class="nav-item nav-link" href="wall-of-fame.php">Classement</a>

      <?php
      if (isset($_SESSION['user'])) { ?>
        <a class="nav-item nav-link" href="profil-utilisateur.php">Profil</a>
        <a class="nav-item nav-link" href="deconnexion.php">Déconnexion</a>
      <?php } else { ?>
        <a class="nav-item nav-link" href="inscription.php">Inscription</a>
        <a class="nav-item nav-link" href="connexion.php">Connexion</a>
      <?php } ?>
    </div>
  </div>




  <audio controls="" loop>
    <source src="img/play_music.mp3" />
  </audio>
</nav>