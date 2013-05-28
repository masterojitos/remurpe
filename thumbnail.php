<?php
require_once '../inc/global.inc.php';

$this_section = SECTION_COURSES;

if (!isset($_GET['file']) || $_GET['file'] == "") {
    Display::display_error_message("You are not allowed to access this page.", false, true);
    exit;
}

$path = '../upload/webtv/' . (strpos($_GET['file'], '.mp4') === false ? 'channels/' : 'thumbs/');
$path_array = explode("/", api_get_path(WEB_PATH));
$client = $path_array[count($path_array) - 2];
$filename = $path . $client . '/' . $_GET['file'];

try {
    require_once 'includes/MO_Image.class.php';
    $image = new MO_Image($filename);
    $image->setAutofill(true, true);
    $image->thumbnail(200, 150);
    $image->output();
} catch(Exception $e) {
    Display::display_error_message($e->getMessage(), false, true);
}