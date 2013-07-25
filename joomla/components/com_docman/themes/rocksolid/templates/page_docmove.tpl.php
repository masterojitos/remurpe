<?php
/**
 * The RockSolid Theme for DOCman
 * @version $Id: page_docmove.tpl.php $
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
* Display the move document form (required)
*
* This template is called when a user performs a move operation on a document.
*
* General variables  :
*	$this->theme->path (string) : template path
*	$this->theme->name (string) : template name
*	$this->theme->conf (object) : template configuartion parameters
*	$this->theme->icon (string) : template icon path
*   $this->theme->png  (boolean): browser png transparency support
*
* Preformatted variables :
*	$this->html->docmove (string)(hardcoded, can change in future versions)
**/
?>

<?php $this->splugin('pagetitle', _DML_TPL_TITLE_MOVE ); ?>

<?php echo $this->plugin('stylesheet', $this->theme->path."css/theme.css"); ?>
<?php $theme = defined('_DM_J15') ? "css/theme15.css" : "css/theme10.css";
      echo $this->plugin('stylesheet', $this->theme->path . $theme); ?>

<?php echo $this->html->menu; ?>

<h2 id="dm-title"><?php echo _DML_TPL_TITLE_MOVE; ?></h2>

<?php echo $this->html->docmove; ?>

<div class="dm-taskbar">
<div class="rs-buttons">
    <a href="javascript: history.go(-1);" class="rs-button"><span><?php echo _DML_TPL_BACK; ?></span></a>
</div>
</div>