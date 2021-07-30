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
if(isset($_POST['email']) && isset($_POST['password']))
{
    $userOperation->email = test_input($_POST['email']);
    $userOperation->password =  test_input($_POST['password']);
    
    $responseArray = $userOperation->loginUser();
    if($responseArray['status'])
    {
        echo json_encode($responseArray);
       // echo json_encode(array("message" => "cant process your request", "status" => true));
    }
    else{
        echo json_encode($responseArray);
        //echo json_encode(array("message" => "cant process your request", "status" => false));
    }
}
else{
    echo json_encode(array("message" => "cant process your request", "status" => false));
}
