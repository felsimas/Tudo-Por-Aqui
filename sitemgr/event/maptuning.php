<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/event/maptuning.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (EVENT_FEATURE != "on") { exit; }
	if (GOOGLE_MAPS_ENABLED != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/gerenciamento/event";
	$url_base = "".DEFAULT_URL."/gerenciamento";
	$sitemgr = 1;

	extract($_POST);
	extract($_GET);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$event = new Event($id);
		if ((!$event->getNumber("id")) || ($event->getNumber("id") <= 0)) {
			header("Location: ".DEFAULT_URL."/gerenciamento/event/".(($search_page) ? "search.php" : "index.php")."?message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
			exit;
		}
		if ((!$event->getString("address")) && (!$event->getString("zip_code")) && (!$event->getNumber("cidade_id")) && (!$event->getNumber("bairro_id"))) {
			header("Location: ".DEFAULT_URL."/gerenciamento/event/".(($search_page) ? "search.php" : "index.php")."?message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
			exit;
		}
		$itemObj = $event;
	} else {
		header("Location: ".DEFAULT_URL."/gerenciamento/event/".(($search_page) ? "search.php" : "index.php")."?message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/maptuning.php");

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
			<h1><?=system_showText(LANG_SITEMGR_MAPTUNING)?></h1>
		</div>
	</div>

	<div id="content-content">
		<div class="default-margin" style="padding-top:3px;">

			<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? include(INCLUDES_DIR."/tables/table_event_submenu.php"); ?>

			<?
			if ($googlemaps_code) {
				echo $googlemaps_code;
			}
			?>

			<br />

			<div id="header-view">
				<?=system_showText(LANG_SITEMGR_EVENT_SING)?> <?=system_showText(LANG_SITEMGR_MAPTUNING)?> - <?=$event->getString("title")?>
			</div>
			
			<div class="baseForm">

			<form name="maptuning_form" id="maptuning_form" action="<?=$_SERVER["PHP_SELF"]?>" method="post">

				<input type="hidden" name="sitemgr" id="sitemgr" value="<?=$sitemgr?>" />
				<input type="hidden" name="id" id="id" value="<?=$id?>" />
				<input type="hidden" name="latitude_longitude" id="myLatitudeLongitude" value="<?=$latitude_longitude?>" />
				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<input type="hidden" name="letra" value="<?=$letra?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />

				<div class="tip-base">
					<h1><?=system_showText(LANG_SITEMGR_MAPTUNING_TIPTITLE)?></h1><br />
					<p style="text-align: justify;"><?=system_showText(LANG_SITEMGR_MAPTUNING_TIP1)?></p><br />
					<span class="warning" style="text-align: justify;"><?=system_showText(LANG_SITEMGR_MAPTUNING_TIP2)?></span>
					<span class="warning" style="text-align: justify;"><?=system_showText(LANG_SITEMGR_MAPTUNING_TIP3)?></span>
					<span class="warning" style="text-align: justify;"><?=system_showText(LANG_SITEMGR_MAPTUNING_TIP4)?></span>
				</div>

				<br />
				<div id="map" class="googleBase" style="border: 1px solid #000;">&nbsp;</div>
				<br />

				<? if ($googlemaps_message) { ?>
					<div id="map_error"><?=$googlemaps_message?></div>
				<? } ?>

							<button type="submit" name="submit_button" class="ui-state-default ui-corner-all mapTunningButton" value="Submit"><?=system_showText(LANG_SITEMGR_MAPTUNING_SAVE)?></button>
							<button type="button" name="clear_button" class="ui-state-default ui-corner-all mapTunningButton" value="Clear" onClick="document.getElementById('myLatitudeLongitude').value='';document.getElementById('maptuning_form').submit();"><?=system_showText(LANG_SITEMGR_MAPTUNING_CLEAR)?></button>
							<button type="button" name="cancel" value="Cancel" class="ui-state-default ui-corner-all mapTunningButton" onclick="document.getElementById('formeventmaptuningcancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>
			</form>
			<form id="formeventmaptuningcancel" action="<?=DEFAULT_URL?>/gerenciamento/event/<?=(($search_page) ? "search.php" : "index.php");?>" method="get">
							<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
							<input type="hidden" name="letra" value="<?=$letra?>" />
							<input type="hidden" name="screen" value="<?=$screen?>" />
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