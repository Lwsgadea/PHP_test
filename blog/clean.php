<?php
$title = 'Suppression article';
require_once '../elements/header.php';
require_once '../pdo.php';
$error = null;
$success = null;
try {
  $query = $pdo->prepare('DELETE FROM posts WHERE id = :id');
  $query->execute([
    'id' => $_GET['id']
  ]);
  $success = 'Votre article a bien été supprimé';
} catch(PDOException $e) {
  $error = $e->getMessage();
}
?>

<div class="container">
  <?php if($success): ?>
    <div class="alert alert-success"><?= $success ?></div>
  <?php elseif($error): ?>
    <div class="alert alert-danger"><?= $error ?></div>
  <?php endif ?>
  <p>
    <a href="/blog">Revenir au listing</a>
  </p>
</div>

<?php require_once '../elements/footer.php'; ?>

