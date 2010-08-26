<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/estabelecimentos/maptuning.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (GOOGLE_MAPS_ENABLED != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/gerenciamento/estabelecimentos";
	$url_base = "".DEFAULT_URL."/gerenciamento";
	$sitemgr = 1;

	extract($_POST);
	extract($_GET);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$listing = new Listing($id);
		if ((!$listing->getNumber("id")) || ($listing->getNumber("id") <= 0)) {
			header("Location: ".DEFAULT_URL."/gerenciamento/estabelecimentos/".(($search_page) ? "search.php" : "index.php")."?message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
			exit;
		}
		if ((!$listing->getString("address")) && (!$listing->getString("zip_code")) && (!$listing->getNumber("cidade_id")) && (!$listing->getNumber("bairro_id"))) {
			header("Location: ".DEFAULT_URL."/gerenciamento/estabelecimentos/".(($search_page) ? "search.php" : "index.php")."?message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
			exit;
		}
		$itemObj = $listing;
	} else {
		header("Location: ".DEFAULT_URL."/gerenciamento/estabelecimentos/".(($search_page) ? "search.php" : "index.php")."?message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/maptuning.php");

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

			<?
			if ($googlemaps_code) {
				echo $googlemaps_code;
			}
			?>

			<br />

			<div id="header-view">
				<?=LANG_SITEMGR_LISTING_SING;?> <?=ucwords(system_showText(LANG_SITEMGR_MAPTUNING))?> - <?=$listing->getString("title")?>
			</div>
			
			<div class="baseForm">

			<form name="maptuning_form" id="maptuning_form" action="<?=$_SERVER["PHP_SELF"]?>" method="post">

				<input type="hidden" name="sitemgr" id="sitemgr" value="<?=$sitemgr?>" />
				<input type="hidden" name="id" id="id" value="<?=$id?>" />
				<input type="hidden" name="latitude_longitude" id="myLatitudeLongitude" value="<?=$latitude_longitude?>" />
				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<input type="hidden" name="letra" value="<?=$letra?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />


				<br />
				<div id="map" class="googleBase" style="border: 1px solid #000;">&nbsp;</div>
				<br />

				<? if ($googlemaps_message) { ?>
					<div id="map_error"><?=$googlemaps_message?></div>
				<? } ?>

				<button type="submit" name="submit_button" class="ui-state-default ui-corner-all" value="Submit"><?=system_showText('Salvar')?></button>
				<button type="button" name="clear_button" class="ui-state-default ui-corner-all" value="Clear" onClick="document.getElementById('myLatitudeLongitude').value='';document.getElementById('maptuning_form').submit();"><?=system_showText(LANG_SITEMGR_MAPTUNING_CLEAR)?></button>

				<button type="button" name="cancel" value="Cancel" class="ui-state-default ui-corner-all" onclick="document.getElementById('formlistingmaptuningcancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>

			</form>
			<form id="formlistingmaptuningcancel" action="<?=DEFAULT_URL?>/gerenciamento/estabelecimentos/<?=(($search_page) ? "search.php" : "index.php");?>" method="get">

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