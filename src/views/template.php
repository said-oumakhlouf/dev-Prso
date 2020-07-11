<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Membres</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/minty/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <link rel="stylesheet" href="<?= URL ?>src/public/css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">DeV-PRSO</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor01">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="<?= URL ?>accueil">Accueil <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= URL ?>livres">Livres <span class="sr-only">(current)</span></a>
      </li>
    
      <?php if(isset($_SESSION['user_session']))
      {
        ?>

        <li class="nav-item">
        <a class="nav-link" href="<?= URL ?>logout">Se déconnecter</a>
        </li>
        <?php
      } else {
        ?>
        <li class="nav-item">
          <a class="nav-link" href="<?= URL ?>register">Inscription</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= URL ?>login">Connexion</a>
        </li>
        <?php
      }
      ?>
    </ul>
  </div>
</nav>

<div class="container">
    <h1 class="rounded border borderp- m-2 text-center text-white btn-info"><?= $titre; ?></h1>
    <?= $content; ?>
</div>

<footer>Copyrigth 2020</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="src/public/js/main.js"></script>
</body>
</html>