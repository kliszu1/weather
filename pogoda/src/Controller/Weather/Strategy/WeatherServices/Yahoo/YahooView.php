<?php

namespace App\Controller\Weather\Strategy\WeatherServices\Yahoo;

/**
 * Description of YahooView
 *
 * @author Kliszu
 */
class YahooView {
    private $weatherData;
    
    public function setWeatherData(array $data){
        $this->weatherData = $data;
        return $this;
    }
    
    public function init(){
        return ['status'=>'ok','html'=>$this->prepareView()];
    }
    
    public function prepareView(){
        $html ='';
        
        foreach($this->weatherData['forecasts'] as $key => $val){
            $html .= <<<HTML
                <div class='weatherDayInfo'>
                    <label>
                        Dzień: <b>{$val['day']}</b> </br>
                        Maksymalna temp. <b>{$val['high']} C</b> </br>
                        Minimalna temp.<b>{$val['low']}  C</b> </br>
                    </label>
                </div>
            HTML;
        }
        
        return <<<HTML
            <div >
                <div class='weatherContenerInfo'>
                    <label>
                        Twoja lokalizacja: <b>{$this->weatherData['location']['city']}/{$this->weatherData['location']['region']}</b>
                        Wschód: <b>{$this->weatherData['current_observation']['astronomy']['sunrise']} </b>
                        Zachód: <b>{$this->weatherData['current_observation']['astronomy']['sunset']}</b>
                    </label>
                </div>
                <div class='weatherContenerDayInfo'>
                    {$html}
                </div>
                
            </div>
        HTML;
    }
}
