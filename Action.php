<?php
        session_start();

class Action
{

    var $host;
    var $username;
    var $password;
    var $dbname;

    var $query;
    var $stmt;
    var $row;
    var $data;
    var $param;
    function __construct()
    {
        $this->host = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->dbname = "smart_irrigation";
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);
    }

    function executeQuery()
    {
        # code...
        return  $this->conn->query($this->query);
    }

    function selectLanguage($language)

    {
        if (!empty($language)) {
            $query = "SELECT lang FROM setting";
            $result = $this->conn->query($query);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    return $row['lang'];
                }
            } else return $language;
        }
    }

    function setSession()
    {

    }

    function isSetSession()
    {
        if(isset($_SESSION['email'])&& isset($_SESSION['password'])&& isset($_SESSION['userLogged']))
        {
            return true;
        }

        return false;
    }
}
