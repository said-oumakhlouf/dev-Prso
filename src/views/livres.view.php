<?php 
ob_start();
?>
<table class="table text-center">
  <tr class="table-warning">
    <th>Image</th>
    <th>Titre</th>
    <th>Nombre de pages</th>
    <th colspan="2">Actions</th>
  </tr>
    <?php 
    for($i = 0; $i < count($livres); $i++): ?>
    <tr>
      <td class="align-middle"><img src="src/public/images/<?= $livres[$i]->getImage(); ?>" width="200px"></td>
      <td class="align-middle"><a href="<?= URL ?>livres/l/<?= $livres[$i]->getId(); ?>"><?= $livres[$i]->getTitre(); ?></a></td>
      <td class="align-middle"><?= $livres[$i]->getNbPages() ?></td>
      <td class="align-middle"><a href="<?= URL ?>livres/m/<?= $livres[$i]->getId(); ?>" class="btn btn-warning">Modifier</a></td>
      <td class="align-middle">
        <form method="post" action="<?= URL ?>livres/s/<?= $livres[$i]->getId(); ?>" onsubmit="return confirm('Voulez-vous supprimer le livre ?');">
          <button class="btn btn-danger" type="submit">Supprimer</button>
        </form>
      </td>
    </tr>
    <?php endfor ?>
</table>
<a href="<?= URL ?>livres/a" class="btn btn-success d-block">Ajouter</a>

<?php
$content = ob_get_clean();
$titre = "Les livres de Dev-Pro";
require 'src/views/template.php'; ?>