<?php
$mod = isset($_REQUEST['mod']) ? $_REQUEST['mod'] : 0;
$id = isset($_GET['id']) ? $_GET['id'] : "";
$do = isset($_POST['do']) ? $_POST['do'] : "";
$page = isset($_POST['mod']) ? (empty($do) ? "-list" : ($do == 1 ? "-form" : "-action")) : "";
switch($mod){
    case 0: include "modules/welcome.php"; break;
//    case 1: include "modules/upload.php"; break;
//    case 2: include "modules/activate.js"; break;
//    case 3: include "modules/tinymce.js"; break;
    case 5: include "modules/access.php"; break;
    case 6: include "modules/forgot_password.php"; break;
    case 7: include "modules/logout.php"; break;

    case 10: include "modules/configuration/access$page.php"; break;
//    case 11: include "modules/configuration/appearance$page.php"; break;
//    case 12: include "modules/configuration/company$page.php"; break;
//    case 13: include "modules/configuration/api$page.php"; break;

    case 20: include "modules/jobapplication/postulation$page.php"; break;

    default: include "modules/sale.php"; break;
}
?>