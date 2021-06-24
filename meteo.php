<?php
require_once 'functions.php';
require 'class/OpenWeather.php';
$weather = new OpenWeather('93105a5d5d6578b125296f230a1570fe');
$forecast = $weather->getForecast(48.8534, 2.3488);
dump($forecast);
require 'elements/header.php';
?>

<h1>Météo</h1>


<?php require 'elements/footer.php'; ?>