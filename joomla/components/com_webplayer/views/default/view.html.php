<?php

/*
 * @version		$Id: view.html.php 1.3 2011-06-13 $
 * @package		Joomla
 * @subpackage	hdwebplayer
 * @copyright   Copyright (C) 2011-2012 HD Webplayer
 * @license     GNU/GPL http://www.gnu.org/licenses/gpl-2.0.html
*/

// no direct access 
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.view');

class WebplayerViewDefault extends JView {

	function display($tpl = null) {
		$model 	   = $this->getModel();
		
		$player    = $model->player();
		$this->assignRef('player', $player);
		
		$googleads = $model->googleads();
		$this->assignRef('googleads', $googleads);
				
        parent::display($tpl);
    }
	
}

?>