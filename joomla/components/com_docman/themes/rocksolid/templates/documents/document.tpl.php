<?php
/**
 * The RockSolid Theme for DOCman
 * @version $Id: document.tpl.php $
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
* Display document details (required)
*
* General variables  :
*	$this->theme->path (string) : template path
* 	$this->theme->name (string) : template name
* 	$this->theme->conf (object) : template configuartion parameters
*	$this->theme->icon (string) : template icon path
*   $this->theme->png  (boolean): browser png transparency support
*
* Template variables :
*	$this->data		(object) : holds the document data
*   $this->links 	(object) : holds the document operations
*   $this->paths 	(object) : holds the document paths
**/

global $mainframe;
if(defined('_DM_J15')){
    $catname = mosDMCategory::getInstance($this->data->catid)->title;
    $catlink = 'index.php?option=com_docman&task=cat_view&gid='.$this->data->catid;
    
    $pathway = & $mainframe->getPathWay();
    $pathway->addItem( $catname, $catlink );
    $pathway->addItem($this->data->dmname);
} else {
    $mainframe->appendPathway( $this->data->dmname );
}
$mainframe->setPageTitle( _DML_TPL_TITLE_DETAILS . ' | ' . $this->data->dmname );

//As soon as this is working change the id below to dm-details and troubleshoot css - SC
?>
<div id="dm-details">
<?php
if ($this->data->dmthumbnail) :
	?><img src="<?php echo $this->paths->thumb ?>" alt="<?php echo $this->data->dmname;?>" /><?php
endif;
?>

<div class="dm-name"><h2><?php echo _DML_TPL_DETAILSFOR ?><em>&nbsp;<?php echo $this->data->dmname ?></em></h2></div>

<div id="rs-files">
<ul>
<li class="main">

<div>

<?php 

//output document link
	if(isset($this->buttons['download'])) :
	?><div class="rs-details"><h3><a class="dm-name" href="<?php echo $this->buttons['download']->link;?>"><?php
	else :
	?><div class="rs-details"><h3><a class="dm-name"><?php
	endif;
		echo $this->data->dmname;

?>
</a>

<?php
//need to add something to output status - SC
	if(!$this->data->approved) :
		?><span class="dm-unapproved">Unapproved</span><?php
	endif;
	if(!$this->data->published) :
		?><span class="dm-unpublished">Unpublished</span><?php
	endif;
	if($this->data->checked_out) :
		?><span class="dm-checked_out">Checked Out</span><?php
	endif;
?>
</h3>
<dl class="rs-props">

<?php
//output document date
if ( $this->theme->conf->item_date ) :
    ?>
       <dt><?php echo _DML_TPL_DATEADDED; ?>:</dt>
       <dd><?php $this->plugin('dateformat', $this->data->dmdate_published, _DML_TPL_DATEFORMAT_SHORT); ?></dd>
    <?php
endif;

//output document (title) name
if($this->theme->conf->details_name && $this->data->dmname != '') :
	?>
       <dt><?php echo _DML_TPL_NAME;?>:</dt>
       <dd><?php echo $this->data->dmname; ?></dd>
    <?php
endif;

//output file name
if($this->theme->conf->details_filename && $this->data->filename != '') :
	 ?>
       <dt><?php echo _DML_TPL_FNAME; ?>:</dt>
       <dd><?php echo $this->data->filename; ?></dd>
    <?php
endif;

//output file size
if($this->theme->conf->details_filesize && $this->data->filesize != '') :
	?>
       <dt><?php echo _DML_TPL_FSIZE ?>:</dt>
       <dd><?php echo $this->data->filesize; ?></dd>
    <?php
endif;

//output file type
if($this->theme->conf->details_filetype && $this->data->filetype != '') :
	?>
       <dt><?php echo _DML_TPL_FTYPE ?>:</dt>
       <dd><?php echo $this->data->filetype; ?>&nbsp;(<?php echo _DML_TPL_MIME.":&nbsp;".$this->data->mime ?>)</dd>
    <?php
endif;

//output submitted by
if($this->theme->conf->details_submitter && $this->data->submitted_by != '') :
	?>
       <dt><?php echo _DML_TPL_SUBBY; ?>:</dt>
       <dd><?php echo $this->data->submited_by ?></dd>
    <?php
