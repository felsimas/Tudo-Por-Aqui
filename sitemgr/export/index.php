<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/export/index.php
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

			<? include(INCLUDES_DIR."/tables/table_export_submenu.php"); ?>


			<div id="header-export"><?=system_showText(LANG_SITEMGR_EXPORT_TITLEEXPORTLISTINGSAMEFORMAT)?></div>


					<a  class="btn ui-state-default ui-corner-all" href="<?=DEFAULT_URL?>/gerenciamento/export/listingexport.php">
						
						<span class="ui-icon ui-icon-circle-arrow-n"></span>
						
						<?=system_showText(LANG_SITEMGR_EXPORT_TITLEEXPORTCSVFILE)?>

					</a>
					<div class="clearfix"></div>
			<br />
			<div id="header-export"><?=system_showText(LANG_SITEMGR_EXPORT_CLICKTODOWNLOADDATA)?></div>

			<div style="float: left; width: 313px;">

					<a  class="btn2 ui-state-default ui-corner-all" href="<?=DEFAULT_URL?>/gerenciamento/export/export.php?type=listing" class="link-export">
						<span class="ui-icon ui-icon-circle-arrow-n"></span>
					
						<?=system_showText(LANG_SITEMGR_EXPORT_LINK_SAVEXLSFILE1)?> <?=system_showText(LANG_SITEMGR_LISTING_PLURAL)?> <?=system_showText(LANG_SITEMGR_EXPORT_LINK_SAVEXLSFILE2)?>
					</a>

					<a  class="btn2 ui-state-default ui-corner-all" href="<?=DEFAULT_URL?>/gerenciamento/export/export.php?type=listingCategories" class="link-export">
						<span class="ui-icon ui-icon-circle-arrow-n"></span>
						
						<?=system_showText(LANG_SITEMGR_EXPORT_LINK_SAVEXLSFILE1)?> <?=system_showText(LANG_SITEMGR_LISTING_PLURAL)?> <?=system_showText(LANG_SITEMGR_CATEGORIES)?>  <?=system_showText(LANG_SITEMGR_EXPORT_LINK_SAVEXLSFILE2)?>
					</a>
				

				<? if (BANNER_FEATURE == "on") { ?>
	
						<a  class="btn2 ui-state-default ui-corner-all" href="<?=DEFAULT_URL?>/gerenciamento/export/export.php?type=banner" class="link-export">
							<span class="ui-icon ui-icon-circle-arrow-n"></span>
						
							<?=system_showText(LANG_SITEMGR_EXPORT_LINK_SAVEXLSFILE1)?> <?=system_showText(LANG_SITEMGR_BANNER_PLURAL)?> <?=system_showText(LANG_SITEMGR_EXPORT_LINK_SAVEXLSFILE2)?>
						</a>
					
				<? } ?>
				</div>
				<div style="float: left; width: 313px;">
				
						
					<a  class="btn2 ui-state-default ui-corner-all" href="<?=DEFAULT_URL?>/gerenciamento/export/export.php?type=location" class="link-export">
						<span class="ui-icon ui-icon-circle-arrow-n"></span>
					
						<?=system_showText(LANG_SITEMGR_EXPORT_LINK_SAVEXLSFILE1)?> <?=system_showText(LANG_SITEMGR_EXPORT_LOCATIONTABLES)?> <?=system_showText(LANG_SITEMGR_EXPORT_LINK_SAVEXLSFILE2)?>
					</a>
	
					<a  class="btn2 ui-state-default ui-corner-all" href="<?=DEFAULT_URL?>/gerenciamento/export/export.php?type=account" class="link-export">
						<span class="ui-icon ui-icon-circle-arrow-n"></span>
					
						<?=system_showText(LANG_SITEMGR_EXPORT_LINK_SAVEXLSFILE1)?> <?=system_showText(LANG_SITEMGR_ACCOUNT_PLURAL)?> <?=system_showText(LANG_SITEMGR_EXPORT_LINK_SAVEXLSFILE2)?>
					</a>

					<a class="btn2 ui-state-default ui-corner-all" href="<?=DEFAULT_URL?>/gerenciamento/export/emailgenerate.php" class="link-export">
						<span class="ui-icon ui-icon-circle-arrow-n"></span>
						
						<?=system_showText(LANG_SITEMGR_EXPORT_GENERATEEMAILLIST)?>
					</a>
					</div>
					<div class="clearfix"></div>

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
