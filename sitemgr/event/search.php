<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/event/search.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (EVENT_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/gerenciamento/event";
	$url_base = "".DEFAULT_URL."/gerenciamento";
	$sitemgr = 1;

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	$_GET = format_magicQuotes($_GET);
	extract($_GET);
	$_POST = format_magicQuotes($_POST);
	extract($_POST);

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------

	##################################################################################################################################
	# CATEGORY
	##################################################################################################################################
	$langIndex = language_getIndex(EDIR_LANGUAGE);
	$categories = db_getFromDB("eventcategory", "category_id", 0, "all", "title");
	$nameArray  = array();
	$valueArray = array();
	if ($categories) {
		foreach ($categories as $category) {
			if (EVENTCATEGORY_SCALABILITY_OPTIMIZATION != "on") {
				$valueArray[] = "";
				$nameArray[]  = "--------------------------------------------------";
			}
			$valueArray[] = $category->getNumber("id");
			if ($category->getString("title".$langIndex)) $nameArray[] = $category->getString("title".$langIndex);
			else $nameArray[] = $category->getString("title");
			if (EVENTCATEGORY_SCALABILITY_OPTIMIZATION != "on") {
				$subcategories = db_getFromDB("eventcategory", "category_id", $category->getNumber("id"), "all", "title");
				if ($subcategories) {
					foreach ($subcategories as $subcategory) {
						$valueArray[] = $subcategory->getNumber("id");
						if ($subcategory->getString("title".$langIndex)) $nameArray[] = " &raquo; ".$subcategory->getString("title".$langIndex);
						else $nameArray[] = " &raquo; ".$subcategory->getString("title");
					}
				}
			}
		}
	}
	if (EVENTCATEGORY_SCALABILITY_OPTIMIZATION != "on") {
		$valueArray[] = "";
		$nameArray[]  = "--------------------------------------------------";
	}
	$categoryDropDown = html_selectBox("search_category_id", $nameArray, $valueArray, $search_category_id, "", "class='input-dd-form-searchevent'", "-- ".system_showText(LANG_LABEL_SELECT_ALLCATEGORIES)." --");

	##################################################################################################################################
	# STATUS
	##################################################################################################################################
	$statusObj = new ItemStatus();
	$statusDropDown = html_selectBox("search_status", $statusObj->getNames(), $statusObj->getValues(), $search_status, "", "class='input-dd-form-searchevent'", "-- ".system_showText(LANG_LABEL_SELECT_ALLSTATUS)." --");

	##################################################################################################################################
	# LOCATION
	##################################################################################################################################
	$countryObj = new LocationCountry();
	$countries  = $countryObj->retrieveAllCountries();
	if ($search_country) {
		$stateObj = new LocationState();
		$stateObj->SetString("estado_id", $search_country);
		$selected_states = $stateObj->retrieveStatesByCountry();
	}
	if ($search_state) {
		$regionObj = new LocationRegion();
		$regionObj->SetString("cidade_id", $search_state);
		$selected_regions = $regionObj->retrieveRegionsByState();
	}
	if ($search_region) {
		$cityObj = new LocationCity();
		$cityObj->SetString("bairro_id", $search_region);
		$selected_cities = $cityObj->retrieveCitiesByRegion();
	}
	if ($city_id) {
		$areaObj = new LocationArea();
		$areaObj->SetString("city_id", $city_id);
		$selected_areas = $areaObj->retrieveAreasByCity();
	}
	$selected_country = ($search_country) ? new LocationCountry($search_country) : FALSE;
	$selected_state   = ($search_state)   ? new LocationState($search_state)     : FALSE;
	$selected_region  = ($search_region)  ? new LocationRegion($search_region)   : FALSE;
	##################################################################################################################################

	/************************************************
	* @desc Category auxiliar code
	*************************************************/
	if($search_category_id) {
		$db = db_getDBObject();
		$sql = "SELECT id FROM Event WHERE cat_1_id = '$search_category_id' OR parcat_1_level1_id = '$search_category_id' OR cat_2_id = '$search_category_id' OR parcat_2_level1_id = '$search_category_id' OR cat_3_id = '$search_category_id' OR parcat_3_level1_id = '$search_category_id' OR cat_4_id = '$search_category_id' OR parcat_4_level1_id = '$search_category_id' OR cat_5_id = '$search_category_id' OR parcat_5_level1_id = '$search_category_id'";
		$rs = $db->query($sql);
		while ($row = mysql_fetch_assoc($rs)) $event_ids_from_category[] = $row["id"];
		$category_event_ids = ($event_ids_from_category) ? implode(",",$event_ids_from_category) : "'0'";
	}

	/************************************************
	* @desc DiscountCode auxiliar code
	************************************************/
	if($search_discount) {

		//Invoice
		$db = db_getDBObject();
		$sql  = "";
		$sql .= " SELECT ";
		$sql .= " event_id ";
		$sql .= " FROM ";
		$sql .= " Invoice_Event ";
		$sql .= " WHERE ";
		$sql .= " discount_id LIKE ".db_formatString($search_discount);
		$rs   = $db->query($sql);
		while ($row = mysql_fetch_assoc($rs)) $event_ids_from_discount[] = $row["event_id"];

		//Payment
		$db = db_getDBObject();
		$sql = "";
		$sql .= " SELECT ";
		$sql .= " event_id ";
		$sql .= " FROM ";
		$sql .= " Payment_Event_Log ";
		$sql .= " WHERE ";
		$sql .= " discount_id LIKE ".db_formatString($search_discount);
		$rs   = $db->query($sql);
		while ($row = mysql_fetch_assoc($rs)) $event_ids_from_discount[] = $row["event_id"];

		//Event
		$db = db_getDBObject();
		$sql  = "";
		$sql .= " SELECT ";
		$sql .= " id ";
		$sql .= " FROM ";
		$sql .= " Event ";
		$sql .= " WHERE ";
		$sql .= " discount_id LIKE ".db_formatString($search_discount);
		$rs   = $db->query($sql);
		while ($row = mysql_fetch_assoc($rs)) $event_ids_from_discount[] = $row["id"];

		/************************************************
		* @desc Removing the ids of events that are not in the category, if the category filter is active
		************************************************/
		if ($search_category_id && count($event_ids_from_discount) > 0) {
			if (count($event_ids_from_category) > 0) {
				$tmparray = array();
				for ($i=0;$i<count($event_ids_from_discount);$i++) {
					if (in_array($event_ids_from_discount[$i], $event_ids_from_category)) {
						$tmparray[] = $event_ids_from_discount[$i];
					}
				}
				$event_ids_from_discount = $tmparray;
				unset($tmparray);
			} else {
				$event_ids_from_discount = "";
			}
		}

		$discount_event_ids = ($event_ids_from_discount) ? implode(",", $event_ids_from_discount) : "'0'";

	}
	// -------------------------------------------

	/************************************************
	* @desc Category and DiscountCode auxiliar code
	************************************************/
	if ($discount_event_ids) {
		$search_event_ids = $discount_event_ids;
	} else if ($category_event_ids) {
		$search_event_ids = $category_event_ids;
	}

	if ($search_title) $sql_where[] = " title LIKE '%".addslashes($search_title)."%' ";
	if ($search_no_owner==1) $sql_where[] = " account_id = 0 ";
	elseif ($search_account_id) $sql_where[] = " account_id = $search_account_id ";
	if ($search_status) $sql_where[] = " status = '$search_status' ";
	if ($search_event_ids) $sql_where[] = " id IN ($search_event_ids) "; // search_event_ids
	if ($search_country) $sql_where[] = " estado_id = '$search_country' ";
	if ($search_state) $sql_where[] = " cidade_id = '$search_state' ";
	if ($search_region) $sql_where[] = " bairro_id = '$search_region' ";
	if ($search_zipcode) $sql_where[] = " zip_code LIKE '$search_zipcode' ";

	// Date Range
	if ((isset($search_date_period1) && $search_date_period1 != "") && (isset($search_date_period2) && $search_date_period2 != "")) {

		if (!validate_date($search_date_period1) || !validate_date($search_date_period2)) {
			$error_message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_DATERANGE);
			$sql_where[]   = " false ";
		} elseif (!validate_date_interval($search_date_period1, $search_date_period2) && ($search_date_period1 != $search_date_period2)) {
			$error_message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_DATERANGE);
			$sql_where[]   = " false ";
		}

		$where_period  = "((start_date <= ".db_formatDate($search_date_period2)." AND end_date >= ".db_formatDate($search_date_period1).") AND (";
		$where_period .= "(start_date <= ".db_formatDate($search_date_period1)." AND end_date >= ".db_formatDate($search_date_period2).") ";
		$where_period .= "OR (start_date >= ".db_formatDate($search_date_period1)." AND end_date >= ".db_formatDate($search_date_period2).") ";
		$where_period .= "OR (start_date >= ".db_formatDate($search_date_period1)." AND end_date <= ".db_formatDate($search_date_period2).") ";
		$where_period .= "OR (start_date <= ".db_formatDate($search_date_period1)." AND end_date >= ".db_formatDate($search_date_period2).") ";
		$where_period .= "OR (start_date <= ".db_formatDate($search_date_period1)." AND end_date <= ".db_formatDate($search_date_period2).") ";
		$where_period .= "))";

		$sql_where[] = $where_period;

	} else if ((isset($search_date_period1) && $search_date_period1 != "") || (isset($search_date_period2) && $search_date_period2 != "")) {

		if (isset($search_date_period1) && $search_date_period1 != "") {
			if (validate_date($search_date_period1)) {
				$sql_where[] = " start_date >= ".db_formatDate($search_date_period1);
			} else {
				$error_message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_STARTDATE);
				$sql_where[] = " false ";
			}
		} else if (isset($search_date_period2) && $search_date_period2 != "") {
			if (validate_date($search_date_period2)) {
				$sql_where[] = " end_date <= ".db_formatDate($search_date_period2);
			} else {
				$error_message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_ENDDATE);
				$sql_where[] = " false ";
			}
		}

	}

	// Expiration Date
	if (isset($search_expiration_date) && $search_expiration_date != "") {
		if (validate_date_future($search_expiration_date)) {
			if ($search_opt_expiration_date == 1) {
				$sql_where[] = " renewal_date = ".db_formatDate($search_expiration_date);
			} else if ($search_opt_expiration_date == 2) {
				$sql_where[] = " (renewal_date >= NOW() AND TO_DAYS(renewal_date) <= TO_DAYS(".db_formatDate($search_expiration_date)."))";
			}
		} else {
			$error_message = system_showText(LANG_SITEMGR_MSGERROR_RENEWALDATE_INFUTURE);
			$sql_where[] = " false ";
		}
	}

	if ($sql_where) $where .= " ".implode(" AND ", $sql_where)." ";
	
	# ----------------------------------------------------------------------------------------------------
	# PAGE BROWSING
	# ----------------------------------------------------------------------------------------------------
	$_GET["search_page"] = "1";
	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	$paging_url = DEFAULT_URL."/gerenciamento/event/search.php";

	if ($search_submit) {
		$pageObj = new pageBrowsing("Event", $screen, 10, "level DESC, title,  renewal_date","title", $letra, $where);
		$events = $pageObj->retrievePage("object");
		// Letters Menu
		$letras = $pageObj->getString("letras");
		foreach ($letras as $each_letra) {
			if ($each_letra == "#") {
				$letras_menu .= "<a href=\"$paging_url".(($url_search_params) ? "?$url_search_params" : "")."\" ".((!$letra) ? "class=\"firstLetter\"" : "" ).">".strtoupper($each_letra)."</a>";
			} else {
				$letras_menu .= "<a href=\"$paging_url?letra=".$each_letra.(($url_search_params) ? "&$url_search_params" : "")."\" ".(($each_letra == $letra) ? "style=\"color:#EF413D\"" : "" ).">".strtoupper($each_letra)."</a>";
			}
		}
		# PAGES DROP DOWN ----------------------------------------------------------------------------------------------
		$pagesDropDown = $pageObj->getPagesDropDown($_GET, $paging_url, $screen, system_showText(LANG_SITEMGR_PAGING_GOTOPAGE)." ", "this.form.submit();");
	}

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

	$_GET = format_magicQuotes($_GET);
	extract($_GET);
	$_POST = format_magicQuotes($_POST);
	extract($_POST);


