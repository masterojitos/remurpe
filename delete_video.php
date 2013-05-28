<?php
if (!isset($_GET['id']) || $_GET['id'] == "") exit;

$video_id = Security::remove_XSS($_GET['id']);

$sql = "SELECT video_src FROM $table_webtv_video WHERE `id` = '$video_id'";
$result = Database::query($sql, __FILE__, __LINE__);

if (Database::affected_rows() == 0) exit;

$video = $client . '/' . Database::result($result, 0);
unlink('/usr/local/WowzaMediaServer/content/' . $video);
unlink(dirname(__FILE__) . '/../upload/webtv/thumbs/' . $video . '.png');

$sql = "DELETE FROM $table_webtv_position WHERE `parent_id` = '$video_id' AND `parent_type` = '2'";
Database::query($sql, __FILE__, __LINE__);

$sql = "DELETE FROM $table_webtv_video WHERE `id` = '$video_id'";
Database::query($sql, __FILE__, __LINE__);

exit;