<?php ob_start(); ?>
    <div class="container-fluid">
        <div class="form-group">
                <form action="check_login" method="post">
                    <input type="text" class="form-control" name="userConnect" id="userConnect" placeholder="Votre pseudo" value="<?php if(isset($userConnect)){echo $userConnect;} ?>">
                    <input type="password" class="form-control" name="passConnect" id="passConnect" placeholder="Votre mot de passe">
                    <input type="submit"  name="submit" class="btn btn-info" value="Se connecter">
                </form>
                <?php if(isset($erreur)){echo '<font color="red">'.$erreur ."</font>";} ?>
                <?php if(isset($success)){echo '<font color="green">'.$success ."</font>";} ?>
        </div>
    </div>

<?php 
$content = ob_get_clean(); 
$titre = 'Connexion';
require('src/views/template.php');
?>



