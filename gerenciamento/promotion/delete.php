<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/promotion/delete.php
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

	extract($_GET);
	extract($_POST);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$promotion = new Promotion($id);
	} else {
		header("Location: ".DEFAULT_URL."/gerenciamento/promotion/".(($search_page) ? "search.php" : "index.php")."?screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$promotion = new Promotion($id);
		$promotion->Delete();
		$message = ucwords(PROMOTION_FEATURE_NAME)." deleted!";
		header("Location: ".DEFAULT_URL."/gerenciamento/promotion/".(($search_page) ? "search.php" : "index.php")."?screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
		exit;
	}

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
		
		<div class="baseForm">

		<form name="promotion" method="post">
			<input type="hidden" name="id" value="<?=$id?>" />
			<div id="header-form">
				<?=ucwords(system_showText(LANG_SITEMGR_DELETE))?> <?=ucwords(system_showText(LANG_SITEMGR_PROMOTION))?> <?=ucwords(system_showText(LANG_SITEMGR_INFORMATION))?> - <?=$promotion->getString("name")?>
			</div>
			<div class="response-msg inf ui-corner-all">
				<?=system_showText(LANG_SITEMGR_PROMOTION_DELETEQUESTION)?>
			</div>
			<input type="hidden" name="letra" value="<?=$letra?>" />
			<input type="hidden" name="screen" value="<?=$screen?>" />
			<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
			<button type="submit" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
			<button type="button" value="Cancel" class="ui-state-default ui-corner-all" onclick="document.getElementById('formpromotiondeletecancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>
		</form>
		<form id="formpromotiondeletecancel" action="<?=DEFAULT_URL?>/gerenciamento/promotion/<?=(($search_page) ? "search.php" : "index.php");?>" method="post">
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
