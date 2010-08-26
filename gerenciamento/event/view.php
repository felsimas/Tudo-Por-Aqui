<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/event/view.php
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

	extract($_POST);
	extract($_GET);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$event = new Event($id);
		if ((!$event->getNumber("id")) || ($event->getNumber("id") <= 0)) {
			header("Location: ".DEFAULT_URL."/gerenciamento/event/index.php?message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
			exit;
		}
		if ($event->getNumber("account_id")) $account = new Account($event->getNumber("account_id"));
	} else {
		header("Location: ".DEFAULT_URL."/gerenciamento/event/index.php?message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
		exit;
	}

	$level = new EventLevel();
	$eventImages = $level->getImages($event->getNumber("level"));

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
		<h1><?=system_showText(LANG_SITEMGR_EVENT_SING)?> - <?=ucwords(system_showText(LANG_SITEMGR_DETAIL))?></h1>
	</div>
</div>
<div id="content-content">
	<div class="default-margin" style="padding-top:3px;">

		<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

		<? include(INCLUDES_DIR."/tables/table_event_submenu.php"); ?>

		<br />
		<div id="header-view">
			<?=ucwords(system_showText(LANG_SITEMGR_MANAGE))?> <?=system_showText(LANG_SITEMGR_EVENT_SING)?> - <?=$event->getString("title")?>
		</div>
		<ul class="list-view">
		  <li>
				<a href="<?=DEFAULT_URL?>/gerenciamento/event/event.php?id=<?=$event->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-view">
					<?=ucwords(system_showText(LANG_SITEMGR_EDIT))?> <?=LANG_SITEMGR_EVENT_SING;?>
				</a>
			</li>	
			<li>
				<a href="<?=DEFAULT_URL?>/gerenciamento/event/delete.php?id=<?=$event->getNumber("id")?>" class="link-view">
					<?=ucwords(system_showText(LANG_SITEMGR_DELETE))?> <?=LANG_SITEMGR_EVENT_SING;?>
				</a>
			</li>
			<li>
				<a href="<?=DEFAULT_URL?>/gerenciamento/event/settings.php?id=<?=$event->getNumber("id")?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-view">
					<?=ucwords(LANG_SITEMGR_MENU_SETTINGS);?>
				</a>
			</li>
			<? if ((EVENT_MAX_GALLERY > 0) && (($eventImages > 0) || ($eventImages == -1))) { ?>
			<li>
				<a href="<?=DEFAULT_URL?>/gerenciamento/event/gallery.php?item_type=event&item_id=<?=$id?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-view">
					<?=ucwords(system_showText(LANG_SITEMGR_PHOTOGALLERY))?>
				</a>
			</li>
			<? } ?>
			<? if (GOOGLE_MAPS_ENABLED == "on") { ?>
			<li>
				<a href="<?=DEFAULT_URL?>/gerenciamento/event/maptuning.php?id=<?=$id?>&screen=<?=$screen?>&letra=<?=$letra?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-view">
					<?=ucwords(system_showText(LANG_SITEMGR_MAPTUNING))?>
				</a>
			</li>
			<? } ?>
			<li>
				<?=ucwords(system_showText(LANG_SITEMGR_LABEL_ACCOUNT))?>:
				<? if (!$account) { ?>
					<em><?=system_showText(LANG_SITEMGR_NOOWNER)?></em>
				<? } else { ?>
					<a href="<?=DEFAULT_URL?>/gerenciamento/account/view.php?id=<?=$event->getNumber("account_id")?>" class="link-view">
						<?=system_showAccountUserName($account->getString("username"))?>
					</a>
				<? } ?>
			</li>
		</ul>

		<div id="header-view"><?=LANG_SITEMGR_EVENT_SING;?> <?=ucwords(system_showText(LANG_SITEMGR_PREVIEW))?></div>
		<center>
			<a href="javascript:void(0);" onclick="javascript:window.open('<?=DEFAULT_URL?>/gerenciamento/event/preview.php?id=<?=$event->getNumber("id")?>', '', 'toolbar=0, location=0, directories=0, status=0, scrollbars=yes, width=800, height=400, screenX=0, screenY=0, menubar=0');" class="standardLINK"><?=system_showText(LANG_SITEMGR_CLICKHERETOPREVIEW)?> <?=system_showText(LANG_SITEMGR_EVENT)?></a>
		</center>

	</div>
</div>
<div id="bottom-content">
	&nbsp;
</div>
</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>