<?php 
/**
* @version		$Id: default.php 00170 2009-04-10 00:00:00 umitkenan $
* @package		SlideShow Pro
* @subpackage	Horizontal SlideShow
* @copyright	Copyright (C) Joomla Türkçe Eğitim ve Destek Sitesi. http://www.jt.gen.tr 
* @license		GNU/GPL
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

// Loading images, urls, and titles
$image 	= explode ( "\n", trim ($params->get( 'images' ) ) );
$url 	= explode ( "\n", trim ($params->get( 'urls' ) ) );
$title 	= explode ( "\n", trim ($params->get( 'titles' ) ) );

// If adding "http" automatically is YES
$addhttp = trim($params->get( 'addhttp' ));

if ($addhttp) {
	for ( $i=0 ; $i < count($image) ; $i++ ) {
		$url[$i]="http://".$url[$i];
	}
}

// Spaces ( Characters )		
$space=trim($params->get( 'space' ));
$spacetext = "&nbsp;";
		
if ($i >= 1) {
	for( $i=1 ; $i<$space ; $i++ ) {
		$spacetext .= "&nbsp;";
	}
}
else
	$spacetext .= "";
?>

<!-- JAVASCRIPT - INITIALS -->
<script language="JavaScript1.2">
	var leftrightslide	=	new Array()
	var finalslide		=	''
	var slidesspace		=	parseInt ('<?php echo trim ( $params->get ( "slidesspace" ) ); ?>')
	var sliderwidth		=	"<?php echo trim ( $params->get ( 'width' ) ); ?>px"
	var sliderheight	=	"<?php echo trim ( $params->get ( 'height' ) ); ?>px"
	var slidebgcolor	=	"<?php echo trim ( $params->get ( 'bgcolor' ) ); ?>"
	var stopslide		=	"<?php echo trim ( $params->get ( 'stopslide' ) ); ?>"
	var imagegap		=	"<?php echo $spacetext; ?>"
	var slidespeed		=	<?php echo trim ( $params->get ( 'speed' ) ); ?>

	<?php 
	for ( $i=0 ; $i < count($image) ; $i++ ) {
		$alt 		=  $title[$i] ? ' alt="'. $title[$i] .'"' : '';
		$alttitle 	=  $title[$i] ? ' title="'. $title[$i] .'"' : '';

		if ( $params->get( 'linked' ) ) {
			$link 		=  $url[$i] ? '<a href="'. $url[$i] .'">' : '';
			$link_end 	=  $url[$i] ? '</a>' : '';
		}
			
		$templink 	= $link . '<img src="'.JURI::root() . trim ( $params->get ( 'folder' ) ) . "/" . $image[$i] . '" border="0"' . $alt . $alttitle .">". $link_end; ?>

		leftrightslide[<?php echo $i; ?>]='<?php echo $templink; ?>'

	<?php } ?>
		
</script>

<!-- JAVASCRIPT -->
<script src = "<?php echo JURI::root(); ?>modules/mod_slideshow/scripts/hscript.js" language="JavaScript1.2"></script>