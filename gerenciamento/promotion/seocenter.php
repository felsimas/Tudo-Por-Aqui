<?


	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/promotion/seocenter.php
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

	$url_redirect = "".DEFAULT_URL."/gerenciamento/promotion";
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
	include(EDIRECTORY_ROOT."/includes/code/promotion_seocenter.php");

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

			<? include(INCLUDES_DIR."/tables/table_promotion_submenu.php"); ?>

			<br />

			<div id="header-form">
				<?=ucwords(system_showText(LANG_SITEMGR_LISTING))?> - <?=$promotion->getString("name")?>
			</div>
			
			<div class="baseForm">

			<form name="promotionseocenter" action="<?=$_SERVER["PHP_SELF"]?>" method="post">

				<input type="hidden" name="id" id="id" value="<?=$id?>" />
				<input type="hidden" name="letra" value="<?=$letra?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />
				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<? include(INCLUDES_DIR."/forms/form_promotion_seocenter.php"); ?>

				<button type="submit" name="submit_button" class="ui-state-default ui-corner-all"><?=ucwords(system_showText(LANG_SITEMGR_SUBMIT))?></button>

				<button type="button" value="Cancel" class="ui-state-default ui-corner-all" onclick="document.getElementById('formpromotionseocentercancel').submit();"><?=ucwords(system_showText(LANG_SITEMGR_CANCEL))?></button>

			</form>

			<form id="formpromotionseocentercancel" action="<?=DEFAULT_URL?>/gerenciamento/promotion/<?=(($search_page) ? "search.php" : "index.php");?>" method="post">

				<input type="hidden" name="letra" value="<?=$letra?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />
				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>

			</form>
			
			</div>

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
