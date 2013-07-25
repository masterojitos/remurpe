<?php
/**
 * The RockSolid Theme for DOCman
 * @version $Id: page_docbrowse.tpl.php $
 * @package RockSolidDOCmanTheme
 * @copyright (C) 2009 JoomlaFare.com
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://joomlafare.com/
 **/
defined('_VALID_MOS') or die('Restricted access');

/**
* Display the documents overview (required)
*
* This template is called when a user performs browse the docman
*
* General variables  :
*	$this->theme->path (string) : template path
* 	$this->theme->name (string) : template name
* 	$this->theme->conf (object) : template configuartion parameters
*	$this->theme->icon (string) : template icon path
*   $this->theme->png  (boolean): browser png transparency support
*
* Preformatted html variables :
*	$this->html->menu     (string)(fetched from : general/menu.tpl.php)
	$this->html->category (string)(fetched from : categories/category.tpl.php)
*	$this->html->cat_list (string)(fetched from : categories/list.tpl.php)
*	$this->html->doc_list (string)(fetched from : documents/list.tpl.php)
*	$this->html->pagenav  (string)(fetched from : general/pagenav.tpl.php)
*	$this->html->pagetitle(string)(fetched from : general/pagetitle.tpl.php)
**/
?>

<?php $this->splugin('pagetitle', _DML_TPL_TITLE_BROWSE.$this->html->pagetitle); ?>

<?php echo $this->plugin('stylesheet', $this->theme->path . "css/theme.css"); ?>
<?php $theme = defined('_DM_J15') ? "css/theme15.css" : "css/theme10.css";
      echo $this->plugin('stylesheet', $this->theme->path . $theme) ?>
<?php echo defined('_DM_J15') ? '' : $this->plugin('javascript', $this->theme->path . "js/theme.js"); ?>

<?php
if ($this->theme->conf->item_tooltip) :
    echo $this->plugin('overlib');
endif;
?>

<?php echo $this->html->menu; ?>

<?php echo $this->html->category; ?>

<?php echo $this->html->cat_list; ?>

<?php echo $this->html->doc_list; ?>

<?php echo $this->html->pagenav; ?>