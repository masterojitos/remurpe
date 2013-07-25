<?php 
/**
* @version		$Id: fadein.php 00170 2009-04-10 00:00:00 umitkenan $
* @package		SlideShow Pro
* @subpackage	Fade-in SlideShow
* @copyright	Copyright (C) Joomla Türkçe Eðitim ve Destek Sitesi. http://www.jt.gen.tr 
* @license		GNU/GPL
*
* Special thanks to RysiuM
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

// Loading images, urls, and titles
$image 	= explode ( "\n", trim ($params->get( 'images' ) ) );
$url 	= explode ( "\n", trim ($params->get( 'urls' ) ) );

// If adding "http" automatically is YES
$addhttp = trim($params->get( 'addhttp' ));

if ($addhttp) {
	for ( $i=0 ; $i < count($image) ; $i++ ) {
		$url[$i]="http://".$url[$i];
	}
}
?>

<!-- JAVASCRIPT - INITIALS -->
<script type="text/javascript">
	var fadebgcolor=""
	var fadeimages=new Array()
	<?php for ( $i=0 ; $i < count($image) ; $i++ ) {  ?>
		fadeimages[<?php echo $i; ?>] = ["<?php echo JURI::root() . trim($params->get( 'folder' )) . "/" . $image[$i]; ?>", "<?php echo $url[$i] ?>", "_new"]
	<?php } ?>
</script>

<!-- JAVASCRIPT -->
<script src="<?php echo JURI::root(); ?>modules/mod_slideshow/scripts/fscript.js" language="JavaScript1.2"></script>

<?php if (trim($params->get( 'random' )) == 'R') : ?>
	<script type="text/javascript">
		//new fadeshow(IMAGES_ARRAY_NAME, slideshow_width, slideshow_height, borderwidth, delay, pause (0=no, 1=yes), optionalRandomOrder)
		new fadeshow(fadeimages, <?php echo trim($params->get( 'width' )); ?>, <?php echo trim($params->get( 'height' )); ?>, 0, <?php echo trim($params->get( 'delay' )); ?>, <?php echo trim($params->get( 'stopslide' )); ?>, "R")
	</script>
<?php else : ?>
	<script type="text/javascript">
		//new fadeshow(IMAGES_ARRAY_NAME, slideshow_width, slideshow_height, borderwidth, delay, pause (0=no, 1=yes))
		new fadeshow(fadeimages, <?php echo trim($params->get( 'width' )); ?>, <?php echo trim($params->get( 'height' )); ?>, 0, <?php echo trim($params->get( 'delay' )); ?>, <?php echo trim($params->get( 'stopslide' )); ?>)
	</script>
<?php endif; ?>
