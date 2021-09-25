<?php
require 'vendor/autoload.php';

use App\{
  OpenWeather,
  Form
};

require_once 'functions.php';
$title = 'Météo';
$weather = new OpenWeather('93105a5d5d6578b125296f230a1570fe');
$location = (string)($_GET['ville'] ?? 'Paris,fr');
$latitude = (float)($_GET['latitude'] ?? 48.8534);
$longitude = (float)($_GET['longitude'] ?? 2.3488);
$error = null;
$forecast = [];
$hour_temp = [];
$hour_time = [];
try {
  $forecast = $weather->getForecast($latitude, $longitude);
  $today = $weather->getToday($location);
} catch(Exception | Error $e) {
  $error = $e->getMessage();
}
foreach($forecast[0][1] as $hour) {
  $hour_temp[] = $hour['temperature'];
  $hour_time[] = (int)$hour['time']->format('H') . 'h';
}
require 'elements/header.php';
?>

<div class="container">
<?php if($error): ?>
  <div class="alert alert-danger"><?= $error ?></div>
<?php else: ?>
  <h1>Météo</h1> 
  <p>Les données affichées ici sont tirées du site <a href="https://openweathermap.org/" target="_blank">OpenWeather</a> par leur API et sont par défaut sur mon site réglées sur Paris, la première ligne par le nom de la ville au format 'Paris,fr' et en dessous gâce aux coordonnées : latitude et longitude .</p>
  <p>Si vous souhaitez voir la météo d'une autre ville, modifiez les informations suivantes :</p>
  <form action="" method="GET">
    <?= Form::generic('ville', 'Ville', $location) ?>
    <?= Form::generic('latitude', 'Latitude', $latitude, 'compris entre -90° et 90°') ?>
    <?= Form::generic('longitude', 'Longitude', $longitude, 'compris entre -180° et 180°') ?>
    <button class="btn btn-primary mb-1" type="submit">Modifier localisation</button>
  </form>
  <div>
    <h2>En ce moment, <?= $today['description'] . ' ' . $today['temp'] . '°C' ?></h2>
  </div>
  <div>
    <ul>
      <?php foreach($forecast[0][2] as $days): ?>
        <li><?= $days['time']->format('D m') . ': ' . $days['description'] . ', ' . ($days['min-temperature'] + $days['max-temperature']) / 2 . '°C' ?></li>
      <?php endforeach ?>
    </ul>
  </div>
  <canvas id="myChart" height="150p" width="600"></canvas>
<?php endif ?>
</div>

<script>
  var ctx = document.getElementById('myChart').getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: <?php echo json_encode($hour_time) ?>,
      datasets: [{
        label: 'Température des prochaines 48h (en °C)',
        data: <?php echo json_encode($hour_temp) ?>,
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
        ],
        borderColor: [
          'rgba(255, 99, 132, 1)',
        ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

</script>

<?php require 'elements/footer.php'; ?>