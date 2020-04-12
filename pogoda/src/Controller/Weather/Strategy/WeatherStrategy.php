<?php

namespace App\Controller\Weather\Strategy;

/**
 * Description of WeatherStrategy
 *
 * @author Kliszu
 */
class WeatherStrategy {
    public function selectService($service){
        switch($service){
            case \App\Controller\Weather\Dictionary\WeatherServicesDictionary::KEY_YAHOO:
                return new WeatherServices\YahooServices();
            break;
            default:
                return false;
        }
    }
}
