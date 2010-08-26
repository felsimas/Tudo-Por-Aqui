<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/claim/index.php
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

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	// Page Browsing /////////////////////////////////////////
	$pageObj  = new pageBrowsing("Claim", $screen, 10, "date_time DESC, id Desc", "title", $letra);
	$claims = $pageObj->retrievePage();

	$paging_url = DEFAULT_URL."/gerenciamento/claim/index.php";

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

?>

<div id="main-right">
	<div id="top-content">
		<div id="header-content"><h1><?=ucwords(system_showText(LANG_SITEMGR_MENU_CLAIMEDLISTINGS));?></h1></div>
	</div>
	<div id="content-content">
		<div class="default-margin" style="padding-top:3px;">

			<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? include(INCLUDES_DIR."/tables/table_claim_submenu.php"); ?>

			<? include(INCLUDES_DIR."/tables/table_paging.php"); ?>

			<? if ($claims) { ?>
				<? include(INCLUDES_DIR."/tables/table_claim.php"); ?>
			<? } else { ?>
				<div class="response-msg inf ui-corner-all"><?=system_showText(LANG_SITEMGR_CLAIM_NORECORD)?></div>
			<? } ?>

		</div>
	</div>
	<div id="bottom-content">&nbsp;</div>
</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
