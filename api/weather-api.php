<?php
    $BASE_URL = "http://query.yahooapis.com/v1/public/yql";
    $yql_query = 'select * from weather.forecast where woeid ="'.$sehir_kodu.'"  and u = "c"';

    $yql_query_url = $BASE_URL . "?q=" . urlencode($yql_query) . "&format=json&lang=tr-TR";

    $session = curl_init($yql_query_url);
    curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
    $json = curl_exec($session);

    $weathers = json_decode($json);
    
//Hava durumu iconları
    function setWeatherIcon($condid) {
  switch($condid) {
    case '0': $icon  = '<i class="wi wi-tornado" style="font-size: 14px !important;"></i>';
    break;
    case '1': $icon  = '<i class="wi wi-storm-showers" style="font-size: 14px !important;"></i>';
    break;
    case '2': $icon  = '<i class="wi wi-tornado" style="font-size: 14px !important;"></i>';
    break;
    case '3': $icon  = '<i class="wi wi-thunderstorm" style="font-size: 14px !important;"></i>';
    break;
    case '4': $icon  = '<i class="wi wi-thunderstorm" style="font-size: 14px !important;"></i>';
    break;
    case '5': $icon  = '<i class="wi wi-snow" style="font-size: 14px !important;"></i>';
    break;
    case '6': $icon  = '<i class="wi wi-rain-mix" style="font-size: 14px !important;"></i>';
    break;
    case '7': $icon  = '<i class="wi wi-rain-mix" style="font-size: 14px !important;"></i>';
    break;
    case '8': $icon  = '<i class="wi wi-sprinkle" style="font-size: 14px !important;"></i>';
    break;
    case '9': $icon  = '<i class="wi wi-sprinkle" style="font-size: 14px !important;"></i>';
    break;
    case '10': $icon  = '<i class="wi wi-hail" style="font-size: 14px !important;"></i>';
    break;
    case '11': $icon  = '<i class="wi wi-showers" style="font-size: 14px !important;"></i>';
    break;
    case '12': $icon  = '<i class="wi wi-showers" style="font-size: 14px !important;"></i>';
    break;
    case '13': $icon  = '<i class="wi wi-snow" style="font-size: 14px !important;"></i>';
    break;
    case '14': $icon  = '<i class="wi wi-storm-showers" style="font-size: 14px !important;"></i>';
    break;
    case '15': $icon  = '<i class="wi wi-snow" style="font-size: 14px !important;"></i>';
    break;
    case '16': $icon  = '<i class="wi wi-snow" style="font-size: 14px !important;"></i>';
    break;
    case '17': $icon  = '<i class="wi wi-hail" style="font-size: 14px !important;"></i>';
    break;
    case '18': $icon  = '<i class="wi wi-hail" style="font-size: 14px !important;"></i>';
    break;
    case '19': $icon  = '<i class="wi wi-cloudy-gusts" style="font-size: 14px !important;"></i>';
    break;
    case '20': $icon  = '<i class="wi wi-fog" style="font-size: 14px !important;"></i>';
    break;
    case '21': $icon  = '<i class="wi wi-fog" style="font-size: 14px !important;"></i>';
    break;
    case '22': $icon  = '<i class="wi wi-fog" style="font-size: 14px !important;"></i>';
    break;
    case '23': $icon  = '<i class="wi wi-cloudy-gusts" style="font-size: 14px !important;"></i>';
    break;
    case '24': $icon  = '<i class="wi wi-cloudy-windy" style="font-size: 14px !important;"></i>';
    break;
    case '25': $icon  = '<i class="wi wi-thermometer" style="font-size: 14px !important;"></i>';
    break;
    case '26': $icon  = '<i class="wi wi-cloudy" style="font-size: 14px !important;"></i>';
    break;
    case '27': $icon  = '<i class="wi wi-night-cloudy" style="font-size: 14px !important;"></i>';
    break;
    case '28': $icon  = '<i class="wi wi-day-cloudy" style="font-size: 14px !important;"></i>';
    break;
    case '29': $icon  = '<i class="wi wi-night-cloudy" style="font-size: 14px !important;"></i>';
    break;
    case '30': $icon  = '<i class="wi wi-day-cloudy" style="font-size: 14px !important;"></i>';
    break;
    case '31': $icon  = '<i class="wi wi-night-clear" style="font-size: 14px !important;"></i>';
    break;
    case '32': $icon  = '<i class="wi wi-day-sunny" style="font-size: 14px !important;"></i>';
    break;
    case '33': $icon  = '<i class="wi wi-night-clear" style="font-size: 14px !important;"></i>';
    break;
    case '34': $icon  = '<i class="wi wi-day-sunny-overcast" style="font-size: 14px !important;"></i>';
    break;
    case '35': $icon  = '<i class="wi wi-hail" style="font-size: 14px !important;"></i>';
    break;
    case '36': $icon  = '<i class="wi wi-day-sunny" style="font-size: 14px !important;"></i>';
    break;
    case '37': $icon  = '<i class="wi wi-thunderstorm" style="font-size: 14px !important;"></i>';
    break;
    case '38': $icon  = '<i class="wi wi-thunderstorm" style="font-size: 14px !important;"></i>';
    break;
    case '39': $icon  = '<i class="wi wi-thunderstorm" style="font-size: 14px !important;"></i>';
    break;
    case '40': $icon  = '<i class="wi wi-storm-showers" style="font-size: 14px !important;"></i>';
    break;
    case '41': $icon  = '<i class="wi wi-snow" style="font-size: 14px !important;"></i>';
    break;
    case '42': $icon  = '<i class="wi wi-snow" style="font-size: 14px !important;"></i>';
    break;
    case '43': $icon  = '<i class="wi wi-snow" style="font-size: 14px !important;"></i>';
    break;
    case '44': $icon  = '<i class="wi wi-cloudy" style="font-size: 14px !important;"></i>';
    break;
    case '45': $icon  = '<i class="wi wi-lightning" style="font-size: 14px !important;"></i>';
    break;
    case '46': $icon  = '<i class="wi wi-snow" style="font-size: 14px !important;"></i>';
    break;
    case '47': $icon  = '<i class="wi wi-thunderstorm" style="font-size: 14px !important;"></i>';
    break;
    case '3200': $icon  =  '<i class="wi wi-cloud" style="font-size: 14px !important;"></i>';
    break;
    default: $icon  =  '<i class="wi wi-cloud" style="font-size: 14px !important;"></i>';
    break;
  }

  return $icon;

}
?>
