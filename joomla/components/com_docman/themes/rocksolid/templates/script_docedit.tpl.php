<?php
/**
 * The RockSolid Theme for DOCman
 * @version $Id: script_docedit.tpl.php $
 * @package RockSolidDOCmanTheme
 * @copyright (C) 2009 JoomlaFare.com
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://joomlafare.com/
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
*	$this->theme->icon (string) : template icon
*   $this->theme->png  (boolean): browser png transparency support
*
**/
?>

<?php
include $this->loadTemplate('scripts/form_docedit.tpl.php');
?>