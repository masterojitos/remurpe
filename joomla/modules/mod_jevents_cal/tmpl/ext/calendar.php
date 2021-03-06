<?php
/**
 * copyright (C) 2008 GWE Systems Ltd - All rights reserved
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

/**
 * HTML View class for the component frontend
 *
 * @static
 */
include(dirname(__FILE__)."/../default/calendar.php");


class ExtModCalView extends DefaultModCalView 
{
	
	function _displayCalendarMod($time, $startday, $linkString,	&$day_name, $monthMustHaveEvent=false, $basedate=false){
			global  $mainframe;
			$db	=& JFactory::getDBO();
			$cfg = & JEVConfig::getInstance();
			$compname = JEV_COM_COMPONENT;

			$cal_day=date("d",$time);
			$cal_year=date("Y",$time);
			$cal_month=date("m",$time);
			$calmonth=date("n",$time);

			if (!$basedate) $basedate=$time;
			$base_year = date("Y",$basedate);
			$base_month = date("m",$basedate);
			$basefirst_of_month   = mktime(0,0,0,$base_month, 1, $base_year);
			$base_prev_month 	= $base_month - 1;
			$base_next_month 	= $base_month + 1;
			$base_next_month_year	= $base_year;
			$base_prev_month_year	= $base_year;
			if( $base_prev_month == 0 ) {
				$base_prev_month 	= 12;
				$base_prev_month_year 	-=1;
			}
			if( $base_next_month == 13 ) {
				$base_next_month 	= 1;
				$base_next_month_year 	+=1;
			}
			
			$reg =& JFactory::getConfig();
			$reg->setValue("jev.modparams",$this->modparams);
			$data = $this->datamodel->getCalendarData($cal_year,$cal_month,1,true,$this->modcatids,$this->catidList, $this->myItemid);
			$reg->setValue("jev.modparams",false);

			$month_name = JEVHelper::getMonthName($cal_month);
			$to_day     = date("Y-m-d", $this->timeWithOffset);
			$today = mktime(0,0,0,$cal_month, $cal_day, $cal_year);

			$cal_prev_month 	= $cal_month - 1;
			$cal_next_month 	= $cal_month + 1;
			$cal_next_month_year	= $cal_year;
			$cal_prev_month_year	= $cal_year;

			// additional EBS
			if( $cal_prev_month == 0 ) {
				$cal_prev_month 	= 12;
				$cal_prev_month_year 	-=1;
			}
			if( $cal_next_month == 13 ) {
				$cal_next_month 	= 1;
				$cal_next_month_year 	+=1;
			}

			$viewname = $this->getTheme();
			$viewpath = JURI::root() . "components/$compname/views/".$viewname."/assets";
			$viewimages = $viewpath . "/images";
			$linkpref = "index.php?option=$compname&Itemid=".$this->myItemid.$this->cat."&task=";

			/*
			$linkprevious = $linkpref."month.calendar&day=$cal_day&month=$cal_prev_month&year=$cal_prev_month_year";
			$linkprevious = JRoute::_($linkprevious);
			$linkprevious = $this->htmlLinkCloaking($linkprevious, '<img border="0" title="previous month" alt="previous month" src="'.$viewimages.'/mini_arrowleft.gif"/ >' );
			*/
			$jev_component_name  = JEV_COM_COMPONENT;
			$this->_navigationJS($this->_modid);
			$linkprevious = htmlentities("index.php?option=$jev_component_name&task=modcal.ajax&day=1&month=$base_prev_month&year=$base_prev_month_year&modid=$this->_modid&tmpl=component".$this->cat);
			$linkprevious = '<img border="0" title="previous month" alt="'.JText::_("JEV_LAST_MONTH").'" class="mod_events_link" src="'.$viewimages.'/mini_arrowleft.gif" onmousedown="callNavigation(\''.$linkprevious.'\');" / >';
			
			$linkcurrent = $linkpref."month.calendar&day=$cal_day&month=$cal_month&year=$cal_year";
			$linkcurrent = JRoute::_($linkcurrent);
			$linkcurrent = $this->htmlLinkCloaking($linkcurrent, $month_name." ".$cal_year, array("style"=>"text-decoration:none;color:inherit;"));
			/*
			$linknext = $linkpref."month.calendar&day=$cal_day&month=$cal_next_month&year=$cal_next_month_year";
			$linknext = JRoute::_($linknext);
			$linknext = $this->htmlLinkCloaking($linknext, '<img border="0" title="next month" alt="next month" src="'.$viewimages.'/mini_arrowright.gif"/ >' );
			*/
			$this->_navigationJS($this->_modid);
			$linknext = htmlentities("index.php?option=$jev_component_name&task=modcal.ajax&day=1&month=$base_next_month&year=$base_next_month_year&modid=$this->_modid&tmpl=component".$this->cat);
			$linknext = '<img border="0" title="next month" alt="'.JText::_("JEV_NEXT_MONTH").'" class="mod_events_link" src="'.$viewimages.'/mini_arrowright.gif" onmousedown="callNavigation(\''.$linknext.'\');" / >';

			$content = <<<START
<div id="extcal_minical">
	<table cellspacing="1" cellpadding="0" border="0" align="center" style="border: 1px solid rgb(190, 194, 195); background-color: rgb(255, 255, 255);">
		<tr>
			<td>
				<table width="100%" cellspacing="0" cellpadding="2" border="0" class="extcal_navbar">
					<tr>
						<td valign="middle" height="18" align="center">
							$linkprevious
                		</td>
		                <td width="98%" valign="middle" nowrap="nowrap" height="18" align="center" class="extcal_month_label">
							$linkcurrent
		                </td>
						<td valign="middle" height="18" align="center">
		                    $linknext
                		</td>
					</tr>
				</table>
				<table class="extcal_weekdays">
START;
			$lf="\n";


			// Days name rows - with blank week no.
			$content	.= "<tr>\n<td/>\n";
			for ($i=0;$i<7;$i++) {
				$content.="<td  class='extcal_weekdays'>".$day_name[($i+$startday)%7]."</td>".$lf	;
			}
			$content.="</tr>\n";

			$datacount = count($data["dates"]);
			$dn=0;
			for ($w=0;$w<6 && $dn<$datacount;$w++){
				$content .="<tr>\n";
				// the week column
				list($week,$link) = each($data['weeks']);
				$content .= '<td class="extcal_weekcell">';
				$content .= $this->htmlLinkCloaking($link, "<img width='5' height='20' border='0' alt='week ".$week."' src='".$viewimages."/icon-mini-week.gif'/>" );
				$content .= "</td>\n";

				for ($d=0;$d<7 && $dn<$datacount;$d++){
					$currentDay = $data["dates"][$dn];
					switch ($currentDay["monthType"]){
						case "prior":
						case "following":
							$content .= "<td class='extcal_othermonth'/>\n";
							break;
						case "current":

							$dayOfWeek=strftime("%w",$currentDay["cellDate"]);

							$class = ($currentDay["today"]) ? "extcal_todaycell" : "extcal_daycell";
							$linkclass = "extcal_daylink";
							if($dayOfWeek==0 && !$currentDay["today"]) {
								$class = "extcal_sundaycell";
								$linkclass = "extcal_sundaylink";
							}

							if ($currentDay["events"]) {
								$linkclass = "extcal_busylink";
							}
							$content .= "<td class='".$class."'>\n";
							$content .= $this->htmlLinkCloaking($currentDay["link"], $currentDay['d'], array("class"=>$linkclass,"title"=>JText::_('JEV_CLICK_TOSWITCH_DAY')));

							$content .="</td>\n";
							break;

					}
					$dn++;
				}
				$content .="</tr>\n";
			}
			$content .= "</table>\n";
			$content .= "</td></tr></table></div>\n";

			// Now check to see if this month needs to have at least 1 event in order to display
//			if (!$monthMustHaveEvent || $monthHasEvent) return $content;
//			else return '';
			return $content;
		}
	
}
