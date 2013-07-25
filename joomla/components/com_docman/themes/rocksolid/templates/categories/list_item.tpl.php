<?php
/**
 * The RockSolid Theme for DOCman
 * @version $Id: list_item.tpl.php $
 * @package RockSolidDOCmanTheme
 * @copyright (C) 2009 JoomlaFare.com
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://joomlafare.com/
 * 
 * The RockSolid Theme for DOCman is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or is derivative of works
 * licensed under the GNU General Public License or other free or open source software licenses.
 * The RockSolid Theme for DOCman is based on the Default DOCman Theme (copyright JoomlaTools)
 * and RokDownloads (copyright RocketWerx) and is offered without any warranty, expressed or implied.
 **/

defined('_VALID_MOS') or die('Restricted access');

/**
* Display a category list item (called by categories/list.tpl.php)
*
* General variables  :
*	$this->theme->path (string) : template path
* 	$this->theme->name (string) : template name
* 	$this->theme->conf (object) : template configuartion parameters
*	$this->theme->icon (string) : template icon path
*   $this->theme->png  (boolean): browser png transparency support
*
* Template variables :
*	$item->data		(object) : holds the category data
*  $item->links 	(object) : holds the category operations
*  $item->paths 	(object) : holds the category paths
**/
?>
	<?php if($item->data->id!=4 && $item->data->id!=13 && $item->data->id!=16 && $item->data->id!=43){?>
<li class="main">

<?php 

//output category image
switch ($this->theme->conf->cat_image) :
	case 0 : //none
		//do nothing
	break;

	case 1 : //icon
		?><div class="rs-thumb"><a class="dm-icon" href="<?php echo $item->links->view; ?>"><img src="<?php echo $item->paths->icon;?>" alt="folder icon" />
		</a></div><?php
	break;

	case 2 : //thumb
		if($item->data->image) :
		?><div class="rs-thumb"><a class="dm-thumb" href="<?php echo $item->links->view; ?>"><img src="<?php echo $item->paths->thumb;?>" alt="<?php echo $item->data->name;?>" />
		</a></div><?php
		endif;
	break;
endswitch;

//output category link
?>
<div class="rs-details">

    
		<h3><a class="dm-name" href="<?php echo $item->links->view; ?>"><?php echo $item->data->name;?></a>
		<?php if($item->data->files) : ?>
		<small>( <?php echo $item->data->files.'&nbsp;'._DML_TPL_FILES;?> )</small>
		<?php endif; ?>
	</h3>	
    <?php
    if($item->data->description) :
        ?><div class="dm-description"><?php echo $item->data->description;?></div><?php
    endif;
    ?>
		



</div>
<div class="clr"></div>

</li>
<div style="background:#6A9016; width:100%; height:20px;">
</div>
<?php }?>