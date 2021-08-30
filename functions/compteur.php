<?php

/**
 * Pointe vers le fichier pour ajouter une vue au compteur
 *
 * @return void
 */
function ajouter_vue(): void {
  $fichier = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'compteur';
  $fichier_journalier = $fichier . '-' . date('Y-m-d');
  incrementer_compteur($fichier);
  incrementer_compteur($fichier_journalier);
}

/**
 * Ajoute 1 vue au compteur à chaque entrée sur une page du site
 *
 * @param  mixed $fichier
 * @return void
 */
function incrementer_compteur(string $fichier): void {
  $compteur = 1;
  if(file_exists($fichier)) {
    $compteur = (int)file_get_contents($fichier);
    $compteur++;
  }
  file_put_contents($fichier, $compteur);
}

/**
 * Retourne le nombre de vues dans le fichier compteur
 *
 * @return string
 */
function nombre_vues(): string {
  $fichier = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'compteur';
  return file_get_contents($fichier);
}

/**
 * Comptabilise l'ensemble des vues des différents fichiers compteur
 *
 * @param  int $annee
 * @param  int $mois
 * @return int
 */
function nombre_vues_mois(int $annee, int $mois): int {
  $mois = str_pad($mois, 2, '0', STR_PAD_LEFT);
  $fichier = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . "compteur-$annee-$mois-*";
  $fichiers = glob($fichier);
  $total = 0;
  foreach($fichiers as $fichier) {
    $total += (int)file_get_contents($fichier);
  }
  return $total;
}

/**
 * Détaille le décompte des vues pour chaque mois par jour
 *
 * @param  mixed $annee
 * @param  mixed $mois
 * @return array
 */
function nombre_vues_detail_mois(int $annee, int $mois): array {
  $mois = str_pad($mois, 2, '0', STR_PAD_LEFT);
  $fichier = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . "compteur-$annee-$mois-*";
  $fichiers = glob($fichier);
  $visites = [];
  foreach($fichiers as $fichier) {
    $parties = explode('-', basename($fichier));
    $visites[] = [
      'annee' => $parties[1],
      'mois' => $parties[2],
      'jour' => $parties[3],
      'visites' => file_get_contents($fichier)
    ];
  }
  return $visites;
}