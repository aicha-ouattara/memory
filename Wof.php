<?php

class Wof
{
    private $id;
    private $time;
    private $grille;
    private $datetime;

    public function __construct()
    {
        $this->id;
        $this->time;
        $this->grille;
        $this->datetime;
    }

    public function profil_utilisateur()
    {
        $bdd = new PDO("mysql:host=localhost;dbname=memory", "root", "");
        $req = $bdd->prepare("SELECT games.time, games.grille, games.datetime, utilisateurs.login FROM games INNER JOIN utilisateurs WHERE games.id_utilisateur = utilisateurs.id ");
        $req->execute();
        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        $bdd = NULL;
        return $resultat;
    }

    public function dix_meilleures_parties()
    {
        $bdd = new PDO("mysql:host=localhost;dbname=memory", "root", "");
        $req = $bdd->prepare("SELECT * FROM games ORDER BY time ASC LIMIT 10 ;");
        $req->execute();
        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        $bdd = NULL;
        return $resultat;
    }

  public function trois_dernieres_parties()
    {
        $bdd = new PDO("mysql:host=localhost;dbname=memory", "root", "");
        $req = $bdd->prepare("SELECT games.time, utilisateurs.login FROM games INNER JOIN utilisateurs WHERE games.id_utilisateur = utilisateurs.id LIMIT 3");
        $req->execute();
        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        $bdd = NULL;
        return $resultat;
    }



    /* public function Get_id($id)
     {
             $bdd =new PDO("mysql:host=localhost;dbname=reservationsalles","root","");
             $req =  $bdd->prepare("SELECT login, titre, description, debut, fin FROM reservations INNER JOIN utilisateurs ON reservations.id_utilisateur = utilisateurs.id WHERE reservations.id = $id");
             $req->execute(array($id));
             $users=$req->fetch(PDO::FETCH_ASSOC);
             if($users)
             {
                 $this->login = $users["login"];
                 $this->titre = $users["titre"];
                 $this->description = $users["debut"];
                 $this->debut  = $users["debut"];
                 $this->fin = $users["fin"];
                 return $users;
             }
     }*/

}

$wof = new Wof();
echo "<pre>";
var_dump($wof->profil_utilisateur());
echo "</pre>";

echo "<pre>";
var_dump($wof->dix_meilleures_parties());
echo "</pre>";

echo "<pre>";
var_dump($wof->trois_dernieres_parties());
echo "</pre>";

?>
