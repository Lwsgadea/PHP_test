<?php
require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Creneau.php';
require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Form.php';
$creneau = new Creneau(9, 12);
$creneau2 = new Creneau(14, 16);
$creneau->intersect($creneau2);
echo $creneau->toHTML();
echo "\n";
echo Form::checkbox('demo', 'Demo', []);


/* $fichier = __DIR__ . DIRECTORY_SEPARATOR . 'demo.csv';
$resource = fopen($fichier, 'r+');
$k = 0;
while($line = fgets($resource)) {
  $k++;
  if($k == 1) {
    fwrite($resource, 'Salut les gens');
    break;
  }
}
fclose($resource); */

/* $date = '2014-01-01';
$date2 = '2019-04-01';

$d = new DateTime($date);
$d2 = new DateTime($date2);
$diff = $d->diff($d2, true);
echo "Il y a {$diff->y} années, {$diff->m} mois et {$diff->d} jours de différence";

echo "\n";

$time = strtotime($date);
$time2 = strtotime($date2);
$days = floor(($time2 - $time) / (24 * 60 * 60));
echo "Il y a $days jours de différence"; */

/* $date = new DateTime('2019-01-01');
$interval = new DateInterval('P1M1DT1M');
$date->add($interval);
var_dump($date); */