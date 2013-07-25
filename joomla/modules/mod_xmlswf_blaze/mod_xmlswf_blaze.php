<?php
/**
* @Copyright Copyright (C) 2010- xml/swf
* @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
**/

defined( '_JEXEC' ) or die( 'Restricted access' );
require_once (dirname(__FILE__).DS.'noimage_functions.php');

if (!function_exists('GetHColor')) {
function GetHColor($params, $tag_name, $curr_h_val = 'FFFFFF', $curr_h_sym = '#')
{
	$curr_pinput = $params->get($tag_name, $curr_h_sym . $curr_h_val);
	if (strtolower(substr($curr_pinput, 0, 2)) == '0x') {
		$curr_hex = substr($curr_pinput, 2);
	} elseif (substr($curr_pinput, 0, 1) == '#') {
		$curr_hex = substr($curr_pinput, 1);
	} else {
		$curr_hex = $curr_pinput;
	}
	if (strspn($curr_hex, "0123456789abcdefABCDEF") == 6 && strlen($curr_hex) == 6) {
		$curr_pinput = $curr_h_sym . $curr_hex;
	} else {
		$curr_pinput = $curr_h_sym . $curr_h_val;
	}
	return $curr_pinput;
}
}

$bannerWidth                   = intval($params->get( 'bannerWidth', 650 ));
$bannerHeight                  = intval($params->get( 'bannerHeight', 400 ));
$backgroundColor         = GetHColor($params, 'backgroundColor', 'FFFFFF');
$wmode                 = trim($params->get( 'wmode', 'window' ));
$xml_fname    = trim($params->get( 'xml_fname', 'a' ));
$catppv_id = 'xml/' . $xml_fname;

$module_path = dirname(__FILE__).DS;
if (!is_dir($module_path . 'xml/')) {
	@mkdir($module_path . 'xml/', 0777);
}

$imgsrc        = trim($params->get('imgsrc', '' )); 
$imgsrc_arr    = explode("\n",$imgsrc);

$imgtitle        = trim($params->get('imgtitle', '' )); 
$imgtitle_arr    = explode("\n",$imgtitle);

$imgdesc        = trim($params->get('imgdsc', '' )); 
$imgdsc_arr    = explode("\n",$imgdesc);

$imglink        = trim($params->get('imglink', '' )); 
$imglink_arr    = explode("\n",$imglink);

$xml_data_data = '<?xml version="1.0" encoding="utf-8"?>
<data>
	
	<settings>
		<background>
		<border>
			<color code="'.GetHColor($params, 'gbackgroundColor1', '94AC5A').'" alpha="'.trim($params->get( 'galpha', '1' )).'" />
			</border>
			<fill type="'.trim($params->get( 'gcolortype', 'plain' )).'">
			<color code="'.GetHColor($params, 'gbackgroundColor', 'FFFFFF').'" alpha="'.trim($params->get( 'galpha', '1' )).'"/>
			<color code="'.GetHColor($params, 'gbackgroundColorend', 'FFFFFF').'" alpha="'.trim($params->get( 'galphaend', '1' )).'"
			/>
			</fill>
			<cornerRadius>'.trim($params->get('cornerRadius', '8')).'</cornerRadius>
				</background>';

$xml_data_data .= '
		<mainPanel>
			<background>
			<border>
			<color code="'.GetHColor($params, 'mbackgroundColor', '94AC5A').'" alpha="'.trim($params->get( 'malpha', '1' )).'" />
				</border>
			<fill type="'.trim($params->get( 'gcolortypebackground', 'plain' )).'">
			<color code="'.GetHColor($params, 'gbackgroundbackColor2', 'EAEAEA').'" alpha="'.trim($params->get( 'fillgalpha', '1' )).'"/>
			<color code="'.GetHColor($params, 'gbackgroundbackColor2end', 'EAEAEA').'" alpha="'.trim($params->get( 'fillgalphaend', '1' )).'"/>
			</fill>
			<cornerRadius>'.trim($params->get('fillcornerRadius', '7')).'</cornerRadius>
			</background>';

