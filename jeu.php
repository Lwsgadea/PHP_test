<?php
require './class/Form.php';
$parfums = [
  'Fraise' => 4,
  'Vanille' => 5,
  'Chocolat' => 3
];
$cornets = [
  'Pot' => 2,
  'Cornet' => 3
];
$supplements = [
  'Pépites de chocolat' => 1,
  'Chantilly' => 0.5
];
$title = 'Composer sa glace';
$ingredients = [];
$total = 0;
foreach(['parfum', 'supplement', 'cornet'] as $name) {
  if(isset($_GET[$name])) {
    $liste = $name . 's';
    $choix = $_GET[$name];
    if(is_array($choix)) {
      foreach($choix as $value) {
        if(isset($$liste[$value])) {
          $ingredients[] = $value;
          $total += $$liste[$value];
        };
      }
    } else {
      if(isset($$liste[$choix])) {
        $ingredients[] = $choix;
        $total += $$liste[$choix];
      }
    }
    
  }
}
require 'elements/header.php';
?>

<div class="container">
  <h1>Composez votre glace</h1>
  <div class="row">
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
        <h5 class="card-title">votre glace</h5>
        <ul>
          <?php foreach($ingredients as $ingredient): ?>
            <li><?= $ingredient ?></li>
          <?php endforeach ?>
        </ul>
        <p>
          <strong>Prix : </strong><?= $total ?>€
        </p>
        </div>
      </div>
    </div>
    <div class="col-md-8">
      <form action="/jeu.php" method="GET">
        <div class="form-group">
          <h3>Choisissez vos parfum</h3>
          <?php foreach($parfums as $parfum => $prix): ?>
            <div class="parfum">
              <label>
                <?= Form::checkbox('parfum', $parfum, $_GET) ?><?= $parfum ?> - <?= $prix ?>€
              </label>
            </div>
          <?php endforeach ?>
          <h3>Choisissez votre contenant</h3>
          <?php foreach($cornets as $cornet => $prix): ?>
            <div class="cornet">
              <label>
              <?= Form::radio('cornet', $cornet, $_GET) ?><?= $cornet ?> - <?= $prix ?>€
              </label>
            </div>
          <?php endforeach ?>
          <h3>Choisissez vos suppléments désirés</h3>
          <?php foreach($supplements as $supplement => $prix): ?>
            <div class="supplements">
              <label>
              <?= Form::checkbox('supplement', $supplement, $_GET) ?><?= $supplement ?> - <?= $prix ?>€
              </label>
            </div>
          <?php endforeach ?>
        </div>
        <button type="submit" class="btn btn-primary mt-1">Valider la glace</button>
      </form>
    </div>
  </div>
</div>


<?php require 'elements/footer.php';