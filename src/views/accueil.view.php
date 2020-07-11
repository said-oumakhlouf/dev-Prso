<?php
ob_start();
?>

<h2>La météo du jour</h2>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-6 my-3">
            <form>
                <div class="form-group">
                    <input type="text" class="form-control" id="inputCity" placeholder="Renseigner une ville">
                </div>
                <button type="submit" class="btn btn-info btn-block">Rechercher</button>
            </form>
        </div>

        <div class="col-12 col-sm-6 d-flex justify-content-center my-3">
            <div class="box-container">
                <div id="city" class="box"></div>
                <div id="temp" class="box"></div>
                <div id="humidity" class="box"></div>
                <div id="wind" class="box"></div>
                <p id="description"></p>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
$titre = "Mon accueil";
require 'src/views/template.php'; ?>