<?php
/**
 * The RockSolid Theme for DOCman
 * @version $Id: form_docedit.tpl.php $
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

/*
* Display the move document form (required)
*
* This template is called when a user performs a move operation on a document.
*
* General variables  :
*	$this->theme->path (string) : template path
*	$this->theme->name (string) : template name
*	$this->theme->conf (object) : template configuartion parameters
*	$this->theme->icon (string) : template icon
*   $this->theme->png  (boolean): browser png transparency support
*
*/
?>

onunload = WarnUser;
var folderimages = new Array;

function submitbutton(pressbutton)
{
	var form = document.adminForm;
	if (pressbutton == 'cancel') {
		submitform( pressbutton );
		return;
	}
	form.goodexit.value=1
	try {
		form.onsubmit();
	}
	catch(e){}

	msg = '';
	if (form.dmname.value == '') {
  		msg += '\n <?php echo _DML_ENTRY_NAME; ?>';
	} if (form.dmdate_published.value == '') {
     	msg += '\n <?php echo _DML_ENTRY_DATE; ?>';
	} if (form.dmfilename.value == '') {
     	msg += '\n<?php echo _DML_ENTRY_DOC; ?>' ;
	} if (form.catid.value == '0') {
     	msg += '\n <?php echo _DML_ENTRY_CAT; ?>' ;
	} if (form.dmowner.value == '<?php echo _DM_PERMIT_NOOWNER; ?>' || form.dmowner.value == '' ) {
     	msg += '\n <?php echo _DML_ENTRY_OWNER; ?>' ;
	} if (form.dmmantainedby.value == '<?php echo _DM_PERMIT_NOOWNER; ?>' || form.dmmantainedby.value == '' ) {
     	msg += '\n <?php echo _DML_ENTRY_MAINT; ?>' ;
	} if( form.document_url ){
		if( form.document_url.value != '' ){
			if( form.dmfilename.value != '<?php echo _DM_DOCUMENT_LINK; ?>'){
				if( form.dmfilename.value != '' ){
					msg += "\n<?php echo _DML_ENTRY_DOCLINK; ?>";
				}
			}
		}
	}

	if ( msg != '' ){
		msghdr = '<?php echo _DML_ENTRY_ERRORS; ?>';
		msghdr += '\n=================================';
		alert( msghdr + msg + '\n' );
	} else {
		/* for static content */
		<?php getEditorContents('editor1', 'dmdescription'); ?>
		submitform(pressbutton);
	}
}

function setgood() {
	document.adminForm.goodexit.value=1;
}

function WarnUser() {

}
<?php die(); ?>