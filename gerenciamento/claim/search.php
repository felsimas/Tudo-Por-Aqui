<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/claim/search.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLAIM_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/gerenciamento/claim";
	$url_base     = "".DEFAULT_URL."/gerenciamento";

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------

	if ($search_id) $sql_where[] = " id = ".db_formatString($search_id)." ";
	if ($search_status) $sql_where[] = " status = '$search_status' ";
	if ($search_title) $sql_where[] = " ( listing_title LIKE ".db_formatString("%".$search_title."%")." OR old_title LIKE ".db_formatString("%".$search_title."%")." OR new_title LIKE ".db_formatString("%".$search_title."%")." ) ";
	if ($search_no_owner==1) $sql_where[] = " account_id = 0 ";
	elseif ($search_account_id) $sql_where[] = " account_id = $search_account_id ";

	if ($sql_where) $where .= " ".implode(" AND ", $sql_where)." ";

	$_GET["search_page"] = "1";
	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	$pageObj = new pageBrowsing("Claim", $screen, 10, "date_time DESC, id Desc", "", "", $where);

	$claims = $pageObj->retrievePage("object");

	$paging_url = DEFAULT_URL."/gerenciamento/claim/search.php";

	# PAGES DROP DOWN ----------------------------------------------------------------------------------------------
	$pagesDropDown = $pageObj->getPagesDropDown($_GET, $paging_url, $screen, system_showText(LANG_SITEMGR_PAGING_GOTOPAGE)." ", "this.form.submit();");
	# --------------------------------------------------------------------------------------------------------------

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
			<h1><?=system_showText(LANG_SITEMGR_MENU_SEARCH)?> <?=system_showText(LANG_SITEMGR_CLAIM_CLAIMS)?></h1>
		</div>
	</div>

	<div id="content-content">

		<div class="default-margin" style="padding-top:3px;">

			<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? include(INCLUDES_DIR."/tables/table_claim_submenu.php"); ?>

			<br />

			<form name="claim" method="get">

				<? if ($error_message) echo "<p class=\"errorMessage\">".$error_message."</p>"; ?>

				<? include(INCLUDES_DIR."/forms/form_searchclaim.php"); ?>

				<table style="margin: 0 auto 0 auto;">
					<tr>
						<td>
							<button type="submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SEARCH)?></button>
						</td>
						<td>
							<button type="button" onclick="emptySearchAccount();searchResetSitemgr(this.form);" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_CLEAR)?></button>
						</td>
					</tr>
				</table>

			</form>

			<div id="header-form">
				<?=system_showText(LANG_SITEMGR_RESULTS)?>
			</div>

			<? include(INCLUDES_DIR."/tables/table_paging.php"); ?>

			<? if ($claims) { ?>

				<? include(INCLUDES_DIR."/tables/table_claim.php"); ?>

			<? } else { ?>

				<p class="errorMessage"><?=system_showText(LANG_SITEMGR_NORESULTS)?></p>

			<? } ?>

		</div>

	</div>

	<div id="bottom-content">
		&nbsp;
	</div>

</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
