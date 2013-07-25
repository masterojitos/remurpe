<?php

/*
 * @version		$Id: controller.php 1.3 2011-06-13 $
 * @package		Joomla
 * @subpackage	hdwebplayer
 * @copyright   Copyright (C) 2011-2012 HD Webplayer
 * @license     GNU/GPL http://www.gnu.org/licenses/gpl-2.0.html
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');

class WebplayerController extends JController {

	function __construct() {
        if(JRequest::getCmd('view') == '') {
            JRequest::setVar('view', 'display');
        }
        $this->item_type = 'Default';
        parent::__construct();
    }
	
	function display() {
		$document = &JFactory::getDocument();
		$vType	  = $document->getType();
	    $view     = &$this->getView('default', $vType);
		
        $model    = &$this->getModel('default');
        $view->setModel($model, true);

		$view->display();
	}
	
	function config() {
        $model    = &$this->getModel('config');
        $model->getdatas();
	}
	
	function skin() {
		JRequest::checkToken( 'get' ) or die( 'Invalid Token' );
	
        $model    = &$this->getModel('skin');
        $model->getdatas();
	}
	
	function playlist() {
		JRequest::checkToken( 'get' ) or die( 'Invalid Token' );
	
        $model    = &$this->getModel('playlist');
        $model->getdatas();
	}
	
	function player() {
		$model    = &$this->getModel('player');
        $model->getplayer();
	}
	
	function email() {
		JRequest::checkToken( 'get' ) or die( 'Invalid Token' );
	
		$model    = &$this->getModel('email');
        $model->sendMail();
	}
	
	function views()
	{		
        $model = &$this->getModel('views');
        $model->addview();
	}
	
}

?>