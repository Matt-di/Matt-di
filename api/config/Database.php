<?php
class Database
{
    private $host;
    private $user;
    private $password;
    private $dbName;

    function __construct(
        $host = "localhost",
        $user = "root",
        $password = "",
        $dbName = "smart_irrigation"
    ) {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->dbName = $dbName;
    }
    /**
     * Function Used to get The connection
     * @return connection - Database Link or
     * @return message - which indicate error message
     */
    public function getConnection()
    {
        $conn = new mysqli($this->host, $this->user, $this->password, $this->dbName);
        if($conn->connect_errno)
        {
            die("Sorry Error occurred during data base connection".$conn->connect_errno);

        }else{
            return $conn;
        }
    }
}
