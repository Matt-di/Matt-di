<?php

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
}
