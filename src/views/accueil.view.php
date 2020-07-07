<?php
ob_start();

// var_dump($_SESSION['user_session']);
// var_dump($_SESSION["admin"]);

?>
Ici la page d'accueil


<?php
$content = ob_get_clean();
$titre = "Mon accueil";
require 'src/views/template.php'; ?>