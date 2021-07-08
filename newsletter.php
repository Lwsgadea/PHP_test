<?php
require_once 'functions.php';
$title = 'Adhérer à la newsletter';
$error = null;
$success = null;
$email = null;
if(isset($_POST['email'])) {
  $email = $_POST['email'];
  if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $fichier = __DIR__ . DIRECTORY_SEPARATOR . 'emails' . DIRECTORY_SEPARATOR . date('Y-m-d');
    $resource = file_put_contents($fichier, $email . PHP_EOL, FILE_APPEND);
    $success = "Email enregistré";
    $email = null;
  } else {
    $error = "Email invalide";
  }
  
}
require_once 'elements/header.php';
?>

<div class="container">
  <h1>Inscription à la newsletter</h1>

  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus quod ipsum corporis ea nisi esse recusandae dolorem inventore amet autem, ex aperiam accusamus saepe quae? Laudantium est repellat reiciendis deleniti?</p>

  <?php if($error): ?>
    <div class="alert alert-danger">
      <?= $error ?>
    </div>
  <?php endif ?>
  <?php if($success): ?>
    <div class="alert alert-success">
      <?= $success ?>
    </div>
  <?php endif ?>

  <form action="/newsletter.php" method="POST">
    <input type="email"
          name="email"
          placeholder="Entrez votre adresse mail"
          class="form-control"
          value="<?= htmlentities($email) ?>"
          required>
    <button type="submit" class="btn btn-primary mt-1">Confirmer l'email</button>
  </form>
</div>
<?php require 'elements/footer.php' ?>