<?php
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : "index";
switch ($action) {
    case "index":
        $include_content = "templates/index_content.html.php";
        break;
    case "add_channel":
        include "new_channel.php";
        break;
    case "edit_channel":
        include "edit_channel.php";
        break;
    case "edit_video":
        include "edit_video.php";
        break;
    case "delete_video":
        include "delete_video.php";
        break;
    case "delete_channel":
        include "delete_channel.php";
        break;
    case "upload":
        include "upload_video.php";
        break;
    case "view_channel":
        include "view_channel.php";
        break;
    case "sort":
        include "sort.php";
        break;
    case "change_status_video":
        $table = $table_webtv_video;
        include "change_status.php";
        break;
    case "change_status_channel":
        $table = $table_webtv_channel;
        include "change_status.php";
        break;
    case "change_shared_status":
        $table = $table_webtv_video;
        $status_field = "shared_status";
        include "change_status.php";
        break;
    case 'view_video':
        include 'view_video.php';
        break;
    case 'search_video':
        include 'search_video.php';
        break;
    default:
        header('HTTP/1.0 404 Not found');
        exit;
 }
 echo "\n";