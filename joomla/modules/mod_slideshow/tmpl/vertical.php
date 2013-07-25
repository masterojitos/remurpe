<?php 
/**
* @version		$Id: vertical.php 00170 2009-04-10 00:00:00 umitkenan $
* @package		SlideShow Pro
* @subpackage	Vertical SlideShow
* @copyright	Copyright (C) Joomla Türkçe Eðitim ve Destek Sitesi. http://www.jt.gen.tr 
* @license		GNU/GPL
*/

// no direct access
defined('_JEXEC') or die('Restricted access');
?>

<!-- STYLE -->
<style type="text/css">
#marqueecontainer {
	position: relative;
	width: <?php echo trim ( $params->get ( 'width' ) ); ?>px;
	height: <?php echo trim ( $params->get ( 'height' ) ); ?>px;
	background-color: <?php echo trim ( $params->get ( 'bgcolor' ) ); ?>;
	overflow: hidden; }
</style>

<!-- JAVASCRIPT -->
<script language="JavaScript1.2">
	var delayb4scroll	=	<?php echo trim ( $params->get ( 'wait' ) ); ?>;
	var marqueespeed	=	<?php echo trim ( $params->get ( 'speed' ) ); ?>;
	var pauseit			=	<?php echo trim ( $params->get ( 'stopslide' ) ); ?>;
</script>

<script src = "<?php echo JURI::root(); ?>modules/mod_slideshow/scripts/vscript.js" language="JavaScript1.2"></script>

<?php
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
?>

<div id="marqueecontainer" onMouseover="copyspeed=pausespeed" onMouseout="copyspeed=marqueespeed">
	<div id="vmarquee" style="text-align:center; position: absolute; width: 98%;">
		<!--SCROLL HERE-->
		<?php 
		for ( $i=0 ; $i < count($image) ; $i++ ) {
			$alt 		=  $title[$i] ? ' alt="'. $title[$i] .'"' : '';
			$alttitle 	=  $title[$i] ? ' title="'. $title[$i] .'"' : '';

			if ( $params->get( 'linked' ) ) {
				$link 		=  $url[$i] ? '<a href="'. $url[$i] .'">' : '';
				$link_end 	=  $url[$i] ? '</a>' : '';
			}
		
			if ( $params->get( 'addbreak' ) ) {
				$break = "<br />";
			}
			
			$templink = $link . '<img src="'.JURI::root() . trim($params->get( 'folder' )) . "/" . $image[$i] . '" border="0"' . $alt.$alttitle . ">" . $link_end . $break;

			// DISPLAY
			echo $templink;
			
			if ( $params->get( 'space' ) ) {
				echo '<br /><img src="' . JURI::root() . 'modules/mod_slideshow/one-pixel.gif" width="1px" height="' . $params->get( 'space' ) . 'px" />';
			}
		} 
		?>
	</div>
</div>