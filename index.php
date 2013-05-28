<?php
require_once 'config.php';

include 'routing.php';

$course_info = api_get_course_info(api_get_course_id());
$course_code = $course_info['id'];
$course_name = $course_info['name'];
$session_id = api_get_session_id();
$session_name = api_get_session_name(api_get_session_id());

$tool_header = $course_name;
if ($session_id != 0) {
    $tool_header .= " ($session_name)";
}
if (api_is_allowed_to_edit()) {
    $update_user_id = 0;
} else {
    $update_user_id = $user_id;
    $sql = "SELECT `id` FROM $table_webtv_position WHERE `user_id` = '" . $update_user_id . "';";
    $result = Database::query($sql, __FILE__, __LINE__);
    if (Database::affected_rows() == 0) {
        $sql = "SELECT `id`, `parent_id`, `parent_type`, `value` 
                FROM $table_webtv_position WHERE `user_id` = '0';";
        $result = Database::query($sql, __FILE__, __LINE__);
        while ($newposition = Database::fetch_array($result, 'ASSOC')) {
            $sql = "INSERT INTO $table_webtv_position (
                          `user_id`, `parent_id`, `parent_type`, `value`
                      ) VALUES (
                          '" . $update_user_id . "', 
                          '" . $newposition['parent_id'] . "', 
                          '" . $newposition['parent_type'] . "', 
                          '" . $newposition['value'] . "'
                      ); ";
            Database::query($sql, __FILE__, __LINE__);
        }
    }
}
$sql = "SELECT id, parent_id, parent_type FROM $table_webtv_position WHERE user_id = '" . $update_user_id . "' ORDER BY value ASC";
$result = Database::query($sql, __FILE__, __LINE__);
$articles = array();
$add_status = "";
if (!api_is_allowed_to_edit()) {
    $add_status = " AND `status` = '1'";
}
while ($position = Database::fetch_array($result, 'ASSOC')) {
    if ($position['parent_type'] == 1) {
        $sql = "SELECT id, name, image_src, `status` FROM $table_webtv_channel WHERE id = '" . $position['parent_id'] . "'" . $add_status;
        $rs = Database::query($sql, __FILE__, __LINE__);
        if (Database::affected_rows() == 0) continue;
        $row = Database::fetch_array($rs, 'ASSOC');
        if (!api_is_allowed_to_edit()) {
            $sql = "SELECT id FROM $table_webtv_video WHERE channel_id = '" . $row['id'] . "'" . $add_status;
            Database::query($sql, __FILE__, __LINE__);
            if (Database::affected_rows() == 0) continue;
        }
        $articles[] = array('id' => $row['id'], "position_id" => $position['id'], "type" => "channel", "name" => $row['name'], "status" => $row['status'], "image" => $row['image_src']);
    } else {
        $sql = "SELECT id, channel_id, title, video_src, `status`, shared_status FROM $table_webtv_video WHERE id = '" . $position['parent_id'] . "'" . $add_status;
        $rs = Database::query($sql, __FILE__, __LINE__);
        if (Database::affected_rows() == 0) continue;
        $row = Database::fetch_array($rs, 'ASSOC');
        if ($row['channel_id'] == 0) {
            $articles[] = array('id' => $row['id'], "position_id" => $position['id'], "type" => "video", "name" => $row['title'], "status" => $row['status'], "shared_status" => $row['shared_status'], "file" => $row['video_src']);
        }
    }
}

include "templates/index.html.php";