<?php
define('MYSQL_SERVEUR', 'localhost');
define('MYSQL_UTILISATEUR', 'root');
define('MYSQL_MOTDEPASSE', '');
define('MYSQL_BASE', 'memory');


class Wof
{
    private $id;
    private $time;
    private $grid;
    private $datetime;

    //Recuparation de toutes les infos du joueur
    public function users_profil_details()
    {
        $bdd = new PDO("mysql:host=" . MYSQL_SERVEUR . ";dbname=" . MYSQL_BASE . "", MYSQL_UTILISATEUR, MYSQL_MOTDEPASSE);
        $req = $bdd->prepare("SELECT games.time, games.grille, games.datetime, utilisateurs.login, utilisateurs.avatar FROM games INNER JOIN utilisateurs WHERE games.id_utilisateur = utilisateurs.id ");
        $req->execute();
        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        $bdd = NULL;
        return $resultat;
    }

    //Recuparation des infos de la progression du joueur par grid:niveau
    public function users_progress($grid)  //$grid ou $id ?
    {
        $bdd = new PDO("mysql:host=" . MYSQL_SERVEUR . ";dbname=" . MYSQL_BASE . "", MYSQL_UTILISATEUR, MYSQL_MOTDEPASSE);
        $req= $bdd->prepare("SELECT * FROM grille WHERE id_utilisateur = ? ORDER BY score.id DESC LIMIT 5");
        $req->execute([$grid]);
        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        $bdd = NULL;
        return $resultat;
    }


    //dix meilleurs parties par grille:niveau classé par temps
    public function top_10($grid)
    {
        $bdd = new PDO("mysql:host=" . MYSQL_SERVEUR . ";dbname=" . MYSQL_BASE . "", MYSQL_UTILISATEUR, MYSQL_MOTDEPASSE);
        $req = $bdd->prepare("SELECT games.grille, games.datetime, utilisateurs.login, utilisateurs.avatar, DATE_FORMAT(time, '%i:%s') AS time FROM games inner join utilisateurs on games.id_utilisateur =  utilisateurs.id
        WHERE grille = ? ORDER BY games.time ASC LIMIT 10 ");
        $req->execute([$grid]);
        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        $bdd = NULL;
        return $resultat;
    }

    //Les 3 dernieres parties qui ont été jouer
    public function three_last_games()
    {
        $bdd = new PDO("mysql:host=" . MYSQL_SERVEUR . ";dbname=" . MYSQL_BASE . "", MYSQL_UTILISATEUR, MYSQL_MOTDEPASSE);
        $req = $bdd->prepare("SELECT games.time, utilisateurs.login, utilisateurs.avatar FROM games INNER JOIN utilisateurs WHERE games.id_utilisateur = utilisateurs.id LIMIT 3");
        $req->execute();
        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        $bdd = NULL;
        return $resultat;
    }



}




$wof = new Wof();
echo "<pre>";
var_dump($wof->users_profil_details());
echo "</pre>";

echo "<pre>";
var_dump($wof->users_progress(6));
echo "</pre>";

echo "<pre>";
var_dump($wof->top_10(6));
echo "</pre>";

echo "<pre>";
var_dump($wof->three_last_games());
echo "</pre>";

?>
