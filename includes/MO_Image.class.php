<?php

/**
 * This is a class that allows you to resize and crop an image.
 * It also has the ability to add borders, background color, transparency, 
 * autofill and additionally generate a perfect thumbnail.
 * 
 * @author Ricardo Garcia Rodriguez <master.ojitos@gmail.com>
 * @version 1.0 - 03-20-2013
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * 
 */
class MO_Image
{    
    /**
     * The image resource
     * @var string
     */
    protected $image;
    
    /**
     * The image path
     * @var string
     */
    protected $filename;
    
    /**
     * The image width
     * @var string
     */
    protected $width;
    
    /**
     * The image height
     * @var string
     */
    protected $height;
    
    /**
     * The image type: gif, jpeg, png
     * @var string
     */
    protected $type;
    
    /**
     * The border width of the image
     * Default is 0
     * @var int
     */
    protected $border_width = 0;
    
    /**
     * The border color of the image (red, green, blue)
     * Default is black
     * @var array
     */
    protected $border_color = array(0, 0, 0);
    
    /**
     * The background color of the image (red, green, blue)
     * Default is white
     * @var array
     */
    protected $background_color = array(255, 255, 255);
    
    /**
     * Auto fill the image
     * Default is false
     * @var bool
     */
    protected $autofill = false;
    
    /**
     * Auto fill the image
     * Default is false
     * @var bool
     */
    protected $transparent = false;
    
    /**
     * Constructor
     * Can optionally take a filename for an image and automatically is loaded.
     *
     * @param string $filename The image path
     */
    public function __construct($filename = null)
    {
        if (!extension_loaded('gd')) {
            throw new Exception('Required extension GD is not loaded.');
        }
        
        if ($filename) {
            $this->load($filename);
        }
    }
    
    /**
     * The image load
     *
     * @param string $filename The image path to be loaded
     */
    public function load($filename)
    {
        $this->filename = $filename;
        
        if (!is_file($this->filename)) {
            throw new Exception('The file doesn\'t exist or is a directory.');
        }
        
        list($this->width, $this->height, $this->type) = getimagesize($this->filename);
        
        switch ($this->type) {
            case IMAGETYPE_GIF:
                $this->image = imagecreatefromgif($this->filename);
                break;
            case IMAGETYPE_JPEG: 
                $this->image = imagecreatefromjpeg($this->filename);
                break;
            case IMAGETYPE_PNG:
                $this->image = imagecreatefrompng($this->filename);
                break;
            default:
                throw new Exception('Invalid image type: ' . $this->filename);
                break;
        }
        
        $this->refreshDimensions();
    }
    
    /**
     * Saves the image in the server
     *
     * @param string $filename The image path to be saved
     * @param int $quality The image compression level
     * @param string $permissions The image permissions
     */
    public function save($filename = null, $quality = null, $permissions = null)
    {
        if (!$filename) {
            $filename = $this->filename;
        }
        
        if (empty($this->image)) {
            throw new Exception('The image doesn\'t exist.');
        }
        
        $this->addBorders();
        
        $format = $this->extension($filename);
        
        switch ($format) {
            case 'gif':
                $result = imagegif($this->image, $filename);
                break;
            case 'jpg':
            case 'jpeg':
                $result = imagejpeg($this->image, $filename, $this->imageQuality($quality, 'jpg'));
                break;
            case 'png':
                $result = imagepng($this->image, $filename, $this->imageQuality($quality, 'png'));
                break;
            default:
                throw new Exception('Unsupported format.');
        }
        
        if (!$result) {
            throw new Exception('Unable to save image');
        }

        if(!is_null($permissions)) {
            chmod($filename, $permissions);
        }
    }
    
    /**
     * Output the image directly to the browser
     * 
     * @param int $quality The image compression level
     */
    public function output($quality = null)
    {
        if (empty($this->image)) {
            throw new Exception('The image doesn\'t exist.');
        }
        
        $this->addBorders();
        
        if ($this->transparent) {
            $this->type = IMAGETYPE_PNG;            
        }
        
        switch ($this->type) {
            case IMAGETYPE_GIF:
                header('Content-type: image/gif');
                imagegif($this->image);
                break;
            case IMAGETYPE_JPEG: 
                header('Content-type: image/jpeg');
                imagejpeg($this->image, null, $this->imageQuality($quality, 'jpg'));
                break;
            case IMAGETYPE_PNG:
                header('Content-type: image/png');
                imagepng($this->image, null, $this->imageQuality($quality, 'png'));
                break;
        }
        
        $this->__destruct();
    }
    
