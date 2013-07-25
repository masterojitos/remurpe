<?php
/**
 * The RockSolid Theme for DOCman
 * @version $Id: pathway.tpl.php $
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
* Display the pathway (required)
*
* General variables  :
*	$this->theme->path (string) : template path
* 	$this->theme->name (string) : template name
* 	$this->theme->conf (object) : template configuartion parameters
*	$this->theme->icon (string) : template icon path
*   $this->theme->png  (boolean): browser png transparency support
*
* Template variables :
*	$this->links (array) : an array of link objects
**/

/*
* Traverse through the links object array and display each link,
* remove the last item of the array and only display it's name.
*
* Link object variables
*	$link->link (string) : url of the link
*	$link->name (string) : name of the link
*	$link->title (string): title of the link
*/
global $mainframe;

if(defined('_DM_J15')){
    $pathway = & $mainframe->getPathWay();
    $first = array_shift($this->links);

    foreach($this->links as $link) {
        $uri = str_replace(JURI::root(), '', $link->link);
        $uri = str_replace('&amp;', '&', $uri);
        $pathway->addItem($link->title, $uri);
    }
} else {
    $last = array_pop($this->links);
    $first = array_shift($this->links);

    foreach($this->links as $link) :
    	ob_start();
        ?><a title="<?php echo $link->title; ?>" href="<?php echo $link->link; ?>">
        <?php echo $link->title; ?></a><?php
        $mainframe->appendPathway( ob_get_clean() );
    endforeach;
    $mainframe->appendPathway( $last->title );
}