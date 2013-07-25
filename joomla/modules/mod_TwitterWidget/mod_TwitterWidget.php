<?php
/**
Twitter Widget for Joomla ! by Sharif Mamdouh http://www.inowweb.com 
have Fun!
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

$document =& JFactory::getDocument();
if ($params->get("load_css", "1") == "1")  $document->addStyleSheet(JURI::Root(true)."/modules/mod_TwitterForJoomla/inow.css");

$moduleclass_sfx = $params->get('moduleclass_sfx');
$username="inowweb";
          $username = $params->get('username');
		  
		  	if($params->get('style', '1')) {
		$style=1;
	}
$width=$params->get('width');
$height=$params->get('height');
$count=$params->get('count');
$flash_style=$params->get('flash_style');

	if($flash_style==0) {
		$flash_style='smooth';
	}
	
			if($flash_style==1) {
		$flash_style='velvetica';
	}
	
	if($flash_style==2) {
		$flash_style='revo';
	}
?>

<div class="joomla_sharethis<?php echo $moduleclass_sfx?>">
<!-- Joomla Twitter BEGIN -->
<?php
$html='
<div id="twitter_div">
<ul id="twitter_update_list"></ul>
<a href="http://twitter.com/'.$username.'" id="twitter-link" style="display:block;text-align:right;">follow me on Twitter</a>
</div>
<script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>
<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/'.$username.'.json?callback=twitterCallback2&amp;count='.$count.'"></script>
';

$flash='

<script src="http://widgets.twimg.com/j/2/widget.js"></script>
<script>
new TWTR.Widget({
  version: 2,
  type: \'profile\',
  rpp: '.$count.',
  interval: 6000,
  width: '.$width.',
  height: '.$height.',
  theme: {
    shell: {
      background: \'#42BFDD\',
      color: \'#ffffff\'
    },
    tweets: {
      background: \'#ffffff\',
      color: \'#000000\',
      links: \'#28617f\'
    }
  },
  features: {
    scrollbar: false,
    loop: false,
    live: false,
    hashtags: true,
    timestamp: true,
    avatars: true,
    behavior: \'all\'
  }
}).render().setUser(\''.$username.'\').start();
</script>

';
if($style==1)
{
echo $flash;
}
else
{
echo $html;
}
?>

<!-- Joomla Twitter END -->
<div align="right" style="color:#999;margin-bottom:3px;font-size:9px"><a target="_blank" class="external" title="web design company" href="http://www.inowweb.com"><span style="color:#999;margin-bottom:3px;font-size:9px" ></span></a></div>

</div>
