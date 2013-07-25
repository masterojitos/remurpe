<?php

/*
 * @version		$Id: playlist.php 1.3 2011-06-13 $
 * @package		Joomla
 * @subpackage	hdwebplayer
 * @copyright   Copyright (C) 2011-2012 HD Webplayer
 * @license     GNU/GPL http://www.gnu.org/licenses/gpl-2.0.html
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');

class WebplayerModelPlaylist extends JModel {

	function __construct() {
		parent::__construct();
    }
	
	function getdatas()
    {
         $db       =& JFactory::getDBO();
		 $category = JRequest::getString('category');
		 $category = ($category != '') ? implode('","', explode(',', $category)) : '';
		 $id       = JRequest::getCmd('id');
		 
         $query    = 'SELECT * FROM #__webplayer_videos WHERE published = 1';
		 $query   .= ($id       != '') ? ' AND id="'.$id.'"' : '';
		 
		 if($id == '') {
		 	$query .= ($category != '') ? ' AND category IN ("'.$category.'")' : '';
		    $query .= ' AND category NOT IN ( SELECT name FROM `#__webplayer_category` WHERE published=0) ORDER BY category,ordering';
		 }
		 
         $db->setQuery( $query );
         $output = $db->loadObjectList();
		 
		 if($id != '') {
		 	$query  = 'SELECT * FROM #__webplayer_videos WHERE published = 1';
			$query .= ' AND id!="'.$id.'"';
			$query .= ($category != '') ? ' AND category IN ("'.$category.'")' : '';
			$query .= ' AND category NOT IN ( SELECT name FROM `#__webplayer_category` WHERE published=0) ORDER BY category,ordering';
			$db->setQuery( $query );
			$output = array_merge($output, $db->loadObjectList());
		 }
		 
         $this->createXml($output);
	}
	
	function createXml($input)
	{
	
		$datas        = $input;
		$count        = (count($datas) > 0) ? count($datas) : 0;
		$br           = "\n";

		ob_clean();
		header("content-type:text/xml;charset=utf-8");
		echo '<?xml version="1.0" encoding="utf-8"?>'.$br;
		echo '<playlist>'.$br.$br;

		for ($i=0, $n=$count; $i < $n; $i++) {
			$item = $datas[$i];
			$br;
			echo '<media>'.$br;
			echo '<id>'.$item->id.'</id>'.$br;
			echo '<type>'.$this->getTyp($item->type).'</type>'.$br;
			echo '<video>'.$item->video.'</video>'.$br;
			if($item->hdvideo) {
				echo '<hd>'.$item->hdvideo.'</hd>'.$br;
			}
			echo '<streamer>'.$item->streamer.'</streamer>'.$br;
			echo '<thumb>'.$item->thumb.'</thumb>'.$br;
			if($item->token) {
				echo '<token>'.$item->token.'</token>'.$br;
			}
			echo '<preview>'.$item->preview.'</preview>'.$br;
			echo '<title>'.$item->title.'</title>'.$br;
			echo '</media>'.$br.$br;
		}

		echo '</playlist>';
		exit();
		
	}
	
	function getTyp($typ)
	{
		switch($typ) {
	    	case 'General Upload':
			case 'FFMPEG Upload':
			case 'Direct URL':
				return 'video';
				break;
			case 'Youtube Videos':
				return 'youtube';
				break;
			case 'Dailymotion Videos':
				return 'dailymotion';
				break;
			case 'RTMP Streams':
				return 'rtmp';
				break;
			case 'SMIL':
				return 'highwinds';
				break;
			case 'Lighttpd Videos':
				return 'lighttpd';
				break;
			default :
		    	return 'video';
		}
	}
	
}

?>