<?

	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");


?>

	<?
	if ($listings) {
		//echo "<div id='resultsMap' name='resultsMapHere' class='resultsMap'>&nbsp;</div>";
	}
	?>
<div id='consulta'><h5><b><?php include(EDIRECTORY_ROOT."/frontend/paging.php") ; ?></b></h5>

		
		<?
	
		$user = true;
		$langIndex = language_getIndex(EDIR_LANGUAGE);
		$str_search = "";
		if ($keyword) $str_search .= " ".system_showText(LANG_SEARCHRESULTS_KEYWORD)." <strong>".$keyword."</strong>";
		if ($where) $str_search .= " ".system_showText(LANG_SEARCHRESULTS_WHERE)." <strong>".$where."</strong>";
		if ($template_id) {
			$search_template = new ListingTemplate($template_id);
			if ($search_template->getString("title")) {
				$str_search .= " ".system_showText(LANG_SEARCHRESULTS_TEMPLATE)." <strong>".$search_template->getString("title")."</strong>";
			}
		}
		if ($category_id) {
			$search_category = new ListingCategory($category_id);
			if ($search_category->getString("title".$langIndex)) {
				$str_search .= " ".system_showText(LANG_SEARCHRESULTS_INCATEGORY)." <strong>".$search_category->getString("title".$langIndex)."</strong>";
			}
		}
		if ($cidade_id || $bairro_id) $str_search.= " ".system_showText(LANG_SEARCHRESULTS_LOCATION)." ";
		if ($bairro_id) {
			$search_city = new LocationRegion($bairro_id);
			$str_search .= "<strong>".$search_city->getString("name")."</strong>";
		}
		if ($cidade_id && $bairro_id) $str_search.= ", ";
		if ($cidade_id) {
			$search_state = new LocationState($cidade_id);
			$str_search .= "<strong>".$search_state->getString("name")."</strong>";
		}
		if ($zip) {
			$str_search .= " ".system_showText(LANG_SEARCHRESULTS_ZIP)." ".ZIPCODE_LABEL." <strong>".$zip.(($dist)?(" (".$dist." ".ZIPCODE_UNIT_LABEL_PLURAL.")"):(""))."</strong>";
		}
		if (!$listings) {
			if ($search_lock) {
				echo "<p class=\"errorMessage\">".system_showText(LANG_MSG_LEASTONEPARAMETER)."</p>";
			} else {
				$db = db_getDBObject();
				if ($db->getRowCount("Listing") > 0) {
					if ($str_search) {
						?><h1><?=system_showText(LANG_SEARCHRESULTS)?> <?=$str_search?></h1><?
					}
					?><p class="errorMessage"><?=system_showText(LANG_MSG_NORESULTS);?> <?=system_showText(LANG_MSG_TRYAGAIN);?></p><?
					if ($keyword) {
						?><div class="response-msg inf ui-corner-all"><?=system_showText(LANG_MSG_USE_SPECIFIC_KEYWORD);?></div><?
					}
				} else {
					?><div class="response-msg inf ui-corner-all"><?=system_showText(LANG_MSG_NOLISTINGS);?></div><?
				}
			}
		} elseif ($listings) {
			$itemRSSSection = "listing";

			if ($str_search) {
				?><p class="titulodabusca"><?=system_showText(LANG_SEARCHRESULTS)?> <?=$str_search?></p><?
			}
			else{
				echo "<h1>".system_showText(system_highlightLastWord(LANG_MSG_LISTINGRESULTS));
				echo "<span class=\"resultadosInfo\">";
				//include(INCLUDES_DIR."/code/rss.php");
				echo "</span></h1>";
			}
			
			$level = new ListingLevel(EDIR_DEFAULT_LANGUAGE, true);
			$locationManager =& new LocationManager();
			$mapNumber = 1;
			foreach ($listings as $listing) {
				$listing->setLocationManager($locationManager);
				report_newRecord("listing", $listing->getString("id"), LISTING_REPORT_SUMMARY_VIEW);

		   	   include(INCLUDES_DIR."/views/view_listing_summary.php");
			
				if ((strlen(trim($listing->getLocationString("A", true))) > 0) || (strlen(trim($listing->getLocationString("s", true))) > 0) || (strlen(trim($listing->getLocationString("r", true))) > 0)) {
					$mapNumber++;
				}
			}
			echo "<div class=\"summaryBottom\"></div>";
			//include(EDIRECTORY_ROOT."/frontend/paging.php");
		}
		?>
		
		

		<div id='consulta_bottom'>
        <h5 class="bottom"><b><div><?php include(EDIRECTORY_ROOT."/frontend/paging_numbers.php") ; ?></div</b></h5>   

