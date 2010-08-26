<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/content/member.php
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
	extract($_POST);
	extract($_GET);

	# ----------------------------------------------------------------------------------------------------
	# PAGE BROWSING
	# ----------------------------------------------------------------------------------------------------
	$pageObj  = new pageBrowsing("Content", $screen, 25, "id", "id", $letra, "section = 'member'");
	$contents = $pageObj->retrievePage();

	# PAGES DROP DOWN ----------------------------------------------------------------------------------------------
	$paging_url = DEFAULT_URL."/gerenciamento/content/member.php";
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
		<div id="header-content">
			<h1><?=ucwords(system_showText(LANG_SITEMGR_CONTENT_MANAGECONTENT))?></h1>
		</div>
	</div>

	<div id="content-content">

		<div class="default-margin" style="padding-top: 3px;">

			<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? include(INCLUDES_DIR."/tables/table_content_submenu.php"); ?>
			<? include(INCLUDES_DIR."/tables/table_paging.php"); ?>
			<? include(INCLUDES_DIR."/tables/table_content.php"); ?>

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
