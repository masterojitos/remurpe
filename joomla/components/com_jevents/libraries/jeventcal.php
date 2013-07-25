<?php
/**
 * JEvents Component for Joomla 1.5.x
 *
 * @version     $Id: jeventcal.php 1506 2009-07-09 18:47:46Z geraint $
 * @package     JEvents
 * @copyright   Copyright (C) 2008-2009 GWE Systems Ltd, 2006-2008 JEvents Project Group
 * @license     GNU/GPLv2, see http://www.gnu.org/licenses/gpl-2.0.html
 * @link        http://www.jevents.net
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

class jEventCal {
	var $data;
	var $_unixstartdate = null;
	var $_unixenddate = null;
	var $_location = "";
	var $_contact = "";
	var $_extra_info = "";
	var $_color = "";
	var $_published = "";
	var $_multiday = 0;
	var $_noendtime = 0;

	// default values
	var $_catid=0;

	function jEventCal($inRow) {
		//$this->data = $inRow;
		$array= get_object_vars($inRow);
		foreach ($array as $key=>$val) {
			$key = "_".$key;
			$this->$key = $val;
		}
		if (!isset($this->_alldayevent)) {
			$this->_alldayevent = 0;
		}
	}

	/**
	 * Is this type of event editable?
	 *
	 * @return boolean
	 */
	function isEditable(){
		return true;
	}

	function editTask(){
		return "jevent.edit";
	}

	function deleteTask(){
		return "jevent.delete";
	}

	function detailTask(){
		return "jevent.detail";
	}

	function startDate(){
		if (!isset($this->_startdate)){
			$this->_startdate=strftime("%Y-%m-%d",$this->getUnixStartDate());
		}
		return $this->_startdate;
		//return $this->_publish_up;
	}

	function endDate(){
		if (!isset($this->_enddate)){
			$this->_enddate=strftime("%Y-%m-%d",$this->getUnixEndDate());
		}
		return $this->_enddate;
		//return $this->_publish_down;
	}

	function hasExtraInfo() {
		return !empty( $this->_extra_info );
	}

	function hasLocation() {
		return !empty( $this->_adresse_info );
	}

	function hasContactInfo() {
		return !empty( $this->_contact_info );

	}

	// workaround for php 4 - much easier in php 5!!!
	function getOrSet($field, $val=""){
		if (strlen($val)==0) return $this->get($field);
		else $this->set($field,$val);
	}
	function get($field){
		$field = "_".$field;
		if (isset($this->$field)) return $this->$field;
		else {
			return false;
		}
	}
	function set($field, $val=""){
		$field = "_".$field;
		$this->$field=$val;
	}

	function id() { return $this->_id; }
	function title() { return $this->_title!=""?$this->_title:""; }
	function useCatColor() { return $this->_useCatColor; }
	function color_bar() { return $this->_color_bar; }
	function catid() { return $this->_catid; }
	function created_by() { return $this->_created_by; }
	function hits() { return $this->_hits; }
	function state() { return $this->_state; }
	function published() { return $this->_published; }
	function alldayevent() { return $this->_alldayevent; }

	function noendtime($val="") {
		return $this->getOrSet(__FUNCTION__,$val);
	}

	function modifylink($val="") {
		return $this->getOrSet(__FUNCTION__,$val);
	}

	function multiday($val="") {
		return $this->getOrSet(__FUNCTION__,$val);
	}

	function content($val="") {
		return $this->getOrSet(__FUNCTION__,$val);
	}

	function access($val="") {
		return $this->getOrSet(__FUNCTION__,$val);
	}

	function location($val="") {
		return $this->getOrSet("adresse_info",$val);
	}
	function contact_info($val="") {
		return $this->getOrSet(__FUNCTION__,$val);
	}

	function extra_info($val="") {
		return $this->getOrSet(__FUNCTION__,$val);
	}

	function yup() { return $this->_yup; }
	function mup() { return $this->_mup; }
	function dup() { return $this->_dup; }
	function hup() { return $this->_hup; }
	function minup() { return $this->_minup; }
	function sup() { return $this->_sup; }

	function ydn() { return $this->_ydn; }
	function mdn() { return $this->_mdn; }
	function ddn() { return $this->_ddn; }
	function hdn() { return $this->_hdn; }
	function mindn() { return $this->_mindn; }
	function sdn() { return $this->_sdn; }


	function publish_up() {return$this->_publish_up;}
	function publish_down() {return$this->_publish_down;}

	function reccurtype() {	return $this->_reccurtype;	}
	function reccurday() {	return $this->_reccurday;	}
	function reccurweeks() {return $this->_reccurweeks;	}
	function reccurweekdays() {return $this->_reccurweekdays;	}

	function isrepeat() {
		if (!isset($this->_rptcount)) {
			if ($this->until()!=$this->dtstart() || $this->count()>1){
				return true;
			}
			return false;
		}
		return $this->_rptcount>0;
	}

	function getUnixStartDate() {
		if (!isset($this->_unixstartdate)){
			$this->_unixstartdate=mktime( 0, 0, 0, $this->mup(), $this->dup(), $this->yup() );
		}
		return $this->_unixstartdate;
	}

	function getUnixEndDate() {
		if (!isset($this->_unixenddate)){
			$this->_unixenddate=mktime( 0, 0, 0, $this->mdn(), $this->ddn(), $this->ydn() );
		}
		return $this->_unixenddate;
	}

	function getUnixStartTime() {
		if (!isset($this->_unixstartime)){
			$this->_unixstarttime=mktime( $this->hup(),$this->minup(), $this->sup(), $this->mup(), $this->dup(), $this->yup() );
		}
		return $this->_unixstarttime;
	}

	function getUnixEndTime() {
		if (!isset($this->_unixendtime)){
			$this->_unixendtime=mktime( $this->hdn(),$this->mindn(), $this->sdn(), $this->mdn(), $this->ddn(), $this->ydn() );
		}
		return $this->_unixendtime;
	}

	function contactLink($val="", $admin=false){
		if (strlen($val)==0) {
			if (!isset($this->_contactLink) || $this->_contactLink=="") $this->_contactLink = JEventsHTML::getUserMailtoLink( $this->id(), $this->created_by(),$admin);
		}
		else $this->_contactLink=$val;
		return $this->_contactLink;
	}

	function catname($val=""){
		if (strlen($val)==0) {
			if (!isset($this->_catname)) $this->_catname = $this->getCategoryName();
			return $this->_catname;
		}
		else $this->_catname=$val;
	}

	function bgcolor($val=""){
		if (strlen($val)==0) {
			if (!isset($this->_bgcolor)) $this->_bgcolor = JEV_CommonFunctions::setColor($this);
			return $this->_bgcolor;
		}
		else $this->_bgcolor=$val;
	}

	function fgcolor($val=""){
		if (strlen($val)==0) {
			if (!isset($this->_fgcolor)) $this->_fgcolor = JevMapColor($this->bgcolor());
			return $this->_fgcolor;
		}
		else $this->_fgcolor=$val;
	}

	function getCategoryName( ){
		$db	=& JFactory::getDBO();

		static $arr_catids;

		$catid = intval($this->catid());

		if (!$arr_catids) {
			$arr_catids = array();
		}
		if (!isset($arr_catids[$catid])) {
			$catsql = "SELECT id, name"
			. "\n FROM #__categories"
			. "\n WHERE id='$catid'"
			;
			$db->setQuery($catsql);

			if( $categories = $db->loadObjectList() ) {
				$arr_catids[$catid] = $categories[0]->name;
			} else {
				$arr_catids[$catid] ='';
			}
		}
		return $arr_catids[$catid];
	}

	function getCategoryDescription( ){
		$db	=& JFactory::getDBO();

		static $arr_catids;

		$catid = intval($this->catid());

		if (!$arr_catids) {
			$arr_catids = array();
		}
		if (!isset($arr_catids[$catid])) {
			$catsql = "SELECT id, name,description"
			. "\n FROM #__categories"
			. "\n WHERE id='$catid'"
			;
			$db->setQuery($catsql);

			if( $categories = $db->loadObjectList() ) {
				$arr_catids[$catid] = $categories[0]->description;
			} else {
				$arr_catids[$catid] ='';
			}
		}
		return $arr_catids[$catid];
	}

	function checkRepeatMonth($cellDate, $year,$month){
		// SHOULD REALLY INDEX ON month/year incase more than one being displayed!


		// builds and returns array
		if (!isset($this->eventDaysMonth)){
			$this->eventDaysMonth = array();

			if(is_null($year) || is_null( $month)) {
				return false;
			}

			$monthStartDate = mktime( 0,0,0, $month, 1, $year );
			$daysInMonth = intval(date("t",$monthStartDate ));
			$monthEndDate = mktime( 0,0,0, $month, $daysInMonth , $year );
			$monthEndSecond = mktime( 23,59,59, $month, $daysInMonth , $year );

			$this->eventDaysMonth =  $this->getRepeatArray($monthStartDate, $monthEndDate, $monthEndSecond);
		}
		return (array_key_exists($cellDate,$this->eventDaysMonth));
	}

	function checkRepeatWeek($this_currentdate,$week_start,$week_end)  {

		// SHOULD REALLY INDEX ON weekstart
		// builds and returns array
		if (!isset($this->eventDaysWeek)){
			$this->eventDaysWeek = array();

			if(is_null($week_start) || is_null( $week_end)) {
				return false;
			}

			list($y,$m,$d) = explode(":",strftime("%Y:%m:%d",$week_end));
			$weekEndSecond = mktime( 23,59,59, $m, $d , $y);

			$this->eventDaysWeek =  $this->getRepeatArray($week_start, $week_end, $weekEndSecond);
		}
		return (array_key_exists($this_currentdate,$this->eventDaysWeek));
	}

	function checkRepeatDay($this_currentdate){

		list($y,$m,$d) = explode(":",strftime("%Y:%m:%d",$this_currentdate));
		$dayEndSecond = mktime( 23,59,59, $m, $d , $y);

		$this->eventDaysDay =  $this->getRepeatArray($this_currentdate, $this_currentdate, $dayEndSecond);
		return (array_key_exists($this_currentdate,$this->eventDaysDay));
		/*
		* do net keep result set, next call is for different day
		if (!isset($this->eventDaysDay)){
		$this->eventDaysDay = array();

		if(is_null($this_currentdate)) {
		return false;
		}

		list($y,$m,$d) = explode(":",strftime("%Y:%m:%d",$this_currentdate));
		$dayEndSecond = mktime( 23,59,59, $m, $d , $y);

		$this->eventDaysDay =  $this->getRepeatArray($this_currentdate, $this_currentdate, $dayEndSecond);
		}
		return (array_key_exists($this_currentdate,$this->eventDaysDay));
		*/
	}

	function getRepeatArray( $startPeriod, $endPeriod, $periodEndSecond) {

		// NEED TO CHECK MONTH and week overlapping month end
		// builds and returns array
		$eventDays = array();

		// double check the SQL has given us valid events
		$event_start_date = mktime( 0,0,0,  $this->_mup, $this->_dup, $this->_yup );
		$event_end_date = mktime( 0,0,0,  $this->_mdn, $this->_ddn, $this->_ydn );
		if ($event_end_date<$startPeriod || $event_start_date>$periodEndSecond) return  $eventDays;

		$daysInMonth = intval(date("t",$startPeriod ));
		list($periodStartDay, $month, $year) = explode(":",date("d:m:Y",$startPeriod));

		$repeatingEvent = false;
		if ($this->_reccurtype!=0 || $this->_reccurday!="" || $this->_reccurweekdays!="" || $this->_reccurweeks!=""){
			$repeatingEvent = true;
		}

		// treat midnight as a special case
		$endsMidnight = false;
		if ($this->_hdn==0 && $this->_mindn==0 && $this->_sdn==0 ){
			$endsMidnight = true;
		}

		$multiDayEvent = false;
		if ($this->_dup!=$this->_ddn || $this->_mup!=$this->_mdn || $this->_yup!=$this->_ydn  ) {	// should test month/year too!
			$multiDayEvent = true;
		}


		if (!$repeatingEvent) {
			if (!$multiDayEvent) {
				// single day so populate the array and get on with things!
				$eventDays[$event_start_date]=true;
				return $eventDays;
			}
			else {
				// otherwise a multiday event

				// Find the first and last relevant days
				if ($startPeriod>$event_start_date) $firstDay = 1;
				else $firstDay = intval(date("j",$event_start_date));

				if ($event_end_date>$endPeriod) $lastDay = $daysInMonth;
				else $lastDay = intval(date("j",$event_end_date));

				for ($d=$firstDay;$d<=$lastDay;$d++) {
					$eventDate = mktime( 0,0,0, $month , $d, $year);
					// treat midnight as a special case - we don't mark following day as having the event
					if ($d==$lastDay && $endsMidnight) continue;
					$eventDays[$eventDate]=true;
				}
				return $eventDays;
			}
		}

		// All I'm left with are the repeated events

		//echo "row->reccurtype = $this->_reccurtype $this->_id<br/><br/>CHECK IT OUT - type 2 needs more work!!!<br/><hr/>";

		switch( $this->_reccurtype) {
			case 0: // All days
			$this->viewable = true;
			return $this->viewable;
			break;

			case 1: // By week - 1* by week
			case 2: // By week - n* by week

			// This is multi-days per week
			if ($this->_reccurweekdays != ""){
				$reccurweekdays	= explode( '|', $this->_reccurweekdays );
				$countdays		= count( $reccurweekdays );
			}
			// This is once a week
			else if ($this->_reccurday!="") {
				$reccurweekdays   = array();
				$tmp_weekday      = intval($this->_reccurday);
				if ($tmp_weekday == -1) {
					$tmp_weekday = intval(date( 'w', $event_start_date));
				}
				$reccurweekdays[] = $tmp_weekday;
				$countdays		  = count( $reccurweekdays );
			}
			else {
				echo "Should not really be here <br/>";
			}

			if (strpos($this->_reccurweeks,"pair")===false) {
				$repeatweeks	= explode( '|', $this->_reccurweeks );
			}
			else $repeatweeks = array();

			for ($i=0;$i<$countdays;$i++){
				// This is first, second week etc of the months
				if (count($repeatweeks)>0){
					$daynum_of_first_in_month = intval(date( 'w', mktime( 0, 0, 0, $month, 1, $year )));
					$adjustment = 1 + (7+$reccurweekdays[$i]-$daynum_of_first_in_month)%7;
					// Now find repeat weeks for the month
					foreach ($repeatweeks as $weeknum) {
						// first $reccurweekdays[$i] in the month is therefore
						$next_recurweekday = ($adjustment + ($weeknum-1)*7);
						$nextDate = mktime( 0, 0, 0, $month, $next_recurweekday, $year );
						if ($nextDate>=$event_start_date && $nextDate<=$event_end_date)	$eventDays[$nextDate]=true;
					}
				}
				else {
					// find corrected start date
					$weekday_of_startdate = date( 'w', $event_start_date);
					if ($reccurweekdays[$i]>=0){
						$true_start_day_of_week_for_sequence = $reccurweekdays[$i];
					}
					else $true_start_day_of_week_for_sequence = $weekday_of_startdate;

					list($event_start_day, $event_start_month, $event_start_year) = explode(":",date("d:m:Y",$event_start_date));

					$adjustedStartDay = $event_start_day + (7+$true_start_day_of_week_for_sequence - $weekday_of_startdate)%7;

					$sequence_start_date = mktime( 0, 0, 0, $event_start_month, $adjustedStartDay, $event_start_year);
					//echo "event start data : ".date("d:m:Y",$event_start_date)."<br/>";
					//echo "adj sequence_start_date: ".date("d:m:Y",$sequence_start_date)."<br/>";
					//echo "month start data : ".date("d:m:Y",$startPeriod)."<br/>";
					if ($this->_reccurweeks=="pair"){
						// every 2 weeks
						// first of month day difference
						// 60*60*24 = 86400
						// 86400*14 = 1209600
						$delta = (1209600+$sequence_start_date-$startPeriod )%1209600;
						$deltadays = round($delta/86400,0);

						for ($weeks=0;$weeks<6;$weeks++){
							$nextDate = mktime(0,0,0,$month, $periodStartDay + $deltadays+ (14*$weeks), $year);
							if ($nextDate<=$endPeriod) {
								if ($nextDate>=$event_start_date && $nextDate<=$event_end_date) $eventDays[$nextDate]=true;
							}
							else break;
						}

					}
					else if ($this->_reccurweeks=="impair"){
						// every 3 weeks
						// every 2 weeks
						// first of month day difference
						// 60*60*24 = 86400
						// 86400*21 = 1814400
						$delta = (1814400+$sequence_start_date-$startPeriod )%1814400;
						$deltadays = round($delta/86400,0);

						for ($weeks=0;$weeks<6;$weeks++){
							$nextDate = mktime(0,0,0,$month, $periodStartDay + $deltadays+ (21*$weeks), $year);
							if ($nextDate<=$endPeriod) {
								if ($nextDate>=$event_start_date && $nextDate<=$event_end_date) $eventDays[$nextDate]=true;
							}
							else break;
						}

					}
				}

			}
			return $eventDays;

			break;

			case 3: // By month - 1* by month
			if( $this->_reccurday ==-1 ) { //by day number

				list($event_start_day, $event_start_month, $event_start_year) = explode(":",date("d:m:Y",$event_start_date));
				$nextDate = mktime(0,0,0,$month, $event_start_day, $year);
				if ($nextDate >= $event_start_date && $nextDate<=$event_end_date) $eventDays[$nextDate]=true;
			}
			else { //by day name following the day number

				list($event_start_day, $event_start_month, $event_start_year) = explode(":",date("d:m:Y",$event_start_date));
				$equiv_day_of_month = mktime( 0, 0, 0, $month, $event_start_day, $year);
				$weekday_of_equivalent = date( 'w', $equiv_day_of_month);
				$temp = $event_start_day + (7+$this->_reccurday - $weekday_of_equivalent)%7;

				$nextDate = mktime( 0, 0, 0, $month, $temp, $year);
				if ($nextDate >= $event_start_date && $nextDate<=$event_end_date) $eventDays[$nextDate]=true;
			}
			return $eventDays;
			break;

			case 4: // By month - end of the month
			// get month end
			list($lastday, $month, $year) = explode(":",date("t:m:Y",$endPeriod));
			$monthEnd = mktime(0,0,0,$month,$lastday,$year);
			if ($monthEnd >= $event_start_date && $monthEnd<=$event_end_date) $eventDays[$monthEnd]=true;
			return $eventDays;

			break;

			case 5: // By year - 1* by year
			list($event_start_day, $event_start_month, $event_start_year) = explode(":",date("d:m:Y",$event_start_date));
			if ($month == $event_start_month){
				if( $this->_reccurday ==-1 ) { //by day number

					$nextDate = mktime(0,0,0,$month, $event_start_day, $year);
					if ($nextDate >= $event_start_date && $nextDate<=$event_end_date) $eventDays[$nextDate]=true;
				}
				else { //by day name following the day number

					list($event_start_day, $event_start_month, $event_start_year) = explode(":",date("d:m:Y",$event_start_date));
					$equiv_day_of_month = mktime( 0, 0, 0, $month, $event_start_day, $year);
					$weekday_of_equivalent = date( 'w', $equiv_day_of_month);
					$temp = $event_start_day + (7+$this->_reccurday - $weekday_of_equivalent)%7;

					$nextDate = mktime( 0, 0, 0, $month, $temp, $year);
					if ($nextDate >= $event_start_date && $nextDate<=$event_end_date) $eventDays[$nextDate]=true;
				}
			}
			return $eventDays;
			break;

			default:
				return $eventDays;
				break;
		}

	}

	function vCalExportLink($sef=false, $singlerecurrence=false){
		$Itemid	= JEVHelper::getItemid();
		$task = $singlerecurrence?"icalrepeat":"icalevent";
		$link = "index.php?option=".JEV_COM_COMPONENT."&task=$task.vcal&template=component&evid=".$this->id()
		. "&Itemid=".$Itemid
		// after testing set showBR = 0
		. "&showBR=1";
		$link = $sef?JRoute::_( $link  ):$link;
		return $link;
	}

	function editLink($sef=false) {
		$Itemid	= JEVHelper::getItemid();
		$link = "index.php?option=".JEV_COM_COMPONENT."&task=".$this->editTask().'&evid='. $this->id().'&Itemid='.$Itemid;
		$link = $sef?JRoute::_( $link  ):$link;
		return $link;
	}

	function editRepeatLink($sef=false) {
		// only applicable for jivalevents at present
		return "";
	}

	function deleteLink($sef=false) {
		$Itemid	= JEVHelper::getItemid();
		$link = "index.php?option=".JEV_COM_COMPONENT."&task=".$this->deleteTask().'&evid='. $this->id().'&Itemid='.$Itemid;
		$link = $sef?JRoute::_( $link  ):$link;
		return $link;
	}

	function deleteRepeatLink($sef=false) {
		// only applicable for jivalevents at present
		return "";
	}

	function deleteFutureLink($sef=false) {
		// only applicable for jivalevents at present
		return "";
	}

	function viewDetailLink($year,$month,$day,$sef=true, $Itemid=0){
		$Itemid	= $Itemid>0?$Itemid:JEVHelper::getItemid();
		$link = "index.php?option=".JEV_COM_COMPONENT."&task=".$this->detailTask()."&evid=".$this->id() .'&Itemid='.$Itemid
		."&year=$year&month=$month&day=$day" ;
		$link = $sef?JRoute::_( $link  ):$link;
		return $link;
	}

	function canUserEdit(){
		$is_event_creator = JEVHelper::isEventCreator();
		$user =& JFactory::getUser();
		// if can create events and this was created by this user then can edit
		if ($is_event_creator && $this->isEditable() &&  $this->created_by() == $user->id){
			return true;
		}
		// if "event publisher" or "event editor" can always edit event
		if (JEVHelper::canEditEvent($this)) return true;
		if (JEVHelper::canPublishEvent($this)) return true;

		return false;
	}

	function repeatSummary(){

		$cfg = & JEVConfig::getInstance();

		// i.e. 1 = follow english word order by default
		$grammar = intval(JText::_('JEV_REPEAT_GRAMMAR'));


		// if starttime and end time the same then show no times!
		if( $this->start_date == $this->stop_date ){
			if (($this->start_time != $this->stop_time) && !($this->alldayevent())){
				echo $this->start_date . ',&nbsp;' . $this->start_time
				. '&nbsp;-&nbsp;' . $this->stop_time;
			} else {
				echo $this->start_date;
			}
		} else {
			// recurring events should have time related to recurrance not range of dates
			if ($this->start_time != $this->stop_time && !($this->reccurtype() > 0)) {
				echo JText::_('JEV_FROM') . '&nbsp;' . $this->start_date . '&nbsp;-&nbsp; '
				. $this->start_time . '<br />'
				. JText::_('JEV_TO') . '&nbsp;' . $this->stop_date . '&nbsp;-&nbsp;'
				. $this->stop_time . '<br/>';
			} else {
				echo JText::_('JEV_FROM') . '&nbsp;' . $this->start_date . '<br />'
				. JText::_('JEV_TO') . '&nbsp;' . $this->stop_date . '<br/>';
			}
		}

		if( $this->reccurtype() > 0 ){
			switch( $this->reccurtype() ){
				case '1': $reccur = JText::_('JEV_REP_WEEK');     break;
				case '2': $reccur = JText::_('JEV_REP_WEEK');     break;
				case '3': $reccur = JText::_('JEV_REP_MONTH');    break;
				case '4': $reccur = JText::_('JEV_REP_MONTH');    break;
				case '5': $reccur = JText::_('JEV_REP_YEAR');     break;
			}

			if( $this->reccurday() >= 0 || ($this->reccurtype()==1 || $this->reccurtype()==2)){
				$timeString = "";
				if ($this->start_time != $this->stop_time) {
					$timeString = $this->start_time."&nbsp;-&nbsp;".$this->stop_time."&nbsp;";
				}
				echo $timeString;

				if (intval($this->reccurday())<0){
					$event_start_date = strtotime($this->startDate()) ;
					$reccurday = intval(date( 'w',$event_start_date));
				}
				else $reccurday =$this->reccurday();
				if( $this->reccurtype() == 1 ){
					$dayname = JEventsHTML::getDayName( $reccurday );
					echo $dayname . '&nbsp;' . JText::_('JEV_EACHOF') . '&nbsp;' . $reccur;
				}else if($this->reccurtype() == 2 ){
					$each =  JText::_('JEV_EACH') . '&nbsp;';
					if ($grammar==1){
						$each = strtolower($each);
					}
					$daystring="";
					if (strlen($this->reccurweeks())==0){
						$days = explode("|",$this->reccurweekdays());
						for ($d=0;$d<count($days);$d++){
							$daystring .= JEventsHTML::getDayName( $days[$d] );
							$daystring .= ($d==0?",":"")."&nbsp;";
						}
						$weekstring="";
					}
					else {
						$days = explode("|",$this->reccurweekdays());
						for ($d=0;$d<count($days);$d++){
							$daystring .= JEventsHTML::getDayName( $days[$d] );
							$daystring .= ($d==0?",":"")."&nbsp;";
						}
						$weekstring = $this->reccurweeks() == 'pair' ? JText::_('JEV_REP_WEEKPAIR') : ( $this->reccurweeks() == 'impair' ? JText::_('JEV_REP_WEEKIMPAIR') : "" );
						if ($weekstring==""){
							switch ($grammar){
								case 1:
									$weekstring = "- ".JText::_('JEV_REP_WEEK')." ";
									$weekstring .= str_replace("|",", ",$this->reccurweeks())." ";
									$weekstring .= strtolower(JText::_('JEV_EACHMONTH'));
									break;
								default:
									$weekstring = str_replace("|",", ",$this->reccurweeks())." ";
									$weekstring .= $reccur;
									$weekstring .= JText::_('JEV_EACHMONTH');
									break;
							}
						}
					}
					$firstword=true;
					switch ($grammar){
						case 1:
							echo $daystring.$weekstring;
							break;
						default:
							echo $each.$daystring.$weekstring;
							break;
					}
				} else {
					echo JText::_('JEV_EACH') . '&nbsp;' . $reccur;
				}

			} else {
				echo JText::_('JEV_EACH') . '&nbsp;' . $reccur;
			}
		} else {
			if( $this->start_date != $this->stop_date ){
				echo JText::_('JEV_ALLDAYS');
			}
		}


	}

	function prevRepeat(){
		return "";
	}

	function nextRepeat(){
		return "";
	}


}