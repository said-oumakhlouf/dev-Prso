<?php 
namespace App\Controllers;
use App\models\LivreManager;

class LivresController 
{
    private $livreManager;

    public function __construct(){
        $this->livreManager = new LivreManager;
        $this->livreManager->chargementLivres();
    }

    public function afficherAccueil(){
        require "src/views/accueil.view.php";
    }

    public function afficherLivres(){
        $livres = $this->livreManager->getLivres();
        require 'src/views/livres.view.php';
        unset($_SESSION['alert']);
    }

    public function afficherLivre($id){
        $livre = $this->livreManager->getLivreById($id);
        require 'src/views/afficherLivre.view.php';
    }

    public function ajoutLivre(){
        require 'src/views/ajoutLivre.view.php';
    }

    public function ajoutLivreValidation(){
        $file = $_FILES['image'];
        $repertoire = "src/public/images/";
        $nomImageAjoute = $this->ajoutImage($file,$repertoire);
        $this->livreManager->ajoutLivreBd($_POST['titre'], $_POST['nbPages'],$nomImageAjoute);
        
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Ajout réalisé"
        ];

        \header('Location: '. URL . 'livres');
    }

    public function suppressionLivre($id) {
        $nomImage = $this->livreManager->getLivreById($id)->getImage();
        \unlink("src/public/images/".$nomImage);
        $this->livreManager->suppressionLivreBd($id);
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Suppression réalisé"
        ];
        \header('Location: '. URL . 'livres');
    }

    public function modificationLivre($id){
        $livre = $this->livreManager->getLivreById($id);
        require 'src/views/modifierLivre.view.php';
    }

    public function modificationLivreValidation(){
        $imageActuelle = $this->livreManager->getLivreById($_POST['identifiant'])->getImage();
        $file = $_FILES['image'];

        if($file['size'] > 0){
            \unlink("src/public/images/".$imageActuelle);
            $repertoire = "src/public/images/";
            $nomImageToAdd = $this->ajoutImage($file,$repertoire);
        } else {
            $nomImageToAdd = $imageActuelle;
        }
        $this->livreManager->modificationLivreBd($_POST['identifiant'], $_POST['titre'], $_POST['nbPages'], $nomImageToAdd );
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Modification réalisé"
        ];
        \header('Location: '. URL . 'livres');
    }

    private function ajoutImage($file, $dir){
        if(!isset($file['name']) || empty($file['name']))
            throw new \Exception("Vous devez indiquer une image");
    
        if(!file_exists($dir)) mkdir($dir,0777);
    
        $extension = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));
        $random = rand(0,99999);
        $target_file = $dir.$random."_".$file['name'];
        
        if(!getimagesize($file["tmp_name"]))
            throw new \Exception("Le fichier n'est pas une image");
        if($extension !== "jpg" && $extension !== "jpeg" && $extension !== "png" && $extension !== "gif")
            throw new \Exception("L'extension du fichier n'est pas reconnu");
        if(file_exists($target_file))
            throw new \Exception("Le fichier existe déjà");
        if($file['size'] > 500000)
            throw new \Exception("Le fichier est trop gros");
        if(!move_uploaded_file($file['tmp_name'], $target_file))
            throw new \Exception("l'ajout de l'image n'a pas fonctionné");
        else return ($random."_".$file['name']);
    }
}