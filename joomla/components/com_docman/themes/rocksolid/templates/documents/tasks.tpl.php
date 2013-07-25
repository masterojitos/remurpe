<?php
/**
 * The RockSolid Theme for DOCman
 * @version $Id: tasks.tpl.php $
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
* Display the document tasks (called by document/list_item.tpl.php and documents/document.tpl.php)
*
* General variables  :
*	$this->theme->path (string) : template path
* 	$this->theme->name (string) : template name
* 	$this->theme->conf (object) : template configuartion parameters
*	$this->theme->icon (string) : template icon path
*   $this->theme->png  (boolean): browser png transparency support
*
* Template variables :
*	$this-	>doc->buttons (array) : holds the tasks a user can preform on a document
**/

foreach($this->doc->buttons as $button) {
	if($button->params->get('popup', false))
	{
		if(defined('_DM_J15')) {
			JHTML::_('behavior.modal');
			$popup = 'class="rs-button modal" rel="{handler: \'iframe\', size: {x:800, y:600}}"';
		} else {
			$popup = 'class="rs-button" type="popup"';
		}
	} else {
		$popup = 'class="rs-button"';
	}
	?>
    
    <div class="rs-buttons">
        <a href="<?php echo $button->link; ?>" <?php echo $popup; ?>>
            <span><?php echo $button->text; ?></span>
        </a>
    </div>	
        
    <?php
}