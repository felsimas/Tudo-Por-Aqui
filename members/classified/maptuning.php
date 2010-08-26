<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/classified/maptuning.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLASSIFIED_FEATURE != "on") { exit; }
	if (GOOGLE_MAPS_ENABLED != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	$url_redirect = "".DEFAULT_URL."/membros/classified";
	$url_base = "".DEFAULT_URL."/membros";
	$membros = 1;

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$classified = new Classified($id);
		if ((!$classified->getNumber("id")) || ($classified->getNumber("id") <= 0)) {
			header("Location: ".DEFAULT_URL."/membros/classified/index.php?screen=$screen&letra=$letra");
			exit;
		}
		if (sess_getAccountIdFromSession() != $classified->getNumber("account_id")) {
			header("Location: ".DEFAULT_URL."/membros/classified/index.php?screen=$screen&letra=$letra");
			exit;
		}
		if ((!$classified->getString("address")) && (!$classified->getString("zip_code")) && (!$classified->getNumber("cidade_id")) && (!$classified->getNumber("bairro_id"))) {
			header("Location: ".DEFAULT_URL."/membros/classified/index.php?screen=$screen&letra=$letra");
			exit;
		}
		$itemObj = $classified;
	} else {
		header("Location: ".DEFAULT_URL."/membros/classified/index.php?screen=$screen&letra=$letra");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/maptuning.php");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/navbar.php");

?>

	<div class="mainContentExtended">

		<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

		<?
		if ($googlemaps_code) {
			echo $googlemaps_code;
		}
		?>

		<h1 class="standardTitle"><?=system_highlightLastWord(system_showText(LANG_LABEL_MAP_TUNING))?></h1>

		<ul class="list-view">
			<li class="list-back"><a href="<?=DEFAULT_URL?>/membros/classified/<?=($search_page) ? "search.php" : "index.php"?>?screen=<?=$screen?>&letra=<?=$letra?>"><?=system_showText(LANG_LABEL_BACK);?></a></li>
		</ul>

		<h2 class="standardSubTitle"><?=system_showText(LANG_CLASSIFIED_MAP_TUNING)?> - <?=$classified->getString("title")?></h2>

		<form name="maptuning_form" id="maptuning_form" action="<?=$_SERVER["PHP_SELF"]?>" method="post">

			<input type="hidden" name="id" id="id" value="<?=$id?>" />
			<input type="hidden" name="latitude_longitude" id="myLatitudeLongitude" value="<?=$latitude_longitude?>" />
			<input type="hidden" name="screen" id="screen" value="<?=$screen?>" />
			<input type="hidden" name="letra" id="letra" value="<?=$letra?>" />

			<div class="tip-base">
				<h1><?=system_showText(LANG_MSG_TIPSFORMAPTUNING)?></h1><br />
				<p style="text-align: justify;"><?=system_showText(LANG_MSG_YOUCANADJUSTPOSITION)?> <strong><?=system_showText(LANG_MSG_WITH_MORE_ACCURACY)?></strong></p><br />
				<span class="warning" style="text-align: justify;">* <?=system_showText(LANG_MSG_USE_CONTROLS_TO_ADJUST)?> </span>
				<span class="warning" style="text-align: justify;">* <?=system_showText(LANG_MSG_USE_ARROWS_TO_NAVIGATE)?> </span>
				<span class="warning" style="text-align: justify;">* <?=system_showText(LANG_MSG_DRAG_AND_DROP_MARKER)?> </span>
			</div>

			<br />
			<div id="map" class="googleBase" style="border: 1px solid #000;">&nbsp;</div>
			<br />

			<? if ($googlemaps_message) { ?>
				<div id="map_error"><?=$googlemaps_message?></div>
			<? } ?>
			
				<p class="standardButton mapTunningButton">
					<button type="submit"><?=system_showText(LANG_BUTTON_SAVE_MAP_TUNING);?></button>
				</p>
				<p class="standardButton mapTunningButton">
					<button type="button" value="Clear" onClick="document.getElementById('myLatitudeLongitude').value='';document.getElementById('maptuning_form').submit();"><?=system_showText(LANG_BUTTON_CLEAR_MAP_TUNING);?></button>
				</p>

		</form>
		<form action="<?=DEFAULT_URL?>/membros/classified/index.php" method="post">

			<input type="hidden" name="screen" value="<?=$screen?>" />
			<input type="hidden" name="letra" value="<?=$letra?>" />

				<p class="standardButton mapTunningButton">
					<button type="submit" value="Cancel"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
				</p>

		</form>

	</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>
