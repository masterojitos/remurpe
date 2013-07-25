<?php
 /**
 *Facebook module FB LikeBox FanPage
 @package Module FB LikeBox FanPage Box for Joomla! 1.5
 * @link       http://joomla.webdesign.org.gr/
* @copyright (C) 2010- Giorgos Xilouris
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
 
// Include the syndicate functions only once
require_once( dirname(__FILE__).DS.'helper.php' );
$fanboxhtml = modfbfanpagelikeboxHelper::getfbfanpagelikebox( $params );
require( JModuleHelper::getLayoutPath( 'mod_fbfanpagelikebox' ) );
?>