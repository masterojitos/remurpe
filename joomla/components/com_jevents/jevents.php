<?php
/**
 * JEvents Component for Joomla 1.5.x
 *
 * @version     $Id: jevents.php 1543 2009-08-14 07:45:29Z geraint $
 * @package     JEvents
 * @copyright   Copyright (C) 2008-2009 GWE Systems Ltd
 * @license     GNU/GPLv2, see http://www.gnu.org/licenses/gpl-2.0.html
 * @link        http://www.jevents.net
 */

defined( 'JPATH_BASE' ) or die( 'Direct Access to this location is not allowed.' );

jimport('joomla.filesystem.path');

// For development performance testing only
/*
$db	=& JFactory::getDBO();
$db->setQuery("SET SESSION query_cache_type = OFF");
$db->query();

$cfg = & JEVConfig::getInstance();
$cfg->set('jev_debug', 1);
*/

include_once(JPATH_COMPONENT.DS."jevents.defines.php");

// Must also load backend language files
$lang =& JFactory::getLanguage();
$lang->load(JEV_COM_COMPONENT, JPATH_ADMINISTRATOR);

// disable Zend php4 compatability mode
@ini_set("zend.ze1_compatibility_mode","Off");

// Split task into command and task
$cmd = JRequest::getCmd('task', false);

if (!$cmd) {
	$view =	JRequest::getCmd('view', false);
	$layout = JRequest::getCmd('layout', "show");
	if ($view && $layout){
		$cmd = $view.'.'.$layout;
	}
	else $cmd = "month.calendar";
}

if (strpos($cmd, '.') != false) {
	// We have a defined controller/task pair -- lets split them out
	list($controllerName, $task) = explode('.', $cmd);

	// Define the controller name and path
	$controllerName	= strtolower($controllerName);
	$controllerPath	= JPATH_COMPONENT.DS.'controllers'.DS.$controllerName.'.php';
	//$controllerName = "Front".$controllerName;

	// If the controller file path exists, include it ... else lets die with a 500 error
	if (file_exists($controllerPath)) {
		require_once($controllerPath);
	} else {
		JError::raiseError(500, 'Invalid Controller '.$controllerName);
	}
} else {
	// Base controller, just set the task
	$controllerName = null;
	$task = $cmd;
}
// Make the task available later
JRequest::setVar("jevtask",$cmd);
JRequest::setVar("jevcmd",$cmd);

JPluginHelper::importPlugin("jevents");

// Make sure the view specific language file is loaded
JEV_CommonFunctions::loadJEventsViewLang();

// Set the name for the controller and instantiate it
$controllerClass = ucfirst($controllerName).'Controller';
if (class_exists($controllerClass)) {
	$controller = new $controllerClass();
} else {
	JError::raiseError(500, 'Invalid Controller Class - '.$controllerClass );
}


// create live bookmark if requested
$cfg = & JEVConfig::getInstance();
if ($cfg->get('com_rss_live_bookmarks')) {
	$rssmodid = $cfg->get('com_rss_modid', 0);
	// do not use JRoute since this creates .rss link which normal sef can't deal with
	$rssLink = 'index.php?option='.JEV_COM_COMPONENT.'&task=modlatest.rss&format=feed&type=rss&modid='.$rssmodid;
	$rssLink = JRoute::_($rssLink);
	$rss = '<link href="' .$rssLink .'"  rel="alternate"  type="application/rss+xml" title="JEvents - RSS 2.0 Feed" />'. "\n";
	$mainframe->addCustomHeadTag( $rss );

	$rssLink =  'index.php?option='.JEV_COM_COMPONENT.'&task=modlatest.rss&format=feed&type=atom&modid='.$rssmodid;
	$rssLink = JRoute::_($rssLink);
	$rss = '<link href="' .$rssLink .'"  rel="alternate"  type="application/rss+xml" title="JEvents - Atom Feed" />'. "\n";
	$mainframe->addCustomHeadTag( $rss );
}

// Add reference for constructor in registry - unfortunately there is no add by reference method
// we rely on php efficiency to not create a copy
$registry	=& JRegistry::getInstance("jevents");
$registry->setValue("jevents.controller",$controller);

// Perform the Request task
$controller->execute($task);

// Redirect if set by the controller
$controller->redirect();
