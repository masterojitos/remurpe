<?php 

/*
 * @version		$Id: embed.php 1.3 2011-06-13 $
 * @package		Joomla
 * @subpackage	hdwebplayer
 * @copyright   Copyright (C) 2011-2012 HD Webplayer
 * @license     GNU/GPL http://www.gnu.org/licenses/gpl-2.0.html
*/

defined('_JEXEC') or die('Restricted access'); 

require_once JPATH_ROOT.DS.'components'.DS.'com_webplayer'.DS.'models'.DS.'html5.php';

srand ((double) microtime( )*1000000);
$dyn      = rand( );
$contents = '';
$htmlNode = '';
$html5Obj = array();

if(JRequest::getCmd('wid')) {
	$id = JRequest::getCmd('wid');
} else {
	$id = '';
}

if($video == '') {
	$html5     = new WebplayerModelHtml5();
	$html5Obj  = $html5->getvideo($id, $category);
	$video     = $html5Obj[0]->video;
} else {
	$html5Obj[0]->type = '';
	$html5Obj[0]->ext  = end(explode(".", $video));
}

if($video == '') {
	$key = 'category';
	$flashvars = preg_replace('/(.*)(\?|&)' . $key . '=[^&]+?(&)(.*)/i', '$1$2$4', $flashvars . '&'); 
	$flashvars = substr($flashvars, 0, -1); 
}

switch($html5Obj[0]->type) {
	case 'Youtube Videos' :
	    $htmlNode  = '<iframe title="YouTube video player" width="'.$width.'" height="'.$height.'" src="'.$video.'" frameborder="0" allowfullscreen></iframe>';
		break;
	case 'Dailymotion Videos':
	 	$htmlNode  = '<iframe frameborder="0" width="'.$width.'" height="'.$height.'" src="'.$video.'"></iframe>';
		break;
	default :
	    if($html5Obj[0]->ext == 'mp4') {
	    	$htmlNode  = '<video width="'.$width.'" height="'.$height.'" controls>';
  	    	$htmlNode .= '<source src="'.$video.'" type="video/mp4" />';
			$htmlNode .= '</video>';
		}		
}

if($ad == 1) {
	$cont    = "ad_container_".$dyn;
	$overlay = "ad_overlay_".$dyn;
	
	$style   = '';	
		
	$style  .= '<style type="text/css">';
		
    $style  .= '#video_wrapper {';
    $style  .= 'width:'.$width.'px;';
    $style  .= 'height:'.$height.'px;';
    $style  .= '}';
	
    $style  .= '#video_wrapper .ad_container_'.$dyn.' {';
 	$style  .= 'margin:'.($height/2 - 154).'px '.($width/2 - 150).'px;';
	$style  .= 'position:absolute;';
	$style  .= 'z-index:10001;';
    $style  .= '}';
		
    $style  .= '#video_wrapper .ad_container_'.$dyn.' .ad_header {';
	$style  .= 'background:#999;';
	$style  .= 'padding:5px 0;';
	$style  .= 'text-align:center;';
	$style  .= 'color:#fff;';
	$style  .= 'font-size:12px;';
	$style  .= 'font-weight:bold;';
	$style  .= 'width:300px;';
    $style  .= '}';
	
	$style  .= '#video_wrapper .ad_container_'.$dyn.' .ad_content {';
	$style  .= 'width:300px;';
	$style  .= 'height:250px;';
	$style  .= 'text-align:center;';
	$style  .= 'background:#fff;';
    $style  .= '}';
		
	$style  .= '#video_wrapper .ad_container_'.$dyn.' .ad_footer {';
	$style  .= 'background:#999;';
	$style  .= 'padding:5px 0;';
	$style  .= 'text-align:center;';
	$style  .= 'color:#fff;';
	$style  .= 'width:300px;';
    $style  .= '}';
	
	$style  .= '#video_wrapper .ad_overlay_'.$dyn.' {';
	$style  .= 'background:#000;';
	$style  .= 'filter:alpha(opacity=75);';
	$style  .= '-moz-opacity:.75;';
	$style  .= 'opacity:.75;';
 	$style  .= 'width:'.$width.'px;';
	$style  .= 'height:'.$height.'px;';
	$style  .= 'position:absolute;';
    $style  .= '}';
	
	$style  .= '#player_div {';
	$style  .= 'z-index:0;';
	$style  .= 'position:absolute;';
    $style  .= '}';
		 
    $style  .= '</style>';
	
	echo $style;
	
	$contents .= '<div id="video_wrapper" >';
    $contents .= '<div id="ad_container_'.$dyn.'" class="ad_container_'.$dyn.'">';
    $contents .= '<div class="ad_header" id="ad_header" >Advertisement </div>';
    $contents .= '<div class="ad_content" id="ad_content">' .$googleads->adscript.' </div>';
    $contents .= '<div class="ad_footer" id="ad_footer"> <a href="javascript:hideAd(\''.$cont.'\', \''.$overlay.'\');">';
	$contents .= '<img src="'.JURI::root().'components/com_webplayer/assets/btn_close.gif" border="0" /></a> </div>';
    $contents .= '</div>';
    $contents .= '<div id="player_div">';
}

$contents  .= '<object id="player" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" name="player" width="'.$width.'" height="'.$height.'">';
$contents  .= '<param name="movie" value="'.$src.'" />';
$contents  .= '<param name="wmode" value="opaque" />';
$contents  .= '<param name="allowfullscreen" value="true" />';
$contents  .= '<param name="allowscriptaccess" value="always" />';
$contents  .= '<param name="flashvars" value="'.$flashvars.'" />';
$contents  .= '<object type="application/x-shockwave-flash" data="'.$src.'" width="'.$width.'" height="'.$height.'">';
$contents  .= '<param name="movie" value="'.$src.'" />';
$contents  .= '<param name="wmode" value="opaque" />';
$contents  .= '<param name="allowfullscreen" value="true" />';
$contents  .= '<param name="allowscriptaccess" value="always" />';
$contents  .= '<param name="flashvars" value="'.$flashvars.'" />';
$contents  .= '<p>'.$htmlNode.'</p>';
$contents  .= '</object>';
$contents  .= '</object>';
		
if($ad == 1) {
	$contents .= '</div>';
    $contents .= '<div id="ad_overlay_'.$dyn.'" class="ad_overlay_'.$dyn.'"></div>';
    $contents .= '</div>';
}
		
if(!$plugin) echo $contents;		

?>

<script>
function hideAd(cont, over) {
 document.getElementById(cont).style.display    = 'none';
 document.getElementById(over).style.display = 'none';
}
</script>