    /**
     * Resizes the image to a specified dimensions
     *
     * @param int $width The width to the new image
     * @param int $height The height to the new image
     */
    public function resize($width, $height)
    {
        if(intval($width) == 0 || intval($height) == 0) {
            throw new Exception('Is required the width and height.');
        }
        
        $original_ratio = $this->width / $this->height;
        
        if ($width / $height > $original_ratio) {
            $new_height = $height;
            $new_width = intval($height * $original_ratio);
        } else if ($width / $height < $original_ratio) {
            $new_width = $width;
            $new_height = intval($width / $original_ratio);
        } else {
            $new_width = $width;
            $new_height = $height;
        }

        if ($this->autofill) {
            $new_image = imagecreatetruecolor($width, $height);
            list($x, $y) = $this->axisCentered($width, $height, $new_width, $new_height);
            
        } else {
            $new_image = imagecreatetruecolor($new_width, $new_height);
            $x = $y = 0;
        }
        
        imagecopyresampled($new_image, $this->image, $x, $y, 0, 0, $new_width, $new_height, $this->width, $this->height);
            
        if ($this->autofill) {            

            imagealphablending($new_image, false);

            if ($this->transparent) {
                imagesavealpha($new_image, true);
            }

            $background_color = imagecolorallocatealpha($new_image, $this->background_color[0], $this->background_color[1], $this->background_color[2], 127);

            if ($x > 0) {
                imagefilledrectangle($new_image, 0, 0, $x, $height, $background_color);
                imagefilledrectangle($new_image, $x + $new_width, 0, $width, $height, $background_color);
            }

            if ($y > 0) {
                imagefilledrectangle($new_image, 0, 0, $width, $y, $background_color);
                imagefilledrectangle($new_image, 0, $y + $new_height, $width, $height, $background_color);
            }
        }
        
        $this->image = $new_image;
        
        $this->refreshDimensions();
    }
    
    /**
     * Crops the image to a specified size
     *
     * @param int $width The width to the new image
     * @param int $height The height to the new image
     * @param int $x The axis x
     * @param int $y The axis y
     */
    public function crop($width = 0, $height = 0, $x = null, $y = null) 
    {
        if(intval($width) == 0 || intval($height) == 0) {
            throw new Exception('Is required the width and height.');
        }
        
        $new_image = imagecreatetruecolor($width, $height);
        
        list($x, $y) = $this->axisCentered($this->width, $this->height, $width, $height, $x, $y);
        
        imagecopyresampled($new_image, $this->image, 0, 0, $x, $y, $width, $height, $width, $height);
        
        imagealphablending($new_image, false);
        
        if ($this->transparent) {
            imagesavealpha($new_image, true);
        }
        
        $background_color = imagecolorallocatealpha($new_image, $this->background_color[0], $this->background_color[1], $this->background_color[2], 127);
        
        if ($x < 0) {
            imagefilledrectangle($new_image, 0, 0, $x * -1, $height, $background_color);
            imagefilledrectangle($new_image, ($x * -1) + $this->width, 0, $width, $height, $background_color);
        }
        
        if ($y < 0) {
            imagefilledrectangle($new_image, $x * -1, 0, ($x * -1) + $this->width, $y * -1, $background_color);
            imagefilledrectangle($new_image, $x * -1, ($y * -1) + $this->height, ($x * -1) + $this->width, $height, $background_color);
        }
        
        $this->image = $new_image;
        
        $this->refreshDimensions();
    }
    
    /**
     * Creates a thumbnail of the image.
     * The width and height are cropped to avoid spaces.
     *
     * @param int $width The width to the new image
     * @param int $height The height to the new image
     * @param bool $crop_image True for cropped image to avoid spaces. Default is false
     * @param bool $expanded True for enlarge the image. Default is false
     */
    public function thumbnail($width = 100, $height = 100, $crop_image = false, $expanded = false)
    {
        if(intval($width) == 0 || intval($height) == 0) {
            throw new Exception('Is required the width and height.');
        }
        
        if (!$crop_image && ($this->width > $width || $this->height > $height)) {
            $this->resize($width, $height);
            
        } else {
            $original_ratio = $this->width / $this->height;
            
            if ($expanded || ($this->width > $width && $this->height > $height)) {
                if ($width / $height > $original_ratio) {
                    $new_width = $width;
                    $new_height = intval($width / $original_ratio);                    
                } else if ($width / $height < $original_ratio) {
                    $new_width = intval($height * $original_ratio);
                    $new_height = $height;
                } else {
                    $new_width = $width;
                    $new_height = $height;              
                }
            } else {
                $new_width = $this->width;
                $new_height = $this->height;
            }

            list($x, $y) = $this->axisCentered($new_width, $new_height, $width, $height);

            $this->resize($new_width, $new_height);
            
            $this->crop($width, $height, $x, $y);
        }
    }
    
