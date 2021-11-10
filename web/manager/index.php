<?php

/**
 * 
 * @author JGomezCecena
 * @link https://github.com/jlgcxyz/
 *
 */

//Header set X-Frame-Options "DENY";
//Set-Cookie: CookieName=CookieValue; SameSite=Lax; Set-Cookie: CookieName=CookieValue; SameSite=Strict;

require_once("config/db.php");
require_once("libraries/helper_functions.php");
require_once("classes/Login.php");
$login = new Login();



if ($login->isUserLoggedIn() == true) {
    include("views/logged_in.php");
} else {
    include("views/not_logged_in.php");
}
