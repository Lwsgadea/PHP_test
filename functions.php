<?php

/**
 * Gère les différents liens internes individuellement
 *
 * @param  string $lien (ex: '/nomdelapage.php')
 * @param  string $titre (ex: 'Nomdelapage')
 * @param  string $linkClass
 * @return string
 */
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

/**
 * Gère l'ensemble des liens internes
 *
 * @param  string $linkClass
 * @return string
 */
function nav_menu(string $linkClass = ''): string {
  return 
    nav_item('/index.php', 'Accueil', $linkClass) . 
    nav_item('/pays.php', 'Pays', $linkClass) . 
    nav_item('/jeu.php', 'Glace', $linkClass) . 
    nav_item('/newsletter.php', 'S\'inscrire', $linkClass) . 
    nav_item('/meteo.php', 'Météo', $linkClass) . 
    nav_item('/blog/', 'Blog', $linkClass) .
    nav_item('/contact.php', 'Contact', $linkClass);
}

/**
 * formate directement le var-dump
 *
 * @param  mixed $variable 
 * @return void
 */
function dump($variable) {
  echo '<pre>';
  var_dump($variable);
  echo '</pre>';
}

/**
 * Retranscrit les horaires quotidiens à partir du tableau de créneaux
 *
 * @param  array $creneaux (ex: [[8, 12], [14, 19]])
 * @return void
 */
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

/**
 * Vérifie l'ouverture ou non du magasin en fonction de l'heure actuelle/ choisie
 *
 * @param  mixed $heure (ex: 20)
 * @param  int $creneaux (ex: [[8, 12], [14, 19]])
 * @return bool
 */
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

/**
 * Ajoute l'adresse mail au document créé ou le créée si il n'existe pas encore
 *
 * @return void
 */
function add_mail() {
  $fichier = 'emails/' . date('Y-m-d');
  $resource = file_put_contents($fichier, 'lewisgadea@gmail.com');
}

/**
 * Modifie les noms des mois et jours de l'anglais au français
 *
 * @param  string $format
 * @param  mixed $time
 * @return void
 */
function date_fr($format, $time = null) {
  $date = date($format, $time);

  $jour_en = ["Mon","Tue","Wed","Thu","Fri","Sat","Sun"];
  $jour_fr = ["Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi","Dimanche"];

  $mois_en = ["January","February","March","April","May","June","July","August","September","October","November","December"];
  $mois_fr = ["Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre"];

  $date = str_replace($jour_en, $jour_fr, $time);
  $date = str_replace($mois_en, $mois_fr, $time);

  return $date;
}