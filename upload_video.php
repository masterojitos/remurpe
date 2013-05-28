<?php
if (isset($_POST['video'])) {
    $progress_token = $_POST['progress_token'];
    require 'includes/VideoClass.php';
    $new_video = new VideoClass($_FILES['video']);
    $result_video = $new_video->upload();
    $code = $result_video['code'];
    $message = $result_video['message'];
    $filename = basename($_FILES['video']['name']['file']);
    if ($code == 200) {
        progress_form(80);
        $video = $_POST['video'];
        $video_canonical = Database::escape_string(substr($filename, 0, strlen($filename) - 4));
        
        $sql = "INSERT INTO $table_webtv_video (`channel_id`, `title`, `keywords`, `description`, `video_src`, `video_canonical`, `format`, `duration`, `sizes`) 
                VALUES ('" . (int)$video['channel'] . "', '" . Database::escape_string(utf8_decode($video['title'])) . "', '" . Database::escape_string(utf8_decode($video['keywords'])) . "', '" . Database::escape_string(utf8_decode($video['description'])) . "', 
                '" . Database::escape_string($new_video->video_src) . "', '" . $video_canonical . "', '" . $new_video->format . "', '" . Database::escape_string($new_video->duration) . "', '')";
        Database::query($sql, __FILE__, __LINE__);
        $video_id = Database::insert_id();
        
        $sql = "SELECT MAX(value) FROM $table_webtv_position WHERE `user_id` = '0'";
        $result = Database::query($sql, __FILE__, __LINE__);
        $position_value = (int)Database::result($result, 0) + 1;
        
        $sql = "INSERT INTO $table_webtv_position (`user_id`, `parent_id`, `parent_type`, `value`) 
                VALUES ('0', '" . $video_id . "', '2', '" . $position_value . "')";
        Database::query($sql, __FILE__, __LINE__);
        
        progress_form(90);
        
        $sql = "SELECT DISTINCT (`user_id`) FROM $table_webtv_position WHERE `user_id` != '0'";
        $result = Database::query($sql, __FILE__, __LINE__);        
        while ($user_position = Database::fetch_array($result, 'ASSOC')){
            $sql = "INSERT INTO $table_webtv_position (`user_id`, `parent_id`, `parent_type`, `value`) 
                    VALUES ('" . $user_position['user_id'] . "', '" . $video_id . "', '2', '" . $position_value . "')";
            Database::query($sql, __FILE__, __LINE__);
        }
        
        $message = get_lang('VideoUploadedSuccessfully');
    }
    progress_form(100);
    header("Content-type: application/json");
    echo json_encode(array("code" => $code, "message" => utf8_encode($message)));
    exit;
}

$result = Database::query("SELECT id, name FROM $table_webtv_channel", __FILE__, __LINE__);
$channels = array();
while ($channel = Database::fetch_array($result, 'ASSOC')) {
    $channels[] = $channel;
}

$channel_id = (isset($_GET['channel_id']) && $_GET['channel_id'] != "") ? $_GET['channel_id'] : "";

$include_content = "templates/upload_video.html.php";