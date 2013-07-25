<?php
/**
 * The RockSolid Theme for DOCman
 * @version $Id: tooltip.tpl.php $
 * @package RockSolidDOCmanTheme
 * @copyright (C) 2009 JoomlaFare.com
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://joomlafare.com/
 * 
 * The RockSolid Theme for DOCman is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or is derivative of works
 * licensed under the GNU General Public License or other free or open source software licenses.
 * The RockSolid Theme for DOCman is based on the Default DOCman Theme (copyright JoomlaTools)
 * and RokDownloads (copyright RocketWerx) and is offered without any warranty, expressed or implied.
 **/

defined('_VALID_MOS') or die('Restricted access');

/**
* Display document details (called by document/list_item.tpl.php)
*
* General variables  :
*	$this->theme->path (string) : template path
* 	$this->theme->name (string) : template name
* 	$this->theme->conf (object) : template configuartion parameters
*	$this->theme->icon (string) : template icon path
*   $this->theme->png  (boolean): browser png transparency support
*
* Template variables :
*  $this->doc->data	 (object) : holds the document data
*  $this->doc->links (object) : holds the document operations
*  $this->doc->paths (object) : holds the document paths
**/

if($this->theme->conf->details_filename)
{
	echo $this->doc->data->filename;
}

if($this->theme->conf->details_filesize)
{
    echo ' ('.$this->doc->data->filesize.') ';
}

if($this->theme->conf->details_filetype)
{
    echo $this->doc->data->mime;
}