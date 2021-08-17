<?php
$title = 'Page de contact';
require_once 'data/config.php';
require_once 'functions.php';
require_once 'class/Form.php';
date_default_timezone_set('Europe/Paris');
$jour = (int)($_GET['jour'] ?? date('N') -1);
$heure = (int)($_GET['heure'] ?? date('G'));
$creneaux = CRENEAUX[date('N') -1];
$ouvert = in_creneaux($heure, $creneaux);
$color = $ouvert ? 'green' : 'red';
require 'elements/header.php'; ?>

<div class="container">
  <div class="row">
    <div class="col-md-8">
      <h2>Nous contacter</h2>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro dolor nostrum veniam, vel optio cumque at a, dicta odit, itaque saepe voluptatibus ut tempore nesciunt! Dolore incidunt architecto illo animi. </p>
    </div>
    <div class="col-md-4">
      <h2>Horaires d'ouverture</h2>
      <?php if($ouvert): ?>
        <div class="alert alert-success">
          Le magasin sera ouvert
        </div>
      <?php else: ?>
        <div class="alert alert-danger">
          Le magasin sera fermé
        </div>
      <?php endif ?>
      <form action="" method="GET">
        <div class="form-group mb-1">
        <?= Form::select('jour', $jour, JOURS) ?>
          </select>
        </div>
        <div class="form-group mb-1">
          <input type="number" name="heure" value="<?= $heure ?>">
        </div>
        <button class="btn btn-primary mb-1" type="submit">Voir si le magasin est ouvert</button>
      </form>
      <ul>
        <?php foreach(JOURS as $k => $jour): ?>
          <li>
            <strong><?= $jour ?> :</strong> 
            <?= creneaux_html(CRENEAUX[$k]); ?></li>
        <?php endforeach ?>
      </ul>
    </div>
  </div>
</div>


<?php require 'elements/footer.php'; ?>