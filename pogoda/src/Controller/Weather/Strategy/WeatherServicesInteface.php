<?php

namespace App\Controller\Weather\Strategy;

/**
 * Description of WeatherServicesInteface
 *
 * @author Kliszu
 */
interface WeatherServicesInteface {
    public function setCity($city);
    public function init();
    public function prepareJson();
    public function getWeatherInfo();
}
