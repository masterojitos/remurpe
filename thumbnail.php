<?php
if (!isset($_GET['file']) || $_GET['file'] == "") exit;
$filename = './userfiles/' . $_GET['file'];
try {
    require_once 'includes/MO_Image.class.php';
    $image = new MO_Image($filename);
    $image->setAutofill(true, true);
    $image->thumbnail(150, 200);
    $image->output();
} catch(Exception $e) {
    Display::display_error_message($e->getMessage(), false, true);
}