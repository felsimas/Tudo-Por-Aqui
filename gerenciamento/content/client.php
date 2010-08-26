<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/content/client.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

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
	# AUX
	# ----------------------------------------------------------------------------------------------------
	$section = "client";

	# ----------------------------------------------------------------------------------------------------
	# PAGE BROWSING
	# ----------------------------------------------------------------------------------------------------
	$pageObj  = new pageBrowsing("Content", $screen, 20, "id", "id", $letra, "section = 'client'");
	$contents = $pageObj->retrievePage();

	# PAGES DROP DOWN ----------------------------------------------------------------------------------------------
	$paging_url = DEFAULT_URL."/gerenciamento/content/client.php";
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

			<ul class="list-view">
				<li><a href="<?=DEFAULT_URL?>/gerenciamento/content/custom.php"><?=system_showText(LANG_SITEMGR_CONTENT_ADDCUSTOMWEBPAGE)?> &raquo;</a></li>
			</ul>

			<? if ($message) { ?>
				<div class="response-msg success ui-corner-all"><?=$message;?></div>
			<? } ?>

			<? include(INCLUDES_DIR."/tables/table_paging.php"); ?>
			<? include(INCLUDES_DIR."/tables/table_content.php"); ?>

		</div>

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
