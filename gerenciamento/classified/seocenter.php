<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/classified/seocenter.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLASSIFIED_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/gerenciamento/classified";
	$url_base = "".DEFAULT_URL."/gerenciamento";
	$sitemgr = 1;

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/classified_seocenter.php");

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
			<h1><?=system_showText(LANG_SITEMGR_CLASSIFIED_SING)?> <?=system_showText(LANG_SITEMGR_SEOCENTER)?></h1>
		</div>
	</div>

	<div id="content-content">
		<div class="default-margin" style="padding-top:3px;">

			<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? include(INCLUDES_DIR."/tables/table_classified_submenu.php"); ?>

			<br />

			<div id="header-form">
				<?=system_showText(LANG_SITEMGR_CLASSIFIED_SING)?> - <?=$classified->getString("title")?>
			</div>
			
			<div class="baseForm">

			<form name="classifiedseocenter" action="<?=$_SERVER["PHP_SELF"]?>" method="post">

				<input type="hidden" name="id" id="id" value="<?=$id?>" />
				<input type="hidden" name="letra" value="<?=$letra?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />
				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<? include(INCLUDES_DIR."/forms/form_classified_seocenter.php"); ?>

					<button type="submit" name="submit_button" class="ui-state-default ui-corner-all"><?=ucwords(system_showText(LANG_SITEMGR_SUBMIT))?></button>

					<button type="button" value="Cancel" class="ui-state-default ui-corner-all" onclick="document.getElementById('formclassifiedseocentercancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>

			</form>

			<form id="formclassifiedseocentercancel" action="<?=DEFAULT_URL?>/gerenciamento/classified/<?=(($search_page) ? "search.php" : "index.php");?>" method="post">

					<input type="hidden" name="letra" value="<?=$letra?>" />
					<input type="hidden" name="screen" value="<?=$screen?>" />
					<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>

			</form>
			
			</div>

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
