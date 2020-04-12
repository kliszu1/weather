<?php

namespace App\Controller\Weather;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of WeatherControler
 *
 * @author Kliszu
 */
class WeatherControler  extends AbstractController{
    
    private $city;
    private $service;
    
    function setCity($city) {
        $this->city = $city;
        return $this;
    }

    function setService($service) {
        $this->service = $service;
        return $this;
    }

    public function index()
    {
        return $this->render('weather/index.html.twig');
    }

    public function getWeather(){
        echo exit;
        //return new JsonResponse('dupa');
//        $weatherStrategy = new Strategy\WeatherStrategy();
//        
//        $object = $weatherStrategy->selectService($this->service);
//        $object
//            ->setCity()
//            ->init()
//            ->prepareJson()
//            ->getWeatherInfo();
        
    }
}
