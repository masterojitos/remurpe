<?php
/**
 * Class that manages the videos.
 *
 * @author Joe Robles <joe.robles.pdj@gmail.com>
 */
require 'includes/FfmpegClass.php';

class VideoClass {
    public $allowed_file_types = array('video/mp4', 'video/x-flv');
    public $client;
    public $code;
    public $duration;
    public $ext;
    public $filename;
    public $format;
    public $message;
    public $newname;
    public $path;
    public $stream_path = '/usr/local/WowzaMediaServer/content';
    public $thumb_width = 720;
    public $thumb_height = 540;
    public $thumbs_folder;
    public $uniq;
    public $uploaded;
    public $video;
    public $video_src;

    /**
     * Receives a video input
     * 
     * @param array $video $_FILES['video']
     */
    public function __construct($video) {
        $path_array   = explode("/", api_get_path(WEB_PATH));
        $this->client = $path_array[count($path_array) - 2];
        $this->path   = dirname(__FILE__) . '/../../upload/webtv/';
        $this->thumbs_folder = $this->path . 'thumbs/' . $this->client;
        $this->video  = $video;
    }
    
    /**
     * Uploads a file from upload file form
     * 
     * @param  string $update  Name of video from database
     * @param  int    $channel Video's channel id
     * @return array
     */
    public function upload($update = '', $channel = '') {
        if ($channel == '') {
            $error = $this->video['error']['file'];
            $name = $this->video['name']['file'];
            $tmp = $this->video['tmp_name']['file'];
            $type = $this->video['type']['file'];
        } else {
            $error = $this->video['error'][$channel]['file'];
            $name = $this->video['name'][$channel]['file'];
            $tmp = $this->video['tmp_name'][$channel]['file'];
            $type = $this->video['type'][$channel]['file'];
        }
        if (!empty($this->video) && ($error == 0)) {
            $this->filename = basename($name);
            $this->ext = strtolower(end(explode(".", $this->filename)));
            
            if (in_array($type, $this->allowed_file_types)) {
                if (!is_dir($this->path)) {
                    mkdir($this->path);
                }
                if (!is_dir($this->stream_path)) {
                    mkdir($this->stream_path);
                }
                if ($update == '') {
                    do {
                        $uniq = uniqid();
                        $this->newname = $this->stream_path . '/' . $this->client . '/' . $uniq . '.' . $this->ext;
                    } while (file_exists($this->newname));
                    $this->video_src = $uniq . '.' . $this->ext;
                } else {
                    $this->video_src = $update;
                    $this->newname = $this->stream_path . '/' . $this->client . '/' . $this->video_src;
                }
                if (!is_dir($this->stream_path . '/' . $this->client . '/')) {
                    mkdir($this->stream_path . '/' . $this->client . '/');
                }
                if (!is_writable($this->stream_path . '/' . $this->client . '/')) {
                    $this->message = get_lang('DestinationFolderIsNotWritable');
                } elseif (move_uploaded_file($tmp, $this->newname)) {
                    $movie = new FfmpegClass($this->newname);
                    if (!is_dir($this->path . 'thumbs/')) {
                        mkdir($this->path . 'thumbs/');
                    }
                    $movie->generateThumbImage($this->thumbs_folder, $this->thumb_width, $this->thumb_height);
                    $movie->getVideoInformation();
                    $this->duration = gmdate("H:i:s", $movie->videoDuration);
                    $original = $movie->get_vid_dim($this->newname);
                    $this->code = 200;
                    $this->uploaded = true;
                    if (!empty($original['width']) && !empty($original['height'])) {
                        if($this->ext != 'mp4') {
                            $converted = $movie->convertToMp4($this->newname);
                            if ($converted['created']) {
                                $this->video_src =  $converted['file'];
                                unlink($this->newname);
                                if ($update == '') {
                                    exec('mv ' . $this->thumbs_folder . '/' . $this->uniq . '.' . $this->ext . '.png ' . $this->thumbs_folder . '/' . $converted['file'] . '.png ');
                                } else {
                                    exec('mv ' . $this->thumbs_folder . '/' . $update . '.png ' . $this->thumbs_folder . '/' . $converted['file'] . '.png ');
                                }
                            }
                        }
                        $this->format = $original['width'] . 'x' . $original['height'];
                    }
                } else {
                    $this->message = get_lang('ErrorProblemOccurredDuringFileUpload');
                    $this->code = 400;
                }
            } else {
                $this->message = get_lang('ErrorOnlyVideosAreAcceptedForUpload');
                $this->code = 400;
            }
        } else {
            if ($update != '') {
                $this->code = 200;
            } else {
                $this->message = get_lang('ErrorNoFileUploaded');
                $this->code = 400;
            }
            $this->uploaded = false;
        }
        
        return array('code' => $this->code, 'message' => $this->message);
    }
}