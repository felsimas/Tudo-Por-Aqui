<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/transactions/search.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (PAYMENT_FEATURE != "on") { exit; }
	if ((CREDITCARDPAYMENT_FEATURE != "on") && (MANUALPAYMENT_FEATURE != "on")) { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/gerenciamento/transactions";
	$url_base = "".DEFAULT_URL."/gerenciamento";

	extract($_GET);
	extract($_POST);

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------

	// Page Browsing ////////////////////////////////////////

	if ($search_id)           $sql_where[] = " transaction_id = ".db_formatString($search_id)." ";
	if ($search_account_id)   $sql_where[] = " account_id = $search_account_id ";

	// Payment System ////////////
	if (isset($search_system) && strlen(trim($search_system)) > 2) {
		$sql_where[] = " system_type  LIKE ".db_formatString($search_system);
	}

	// Ammount Range ////////////
	if (isset($search_amount_range1) && $search_amount_range1 != "" &&
		isset($search_amount_range2) && $search_amount_range2 != "") {
		if (doubleval($search_amount_range2) < doubleval($search_amount_range1)) {
			$error_message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_AMOUNTRANGE);
		}
	}

	if (isset($search_amount_range1) && $search_amount_range1 != "") {
		$search_amount_range1 = doubleval($search_amount_range1);
		if (is_double($search_amount_range1)) {
			$sql_where[] = " transaction_amount  >= ".doubleval($search_amount_range1);
		} else {
			$error_message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_STARTAMOUNT);
			$sql_where[] = " false ";
		}
	}

	if (isset($search_amount_range2) && $search_amount_range2 != "") {
		$search_amount_range2 = doubleval($search_amount_range2);
		if (is_double($search_amount_range2)) {
			$sql_where[] = " transaction_amount  <= ".doubleval($search_amount_range2);
		} else {
			$error_message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_ENDAMOUNT);
			$sql_where[]   = " false ";
		}
	}

	// Date Range ////////////
	if ((isset($search_date_range1) && $search_date_range1 != "") && (isset($search_date_range2) && $search_date_range2 != "")) {
		if (validate_date($search_date_range1) && validate_date($search_date_range2)) {
			if (!validate_date_interval($search_date_range1, $search_date_range2) && ($search_date_range1 != $search_date_range2)) {
				$error_message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_DATERANGE);
				$sql_where[]   = " false ";
			}
		} else {
			$error_message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_DATERANGE);
			$sql_where[]   = " false ";
		}
	}

	if (isset($search_date_range1) && $search_date_range1 != "") {
		if (validate_date($search_date_range1)) {
			$sql_where[] = " DATE_FORMAT(transaction_datetime, '%Y-%m-%d') >= ".db_formatDate($search_date_range1);
		} else {
			$error_message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_STARTDATE);
			$sql_where[] = " false ";
		}
	}

	if (isset($search_date_range2) && $search_date_range2 != "") {
		if (validate_date($search_date_range2)) {
			$sql_where[] = " DATE_FORMAT(transaction_datetime, '%Y-%m-%d') <= ".db_formatDate($search_date_range2);
		} else {
			$error_message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_ENDDATE);
			$sql_where[] = " false ";
		}
	}

	if ((isset($search_date_range1) && $search_date_range1 != "") || (isset($search_date_range2) && $search_date_range2 != "")) {
		$sql_where[] = " DATE_FORMAT(transaction_datetime, '%Y-%m-%d') != '0000-00-00' ";
	}

	/**
	* System Drop Down
	****************************************************************************/
	$db = db_getDBObject();
	$query_rsSystems = "SELECT DISTINCT system_type FROM Payment_Log ORDER BY system_type";
	$rsSystems = $db->query($query_rsSystems);
	$arraySystems = array();
	while($row = mysql_fetch_assoc($rsSystems)) {
		array_push($arraySystems, $row['system_type']);
	}
	$systemsDropDown = html_selectBox("search_system", $arraySystems, $arraySystems, $search_system, "", "class=\"input-dd-form-searchtransaction\"", "-- ".system_showText(LANG_LABEL_SELECT_SELECTASYSTEM)." --");
	/***************************************************************************/

	if ($sql_where)  $where .= " ".implode(" AND ", $sql_where)." ";

	$pageObj  = new pageBrowsing("Payment_Log", $screen, 10, "transaction_datetime DESC", "", "", $where);

	$transactions = $pageObj->retrievePage("array");

	$_GET["search_page"] = "1";
	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	$paging_url = DEFAULT_URL."/gerenciamento/transactions/search.php";

	# PAGES DROP DOWN ----------------------------------------------------------------------------------------------
	$pagesDropDown = $pageObj->getPagesDropDown($_GET, $paging_url, $screen, system_showText(LANG_SITEMGR_PAGING_GOTOPAGE)." ", "this.form.submit();");
	# --------------------------------------------------------------------------------------------------------------
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

		<? include(INCLUDES_DIR."/tables/table_transaction_submenu.php"); ?>

		<div id="header-form">
			<?=system_showText(LANG_SITEMGR_SEARCH)?>
		</div>

		<form name="transactions" method="get">
			<? if ($error_message) echo "<p class=\"errorMessage\">".$error_message."</p>"; ?>
			<? include(INCLUDES_DIR."/forms/form_searchtransaction.php"); ?>
				<table style="margin: 0 auto 0 auto;">
				<tr>
					<td>
						<button type="submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SEARCH)?></button>
					</td>
					<td>
						<button type="button" onclick="emptySearchAccount(); searchResetSitemgr(this.form);" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_CLEAR)?></button>
					</td>
				</tr>
			</table>
		</form>
		<div id="header-form">
			<?=system_showText(LANG_SITEMGR_RESULTS)?>
		</div>
		<? include(INCLUDES_DIR."/tables/table_paging.php"); ?>
		<? if ($transactions) { ?>
			<? include(INCLUDES_DIR."/tables/table_transaction.php"); ?>
		<? } else { ?>
			<p class="errorMessage">
				<?=system_showText(LANG_SITEMGR_NORESULTS)?>
			</p>
		<? } ?>
	</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		<div class="clearfix"></div>

<script language="javascript">
	<!--

	<? if (DEFAULT_DATE_FORMAT == "m/d/Y") { ?>
		
		var cal_date_range1 = new calendarmdy(document.forms['transactions'].elements['search_date_range1']);
		var cal_date_range2 = new calendarmdy(document.forms['transactions'].elements['search_date_range2']);
	
	<? } elseif (DEFAULT_DATE_FORMAT == "d/m/Y") { ?>
		
		var cal_date_range1 = new calendardmy(document.forms['transactions'].elements['search_date_range1']);
		var cal_date_range2 = new calendardmy(document.forms['transactions'].elements['search_date_range2']);
	
	<? } ?>
	
	cal_date_range1.year_scroll = true;
	cal_date_range1.time_comp   = false;
	
	cal_date_range2.year_scroll = true;
	cal_date_range2.time_comp   = false;
	
	//-->
</script>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>