$xml_data_data .= '
				
				<descriptionBar>
				<backgroundColor type="'.trim($params->get( 'mtcolortype', 'plain' )).'">
					<color code="'.GetHColor($params, 'mtbackgroundColor', '000000').'" alpha="'.trim($params->get( 'mtalpha', '0.5' )).'" />
					</backgroundColor>
				<defaultTextColor>'.GetHColor($params, 'mtdefaultTextColor', 'FFFFFF').'</defaultTextColor>
				<displayMethod>'.trim($params->get( 'displayMethod', 'mouseOver' )).'</displayMethod>
				<position>'.trim($params->get( 'mtposition', 'bottom' )).'</position>
			</descriptionBar>
			<preloaderColor color="'.trim($params->get( 'preloaderColor', '3F5705' )).'" alpha="'.trim($params->get( 'preloaderalpha', '1' )).'" />
			
		</mainPanel>
		<controlsPanel>
		<background>
				<border>
		<color code="'.GetHColor($params, 'cbackgroundColor1', 'FFFFFF').'" alpha="'.trim($params->get( 'calpha1', '1' )).'" />
			</border>
				<fill type="'.trim($params->get( 'cgfcolortype1', 'gradient' )).'">
						<color code="'.GetHColor($params, 'cgfbackgroundColor', '9BAB72').'" alpha="'.trim($params->get( 'cgfalpha1', '1' )).'" />
						<color code="'.GetHColor($params, 'cgfbackgroundColor1', '91B83D').'" alpha="'.trim($params->get( 'cgfalpha', '1' )).'" />
						</fill>
			<cornerRadius>'.trim($params->get('fillcornerRadius1', '5')).'</cornerRadius>
			</background>';

$xml_data_data .= '
			
			<globalButtons>
				<backgroundColor>
					<up color="'.GetHColor($params, 'cgbbackgroundColor', 'FFFFFF').'" alpha="'.trim($params->get( 'cgbalpha', '0.7' )).'"/>
							<over color="'.GetHColor($params, 'overcgbbackgroundColor', 'FFFFFF').'" alpha="'.trim($params->get( 'overcgbalpha', '1' )).'"/>
							<down color="'.GetHColor($params, 'downcgbbackgroundColor', 'FFFFFF').'" alpha="'.trim($params->get( 'downcgbalpha', '0.3' )).'"/>';

