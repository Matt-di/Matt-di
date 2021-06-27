<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json; charset-UTF-8");

include_once "../Class/Sensor.php";
include_once "../config/Database.php";

$database = new Database();
$db = $database->getConnection();

$sensor = new Sensor($db);

$sensor->data_id = (isset($_GET['id']) && $_GET['id'])?$_GET['id']:'0';
$result = $sensor->read();

if($result->num_rows >0){
    $sensorDatas = array();
    $sensorDatas['datas'] = array();

    while($row = $result->fetch_assoc())
    {
        extract($row);
        $data = array(
            "data_id" => $data_id,
            "soilMoisture" => $soil_moisture,
            "humidity" => $humidity,
            "temperature" => $temperature,
            "motorStatus" => $motor_pump_status,
            "recommendation" =>$recommendation
        );
        array_push($sensorDatas['datas'],$data);


    }

    http_response_code(200);
    echo json_encode($sensorDatas);

}
else{
    http_response_code(400);
    json_encode(array("message"=>"Input data is incorrect"));
}