?>

<div id="main-right">

	<div id="top-content">
		<div id="header-content">
			<h1><?=ucwords(system_showText(LANG_SITEMGR_MENU_SEARCH))?> <?=system_showText(LANG_SITEMGR_NAVBAR_EVENT)?></h1>
		</div>
	</div>

	<div id="content-content">

		<div class="default-margin" style="padding-top:3px;">

			<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? include(INCLUDES_DIR."/tables/table_event_submenu.php"); ?>

			<br />

			<? if ($search_submit) { ?>
				<div id="header-form">
					<?=ucwords(system_showText(LANG_SITEMGR_RESULTS))?>
				</div>
				<? include(INCLUDES_DIR."/tables/table_paging.php"); ?>
				<? if ($events) { ?>
					<? include(INCLUDES_DIR."/tables/table_event.php"); ?>
				<? } else { ?>
					<p class="errorMessage"><?=system_showText(LANG_SITEMGR_NORESULTS)?></p>
				<? } ?>
			<? } ?>

			<div id="header-form">
				<?=ucwords(system_showText(LANG_SITEMGR_SEARCH))?>
			</div>

			<form name="searchEvent" method="get">

				<? if ($error_message) echo "<p class=\"errorMessage\">".$error_message."</p>"; ?>

				<? include(INCLUDES_DIR."/forms/form_searchevent.php"); ?>

				<table style="margin: 0 auto 0 auto;">
					<tr>
						<td>
							<button type="submit" name="search_submit" value="Search" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SEARCH)?></button>
						</td>
						<td>
							<button type="button" onclick="emptySearchAccount(); searchResetSitemgr(this.form);" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_CLEAR)?></button>
						</td>
					</tr>
				</table>

			</form>

		</div>

	</div>

	<div id="bottom-content">
		&nbsp;
	</div>

</div>

<script language="javascript">
	<!--

	<? if (DEFAULT_DATE_FORMAT == "m/d/Y") { ?>
		
		var cal_expiration_date = new calendarmdy(document.forms['searchEvent'].elements['search_expiration_date']);
		var cal_date_period1 	= new calendarmdy(document.forms['searchEvent'].elements['search_date_period1']);
		var cal_date_period2 	= new calendarmdy(document.forms['searchEvent'].elements['search_date_period2']);
		
	<? } elseif (DEFAULT_DATE_FORMAT == "d/m/Y") { ?>
		
		var cal_expiration_date = new calendardmy(document.forms['searchEvent'].elements['search_expiration_date']);
		var cal_date_period1 	= new calendardmy(document.forms['searchEvent'].elements['search_date_period1']);
		var cal_date_period2 	= new calendardmy(document.forms['searchEvent'].elements['search_date_period2']);
	
	<? } ?>
	
	cal_expiration_date.year_scroll = true;
	cal_expiration_date.time_comp = false;
	
	cal_date_period1.year_scroll = true;
	cal_date_period1.time_comp = false;
	
	cal_date_period2.year_scroll = true;
	cal_date_period2.time_comp = false;
	
	//-->
</script>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
