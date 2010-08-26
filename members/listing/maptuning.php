<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/listing/maptuning.php
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
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	$url_redirect = "".DEFAULT_URL."/membros/listing";
	$url_base = "".DEFAULT_URL."/membros";
	$membros = 1;

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$listing = new Listing($id);
		if ((!$listing->getNumber("id")) || ($listing->getNumber("id") <= 0)) {
			header("Location: ".DEFAULT_URL."/membros/listing/index.php?screen=$screen&letra=$letra");
			exit;
		}
		if (sess_getAccountIdFromSession() != $listing->getNumber("account_id")) {
			header("Location: ".DEFAULT_URL."/membros/listing/index.php?screen=$screen&letra=$letra");
			exit;
		}
		if ((!$listing->getString("address")) && (!$listing->getString("zip_code")) && (!$listing->getNumber("cidade_id")) && (!$listing->getNumber("bairro_id"))) {
			header("Location: ".DEFAULT_URL."/membros/listing/index.php?screen=$screen&letra=$letra");
			exit;
		}
		$itemObj = $listing;
	} else {
		header("Location: ".DEFAULT_URL."/membros/listing/index.php?screen=$screen&letra=$letra");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/maptuning.php");

# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header_members.php");

?>

	<div id="page-wrapper">

		<div id="main-wrapper">
		<?php 	include(MEMBERS_EDIRECTORY_ROOT."/menu.php"); ?>
		
			<div id="main-content"> 

				
				<div class="page-title ui-widget-content ui-corner-all">

					<div class="other_content">
		<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

		<?
		if ($googlemaps_code) {
			echo $googlemaps_code;
		}
		?>
				<div id="header-form"><a href="<?=DEFAULT_URL?>/membros/listing/view.php?id=<?=$listing->getNumber("id")?>"><?=system_showText(LANG_MANAGE_LISTING);?> - <?=$listing->getString("title")?> - <?=system_highlightLastWord(system_showText(LANG_LABEL_MAP_TUNING))?></a></div>



		<h2 class="standardSubTitle"><?=system_showText(LANG_LISTING_MAP_TUNING)?> - <?=$listing->getString("title")?></h2>

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

				<button  class="ui-state-default ui-corner-all" type="submit"><?=system_showText(LANG_BUTTON_SAVE_MAP_TUNING);?></button>
			
				<button  class="ui-state-default ui-corner-all" type="button" value="Clear" onClick="document.getElementById('myLatitudeLongitude').value='';document.getElementById('maptuning_form').submit();"><?=system_showText(LANG_BUTTON_CLEAR_MAP_TUNING);?></button>
		

		</form>
		<form action="<?=DEFAULT_URL?>/membros/listing/index.php" method="post">

			<input type="hidden" name="screen" value="<?=$screen?>" />
			<input type="hidden" name="letra" value="<?=$letra?>" />

				<button  class="ui-state-default ui-corner-all" type="submit" value="Cancel"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
		

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
			include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
		?>
