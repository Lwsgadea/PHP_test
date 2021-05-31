<?php
if( !function_exists('nav_item')) {
  function nav_item(string $lien, string $titre, string $linkClass = ''): string {
    $classe = 'nav-item';
    if( $_SERVER['SCRIPT_NAME'] === $lien ) {
      $linkClass .= ' active';
    }
    return <<<HTML
    <li class="$classe">
      <a class="$linkClass" aria-current="page" href="$lien">$titre</a>
    </li> 
HTML;
  }
} 

?>

<?= nav_item('/index.php', 'Accueil', $classe) ?>
<?= nav_item('/contact.php', 'Contact', $classe) ?>