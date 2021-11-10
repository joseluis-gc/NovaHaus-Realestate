<?php

//Including Database configuration file.

require_once("../../../manager/config/db.php");

//Getting value of "search" variable from "script.js".

if (isset($_POST['search'])) {

//Search box value assigning to $Name variable.

   $Name = $_POST['search'];

//Search query.

   $Query = "SELECT name FROM property WHERE name LIKE '%$Name%' LIMIT 5";

//Query execution

   $ExecQuery = MySQLi_query($connection, $Query);

//Creating unordered list to display result.

   echo '

<ul  class="collection">

   ';

   //Fetching result from database.

   while ($Result = MySQLi_fetch_array($ExecQuery)) {

       ?>

   <!-- Creating unordered list items.

        Calling javascript function named as "fill" found in "script.js" file.

        By passing fetched result as parameter. -->

   <li class="collection-item" style="background-color: white;" onclick='fill("<?php echo $Result['name']; ?>")'>

   <a>

   <!-- Assigning searched result in "Search box" in "search.php" file. -->

       <?php echo $Result['name']; ?>

   </li></a>

   <!-- Below php code is just for closing parenthesis. Don't be confused. -->

   <?php

}}


?>

</ul>