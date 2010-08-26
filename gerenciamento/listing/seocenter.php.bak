<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/estabelecimentos/seocenter.php
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

	$url_redirect = "".DEFAULT_URL."/gerenciamento/estabelecimentos";
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
	include(EDIRECTORY_ROOT."/includes/code/listing_seocenter.php");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header_manager.php");

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

			<? include(INCLUDES_DIR."/tables/table_listing_submenu.php"); ?>

			<br />

			<div id="header-form">
				<?=system_showText(LANG_SITEMGR_LISTING_SING)?> - <?=$listing->getString("title")?>
			</div>
			
			<div class="baseForm">

			<form name="listingseocenter" action="<?=$_SERVER["PHP_SELF"]?>" method="post">

				<input type="hidden" name="id" id="id" value="<?=$id?>" />
				<input type="hidden" name="letra" value="<?=$letra?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />
				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<? include(INCLUDES_DIR."/forms/form_listing_seocenter.php"); ?>

				<button type="submit" name="submit_button" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>

				<button type="button" value="Cancel" class="ui-state-default ui-corner-all" onclick="document.getElementById('formlistingseocentercancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>

			</form>

			<form id="formlistingseocentercancel" action="<?=DEFAULT_URL?>/gerenciamento/estabelecimentos/<?=(($search_page) ? "search.php" : "index.php");?>" method="get">

				<input type="hidden" name="letra" value="<?=$letra?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />
				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>

			</form>
			
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
