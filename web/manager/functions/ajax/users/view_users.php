<?php 

require_once("../../../config/db.php");

$query = "SELECT * FROM users";
$result = mysqli_query($connection, $query);


$data = array();
while ($row = mysqli_fetch_array($result)) {
  $data[] = array(
    $row['user_id'],
    "<img style='width:80px;' src='{$row['user_image']}' class='brand-image img-circle elevation-3'>",
    $row['user_firstname'] . " " . $row['user_lastname'] ,
    $row['user_name'],
    $row['user_email'],
    $row['user_phone'],
    $row['user_number'],
    "<a href='index.php?page=edit_user&id={$row['user_id']}' class='btn btn-primary'>Editar</a>",
    "<a href='index.php?page=details_user&id={$row['user_id']}' class='btn btn-light'>Detalles</a>"
  ); 
}

$response = array(
    "aaData" => $data
);
echo json_encode($response);