<?php
namespace App\Controller\Weather\Strategy\WeatherServices\Yahoo;

/**
 * Description of YahooServices
 *
 * @author Kliszu
 */
class YahooServices implements \App\Controller\Weather\Strategy\WeatherServicesInteface {
    
    const YAHOO_APP_ID = 'NuBBpS36';
    const YAHOO_CLIENT_ID  = 'dj0yJmk9Z0RnMW1wQktDaG1TJmQ9WVdrOVRuVkNRbkJUTXpZbWNHbzlNQS0tJnM9Y29uc3VtZXJzZWNyZXQmc3Y9MCZ4PTBk';
    const YAHOO_CLIENT_SECRET  = 'f2b4b1212e735e0d31a997dec107e0d983bf7228';
    const YAHOO_URL  = 'https://weather-ydn-yql.media.yahoo.com/forecastrss';
    
    private $city;
    private $options;
    
    public function setCity(string $city){
        $this->city = $city;
        return $this;
    }
    
    public function init(){
        $this->prepareDataToSend();
        return $this->getWeatherInfo();
    }
 
    public function prepareDataToSend(){
        $query = [
            "location" => "{$this->city},pl",
            "format" => "json",
            "u" => "c",
        ];
        
        $oauth = array(
            'oauth_consumer_key' => self::YAHOO_CLIENT_ID,
            'oauth_nonce' => uniqid(mt_rand(1, 1000)),
            'oauth_signature_method' => 'HMAC-SHA1',
            'oauth_timestamp' => time(),
            'oauth_version' => '1.0'
        );
        
        $baseInfo = $this->buildBaseString( array_merge($query, $oauth));
        $compositeKey = rawurlencode(self::YAHOO_CLIENT_SECRET) . '&';
        $oauthSignature = base64_encode(hash_hmac('sha1', $baseInfo, $compositeKey, true));
        $oauth['oauth_signature'] = $oauthSignature;

        $header = array(
            $this->buildAuthorizationHeader($oauth),
            'X-Yahoo-App-Id: ' . self::YAHOO_APP_ID
        );
        
        $this->options = array(
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_HEADER => false,
            CURLOPT_URL => self::YAHOO_URL . '?' . http_build_query($query),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false
        );
    }
    
    public function buildBaseString(array $params) {
        $result = [];
        ksort($params);
        
        foreach($params as $key => $value) {
            $result[] = "$key=" . rawurlencode($value);
        }
        
        return "GET&" . rawurlencode(self::YAHOO_URL) . '&' . rawurlencode(implode('&', $result));
    }
    
    public function buildAuthorizationHeader(array $oauth) {
        $result = 'Authorization: OAuth ';
        $values = [];
        
        foreach($oauth as $key=>$value) {
            $values[] = "$key=\"" . rawurlencode($value) . "\"";
        }
        
        $result .= implode(', ', $values);
        return $result;
    }
    
    public function getWeatherInfo(){
        $ch = curl_init();
        curl_setopt_array($ch, $this->options);
        $response = curl_exec($ch);
        curl_close($ch);
        
        $response = json_decode($response,true);
        
        if(empty($response)){
            return [
                'status'=>'error',
                'message'=>'Błąd pobierania danych'];
        }
        
        if(empty($response['location'])){
            return [
                'status'=>'error',
                'message'=>'Zła lokalizacja.'];
        }
        
        return [
            'status'=>'ok',
            'data'=>$response];
    }
}