    /**
     * Sets the border width and color to the image
     *
     * @param int $width The border width value
     * @param mixed $color The color value, accepts hex string or rgb array
     */
    public function setBorder($width, $color)
    {
        $this->border_width = $width;
        $this->border_color = $this->Hex2RGB($color);
    }
    
    /**
     * Sets a background color to the image
     *
     * @param mixed $color The color value, accepts hex string or rgb array
     */
    public function setBackgroundColor($color)
    {
        $this->background_color = $this->Hex2RGB($color);
    }
    
    /**
     * Sets whether we should auto fill the image or not.
     * Also optionally set the background color transparent to images png.
     *
     * @param bool $autofill true or false
     * @param bool $transparent true or false
     */
    public function setAutofill($autofill, $transparent = true)
    {
        $this->autofill = $autofill;
        $this->transparent = $transparent;
    }
    
    /**
     * Sets the width and height of the current image
     */
    private function refreshDimensions()
    {
        $this->width = imagesx($this->image);
        $this->height = imagesy($this->image);
    }
    
    /**
     * Returns the x and y axis centered by the width and height from image
     *
     * @param int $original_width The width from the current image
     * @param int $original_height The height from the current image
     * @param int $width The width to the new image
     * @param int $height The height to the new image
     * @param int $x The axis x
     * @param int $y The axis y
     * @return array The x and y axis
     */
    private function axisCentered($original_width, $original_height, $width, $height, $x = null, $y = null)
    {
        if (is_null($x) && is_null($y)) {
            $x_center = intval($original_width / 2);
            $x = $x_center - ($width / 2);
            $y_center = intval($original_height / 2);
            $y = $y_center - ($height / 2);
        }
        
        if (is_null($x)) {
            $x = 0;
        }
        
        if (is_null($y)) {
            $y = 0;
        }
        
        return array($x, $y);
    }
    
    /**
     * Adds borders to the image
     */
    private function addBorders()
    {
        if($this->border_width > 0) {
            $border_color = imagecolorallocate($this->image, $this->border_color[0], $this->border_color[1], $this->border_color[2]);
            
            imagefilledrectangle($this->image, 0, $this->height, $this->width, $this->height - $this->border_width, $border_color); // Bottom
            imagefilledrectangle($this->image, 0, 0, $this->width, $this->border_width - 1, $border_color); // Top
            imagefilledrectangle($this->image, 0, 0, $this->border_width - 1, $this->height, $border_color); // Left
            imagefilledrectangle($this->image, $this->width - $this->border_width, 0, $this->width, $this->height, $border_color); // Right
        }
    }
    
    /**
     * Converts a Hex color into it's RGB values
     *
     * @param mixed $hex_color The hex color value
     * @return array The equivalent RGB color value
     */
    private function Hex2RGB($hex_color)
    {
        if (is_array($hex_color)) {
            return $hex_color;
        }
        
        $hex_color = str_replace('#', '', $hex_color);        
        if (strlen($hex_color) == 3) {
            $characters = 1;
        } else if (strlen($hex_color) == 6) {
            $characters = 2;
        } else {            
            return $this->border_color;
        }
        
        $rgb_color = array();
        for ($i = 0; $i < 3; $i++) {
            $rgb_color[$i] = hexdec(str_repeat(substr($hex_color, $characters * $i, $characters), $characters == 1 ? 2 : 1));
        }
        
        return $rgb_color;
    }
    
    /**
     * Return the image format: gif, jpg, jpeg, png
     * 
     * @param string $filename The image path to extract the extension
     * @return string The image format
     */
    private function extension($filename)
    {
        return strtolower(end(explode(".", $filename)));
    }
    
    /**
     * Return the image quality by a format
     *
     * @param int $value The image compression level
     * @param string $format The image format, default is png
     * @return int The new image compression level by format
     */
    private function imageQuality($value, $format = 'png') {
        if ($format == 'png') {
            if (is_null($value)) {
                $value = 9;
            }
            return $this->forceRange($value, 0, 9);
        } else {
            if (is_null($value)) {
                $value = 90;
            }
            return $this->forceRange($value, 0, 100);            
        }
    }
    
    /**
     * Force a value within a range.
     * If is lower, $minimum is returned. If is higher, $maximum is returned.
     * Otherwise $value is returned.
     *
     * @param int $value The value to forcing
     * @param int $minimum the minimum value
     * @param int $maximum the maximum value
     * @return int The new value forced in the range
     */
    private function forceRange($value, $minimum, $maximum) {
        if ($value < $minimum) {
            return $minimum;
        } else if ($value > $maximum) {
            return $maximum;
        } else {
            return $value;
        }
    }
    
    /**
     * Destructor
     * This is invoked when the function "output" finishes running 
     * and used to free the memory.
     */
    private function __destruct() {
        if ($this->image) {
            imagedestroy($this->image);
        }
    }
}