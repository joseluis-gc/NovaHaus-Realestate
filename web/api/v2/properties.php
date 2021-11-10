<?php

require_once("../../../manager/config/db.php");
$array = array();
$query = "SELECT * FROM  property";
$result = mysqli_query($connection, $query);
while($row = mysqli_fetch_array($result))
{
    $array[] = $row;
}

echo json_encode($array);