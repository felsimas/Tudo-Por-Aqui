<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/invoices/search.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (PAYMENT_FEATURE != "on") { exit; }
	if (INVOICEPAYMENT_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	$url_redirect = "".DEFAULT_URL."/gerenciamento/invoices";
	$url_base     = "".DEFAULT_URL."/gerenciamento";

	##################################################################################################################################
	# STATUS
	##################################################################################################################################	
	$invoiceStatusObj = new InvoiceStatus();
	$statusDropDown = html_selectBox("search_status", $invoiceStatusObj->getNames(), $invoiceStatusObj->getValues(), $search_status, "", "class='input-dd-form-searchinvoice'", "-- ".system_showText(LANG_LABEL_SELECT_ALLSTATUS)." --");

	// Page Browsing ////////////////////////////////////////

	if ($search_id)                       $sql_where[] = " id = ".db_formatString($search_id)." ";
	if ($search_account_id)               $sql_where[] = " account_id = $search_account_id ";
	if ($search_status)                   $sql_where[] = " status = '$search_status' ";

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
			$sql_where[] = " amount  >= ".doubleval($search_amount_range1);
		} else {
			$error_message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_STARTAMOUNT);
			$sql_where[] = " false ";
		}
	}

	if (isset($search_amount_range2) && $search_amount_range2 != "") {
		$search_amount_range2 = doubleval($search_amount_range2);
		if (is_double($search_amount_range2)) {
			$sql_where[] = " amount  <= ".doubleval($search_amount_range2);
		} else {
			$error_message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_ENDAMOUNT);
			$sql_where[]   = " false ";
		}
	}

	// Date Range ////////////

	if (isset($search_date_range1) && $search_date_range1 != "") {
		if (validate_date($search_date_range1)) {
			$sql_where[] = " DATE_FORMAT(payment_date, '%Y-%m-%d') >= ".db_formatDate($search_date_range1);
		} else {
			$error_message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_STARTDATE);
			$sql_where[] = " false ";
		}
	}

	if (isset($search_date_range2) && $search_date_range2 != "") {
		if (validate_date($search_date_range2)) {
			$sql_where[] = " DATE_FORMAT(payment_date, '%Y-%m-%d') <= ".db_formatDate($search_date_range2);
		} else {
			$error_message = system_showText(LANG_SITEMGR_MSGERROR_INVALID_ENDDATE);
			$sql_where[] = " false ";
		}
	}

	if ((isset($search_date_range1) && $search_date_range1 != "") && (isset($search_date_range2) && $search_date_range2 != "")) {
		if (validate_date($search_date_range1) && validate_date($search_date_range2)) {
			if (!validate_date_interval($search_date_range1, $search_date_range2) && ($search_date_range1 != $search_date_range2)) {
				$error_message = "&#149; ".system_showText(LANG_SITEMGR_MSGERROR_INVALID_DATERANGE);
				$sql_where[]   = " false ";
			}
		} else {
			$error_message = "&#149; ".system_showText(LANG_SITEMGR_MSGERROR_INVALID_DATERANGE);
			$sql_where[]   = " false ";
		}
	}

	if ((isset($search_date_range1) && $search_date_range1 != "") || (isset($search_date_range2) && $search_date_range2 != "")) {
		$sql_where[] = " DATE_FORMAT(payment_date, '%Y-%m-%d') != '0000-00-00' ";
	}

	// Expiration Date
	if (isset($search_expiration_date) && $search_expiration_date != "") {
		if (validate_date_future($search_expiration_date)) {
			if ($search_opt_expiration_date == 1) {
				$sql_where[] = " DATE(expire_date) = ".db_formatDate($search_expiration_date);
			} else if ($search_opt_expiration_date == 2) {
				$sql_where[] = " (DATE(expire_date) >= NOW() AND TO_DAYS(DATE(expire_date)) <= TO_DAYS(".db_formatDate($search_expiration_date)."))";
			}
		} else {
			$error_message = system_showText(LANG_SITEMGR_MSGERROR_RENEWALDATE_INFUTURE);
			$sql_where[] = " false ";
		}
	}

	if ($invoiceStatusObj->getDefault()) $sql_where[] = " status != '".$invoiceStatusObj->getDefault()."' ";
	if ($sql_where)                      $where .= " ".implode(" AND ", $sql_where)." ";

	$_GET["search_page"] = "1";
	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	$pageObj  = new pageBrowsing("Invoice",$screen,10,"date DESC","","",$where);

	$invoices = $pageObj->retrievePage("array");

	$letras = $pageObj->getString("letras");

	$paging_url = DEFAULT_URL."/gerenciamento/invoices/search.php";

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

		<? include(INCLUDES_DIR."/tables/table_invoice_submenu.php"); ?>

		<br />

		<div id="header-form">
			<?=ucwords(system_showText(LANG_SITEMGR_MENU_SEARCH))?>
		</div>

		<form name="invoice_search" method="get">
			<? if ($error_message) echo "<p class=\"errorMessage\">".$error_message."</p>"; ?>
			<? include(INCLUDES_DIR."/forms/form_searchinvoice.php"); ?>
				<table style="margin: 0 auto 0 auto;">
				<tr>
					<td>
						<button type="submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_MENU_SEARCH)?></button>
					</td>
					<td>
						<button type="button" onclick="emptySearchAccount(); searchResetSitemgr(this.form);" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_CLEAR)?></button>
					</td>
				</tr>
			</table>
		</form>
		<div id="header-form">
			<?=ucwords(system_showText(LANG_SITEMGR_RESULTS))?>
		</div>
		<? include(INCLUDES_DIR."/tables/table_paging.php"); ?>
		<? if ($invoices) { ?>
			<? include(INCLUDES_DIR."/tables/table_invoice.php"); ?>
		<? } else { ?>
			<p class="errorMessage">
				<?=ucwords(system_showText(LANG_SITEMGR_NORESULTS))?>
			</p>
		<? } ?>
	</div>
</div>
<div id="bottom-content">
	&nbsp;
</div>
</div>

<script language="javascript">
	<!--

	<? if (DEFAULT_DATE_FORMAT == "m/d/Y") { ?>
		
		var cal_expiration_date = new calendarmdy(document.forms['invoice_search'].elements['search_expiration_date']);
		var cal_date_range1 = new calendarmdy(document.forms['invoice_search'].elements['search_date_range1']);
		var cal_date_range2 = new calendarmdy(document.forms['invoice_search'].elements['search_date_range2']);
	
	<? } elseif (DEFAULT_DATE_FORMAT == "d/m/Y") { ?>
		
		var cal_expiration_date = new calendardmy(document.forms['invoice_search'].elements['search_expiration_date']);
		var cal_date_range1 = new calendardmy(document.forms['invoice_search'].elements['search_date_range1']);
		var cal_date_range2 = new calendardmy(document.forms['invoice_search'].elements['search_date_range2']);
	
	<? } ?>
	
	cal_expiration_date.year_scroll = true;
	cal_expiration_date.time_comp = false;
	
	cal_date_range1.year_scroll = true;
	cal_date_range1.time_comp = false;
	
	cal_date_range2.year_scroll = true;
	cal_date_range2.time_comp = false;
	
	//-->
</script>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
