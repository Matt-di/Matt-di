<?php
include("config.php");
$action = new Action;
$conn = new mysqli("localhost", "root", "", "smart_irrigation");

if (isset($_POST['page'])) {
    if ($_POST['page'] == 'login') {
        if ($_POST['action'] == "login") {
            $username = $_POST['sis-username'];
            $password = $_POST['sis-password'];
        }
    }
    if ($_POST['page'] == "manage") {
        if ($_POST['action'] == "update") {
        }
    }
    if ($_POST['page'] == "data") {
        if ($_POST['action'] == "fetchSoil") {

            $query = "SELECT soil_moisture,updated_date,humidity,temperature from sensor_detail ORDER BY data_id DESC limit 15  ";
            $result = $conn->query($query);
            $data = array();
            $xAxis = array();
            $soilMoisture = array();
            $humidity = array();
            $temperature = array();
            $i = 0;
            if ($result->num_rows > 0)
                while ($row = $result->fetch_assoc()) {
                    $xAxis[] = explode(" ", $row['updated_date'])[1];
                    $soilMoisture[] = $row['soil_moisture'];
                    $temperature[] = $row['temperature'];
                    $humidity[] = $row['humidity']-950;
                }
            $data = array(
                "xAxis" => $xAxis,
                "soilMoisture" => $soilMoisture,
                "temperature" => $temperature,
                "humidity" => $humidity,
            );
            echo json_encode($data);
        } else {
            echo json_encode("mat");
        }
    }
} elseif (isset($_REQUEST['api_key'])) {
    if ($_REQUEST['action'] == "fetch") {
        $query = "SELECT * FROM basedata";
        $result = $conn->query($query);
        $data = array();
        if ($result->num_rows > 0)
            while ($row = $result->fetch_assoc()) {
                $data["soilMoistureTV"] = $row['soil_moistureTV'];
                $data["humidityTV"] = $row['humidityTV'];
                $data["temperatureTV"] = $row['temperatureTV'];
                $data["controlMode"] = $row['control_mode'];
                $data["motorStatus"] = $row['motor_status'];
                $data["requestTime"] = $row['request'];
                $data["apiKey"] = $row['api_key'];
            }
        if ($data != "") {
            echo json_encode($data);
        } else {
            echo "No data";
        }
    }
    if ($_REQUEST['action'] == "update") {
        $apiKey = $_POST['api_key'];
        $soilMoisture = $_POST['soilMoisture'];
        $temperature = $_POST['temperature'];
        $humidity = $_POST['humidity'];
        $sensorId = $_POST['sensor'];
        $motor = $_POST['motorStatus'];
        $query = "INSERT INTO 
                        sensor_detail (soil_moisture,temperature,humidity,motor_pump_status)
                        VALUES($soilMoisture,$temperature,$humidity,$motor)";
        if ($conn->query($query)) {
            $query = "UPDATE basedata
                     SET motor_status=$motor
                     WHERE id=1";
            if($conn->query($query));
            echo "Sucess" . $humidity;
        } else {
            echo "Error Ocurred data not inserted";
        }
    }
}
