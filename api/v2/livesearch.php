<?php

//Including Database configuration file.

require_once("db.php");

//Getting value of "search" variable from "script.js".

if (isset($_POST['search'])) {

//Search box value assigning to $Name variable.

   $Name = $_POST['search'];

//Search query.

//$Query = "SELECT name, city_name FROM property 
//WHERE name LIKE '%$Name%' LIMIT 5";


   $Query = "SELECT name, city_name, property.city_id, section, street FROM property 
   LEFT JOIN city ON city.city_id = property.city_id 
   WHERE property.name LIKE '%$Name%' OR city_name LIKE '%$Name%' OR section LIKE '%$Name%' OR street LIKE '%$Name%' LIMIT 5";

//Query execution

   $ExecQuery = MySQLi_query($connection, $Query);

//Creating unordered list to display result.

   echo '

<ul style="overflow-y:scroll; position:absolute;z-index:10000000; width:97%; box-shadow:0 0 20px rgb(78 78 78 / 10%)">

   ';

   //Fetching result from database.

   while ($Result = MySQLi_fetch_array($ExecQuery)) {

       ?>

   <!-- Creating unordered list items.

        Calling javascript function named as "fill" found in "script.js" file.

        By passing fetched result as parameter.  margin-top:-20px; margin-bottom: 20px; padding:20px; -->

   <li  style="background-color: white; margin-top:-20px; margin-bottom: 10px; padding:20px; " onclick='fill("<?php echo $Result['name']; ?>")'>

   <a>

   <!-- Assigning searched result in "Search box" in "search.php" file. -->

       <?php echo $Result['name']; ?>

   </li></a>

   <!-- Below php code is just for closing parenthesis. Don't be confused. -->

   <?php

}}


?>

</ul>