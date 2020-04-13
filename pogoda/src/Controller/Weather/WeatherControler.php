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

    public function index()
    {
        return $this->render('weather/index.html.twig');
    }

    public function getWeatherControler(){
        $weatherStrategy = new Strategy\WeatherStrategy();
        
        $result = $weatherStrategy->selectService($_POST['serviceType']);
        
        if($result['status'] == 'error'){
            echo json_encode($result);
            exit;
        }
        
        $servies = $result['services'];
        $view = $result['view'];
        
        $response = $servies
            ->setCity($_POST['city'])
            ->init();
        
        if($response['status'] == 'error'){
            echo json_encode($response);
            exit;
        }
        
        $response = $view
            ->setWeatherData($response['data'])
            ->init();
        
        echo json_encode($response);
        exit;
    }
}
