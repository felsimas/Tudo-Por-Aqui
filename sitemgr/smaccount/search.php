<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/smaccount/search.php
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

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	// Page Browsing ////////////////////////////////////////

	if ($search_username) $sql_where[] = " username like ".db_formatString('%'.$search_username.'%')." ";
	if ($sql_where)       $where .= " ".implode(" AND ", $sql_where)." ";

	$_GET["search_page"] = "1";
	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	$pageObj  = new pageBrowsing("SMAccount", $screen, 10, "username", "", "", $where);

	$smaccounts = $pageObj->retrievePage();

	$paging_url = DEFAULT_URL."/gerenciamento/smaccount/search.php";

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

		<? include(INCLUDES_DIR."/tables/table_smaccount_submenu.php"); ?>
		<div id="header-form">
			Buscar Conta(s)
			</div>
		<form name="smaccount" method="get">
			<? include(INCLUDES_DIR."/forms/form_searchsmaccount.php"); ?>
				<table style="margin: 0 auto 0 auto;">
				<tr>
					<td>
						<button type="submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SEARCH)?></button>
					</td>
					<td>
						<button type="button" onclick="searchResetSitemgr(this.form);" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_CLEAR)?></button>
					</td>
				</tr>
			</table>
		</form>
			<div id="header-form">
				<?=system_showText(LANG_SITEMGR_RESULTS)?>
			</div>
			<? include(INCLUDES_DIR."/tables/table_paging.php"); ?>
			<? if ($smaccounts) { ?>
				<? include(INCLUDES_DIR."/tables/table_smaccount.php"); ?>
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
		<div class="clearfix"></div>
<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>