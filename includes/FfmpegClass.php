<?php
/**
 * Class that manages the ffmpeg php module.
 *
 * @author Joe Robles <joe.robles.pdj@gmail.com>
 * @author Ricardo Garcia Rodriguez <master.ojitos@gmail.com>
 */
class FfmpegClass
{
    public $videoPath;
    
    public function __construct($videoPath) {
        $this->videoPath = $videoPath;
    }
    
    /**
     * Gets information from vidio file
     */
    public function getVideoInformation() {
        $movie = new ffmpeg_movie($this->videoPath,false);

        $this->audBitRate = $movie->getAudioBitRate();
        $this->audioCodec = $movie->getAudioCodec();
        $this->audSampleRate = $movie->getAudioSampleRate();
        $this->bitRate = $movie->getVideoBitRate();
        $this->frameCount = $movie->getFrameCount();
        $this->frameHeight = $movie->getFrameHeight();
        $this->frameRate = $movie->getFrameRate();
        $this->frameWidth = $movie->getFrameWidth();
        $this->hasAudio = $movie->hasAudio();
        $this->pixelFormat = $movie->getPixelFormat();
        $this->videoCodec = $movie->getVideoCodec();
        $this->videoDuration = $movie->getDuration();
    }

    /**
     * Gets Information from audio file
     */
    public function getAudioInformation() {
        $movie = new ffmpeg_movie($this->videoPath,false);

        $this->artist = $movie->getArtist();
        $this->audBitRate = $movie->getAudioBitRate();
        $this->audioChannels = $movie->getAudioChannels();
        $this->audioCodec = $movie->getAudioCodec();
        $this->audioDuration = $movie->getDuration();
        $this->audSampleRate = $movie->getAudioSampleRate();
        $this->bitRate = $movie->getBitRate();
        $this->frameCount = $movie->getFrameCount();
        $this->frameRate = $movie->getFrameRate();
        $this->track = $movie->getTrackNumber();
    }

    /**
     * Generates the thumbnail for a video file
     */
    public function generateThumbImage($path, $width, $height) {
        $movie = new ffmpeg_movie($this->videoPath,false);
        
        $this->getVideoInformation();

        $capPos = ceil($this->frameCount / 4);
        $frameObject = $movie->getFrame($capPos);
        if ($frameObject) {
            $fileName = end(explode('/', $this->videoPath));
            if (!is_dir($path)) {
                mkdir($path);
            }
            $tmbPath = $path . '/' . $fileName . '.png';
            $thumb_width = $width;
            $thumb_height = $height;
            $img_dest = imagecreatetruecolor($thumb_width, $thumb_height);
            imagecopyresampled($img_dest, $frameObject->toGDImage(), 0, 0, 0, 0, $thumb_width, $thumb_height, $frameObject->getWidth(), $frameObject->getHeight());
            imagepng($img_dest, $tmbPath);
        }
    }
    
    public function get_vid_dim($file) {
        $command = '/usr/local/bin/ffmpeg -i ' . escapeshellarg($file) . ' 2>&1';
        $dimensions = array();
        exec($command, $output, $status);
        if (!preg_match('/Stream #(?:[0-9\.]+)(?:.*)\: Video: (?P<videocodec>.*) (?P<width>[0-9]*)x(?P<height>[0-9]*)/', implode('\n', $output), $matches)) {
            preg_match('/Could not find codec parameters \(Video: (?P<videocodec>.*) (?P<width>[0-9]*)x(?P<height>[0-9]*)\)/' ,implode('\n', $output), $matches);
        }
        if (!empty($matches['width']) && !empty($matches['height'])) {
            $dimensions['width'] = $matches['width'];
            $dimensions['height'] = $matches['height'];
        }
        return $dimensions;
    }
    
