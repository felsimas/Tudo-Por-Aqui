<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/event/view.php
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
	sess_validateSession();

	extract($_GET);
	extract($_POST);
	
	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$event = new Event($id);
		if (sess_getAccountIdFromSession() != $event->getNumber("account_id")) {
			header("Location: ".DEFAULT_URL."/membros/event/index.php?screen=$screen&letra=$letra");
			exit;
		}
	}
	else {
		header("Location: ".DEFAULT_URL."/membros/event/index.php?screen=$screen&letra=$letra");
		exit;
	}

	$level = new EventLevel();
	$eventImages = $level->getImages($event->getNumber("level"));

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

				<h1 class="standardTitle"><?=system_highlightLastWord(system_showText(LANG_EVENT_DETAIL));?></span></h1>

				<ul class="list-view">
					<li class="list-back"><a href="javascript:history.back(-1);"><?=system_showText(LANG_LABEL_BACK);?></a></li>
				</ul>

				<h2 class="standardSubTitle"><?=system_showText(LANG_MANAGE_EVENT);?> - <?=$event->getString("title")?></h2>

				<ul class="list-view">
					<li><a href="<?=DEFAULT_URL?>/membros/event/event.php?id=<?=$event->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?>"><?=system_showText(LANG_EVENT_EDIT_INFORMATION);?></a></li>
					<li><a href="<?=DEFAULT_URL?>/membros/event/delete.php?id=<?=$event->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?>"><?=system_showText(LANG_EVENT_DELETE);?></a></li>

					<? if ((EVENT_MAX_GALLERY > 0) && (($eventImages > 0) || ($eventImages == -1))) { ?>
						<li><a href="<?=DEFAULT_URL?>/membros/event/gallery.php?item_type=event&item_id=<?=$event->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?>"><?=system_showText(LANG_LABEL_PHOTO_GALLERY);?></a></li>
					<? } ?>

					<? if (GOOGLE_MAPS_ENABLED == "on") { ?>
						<li><a href="<?=DEFAULT_URL?>/membros/event/maptuning.php?id=<?=$event->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?>"><?=system_showText(LANG_LABEL_MAP_TUNING);?></a></li>
					<? } ?>

				</ul>

				<h2 class="standardSubTitle"><?=system_showText(LANG_EVENT_PREVIEW);?></h2>

				<center><a href="javascript:void(0);" onclick="javascript:window.open('<?=DEFAULT_URL?>/membros/event/preview.php?id=<?=$event->getNumber("id")?>', '', 'toolbar=0, location=0, directories=0, status=0, scrollbars=yes, width=800, height=400, screenX=0, screenY=0, menubar=0');" class="standardLINK"><?=system_showText(LANG_MSG_CLICK_TO_PREVIEW_THIS_EVENT);?></a></center>

			</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>
