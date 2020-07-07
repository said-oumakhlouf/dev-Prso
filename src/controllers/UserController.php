<?php 

namespace App\Controllers;

use App\Models\UserManager;

class UserController
{
    private $userManager;
    
    public function __construct()
    {
        $this->userManager = new UserManager;
    }

    public function signup()
    {
        if(isset($_POST['submit']))
        {
            $username = htmlspecialchars($_POST['username']);
            $email = htmlspecialchars($_POST['email']);
            $email2 = htmlspecialchars($_POST['email2']);
            $password = \md5($_POST['password']);
            $confirm_password = \md5($_POST['confirm_password']);
            
            if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['email2']) && !empty($_POST['password']) && !empty($_POST['confirm_password']))
            {
                $usernameLength = strlen($username);
                if($usernameLength <= 60)
                {
                    $userManager = new UserManager;
                    if($userManager->getUser($username) == 0)
                    {
                        if($email == $email2)
                        {
                            if(\filter_var($email, \FILTER_VALIDATE_EMAIL))
                            {
                                $userManager = new UserManager;
                                if($userManager->getEmail($email) == 0)
                                {
                                    if($password == $confirm_password)
                                    {
                                        $userManager = new UserManager;
                                        $userManager->register($username, $email,$password);
                                        $success = "Votre compte à bien été crée !";
                                    }
                                    else
                                    {
                                        $erreur = "Vos mots de passes ne correspondent pas !";
                                    }
                                }
                                else 
                                {
                                    $erreur = "Cet email existe déjà !";
                                }
                            }
                            else
                            {
                                $erreur = "Votre adresse mail n'est pas valide !";
                            }
                        }
                        else
                        {
                            $erreur = "Vos adresses mail ne correspondent pas !";
                        }
                    }
                    else
                    {
                        $erreur = "Cet utilisateur existe déjà !";
                    }
                }
                else 
                {
                    $erreur = "Votre pseudo ne doit pas dépassé 60 caractères !";
                }
            }
            else 
            {
                $erreur = "Tous les champs doivent être complétés !";
            }
        }
        require 'src/views/register.view.php';
    }

    public function afficherSignin()
    {
        require "src/views/login.view.php";
    }

    public function signin()
    {
    
        $userConnect = \htmlspecialchars($_POST['userConnect']);
        $passConnect = \md5($_POST['passConnect']);

        if(!empty($userConnect) && !empty($passConnect))
        {
            $userManager = new UserManager;
            $userDb = $userManager->login($userConnect);
            
            if(\password_verify($passConnect, $userDb['password']))
            {
                $_SESSION['user_session'] = $userDb['id'];
                $_SESSION['admin'] = $userDb['admin'];
                \header('Location:accueil?id='.$userDb['id']);
            }
            else 
            {
                $erreur = "Mauvais pseudo ou mot de passe !";
            }
        }
        else
        {
            $erreur = "Tous les champs doivent être complétés !";
        }
        require "src/views/login.view.php";
    }

    public function logout()
    {
        session_destroy();
        unset($_SESSION['user_session']);
        \header("Location: accueil");        
    }
}