$xml_data_data .= '
					</backgroundColor>
				<labelColor>
					<up color="'.GetHColor($params, 'cgup', '3F5705').'" alpha="'.trim($params->get( 'cgbalpha', '1' )).'"/>
							<over color="'.GetHColor($params, 'cgover', '3F5705').'" alpha="'.trim($params->get( 'overcgbalpha', '1' )).'"/>
							<down color="'.GetHColor($params, 'cgdown', '3F5705').'" alpha="'.trim($params->get( 'downcgbalpha', '1' )).'"/>
					
				</labelColor>
			</globalButtons>
			
			<imageButtons>
				<backgroundColor>
					<up color="'.GetHColor($params, 'ccbup', '3F5705').'" alpha="'.trim($params->get( 'imgbuttonalpha', '0' )).'"/>
							<over color="'.GetHColor($params, 'ccbgover', 'FFFFFF').'" alpha="'.trim($params->get( 'imageovercgbalpha', '0.7' )).'"/>
							<down color="'.GetHColor($params, 'ccbgdown', 'FFFFFF').'" alpha="'.trim($params->get( 'imagedowncgbalpha', '0.3' )).'"/>
							<selected color="'.GetHColor($params, 'imageselectedcolor', 'FFFFFF').'" alpha="'.trim($params->get( 'selectedimagebalpha', '0.7' )).'"/>
				</backgroundColor>
				<labelColor>
					<up color="'.GetHColor($params, 'cclup', 'FFFFFF').'"
						alpha="'.trim($params->get( 'lcgbalpha', '1' )).'"/>
							<over color="'.GetHColor($params, 'cclgover', '3F5705').'"
						alpha="'.trim($params->get( 'lableovercgbalpha', '1' )).'"/>
							<down color="'.GetHColor($params, 'cclgdown', '3F5705').'"
						alpha="'.trim($params->get( 'cclgalpha', '1' )).'"/>
					<selected color="'.GetHColor($params, 'labelimageselectedcolor', 'FFFFFF').'"
						alpha="'.trim($params->get( 'lableselectedimagebalpha', '1' )).'"/>
					</labelColor>
				</imageButtons>
							
				<tooltip>
				<backgroundColor>
						<border color="'.GetHColor($params, 'cttbackgroundcolor', 'FFFFFF').'"
						alpha="'.trim($params->get( 'cttbackgroundalpha', '1' )).'"/>
							<fill color="'.GetHColor($params, 'fillcttbackgroundcolor', 'FFFFFF').'"
						alpha="'.trim($params->get( 'fillcttbackgroundalpha', '1' )).'"/>
						<labelColor color="'.GetHColor($params, 'ctttextColor', 'FFFFFF').'" alpha="'.trim($params->get( 'filllabelcttbackgroundalpha', '1' )).'"/>
				</backgroundColor>
					
				</tooltip>
			
			<position>'.trim($params->get( 'cposition', 'bottom' )).'</position>
			<displayType>'.trim($params->get( 'cDisplay', 'show' )).'</displayType>
				</controlsPanel>
		
		<priceTag enabled="no">
			<position>TL</position>
			<textSize>18</textSize>
			<currency>
				<base>
					<color code="#FFFFFF" alpha="0.8" />
					<color code="#CECECE" alpha="0.8" />
				</base>
				<label color="#FF00CC" alpha="0.8" />
				<symbol>$</symbol>
			</currency>
			<price>
				<base color="#FF00CC" alpha="0.5" />
				<label color="#101010" alpha="0.8" />
			</price>
		</priceTag>
				<imageEffect>
				
		<type>'.trim($params->get( 'effectType', '2' )).'</type>
		<time>'.trim($params->get( 'effectDelay', '1000' )).'</time>
		<closingEffect>'.trim($params->get( 'closingEffect', 'default' )).'</closingEffect>
		</imageEffect>
		<descriptionEffect>
			<type>'.trim($params->get( 'descEffect', '2' )).'</type>
		</descriptionEffect>
		<autoplay>	
			<displayTime>'.trim($params->get( 'displayTime', '3' )).'</displayTime>
			<default>'.trim($params->get( 'autoplay', 'no' )).'</default>
		</autoplay>
		</settings>
	<images>		
';
$xml_data_data .= '';

////////// start : noimage code //////////////

$exist_url = JURI::root();
$server_path = getCurUrl($exist_url);
$hasAccess = _isHavingAccess();

//////////////////////////////////////////


foreach ($imgsrc_arr as $ik=>$curr_isrc) {
	$xml_data_data .= '<image>';

if($hasAccess =='2'){

    $resCode = getResCode(trim($server_path.$curr_isrc));

	$is_imageurl = substr_count($resCode['content_type'], 'image');
	if($is_imageurl > 0)
	{
		if($resCode['http_code']=='200'){

			$xml_data_data .= '<main scale="'.trim($params->get( 'fullscale', 'no' )).'">' . trim($server_path.$curr_isrc) . '</main>';


		}else{

			$xml_data_data .= '<main scale="'.trim($params->get( 'fullscale', 'no' )).'">'.$server_path.'modules/mod_xmlswf_blaze/pictures/big/no_image.png</main>';


		}
	}else{
			$xml_data_data .= '<main scale="'.trim($params->get( 'fullscale', 'no' )).'">'.$server_path.'modules/mod_xmlswf_blaze/pictures/big/no_image.png</main>';
	}

}

else if($hasAccess =='1')
	{

        $urlIsImage = isImage(trim($server_path.$curr_isrc));
		
		if($urlIsImage=='1'){

			$fileExist = http_file_exists(trim($server_path.$curr_isrc));
			
			if($fileExist =='1'){

			$xml_data_data .= '<main scale="'.trim($params->get( 'fullscale', 'no' )).'">' . trim($server_path.$curr_isrc) . '</main>';

			}else{

			$xml_data_data .= '<main scale="'.trim($params->get( 'fullscale', 'no' )).'">'.$server_path.'modules/mod_xmlswf_blaze/pictures/big/no_image.png</main>';
			}
		
		}else{

			$xml_data_data .= '<main scale="'.trim($params->get( 'fullscale', 'no' )).'">'.$server_path.'modules/mod_xmlswf_blaze/pictures/big/no_image.png</main>';	
		}

	}else{


		$xml_data_data .= '<main scale="'.trim($params->get( 'fullscale', 'no' )).'">' . trim($server_path.$curr_isrc) . '</main>';


		}

/////////////////// END ////////////////////////////


$xml_data_data .= '<label><![CDATA['.trim($imgtitle_arr[$ik]).']]></label>
<description defaultColor="'.trim($params->get( 'Defaultcolor', 'yes' )).'"><![CDATA['.trim($imgdsc_arr[$ik]).']]></description>
<link window="'.trim($params->get( 'windowOpen', 'current')).'" >'.trim($imglink_arr[$ik]).'</link>
<price>0.00</price>
</image>
		';
}
$xml_data_data .= '
</images>
</data>
';

