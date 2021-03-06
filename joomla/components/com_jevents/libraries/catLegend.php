<?php
/**
 * JEvents Component for Joomla 1.5.x
 *
 * @version     $Id: catLegend.php 1400 2009-03-30 08:45:17Z geraint $
 * @package     JEvents
 * @copyright   Copyright (C) 2008-2009 GWE Systems Ltd, 2006-2008 JEvents Project Group
 * @license     GNU/GPLv2, see http://www.gnu.org/licenses/gpl-2.0.html
 * @link        http://www.jevents.net
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

class catLegend {
	function catLegend($id, $name, $color, $description,$parent_id=0)
	{
		$this->id=$id;
		$this->name=$name;
		$this->color=$color;
		$this->description=$description;
		$this->parent_id=$parent_id;
	}
}
