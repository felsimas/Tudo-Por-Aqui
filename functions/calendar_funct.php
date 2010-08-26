<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /functions/calendar_funct.php
	# ----------------------------------------------------------------------------------------------------

	function cal_display_month($property_id = false, $this_date=false, $hilight="Y", $next_links="Y", $price_type="week", $link_all_days=false) {

		if (empty($this_date)) $this_date = date("Ymd"); 

		/////////////////////////////
		//build legend
		$bookedcolor = "#AAAAAA";
		$availablecolor = "#a8f3a5";

		///////////////////////////////////////////////
		echo "<div id=\"featured\">
			<div class=\"box-t1\">
				<div class=\"box-t2\">
					<div class=\"box-t3\"/>
					</div>
				</div>
			</div><div class=\"box-1\"><div class=\"box-2\"><div class=\"box-3\">";
		echo "<div class=\"baseCalendar\">";
			echo "<h4>".system_showText(LANG_BROWSEEVENTSBYDATE)."</h4>";
			for ($monthCount=0;$monthCount<1;$monthCount++){
				if ($next_date != "") {
					$this_date = $next_date;
				}
				# THIS MONTH
				$this_year = date("Y",strtotime($this_date));
				$this_month = date("m",strtotime($this_date));
				$this_day = date("d",strtotime($this_date));
				$this_month_txt = system_showDate("F",strtotime($this_date));
				if ($hilight=="N") { $this_day = ""; }
				# LAST MONTH
				$last_date = date("Ymd",mktime(0,0,0,(int)$this_month-1,1,(int)$this_year));
				# NEXT MONTH
				$next_date = date("Ymd",mktime(0,0,0,(int)$this_month+1,1,(int)$this_year));
				$fotm = mktime(0,0,0,(int)$this_month,1,(int)$this_year);
				$this_ndays = date("t",$fotm);
				$this_fdow  = date("w",$fotm);
				$this_month_txt = system_showDate("F",$fotm);
				$this_date = sprintf("%04s%02s%02s",$this_year,$this_month,1);
	
				echo "<table class=\"calendar\" border=\"0\" cellspacing=\"4\" cellpadding=\"0\" width=\"100%\"><tr>";

					# MONTH-YEAR HEADER
					echo "<td colspan=\"7\">";
						echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" class=\"calendarHeader\"><tr>";
							echo "<th align=\"left\">";
							if (($next_links == "Y" || $next_links == "L") && $monthCount==0 ) {
								echo "<a href=\"".EVENT_DEFAULT_URL."/results.php?month=".substr($last_date,0,6)."&amp;this_date=$last_date\">&laquo;</a>";
							} else {
								echo "&nbsp;&nbsp;&nbsp;&nbsp;";
							}
							echo "</th>";
							echo "<th>";
							echo "<a href=\"".EVENT_DEFAULT_URL."/results.php?month=$this_year$this_month&amp;this_date=$this_date\">$this_month_txt $this_year</a></th>";
							if (($next_links == "Y")) {
								echo "<th align=\"right\"><a href=\"".EVENT_DEFAULT_URL."/results.php?month=".substr($next_date,0,6)."&amp;this_date=$next_date\">&raquo;</a>";
							} else {
								echo "&nbsp;&nbsp;&nbsp;&nbsp;";
							}
							echo "</th>";
							echo "</tr></table>";

						echo "</td>";
					echo "</tr>";

					# WEEKDAY HEADERS
					$weekdays_list = explode(",", LANG_DATE_WEEKDAYS);
					echo "<tr>";
						for ($i=0;$i<count($weekdays_list);$i++) {
							echo "<th class=\"calendarWeekday\">".ucwords(substr($weekdays_list[$i], 0, 3))."</th>";
						}
					echo "</tr>";
	
				# DAYS OF MONTH
				echo "<tr>";
				for($this_dow=0; $this_dow<$this_fdow; $this_dow++) { echo "<td>&nbsp;</td>"; }
				for($i=1; $i<=$this_ndays; $i++) {
	
					$i = sprintf("%02s",$i);
					$this_date = sprintf("%04s%02s%02s",$this_year,$this_month,$i);
					if (++$this_dow == "8") {
						$this_dow = "1";
						echo "</tr><tr>";
					}
	
					/////////////////
					//AVAILABILITY change cell color
	
					$this_date_timestamp = strtotime($this_date);
	
					//first reset availability flag
					if ($this_date_timestamp == $a_end_date ){
						if ($row = mysql_fetch_row($a_rs)){;
							$a_start_date = strtotime($row[0]);
							$a_end_date = strtotime($row[1]);
							$a_available = $row[2];  
						}
					}
	
					echo "<td align=\"center\" width=\"22\" class=\"calendarDay\">";
	
					$new_date = $this_date;
	
					$current_year = date("Y");
					$current_month = date("m");
					$current_day = date("d");
					$current_month_txt = system_showDate("F");
	
					$current_yyyy_mm = $current_year.$current_month;
					$current_yyyy_mm_dd = $current_year.$current_month.$current_day;
	
						//not a check in day
						if (($_GET["this_date"]) && ($_GET["this_date"] == $this_date) && (!$_GET["month"]) && ($_GET["search_by_day"])) {
	
							$date_style = $i;
							$day_class = "selected";
	
						} elseif ((($_GET["month"] == $current_yyyy_mm) && ($current_yyyy_mm_dd == $this_date)) || (($current_yyyy_mm_dd == $this_date) && (!$_GET["month"]))) {
							$date_style = $i;
							$day_class = "today";
						} else {
							$date_style = $i;
							$day_class = "normal";
						}
	
						echo "<a href=\"javascript:set_cal_date('".$this_date."')\" class=\"$day_class\">".$date_style."</a>";
	
					echo "</td>";
				}
				for($i=$this_dow;$i<7;$i++) { echo "<td>&nbsp;</td>"; }
				echo "</tr></table>\n";
			}
		echo "</div>";
		echo "</div></div></div>";
		echo "<div class=\"box-b1\">
			<div class=\"box-b2\">
				<div class=\"box-b3\"/>
				</div>
			</div>
		</div></div><br/>";
	}

?>
