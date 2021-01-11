<?php


class Wof
{
    private $id;
    private $time;
    private $grid;
    private $datetime;
    private $score;
    private $id_utilisateur;

    public static function insert_wof($time, $grid, $datetime, $score, $id_utilisateur)
    {
        $db = new PDO("mysql:host=" . MYSQL_SERVEUR . ";dbname=" . MYSQL_BASE . "", MYSQL_UTILISATEUR, MYSQL_MOTDEPASSE);
        $req_insert = $db->prepare("INSERT INTO games ( time , grille , datetime, score, id_utilisateur) VALUES (?, ?, ?, ?, ?)") ;
        $req_insert->execute([$time, $grid, $datetime, $score, $id_utilisateur]);
    }

    //Recuparation de toutes les infos du joueur : progression individuelle
    public static function users_profil_details()
    {
        $db = new PDO("mysql:host=" . MYSQL_SERVEUR . ";dbname=" . MYSQL_BASE . "", MYSQL_UTILISATEUR, MYSQL_MOTDEPASSE);
        $req = $db->prepare("SELECT login, time, score, grille, datetime as date  FROM games INNER JOIN utilisateurs WHERE games.id_utilisateur = utilisateurs.id");
        $req->execute();
        $resultat = $req->fetch(PDO::FETCH_ASSOC);
        $bdd = NULL;
        return $resultat;
    }

    //3 derniers meilleurs scores réalisés
    public static function users_progress_score($id)  //$grid ou $id ?
    {
        $db = new PDO("mysql:host=" . MYSQL_SERVEUR . ";dbname=" . MYSQL_BASE . "", MYSQL_UTILISATEUR, MYSQL_MOTDEPASSE);
        $req= $db->prepare("SELECT time as temps, score, grille as pairs , datetime as date  FROM games WHERE id_utilisateur = ? ORDER BY games.score DESC LIMIT 3");
        $req->execute([$id]);
        $resultat = $req->fetch(PDO::FETCH_ASSOC);
        $bdd = NULL;
        return $resultat;
    }
    //Les 3 dernieres parties qui ont été jouer par l'user par temps
    public static function users_progress($id)
    {
        $db = new PDO("mysql:host=" . MYSQL_SERVEUR . ";dbname=" . MYSQL_BASE . "", MYSQL_UTILISATEUR, MYSQL_MOTDEPASSE);
        $req = $db->prepare("SELECT time as temps, score, grille as pairs , datetime as date FROM games INNER JOIN utilisateurs WHERE games.id_utilisateur = ? ORDER BY games.time desc LIMIT 3");
        $req->execute([$id]);
        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        $bdd = NULL;
        return $resultat;
    }


    //dix meilleurs parties par grille:niveau classé par temps
    public function top_10_time($grid)
    {
        $db = new PDO("mysql:host=" . MYSQL_SERVEUR . ";dbname=" . MYSQL_BASE . "", MYSQL_UTILISATEUR, MYSQL_MOTDEPASSE);
        $req = $db->prepare("SELECT avatar, login, time as temps, score, grille, datetime as date  FROM games inner join utilisateurs on games.id_utilisateur =  utilisateurs.id
        WHERE grille = ? ORDER BY games.time ASC LIMIT 10 ");
        $req->execute([$grid]);
        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        $bdd = NULL;
        return $resultat;
    }

    //dix meilleurs parties par grille:niveau classé par score
    public function top_10_score($grid)
    {
        $db = new PDO("mysql:host=" . MYSQL_SERVEUR . ";dbname=" . MYSQL_BASE . "", MYSQL_UTILISATEUR, MYSQL_MOTDEPASSE);
        $req = $db->prepare("SELECT avatar, login, time as temps, score, grille, datetime as date FROM games inner join utilisateurs on games.id_utilisateur =  utilisateurs.id
        WHERE grille = ? ORDER BY games.score ASC LIMIT 10 ");
        $req->execute([$grid]);
        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        $bdd = NULL;
        return $resultat;
    }

    //Les 3 dernieres parties qui ont été jouer par id de la table game decroissant
    public function three_last_games()
    {
        $db = new PDO("mysql:host=" . MYSQL_SERVEUR . ";dbname=" . MYSQL_BASE . "", MYSQL_UTILISATEUR, MYSQL_MOTDEPASSE);
        $req = $db->prepare("SELECT avatar, login, time as temps, score, grille, datetime as date FROM games INNER JOIN utilisateurs WHERE games.id_utilisateur = utilisateurs.id ORDER BY games.id desc LIMIT 3");
        $req->execute();
        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        $bdd = NULL;
        return $resultat;
    }
}



$wof = new Wof();
//echo "<pre>";
//var_dump($wof->users_profil_details());
//echo "</pre>";
//
//echo "<pre>";
//var_dump($wof->users_progress_score(1));
//echo "</pre>";
//
//echo "<pre>";
//var_dump($wof->users_progress(1));
//echo "</pre>";
//
//echo "<pre>";
//var_dump($wof->top_10_time(6));
//echo "</pre>";

//echo "<pre>";
//var_dump($wof->top_10_score(6));
//echo "</pre>";

//echo "<pre>";
//var_dump($wof->three_last_games());
//echo "</pre>";
//
// echo "<pre>";
// var_dump($wof->insert_wof("OO:21:37", 3, "2021-01-11 12:42:31", 6, 6));
// echo "</pre>";



?>
