<?php

/*
 * @version		$Id: default.php 1.3 2011-06-13 $
 * @package		Joomla
 * @subpackage	hdwebplayer
 * @copyright   Copyright (C) 2011-2012 HD Webplayer
 * @license     GNU/GPL http://www.gnu.org/licenses/gpl-2.0.html
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');

class WebplayerModelDefault extends JModel {

	function __construct() {
		parent::__construct();
    }
	
	function player()
    {
         $db     =& JFactory::getDBO();
         $query  = "SELECT * FROM #__webplayer_settings";
         $db->setQuery( $query );
         $output = $db->loadObjectList();
         return($output);
	}
	
	function googleads()
    {
         $db     =& JFactory::getDBO();
         $query  = "SELECT * FROM #__webplayer_googleads";
         $db->setQuery( $query );
         $output = $db->loadObjectList();
         return($output);
	}
	
}

?>