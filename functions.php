<?php

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

function nav_menu(string $linkClass = ''): string {
  return 
    nav_item('/index.php', 'Accueil', $linkClass) . 
    nav_item('/pays.php', 'Pays', $linkClass) . 
    nav_item('/jeu.php', 'Glace', $linkClass) . 
    nav_item('/newsletter.php', 'S\'inscrire', $linkClass) . 
    nav_item('/contact.php', 'Contact', $linkClass);
}

function dump($variable) {
  echo '<pre>';
  var_dump($variable);
  echo '</pre>';
}

function creneaux_html(array $creneaux) {
  $phrases = [];
  if(empty($creneaux)) {
    return 'Fermé';
  }
  foreach($creneaux as $creneau) {
    $phrases[] = "ouvert de <strong>{$creneau[0]}h</strong> à <strong>{$creneau[1]}h</strong>";
  }
  return implode(' et ', $phrases);
}

function in_creneaux(int $heure, array $creneaux): bool {
  foreach($creneaux as $creneau) {
    $debut = $creneau[0];
    $fin = $creneau[1];
    if($heure >= $debut && $heure < $fin) {
      return true;
    }
  }
  return false;
}

function add_mail() {
  $fichier = 'emails/' . date('Y-m-d');
  $resource = file_put_contents($fichier, 'lewisgadea@gmail.com');
}