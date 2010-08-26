<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/banner/delete.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (BANNER_FEATURE != "on") { exit; }

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

	$url_redirect = "".DEFAULT_URL."/gerenciamento/banner";
	$url_base = "".DEFAULT_URL."/gerenciamento";
	$sitemgr = 1;

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	include(EDIRECTORY_ROOT."/includes/code/banner.php");

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

			<div id="header-form">
				<? $banner = new Banner($id); ?>
				<?=ucwords(system_showText(LANG_SITEMGR_DELETE))?> <?=ucwords(system_showText(LANG_SITEMGR_BANNER))?> - <?=$banner->getString("caption")?>
			</div>
			
			<div class="baseForm">

			<form name="banner" action="<?=$_SERVER["PHP_SELF"]?>" method="post">
				<input type="hidden" name="id" value="<?=$id?>" />
				<input type="hidden" name="operation" value="delete" />
				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<input type="hidden" name="letra" value="<?=$letra?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />

				<div class="response-msg inf ui-corner-all"><?=system_showText(LANG_SITEMGR_BANNER_DELETEQUESTION)?></div>

				<button type="submit" name="submit" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_CONFIRM)?></button>
				<button type="button" value="Cancel" class="ui-state-default ui-corner-all" onclick="document.getElementById('formbannerdeletecancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button></li>

			</form>
			<form  id="formbannerdeletecancel"action="<?=DEFAULT_URL?>/gerenciamento/banner/<?=(($search_page) ? "search.php" : "index.php")?>" method="post" style="margin: 0; padding: 0;">

				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<input type="hidden" name="letra" value="<?=$letra?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />

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
