<?php

require 'message.php';

define('MYSQL_SERVEUR', 'localhost');
define('MYSQL_UTILISATEUR', 'root');
define('MYSQL_MOTDEPASSE', 'root');
define('MYSQL_BASE', 'memory');

class user
{

    private $id;
    public $login;
    public $password;
    public $avatar;

    public function register($login, $password, $password_check, $avatar) //fonction pour l'inscription
    {

        //verification empty
        if (empty($login) or empty($password) or empty($password_check) or empty($avatar)) {
            $errors[] = "Tous les champs doivent être remplis.";
        }

        //Verification caractère login 
        $login_required = preg_match("/^(?=.*[A-Za-z]$)[A-Za-z][A-Za-z\-]{2,19}$/", $login);
        if (!$login_required) {
            $errors[] = "Le login doit comporter entre 3 et 19 caractères et ne doit contenir aucun caractère spécial (excepté -).";
        }

        //verification existence login
        $db = new PDO("mysql:host=" . MYSQL_SERVEUR . ";dbname=" . MYSQL_BASE . "", MYSQL_UTILISATEUR, MYSQL_MOTDEPASSE);
        $reqlogin = $db->prepare("SELECT * FROM utilisateurs WHERE login = ?");
        $reqlogin->execute(array($login));
        $loginexist = $reqlogin->rowCount();

        if ($loginexist == 1) {
            $errors[] = "Le login est déjà utilisé";
        }

        //verif Password (caractères et corresponance)
        $password_required = preg_match("/^(?=.*?[A-Z]{1,})(?=.*?[a-z]{1,})(?=.*?[0-9]{1,})(?=.*?[\W]{1,}).{8,20}$/", $password);
        if (!$password_required) {
            $errors[] = "Le mot de passe doit contenir: Entre 8 et 20 caractères avec au moins 1 caractère spécial, 1 majuscule, 1 minuscule et un chiffre.";
        }

        if ($password != $password_check) {
            $errors[] = "Les mots de passe ne correspondent pas.";
        } else {
            $passwordHash = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));
        }

        if (empty($errors)) {
            $insertDatabase = $db->prepare("INSERT INTO utilisateurs(login, password, avatar) VALUES(?, ?, ?)");
            $insertDatabase->execute(array($login, $passwordHash, $avatar));?>
        
            <div class="alert alert-success" role="alert">Bravo vous êtes officiellement un petit monstre !</div>
            <a href="connexion.php">Connexion à ton compte</a>
            <img src="https://media.giphy.com/media/27bK4xfPEEOvAheEgX/giphy.gif" alt="gifmonster" class="gifmonster">  
       <?php  
             
        } else {
            $message = new messages($errors);
            echo $message->renderMessage();
        }
    }

    public function connect($login, $password)
    {
        $db = new PDO("mysql:host=" . MYSQL_SERVEUR . ";dbname=" . MYSQL_BASE . "", MYSQL_UTILISATEUR, MYSQL_MOTDEPASSE);
        $requser = $db->prepare("SELECT * FROM utilisateurs WHERE login = ? ");
        $requser->execute(array($login));
        $user = $requser->fetch(PDO::FETCH_ASSOC);


        //verification empty
        // if (empty($login) or empty($password)) {
        //     $errors[] = "Tous les champs doivent être remplis.";
        // }

        // if ( $requser->rowCount() == 0 ) {
        //     $errors[] = "Login inexistant";
        // }

        // if (password_verify($password, $user['password'])==false) {
        //     $errors[] = "Mauvais mot de passe";
        // }

        // if (empty($errors)) {
        //     $this->id = $user['id'];
        //     $this->login = $user['login'];
        //     $this->password = $user['password'];
        //     header("Location: profil.php");
        // } else {
        //     $message = new messages($errors);
        //     echo $message->renderMessage();
        // }

        if (!empty($login) or !empty($password)) {

            if ($requser->rowCount() > 0) {
                if (password_verify($password, $user['password'])) {

                    $this->id = $user['id'];
                    $this->login = $user['login'];
                    $this->password = $user['password'];
                    header("Location: profil_update.php");
                } else {
                    $errors[] = "Mauvais login ou mot-de-passe";
                    $message = new messages($errors);
                    echo $message->renderMessage();
                }
            } else {
                $errors[] = "Mauvais login ou mot-de-passe";
                $message = new messages($errors);
                echo $message->renderMessage();
            }
        } else {
            $errors[] = "Tous les champs doivent être remplis.";
            $message = new messages($errors);
            echo $message->renderMessage();
        }
    }

    public function update_profile($login, $password, $password_check, $avatar)
    {

        if (empty($login) or empty($password) or empty($password_check)) {
            $errors[] = "Tous les champs doivent être remplis.";
        }

        //Verification caractère login 
        $login_required = preg_match("/^(?=.*[A-Za-z]$)[A-Za-z][A-Za-z\-]{2,19}$/", $login);
        if (!$login_required) {
            $errors[] = "Le login doit comporter entre 3 et 19 caractères et ne doit contenir aucun caractère spécial (excepté -).";
        }



        //verification existence login
        $db = new PDO("mysql:host=" . MYSQL_SERVEUR . ";dbname=" . MYSQL_BASE . "", MYSQL_UTILISATEUR, MYSQL_MOTDEPASSE);
        $reqlogin = $db->prepare("SELECT * FROM utilisateurs WHERE login = ?");
        $reqlogin->execute(array($login));
        $loginexist = $reqlogin->rowCount();


        if ($loginexist == 1 AND $login !=  $this->login) {
                 $errors[] = "Le login est déjà utilisé";

        }

        //verif Password (caractères et corresponance)
        $password_required = preg_match(
            "/^(?=.*?[A-Z]{1,})(?=.*?[a-z]{1,})(?=.*?[0-9]{1,})(?=.*?[\W]{1,}).{8,20}$/",
            $password
        );
        if (!$password_required) {
            $errors[] = "Le mot de passe doit contenir: Entre 8 et 20 caractères avec au moins 1 caractère spécial, 1 majuscule, 1 minuscule et un chiffre.";
        }

        if ($password != $password_check) {
            $errors[] = "Les mots de passe ne correspondent pas.";
        } else {
            $passwordHash = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));
        }

        if (empty($errors)) {
            $update = $db->prepare("UPDATE utilisateurs SET login = ? , password = ?, avatar = ? WHERE id = ?");
            $update->execute(array($login, $passwordHash, $avatar, $this->id));
            header("location:profil_update.php");
        }
         else {
            $message = new messages($errors);
            echo $message->renderMessage();
        }
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getId()
    {
        return $this->id;
    }

}

?>
