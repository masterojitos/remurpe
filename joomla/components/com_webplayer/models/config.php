<?php

/*
 * @version		$Id: config.php 1.3 2011-06-13 $
 * @package		Joomla
 * @subpackage	hdwebplayer
 * @copyright   Copyright (C) 2011-2012 HD Webplayer
 * @license     GNU/GPL http://www.gnu.org/licenses/gpl-2.0.html
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');

class WebplayerModelConfig extends JModel {

	function __construct() {
		parent::__construct();
    }
	
	function getdatas()
    {
         $db     =& JFactory::getDBO();
         $query  = "SELECT * FROM #__webplayer_settings";
         $db->setQuery( $query );
         $output = $db->loadObjectList();
         $this->createXml($output);
	}
	
	function createXml($input)
	{
	
		$datas        = $input[0];
		$lang         = JRequest::getCmd('lang') ? '&lang='.JRequest::getCmd('lang') : '';
		$skinxml  	  = COM_WEBPLAYER_BASEURL."%26view=skin%26". JUtility::getToken() ."=1".$lang;
		$category     = JRequest::getString('category');
		$category     = str_replace(',', '%2C', $category);
		$id           = JRequest::getCmd('id');
		$playlistxml  = COM_WEBPLAYER_BASEURL."%26view=playlist%26". JUtility::getToken() ."=1".$lang;
		$playlistxml .= ($category != '') ? '%26category='.$category : '';
		$playlistxml .= ($id       != '') ? '%26id='.$id             : '';
		$email        =  COM_WEBPLAYER_BASEURL."%26view=email%26". JUtility::getToken() ."=1".$lang;
		$br           = "\n";

		ob_clean();
		header("content-type:text/xml;charset=utf-8");
		echo '<?xml version="1.0" encoding="utf-8"?>'.$br;
		echo '<config>'.$br;
		echo '<license>'.$datas->licensekey.'</license>'.$br;
		echo '<logo>'.$datas->logo.'</logo>'.$br;
		echo '<logoPosition>'.$datas->logoposition.'</logoPosition>'.$br;
		echo '<logoAlpha>'.$datas->logoalpha.'</logoAlpha>'.$br;
		echo '<logoTarget>'.$datas->logotarget.'</logoTarget>'.$br;
		echo '<skinXml>'.$skinxml.'</skinXml>'.$br;
		echo '<skinMode>'.$datas->skinmode.'</skinMode>'.$br;
		echo '<playlistXml>'.$playlistxml.'</playlistXml>'.$br;
		echo '<playlistAutoStart>'.$this->castAsBoolean($datas->playlistautoplay).'</playlistAutoStart>'.$br;
		echo '<playlistOpen>'.$this->castAsBoolean($datas->playlistopen).'</playlistOpen>'.$br;
		echo '<autoStart>'.$this->castAsBoolean($datas->autoplay).'</autoStart>'.$br;
		echo '<stretch>'.$datas->stretchtype.'</stretch>'.$br;
		echo '<buffer>'.$datas->buffertime.'</buffer>'.$br;
		echo '<volumeLevel>'.$datas->volumelevel.'</volumeLevel>'.$br;
		echo '<emailPhp>'.$email.'</emailPhp>'.$br;
		echo '</config>'.$br;
		exit();

	}
	
	function castAsBoolean($val){
		if($val == 1) {
	    	return 'true';
		} else {
			return 'false';
		}
	}

}

?>