<?php
require 'vendor/autoload.php';
require_once '../functions.php';
require_once '../pdo.php';

use App\Post;

$title = 'blog';
$error = null;
try {
  if(isset($_POST['name'], $_POST['content'])) {
    $query = $pdo->prepare('INSERT INTO posts (name, content, created_at) VALUES (:name, :content, :created)');
    $query->execute([
      'name'    => $_POST['name'],
      'content' => $_POST['content'],
      'created' => time()
    ]);
    header('Location: blog/edit.php?id=' . $pdo->lastInsertId());
  }
  $query = $pdo->query('SELECT * from posts');
  $posts = $query->fetchAll(PDO::FETCH_CLASS, 'App\Post');
} catch(PDOException $e) {
  $error = $e->getMessage();
}
require_once '../elements/header.php'; ?>

<div class="container">
<?php if($error): ?>
  <div class="alert alert-danger"><?= $error ?></div>
<?php else: ?>
  <?php foreach($posts as $post): ?>  
    <h2><a href="/blog/edit.php?id=<?= $post->id ?>"><?= $post->name ?></a></h2>
    <a href="/blog/clean.php?id=<?= $post->id ?>">
      <button class="btn btn-danger btn-sm">Supprimer l'article <?= $post->id ?></button>
    </a>
    <p class="small text-muted">Ecrit le <?= $post->created_at->format('d/m/Y à H:i') ?></p>
    <p><?= nl2br(htmlentities($post->getExcerpt())) ?></p>
  <?php endforeach ?>
  <form action="" method="post">
    <div class="form-group mb-1">
      <input type="text" class="form-control" name="name" value="">
    </div>
    <div class="form-group mb-1">
      <textarea class="form-control" name="content"></textarea>
    </div>
    <button class="btn btn-primary">Sauvegarder</button>
  </form>
<?php endif ?>
</div>


<?php require_once '../elements/footer.php'; ?>