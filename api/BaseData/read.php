<?php 
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json");

include_once "../Class/BaseData.php";
include_once "../config/Database.php";

$database = new Database();
$db = $database->getConnection();
$baseData = new BaseData($db);

$baseData->id = (isset($_GET['id']) && $_GET['id'])?$_GET['id']:"0";
$result = $baseData->read();

if($result->num_rows>0)
{
    $baseDatas['baseDatas'] = array();
    while($row = $result->fetch_assoc())
    {
        extract($row);
        $data = array(
            "id"=>$id,
            "name"=>$name,
            "value"=>$value
        );

        array_push($baseDatas['baseDatas'],$data);

    }

    http_response_code(200);
    echo json_encode($baseDatas);
}else{
    http_response_code(200);
    echo json_encode(array("message"=>"There is no data in the record"));
}