    function get_dimensions($original_width, $original_height, $target_width, $target_height, $force_aspect = true) {
        // Array to be returned by this function
        $target = array();
        // Target aspect ratio (width / height)
        $aspect = $target_width / $target_height;
        // Target reciprocal aspect ratio (height / width)
        $raspect = $target_height / $target_width;

        if ($original_width/$original_height !== $aspect) {
            // Aspect ratio is different
            if ($original_width/$original_height > $aspect) {
                // Width is the greater of the two dimensions relative to the target dimensions
                if ($original_width < $target_width) {
                    // Original video is smaller.  Scale down dimensions for conversion
                    $target_width = $original_width;
                    $target_height = round($raspect * $target_width);
                }
                // Calculate height from width
                $original_height = round($original_height / $original_width * $target_width);
                $original_width = $target_width;
                if ($force_aspect) {
                    // Pad top and bottom
                    $dif = round(($target_height - $original_height) / 2);
                    $target['padtop'] = $dif;
                    $target['padbottom'] = $dif;
                }
            } else {
                // Height is the greater of the two dimensions relative to the target dimensions
                if ($original_height < $target_height) {
                    // Original video is smaller.  Scale down dimensions for conversion
                    $target_height = $original_height;
                    $target_width = round($aspect * $target_height);
                }
                //Calculate width from height
                $original_width = round($original_width / $original_height * $target_height);
                $original_height = $target_height;
                if ($force_aspect) {
                    // Pad left and right
                    $dif = round(($target_width - $original_width) / 2);
                    $target['padleft'] = $dif;
                    $target['padright'] = $dif;
                }
            }
        } else {
            // The aspect ratio is the same
            if ($original_width !== $target_width) {
                if ($original_width < $target_width) {
                    // The original video is smaller.  Use its resolution for conversion
                    $target_width = $original_width;
                    $target_height = $original_height;
                } else {
                    // The original video is larger,  Use the target dimensions for conversion
                    $original_width = $target_width;
                    $original_height = $target_height;
                }
            }
        }
        if ($force_aspect) {
            // Use the target_ vars because they contain dimensions relative to the target aspect ratio
            $target['width'] = $target_width;
            $target['height'] = $target_height;
        } else {
            // Use the original_ vars because they contain dimensions relative to the original's aspect ratio
            $target['width'] = $original_width;
            $target['height'] = $original_height;
        }
        return $target;
    }
    
    public function convertToMp4($file)
    {
        $prefile = explode('.', $file);
        array_pop($prefile);
        $postfile = implode('.', $prefile);
        
        $chkvideocodec = "/usr/local/bin/ffmpeg -i $file 2>&1 | grep Video: | grep h264";
        exec($chkvideocodec, $output, $status);
        if ($output != '') { //check video codec
            $vcodec = 'copy';
        } else {
            $vcodec = 'libx264';
        }
        $chk264 = '/usr/local/bin/ffmpeg -i ' . $file. ' 2>&1 | grep Video: | grep "High 10"';
        exec($chk264, $output, $status);
        if ($output != '') { //10 bit H.264 can't be played by Hardware.
            $vcodec = 'libx264';
        }
        $chkaudiocodec = "/usr/local/bin/ffmpeg -i $file 2>&1 | grep Audio: | grep aac";
        exec($chkaudiocodec, $output, $status);
        if ($output != '') { //check audio codec
            $acodec = 'copy';
        } else {
            $acodec = 'libfaac';
        }

        $outformat = 'mp4';
        //$command = '/usr/local/bin/ffmpeg -i ' . $file . ' -s ' . $dimensions['width'] . 'x' . $dimensions['height'] . ' -acodec copy ' . $postfile . '.mp4' . ' 2>&1';
        //$command = "/usr/local/bin/ffmpeg -i $file -y -f $outformat -acodec $acodec -ab 160k -ac 2 -vcodec $vcodec -profile main -level 3.1 -flags +loop+slice -flags2 -dct8x8 -qmax 19 -qmin 13 -threads 0 $postfile.$outformat";
        $command = "/usr/local/bin/ffmpeg -i $file -acodec copy $postfile.$outformat";
        exec($command, $output, $status);
        if ($status == 0) {
            $onlyfile = end(explode('/', $postfile . '.' . $outformat));
            return array('created' => true, 'file' => $onlyfile);
        } else {
            return array('created' => false, 'message' => $output);
        }
    }
}