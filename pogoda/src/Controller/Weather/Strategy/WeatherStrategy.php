<?php

namespace App\Controller\Weather\Strategy;

/**
 * Description of WeatherStrategy
 *
 * @author Kliszu
 */
class WeatherStrategy {
    public function selectService(string $service){
        switch($service){
            case \App\Controller\Weather\Dictionary\WeatherServicesDictionary::KEY_YAHOO:
                return [
                    'status' => 'ok', 
                    'services' => new WeatherServices\Yahoo\YahooServices(), 
                    'view' => new WeatherServices\Yahoo\YahooView()];
            break;
            default:
                return [
                    'status' => 'error',
                    'message'=>'Nie znaleziono wybranego serwisu.'];
        }
    }
}
