<?php 

require_once("../../../config/db.php");

$query = "SELECT * FROM property 
LEFT JOIN property_category ON property.tipo = property_category.cat_id 
LEFT JOIN country ON country.country_id = property.country_id 
LEFT JOIN state ON state.state_id = property.state_id 
LEFT JOIN city ON city.city_id = property.city_id";
$result = mysqli_query($connection, $query);


$data = array();
while ($row = mysqli_fetch_array($result)) {

  if($row['vor'] == "v"){
    $vor = "Venta";
  }
  elseif($row['vor'] == "r"){
    $vor = "Renta";
  }
  elseif($row['vor'] == "t"){
    $vor = "Traspaso";
  }
  else{
    $vor = "N/A";
  }

  $imagen = substr($row['imagen_principal'],6);
  $precio_interno = number_format($row['precio_interno'],2);
  $precio = number_format($row['precio'],2);

  $data[] = array(
    $row['id'],
    $row['name'],
    $row['cat_name'],
    $vor,
    $row['street'] . " " . $row['number'] . " " . $row['section'] . ", " .$row['city_name'] . " " . $row['state_name'] . " " . $row['country'],
    $row['recamaras'],
    $row['bathrooms'],
    "$" . $precio_interno,
    "$" . $precio,
    $row['terreno'],
    "<img class='img-fluid' src='{$row['imagen_principal']}'>",
    "<a class='btn btn-secondary' href='index.php?page=details_property&id={$row['id']}'>Detalles</a>",
    "<a class='btn btn-secondary' href='index.php?page=edit_property&id={$row['id']}'>Editar</a>",
    "<a class='btn btn-secondary' href='index.php?page=delete_property&id={$row['id']}'>Borrar</a>",
    "<a class='btn btn-secondary' href='index.php?page=gallery_property&id={$row['id']}'>Galeria</a>"
  ); 
}

$response = array(
    "aaData" => $data
);
echo json_encode($response);