<?php

class WeatherAPI {
    private $longitude;
    private $latitude;
    private $location;


    private $weatherApiKey;
    private $weatherUrl = "http://api.openweathermap.org";
    
    function __construct($lat,$long)
    {
        $this->latitude = $lat;
        $this->longitude = $long;
    }

    function fetchData()
    {
        $sQuery = http_build_query([]);
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$this->weatherUrl);
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_FOLLOWLOCATION,true);
        curl_setopt($ch,CURLOPT_VERBOSE,0);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);

        $response = curl_exec($ch);

        curl_close($ch);
        $weatherData = json_decode($response);

        return $weatherData;
        
    }

}


?>