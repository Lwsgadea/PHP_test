<?php
require_once 'functions.php'; 
$title = 'Nos pays';
$monde = file(__DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'pays.csv');
$monde = str_replace('"', '', $monde);
$monde = str_replace("\n", '', $monde);
foreach($monde as $k => $pays) {
  $monde[$k] = explode(",", $pays);
}
require 'elements/header.php';
?>

<h1>Liste des Pays</h1>

<div class="container">
  <div class="row">
    <?php foreach($monde as $pays): ?>
      <div class="card col-sm-5 border-primary m-1">
        <div class="card-body">
          <h4 class="card-title"><strong><?= $pays[4] ?></strong></h4>
          <h6 class="card-subtitle mb-2 text-muted"><?= $pays[5] ?> (eng)</h6>
          <p class="card-text">
            <ul>
              <li>code ISO 3166-1 numérique : <?= $pays[1] ?></li>
              <li>code ISO 3166-1 alpha2 : <?= $pays[2] ?></li>
              <li>code ISO 3166-1 alpha3 : <?= $pays[3] ?></li>
            </ul>
          </p>
        </div>
      </div>
    <?php endforeach ?>
  </div>
</div>
<?php require_once 'elements/footer.php'; ?>