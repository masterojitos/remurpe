<?php
// including the global dokeos file
require_once '../inc/global.inc.php';
// section (for the tabs)
$this_section = SECTION_COURSES;

api_protect_course_script();

$table_webtv_catalogue = Database::get_course_table(TABLE_WEBTV_CATALOGUE);
$table_webtv_channel = Database::get_course_table(TABLE_WEBTV_CHANNEL);
$table_webtv_video = Database::get_course_table(TABLE_WEBTV_VIDEO);
$table_webtv_position = Database::get_course_table(TABLE_WEBTV_POSITION);

require "includes/functions.php";

$path_array = explode("/", api_get_path(WEB_PATH));
$client = $path_array[count($path_array) - 2];

$stream_server = "dokeos.net";//dokeos.net

$user_id = api_get_user_id();
$session_id = api_get_session_id();