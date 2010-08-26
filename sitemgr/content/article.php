<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/content/article.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (ARTICLE_FEATURE != "on") { exit; }

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
	$pageObj  = new pageBrowsing("Content", $screen, 20, "id", "id", $letra, "section = 'article'");
	$contents = $pageObj->retrievePage();

	# PAGES DROP DOWN ----------------------------------------------------------------------------------------------
	$paging_url = DEFAULT_URL."/gerenciamento/content/article.php";
	$pagesDropDown = $pageObj->getPagesDropDown($_GET, $paging_url, $screen, system_showText(LANG_SITEMGR_PAGING_GOTOPAGE)." ", "this.form.submit();");
	# --------------------------------------------------------------------------------------------------------------


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

			<? include(INCLUDES_DIR."/tables/table_content_submenu.php"); ?>

			<?
			include(INCLUDES_DIR."/tables/table_paging.php");
			include(INCLUDES_DIR."/tables/table_content.php");
			?>

			<br />

			<table class="table-table">

				<tr class="th-table">
					<td class="td-th-table"><?=ucwords(system_showText(LANG_SITEMGR_ARTICLE))?> <?=strtolower(system_showText(LANG_SITEMGR_LEVELADVERTISEMENT))?></td>
					<td class="td-th-table" style="width: 60px;">&nbsp;</td>
				</tr>

				<?
				$articleLevelObj = new ArticleLevel();
				$levelValue = $articleLevelObj->getValues();
				foreach ($levelValue as $value) {
				?>
					<tr class="tr-table">
						<td class="td-table">
							<a href="<?=DEFAULT_URL?>/gerenciamento/content/contentlevel.php?section=article&value=<?=$value?>" class="link-table">
								<?=$articleLevelObj->showLevel($value)?>
							</a>
						</td>
						<td class="td-table">
							<img src="<?=DEFAULT_URL?>/images/icon_seof_off.gif" alt="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" title="<?=system_showText(LANG_SITEMGR_SEOCENTER_SEOFEATURE)?>" border="0" />
							<a href="<?=DEFAULT_URL?>/gerenciamento/content/contentlevel.php?section=article&value=<?=$value?>" class="link-table">
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
