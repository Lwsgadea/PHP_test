<?php
require_once 'functions.php';

$title = 'Adhérer à la newsletter';
$error = null;
$success = null;
$email = null;
$path = './emails';
$files = [];
$lastFile = '';
if(is_dir($path)) {
  if($dh = opendir($path)) {
    while(($file = readdir($dh)) !== false) {
      if($file !== "." && $file !== "..") {
        $files[] .= $file; 
      }
    }
    $lastFile = $files[0];
    closedir($dh);
  }
}
if(isset($_POST['email'])) { 
  $email = $_POST['email'];
  if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $success = mail($email, "Inscription à la newsletter L. Gadea", "Bonjour, \nMerci de vous être inscrit à notre newsletter. \n\nCordialement, \n\nLewis Gadea");
    if(!$success) {
      dump(error_get_last()['message']);
    }
    $fichier = __DIR__ . DIRECTORY_SEPARATOR . 'emails' . DIRECTORY_SEPARATOR . date('Y-m-d');
    $resource = file_put_contents($fichier, $email . PHP_EOL, FILE_APPEND);
    // $success = "Adresse mail enregistrée et courrier de bienvenue envoyé !";
    $email = null;
    header('Location: /newsletter.php');
  } else {
    $error = "Email invalide";
  }
}
require_once 'elements/header.php';
?>

<div class="container">
  <h1>Inscription à la newsletter</h1>

  <p>Inscrivez-vous à notre newsletter en entrant votre addresse mail. Vous pouvez vérifier votre inscription dans ce fichier (un nouveau créé chaque jour, essayez demain!) en cliquant ici : <a href="<?= './emails/' . $lastFile ?>" target="_blank">fichier du <?= $lastFile ?></a></p>

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