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

<div class="container">
<h1>Liste des Pays</h1>
<p>Les données de cette page sont prises à partir du fichier <a href="data/pays.csv">pays.csv</a>, le traitement est automatisé pour donner ce rendu. </p>
<div class="row">
  <?php foreach($monde as $pays): ?>
    <div class="card col-sm-5 border-primary bg-primary m-1">
      <div class="card-body">
        <h4 class="card-title"><strong><?= $pays[4] ?></strong></h4>
        <h5 class="card-subtitle mb-2 text-dark"><?= $pays[5] ?></h5>
        <p class="card-text">
          <h6>Codes ISO :</h6>
          <ul>
            <li>numérique : <?= $pays[1] ?></li>
            <li>alpha2 : <?= $pays[2] ?></li>
            <li>alpha3 : <?= $pays[3] ?></li>
          </ul>
        </p>
      </div>
    </div>
  <?php endforeach ?>
</div>
</div>
<?php require_once 'elements/footer.php'; ?>