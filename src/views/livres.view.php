<?php 
ob_start();

if(!empty($_SESSION['alert'])):
?>
<div class="alert alert-<?= $_SESSION['alert']['type'] ?>" role="alert">
  <?= $_SESSION['alert']['msg'] ?>
</div>
<?php endif; ?>

<table class="table text-center">
  <tr class="table-active">
    <th>Image</th>
    <th>Titre</th>
    <th>Nombre de pages</th>
    <?php 
    if(isset($_SESSION['admin']) && ($_SESSION['admin'] == '1')){
    ?>
    <th colspan="2">Actions</th>
    <?php 
    }
    ?>
  </tr>
    <?php 
    for($i = 0; $i < count($livres); $i++): ?>
    <tr>
      <td class="align-middle"><img src="src/public/images/<?= $livres[$i]->getImage(); ?>" width="200px"></td>
      <td class="align-middle"><a href="<?= URL ?>livres/l/<?= $livres[$i]->getId(); ?>"><?= $livres[$i]->getTitre(); ?></a></td>
      <td class="align-middle"><?= $livres[$i]->getNbPages() ?></td>
      <?php 
      if(isset($_SESSION['admin']) && ($_SESSION['admin'] == '1')){
        ?>
        <td class="align-middle"><a href="<?= URL ?>livres/m/<?= $livres[$i]->getId(); ?>" class="btn btn-warning">Modifier</a></td>
        <td class="align-middle">
          <form method="post" action="<?= URL ?>livres/s/<?= $livres[$i]->getId(); ?>" onsubmit="return confirm('Voulez-vous supprimer le livre ?');">
            <button class="btn btn-secondary" type="submit">Supprimer</button>
          </form>
        </td>
      <?php
      }
      ?>
    </tr>
    <?php endfor ?>
</table>
<?php 
  if(isset($_SESSION['admin']) && ($_SESSION['admin'] == '1')){
?>
<a href="<?= URL ?>livres/a" class="btn btn-success btn-lg btn-block">Ajouter</a>
<?php 
}
?>

<div class="pagination">
  <ul class="pagination pagination-sm">
    <li class="page-item disabled">
      <a class="page-link" href="#">&laquo;</a>
    </li>
    <li class="page-item active">
      <a class="page-link" href="#">1</a>
    </li>
    <li class="page-item">
      <a class="page-link" href="#">2</a>
    </li>
    <li class="page-item">
      <a class="page-link" href="#">3</a>
    </li>
    <li class="page-item">
      <a class="page-link" href="#">4</a>
    </li>
    <li class="page-item">
      <a class="page-link" href="#">5</a>
    </li>
    <li class="page-item">
      <a class="page-link" href="#">&raquo;</a>
    </li>
  </ul>
</div>

<?php
$content = ob_get_clean();
$titre = "Les livres de Dev-Pro";
require 'src/views/template.php'; ?>