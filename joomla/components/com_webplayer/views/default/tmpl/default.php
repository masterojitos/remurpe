<?php 

/*
 * @version		$Id: default.php 1.3 2011-06-13 $
 * @package		Joomla
 * @subpackage	hdwebplayer
 * @copyright   Copyright (C) 2011-2012 HD Webplayer
 * @license     GNU/GPL http://www.gnu.org/licenses/gpl-2.0.html
*/

defined('_JEXEC') or die('Restricted access'); 

$player    = $this->player[0];
$googleads = $this->googleads[0];
$width     = $player->width;
$height    = $player->height;
$lang      = JRequest::getCmd('lang') ? '&lang='.JRequest::getCmd('lang') : '';
$video     = '';
$category  = '';
$plugin    = false;
$src       = COM_WEBPLAYER_BASEURL.'&view=player'.$lang;
$flashvars = 'baseJ='.JURI::root();
$flashvars .= JRequest::getCmd('wid') ? '&id='.JRequest::getCmd('wid')  : '' ;

if($googleads->component == 1 && $width >= 350 && $height >= 350) {
	$ad = 1;
} else {
	$ad = 0;
}
require JPATH_ROOT.DS.'components'.DS.'com_webplayer'.DS.'models'.DS.'embed.php';

?>