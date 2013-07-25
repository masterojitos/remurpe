<?php 

/*
 * @version		$Id: default_googleads.php 1.3 2011-06-13 $
 * @package		Joomla
 * @subpackage	hdwebplayer
 * @copyright   Copyright (C) 2011-2012 HD Webplayer
 * @license     GNU/GPL http://www.gnu.org/licenses/gpl-2.0.html
*/

defined('_JEXEC') or die('Restricted access');

$width      = $items['width'];
$height     = $items['height'];
$lang       = JRequest::getCmd('lang') ? '&lang='.JRequest::getCmd('lang')  : '';
$category   = ($items['categories'] == '') ? '' : implode("%2C", $items['categories']);
$video      = '';
$plugin     = false;
$src        = JURI::root().'index.php?option=com_webplayer&view=player'.$lang;
$flashvars  = 'baseJ='.JURI::root();
$flashvars .= ($category            == '') ? ''  : '&category='.$category;
$flashvars .= ($items['autoStart']  == 1)  ? '&autoStart=true' : '&autoStart=false';
$flashvars .= JRequest::getCmd('wid') ? '&id='.JRequest::getCmd('wid')  : '' ;

if($googleads->module == 1 && $width  >= 350 && $height >= 350) {
	$ad = 1;
} else {
	$ad = 0;
}
require JPATH_ROOT.DS.'components'.DS.'com_webplayer'.DS.'models'.DS.'embed.php';

?>