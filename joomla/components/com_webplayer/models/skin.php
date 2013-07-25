<?php

/*
 * @version		$Id: skin.php 1.3 2011-06-13 $
 * @package		Joomla
 * @subpackage	hdwebplayer
 * @copyright   Copyright (C) 2011-2012 HD Webplayer
 * @license     GNU/GPL http://www.gnu.org/licenses/gpl-2.0.html
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');

class WebplayerModelSkin extends JModel {

	function __construct() {
		parent::__construct();
    }
	
	function getdatas()
    {
         $db     =& JFactory::getDBO();
         $query  = "SELECT * FROM #__webplayer_skin";
         $db->setQuery( $query );
         $output = $db->loadObjectList();
         $this->createXml($output);
	}
	
	function createXml($input)
	{
	
		$datas        = $input[0];
		$br           = "\n";

		foreach( $datas as $key => $value){
			$datas->$key = ($datas->$key == 1) ? 'true' : 'false';
		}

		ob_clean();
		header("content-type:text/xml;charset=utf-8");
		echo '<?xml version="1.0" encoding="utf-8"?>'.$br;
		echo '<skin>'.$br;

		echo '<controlbar><display>'.$datas->controlbar.'</display></controlbar>'.$br;
		echo '<playpause><display>'.$datas->playpause.'</display></playpause>'.$br;
		echo '<progressbar><display>'.$datas->progressbar.'</display></progressbar>'.$br;
		echo '<timer><display>'.$datas->timer.'</display></timer>'.$br;
		echo '<share><display>'.$datas->share.'</display></share>'.$br;
		echo '<volume><display>'.$datas->volume.'</display></volume>'.$br;
		echo '<fullscreen><display>'.$datas->fullscreen.'</display></fullscreen>'.$br;
		echo '<playdock><display>'.$datas->playdock.'</display></playdock>'.$br;
		echo '<videogallery><display>'.$datas->videogallery.'</display></videogallery>'.$br;
		
		echo '</skin>'.$br;
		exit();
		
	}
	
}

?>