<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json; charset= UTF-8");
header("Access-Control-Allow-Methods:POST");
header("Access-Control-Max-Age:3600");

include_once "../Class/Sensor.php";
include_once "../config/Database.php";

$database = new Database();
$db = $database->getConnection();

$sensorsData = new Sensor($db);

$inpuData = json_decode(file_get_contents("php://input"));

if($inpuData)
    {
        $sensorsData->soilMoisture = $inpuData->soilMoisture;
        $sensorsData->temperature = $inpuData->temperature;
        $sensorsData->humidity = $inpuData->humidity;
        $sensorsData->motorStatus = $inpuData->motorStatus;

        if($sensorsData->insert())
        {
            http_response_code(200);
            echo json_encode(array("message"=>"data inserted successfully"));
        }else{
            http_response_code(500);
            echo json_encode(array("message"=>"couldn't insert into database"));
        }
    }
    else{
        http_response_code(400);
        echo json_encode(array("message"=>"Data is not correct"));
    }