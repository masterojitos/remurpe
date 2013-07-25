<?php
/**
 * The RockSolid Theme for DOCman
 * @version $Id: category.tpl.php$
 * @package RockSolid_DOCman_Theme
 * @copyright (C) 2009 JoomlaFare.com
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://joomlafare.com/ Official website
 * 
 * The RockSolid Theme for DOCman is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or is derivative of works
 * licensed under the GNU General Public License or other free or open source software licenses.
 * The RockSolid Theme for DOCman is based on the Default DOCman Theme (copyright JoomlaTools)
 * and RokDownloads (copyright RocketWerx) and is offered without any warranty, expressed or implied.
 **/

defined('_VALID_MOS') or die('Restricted access');

/*
* Display category details (required)
*
* General variables  :
*	$this->theme->path (string) : template path
* 	$this->theme->name (string) : template name
* 	$this->theme->conf (object) : template configuartion parameters
*	$this->theme->icon (string) : template icon path
*   $this->theme->png  (boolean): browser png transparency support
*
* Template variables :
*  $this->data		(object) : holds the category data
*  $this->links 	(object) : holds the category operations
*  $this->paths 	(object) : holds the category paths
*/
?>

<div class="dm-cat" style="background:#FFFFFF;">

<?php
    if($this->data->image) :
        ?><img class="dm-thumb" src="<?php echo $this->paths->thumb; ?>" style="float:<?php echo $this->data->image_position;?>" alt="" /><?php
    endif;

    if($this->data->title != '') :
        ?><div class="dm-name"  style="background:#FFFFFF;"><h2><?php echo $this->data->title;?></h2></div><?php
    endif;

	if($this->data->description != '') :
		?><div class="dm-description"  style="background:#FFFFFF;"><?php echo $this->data->description; ?></div><?php
	endif;
?>
</div>

