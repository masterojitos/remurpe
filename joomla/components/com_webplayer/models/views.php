<?php

/*
 * @version		$Id: views.php 1.3 2011-06-13 $
 * @package		Joomla
 * @subpackage	hdwebplayer
 * @copyright   Copyright (C) 2011-2012 HD Webplayer
 * @license     GNU/GPL http://www.gnu.org/licenses/gpl-2.0.html
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');

class WebplayerModelViews extends JModel {

	function __construct() {
		parent::__construct();
    }
	
	function addview()
    {
		 ob_clean();
	     $id               = JRequest::getCmd('id');
         $mainframe        = JFactory::getApplication();	
     
    	 $db               =& JFactory::getDBO();
		 $query            = "SELECT views FROM #__webplayer_videos WHERE id=".$id;
    	 $db->setQuery ( $query );
    	 $output           = $db->loadObjectList();
		 
		 $count            = $output[0]->views + 1;
	 
		 $query            = "UPDATE #__webplayer_videos SET views=".$count." WHERE id=".$id;
    	 $db->setQuery ( $query );
		 $db->query();
		 exit();
	}
	
}

?>