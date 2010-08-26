<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/article/search.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (ARTICLE_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/gerenciamento/article";
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
	$categories = db_getFromDB("articlecategory", "category_id", 0, "all", "title");
	$nameArray  = array();
	$valueArray = array();
	if ($categories) {
		foreach ($categories as $category) {
			if (ARTICLECATEGORY_SCALABILITY_OPTIMIZATION != "on") {
				$valueArray[] = "";
				$nameArray[]  = "--------------------------------------------------";
			}
			$valueArray[] = $category->getNumber("id");
			if ($category->getString("title".$langIndex)) $nameArray[] = $category->getString("title".$langIndex);
			else $nameArray[] = $category->getString("title");
			if (ARTICLECATEGORY_SCALABILITY_OPTIMIZATION != "on") {
				$subcategories = db_getFromDB("articlecategory", "category_id", $category->getNumber("id"), "all", "title");
				if ($subcategories) {
					foreach ($subcategories as $subcategory) {
						$valueArray[] = $subcategory->getNumber("id");
						if ($subcategory->getString("title".$langIndex)) $nameArray[] = " &raquo; ".$subcategory->getString("title".$langIndex);
						else $nameArray[] = " &raquo; ".$subcategory->getString("title");
						$subcategories2 = db_getFromDB("articlecategory", "category_id", $subcategory->getNumber("id"), "all", "title");
						if ($subcategories2) {
							foreach ($subcategories2 as $subcategory2) {
								$valueArray[] = $subcategory2->getNumber("id");
								if ($subcategory2->getString("title".$langIndex)) $nameArray[] = " &raquo;&raquo; ".$subcategory2->getString("title".$langIndex);
								else $nameArray[] = " &raquo;&raquo; ".$subcategory2->getString("title");
								$subcategories3 = db_getFromDB("articlecategory", "category_id", $subcategory2->getNumber("id"), "all", "title");
								if ($subcategories3) {
									foreach ($subcategories3 as $subcategory3) {
										$valueArray[] = $subcategory3->getNumber("id");
										if ($subcategory3->getString("title".$langIndex)) $nameArray[] = " &raquo;&raquo;&raquo; ".$subcategory3->getString("title".$langIndex);
										else $nameArray[] = " &raquo;&raquo;&raquo; ".$subcategory3->getString("title");
										$subcategories4 = db_getFromDB("articlecategory", "category_id", $subcategory3->getNumber("id"), "all", "title");
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
	if (ARTICLECATEGORY_SCALABILITY_OPTIMIZATION != "on") {
		$valueArray[] = "";
		$nameArray[] = "--------------------------------------------------";
	}
	$categoryDropDown = html_selectBox("search_category_id", $nameArray, $valueArray, $search_category_id, "", "class='input-dd-form-article'", "-- ".system_showText(LANG_LABEL_SELECT_ALLCATEGORIES)." --");

	##################################################################################################################################
	# STATUS
	##################################################################################################################################
	$statusObj = new ItemStatus();
	$statusDropDown = html_selectBox("search_status", $statusObj->getNames(), $statusObj->getValues(), $search_status, "", "class='input-dd-form-searcharticle'", "-- ".system_showText(LANG_LABEL_SELECT_ALLSTATUS)." --");

	/************************************************
	* @desc Category auxiliar code
	*************************************************/
	if($search_category_id) {
		$db = db_getDBObject();
		$sql = "SELECT id FROM Article WHERE cat_1_id = '$search_category_id' OR parcat_1_level1_id = '$search_category_id' OR cat_2_id = '$search_category_id' OR parcat_2_level1_id = '$search_category_id' OR cat_3_id = '$search_category_id' OR parcat_3_level1_id = '$search_category_id' OR cat_4_id = '$search_category_id' OR parcat_4_level1_id = '$search_category_id' OR cat_5_id = '$search_category_id' OR parcat_5_level1_id = '$search_category_id'";
		$rs = $db->query($sql);
		while ($row = mysql_fetch_assoc($rs)) $article_ids_from_category[] = $row["id"];
		$category_article_ids = ($article_ids_from_category) ? implode(",",$article_ids_from_category) : "'0'";
	}
	
	/************************************************
	* @desc DiscountCode auxiliar code
	************************************************/
	if($search_discount) {
		
		//Invoice
		$db = db_getDBObject();
		$sql  = "";
		$sql .= " SELECT ";
		$sql .= " article_id ";
		$sql .= " FROM ";
		$sql .= " Invoice_Article ";
		$sql .= " WHERE ";
		$sql .= " discount_id LIKE ".db_formatString($search_discount);
		$rs   = $db->query($sql);
		while ($row = mysql_fetch_assoc($rs)) $article_ids_from_discount[] = $row["article_id"];
		
		//Payment
		$db = db_getDBObject();
		$sql = "";
		$sql .= " SELECT ";
		$sql .= " article_id ";
		$sql .= " FROM ";
		$sql .= " Payment_Article_Log ";
		$sql .= " WHERE ";
		$sql .= " discount_id LIKE ".db_formatString($search_discount);
		$rs   = $db->query($sql);
		while ($row = mysql_fetch_assoc($rs)) $article_ids_from_discount[] = $row["article_id"];
		
		//Article
		$db = db_getDBObject();
		$sql = "";
		$sql .= " SELECT ";
		$sql .= " id ";
		$sql .= " FROM ";
		$sql .= " Article ";
		$sql .= " WHERE ";
		$sql .= " discount_id LIKE ".db_formatString($search_discount);
		$rs   = $db->query($sql);
		while ($row = mysql_fetch_assoc($rs)) $article_ids_from_discount[] = $row["id"];
		
		/************************************************
		* @desc Removing the ids of articles that are not in the category, if the category filter is active
		************************************************/
		if ($search_category_id && count($article_ids_from_discount) > 0) {
			if (count($article_ids_from_category) > 0) {
				$tmparray = array();
				for ($i=0;$i<count($article_ids_from_discount);$i++) {
					if (in_array($article_ids_from_discount[$i], $article_ids_from_category)) {
						$tmparray[] = $article_ids_from_discount[$i];
					}
				}
				$article_ids_from_discount = $tmparray;
				unset($tmparray);
			} else {
				$article_ids_from_discount = "";
			}
		}
		
		$discount_article_ids = ($article_ids_from_discount) ? implode(",", $article_ids_from_discount) : "'0'";
		
	}
	
	/************************************************
	* @desc Category and DiscountCode auxiliar code
	************************************************/
	if ($discount_article_ids) {
		$search_article_ids = $discount_article_ids;
	} else if ($category_article_ids) {
		$search_article_ids = $category_article_ids;
	}

	if ($search_title) $sql_where[] = " title LIKE '%".addslashes($search_title)."%' ";
	if ($search_no_owner==1) $sql_where[] = " account_id = 0 ";
	elseif ($search_account_id) $sql_where[] = " account_id = $search_account_id ";
	if ($search_level) $sql_where[] = " level = '$search_level' ";
	if ($search_status) $sql_where[] = " status = '$search_status' ";
	if ($search_article_ids) $sql_where[] = " id IN ($search_article_ids) "; // search_article_ids

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

	$paging_url = DEFAULT_URL."/gerenciamento/article/search.php";

	if ($search_submit) {
		$pageObj = new pageBrowsing("Article", $screen, 10, "level DESC, title, renewal_date", "title", $letra, $where);
		$articles = $pageObj->retrievePage("object");
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
			<h1><?=ucwords(system_showText(LANG_SITEMGR_MENU_SEARCH))?> <?=system_showText(LANG_SITEMGR_NAVBAR_ARTICLE)?></h1>
		</div>
	</div>

	<div id="content-content">

		<div class="default-margin" style="padding-top:3px;">

			<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? include(INCLUDES_DIR."/tables/table_article_submenu.php"); ?>

			<br />

			<? if ($search_submit) { ?>
				<div id="header-form">
					<?=ucwords(system_showText(LANG_SITEMGR_RESULTS))?>
				</div>
				<? include(INCLUDES_DIR."/tables/table_paging.php"); ?>
				<? if ($articles) { ?>
					<? include(INCLUDES_DIR."/tables/table_article.php"); ?>
				<? } else { ?>
					<p class="errorMessage"><?=system_showText(LANG_SITEMGR_NORESULTS)?></p>
				<? } ?>
			<? } ?>

			<div id="header-form">
				<?=system_showText(LANG_SITEMGR_SEARCH)?>
			</div>

			<form name="article" method="get">

				<? if ($error_message) echo "<p class=\"errorMessage\">".$error_message."</p>"; ?>

				<? include(INCLUDES_DIR."/forms/form_searcharticle.php"); ?>

				<table style="margin: 0 auto 0 auto;">
					<tr>
						<td>
							<button type="submit" name="search_submit" value="Search" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SEARCH)?></button>
						</td>
						<td>
							<button type="button" value="Clear" onclick="emptySearchAccount(); searchResetSitemgr(this.form);" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_CLEAR)?></button>
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
		
		var cal_expiration_date = new calendarmdy(document.forms['article'].elements['search_expiration_date']);
	
	<? } elseif (DEFAULT_DATE_FORMAT == "d/m/Y") { ?>
		
		var cal_expiration_date = new calendardmy(document.forms['article'].elements['search_expiration_date']);
	
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
