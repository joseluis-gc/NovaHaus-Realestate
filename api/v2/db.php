<?php
/**
 * Settings
**/

header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, POST');

header("Access-Control-Allow-Headers: X-Requested-With");

//output buffering 
ob_start();

//set_timezone
date_default_timezone_set("America/Tijuana");


//set smtp values
define("SMTP_HOST","smtp.jlgcxyz.com");
define("SMTP_USER","joseluisgc");
define("SMTP_PASSWORD","password123");
define("SMTP_SECURITY","tls");
define("SMTP_PORT","25");

/**
  * DB Connection  
**/
define("DB_HOST", "localhost");
define("DB_NAME", "adminsystems_realestate");
define("DB_USER", "root");
define("DB_PASS", "");


/***
 * 
 * define("DB_HOST", "localhost");
define("DB_NAME", "smartlab_realestate");
define("DB_USER", "smartlab_user");
define("DB_PASS", "databaseuser1!");

 */

$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
 
if ($connection->connect_error) { 
    die("Connection Error: " . $connection->connect_error); 
}


