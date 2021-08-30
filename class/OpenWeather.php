<?php
require_once 'functions.php';

/**
 * Gère l'API d'Openweather
 *
 *
 * @author  Lewis Gadea <lewisgadea@gmail.com>
 *
 * @since 1.0
 *
 * @param string $apikey (ex: '93855a8d5g6978b124298f230k1570fe')
 * @param string $data (ex: 'weather?q=Paris,fr' ou 'onecall?lat=48.8534&lon=2.3488')
 */
class OpenWeather {

  private $apiKey;

  public function __construct(string $apiKey) {
    $this->apiKey = $apiKey;
  }
  
  /**
   * Récupère et trie les informations météo des minutes, heures et jours à venir
   *
   * @param  string $endpoint (ex: 'onecall?lat=48.8534&lon=2.3488')
   * @return void
   */
  public function getForecast(float $lattitude, float $longitude) {
    $data = $this->callAPI("onecall?lat={$lattitude}&lon={$longitude}");
    
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
  
  /**
   * Récupère les informations météo du jour 
   *
   * @param  string $city Ville (ex: "Montpellier,fr")
   * @return array
   */
  public function getToday(string $city): ?array {
    $data = $this->callAPI("weather?q={$city}");
    return [
      'temp'        => $data['main']['temp'],
      'description' => $data['weather'][0]['description'],
      'date'        => new DateTime()
    ];
  }
  
  /**
   * Appelle l'API Openweather
   * 
   * @throws Exception
   *
   * @param  string $endpoint (ex: 'weather?q=Paris,fr' ou 'onecall?lat=48.8534&lon=2.3488')
   * @return array
   */
  private function callAPI(string $endpoint): ?array { 
    $curl = curl_init("http://api.openweathermap.org/data/2.5/{$endpoint}&appid={$this->apiKey}&units=metric&lang=fr");
    curl_setopt_array($curl, [
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_TIMEOUT => 1
    ]);
    $data = curl_exec($curl);
    if($data === false) {
      $error = curl_error($curl);
      curl_close($curl);
      throw new Exception($error);
    }
    if(curl_getinfo($curl, CURLINFO_HTTP_CODE) !== 200) {
      throw new Exception($data);
    } 
    curl_close($curl);
    return json_decode($data, true);
  }
}
