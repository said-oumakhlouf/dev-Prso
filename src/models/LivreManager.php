<?php
namespace App\Models;

use App\Models\Livre;
use Exception;

class LivreManager extends Model
{
    private $livres; // Tableau de livres

    public function ajoutLivre($livre){
        $this->livres[] = $livre;
    }

    public function getLivres(){return $this->livres;}

    public function chargementLivres(){
        $req = $this->getBdd()->prepare('SELECT * FROM livres');
        $req->execute();
        $mesLivres = $req->fetchAll(\PDO::FETCH_ASSOC);
        $req->closeCursor();
        foreach($mesLivres as $livre){
            $l = new Livre($livre['id'], $livre['titre'],$livre['nbPages'], $livre['image']);
            $this->ajoutLivre($l);
        }
    }

    public function getLivreById($id){
        for($i = 0; $i < \count($this->livres); $i++){
            if($this->livres[$i]->getId() === $id){
                return $this->livres[$i];
            }
        }
        throw new \Exception("Le livre n'existe pas !");
    }

    public function ajoutLivreBd($titre, $nbPages,$image){
        $req = '
        INSERT INTO livres(titre, nbPages, image)
        VALUES (:titre, :nbPages, :image)';
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(':titre', $titre, \PDO::PARAM_STR);
        $stmt->bindValue(':nbPages', $nbPages, \PDO::PARAM_INT);
        $stmt->bindValue(':image', $image, \PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();

        if($resultat > 0){
            $livre = new Livre($this->getBdd()->lastInsertId(), $titre, $nbPages, $image);
            $this->ajoutLivre($livre);
        }
    }

    public function suppressionLivreBd($id){
        $req = '
        DELETE FROM livres WHERE id = :idLivre';
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(':idLivre', $id, \PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if($resultat > 0){
            $livre = $this->getLivreById($id);
            unset($livre);
        }
    }

    public function modificationLivreBd($id, $titre, $nbPages, $image){
        $req = '
        UPDATE livres
        SET titre = :titre, nbPages = :nbPages, image = :image
        WHERE id = :id';
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->bindValue(':titre', $titre, \PDO::PARAM_STR);
        $stmt->bindValue(':nbPages', $nbPages, \PDO::PARAM_INT);
        $stmt->bindValue(':image', $image, \PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();

        if($resultat > 0){
            $this->getLivreById($id)->setTitre($titre);
            $this->getLivreById($id)->setTitre($nbPages);
            $this->getLivreById($id)->setTitre($image);
        }
    }
}