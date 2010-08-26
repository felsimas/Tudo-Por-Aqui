<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/event/gallery.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (EVENT_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/gerenciamento/event";
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
	include(EDIRECTORY_ROOT."/includes/code/item_gallery.php");

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
		<div id="header-content"><h1><?=system_showText(LANG_SITEMGR_EVENT_SING)?> <?=ucwords(system_showText(LANG_SITEMGR_GALLERY))?> - <?=$item->getString("title")?></h1></div>
	</div>

	<div id="content-content">

		<div class="default-margin" style="padding-top:3px;">

			<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? include(INCLUDES_DIR."/tables/table_event_submenu.php"); ?>

			<table border="0" cellpadding="0" cellspacing="0" class="standard-table">
				<tr>
					<th class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_ADDGALLERY)?>:</th>
				</tr>
				<tr>
					<td style="background: none;">
						<button type="button" name="new_gallery" class="ui-state-default ui-corner-all" onclick="javascript:document.location='<?=DEFAULT_URL?>/gerenciamento/gallery/gallery.php?item_type=event&item_id=<?=$item->getNumber("id")?><?=(($url_search_params) ? "&$url_search_params" : "");?>';" style="width: 200px; font-weight: bold; color: #FFF;"><?=system_showText(LANG_SITEMGR_ADDGALLERY)?></button>
					</td>
				</tr>
			</table>

			<? $eventLevelGallery = new EventLevel(); ?>
			<div class="response-msg inf ui-corner-all"><?=system_showText(LANG_SITEMGR_EVENT_MSGGALLERY1)?> <?=(($eventLevelGallery->getImages($item->getNumber("level")) == -1) ? (system_showText(LANG_SITEMGR_ULIMITED)) : ($eventLevelGallery->getImages($item->getNumber("level"))));?> <?=system_showText(LANG_SITEMGR_CLASSIFIED_MSGGALLERY2)?></div>

			<table border="0" cellpadding="0" cellspacing="0" class="standard-table" style="margin-bottom: 0;">
				<tr>
					<th class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_ASSOCIATEGALLERY)?> <?=(system_showText(LANG_SITEMGR_EVENT_SING))?>:</th>
				</tr>
			</table>
			
			<div class="baseForm">

			<form name="gallery" action="<?=$_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data">
				<input type="hidden" name="item_id" value="<?=$item_id?>" />
				<input type="hidden" name="item_type" value="event" />
				<input type="hidden" name="letra" value="<?=$letra?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />
				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>

				<? include(INCLUDES_DIR."/forms/form_itemgallery.php"); ?>

				<button type="submit" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>

				<button type="button" value="Cancel" class="ui-state-default ui-corner-all" onclick="document.getElementById('formeventgallerycancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>

			</form>
			<form id="formeventgallerycancel" action="<?=DEFAULT_URL?>/gerenciamento/event/<?=(($search_page) ? "search.php" : "index.php");?>" method="post">

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
