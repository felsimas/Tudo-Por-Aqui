<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/estabelecimentos/search.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/gerenciamento/estabelecimentos";
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
	$categories = db_getFromDB("listingcategory", "category_id", 0, "all", "title");
	$nameArray  = array();
	$valueArray = array();
	if ($categories) {
		foreach ($categories as $category) {
			if (LISTINGCATEGORY_SCALABILITY_OPTIMIZATION != "on") {
				$valueArray[] = "";
				$nameArray[]  = "--------------------------------------------------";
			}
			$valueArray[] = $category->getNumber("id");
			if ($category->getString("title".$langIndex)) $nameArray[] = $category->getString("title".$langIndex);
			else $nameArray[] = $category->getString("title");
			if (LISTINGCATEGORY_SCALABILITY_OPTIMIZATION != "on") {
				$subcategories = db_getFromDB("listingcategory", "category_id", $category->getNumber("id"), "all", "title");
				if ($subcategories) {
					foreach ($subcategories as $subcategory) {
						$valueArray[] = $subcategory->getNumber("id");
						if ($subcategory->getString("title".$langIndex)) $nameArray[] = " &raquo; ".$subcategory->getString("title".$langIndex);
						else $nameArray[] = " &raquo; ".$subcategory->getString("title");
						$subcategories2 = db_getFromDB("listingcategory", "category_id", $subcategory->getNumber("id"), "all", "title");
						if ($subcategories2) {
							foreach ($subcategories2 as $subcategory2) {
								$valueArray[] = $subcategory2->getNumber("id");
								if ($subcategory2->getString("title".$langIndex)) $nameArray[] = " &raquo;&raquo; ".$subcategory2->getString("title".$langIndex);
								else $nameArray[] = " &raquo;&raquo; ".$subcategory2->getString("title");
								$subcategories3 = db_getFromDB("listingcategory", "category_id", $subcategory2->getNumber("id"), "all", "title");
								if ($subcategories3) {
									foreach ($subcategories3 as $subcategory3) {
										$valueArray[] = $subcategory3->getNumber("id");
										if ($subcategory3->getString("title".$langIndex)) $nameArray[] = " &raquo;&raquo;&raquo; ".$subcategory3->getString("title".$langIndex);
										else $nameArray[] = " &raquo;&raquo;&raquo; ".$subcategory3->getString("title");
										$subcategories4 = db_getFromDB("listingcategory", "category_id", $subcategory3->getNumber("id"), "all", "title");
										if ($subcategories4) {
											foreach ($subcategories4 as $subcategory4) {
												$valueArray[] = $subcategory4->getNumber("id");
												if ($subcategory4->getString("title".$langIndex)) $nameArray[] = " &raquo;&raquo;&raquo;&raquo; ".$subcategory4->getString("title".$langIndex);
												else $nameArray[] = " &raquo;&raquo;&raquo;&raquo; ".$subcategory4->getString("title");
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
	if (LISTINGCATEGORY_SCALABILITY_OPTIMIZATION != "on") {
		$valueArray[] = "";
		$nameArray[] = "--------------------------------------------------";
	}
	$categoryDropDown = html_selectBox("search_category_id", $nameArray, $valueArray, $search_category_id, "", "class='input-dd-form-listing'", system_showText(LANG_SITEMGR_RESULTSPAGE_GENERAL));

	##################################################################################################################################
	# STATUS
	##################################################################################################################################
	$statusObj = new ItemStatus();
	$statusDropDown = html_selectBox("search_status", $statusObj->getNames(), $statusObj->getValues(), $search_status, "", "class='input-dd-form-searchlisting'", "-- ".system_showText(LANG_LABEL_SELECT_ALLSTATUS)." --");

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

	##################################################################################################################################
	# LISTING TEMPLATE
	##################################################################################################################################
	$listingTemplates = db_getFromDB("listingtemplate", "", 0, "all", "title");
	$listingTemplateDropDown = "<select name=\"search_listingtemplate_id\">";
	$listingTemplateDropDown .= "<option value=\"\"> ".system_showText(LANG_SITEMGR_LABEL_SELECT_LISTINGTEMPLATE)." </option>";
	$listingTemplateDropDown .= "<option value=\"D\"".(($search_listingtemplate_id == "D") ? " selected" : "").">".system_showText(LANG_SITEMGR_DEFAULT)."</option>";
	if ($listingTemplates) {
		foreach ($listingTemplates as $each_template) {
			$listingtemplate = new ListingTemplate($rowLT["id"]);
			$listingTemplateDropDown .= "<option value=\"".$each_template->getNumber("id")."\"";
			if ($search_listingtemplate_id == $each_template->getNumber("id"))
				$listingTemplateDropDown .= " selected";
			$listingTemplateDropDown .= ">".$each_template->getString("title")."</option>";
		}
	}
	$listingTemplateDropDown .= "</select>";
	##################################################################################################################################

	/************************************************
	* @desc Category auxiliar code
	************************************************/
	if($search_category_id) {
		$db = db_getDBObject();
		$sql = "SELECT id FROM Listing WHERE cat_1_id = '$search_category_id' OR parcat_1_level1_id = '$search_category_id' OR parcat_1_level2_id = '$search_category_id' OR parcat_1_level3_id = '$search_category_id' OR parcat_1_level4_id = '$search_category_id' OR cat_2_id = '$search_category_id' OR parcat_2_level1_id = '$search_category_id' OR parcat_2_level2_id = '$search_category_id' OR parcat_2_level3_id = '$search_category_id' OR parcat_2_level4_id = '$search_category_id' OR cat_3_id = '$search_category_id' OR parcat_3_level1_id = '$search_category_id' OR parcat_3_level2_id = '$search_category_id' OR parcat_3_level3_id = '$search_category_id' OR parcat_3_level4_id = '$search_category_id' OR cat_4_id = '$search_category_id' OR parcat_4_level1_id = '$search_category_id' OR parcat_4_level2_id = '$search_category_id' OR parcat_4_level3_id = '$search_category_id' OR parcat_4_level4_id = '$search_category_id' OR cat_5_id = '$search_category_id' OR parcat_5_level1_id = '$search_category_id' OR parcat_5_level2_id = '$search_category_id' OR parcat_5_level3_id = '$search_category_id' OR parcat_5_level4_id = '$search_category_id'";
		$rs = $db->query($sql);
		while ($row = mysql_fetch_assoc($rs)) $listing_ids_from_category[] = $row["id"];
		$category_listing_ids = ($listing_ids_from_category) ? implode(",",$listing_ids_from_category) : "'0'";
	}

	/************************************************
	* @desc DiscountCode auxiliar code
	************************************************/
	if($search_discount) {

		//Invoice
		$db = db_getDBObject();
		$sql  = "";
		$sql .= " SELECT ";
		$sql .= " listing_id ";
		$sql .= " FROM ";
		$sql .= " Invoice_Listing ";
		$sql .= " WHERE ";
		$sql .= " discount_id LIKE ".db_formatString($search_discount);
		$rs   = $db->query($sql);
		while ($row = mysql_fetch_assoc($rs)) $listing_ids_from_discount[] = $row["listing_id"];

		//Payment
		$db = db_getDBObject();
		$sql  = "";
		$sql .= " SELECT ";
		$sql .= " listing_id ";
		$sql .= " FROM ";
		$sql .= " Payment_Listing_Log ";
		$sql .= " WHERE ";
		$sql .= " discount_id LIKE ".db_formatString($search_discount);
		$rs   = $db->query($sql);
		while ($row = mysql_fetch_assoc($rs)) $listing_ids_from_discount[] = $row["listing_id"];

		//Listing
		$db = db_getDBObject();
		$sql  = "";
		$sql .= " SELECT ";
		$sql .= " id ";
		$sql .= " FROM ";
		$sql .= " Listing ";
		$sql .= " WHERE ";
		$sql .= " discount_id LIKE ".db_formatString($search_discount);
		$rs   = $db->query($sql);
		while ($row = mysql_fetch_assoc($rs)) $listing_ids_from_discount[] = $row["id"];

		/************************************************
		* @desc Removing the ids of listings that are not in the category, if the category filter is active
		************************************************/
		if ($search_category_id && count($listing_ids_from_discount) > 0) {
			if (count($listing_ids_from_category) > 0) {
				$tmparray = array();
				for ($i=0;$i<count($listing_ids_from_discount);$i++) {
					if (in_array($listing_ids_from_discount[$i], $listing_ids_from_category)) {
						$tmparray[] = $listing_ids_from_discount[$i];
					}
				}
				$listing_ids_from_discount = $tmparray;
				unset($tmparray);
			} else {
				$listing_ids_from_discount = "";
			}
		}

		$discount_listing_ids = ($listing_ids_from_discount) ? implode(",", $listing_ids_from_discount) : "'0'";

	}

	/************************************************
	* @desc Category and DiscountCode auxiliar code
	************************************************/
	if ($discount_listing_ids) {
		$search_listing_ids = $discount_listing_ids;
	} else if ($category_listing_ids) {
		$search_listing_ids = $category_listing_ids;
	}

	if ($search_title) $sql_where[] = " title LIKE '%".addslashes($search_title)."%' ";
	if ($search_no_owner==1) $sql_where[] = " account_id = 0 ";
	elseif ($search_account_id) $sql_where[] = " account_id = $search_account_id ";
	if ($search_level) $sql_where[] = " level = '$search_level' ";
	if ($search_status) $sql_where[] = " status = '$search_status' ";
	if ($search_listing_ids) $sql_where[] = " id IN ($search_listing_ids) "; //search_listing_ids
	if ($search_country) $sql_where[] = " estado_id = '$search_country' ";
	if ($search_state) $sql_where[] = " cidade_id = '$search_state' ";
	if ($search_region) $sql_where[] = " bairro_id = '$search_region' ";
	if ($search_zipcode) $sql_where[] = " zip_code LIKE '$search_zipcode' ";

	if ($search_days) {
		if (is_numeric($search_days) && $search_days > 0) {
			$sql_where[] = " renewal_date > NOW() AND renewal_date <= DATE_ADD(NOW(), INTERVAL $search_days DAY) ";
		} else {
			$error_message = system_showText(LANG_SITEMGR_MSGERROR_INVALIDDAYSTOEXPIRATION);
			$sql_where[] = " false ";
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

	if (strlen(trim($search_listingtemplate_id))>0) {
		if ($search_listingtemplate_id=="D") {
			$sql_where[] = " listingtemplate_id=0";
		} else {
			$sql_where[] = " listingtemplate_id=$search_listingtemplate_id";
		}
	}

	if ($sql_where) $where .= " ".implode(" AND ", $sql_where)." ";
	
	# ----------------------------------------------------------------------------------------------------
	# PAGE BROWSING
	# ----------------------------------------------------------------------------------------------------
	$_GET["search_page"] = "1";
	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));
	$paging_url = DEFAULT_URL."/gerenciamento/estabelecimentos/search.php";

	if ($search_submit) {
		$pageObj = new pageBrowsing("Listing", $screen, 10, "level DESC, title", "title", $letra, $where);
		$listings = $pageObj->retrievePage("object");
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
	include(SM_EDIRECTORY_ROOT."/layout/header_manager.php");
	

	$_GET = format_magicQuotes($_GET);
	extract($_GET);
	$_POST = format_magicQuotes($_POST);
	extract($_POST);
    

?>

	<div id="page-wrapper">

		<div id="main-wrapper">
		
		<?php 	include(SM_EDIRECTORY_ROOT."/menu.php"); ?>
		
			<div id="main-content"> 

				<div class="page-title ui-widget-content ui-corner-all">

					<div class="other_content">

			<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? include(INCLUDES_DIR."/tables/table_listing_submenu.php"); ?>

			<? if ($search_submit) { ?>
				<div id="header-form">
					<?=ucwords(system_showText(LANG_SITEMGR_RESULTS))?>
				</div>
				<? include(INCLUDES_DIR."/tables/table_paging.php"); ?>
				<? if ($listings) { ?>
					<? include(INCLUDES_DIR."/tables/table_listing.php"); ?>
				<? } else { ?>
					<p class="errorMessage"><?=system_showText(LANG_SITEMGR_NORESULTS)?></p>
				<? } ?>
			<? } ?>

			<div id="header-form">
				<?=ucwords(system_showText(LANG_SITEMGR_MENU_SEARCH))?>
			</div>

			<form name="listing" method="get">

				<? if ($error_message) echo "<p class=\"errorMessage\">".$error_message."</p>"; ?>

				<? include(INCLUDES_DIR."/forms/form_searchlisting.php"); ?>

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
			</div>
		</div>
	</div>
<div class="clearfix"></div>

<script language="javascript">
	<!--

	<? if (DEFAULT_DATE_FORMAT == "m/d/Y") { ?>
		
		var cal_expiration_date = new calendarmdy(document.forms['listing'].elements['search_expiration_date']);
	
	<? } elseif (DEFAULT_DATE_FORMAT == "d/m/Y") { ?>
		
		var cal_expiration_date = new calendardmy(document.forms['listing'].elements['search_expiration_date']);
	
	<? } ?>
	
	cal_expiration_date.year_scroll = true;
	cal_expiration_date.time_comp = false;

	//-->
</script>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
