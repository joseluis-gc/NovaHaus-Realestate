<?php

require_once("../../config/db.php");
echo "works";
if(!empty($_POST["country_id"]))
{ 
  

    echo $query = "SELECT * FROM state WHERE country_id = ".$_POST['country_id']." "; 
    $result = $connection->query($query); 
     
    if($result->num_rows > 0)
    { 
        echo '<option value="">Seleccione un pais</option>'; 
        while($row = $result->fetch_assoc())
        {  
            echo '<option value="'.$row['state_id'].'">'.$row['state_name'].'</option>'; 
        } 
    }
    else
    { 
        echo '<option value="">No hay estados.</option>'; 
    } 
}
elseif(!empty($_POST["state_id"]))
{ 
    // Fetch city data based on the specific state 
    $query = "SELECT * FROM city WHERE state_id = ".$_POST['state_id']." "; 
    $result = $connection->query($query); 
     
    // Generate HTML of city options list 
    if($result->num_rows > 0)
    { 
        echo '<option value="">Seleccione estado</option>'; 
        while($row = $result->fetch_assoc())
        {  
            echo '<option value="'.$row['city_id'].'">'.$row['city_name'].'</option>'; 
        } 
    }
    else
    { 
        echo '<option value="">No hay ciudades.</option>'; 
    } 
} 