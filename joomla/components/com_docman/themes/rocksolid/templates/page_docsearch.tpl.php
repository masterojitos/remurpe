<?php
/**
 * The RockSolid Theme for DOCman
 * @version $Id: page_docsearch.tpl.php $
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
*	$this->html->menu     	(string)(fetched from : general/menu.tpl.php)
*	$this->html->searchform	(string)(hardcoded)
*
* Template variables :
*	$this->items (array)  : holds an array of dcoument items
**/
global $mainframe;
$mainframe->appendPathway(_DML_TPL_TITLE_SEARCH);
?>

<?php $this->splugin('pagetitle', _DML_TPL_TITLE_SEARCH ) ?>

<?php echo $this->plugin('stylesheet', $this->theme->path . "css/theme.css") ?>
<?php $theme = defined('_DM_J15') ? "css/theme15.css" : "css/theme10.css";
      echo $this->plugin('stylesheet', $this->theme->path . $theme) ?>
<?php
if ($this->theme->conf->item_tooltip) :
    echo $this->plugin('overlib');
endif;
?>
<?php echo $this->html->menu; ?>
<h2 id="dm-title"><?php echo _DML_TPL_TITLE_SEARCH;?></h2>
<?php echo $this->html->searchform ?>

<?php
// If we have no items to show
if (count($this->items) == 0) :
    // show a message if a search term was entered
    if( mosGetParam($_REQUEST, 'search_phrase') ) {
        $_REQUEST['mosmsg'] = _DML_TPL_NO_ITEMS_FOUND;
    }
    return;
endif;
?>
<hr />
<dl id="dm-docs">

<?php
/*
     * Include the list_item template and pass the item to it
    */
$category = '';
foreach($this->items as $item) :
    if ($category != $item->data->category) :
        $category = $item->data->category ;
        ?><dt class="dm-cat"><?php echo _DML_CAT .': '. $item->data->category ?></dt><?php
    endif;
    $this->doc = &$item; //add item to template variables
    include $this->loadTemplate('documents/list_item.tpl.php');
endforeach;

?>
</dl>
