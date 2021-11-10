<?php
//set_timezone
date_default_timezone_set("America/Tijuana");

define("DB_HOST", "localhost");
define("DB_NAME", "adminsystems_realestate");
define("DB_USER", "root");
define("DB_PASS", "");

$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
 
if ($connection->connect_error) { 
    die("Connection Error: " . $connection->connect_error); 
}
