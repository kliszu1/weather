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
        return $this->render('Weather/index.html.twig');
    }
}
