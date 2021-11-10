<?php
require_once ('views/includes/public/header.php');

// show potential errors / feedback (from login object)
if (isset($login)) {
    if ($login->errors) {
        foreach ($login->errors as $error) {
            echo $error;
        }
    }
    if ($login->messages) {
        foreach ($login->messages as $message) {
            echo $message;
        }
    }
}

switch($page)
{
    case "andon_client":
        include("pages/andon_client/index.php");
    break;

    default:
        include("pages/login/login.php");
    break;
}


require_once ('views/includes/public/footer.php'); 
?>


