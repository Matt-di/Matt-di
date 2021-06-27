<?php
class Sensor
{
    public $data_id;
    public $soilMoisture;
    public $temperature;
    public $humidity;
    public $motorStatus;
    public $updatedDate;

    private $database;
    private $sensorTable;
    function __construct($database)
    {
        $this->database = $database;
        $this->sensorTable = "sensor_detail";
    }

    /**
     * Used to add sensor detail to the database
     * here i'm using this function for the RESTful api
     * operation which is POST
     * @return boolean - added successfully or not
     */
    function insert()
    {
        $stmt = $this->database->prepare(
            "INSERT INTO " . $this->sensorTable .
                " ( 'soil_moisture','temperature',
            'humidity','motor_status)
             VALUES (?,?,?,?)"
        );

        $this->soilMoisture = $this->cleanInput($this->soilMoisture);
        $this->humidity = $this->cleanInput($this->humidity);
        $this->temperature = $this->cleanInput($this->temperature);
        $this->motorStatus = $this->cleanInput($this->motorStatus);

        $stmt->bind_param(
            "dddi",
            $this->soilMoisture,
            $this->temperature,
            $this->humidity,
            $this->motorStatus
        );

        if($stmt->execute()){
            $stmt->close();
            return true;
        }

        return false;
    }

    function read()
    {
        if($this->data_id)
        {
            $stmt = $this->database->prepare(
                "SELECT * FROM ".$this->sensorTable.
                " WHERE data_id =?"
            );

            $stmt->bind_param("i",$this->data_id);
        }else{
            $stmt = $this->database->prepare(
                "SELECT * FROM ".$this->sensorTable
            );
        }
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }

    function cleanInput($input)
    {
        return htmlspecialchars(strip_tags($input));
    }
}
