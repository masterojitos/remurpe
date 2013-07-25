<?php

/*
 * @version		$Id: html5.php 1.3 2011-06-13 $
 * @package		Joomla
 * @subpackage	hdwebplayer
 * @copyright   Copyright (C) 2011-2012 HD Webplayer
 * @license     GNU/GPL http://www.gnu.org/licenses/gpl-2.0.html
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');

class WebplayerModelHtml5 extends JModel {

	function __construct() {
		parent::__construct();
    }
	
	function getvideo($id, $category)
    {	
		 $db       =& JFactory::getDBO();
		 $category = ($category != '') ? implode('","', explode('%2C', $category)) : '';
		 
		 if($id != '') {
		 	$query  = 'SELECT type,video FROM #__webplayer_videos WHERE published = 1';
			$query .= ' AND id="'.$id.'"';
			$db->setQuery( $query );
			$output = $db->loadObjectList();
		 } else {
		 	$query  = 'SELECT type,video FROM #__webplayer_videos WHERE published = 1';
		 	$query .= ($category != '') ? ' AND category IN ("'.$category.'")' : '';
		 	$query .= ' AND category NOT IN ( SELECT name FROM `#__webplayer_category` WHERE published=0) ORDER BY category,ordering';
			$query .= ' LIMIT 1';		 
         	$db->setQuery( $query );
         	$output = $db->loadObjectList();
		 }
		 
		 if($output) {
    	 	$output[0]->ext = end(explode(".", $output[0]->video));
		 } else {
		 	$output[0]->video = $output[0]->type = $output[0]->ext = '';
		 }
		 
		 return $output;
	}	
	
}

?>