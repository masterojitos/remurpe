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
* Display the documents list (required)
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
*	$this->order (object) : holds the document list order information
**/
?>

<?php if(count($this->items)) {; ?>
    <div id="dm-docs">
    <?php /* <h2><?php echo _DML_TPL_DOCS;?></h2> */ ?>
    <?php
    /*
     * Include the documents list ordering template
    */
    ?>
    <?php include $this->loadTemplate('documents/list_order.tpl.php'); ?>
	    <div id="rs-files">
		<ul>
		    <?php
			/*
			 * Include the list_item template and pass the item to it
			*/
			foreach($this->items as $item) :
				$this->doc = &$item; //add item to template variables
				include $this->loadTemplate('documents/list_item.tpl.php');
			endforeach;
		    ?>
		</ul>
	    </div>
    </div>
<?php } else {; ?>
    <br />
    <div id="dm-docs">
        <i><?php echo _DML_TPL_NO_DOCS; ?></i>
    </div>
<?php }; ?>