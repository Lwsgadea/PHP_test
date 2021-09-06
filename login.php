<?php
require_once 'functions.php';

$title = 'Authentification';
$erreur = null;
$password = '$2y$12$Fooh05G1uGYS5AXL952DhOF3RQdjfFcZ67HqjPykTkKYqZKhaFhVS';
if(!empty($_POST['pseudo']) && !empty($_POST['password'])) {
  if($_POST['pseudo'] === 'John' && password_verify($_POST['password'], $password)) {

    session_start();
    $_SESSION['connecte'] = 1;
    header('Location: /dashboard.php');
    exit();
  } else {
    $erreur = "Identificants incorrects";
  }
}

require_once 'functions/auth.php';
if(est_connecte()) {
  header('Location: /dashboard.php');
  exit();
}
require_once 'elements/header.php';
?>
<div class="container">
  <?php if($erreur): ?>
    <div class="alert alert-danger"><?= $erreur ?></div>
  <?php endif ?>

  <div class="row">
    <p>Entrez John et Doe pour vous connecter</p>
  </div>
  <form action="" method="post">
    <div class="form-group mb-2">
      <input type="text" 
            name="pseudo" 
            class="form-control"
            placeholder="Nom d'utilisateur">
    </div>
    <div class="form-group mb-2">
      <input type="text" 
            name="password" 
            class="form-control"
            placeholder="Mot de pass">
    </div>
    <button type="submit" class="btn btn-primary">Se connecter</button>
  </form>
</div>


<?php require 'elements/footer.php' ?>