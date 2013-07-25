<?php
/*----------------------------------------------------------------------
#Youjoomla Newsflash Module for Joomla 1.5 Version 1.0
# ----------------------------------------------------------------------
# Copyright (C) 2007 You Joomla. All Rights Reserved.
# Designed by: Youjoomla.com
# Commercial
# Website: http://www.youjoomla.com// Copyright (c) 2006 - 2008 Youjoomla LLC
# This code cannot be redistributed without permission from Youjoomla - http://www.youjoomla.com.
# More info at http://www.youjoomla.com 
# Developer: Dragan Todorovic
------------------------------------------------------------------------*/

// no direct access
defined('_JEXEC') or die('Restricted access');
require_once (JPATH_SITE.DS.'components'.DS.'com_content'.DS.'helpers'.DS.'route.php');
$database					=& JFactory::getDBO();
$mosConfig_absolute_path	= JPATH_ROOT;
$mosConfig_live_site 		= JURI :: base();    
  
require_once('modules/mod_yj_newsflash/lib/slike.php');

global $mosConfig_absolute_path, $mosConfig_live_site, $mainframe, $database, $_MAMBOTS;




  echo "<!-- http://www.Youjoomla.com  Youjoomla Newslash Module for Joomla 1.5 starts here -->	";

?>

		
        
<?php

        
  $now 		    = date('Y-m-d H:i:s');
  $database 	=& JFactory::getDBO();
  $nullDate 	= $database->getNullDate();


$get_items = $params->get('get_items',1);
$nitems = $params->get ('nitems',4);
$chars = $params->get ('chars',40);

$border_t = $params->get ('border_t','1px solid #e5e5e5');
$border_r =$params->get ('border_r','1px solid #e5e5e5');
$border_b =$params->get ('border_b','1px solid #e5e5e5');
$border_l =$params->get ('border_l','1px solid #e5e5e5');
$imgwidth=$params->get('imgwidth',"40px");
$imgheight=$params->get('imgheight',"40px");
$imgalign = $params->get('imgalign',"left");
$imgborder = $params->get('imgborder',"1px solid #e5e5e5");
$ordering = $params->get('ordering',3);// 1 = ordering | 2 = popular | 3 = random 
$showimage = $params->get('showimage',1);

if($ordering ==1){
$order = 'ordering';
}elseif($ordering == 2){
$order = 'hits';
}elseif ($ordering == 3){
$order = 'RAND()';
}


			
			

		$db			=& JFactory::getDBO();
		$user		=& JFactory::getUser();
		$userId		= (int) $user->get('id');
		$aid		= $user->get('aid', 0);

		$contentConfig = &JComponentHelper::getParams( 'com_content' );
		$access		= !$contentConfig->get('shownoauth');

		$nullDate	= $db->getNullDate();

		$date =& JFactory::getDate();
		$now = $date->toMySQL();

		$where		= 'a.state = 1'
			. ' AND ( a.publish_up = '.$db->Quote($nullDate).' OR a.publish_up <= '.$db->Quote($now).' )'
			. ' AND ( a.publish_down = '.$db->Quote($nullDate).' OR a.publish_down >= '.$db->Quote($now).' )'
			;



$sql = 'SELECT a.*, ' .
' CASE WHEN CHAR_LENGTH(a.alias) THEN CONCAT_WS(":", a.id, a.alias) ELSE a.id END as slug,'. 
' CASE WHEN CHAR_LENGTH(cc.alias) THEN CONCAT_WS(":", cc.id, cc.alias) ELSE cc.id END as catslug'.
			' FROM #__content AS a' .
			' INNER JOIN #__categories AS cc ON cc.id = a.catid' .
			' INNER JOIN #__sections AS s ON s.id = a.sectionid' .
			' WHERE '. $where .' AND cc.id = '.$get_items.'' .
			($access ? ' AND a.access <= ' .(int) $aid. ' AND cc.access <= ' .(int) $aid. ' AND s.access <= ' .(int) $aid : '').
			' AND s.published = 1' .
			' AND cc.published = 1' .
			' ORDER BY '.$order .' LIMIT 0,'.$nitems.'';
			
			
$database->setQuery( $sql );
$load_items = $database->loadObjectList();

?>
<?php
     // error_reporting(E_ALL);
	 

foreach ( $load_items as $row ) {
require('modules/mod_yj_newsflash/lib/slike1.php');

    $intro 	= substr(strip_tags($row->introtext),0,$chars)."...";
   $link = ContentHelperRoute::getArticleRoute($row->slug, $row->catslug, $row->sectionid);
	if(isset($img_url) && $img_url != "") $img_out="<a href=\"".JRoute::_($link)."\"><img src=\"".$img_url."\" border=\"0\" height=\"".$imgheight."\" style=\"border:".$imgborder.";padding:3px;margin:0px 5px 0px 0px;\" align=\"".$imgalign."\" title=\"".$row->title." \" width=\"".$imgwidth."\" alt=\"\"/></a>";


echo "<div class=\"yjnewsflash\" style=\"display:block;width:auto;border-left:".$border_l.";border-right:".$border_r.";border-top:".$border_t.";border-bottom:".$border_b.";margin:0px 0px 5px 0px;overflow:hidden; padding:3px;font-size:12px;height:1% !important;\">";
if($showimage == 1){

if($imgalign == 'left' || $imgalign == 'right' || $imgalign == 'top'){


if($imgalign == 'top'){
echo '<div class="nfimgpos">';
}
if(isset($img_url) && $img_url != "") echo $img_out;

if($imgalign == 'top'){
echo '</div>';
}
}
}

echo "<a href=\"".JRoute::_($link)."\">".$row->title."</a><br />";
echo $intro;

if($showimage == 1){
if($imgalign == 'bottom'){


echo '<div class="nfimgpos">';
if(isset($img_url) && $img_url != "") echo $img_out;
echo '</div>';

}
}

echo "</div>\n";
}
?>



