<?php

$WEB_URL = 'http://127.0.0.1/hrd/';
$ROOT_PATH = 'C:\xampp\htdocs\hrd';

$host = "localhost";
$username = "root";
$password = "";
$database = "hrd4";

# For connection of database
$con = mysqli_connect("$host","$username","$password","$database");

      date_default_timezone_set("Asia/Manila");
# For connection failed
if (!$con) 
{   
    die();
}


?>