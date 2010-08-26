<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/content/event.php
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

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	# ----------------------------------------------------------------------------------------------------
	# PAGE BROWSING
	# ----------------------------------------------------------------------------------------------------
	$pageObj  = new pageBrowsing("Content", $screen, 20, "id", "id", $letra, "section = 'event'");
	$contents = $pageObj->retrievePage();

	# PAGES DROP DOWN ----------------------------------------------------------------------------------------------
	$paging_url = DEFAULT_URL."/gerenciamento/content/event.php";
	$pagesDropDown = $pageObj->getPagesDropDown($_GET, $paging_url, $screen, system_showText(LANG_SITEMGR_PAGING_GOTOPAGE)." ", "this.form.submit();");
	# --------------------------------------------------------------------------------------------------------------

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
			<h1><?=ucwords(system_showText(LANG_SITEMGR_CONTENT_MANAGECONTENT))?></h1>
		</div>
	</div>

	<div id="content-content">

		<div class="default-margin" style="padding-top: 3px;">

			<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? include(INCLUDES_DIR."/tables/table_content_submenu.php"); ?>

			<?
			include(INCLUDES_DIR."/tables/table_paging.php");
			include(INCLUDES_DIR."/tables/table_content.php");
			?>

			<br />

			<table class="table-table">

				<tr class="th-table">
					<td class="td-th-table"><?=system_showText(LANG_SITEMGR_NAVBAR_EVENT)?> <?=strtolower(system_showText(LANG_SITEMGR_LEVELADVERTISEMENT))?></td>
					<td class="td-th-table" style="width: 60px;">&nbsp;</td>
				</tr>

				<?
				$eventLevelObj = new EventLevel();
				$levelValue = $eventLevelObj->getValues();
				foreach ($levelValue as $value) {
					?>
					<tr class="tr-table">
						<td class="td-table">
							<a href="<?=DEFAULT_URL?>/gerenciamento/content/contentlevel.php?section=event&value=<?=$value?>" class="link-table">
								<?=$eventLevelObj->showLevel($value)?>
							</a>
						</td>
						<td class="td-table">
							<img src="<?=DEFAULT_URL?>/images/icon_seof_off.gif" alt="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" title="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" border="0" />
							<a href="<?=DEFAULT_URL?>/gerenciamento/content/contentlevel.php?section=event&value=<?=$value?>" class="link-table">
								<img src="<?=DEFAULT_URL?>/images/bt_edit.gif" alt="<?=strtolower(system_showText(LANG_SITEMGR_EDIT))?>" title="<?=strtolower(system_showText(LANG_SITEMGR_EDIT))?>" border="0" />
							</a>
							<img src="<?=DEFAULT_URL?>/images/bt_delete_off.gif" alt="<?=system_showText(LANG_SITEMGR_DELETE)?>" title="<?=system_showText(LANG_SITEMGR_DELETE)?>" border="0" />
						</td>
					</tr>
					<?
				}
				?>

			</table>

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
