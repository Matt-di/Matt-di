<?php
$host = 'localhost';
$username="root";
$password = "";
$dbname = "smart_irrigation";
$conn = new mysqli($host,$username,$password,$dbname);
if(!$conn){
    die("Cannot create connection to the database for the moment");
}