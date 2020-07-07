<?php 
namespace App\Models;

use PDOException;


class UserManager extends Model
{
    public function getUser($username)
    {
        $req = $this->getBdd()->prepare("SELECT * FROM users WHERE username = :username "); 
        $req->execute([
            ':username' => $username,
            ]);
        $userExist = $req->rowCount();
        return $userExist;
    }

    public function getEmail($email)
    {
        $req = $this->getBdd()->prepare("SELECT * FROM users WHERE email = :email "); 
        $req->execute([
            ':email' => $email,
            ]);
        $emailExist = $req->rowCount();
        return $emailExist;
        // return (bool) $req->fetchColumn();
    }

    public function register($username, $email, $pass)
    {
        try
        {
            $req = $this->getBdd()->prepare('INSERT INTO users(username, email, password) VALUES(:username, :email, :password)');
            $new_password = password_hash($pass, \PASSWORD_BCRYPT);
            $req->bindParam(":username", $username);
            $req->bindParam(":email", $email);
            $req->bindParam(":password", $new_password);
            $req->execute();

            return $req;
        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
        }
    }
    
    public function login($username)
    {
        try
        {
            $req = $this->getBdd()->prepare("SELECT * FROM users WHERE username = :username");
            $req->execute(array(':username' => $username));
            $userRow = $req->fetch(\PDO::FETCH_ASSOC);
            
            return $userRow;
        }
        catch (\PDOException $e)
        {
            echo $e->getMessage();
        }
    }
}