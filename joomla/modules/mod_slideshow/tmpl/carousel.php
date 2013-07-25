<?php 
/**
* @version		$Id: carousel.php 00170 2009-04-10 00:00:00 umitkenan $
* @package		SlideShow Pro
* @subpackage	Carousel SlideShow
* @copyright	Copyright (C) Joomla Türkçe Eðitim ve Destek Sitesi. http://www.jt.gen.tr 
* @license		GNU/GPL
*/

// no direct access
defined('_JEXEC') or die('Restricted access');
?>

<!-- JAVASCRIPT -->
<script src = "<?php echo JURI::root(); ?>modules/mod_slideshow/scripts/cscript.js" language="JavaScript1.2"></script>

<?php 
// Loading images, urls, and titles
$image 	= explode ( "\n", trim ($params->get( 'images' ) ) );
$url 	= explode ( "\n", trim ($params->get( 'urls' ) ) );
$title 	= explode ( "\n", trim ($params->get( 'titles' ) ) );

// If adding "http" automatically is YES
$addhttp = trim ( $params->get( 'addhttp' ) );

if ($addhttp) {
	for ( $i=0 ; $i < count($image) ; $i++ ) {
		$url[$i]="'http://".$url[$i]."'";
	}
}
else {
	for ( $i=0 ; $i < count($image) ; $i++ ) {
		$url[$i]="'".$url[$i]."'";
	}
}

// Preparing ( images )
for ( $i=0 ; $i < count($image) ; $i++ ) {
	$image[$i] = "'" . JURI::root() . trim ( $params->get ( 'folder' ) ) . "/" . $image[$i] . "'";
}

// Preparing ( titles )
for ( $i=0 ; $i < count($image) ; $i++ ) {
	$title[$i] = "'" . $title[$i] . "'";
}

// Preparing ( arrays )
$images = implode(", ",$image);
$urls 	= implode(", ",$url);
$titles = implode(", ",$title);
?>

<script type='text/javascript'>
carousel ({
	id:'idmustbeunique', //Enter arbitrary but unique ID of this slideshow instance
	border:'',
	size_mode:'image', //Enter "carousel" or "image". Affects the width and height parameters below.
	width:<?php echo trim ( $params->get ( 'width' ) ); ?>, //Enter width of image or entire carousel, depending on above value
	height:<?php echo trim ( $params->get ( 'height' ) ); ?>, //Enter height of image or entire carousel, depending on above value
	sides:<?php echo trim ( $params->get ( 'sides' ) ); ?>, //# of sides of the carousel. What's shown = sides/2. Even integer with sides/2< total images is best
	steps:<?php echo trim ( $params->get ( 'steps' ) ); ?>, //# of animation steps. More = smoother, but more CPU intensive
	speed:<?php echo trim ( $params->get ( 'speed' ) ); ?>, //Speed of slideshow. Larger = faster.
	direction:'<?php echo trim ( $params->get ( 'direction' ) ); ?>', //Direction of slideshow. Enter "top", "bottom", "left", or "right"
	images:[<?php echo $images; ?>],
	links: [<?php echo $urls; ?>],
	// lnk_base:'',
	// lnk_targets:[''], //link target for each link (see: http://www.codingforums.com/showthread.php?t=58814&page=2)
	// lnk_attr:[''], //window attribute for each pop up (see url above for docs)
	titles:[<?php echo $titles; ?>],
	image_border_width:0,
	image_border_color:'black'
});
</script>