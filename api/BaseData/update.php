<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json; charset= UTF-8");
header("Access-Control-Allow-Methods:PUT");
header("Access-Control-Max-Age:3600");

include_once "../Class/BaseData.php";
include_once "../config/Database.php";

$database = new Database();
$db = $database->getConnection();

$baseData = new BaseData($db);

$inputdata = json_decode(file_get_contents("php://input"));

if(true)
{
    //$baseData->id = $inputdata->id;
    $baseData->name = $inputdata->name;
    $baseData->value = $inputdata->value;

    if($baseData->update())
    {
        http_response_code(200);
        echo json_encode(array("message"=>"Data updated successfully","status"=>true));
    }
    else
    {
        http_response_code(503);
        echo json_encode(array("message"=>"Can't carry out the operation","status"=>false));

    }

}
else
{
    http_response_code(400);
    echo json_encode(array("message"=>"Data is not complete"));
}