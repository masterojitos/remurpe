<?php
/*----------------------------------------------------------------------
#Youjoomla Newsflash Module for Joomla 1.5 Version 3.0
/*======================================================================*\
|| #################################################################### ||
|| # Youjoomla LLC - YJ- Licence Number 62IE029
|| # Licensed to - Neo
|| # ---------------------------------------------------------------- # ||
|| # Copyright ©2006-2009 Youjoomla LLC. All Rights Reserved.           ||
|| # This file may not be redistributed in whole or significant part. # ||
|| # ---------------- THIS IS NOT FREE SOFTWARE ---------------- #      ||
|| # http://www.youjoomla.com | http://www.youjoomla.com/license.html # ||
|| #################################################################### ||
\*======================================================================*/

	// no direct access
	defined('_JEXEC') or die('Restricted access');
	require_once (JPATH_SITE.DS.'components'.DS.'com_content'.DS.'helpers'.DS.'route.php');

	$database					=& JFactory::getDBO();
	$mosConfig_absolute_path	= JPATH_ROOT;
	$mosConfig_live_site 		= JURI :: base();    
  
	global $mosConfig_absolute_path, $mosConfig_live_site, $mainframe, $database, $_MAMBOTS;

	$document = JFactory::getDocument();
	$document->addStyleSheet(JURI::base() . 'modules/mod_yj_newsflash5/stylesheet.css');
	$document->addScript(JURI::base() . 'modules/mod_yj_newsflash5/lib/YJNF5.js');

	
	echo "<!-- http://www.Youjoomla.com  Youjoomla Newslash Module V5 for Joomla 1.5 starts here -->	";
?>
       
<?php
       
	$now = date( 'Y-m-d H:i:s' );
	$database =& JFactory::getDBO();
	$nullDate = $database->getNullDate();

	$get_items = $params->get('get_items', 1);
	$nitems = $params->get ('nitems', 4);
	$chars = $params->get ('chars', 40);
	$imgwidth = $params->get('imgwidth', "40px");
	$imgheight = $params->get('imgheight', "40px");
	$imgalign = $params->get('imgalign', "left");
	$ordering = $params->get('ordering', 3);// 1 = ordering | 2 = popular | 3 = random 
	$showimage = $params->get('showimage', 1);
	$showrm = $params->get('showrm', 1);
	$showtitle = $params->get('showtitle', 1);
	$show_cat_title = $params->get('show_cat_title',1);
	$showdate = $params->get('showdate',1);
    $yj5_height = $params->get('yj5_height');
	$yj5_iscopy = $params->get('yj5_iscopy');
	switch ($ordering)
	{
		case 1:
			$order = 'ordering';
		break;
		
		case 2:
			$order = 'hits';
		break;
		
		case 3:
			$order = 'RAND()';
		break;		
	}
	
	$db	=& JFactory::getDBO();
	$user=& JFactory::getUser();
	$userId	= (int) $user->get('id');
	$aid = $user->get('aid', 0);

	$contentConfig = &JComponentHelper::getParams( 'com_content' );
	$access	= !$contentConfig->get('shownoauth');

	$nullDate = $db->getNullDate();

	$date =& JFactory::getDate();
	$now = $date->toMySQL();

	$where = 'a.state = 1'
			 .' AND ( a.publish_up = '.$db->Quote($nullDate).' OR a.publish_up <= '.$db->Quote($now).' )'
			 .' AND ( a.publish_down = '.$db->Quote($nullDate).' OR a.publish_down >= '.$db->Quote($now).' )';

	$sql = 'SELECT a.*, ' .
		   ' CASE WHEN CHAR_LENGTH(a.alias) THEN CONCAT_WS(":", a.id, a.alias) ELSE a.id END as slug,'. 
		   ' CASE WHEN CHAR_LENGTH(cc.alias) THEN CONCAT_WS(":", cc.id, cc.alias) ELSE cc.id END as catslug,'.
		   'cc.title as cattitle,'.
		   's.title as sectitle'.
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
	
	
		$document->addScriptDeclaration("
	window.addEvent('domready', function(){
		new YJNF5({
			outerContainer: 'yjnf5_co".$yj5_iscopy."',
			innerContainer: 'yjnf5_ci".$yj5_iscopy."',
			innerElements: '.yjnewsflash5',
			navLinks: {
				upLink: 'up".$yj5_iscopy."',
				downLink: 'down".$yj5_iscopy."'
			},
			highlightClass: 'yjnf5_h".$yj5_iscopy."'
		});
	})
");
?>
<div id="YJ_NewsFlash5<?php echo $yj5_iscopy ?>">
	<!--nav links -->
    <div class="yjnf5_nav<?php echo $yj5_iscopy ?>">
    <div class="yjmf5_nav_b">
	<a href="#" id="up<?php echo $yj5_iscopy ?>">up</a> <a href="#" id="down<?php echo $yj5_iscopy ?>">down</a> </div>
    </div>
	<!-- module content -->
	<div id="yjnf5_co<?php echo $yj5_iscopy ?>" style="height:<?php echo $yj5_height ?>;">
		<div id="yjnf5_ci<?php echo $yj5_iscopy ?>">
<?php
/**
 * set of functions that search and return the path of the first image encountered in text
 */
require_once('modules/mod_yj_newsflash5/lib/slike.php');
foreach ( $load_items as $row ) 
{
	$date = JHTML::_('date', $row->created, '%B %d, %Y');
    $intro 	= substr(strip_tags($row->introtext), 0, $chars)."...";
    $link = ContentHelperRoute::getArticleRoute($row->slug, $row->catslug, $row->sectionid);
	
    $img_url = article_image5($row);
    
    $img_out = '';
    if(isset($img_url) && $img_url != "") 
		$img_out = "<a href=\"".JRoute::_($link)."\"><img src=\"".$img_url."\" border=\"0\" height=\"".$imgheight."\" align=\"".$imgalign."\" title=\"".$row->title." \" width=\"".$imgwidth."\" alt=\"\"/></a>";

	echo '<div class="yjnewsflash5">';


		
	if( $showimage == 1){	
		echo '<div class="nfimgpos5">';
		echo $img_out;
		echo '</div>';
		}
	
	if( $showdate == 1 ){
	$show_date = $date."&nbsp;-&nbsp;";
	}else{
	$show_date ='';
	}
	
	if( $showtitle == 1 ){
		echo '<a class="yjnewsflash_title5" href="'.JRoute::_($link).'">'.$show_date.''.$row->title.'</a><br />';
		}
	echo '<p>';	
	    echo $intro;
echo '</p>';
	
	if($showrm == 1)
		echo '<span class="yjnsreadon5"><a class="yjns_rm5" href="'.JRoute::_($link).'">Leer Mas</a></span>';
	
	echo "<div class=\"clear\"><!--clear--></div></div>\n";
}
?>
		</div> <!-- close  YJ_NewsFlash_5_content_inner-->
	</div> <!-- close YJ_NewsFlash_5_content_outer-->
</div> <!--close YJ_NewsFlash5-->	