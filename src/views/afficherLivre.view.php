<?php
ob_start();
?>

<div class="row">
    <div class="col-6">
        <img src="<?= URL ?>src/public/images/<?= $livre->getImage(); ?>">
    </div>
    <div class="col-6">
        <p>Titre : <?= $livre->getTitre(); ?></p>
        <p>Nombres de Pages : <?= $livre->getNbPages(); ?></p>
        <p>Description : </p>
    </div>
</div>

<?php
$content = ob_get_clean();
$titre = $livre->getTitre();
require 'src/views/template.php'; ?>