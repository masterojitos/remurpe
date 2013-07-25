<?php

/*
 * @version		$Id: mod_webplayer.php 1.3 2011-06-13 $
 * @package		Joomla
 * @subpackage	hdwebplayer
 * @copyright   Copyright (C) 2011-2012 HD Webplayer
 * @license     GNU/GPL http://www.gnu.org/licenses/gpl-2.0.html
*/
 
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
 
// Include the syndicate functions only once
require_once( dirname(__FILE__).DS.'helper.php' );
 
$items     = modwebplayerHelper::getItems( $params );
$googleads = modwebplayerHelper::googleads();

require(JModuleHelper::getLayoutPath('mod_webplayer'));

?>