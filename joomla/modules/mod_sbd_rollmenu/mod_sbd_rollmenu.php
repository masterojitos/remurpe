<?php
/**
*  SBD Accordion Menu Joomla 1.5 Native
* Copyright (C) 2007 Simple By Design Ltd
* 
*  This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
* 
*  This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
* 
*  You should have received a copy of the GNU General Public License
* along with this program.  If not, see <http://www.gnu.org/licenses/>.
*
* @version $Id: mod_sbd_rollmenu.php,v 0.9.84a.J15N 2008-03-03 23:28 deutz Exp $
* @package sbd_rollmenu
* @copyright Copyright (C) 2007 Simple By Design

*
* More Information regarding this module can be found at the following location:
*
* http://www.simplebydesign.co.uk/joomla/modules/sbd-accordian-menu.html
*

**/


// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

if (!defined( '_MOS_ROLLMENU_MODULE' )) {
	$GLOBALS['sSBDRollMenudEBUG'] = array();
	/** ensure that functions are declared only once */
	define( '_MOS_ROLLMENU_MODULE', 1 );
	global $database, $Itemid;
	$document = JFactory::getDocument();
	$livePath = JURI::base(false) . '';
	$modDir = $livePath . "/modules/mod_sbd_rollmenu/mod_sbdrollmenu/";
	
	
	$document->addCustomTag('<!--Simple By Design: SBD Accordion Menu for Joomla (v0.9.84a.J15N) - http://www.simplebydesign.co.uk/joomla/modules/sbd-accordian-menu.html-->');
	$document->addCustomTag('<!--Yahoo! User Interface Library : http://developer.yahoo.com/yui/index.html-->');
	$document->addScript($modDir.'yahoo_2.0.0-b2.js');
	$document->addScript($modDir.'event_2.0.0-b2.js');
	$document->addScript($modDir.'dom_2.0.2-b3.js');
	$document->addScript($modDir.'animation_2.0.0-b3.js');
	
	$tempFiles = '<!--required library-->';
	$tempFiles .= '<!--Simple By Design: SBD Accordion Menu for Joomla (v0.9.84a.J15N) - http://www.simplebydesign.co.uk/joomla/modules/sbd-accordian-menu.html-->';
	$tempFiles .= '<!--Yahoo! User Interface Library : http://developer.yahoo.com/yui/index.html-->';
	$tempFiles .= '<script type="text/javascript" src="'.$modDir.'yahoo_2.0.0-b2.js"></script>';
	$tempFiles .= '<script type="text/javascript" src="'.$modDir.'event_2.0.0-b2.js" ></script>';
	$tempFiles .= '<script type="text/javascript" src="'.$modDir.'dom_2.0.2-b3.js"></script>';
	$tempFiles .= '<script type="text/javascript" src="'.$modDir.'animation_2.0.0-b3.js"></script>';
	
	if( $params->get( 'usecompressedjs' ) == 1 ){
		$tempFiles .=  '<script type="text/javascript" src="'.$modDir.'mod_sbd_roll_compressed.js"></script><!--//required library-->';
		$document->addScript($modDir.'mod_sbd_roll_compressed.js');
	}else{
		$tempFiles .=  '<script type="text/javascript" src="'.$modDir.'mod_sbd_rollmenu.js"></script><!--//required library-->';
		$document->addScript($modDir.'mod_sbd_rollmenu.js');
	}
	if( $params->get('attemptvalidation') == 0 ){
		$tempFiles .=  '<style type="text/css" media="screen">@import "'.$modDir.'mod_sbd_rollmenu.css";</style>';
		$document->addStyleSheet($modDir.'mod_sbd_rollmenu.css');
	}
	
	switch( $params->get('mouseoverver') ){
		case 0:
		case 1:
			$tempJavascript = "<!--\n";
			$tempJavascript .= "function runOver( id ){\n";
			$tempJavascript .= "	if( runOk == 1 && currentId != id ){\n";
			$tempJavascript .= "		runOk = 0;\n";
			$tempJavascript .= "		window.setTimeout( 'switchRun()', $params->get( 'time_delay' ) );\n";
			$tempJavascript .= "		currentId = id;\n";
			$tempJavascript .= "		window.setTimeout( 'AccordionMenu.openDtById(\''+id+'\')', $params->get( 'menu_delay' ) );\n";
			$tempJavascript .= "		//alert( id );\n";
			$tempJavascript .= "	}\n";
			$tempJavascript .= "}\n";
			
			break;
		case 2:
			$tempJavascript = "<!--\n";
			$tempJavascript .= "function runOver( id ){\n";
			$tempJavascript .= "	currentId = id;\n";
			$tempJavascript .= "	window.setTimeout( 'delayRun( \''+id+'\' )', $params->get( 'time_delay' ) );\n";
			$tempJavascript .= "	//alert( id );\n";
			$tempJavascript .= "}\n";
			break;
	}

	$tempJavascript .= "function runOut( id ){\n";
	$tempJavascript .= "	AccordionMenu.openDtById(id, 0);\n";
	$tempJavascript .= " 	runOk = 1;\n";
	$tempJavascript .= "	currentId = 0;\n";
	$tempJavascript .= "}\n";
	$tempJavascript .= "//-->\n";
	$document->addScriptDeclaration( $tempJavascript );
	$GLOBALS['sSBDRollMenudEBUG'][$row->id]['Version'] = "Version: 0.9.84a.J15N";
	$GLOBALS['sSBDRollMenudEBUG'][$row->id]['header'] = "Added Script Tag";	
	

	function curPageURL() {
		$pageURL = 'http';
		if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}

	function hideMenu( &$itemid, &$menusToIgnore ){
		$return = false;
		if( isset( $menusToIgnore ) ){
			$menusToIgnore = split( ",", $menusToIgnore );	
			if( is_array( $menusToIgnore ) ){
				foreach( $menusToIgnore AS $value ){
					if( $itemid == $value ){
						$return = true;	
					}	
				}
			}else{
				if( $itemid == $menusToIgnore ){
					$return = true;
				}
			}
		}
		return $return;
	}

	function findMenuImage( &$mitem, &$level, &$params ){
		$livePath = JURI::base(false) . '';
		switch( $params->get( 'useimage' ) ){
			case 0:
				$txt =	$mitem->name . '';					
				break;
			case 1:
			case 2:
				if( $level > 0 && $params->get( 'useimage' ) == 2 ){
					$txt = $mitem->name . '';
					break;
				}
			case 3:
				if( $level == 0 && $params->get( 'useimage' ) == 3 ){
					$txt = $mitem->name . '';
					break;
				}
			case 4:
				$tempLevel = ','.$level.',';
				$tempSelected = ','.$params->get('imagelevels').',';
				if( strpos( $tempSelected, $tempLevel ) === false && $params->get('useimage') == 4 ){
					$txt = $mitem->name . '';
					break;
				} 
				$filename = strtolower( $params->get( 'imagepath' ) . '/' .str_replace( ' ', '-', $mitem->name ) . '.' . $params->get( 'imageext' ) );
				$GLOBALS['sSBDRollMenudEBUG'][$mitem->id]['filename'] = $filename;							
				if( file_exists( $filename ) ){
					$txt =	'<img id="menuid_'.$mitem->id.'" src="'.$livePath.'/'.$filename.'" alt="'. $mitem->name .'" />';
				}else{
					$txt =	$mitem->name;// .$livePath.'/'.$filename.'';
				}
			break;
		}				
		
		return $txt;	
	}	
	
	function sbdBrowsernav( $type ){
		switch( $type ){
			case 'separator':
			$return = 3;
			break;
		case 'component':
			default:
			$return = 0;
			break;
		}
		return $return;
	}

	/**
	*
	* Recursive function to find parent menu to expand
	*
	*/
	function sbdrollFindParent( $params, $id=0, $level=0 ){
		global $database, $my, $mosConfig_shownoauth;
		
		
		$and = '';
		if ( !$mosConfig_shownoauth ) {
			$and = "\n AND access <= " . (int) $my->gid;
		}
		
		$sql = "SELECT m.*"
		. "\n FROM #__menu AS m"
		. "\n WHERE menutype = " . $database->Quote( $params->get( 'menutype' ) )
		. "\n AND published = 1"
		. "\n AND link LIKE '%&id=" . $id . "%'"
		. $and
		. "\n ORDER BY parent, ordering";		
		// 		$database->setQuery( $sql );
		// 		$rows = $database->loadObjectList( 'id' );
		$database->setQuery( $sql );
		$rows = $database->loadObjectList( 'id' );
		
		foreach( $rows AS $row ){
		//			echo "<pre>";
		//			print_r( $row );
		//			echo "</pre>";	
		}	
		
	}

	/**
	* Utility function for writing a menu link
	*/
	function sbdrollGetMenuLink( $mitem, $level=0, &$params, $open=null, $url=0 ) {
		global $Itemid, $mainframe;
		global $id;
		$livePath = JURI::base(false) . '';
		$contentId = $id;
		$txt = '';
		$GLOBALS['sSBDRollMenudEBUG'][$mitem->id]['name'] = $mitem->name;
		if( !isset( $mitem->urldone ) ){
			$mitem->urldone = 0;
		}
		
		$GLOBALS['sSBDRollMenudEBUG'][$mitem->id]['urldone'] = $mitem->urldone;
		if( $mitem->urldone == 0 ){
			switch ($mitem->type) {
				case 'separator':
				case 'component_item_link':
					break;
				case 'url':
					if ( eregi( 'index.php\?', $mitem->link ) && !eregi( 'http', $mitem->link ) && !eregi( 'https', $mitem->link ) ) {
						if ( !eregi( 'Itemid=', $mitem->link ) ) {
							$mitem->link .= '&Itemid='. $mitem->id;
							$GLOBALS['sSBDRollMenudEBUG'][$mitem->id]['url'] = $mitem->link;
						}
					}
					break;
				case 'content_item_link':
				case 'content_typed':
					// load menu params
					$menuparams = new mosParameters( $mitem->params, $mainframe->getPath( 'menu_xml', $mitem->type ), 'menu' );
					
					$unique_itemid = $menuparams->get( 'unique_itemid', 1 );
					
					if ( $unique_itemid && !eregi( 'Itemid=', $mitem->link ) ) {
						$mitem->link .= '&Itemid='. $mitem->id;
						$GLOBALS['sSBDRollMenudEBUG'][$mitem->id]['uniqueitemid'] = $mitem->link;
					} else {
						$temp = split('&task=view&id=', $mitem->link);
						
						if ( $mitem->type == 'content_typed' ) {
							if ( !eregi( 'Itemid=', $mitem->link ) ) {
								$mitem->link .= '&Itemid='. $mainframe->getItemid($temp[1], 1, 0);
								$GLOBALS['sSBDRollMenudEBUG'][$mitem->id]['contenttyped'] = $mitem->link;
							}
						} else {
							if ( !eregi( 'Itemid=', $mitem->link ) ) {
								$mitem->link .= '&Itemid='. $mainframe->getItemid($temp[1], 0, 1);
								$GLOBALS['sSBDRollMenudEBUG'][$mitem->id]['noncontenttyped'] = $mitem->link;
							}
						}
					}
					break;
				
				default:
					if ( !eregi( 'Itemid=', $mitem->link ) ) {
						$mitem->link .= '&Itemid='. $mitem->id;
						$GLOBALS['sSBDRollMenudEBUG'][$mitem->id]['default'] = $mitem->link;
					}
					break;
			}
		}
		
		
		// Active Menu highlighting
		$current_itemid = $Itemid;
		$activeparent_roll_menu = 0;
		$GLOBALS['sSBDRollMenudEBUG'][$mitem->id]['currentId'] = $Itemid;
		if ( !$current_itemid ) {
			$id = '';
		} else if ( $current_itemid == $mitem->id ) {
			$id = 'id="active_roll_menu'. $params->get( 'class_sfx' ) .'"';
			$activeparent_roll_menu = 1;
		} else if( isset( $open ) && in_array( $mitem->id, $open ) )  {
			$id = 'id="activeparent_roll_menu';
			$activeparent_roll_menu = 1;
			if( $params->get( 'parentlevel' ) ){
				$id .= '_' . $level;
			}
			$id .= $params->get( 'class_sfx' ) .'"';
		} else {
		$id = '';
		}
		
		if ( $params->get( 'full_active_id' ) ) {
			// support for `active_menu` of 'Link - Component Item'
			if ( $id == '' && $mitem->type == 'component_item_link' ) {
				parse_str( $mitem->link, $url );
				if ( $url['Itemid'] == $current_itemid ) {
					$id = 'id="active_roll_menu'. $params->get( 'class_sfx' ) .'"';
				}
			}
			
			// support for `active_menu` of 'Link - Url' if link is relative
			if ( $id == '' && $mitem->type == 'url' && strpos( 'http', $mitem->link ) === false) {
				parse_str( $mitem->link, $url );
				if ( isset( $url['Itemid'] ) ) {
					if ( $url['Itemid'] == $current_itemid ) {
						$id = 'id="active_roll_menu'. $params->get( 'class_sfx' ) .'"';
					}
				}
			}
		}
		$isActive = 0;
		if( isset( $url['Itemid'] ) ){
			if ( $url['Itemid'] == $current_itemid ) {
				$isActive = 1;
			}
		}
		
		// replace & with amp; for xhtml compliance
		if( $mitem->urldone == 0 ){
			$mitem->link = $mitem->link; //ampReplace()
			$GLOBALS['sSBDRollMenudEBUG'][$mitem->id]['ampreplace'] = $mitem->link;
			if (strcasecmp(substr($mitem->link, 0, 4), 'http')) {
				$mitem->link = JRoute::_($mitem->link, true, 0);
			} else {
				//		$mitem->link = $mitem->link;
			}
		}
		
		$GLOBALS['sSBDRollMenudEBUG'][$mitem->id]['sef'] = $mitem->link;
		
		$menuclass = 'rollmainlevel';
		if( $params->get( 'menulevel_sfx' ) ){
			$menuclass .= '_'.$mitem->id;
		}
		$tempsfx = $params->get( 'class_sfx' );
		if( !empty( $tempsfx  ) ){
			$menuclass .= '_' . $params->get( 'class_sfx' );
		}
		if ($level > 0) {
			$menuclass = 'rollsublevel';
			if( $params->get( 'menulevel_sfx' ) ){
				$menuclass .= '_'.$mitem->parent;
			}
			if( $params->get( 'level_sfx' ) ){
				$menuclass .= '_'.$level;
			}
			if( !empty( $tempsfx ) ){
				$menuclass .= '_' . $params->get( 'class_sfx' );
			}
		}
		
		// replace & with amp; for xhtml compliance
		// remove slashes from excaped characters
		$mitem->name = stripslashes( $mitem->name ); //ampReplace
		
		$extratext = "";
		if( $params->get( 'use_mouseover' ) == 2  ){
			$extratext = " onmouseout=\"javascript: currentId = 0;\"";
		}
		$GLOBALS['sSBDRollMenudEBUG'][$mitem->id]['browsernav'] = $mitem->browserNav;
		
		switch ($mitem->browserNav) {
			// cases are slightly different
			case 1:
				// open in a new window
				$txt = '<a href="'. $mitem->link .'" target="_blank" class="'. $menuclass .'" '. $id .' ' . $extratext . '>';
				$txt .= findMenuImage( $mitem, $level, $params );
				$txt .= '</a>';
				$GLOBALS['sSBDRollMenudEBUG'][$mitem->id]['findMenuImage'] = findMenuImage( $mitem, $level, $params );
				break;
			case 2:
				// open in a popup window
				$txt = "<a href=\"#\" onclick=\"javascript: window.open('". $mitem->link ."', '', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550'); return false\" class=\"$menuclass\" ". $id ." " . $extratext . ">";
				$txt .= findMenuImage( $mitem, $level, $params );
				$GLOBALS['sSBDRollMenudEBUG'][$mitem->id]['findMenuImage'] = findMenuImage( $mitem, $level, $params );
				$txt .= "</a>";
				break;
			case 3:
				// don't link it
				$txt = '<span class="'. $menuclass .'" '. $id .'>';
				$txt .= findMenuImage( $mitem, $level, $params );
				$GLOBALS['sSBDRollMenudEBUG'][$mitem->id]['findMenuImage'] = findMenuImage( $mitem, $level, $params );
				$txt .= '</span>';
				break;
			default:
				// open in parent window
				$txt = '<a ';
				if( $params->get( 'use_mouseover' ) == 1  ){
					$txt .= "onclick=\"javascript: window.location='" . $mitem->link . "'\" ";
				}
				$txt .= 'href="' . $mitem->link .'" class="'. $menuclass .'" '. $id .' ' . $extratext . '>';
				$txt .= findMenuImage( $mitem, $level, $params );
				$GLOBALS['sSBDRollMenudEBUG'][$mitem->id]['findMenuImage'] = findMenuImage( $mitem, $level, $params );
				$txt .= '</a>';
				break;
		}
		
		if( $params->get('mouseoverver') == 1 /*|| $params->get('mouseoverver') == 2 */ ){
			switch( $level ){
				case 0:
					$txt = $mitem->name;
					break;
				default:
					break;
			}
		}
		
		$mitem->urldone = 1;
		
		if( $params->get('mouseoverver') == 1 /*|| $params->get('mouseoverver') == 2*/ ){
			switch( $url ){
				case 0:
					break;
				case 1:
					$txt = $mitem->link;
					break;
			}
		}else{
			if( $url && $txt == '' ){
				$txt = $mitem->name;
			}
			if( $url == 1 ){
				$txt = $mitem->link;
			}
		}
		
		$GLOBALS['sSBDRollMenudEBUG'][$mitem->id]['txt'] = $txt;
		$GLOBALS['sSBDRollMenudEBUG'][$mitem->id]['isActive'] = $isActive;
		$tempArray = array($txt,$isActive,$activeparent_roll_menu);
		return $tempArray;
		//return $txt;
	}

	/**
	* Vertically Indented Menu
	*/
	function sbdrollShowMenu(  &$params ) {
		global $database, $my, $cur_template, $Itemid;
		global $mosConfig_absolute_path, $mosConfig_shownoauth;
		$livePath = JURI::base(false) . '';
		/* If a user has signed in, get their user type */
		$intUserType = 0;
		if($my->gid){
			switch ($my->usertype) {
				case 'Super Administrator':
				$intUserType = 0;
				break;
				
				case 'Administrator':
				$intUserType = 1;
				break;
				
				case 'Editor':
				$intUserType = 2;
				break;
				
				case 'Registered':
				$intUserType = 3;
				break;
				
				case 'Author':
				$intUserType = 4;
				break;
				
				case 'Publisher':
				$intUserType = 5;
				
				break;
				
				case 'Manager':
				$intUserType = 6;
				break;
			}
		} else {
			/* user isn't logged in so make their usertype 0 */
			$intUserType = 0;
		}
		
		$menu = & JSite::getMenu();
		$user = & JFactory::getUser();
		$rows = $menu->getItems('menutype', $params->get('menutype'));
		
		// first pass - collect children
		$cacheIndex = array();
		$listItemIds = "";
		if(is_array($rows) && count($rows)) {
			foreach ($rows as $index => $v) {
				if ($v->access <= $user->get('aid')) {
					$listItemIds .= $v->id . ",";
					$pt = $v->parent;
					$list = @ $children[$pt] ? $children[$pt] : array ();
					array_push($list, $v);
					$children[$pt] = $list;
				}
				$cacheIndex[$v->id] = $index;
				
			}
		}
		// second pass - collect 'open' menus
		$open = array (
		$Itemid
		);
		$count = 20; // maximum levels - to prevent runaway loop
		$id = $Itemid;
		while (-- $count){
			if (isset($cacheIndex[$id])) {
					$index = $cacheIndex[$id];
					if (isset ($rows[$index]) && $rows[$index]->parent > 0) {
						$id = $rows[$index]->parent;
						$open[] = $id;
					} else {
						break;
				}
			}
		}
		//echo "<pre>";
		//print_r( $children );
		//echo "</pre>";
		$allowMenu = false;
		
		//Check if Itemid is in the list of menu items
		$pos = strpos( $listItemIds, trim( $Itemid ) ); 
		if( $pos === false  ){
			//echo $Itemid . "<br/>"; 
		}else{
			if( $params->get( 'openparentmenu' ) == 1 && !defined('_SBD_ROLLMENU_OPEN') ){
				echo "<script type=\"text/javascript\">";
				echo	"runOver( 'sbd" . end( $open ) . "' );";
				//echo "alert( 'b sbd" . end( $open ) . " " . $params->get('menutype') . "');";
				echo "</script>";
				//define('_SBD_ROLLMENU_OPEN',1);
			}
		}
		//echo $listItemIds . "<br/>";
		echo "<dl class=\"accordion-menu\"";
		echo ">";
		sbdrollRecurseMenu( 0, 0, $children, $open, $indents, $params, 0 );
		echo "<dt class=\"a-m-t sbdhidden\" >&nbsp;</dt>";	
		echo "<dd class=\"a-m-d\"><div class=\"bd\"><dl class=\"rollmenu_0\"><dd>&nbsp;</dd></dl></div></dd>";
		echo "</dl>";
	}

	/**
	* Utility function to recursively work through a vertically indented
	* hierarchial menu
	*/
	function sbdrollRecurseMenu( $id, $level, &$children, &$open, &$indents, &$params, $previousLevel ) {
		global $Itemid;
		$menuCount = 0;
		$lastItemId = 0;
		if (@$children[$id]) {
			$n = min( $level, count( $indents )-1 );
			foreach ($children[$id] as $row) {
				// Find if this menu Itemid needs to be hidden
				$menusToIgnore = hideMenu( $row->id, $params->get('ignoreid') );
				$GLOBALS['sSBDRollMenudEBUG'][$row->id]['rowname'] = $row->name;
				$tempArray = array();
				$tempArray = sbdrollGetMenuLink( $row, $level, $params, $open );
				$link = $tempArray[0];
				$isActive = $tempArray[1];
				//$link = sbdrollGetMenuLink( $row, $level, $params, $open );
				$GLOBALS['sSBDRollMenudEBUG'][$row->id]['retlink'] = $link;
				if( $level == 0 ){
					echo "<dt class=\"";
					if( ( isset( $children[$row->id] ) && is_array( $children[$row->id] ) && !$menusToIgnore ) || $params->get( 'noextramenu' ) == 0 ){
						echo "a-m-t";
					}else{
						echo "a-m-t-n";
					}
					if( $row->id == $Itemid ){
						echo " active_top_menu";	
					}
					$activeparent_roll_menu = $tempArray[2];
					if( $activeparent_roll_menu == 1 ){
						echo " top_menu_active";
					}
					echo "\" id=\"sbd".$row->id;					
					echo "\" ";
					
					if( ( $params->get( 'use_mouseover' ) == 1 || $params->get('top_linkclick' ) == 1 ) && isset( $children[$row->id] ) && is_array( $children[$row->id] ) ){
						if( !$menusToIgnore ){
							echo "onmouseover=\"javascript:void( runOver( 'sbd" . $row->id . "' ) );\"";
						}
					}
					if( ( $params->get( 'use_mouseover' ) == 1 || $params->get('top_linkclick' ) == 1 ) && ( $params->get('mouseoverver') == 1 /*|| $params->get('mouseoverver') == 2*/ ) ){
						$tempArray = sbdrollGetMenuLink( $row, $level, $params, $open, 1 );
						$url = $tempArray[0];
						//$url = sbdrollGetMenuLink( $row, $level, $params, $open, 1 );
						$GLOBALS['sSBDRollMenudEBUG'][$row->id]['returl'] = $url;
						$livePath = JURI::base(false) . '';
						$siteURL = $livePath . "/";
						$action = "";
						switch( $row->browserNav ){
							case 1:
								$action = "window.open('". $url ."', '', '')";
								break;
							case 2:
								$action = "window.open('". $url ."', '', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550')";
								break;
							case 3:
								$action = "";
								break;
							default:
								$action = "window.location = '" . $url . "'";
								break;
						}
						if( !empty( $action ) ){
							echo " onclick=\"javascript:void( $action );\"";
						}
					}
					if( $params->get('mouseoverver') == 2 ){
						echo " onmouseout=\"javascript: currentId = 0;\"";
					}
					if( $params->get('top_linkclick' ) == 0 && !isset( $children[$row->id] ) && $params->get( 'noextramenu' ) == 1 ){
						$tempArray = sbdrollGetMenuLink( $row, $level, $params, $open, 1 );
						$url = $tempArray[0];
						//$url = sbdrollGetMenuLink( $row, $level, $params, $open, 1 );
						$GLOBALS['sSBDRollMenudEBUG'][$row->id]['returl'] = $url;
						$livePath = JURI::base(false) . '';
						$siteURL = $livePath . "/";
						$action = "";
						switch( $row->browserNav ){
							case 1:
								$action = "window.open('$url', '', '')";
								break;
							case 2:
								$action = "window.open('$url', '', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550')";
								break;
							case 3:
								$action = "";
								break;
							default:
								$action = "window.location = '$url'";
								break;
						}
						if( !empty( $action ) ){
							echo " onclick=\"javascript:void( $action  );\"";
						}
					}
					
					if( $params->get( 'use_mouseover' ) == 0 && $params->get('top_linkclick' ) == 0 && isset( $children[$row->id] ) && is_array( $children[$row->id] ) ){
						if( !$menusToIgnore ){
							echo "onclick=\"javascript:void( runOver( 'sbd" . $row->id . "' ) );\"";
						}
					}
					if( $params->get( 'use_mouseover' ) == 0 && $params->get('top_linkclick' ) == 0 && !isset( $children[$row->id] ) && !is_array( $children[$row->id] ) && $params->get( 'noextramenu' ) == 0  ){
						if( !$menusToIgnore ){
							echo "onclick=\"javascript:void( runOver( 'sbd" . $row->id . "' ) );\"";
						}
					}
					echo ">";
					$showDiv = 1;
					
					if( $params->get( 'use_mouseover' ) == 1 || $params->get('top_linkclick' ) == 1 ){
						echo $link;
						echo "</dt>";
					}else{
						if( isset( $children[$row->id] ) && is_array( $children[$row->id] ) ){
						}else{
							$showDiv = 0;
						}
						echo $row->name;
						$GLOBALS['sSBDRollMenudEBUG'][$row->id]['dtname'] = $row->name;
						echo "</dt>";
					}
					if( ( isset( $children[$row->id] ) && is_array( $children[$row->id] ) && !$menusToIgnore ) || $params->get( 'noextramenu' ) == 0  ){
						echo '<dd class="a-m-d sbdItemId'.$row->id.'"';
						if( $params->get('use_mouseout') == 1 ){
							echo "onmouseout=\"javascript:void( runOut( 'sbdhidden' ) );\"";
						}						
						echo '><div class="bd"><dl class="rollmenu';
						if( $params->get( 'menulevel_sfx' ) ){
							echo '_'.$row->id;
						}
						if( $params->get( 'level_sfx' ) ){
							echo '_'.$level;
						}
						echo $params->get( 'class_sfx' ).'">';
						if( $params->get( 'noextramenu' ) == 0 && $row->link != '#' && $row->link != '/' && !empty( $row->link) && $row->link != '' ){
							echo '<dd class="active_submenu">' . $link . '</dd>';
						}
					}
				}else{
					$tempArray = sbdrollGetMenuLink( $row, $level, $params, $open, 1 );
					$url = trim( str_replace( "&sdvDebug=1", "", substr( $tempArray[0], -( strlen( $tempArray[0] ) - 1) ) ) );
					//$url = $tempArray[0];
					$livePath = JURI::base(false) . '';
					$url = $livePath . $url;
					$GLOBALS['sSBDRollMenudEBUG'][$row->id]['use_url'] = $url;
					$GLOBALS['sSBDRollMenudEBUG'][$row->id]['use_curPageUrl'] = trim( str_replace( "&sdbDebug=1","",curPageURL() ) );
					if( trim( str_replace( "&", "&amp;", str_replace( "&sdbDebug=1","",curPageURL() ) ) ) == trim( $url ) ){
						$GLOBALS['sSBDRollMenudEBUG'][$row->id]['use_match'] = "yes";
					}else{
						$GLOBALS['sSBDRollMenudEBUG'][$row->id]['use_match'] = "no";
					}
					echo "<dd ";
					// 					if( $params->get('use_mouseout') == 1 ){
					// 						echo "onmouseout=\"javascript:void( runOut( 'sbdhidden' ) );\"";
					// 					}
					
					if( trim( str_replace( "&", "&amp;", str_replace( "&sdbDebug=1","",curPageURL() ) ) ) == trim( $url ) ){
						echo "class=\"sbd_is_active_item_dd\"";
					}
					echo ">" . $link . "</dd>";
					if( isset( $children[$row->id] ) && is_array( $children[$row->id] ) ){
						echo '<dd " ';
						// 						if( $params->get('use_mouseout') ){
						// 							echo 'onmouseout="javascript:void( runOut( \'sbdhidden\' ) );"';
						// 						}
						echo '><dl class="rollmenu';
						if( $params->get( 'menulevel_sfx' ) ){
							echo '_'.$row->id;
						}
						if( $params->get( 'level_sfx' ) ){
							echo '_'.$level;
						}
						echo $params->get( 'class_sfx' );
						if( $isActive == 1 ){
							echo ' sbd_is_active_item_dd';
						}
						echo '">';
					}
				}
				// Check if menus are to have submenus hidden
				if( !$menusToIgnore ){
				sbdrollRecurseMenu( $row->id, $level+1, $children, $open, $indents, $params, $row->id );
				}
				if( $level == 0 ){
					$menuCount++;
					$lastItemId = $row->id;
					if( ( $params->get( 'use_mouseover' ) == 0 || $params->get('top_linkclick' ) == 0 ) && isset( $children[$row->id] ) && is_array( $children[$row->id] ) && !$showDiv ){
						echo "</dl>";
					}
					if( ( isset( $children[$row->id] ) && is_array( $children[$row->id] ) && !$menusToIgnore ) || $params->get( 'noextramenu' ) == 0  ){
						echo '</dl></div></dd>';
					}
				}elseif( isset( $children[$row->id] ) && $children[$row->id] && !$menusToIgnore ){
					echo "</dl></dd>";
				}
			}
			if( $menuCount == 1 && $params->get('opensinglemenu') == 1 ){
				echo "<script type=\"text/javascript\">";
				echo "AccordionMenu.openDtById('sbd" . $lastItemId . "');";
				echo "alert( 'a sbd" . $lastItemId . "' );";
				echo "</script>";
			}
		}
	}
}
$params->def('menutype', 			'mainmenu');
$params->def('class_sfx', 			'');
$params->def('time_delay', 		1500);
$params->def('menu_delay', 		10);
$params->def('use_mouseover',	1);
$params->def('top_linkclick', 1);
$params->def('noextramenu', 0 );
$params->def('openparentmenu', 1 );
$params->def('usecompressedjs', 1 );
$params->def('attemptvalidation', 0 );
$params->def('opensinglemenu', 1 );
$params->def('joomlaver', 0);
$params->def('hidemenunoscript', 0 );
$params->def('noscriptmsg', 'Menu requires javascript' );
$params->def('mouseoverver', 0 );
$params->def('useimage', 0 );
$params->def('imagelevels', '' );
$params->def('imagepath', 'images/stories' );
$params->def('imageext', 'png' );
$params->def('ignoreid', '' );
$params->def('use_mouseout', 0);



