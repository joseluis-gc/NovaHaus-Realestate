<?php
//setting header to json
header('Content-Type: application/json');

require_once("../../config/db.php");

//get connection
if(!$connection){
  die("Connection failed: " . $connection->error);
}

$today = date("Y-m-d");
$start = $today." 00:00:00";
$end   = $today." 23:59:59";

//query to get data from the table
$query = sprintf("SELECT COUNT(id) AS numero, tipo, cat_name FROM property LEFT JOIN property_category ON property_category.cat_id = property.tipo WHERE 1 GROUP BY property.tipo");

//execute query
$result = $connection->query($query);

//loop through the returned data
$data = array();
foreach ($result as $row) {
  $data[] = $row;
}

//free memory associated with result
$result->close();

//close connection
$connection->close();

//now print the data
print json_encode($data);