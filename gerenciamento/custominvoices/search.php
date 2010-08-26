<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/custominvoices/search.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (PAYMENT_FEATURE != "on") { exit; }
	if ((CREDITCARDPAYMENT_FEATURE != "on") && (INVOICEPAYMENT_FEATURE != "on")) { exit; }
	if (CUSTOM_INVOICE_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/gerenciamento/custominvoices";
	$url_base = "".DEFAULT_URL."/gerenciamento";
	$sitemgr = 1;

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------

	$error = false;

	// Page Browsing ////////////////////////////////////////

	if ($search_account_id) $sql_where[] = " account_id = $search_account_id ";
	if ($search_status) {
		if ($search_status == "paid")
			$sql_where[] = " paid = 'y' ";
		elseif ($search_status == "sent") {
			$sql_where[] = " sent = 'y' ";
			$sql_where[] = " paid != 'y' ";
		}
		elseif($search_status == "pending") {
			$sql_where[] = " paid != 'y' ";
			$sql_where[] = " sent != 'y' ";
		}
	}

	if ($do_search) {

		if (!$search_date_from && $search_date_to) {
			if (validate_date($search_date_to)) {
				$sql_where[] = " (date <= (".db_formatDate($search_date_to)."))";
			} else {
				$error = true;
				$message_searchcustominvoice = "&#149; ".system_showText(LANG_SITEMGR_MSGERROR_INVALID_ENDDATE);
			}
		}

		if ($search_date_from && !$search_date_to) {
			if (validate_date($search_date_from)) {
				$sql_where[] = " (date >= (".db_formatDate($search_date_from)."))";
			} else {
				$error = true;
				$message_searchcustominvoice = "&#149; ".system_showText(LANG_SITEMGR_MSGERROR_INVALID_STARTDATE);
			}
		}

		if ($search_date_from && $search_date_to) {
			if (validate_date($search_date_from) && validate_date($search_date_to)) {
				//formating dates
				$search_from = db_formatDate($search_date_from);
				$search_to = db_formatDate($search_date_to);
				$sql_where[] = " SUBSTRING(date,1,10) BETWEEN $search_from AND $search_to ";
			} else {
				$error = true;
				$message_searchcustominvoice = "&#149; ".system_showText(LANG_SITEMGR_MSGERROR_INVALID_DATERANGE);
			}
		}

	}

	if ($search_title) $sql_where[] = " title LIKE '%".addslashes($search_title)."%' ";

	if ($sql_where) $where .= " ".implode(" AND ", $sql_where)." ";

	$_GET["search_page"] = "1";
	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	$pageObj  = new pageBrowsing("CustomInvoice", $screen, 10, "date DESC", "", "", $where);

	if (!$error) {
		$custominvoices = $pageObj->retrievePage("object");		
	} else {
		$pageObj->setString("record_amount", 0);
		unset($custominvoices);
	}
	$paging_url = DEFAULT_URL."/gerenciamento/custominvoices/search.php";

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

			<? include(INCLUDES_DIR."/tables/table_custominvoice_submenu.php"); ?>

			<br />

			<?
				if ($message_searchcustominvoice) {
					echo "<p class=\"errorMessage\">$message_searchcustominvoice</p>";
				}
			?>

			<form name="custominvoice" method="get">

				<input type="hidden" name="do_search" value="1" />

				<? include(INCLUDES_DIR."/forms/form_searchcustominvoice.php"); ?>

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
				<?=system_showText(LANG_SITEMGR_RESULTS)?>
			</div>

			<? include(INCLUDES_DIR."/tables/table_paging.php"); ?>

			<? if ($custominvoices) { ?>

				<? include(INCLUDES_DIR."/tables/table_custominvoice.php"); ?>

			<? } else { ?>

					<p class="errorMessage"><?=system_showText(LANG_SITEMGR_NORESULTS)?></p>

			<? } ?>

							</div>
						</div>
					</div>
				</div>
			</div>
		<div class="clearfix"></div>

<script language="javascript">
	<!--

	<? if (DEFAULT_DATE_FORMAT == "m/d/Y") { ?>
		
		var cal_date_from 	= new calendarmdy(document.forms['custominvoice'].elements['search_date_from']);
		var cal_date_to 	= new calendarmdy(document.forms['custominvoice'].elements['search_date_to']);
		
	<? } elseif (DEFAULT_DATE_FORMAT == "d/m/Y") { ?>
		
		var cal_date_from 	= new calendardmy(document.forms['custominvoice'].elements['search_date_from']);
		var cal_date_to 	= new calendardmy(document.forms['custominvoice'].elements['search_date_to']);
	
	<? } ?>
	
	cal_date_from.year_scroll = true;
	cal_date_from.time_comp = false;
	
	cal_date_to.year_scroll = true;
	cal_date_to.time_comp = false;
	
	//-->
</script>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
