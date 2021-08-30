<?php
require_once 'functions.php';
require 'class/OpenWeather.php';
// error_reporting(0);
$title = 'Météo';
$hour_temp = [];
$hour_time = [];
$error = null;
$weather = new OpenWeather('93105a5d5d6578b125296f230a1570fe');
try {
  $forecast = $weather->getForecast(48.8534, 2.3488);
  $today = $weather->getToday('Paris,fr');
} catch(Exception | Error $e) {
  $error = $e->getMessage();
}
foreach($forecast[0][1] as $hour) {
  $hour_temp[] = $hour['temperature'];
  $hour_time[] = (int)$hour['time']->format('H') . 'h';
}
require 'elements/header.php';
?>

<?php if($error): ?>
<div class="container">
  <div class="alert alert-danger"><?= $error ?></div>
</div>
<?php else: ?>
<h1>Météo</h1> 
<div class="container">
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
</div>
<canvas id="myChart" height="150p" width="600"></canvas>
<?php endif ?>
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