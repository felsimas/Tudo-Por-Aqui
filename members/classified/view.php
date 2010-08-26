<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/classified/view.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLASSIFIED_FEATURE != "on") { exit; }

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
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$errorPage = "".DEFAULT_URL."/membros/classified/index.php?screen=$screen&letra=$letra";
	if ($id) {
		$classified = new Classified($id);
		if ((!$classified->getNumber("id")) || ($classified->getNumber("id") <= 0)) {
			header("Location: ".$errorPage);
			exit;
		}
		if (sess_getAccountIdFromSession() != $classified->getNumber("account_id")) {
			header("Location: ".$errorPage);
			exit;
		}
	} else {
		header("Location: ".$errorPage);
		exit;
	}

	$account = new Account($classified->getNumber("account_id"));

	$level = new ClassifiedLevel();
	$classifiedImages = $level->getImages($classified->getNumber("level"));

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

		<h1 class="standardTitle"><?=system_highlightLastWord(system_showText(LANG_CLASSIFIED_DETAIL));?></h1>

		<ul class="list-view">
			<li class="list-back"><a href="javascript:history.back(-1);"><?=system_showText(LANG_LABEL_BACK);?></a></li>
		</ul>

		<? if($classified->getString("id") == 0){ ?>
			<p class="errorMessage"><?=system_showText(LANG_NO_CLASSIFIED_FOUND);?></p>
		<? } else { ?>

			<h2 class="standardSubTitle"><?=system_showText(LANG_MANAGE_CLASSIFIED);?> - <?=$classified->getString("title")?></h2>

			<ul class="list-view">
				<li><a href="<?=DEFAULT_URL?>/membros/classified/classified.php?id=<?=$classified->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?>"><?=system_showText(LANG_CLASSIFIED_EDIT_INFORMATION);?></a></li>
				<li><a href="<?=DEFAULT_URL?>/membros/classified/classifiedlevel.php?id=<?=$classified->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?>"><?=system_showText(LANG_CLASSIFIED_EDIT_LEVEL);?></a></li>
				<li><a href="<?=DEFAULT_URL?>/membros/classified/delete.php?id=<?=$classified->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?>" class="link-view"><?=system_showText(LANG_CLASSIFIED_DELETE);?></a></li>

				<? if ((CLASSIFIED_MAX_GALLERY > 0) && (($classifiedImages > 0) || ($classifiedImages == -1))) { ?>
					<li><a href="<?=DEFAULT_URL?>/membros/classified/gallery.php?item_type=classified&item_id=<?=$classified->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?>"><?=system_showText(LANG_LABEL_PHOTO_GALLERY);?></a></li>
				<? } ?>

				<? if (GOOGLE_MAPS_ENABLED == "on") { ?>
					<li><a href="<?=DEFAULT_URL?>/membros/classified/maptuning.php?id=<?=$classified->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?>"><?=system_showText(LANG_LABEL_MAP_TUNING);?></a></li>
				<? } ?>

			</ul>

			<h2 class="standardSubTitle"><?=system_showText(LANG_CLASSIFIED_PREVIEW);?></h2>
			<center>
				<a href="javascript:void(0);" onclick="javascript:window.open('<?=DEFAULT_URL?>/membros/classified/preview.php?id=<?=$classified->getNumber("id")?>', '', 'toolbar=0, location=0, directories=0, status=0, scrollbars=yes, width=800, height=400, screenX=0, screenY=0, menubar=0');" class="standardLINK"><?=system_showText(LANG_MSG_CLICK_TO_PREVIEW_THIS_CLASSIFIED);?></a>
			</center>

		<? } ?>

	</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>
