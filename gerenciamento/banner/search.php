<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/banner/search.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (BANNER_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	$_GET = format_magicQuotes($_GET);
	extract($_GET);
	$_POST = format_magicQuotes($_POST);
	extract($_POST);

	$url_redirect = "".DEFAULT_URL."/gerenciamento/banner";
	$url_base = "".DEFAULT_URL."/gerenciamento";
	$sitemgr = 1;

	# ----------------------------------------------------------------------------------------------------
	# FORM DEFINES
	# ----------------------------------------------------------------------------------------------------

	/**
	* Banner Type Drop Down
	****************************************************************************/
	$bannerObj  =& new Banner();

	$nameArray  = array();
	$valueArray = array();

	foreach($bannerObj->banner_types as $each_type => $each_value){

		$bannerLevelObj = new BannerLevel();
		$banner_size = "(".$bannerLevelObj->getWidth($each_value)."px x ".$bannerLevelObj->getHeight($each_value)."px)";

		$nameArray[]  = ucwords(str_replace("_"," ",$each_type))." ".$banner_size;
		$valueArray[] = $each_value;

	}

	$typeDropDown = html_selectBox("search_type", $nameArray, $valueArray, $search_type, "", "class='input-dd-form-searchbanner'", "-- ".system_showText(LANG_LABEL_SELECT_TYPE)." --");

	unset($bannerObj);

	/**
	* Category Drop Down
	****************************************************************************/
	$nameArray  = array();
	$valueArray = array();
	if ($search_section) {
		if ($search_section == "general") {
			$categoryDropDown = html_selectBox("search_category", $nameArray, $valueArray, $search_category, "id=\"search_category\" disabled", "class='input-dd-form-banner' style='width: 350px;'", system_showText(LANG_LABEL_SELECT_ALLPAGESBUTITEMPAGES));
		} else {
			if ($search_section == "listing") $tableCategory = "listingcategory";
			elseif ($search_section == "event") $tableCategory = "eventcategory";
			elseif ($search_section == "classified") $tableCategory = "classifiedcategory";
			elseif ($search_section == "article") $tableCategory = "articlecategory";
			$categories = db_getFromDB($tableCategory, "category_id", 0, "all", "title");
			if ($categories) {
				foreach ($categories as $category) {
					if (CATEGORY_SCALABILITY_OPTIMIZATION != "on") {
						$valueArray[]  = "";
						$nameArray[]   = "--------------------------------------------------";
					}
					$valueArray[]  = $category->getNumber("id");
					$nameArray[]   = $category->getString("title");
					if (CATEGORY_SCALABILITY_OPTIMIZATION != "on") {
						$subcategories = db_getFromDB($tableCategory, "category_id", $category->getNumber("id"), "all", "title");
						if ($subcategories) {
							foreach ($subcategories as $subcategory) {
								$valueArray[] = $subcategory->getNumber("id");
								$nameArray[]  = "- ".$subcategory->getString("title");
								$subcategories2 = db_getFromDB($tableCategory, "category_id", $subcategory->getNumber("id"), "all", "title");
								if ($subcategories2) {
									foreach ($subcategories2 as $subcategory2) {
										$valueArray[] = $subcategory2->getNumber("id");
										$nameArray[]  = "&nbsp;- ".$subcategory2->getString("title");
										$subcategories3 = db_getFromDB($tableCategory, "category_id", $subcategory2->getNumber("id"), "all", "title");
										if ($subcategories3) {
											foreach ($subcategories3 as $subcategory3) {
												$valueArray[] = $subcategory3->getNumber("id");
												$nameArray[]  = "&nbsp;&nbsp;- ".$subcategory3->getString("title");
												$subcategories4 = db_getFromDB($tableCategory, "category_id", $subcategory3->getNumber("id"), "all", "title");
												if ($subcategories4) {
													foreach ($subcategories4 as $subcategory4) {
														$valueArray[] = $subcategory4->getNumber("id");
														$nameArray[]  = "&nbsp;&nbsp;&nbsp;- ".$subcategory4->getString("title");
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
		}
	}
	if (CATEGORY_SCALABILITY_OPTIMIZATION != "on") {
		$valueArray[] = "";
		$nameArray[]  = "--------------------------------------------------";
	}
	$categoryDropDown = html_selectBox("search_category", $nameArray, $valueArray, $search_category, "id=\"search_category\"", "class='input-dd-form-banner' style='width:350px;'", system_showText(LANG_SITEMGR_LABEL_NONCATEGORYSEARCH));

	/**
	* Status Drop Down
	****************************************************************************/	
	$statusObj = new ItemStatus();
	$statusDropDown = html_selectBox("search_status", $statusObj->getNames(), $statusObj->getValues(), $search_status, "", "class='input-dd-form-searchbanner'", "-- ".system_showText(LANG_SITEMGR_SELECTASTATUS)." --");

	/************************************************
	* @desc Category auxiliar code
	*************************************************/
	if($search_category_id) {
		$db = db_getDBObject();
		$sql = "SELECT id FROM Banner WHERE category_id = '$search_category_id'";
		$rs = $db->query($sql);
		while($row = mysql_fetch_assoc($rs)) $banner_ids_from_category[] = $row["id"];
		$category_banner_ids = ($banner_ids_from_category) ? implode(",",$banner_ids_from_category) : "'0'";
	}
	
	/************************************************
	* @desc DiscountCode auxiliar code
	************************************************/
	if($search_discount) {
		
		//Invoice
		$db = db_getDBObject();
		$sql  = "";
		$sql .= " SELECT ";
		$sql .= " banner_id ";
		$sql .= " FROM ";
		$sql .= " Invoice_Banner ";
		$sql .= " WHERE ";
		$sql .= " discount_id LIKE ".db_formatString($search_discount);
		$rs   = $db->query($sql);
		while ($row = mysql_fetch_assoc($rs)) $banner_ids_from_discount[] = $row["banner_id"];
		
		//Payment
		$db = db_getDBObject();
		$sql = "";
		$sql .= " SELECT ";
		$sql .= " banner_id ";
		$sql .= " FROM ";
		$sql .= " Payment_Banner_Log ";
		$sql .= " WHERE ";
		$sql .= " discount_id LIKE ".db_formatString($search_discount);
		$rs   = $db->query($sql);
		while ($row = mysql_fetch_assoc($rs)) $banner_ids_from_discount[] = $row["banner_id"];
		
		//Banner
		$db = db_getDBObject();
		$sql = "";
		$sql .= " SELECT ";
		$sql .= " id ";
		$sql .= " FROM ";
		$sql .= " Banner ";
		$sql .= " WHERE ";
		$sql .= " discount_id LIKE ".db_formatString($search_discount);
		$rs   = $db->query($sql);
		while ($row = mysql_fetch_assoc($rs)) $banner_ids_from_discount[] = $row["id"];
		
		/************************************************
		* @desc Removing the ids of banners that are not in the category, if the category filter is active
		************************************************/
		if ($search_category_id && count($banner_ids_from_discount) > 0) {
			if (count($banner_ids_from_category) > 0) {
				$tmparray = array();
				for ($i=0;$i<count($banner_ids_from_discount);$i++) {
					if (in_array($banner_ids_from_discount[$i], $banner_ids_from_category)) {
						$tmparray[] = $banner_ids_from_discount[$i];
					}
				}
				$banner_ids_from_discount = $tmparray;
				unset($tmparray);
			} else {
				$banner_ids_from_discount = "";
			}
		}
		
		$discount_banner_ids = ($banner_ids_from_discount) ? implode(",", $banner_ids_from_discount) : "'0'";
		
	}
	
	/************************************************
	* @desc Category and DiscountCode auxiliar code
	************************************************/
	
	if ($discount_banner_ids) {
		$search_banner_ids = $discount_banner_ids;
	} else if ($category_banner_ids) {
		$search_banner_ids = $category_banner_ids;
	}

	if ($search_caption) $sql_where[] = " caption LIKE ".db_formatString('%'.$search_caption.'%')." ";
	if ($search_no_owner==1) $sql_where[] = " account_id = 0 ";
	elseif ($search_account_id) $sql_where[] = " account_id = $search_account_id ";
	if ($search_section) $sql_where[] = " section = ".db_formatString($search_section);
	if ($search_category)			$sql_where[] = " category_id = ".db_formatNumber($search_category);
	if ($search_banner_ids)			$sql_where[] = " id IN ($search_banner_ids) "; // search_banner_ids
	if ($search_type) $sql_where[] = " type = '$search_type' ";
	if ($search_status) $sql_where[] = " status = '$search_status' ";

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

	if ($search_category_id) $sql_where[] = " id IN ($category_banner_ids) ";

	if ($sql_where) $where .= " ".implode(" AND ", $sql_where)." ";
	
	# ----------------------------------------------------------------------------------------------------
	# PAGE BROWSING
	# ----------------------------------------------------------------------------------------------------
	$_GET["search_page"] = "1";
	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	$paging_url = DEFAULT_URL."/gerenciamento/banner/search.php";

	if ($search_submit) {
		$pageObj = new pageBrowsing("Banner", $screen, 10, "type, caption","caption", $letra, $where);
		$banners = $pageObj->retrievePage("array");
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
<script language="javascript">
<!--
function searchResetBanner(form) {
	tot = form.elements.length;
	for (i=0;i<tot;i++) {
		if (form.elements[i].type == 'text') {
			form.elements[i].value = "";
		} else if (form.elements[i].type == 'checkbox' || form.elements[i].type == 'radio') {
			form.elements[i].checked = false;
		} else if (form.elements[i].type == 'select-one') {
			form.elements[i].selectedIndex = 0;
		}
	}
	fillBannerCategorySelect('<?=DEFAULT_URL?>', form.search_category, "", form);
	form.search_category.length = 0;
	form.search_category.disabled = false;
	form.search_category.options[0] = new Option(system_showText(LANG_SITEMGR_LABEL_NONCATEGORYSEARCH),"");
	form.search_category.options[1] = new Option("--------------------------------------------------","");
}
-->
</script>
<div id="page-wrapper">

	<div id="main-wrapper">

	<?php 	include(SM_EDIRECTORY_ROOT."/menu.php"); ?>

		<div id="main-content"> 

			<div class="page-title ui-widget-content ui-corner-all">

				<div class="other_content">

		<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

		<? include(INCLUDES_DIR."/tables/table_banner_submenu.php"); ?>

		<? if ($search_submit) { ?>
			<div id="header-form">
				<?=ucwords(system_showText(LANG_SITEMGR_RESULTS))?>
			</div>
			<? include(INCLUDES_DIR."/tables/table_paging.php"); ?>
			<? if ($banners) { ?>
				<? include(INCLUDES_DIR."/tables/table_banner.php"); ?>
			<? } else { ?>
				<p class="errorMessage"><?=system_showText(LANG_SITEMGR_NORESULTS)?></p>
			<? } ?>
		<? } ?>

		<div id="header-form">
			<?=ucwords(system_showText(LANG_SITEMGR_SEARCH))?>
		</div>

		<form name="banner" method="get">
			<? if ($error_message) echo "<p class=\"errorMessage\">".$error_message."</p>"; ?>
			<? include(INCLUDES_DIR."/forms/form_searchbanner.php"); ?>
				<table style="margin: 0 auto 0 auto;">
				<tr>
					<td>
						<button type="submit" name="search_submit" value="Search" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SEARCH)?></button>
					</td>
					<td>
						<button type="button" onclick="emptySearchAccount();searchResetBanner(this.form);" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_CLEAR)?></button>
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
		
		var cal_expiration_date = new calendarmdy(document.forms['banner'].elements['search_expiration_date']);
	
	<? } elseif (DEFAULT_DATE_FORMAT == "d/m/Y") { ?>
		
		var cal_expiration_date = new calendardmy(document.forms['banner'].elements['search_expiration_date']);
	
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