endif;

//output created on
if($this->theme->conf->details_created && $this->data->dmdate_published != '') :
	?>
       <dt><?php echo _DML_TPL_SUBDT; ?>:</dt>
       <dd><?php  $this->plugin('dateformat', $this->data->dmdate_published , _DML_TPL_DATEFORMAT_LONG); ?></dd>
    <?php
endif;


if($this->theme->conf->details_readers && $this->data->owner != '') :
	?>
 		<dt><?php echo _DML_TPL_OWNER; ?>:</dt>
 		<dd><?php echo $this->data->owner; ?></dd>
	<?php
endif;
if($this->theme->conf->details_maintainers && $this->data->maintainedby != '') :
	?>
 		<dt><?php echo _DML_TPL_MAINT; ?>:</dt>
 		<dd><?php echo $this->data->maintainedby; ?></dd>
	<?php
endif;
if($this->theme->conf->details_downloads && $this->data->dmcounter != '') :
	?>
 		<dt><?php echo _DML_TPL_HITS; ?>:</dt>
 		<dd><?php echo $this->data->dmcounter."&nbsp;"._DML_TPL_HITS; ?></dd>
	<?php
endif;
if($this->theme->conf->details_updated && $this->data->dmlastupdateon != '') :
	?>
 		<dt><?php echo _DML_TPL_LASTUP; ?>:</dt>
 		<dd><?php  $this->plugin('dateformat', $this->data->dmlastupdateon , _DML_TPL_DATEFORMAT_LONG); ?></dd>
	<?php
endif;
if($this->theme->conf->details_homepage && $this->data->dmurl != '') :
	?>
 		<dt><?php echo _DML_TPL_HOME; ?>:</dt>
 		<dd><?php echo $this->data->dmurl; ?></dd>
	<?php
endif;
if($this->theme->conf->details_crc_checksum && $this->data->params->get('crc_checksum') != '') :
	?>
 		<dt><?php echo _DML_TPL_CRC_CHECKSUM; ?>:</dt>
 		<dd><?php echo $this->data->params->get('crc_checksum'); ?></dd>
	<?php
endif;
if($this->theme->conf->details_md5_checksum && $this->data->params->get('md5_checksum') != '') :
	?>
 		<dt><?php echo _DML_TPL_MD5_CHECKSUM; ?>:</dt>
 		<dd><?php echo $this->data->params->get('md5_checksum'); ?></dd>
	<?php
endif;

//output document counter
if ( $this->theme->conf->item_hits  ) :
    ?>
	<dt class="rs-dl_count"><?php echo _DML_TPL_HITS; ?>:</dt> 
	<dd class="rs-dl_count"><?php echo $this->data->dmcounter; ?></dd>
    <?php
endif;
?>

</dl>

<?php
//output document description output as a separate div from the other details
if($this->theme->conf->details_description && $this->data->dmdescription != '') :
	?>
	<div class="rs-desc">
		<?php echo $this->data->dmdescription; ?>
	</div>
	<?php
endif;

//output document url
if ( $this->theme->conf->item_homepage && $this->data->dmurl != '') :
	?>
 	<div class="dm-homepage">
		<?php echo _DML_TPL_HOMEPAGE;?>: <a href="<?php echo $this->doc->data->dmurl; ?>"><?php echo $this->doc->data->dmurl;?></a>
	</div>
	<?php
endif;

?>

<?php
if($this->doc->data->new) :
	?><div class="rs-status"><span class="rs-new"><?php /* echo $this->doc->data->new */; ?></span></div><?php
endif;
if($this->doc->data->hot) :
	?><div class="rs-status"><span class="rs-hot"><?php /* echo $this->doc->data->hot */; ?></span></div><?php
endif; ?>


<div class="dm-taskbar">

<?php
	unset($this->buttons['details']);
	$this->doc = &$this;
	include $this->loadTemplate('documents/tasks.tpl.php');
?>
<a class="rs-button" href="javascript: history.go(-1);"><?php echo _DML_TPL_BACK; ?></a>

</div>

<div class="clr"></div>
</div>
</div>
</li>
</ul>
</div>
</div>