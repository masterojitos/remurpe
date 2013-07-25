<?php

/*
 * @version		$Id: helper.php 1.3 2011-06-13 $
 * @package		Joomla
 * @subpackage	hdwebplayer
 * @copyright   Copyright (C) 2011-2012 HD Webplayer
 * @license     GNU/GPL http://www.gnu.org/licenses/gpl-2.0.html
*/
 
// no direct access
defined('_JEXEC') or die('Restricted access');

class modwebplayerHelper
{

    function getItems( $params )
    {
		$itm               =  array();
		$itm["width"]      =  $params->get('width');
		$itm["height"]     =  $params->get('height');
		
		$category		   =  (array) $params->get('categories');
		$numeric           =  false;
		
		foreach ($category as $element) {
    		if (is_numeric($element)) {
        		$numeric  = true;
				break;
    		} else {
        		$numeric  = false;
    		}
		}
		
		if($numeric) {	
			
			$category          =  implode(" OR ", $category);
			$db                =& JFactory::getDBO();		
			$query             =  "SELECT name FROM #__webplayer_category WHERE id=".$category;
       		$db->setQuery( $query );
       		$output            =  $db->loadObjectList();
		
			$row               =  array();
			for ($i=0, $n=count($output); $i < $n; $i++) {
				$row[$i] = $output[$i]->name;
			}
			
			$itm["categories"] = $row;	
					
		} else {		
		    $itm["categories"] = $category;			
		}
	
		$itm["autoStart"]  = $params->get('autoplay');
		
        return $itm;
    }
	
	function googleads()
    {
         $db     =& JFactory::getDBO();
         $query  = "SELECT * FROM #__webplayer_googleads";
         $db->setQuery( $query );
         $output = $db->loadObjectList();
		 
         return($output[0]);
	}
}

?>