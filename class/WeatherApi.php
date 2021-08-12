<?php

class WeatherAPI {
    private $longitude;
    private $latitude;
    private $location;


    private $weatherApiKey="";
    private $weatherUrl = "http://api.openweathermap.org/data/2.5";
    
    function __construct($location)
    {
        $this->latitude = $location["lat"];
        $this->longitude = $location['lon'];
    }

    function fetchData()
    {
        
        $sQuery = $this->weatherUrl."forecast?lon=".$this->longitude."&lat=".$this->latitude."&appid=".$this->weatherApiKey;
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$sQuery);
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_FOLLOWLOCATION,true);
        curl_setopt($ch,CURLOPT_VERBOSE,0);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);

        $response = curl_exec($ch);

        curl_close($ch);
        $weatherData = json_decode($response,true);

        return $weatherData;
        
    }

}


?>