<?php
/**
 * The RockSolid Theme for DOCman
 * @version $Id: list_item.tpl.php $
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
* Display a documents list item (called by document/list.tpl.php)
*
* This template is called when a user performs browse the docman
*
* General variables  :
*	$this->theme->path (string) : template path
* 	$this->theme->name (string) : template name
* 	$this->theme->conf (object) : template configuartion parameters
*	$this->theme->icon (string) : template icon path
*   $this->theme->png  (boolean): browser png transparency support

* Template variables :
*   $this->doc->data  (object) : holds the document data
*   $this->doc->links (object) : holds the document operations
*   $this->doc->paths (object) : holds the document paths
**/
?>

<li class="main">

<div>

<?php 

//output document image
switch($this->theme->conf->doc_image) :
 	case 0 : //none
		//do nothing
	break;

 	case 1 :   //icon
        if(isset($this->doc->buttons['download'])) {
            ?><div class="rs-thumb"><a class="dm-icon" href="<?php echo $this->doc->buttons['download']->link;?>"><?php
        } else {
            ?><div class="rs-thumb"><a class="dm-icon"><?php
        }
		?>
		<img src="<?php echo $this->doc->paths->icon;?>" alt="file icon" />
		</a></div>
		<?php
	break;

 	case 2  :  //thumb
 		if($this->doc->data->dmthumbnail) {
            if(isset($this->doc->buttons['download'])) {
                ?><div class="rs-thumb"><a class="dm-thumb" href="<?php echo $this->doc->buttons['download']->link;?>"><?php
            } else {
                ?><div class="rs-thumb"><a class="dm-thumb"><?php
            }
    		?>
            	<img src="<?php echo $this->doc->paths->thumb; ?>" alt="<?php echo $this->doc->data->dmname ?>" />
    		</a></div>
     		<?php
        }
 	break;
endswitch;

//output document link
	if(isset($this->doc->buttons['download'])) :
	?><div class="rs-details"><h3><a class="dm-name" href="<?php echo $this->doc->buttons['download']->link;?>"><?php
	else :
	?><div class="rs-details"><h3><a class="dm-name"><?php
	endif;
		echo $this->doc->data->dmname;

?>
</a>
<?php
//need to replace static text with language variables - SC
//include tooltip
 	if($this->theme->conf->item_tooltip) :
 		$this->item = &$this->doc;
 		$tooltip = $this->fetch('documents/tooltip.tpl.php');
 		$icon    = $this->theme->path."images/icons/16x16/tooltip.png";
 		$this->plugin('tooltip', $this->doc->data->id, '', $tooltip, $icon);
 	endif;
?>
</h3>
<br />
<?php
/*
	if(!$this->doc->data->approved) :
		?><span class="dm-unapproved">Unapproved</span><?php
	endif;
	if(!$this->doc->data->published) :
		?><span class="dm-unpublished">Unpublished</span><?php
	endif;
	if($this->doc->data->checked_out) :
		?><span class="dm-checked_out">Checked Out</span><?php
	endif;
	*/
?>

<dl class="rs-props">

<?php
//output document date
if ( $this->theme->conf->item_date ) :
    ?>
       <dt class="rs-uploaded_date"><?php echo _DML_TPL_DATEADDED;?>:</dt>
       <dd class="rs-uploaded_date"><?php $this->plugin('dateformat', $this->doc->data->dmdate_published, _DML_TPL_DATEFORMAT_SHORT); ?></dd>
    <?php
endif;


//output document counter
if ( $this->theme->conf->item_hits  ) :
    ?>
	<dt class="rs-dl_count"><?php echo _DML_TPL_HITS;?>:</dt> 
	<dd class="rs-dl_count"><?php echo $this->doc->data->dmcounter;?></dd>
    <?php
endif;
?>

</dl>


<?php
//output document description
if ( $this->theme->conf->item_description AND $this->doc->data->dmdescription ) :
	?>
	<div class="rs-desc">
		<?php echo $this->doc->data->dmdescription;?>
	</div>
	<?php
endif;

//output document url
if ( $this->theme->conf->item_homepage && $this->doc->data->dmurl != '') :
	?>
 	<div class="dm-homepage">
		<?php echo _DML_TPL_HOMEPAGE;?>: <a href="<?php echo $this->doc->data->dmurl; ?>"><?php echo $this->doc->data->dmurl; ?></a>
	</div>
	<?php
endif;

?>


<?php
if($this->doc->data->new) :
	?><div class="rs-status"><span class="rs-new"><?php /* echo $this->doc->data->new */ ?></span></div><?php
endif;
if($this->doc->data->hot) :
	?><div class="rs-status"><span class="rs-hot"><?php /* echo $this->doc->data->hot */ ?></span></div><?php
endif; ?>


<div class="dm-taskbar" style="clear:both;">
	<?php include $this->loadTemplate('documents/tasks.tpl.php'); ?>

</div>


<div class="clr"></div>
</div>
</div>
</li>

<div>
<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style " style="background:#FFFFFF; border-left:1px  solid #6A9016; border-right:1px solid #6A9016 ;padding-left:100px; padding-bottom:5px;">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
<a class="addthis_counter addthis_bubble_style"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4e02ce9946ec48ae"></script>

<!-- AddThis Button END -->
</div>
<div  style="background:#6A9016; width:100%; height:20px;">
	
</div>

