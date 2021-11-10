<?php
require_once("../../config/db.php");

$data = array();

$today = date("Y-m-d");
$query = "SELECT COUNT(*) FROM andon ";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_array($result);
$data["total"] = $row[0];



$query = "SELECT COUNT(*) FROM andon WHERE andon_attention = 0";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_array($result);
$data["pending"] = $row[0];



$query = "SELECT COUNT(*) FROM andon WHERE andon_attention = 1";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_array($result);
$data["working"] = $row[0];



print json_encode($data);
?>