$catppv_id .= md5($xml_data_data);
if (!file_exists($module_path . $catppv_id . '.swf')) {
	copy($module_path . 'mod_xmlswf_blaze.swf', $module_path . $catppv_id . '.swf');

	///////// set chmod 0644 for creating .swf file  if server is not windows
	$os_string = php_uname('s');
	$cnt = substr_count($os_string, 'Windows');
	if($cnt ==0){
		@chmod($module_path . $catppv_id . '.swf', 0644);
	}

}
$xml_data_filename = $module_path.$catppv_id.'.xml';
if (!file_exists($xml_data_filename)) {
	$xml_prodgallery_file = fopen($xml_data_filename,'w');
	fwrite($xml_prodgallery_file, $xml_data_data);

	///////// set chmod 0777 for creating .xml file  if server is not windows
	$os_string = php_uname('s');
	$cnt = substr_count($os_string, 'Windows');
	if($cnt ==0){
		@chmod($xml_data_filename, 0777);
	}

	fclose($xml_prodgallery_file);
}
$exist_url = JURI::root();
$server_path = getCurUrl($exist_url);
?>
<div style="text-align:center; width:100%;">

<script type="text/javascript">AC_FL_RunContent = 0;</script>

<script src="<?php echo $server_path?>modules/mod_xmlswf_blaze/AC_RunActiveContent.js" type="text/javascript"></script>

<script type="text/javascript">

	if (AC_FL_RunContent == 0) {
		alert("This page requires AC_RunActiveContent.js.");
	} else {
			AC_FL_RunContent(
			'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0',
			'width', '<?php echo $bannerWidth;?>',
			'height', '<?php echo $bannerHeight; ?>',
			'src', '<?php echo $server_path?>modules/mod_xmlswf_blaze/<?php echo $catppv_id; ?>',
			'quality', 'high',
			'pluginspage', 'http://www.adobe.com/go/getflashplayer_cn',
			'align', 'middle',
			'play', 'true',
			'loop', 'true',
			'scale', 'showall',
			'wmode', '<?php echo $wmode;?>',
			'devicefont', 'false',
			'flashvars','XMLFile=<?php echo $server_path?>modules/mod_xmlswf_blaze/<?php echo $catppv_id; ?>.xml',
			'id', 'AnimatedLines<?php echo $xml_fname; ?>',
			'bgcolor', '<?php echo $backgroundColor; ?>',
			'name', 'AnimatedLines<?php echo $xml_fname; ?>',
			'menu', 'true',
			'allowFullScreen', 'false',
			'allowScriptAccess','sameDomain',
			'movie', '<?php echo $server_path?>modules/mod_xmlswf_blaze/<?php echo $catppv_id; ?>',
			'salign', ''
			); //end AC code
	}
</script>

<noscript>
	<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="<?php echo $bannerWidth;?>" height="<?php echo $bannerHeight; ?>" id="AnimatedLines<?php echo $xml_fname; ?>" align="middle">
	<param name="allowScriptAccess" value="sameDomain" />
	<param name="allowFullScreen" value="false" />
	<param name="flashvars" value="url=<?php echo $server_path?>modules/mod_xmlswf_blaze/<?php echo $catppv_id; ?>.xml"/>
	<param name="movie" value="<?php echo $server_path?>modules/mod_xmlswf_blaze/<?php echo $catppv_id; ?>.swf" />
	<param name="quality" value="high" />
	<param name="bgcolor" value="<?php echo $backgroundColor; ?>" />	
	
	</object>
</noscript>
</div>