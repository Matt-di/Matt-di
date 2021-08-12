<?php
header("Access-Control-Allow-Origin:*");
// header("Content-Type:application/json; charset-UTF-8");
header("Access-Control-Allow-Methods:POST");
header("Access-Control-Max-Age:3600");
//header("Access-Control-Allow-Methods:GET");

include_once "../Class/UserOperation.php";
include_once "../config/Database.php";

$database = new Database();
$db = $database->getConnection();

$userOperation = new UserOperation($db);

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
if(isset($_POST['longitude']) && isset($_POST['latitude']))
{
    $userOperation->latitude = test_input($_POST['latitude']);
    $userOperation->longitude =  test_input($_POST['longitude']);
    
    $responseArray = $userOperation->updateLocation();
    if(!$responseArray)
    {
        //echo json_encode($responseArray);
        //echo json_encode(array("message" => "Updated succedully", "status" => true));
         echo json_encode(array("message" => "cant process your request", "status" => false));
    }
    else{
        //echo json_encode($responseArray);
        echo json_encode(array("message" => "Updated succedully", "status" => true));
    }
}
else{
    echo json_encode(array("message" => "cant process your request", "status" => false));
}
