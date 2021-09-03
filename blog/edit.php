<?php
$title = 'blog';
require_once '../functions.php';
require_once '../pdo.php';
$error = null;
$success = null;
try {
  if(isset($_POST['name'], $_POST['content'])) {
    $query = $pdo->prepare('UPDATE posts SET name = :name, content = :content WHERE id = :id');
    $query->execute([
      'name'    => $_POST['name'],
      'content' => $_POST['content'],
      'id'      => $_GET['id']
    ]);
    $success = 'Votre article a bien été modifié';
  }
  $query = $pdo->prepare('SELECT * from posts where id = :id');
  $query->execute([
    'id' => $_GET['id']
  ]);
  $posts = $query->fetch(PDO::FETCH_OBJ);
} catch(PDOException $e) {
  $error = $e->getMessage();
}
require_once '../elements/header.php'; ?>

<div class="container">
  <p>
    <a href="/blog">Revenir au listing</a>
  </p>
<?php if($success): ?>
  <div class="alert alert-success"><?= $success ?></div>
<?php endif ?>
<?php if($error): ?>
  <div class="alert alert-danger"><?= $error ?></div>
<?php endif ?>
  <form action="" method="post">
    <div class="form-group mb-1">
      <input type="text" class="form-control" name="name" value="<?= htmlentities($posts->name) ?>">
    </div>
    <div class="form-group mb-1">
      <textarea class="form-control" name="content"><?= htmlentities($posts->content) ?></textarea>
    </div>
    <button class="btn btn-primary">Sauvegarder</button>
  </form>
</div>


<?php require_once '../elements/footer.php'; ?>