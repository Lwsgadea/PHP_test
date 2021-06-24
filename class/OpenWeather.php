<?php
require_once 'functions.php';

class OpenWeather {

  private $apiKey;

  public function __construct(string $apiKey) {
    $this->apiKey = $apiKey;
  }

  public function getForecast(float $lattitude, float $longitude) {
    $curl = curl_init("https://api.openweathermap.org/data/2.5/onecall?lat={$lattitude}&lon={$longitude}&appid={$this->apiKey}&units=metric&lang=fr");
    curl_setopt_array($curl, [
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_SSL_VERIFYPEER => false,
      CURLOPT_TIMEOUT        => 2
    ]);
    $data = curl_exec($curl);
    if($data === false) {
      var_dump(curl_error($curl));
    } 
      $data = json_decode($data, $associative = true);
      $result_by_minute = [];
      $result_by_hour = [];
      $result_by_day = [];
      foreach($data['minutely'] as $by_minute) {
        $result_by_minute[] = [
          'time' => new DateTime('@' .  $by_minute['dt']),
          'rain' => $by_minute['precipitation']
        ];
      }
      foreach($data['hourly'] as $by_hour) {
        $result_by_hour[] = [
          'time'        => new DateTime('@' .  $by_hour['dt']),
          'temperature' => $by_hour['temp'],
          'description' => $by_hour['weather']['0']['description']
        ];
      }
      foreach($data['daily'] as $by_day) {
        $result_by_day[] = [
          'time'            => new DateTime('@' .  $by_day['dt']),
          'sunrise'         => $by_day['sunrise'],
          'sunset'          => $by_day['sunset'],
          'moonrise'        => $by_day['moonrise'],
          'moonset'         => $by_day['moonset'],
          'min-temperature' => $by_day['temp']['min'],
          'max-temperature' => $by_day['temp']['max'],
          'description'     => $by_day['weather' ]['0']['description']
        ];
      }
      
      $result[] = [$result_by_minute, $result_by_hour, $result_by_day];
      return $result;

    



  }
}
