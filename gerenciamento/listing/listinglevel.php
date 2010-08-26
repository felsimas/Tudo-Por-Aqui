<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/estabelecimentos/listinglevel.php
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

	if ($id) {
		$listing = new Listing($id);
		$listing->extract();
	}

	extract($_POST);
	extract($_GET);

	$levelObj = new ListingLevel();
	if ($level) {
		$levelArray[$levelObj->getLevel($level)] = $level;
	} else {
		$levelArray[$levelObj->getLevel($levelObj->getDefaultLevel())] = $levelObj->getDefaultLevel();
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		if (($id) && ($listing)) {
			$listing->setString("level", $_POST["level"]);
			$listing->setNumber("listingtemplate_id", $_POST["listingtemplate_id"]);
			$listing->Save();
			header("Location: ".DEFAULT_URL."/gerenciamento/estabelecimentos/".(($search_page) ? "search.php" : "index.php")."?message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
			exit;
		} else {
	//		header("Location: ".DEFAULT_URL."/gerenciamento/estabelecimentos/listing.php?level=".$_POST["level"]."&listingtemplate_id=".$_POST["listingtemplate_id"]);
			header("Location: ".DEFAULT_URL."/gerenciamento/estabelecimentos/adicionar/tipo/".$_POST["level"]."");
			exit;
		}
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

			<? include(INCLUDES_DIR."/tables/table_listing_submenu.php"); ?>

			<div id="header-view">
				<?= ($id) ? ucwords(system_showText(LANG_SITEMGR_EDIT))." " : ucwords(system_showText(LANG_SITEMGR_ADD))." "?><?=LANG_SITEMGR_LISTING_SING;?> <?=ucwords(system_showText(LANG_SITEMGR_LEVEL))?> <? if (($listing) && ($listing->getString("title"))) echo "- ".$listing->getString("title"); ?>
			</div>
			
			<div class="baseForm">

			<form name="listing_setting" action="<?=$_SERVER["PHP_SELF"]?>" method="post">
				<input type="hidden" name="id" value="<?=$id?>" />
				<? include(INCLUDES_DIR."/forms/form_listinglevel.php"); ?>
				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<input type="hidden" name="letra" value="<?=$letra?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />
				<button class="ui-state-default ui-corner-all"type="submit" value="Submit"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
				<button class="ui-state-default ui-corner-all" type="button" name="back" value="Back" onclick="document.getElementById('formlistinglevelcancel').submit();"><?=system_showText(LANG_SITEMGR_BACK)?></button>
			</form>
			<form id="formlistinglevelcancel" action="<?=DEFAULT_URL?>/gerenciamento/estabelecimentos/<?=(($search_page) ? "search.php" : "index.php");?>" method="post">
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