$GLOBALS['sSBDRollMenu'] = true;
$GLOBALS['sSBDRollMenudEBUG'][0]['version'] = "1.5";
$GLOBALS['sSBDRollMenudEBUG'][0]['menutype'] = $params->get('menutype');
$GLOBALS['sSBDRollMenudEBUG'][0]['class_sfx'] = $params->get('class_sfx');
$GLOBALS['sSBDRollMenudEBUG'][0]['time_delay'] = $params->get('time_delay');
$GLOBALS['sSBDRollMenudEBUG'][0]['menu_delay'] = $params->get('menu_delay');
$GLOBALS['sSBDRollMenudEBUG'][0]['use_mouseover'] = $params->get('use_mouseover');
$GLOBALS['sSBDRollMenudEBUG'][0]['top_linkclick'] = $params->get('top_linkclick');
$GLOBALS['sSBDRollMenudEBUG'][0]['noextramenu'] = $params->get('noextramenu');
$GLOBALS['sSBDRollMenudEBUG'][0]['openparentmenu'] = $params->get('openparentmenu');
$GLOBALS['sSBDRollMenudEBUG'][0]['usecompressedjs'] = $params->get('usecompressedjs');
$GLOBALS['sSBDRollMenudEBUG'][0]['attemptvalidation'] = $params->get('attemptvalidation' );
$GLOBALS['sSBDRollMenudEBUG'][0]['opensinglemenu'] = $params->get('opensinglemenu');
$GLOBALS['sSBDRollMenudEBUG'][0]['joomlaver'] = $params->get('joomlaver');
$GLOBALS['sSBDRollMenudEBUG'][0]['hidemenunoscript'] = $params->get('hidemenunoscript');
$GLOBALS['sSBDRollMenudEBUG'][0]['noscriptmsg'] = $params->get('noscriptmsg');
$GLOBALS['sSBDRollMenudEBUG'][0]['originalmouseover'] = $params->get('mouseoverver');
$GLOBALS['sSBDRollMenudEBUG'][0]['ignoreid'] = $params->get('ignoreid');
$GLOBALS['sSBDRollMenudEBUG'][0]['use_mouseout'] = $params->get('use_mouseout');

sbdrollShowMenu( $params );

if( isset($_GET['sdbDebug']) && $_GET['sdbDebug'] == 1 ){
	//  $user = & JFactory::getUser();
	echo "<pre>";
	print_r( $GLOBALS['sSBDRollMenudEBUG'] );
	//	print_r( $user );
	echo "</pre>";
	echo "article ID: " . JRequest::getCmd('id', 'default');
	//sbdrollFindParent( $params, JRequest::getCmd('id', 'default') );
}
if( $params->get('hidemenunoscript') == 1 ){
	?>
	<noscript>
	<style type="text/css">
	dl.accordion-menu {
	display: none;
	}
	</style>
	<?php echo $params->get("noscriptmsg"); ?>
	</noscript>
	<?php 
}  
?>
