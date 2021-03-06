<?php
/**
 * JEvents Component for Joomla 1.5.x
 *
 * @version     $Id: abstract.php 1440 2009-05-11 08:22:54Z geraint $
 * @package     JEvents
 * @copyright   Copyright (C) 2008-2009 GWE Systems Ltd
 * @license     GNU/GPLv2, see http://www.gnu.org/licenses/gpl-2.0.html
 * @link        http://www.jevents.net
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

/**
 * HTML Abstract view class for the component frontend
 *
 * @static
 */
JLoader::register('JEventsDefaultView',JEV_VIEWS."/default/abstract/abstract.php");

class JEventsAlternativeView extends JEventsDefaultView 
{
	var $jevlayout = null;

	function __construct($config = null)
	{
		parent::__construct($config);

		$this->jevlayout="alternative";	

		$this->addHelperPath(dirname(__FILE__)."/../helpers/");
		global $mainframe;
		$this->addHelperPath( JPATH_BASE.DS.'templates'.DS.$mainframe->getTemplate().DS.'html'.DS.JEV_COM_COMPONENT.DS."helpers");

	}

	function viewNavTableBarIconic( $today_date, $this_date, $dates, $alts, $option, $task, $Itemid ){
		$this->loadHelper("AlternativeViewNavTableBarIconic");
		$var = new AlternativeViewNavTableBarIconic($this, $today_date, $this_date, $dates, $alts, $option, $task, $Itemid );
	}

	function buildMonthSelect($link, $month, $year){
		$this->loadHelper("AlternativeBuildMonthSelect");
		$var = new AlternativeBuildMonthSelect($this, $link, $month, $year );
		return $var->result;
	}
}
