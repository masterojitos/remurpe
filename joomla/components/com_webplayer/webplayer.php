<?php

/*
 * @version		$Id: webplayer.php 1.3 2011-06-13 $
 * @package		Joomla
 * @subpackage	hdwebplayer
 * @copyright   Copyright (C) 2011-2012 HD Webplayer
 * @license     GNU/GPL http://www.gnu.org/licenses/gpl-2.0.html
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

// Define constants for all pages
define( 'COM_WEBPLAYER_BASEURL', JURI::root().'index.php?option=com_webplayer');

// Require the base controller
require_once JPATH_COMPONENT.DS.'controller.php';

// Initialize the controller
$controller = new WebplayerController( );

// Perform the Request task
$controller->execute( JRequest::getCmd('view'));
$controller->redirect();

?>