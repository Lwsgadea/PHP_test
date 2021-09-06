<?php
require_once 'functions.php';

$title = 'S\'enregistrer';
$age = null;
if(!empty($_POST['birthday'])) {
  setcookie('birthday', $_POST['birthday']);
  $_COOKIE['birthday'] = $_POST['birthday'];
}
if(!empty($_COOKIE['birthday'])) {
  $birthday = (int)$_COOKIE['birthday'];
  $age = (int)date('Y') - $birthday;
}
require 'elements/header.php';
?>

<?php if($age >= 18): ?>
  <h1>Du contenu réservé aux adultes</h1>
<?php elseif($age !== null): ?>
  <div class="alert alert-danger">Vous n'avez pas l'âge requis pour voir le contenu</div>
<?php else: ?>
  <form action="" method="post">
    <div class="form-group">
      <label for="birthday">Section réservée aux adultes, veuillez entrer votre année de naissance</label>
      <select name="birthday"
              id="birthday"
              class="form-control">
        <?php for($i = 2010; $i > 1919; $i--): ?>
          <option value="<?= $i ?>"><?= $i ?></option>
        <?php endfor ?>
      </select>
      <button type="submit" class="btn btn-primary">Vérifier son âge</button>
    </div>
  </form>
<?php endif ?>



<?php require 'elements/footer.php'; ?>