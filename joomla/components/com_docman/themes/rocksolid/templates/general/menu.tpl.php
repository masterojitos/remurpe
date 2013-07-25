<?php
/**
 * The RockSolid Theme for DOCman
 * @version $Id: menu.tpl.php $
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
* Display the menu (required)
*
* General variables  :
*	$this->theme->path (string) : template path
* 	$this->theme->name (string) : template name
* 	$this->theme->conf (object) : template configuartion parameters
*	$this->theme->icon (string) : template icon path
*   $this->theme->png  (boolean): browser png transparency support
*
* Template variables :
*	$this->links (object) : holds the different menu links
*   $this->perms (number) : upload user permissions
**/

if( !$this->theme->conf->menu_home
    AND !$this->theme->conf->menu_search
    AND !$this->theme->conf->menu_upload
    AND $this->perms->upload != DM_TPL_AUTHORIZED) {
        // No buttons to show
    	return;
    }
?>

<div id="dm-header">
<?php
if($this->theme->conf->menu_home) :
	?>
	<div>
		<a href="<?php echo $this->links->home; ?>">
			<img src="<?php echo $this->theme->icon;?>home.png" alt="<?php echo _DML_TPL_CAT_VIEW; ?>" /><br />
			<?php echo _DML_TPL_CAT_VIEW;?>
		</a>
	</div>
	<?php
endif;
if($this->theme->conf->menu_search) :
	?>
	<div>
		<a href="<?php echo $this->links->search; ?>">
			<img src="<?php echo $this->theme->icon;?>search.png" alt="<?php echo _DML_TPL_SEARCH_DOC; ?>" /><br />
			<?php echo _DML_TPL_SEARCH_DOC; ?>
		</a>
	</div>
	<?php
endif;
	/*
	 * Check to upload permissions and show the appropriate icon/text
	 * Values for $this->perms->upload
	 *		- DM_TPL_AUTHORIZED 	: the user is authorized to upload
	 *		- DM_TPL_NOT_LOGGED_IN  : the user isn't logged in
	 *		- DM_TPL_NOT_AUTHORIZED : the user isn't authorized to upload
	*/
if($this->theme->conf->menu_upload) :
	switch($this->perms->upload) :
		case DM_TPL_AUTHORIZED :
		?>
		<div>
			<a href="<?php echo $this->links->upload; ?>">
				<img src="<?php echo $this->theme->icon;?>submit.png" alt="<?php echo _DML_TPL_SUBMIT; ?>" /><br />
				<?php echo _DML_TPL_SUBMIT; ?>
			</a>
		</div>
		<?php break;
	endswitch;
endif;
	?>
</div>

<div class="clr"></div>