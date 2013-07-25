<?php
/*
* Author: Nurte
* @package www.nurte.pl Nurte Facebook Like Box
* @copyright Copyright (C) 2010 Nurte sp. z o.o. All rights reserved.
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
* Version 1.0.0.0
*/
defined( '_JEXEC' ) or die( 'Restricted access' );
$nurte_fb_likebox = nurte_fb_likebox( $params );
echo $nurte_fb_likebox;

function nurte_fb_likebox( $params )   {
	$language	= &JFactory::getLanguage();
	$language	= str_replace("-","_",$language->get('tag'));  
	$fb_likebox    = " <div id=\"fb-root\"></div> <script> window.fbAsyncInit = function() { FB.init({appId  : \"YOUR APP ID\", status : true, cookie : true, xfbml  : true }); };" 
			." (function() { var e = document.createElement(\"script\"); e.src = document.location.protocol + \"//connect.facebook.net/".$language."/all.js\";"
			." e.async = true; document.getElementById(\"fb-root\").appendChild(e); }()); </script>"
			."<fb:fan profile_id=\"".trim( $params->get('pageid') )."\""
			." width =\"".trim( $params->get('width') )."\"" 
			." height=\"".trim( $params->get('height') )."\""
			." connections =\"".trim( $params->get('connections') )."\""	 
			." stream =\"".trim( $params->get('stream') )."\"" 
			." logobar=\"".trim( $params->get('logobar') )."\""
			." css=\"".trim( $params->get('css') )."\"></fb:fan>";

	return $fb_likebox;
}
?>
