<?php
class BaseData
{
    public $id;
    //for basedata database table
    public $soilMoistureTV;
    public $temperatureTV;
    public $humidityTV;
    public $motorStatus;
    public $controlMode;
    public $apiKey;
    public $requestTime;

    //for base_data database table
    //public $id
    public $name;
    public $value;

    private $baseDataTable;
    private $database;

    /**
     * Creating new BaseData instance
     * require one parameter
     * @param database - database connection
     */
    function __construct($database)
    {
        $this->baseDataTable = "base_data";
        $this->database = $database;
    }

    /**
     * For reading data records
     */
    function read()
    {

        if ($this->id) {
            $stmt = $this->database->prepare(
                "SELECT * FROM " . $this->baseDataTable .
                    "WHERE id=?"
            );
            $stmt->bind_param("i", $this->id);
        } else {
            $stmt = $this->database->prepare(
                "SELECT * FROM " . $this->baseDataTable
            );
        }

        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }

    function update()
    {
        
            $this->id = $this->cleanInput($this->id);
            $this->soilMoistureTV = $this->cleanInput($this->soilMoistureTV);
            $this->humidityTV = $this->cleanInput($this->humidityTV);
            $this->temperatureTV = $this->cleanInput($this->temperatureTV);
            $this->motorStatus = $this->cleanInput($this->motorStatus);
            $this->controlMode = $this->cleanInput($this->controlMode);
            $this->apiKey = $this->cleanInput($this->apiKey);
            $this->requestTime = $this->cleanInput($this->requestTime);

            $this->name = $this->cleanInput($this->name);
            $this->value = $this->cleanInput($this->value);



            if(!empty($this->name)){
            $query  = "UPDATE base_data
                        SET value=? WHERE name=?";
            $stmt = $this->database->prepare($query);

            $stmt->bind_param("ss",$this->value,$this->name);

            if($stmt->execute())
            {
                return true;
            }

            }
        return false;
        
    }
    

    function cleanInput($input)
    {
        return htmlspecialchars(strip_tags($input));
    }
}
