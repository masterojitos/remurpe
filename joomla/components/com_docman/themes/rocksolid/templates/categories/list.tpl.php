<?php
/**
 * The RockSolid Theme for DOCman
 * @version $Id: list.tpl.php $
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
* Display the category list (required)
*
* General variables  :
*	$this->theme->path (string) : template path
* 	$this->theme->name (string) : template name
* 	$this->theme->conf (object) : template configuartion parameters
*	$this->theme->icon (string) : template icon path
*   $this->theme->png  (boolean): browser png transparency support
*
* Template variables :
*	$this->items (array)  : holds an array of dcoument items
*/
?>

<?php if (count($this->items)) {; ?>
    <div id="dm-cats">
    	<h2><?php echo _DML_TPL_CATS; ?></h2>
    <div>
	    <ul>
		    <?php
			/*
			 * Include the list_item template and pass the item to it
			*/
			foreach($this->items as $item) :
				if($this->theme->conf->cat_empty || $item->data->files != 0) :
					include $this->loadTemplate('categories/list_item.tpl.php');
				endif;
			endforeach;
		    ?>
	    </ul>
    </div>
    </div>
<?php }; ?>