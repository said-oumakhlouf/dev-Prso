<?php
session_start();
define("URL", str_replace("index.php","",(isset($_SERVER['HTTPS']) ? "https" : "http")."://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

use App\Controllers\UserController;
use App\Controllers\LivresController;

require_once realpath("vendor/autoload.php");

$livreController = new LivresController;
$userController = new UserController;

try{
    if(empty($_GET['page'])){
        $livreController->afficherAccueil();
    } else {
        $url = explode("/", filter_var($_GET['page']), FILTER_SANITIZE_URL);
        
        switch($url[0]){
            case "accueil" : $livreController->afficherAccueil();
            break;
            case "livres" : 
                if(empty($url[1])){
                    $livreController->afficherLivres();
                } elseif($url[1] === 'l') {
                    $livreController->afficherLivre($url[2]);
                } elseif($url[1] === 'a') {
                    $livreController->ajoutLivre();
                } elseif($url[1] === 'm') {
                    $livreController->modificationLivre($url[2]);
                } elseif($url[1] === 's') {
                    $livreController->suppressionLivre($url[2]);
                } elseif($url[1] === 'av') {
                    $livreController->ajoutLivreValidation();
                } elseif($url[1] === 'mv') {
                    $livreController->modificationLivreValidation();
                } else {
                    throw new \Exception("La page n'existe pas !");
                }
            break;
            default : throw new \Exception("La page n'existe pas !");
            case "register" : $userController->signup();
            break;
            case "login" : $userController->afficherSignin();
            break;
            case "check_login" : $userController->signin();
            break;
            case "logout" : $userController->logout();
            break;
        }
    }
}
catch(\Exception $e){
    $msg = $e->getMessage();
    require 'src/views/error.view.php';
}