<?php
require_once("views/includes/private/header.php");
require_once("views/includes/private/sidebar.php");



switch($page)
{

    case "create_property":
        include("pages/property/create_property.php");
    break;

    case "property_gallery":
        include("pages/property/property_gallery.php");
    break;

    case "view_property":
        include("pages/property/view_property.php");
    break;


    case "create_user":
        include("pages/users/create_user.php");
    break;

    case "view_user":
        include("pages/users/view_users.php");
    break;

    case "edit_user":
        include("pages/users/edit_user.php");
    break;

    case "andon_respond":
        include("pages/andon_admin/andon_respond.php");
    break;

    case "andon_solution":
        include("pages/andon_admin/andon_solution.php");
    break;

    case "andon_reports":
        include("pages/andon_admin/andon_reports.php");
    break;



    default:
        include("pages/home/home.php");
    break;
}



require_once("views/includes/private/footer.php");
