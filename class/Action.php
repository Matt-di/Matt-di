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
    function updateLanguage($lang)
    {
        $query = "UPDATE setting SET lang='$lang'";
        if ($this->conn->query($query)) {
            return true;
        } else return false;
    }

    function selectLanguage()

    {

        $query = "SELECT lang FROM setting";
        $result = $this->conn->query($query);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc() ;
                return $row['lang'];
            
        }
    }

    function setSession()
    {
    }

    function isSetSession()
    {
        if (isset($_SESSION['email']) && isset($_SESSION['password']) && isset($_SESSION['userLogged'])) {
            return true;
        }

        return false;
    }
}
