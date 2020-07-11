<?php ob_start(); ?>
    <div class="container-fluid">
        <div class="form-group">
                <form action="register" method="post">
                    <input type="text" class="form-control" name="username" id="username" placeholder="Votre pseudo" value="<?php if(isset($username)) {echo $username;} ?>">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Votre email" value="<?php if(isset($email)) {echo $email;} ?>">
                    <input type="email" class="form-control" name="email2" id="email2" placeholder="Confirmez votre email" value="<?php if(isset($email2)) {echo $email2;} ?>">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Votre mot de passe">
                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirmez votre mot de passe">
                    <input type="submit"  name="submit" class="btn btn-info" value="S'inscrire">
                </form>
                <?php if(isset($erreur)){echo '<font color="red">'.$erreur ."</font>";} ?>
                <?php if(isset($success)){echo '<font color="green">'.$success ."</font>";} ?>
            </div>
    </div>
<?php 
$content = ob_get_clean(); 
$titre = 'Inscription';
require('src/views/template.php'); 
?>
