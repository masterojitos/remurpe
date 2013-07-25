<?php

/*
 * @version		$Id: player.php 1.3 2011-06-13 $
 * @package		Joomla
 * @subpackage	hdwebplayer
 * @copyright   Copyright (C) 2011-2012 HD Webplayer
 * @license     GNU/GPL http://www.gnu.org/licenses/gpl-2.0.html
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');

class WebplayerModelPlayer extends JModel {

	function __construct() {
		parent::__construct();
    }
	
	function getplayer()
    {
	
        $player = JPATH_COMPONENT.DS.'player.swf';
		
		ob_clean();
		header("content-type:application/x-shockwave-flash");
		readfile($player);
		exit();
		
	}
}

?>