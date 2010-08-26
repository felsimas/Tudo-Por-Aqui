<?

	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();

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

			<div class="response-msg inf ui-corner-all"><?=system_showText(LANG_SITEMGR_SEOCENTER_ABOUT)?></div>

			<table border="0" cellpadding="0" cellspacing="0" class="standard-table">
				<? if (SITEMAP_FEATURE == "on") { ?>
				<tr>
					<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_LABEL_SITEMAP)?></th>
				</tr>
				
					<tr>
						<th><?=system_showText(LANG_SITEMGR_SEOCENTER_LABEL_SITEMAPLINK)?>:</th>
						<td><a href="<?=DEFAULT_URL;?>/sitemap.xml" target="_blank"><?=DEFAULT_URL;?>/sitemap.xml</a><span>(<?=system_showText(LANG_SITEMGR_SEOCENTER_RUNSNIGHTLY)?>)</span></td>
					</tr>
				<? } ?>

                <tr>
                    <th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY)?></th>
                </tr>
                <tr>
                    <th><?=ucwords(system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY_METATAG))?>:</th>
                    <td><a href="<?=DEFAULT_URL;?>/gerenciamento/prefs/searchverify.php"><?=DEFAULT_URL;?>/gerenciamento/prefs/searchverify.php</a></td>
                </tr>
                
				<tr>
					<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_SEOCENTER_HOMEPAGEOPTIMIZATION)?></th>
				</tr>
				<tr>
					<th><?=system_showText(LANG_SITEMGR_SEOCENTER_LABEL_SITECONTENT)?>:</th>
					<td><a href="<?=DEFAULT_URL;?>/gerenciamento/content/index.php"><?=system_showText(LANG_SITEMGR_SEOCENTER_CLICKHERETOGO_SITECONTENTSECTION)?></a><span><?=system_showText(LANG_SITEMGR_SEOCENTER_CLICKHERETOGO_SITECONTENTSECTION_SPAN)?></span></td>
				</tr>
				<tr>
					<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_SEOCENTER_CATEGORYINFORMATION)?></th>
				</tr>
				<tr>
					<th><?=system_showText(LANG_SITEMGR_SEOCENTER_CATEGORIES)?>:</th>
					<td><a href="<?=DEFAULT_URL;?>/gerenciamento/estabelecimentoscategs/index.php"><?=system_showText(LANG_SITEMGR_SEOCENTER_CLICKHERETOGO_CATEGORIESSECTION)?></a><span><?=system_showText(LANG_SITEMGR_SEOCENTER_CLICKHERETOGO_CATEGORIESSECTION_SPAN)?></span></td>
				</tr>
				<tr>
					<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_SEOCENTER_LOCATIONINFORMATION)?></th>
				</tr>
				<tr>
					<th><?=system_showText(LANG_SITEMGR_SEOCENTER_LABEL_LOCATIONS)?>:</th>
					<td><a href="<?=DEFAULT_URL;?>/gerenciamento/locations/index.php"><?=system_showText(LANG_SITEMGR_SEOCENTER_CLICKHERETOGO_LOCATIONSSECTION)?></a><span><?=system_showText(LANG_SITEMGR_SEOCENTER_CLICKHERETOGO_LOCATIONSSECTION_SPAN)?></span></td>
				</tr>
				<tr>
					<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_SEOCENTER_ITEMOPTIMIZATION)?></th>
				</tr>
				<tr>
					<th><?=ucwords(system_showText(LANG_SITEMGR_LISTING_PLURAL))?>:</th>
					<td><a href="<?=DEFAULT_URL?>/gerenciamento/estabelecimentos/"><?=system_showText(LANG_SITEMGR_SEOCENTER_CLICKHERETOGO_LISTINGSSECTION)?></a></td>
				</tr>
				<tr>
					<th><?=ucwords(system_showText(LANG_SITEMGR_NAVBAR_PROMOTION))?>:</th>
					<td><a href="<?=DEFAULT_URL?>/gerenciamento/promotion/"><?=system_showText(LANG_SITEMGR_SEOCENTER_CLICKHERETOGO_PROMOTIONSSECTION)?></a></td>
				</tr>
				<? if (EVENT_FEATURE == "on") { ?>
					<tr>
						<th><?=ucwords(system_showText(LANG_SITEMGR_NAVBAR_EVENT))?>:</th>
						<td><a href="<?=DEFAULT_URL?>/gerenciamento/event/"><?=system_showText(LANG_SITEMGR_SEOCENTER_CLICKHERETOGO_EVENTSSECTION)?></a></td>
					</tr>
				<? } ?>
				<? if (CLASSIFIED_FEATURE == "on") { ?>
					<tr>
						<th><?=ucwords(system_showText(LANG_SITEMGR_NAVBAR_CLASSIFIED))?>:</th>
						<td><a href="<?=DEFAULT_URL?>/gerenciamento/classified/"><?=system_showText(LANG_SITEMGR_SEOCENTER_CLICKHERETOGO_CLASSIFIEDSSECTION)?></a></td>
					</tr>
				<? } ?>
				<? if (ARTICLE_FEATURE == "on") { ?>
					<tr>
						<th><?=ucwords(system_showText(LANG_SITEMGR_NAVBAR_ARTICLE))?>:</th>
						<td><a href="<?=DEFAULT_URL?>/gerenciamento/article/"><?=system_showText(LANG_SITEMGR_SEOCENTER_CLICKHERETOGO_ARTICLESSECTION)?></a></td>
					</tr>
				<? } ?>
			</table>

			<br />


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
