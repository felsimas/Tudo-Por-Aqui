<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/classified/view.php
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
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/gerenciamento/classified";
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
	$errorPage = DEFAULT_URL."/gerenciamento/classified/index.php?message=".urlencode($message)."&screen=$screen&letra=$letra";
	if ($id) {
		$classified = new Classified($id);
		if ((!$classified->getNumber("id")) || ($classified->getNumber("id") <= 0)) {
			header("Location: ".$errorPage);
			exit;
		}
	} else {
		header("Location: ".$errorPage);
		exit;
	}

	if ($classified->getNumber("account_id")) $account = new Account($classified->getNumber("account_id"));

	$level = new ClassifiedLevel();
	$classifiedImages = $level->getImages($classified->getNumber("level"));

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
			<h1><?=system_showText(LANG_SITEMGR_CLASSIFIED_SING)?> - <?=ucwords(system_showText(LANG_SITEMGR_DETAIL))?></h1>
		</div>
	</div>
	<div id="content-content">
		<div class="default-margin" style="padding-top:3px;">

			<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? if($classified->getString("id") == 0){ ?>
				<p class="errorMessage"> <?=system_showText(LANG_SITEMGR_CLASSIFIED_MIGHTBEDELETED)?></p>
			<? } else { ?>

				<? include(INCLUDES_DIR."/tables/table_classified_submenu.php"); ?>

				<br />
				<div id="header-view"><?=system_showText(LANG_SITEMGR_MANAGE)?> <?=system_showText(LANG_SITEMGR_CLASSIFIED_SING)?> - <?=$classified->getString("title")?></div>
				<ul class="list-view columnListView">

					<li><a href="<?=DEFAULT_URL?>/gerenciamento/classified/classified.php?id=<?=$classified->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?>" class="link-view"><?=system_showText(LANG_SITEMGR_EDIT)?> <?=ucfirst(system_showText(LANG_SITEMGR_INFORMATION))?></a></li>
					<li><a href="<?=DEFAULT_URL?>/gerenciamento/classified/classifiedlevel.php?id=<?=$classified->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?>" class="link-view"><?=system_showText(LANG_SITEMGR_EDIT)?> <?=system_showText(LANG_SITEMGR_LEVEL)?></a></li>
					<li>
						<a href="<?=DEFAULT_URL?>/gerenciamento/classified/delete.php?id=<?=$classified->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?>" class="link-view"><?=system_showText(LANG_SITEMGR_DELETE)?> <?=system_showText(LANG_SITEMGR_CLASSIFIED_SING)?></a>
					</li>
					<li>
						<a href="<?=DEFAULT_URL?>/gerenciamento/classified/settings.php?id=<?=$classified->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?>" class="link-view"><?=system_showText(LANG_SITEMGR_MENU_SETTINGS)?></a>
					</li>

					<? if ((CLASSIFIED_MAX_GALLERY > 0) && (($classifiedImages > 0) || ($classifiedImages == -1))) { ?>
						<li><a href="<?=DEFAULT_URL?>/gerenciamento/classified/gallery.php?item_type=classified&item_id=<?=$classified->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-view"><?=system_showText(LANG_SITEMGR_PHOTOGALLERY)?></a></li>
					<? } ?>

					<? if (GOOGLE_MAPS_ENABLED == "on") { ?>
						<li><a href="<?=DEFAULT_URL?>/gerenciamento/classified/maptuning.php?id=<?=$classified->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-view"><?=ucwords(system_showText(LANG_SITEMGR_MAPTUNING))?></a></li>
					<? } ?>

					<li>
						<?=system_showText(LANG_SITEMGR_LABEL_ACCOUNT)?>:
						<? if (!$account) { ?>
							<em><?=system_showText(LANG_SITEMGR_NOOWNER)?></em>
						<? } else { ?>
							<a href="<?=DEFAULT_URL?>/gerenciamento/account/view.php?id=<?=$classified->getNumber("account_id")?>" class="link-view">
								<?=system_showAccountUserName($account->getString("username"))?>
							</a>
						<? } ?>
					</li>

				</ul>
				
				<ul class="list-view columnListView secondaryListView">
					<li><strong><?=system_showText(LANG_SITEMGR_DATECREATED)?>:</strong> <span class="label-field-account"><?=format_date($classified->getNumber("entered"),DEFAULT_DATE_FORMAT." - H:i:s", "datetime")?></span></li>
					<li><strong><?=system_showText(LANG_SITEMGR_LASTUPDATED)?>:</strong> <span class="label-field-account"><?=format_date($classified->getNumber("updated"),DEFAULT_DATE_FORMAT." - H:i:s", "datetime")?></span></li>
				</ul>
				
				<br class="clear" />

				<div id="header-view"><?=system_showText(LANG_SITEMGR_CLASSIFIED_SING)?> <?=ucwords(system_showText(LANG_SITEMGR_PREVIEW))?></div>
				<center>
					<a href="javascript:void(0);" onclick="javascript:window.open('<?=DEFAULT_URL?>/gerenciamento/classified/preview.php?id=<?=$classified->getNumber("id")?>', '', 'toolbar=0, location=0, directories=0, status=0, scrollbars=yes, width=800, height=400, screenX=0, screenY=0, menubar=0');" class="standardLINK"><?=system_showText(LANG_SITEMGR_CLICKHERETOPREVIEW)?> <?=system_showText(LANG_SITEMGR_CLASSIFIED_SING)?></a>
				</center>

			<? } ?>

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
