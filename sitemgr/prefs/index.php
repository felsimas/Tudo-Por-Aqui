<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/prefs/index.php
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

			<? include(INCLUDES_DIR."/tables/table_prefs_submenu.php"); ?>

			<br />

			<div id="header-form">
				<?=system_showText(LANG_SITEMGR_SETTINGS_SITEMGRSETTINGS)?>
			</div>

			<ul class="list-view">

				<? if (DEMO_MODE == 0) { ?>
				<li><a href="<?=DEFAULT_URL?>/gerenciamento/prefs/theme.php"><?=ucwords(system_showText(LANG_SITEMGR_MENU_THEMES));?></a></li>
				<? } ?>

				<li><a href="<?=DEFAULT_URL?>/gerenciamento/prefs/promotion.php"><?=ucwords(system_showText(LANG_SITEMGR_PROMOTION_PLURAL));?></a></li>

				<li><a href="<?=DEFAULT_URL?>/gerenciamento/prefs/email.php"><?=ucwords(system_showText(LANG_SITEMGR_LABEL_EMAIL));?></a></li>

				<li><a href="<?=DEFAULT_URL?>/gerenciamento/prefs/emailconfig.php"><?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_EMAILSENDINGCONFIGURATION)?></a></li>

				<li><a href="<?=DEFAULT_URL?>/gerenciamento/prefs/review.php"><?=system_showText(LANG_SITEMGR_MENU_REVIEWS)?></a></li>

				<li><a href="<?=DEFAULT_URL?>/gerenciamento/prefs/editorchoice.php"><?=ucwords(system_showText(LANG_SITEMGR_SETTINGS_EDITORCHOICE_DESIGNATIONS))?></a></li>

				<li><a href="<?=DEFAULT_URL?>/gerenciamento/prefs/pricing.php"><?=ucwords(system_showText(LANG_SITEMGR_SETTINGS_PRICING))?></a></li>

				<? if(ABLE_RENAME_LEVEL == 'on') { ?>
					<li><a href="<?=DEFAULT_URL?>/gerenciamento/prefs/levels.php"><?=system_showText(LANG_SITEMGR_SETTINGS_LEVELS_MENULABEL)?></a></li>
				<? } ?>

				<? if (PAYMENT_FEATURE == "on") { ?>
					<? if (CREDITCARDPAYMENT_FEATURE == "on") { ?>
						<li><a href="<?=DEFAULT_URL?>/gerenciamento/prefs/paymentgateway.php"><?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_PAYMENTGATEWAY)?></a></li>
					<? } ?>
				<? } ?>

				<? if (PAYMENT_FEATURE == "on") { ?>
					<? if (INVOICEPAYMENT_FEATURE == "on") { ?>
						<li><a href="<?=DEFAULT_URL?>/gerenciamento/prefs/invoice.php"><?=ucwords(system_showText(LANG_SITEMGR_INVOICE))?></a></li>
					<? } ?>
				<? } ?>

				<li><a href="<?=DEFAULT_URL?>/gerenciamento/prefs/import.php"><?=ucwords(system_showText(LANG_SITEMGR_IMPORT))?></a></li>

				<? if (CLAIM_FEATURE == "on") { ?>
					<li><a href="<?=DEFAULT_URL?>/gerenciamento/prefs/claim.php"><?=ucwords(system_showText(LANG_SITEMGR_CLAIM_CLAIMS))?></a></li>
				<? } ?>

				<li><a href="<?=DEFAULT_URL?>/gerenciamento/prefs/foreignaccount.php"><?=ucwords(system_showText(LANG_SITEMGR_MENU_LOGINOPTIONS))?></a></li>

			</ul>

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
