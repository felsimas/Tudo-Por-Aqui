<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/layout/navbar.php
	# ----------------------------------------------------------------------------------------------------

?>

<div id="main-left">

	<div id="top-navbar">
		<div id="header-navbar"><?=system_showText(LANG_SITEMGR_NAVBAR_OPTIONS)?></div>
	</div>

	<div id="content-navbar">
		<dl class="navBar">

			<?
			unset($availablemodules);
			$availablemodules = 0;
			?>
			<dt><?=system_showText(LANG_SITEMGR_NAVBAR_MODULES)?>asds</dt>
			<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_LISTINGS)) { ?>
				<li><a href="<?=DEFAULT_URL?>/gerenciamento/estabelecimentos/">ss<?=system_showText(LANG_SITEMGR_NAVBAR_LISTING);?></a></li>
				<? $availablemodules++; ?>
			<? } ?>
			<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_GALLERIES)) { ?>
				<li><a href="<?=DEFAULT_URL?>/gerenciamento/gallery/"><?=system_showText(LANG_SITEMGR_NAVBAR_GALLERY)?></a></li>
				<? $availablemodules++; ?>
			<? } ?>
			<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_LISTINGS)) { ?>
				<li><a href="<?=DEFAULT_URL?>/gerenciamento/promotion/"><?=system_showText(LANG_SITEMGR_NAVBAR_PROMOTION);?></a></li>
				<? $availablemodules++; ?>
			<? } ?>
			<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_EVENTS)) { ?>
				<? if (EVENT_FEATURE == "on") { ?>
					<li><a href="<?=DEFAULT_URL?>/gerenciamento/event/"><?=system_showText(LANG_SITEMGR_NAVBAR_EVENT);?><? if (DEMO_MODE) { ?><span>*</span> <? } ?></a></li>
					<? $availablemodules++; ?>
				<? } ?>
			<? } ?>
			<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_BANNERS)) { ?>
				<? if (BANNER_FEATURE == "on") { ?>
					<li><a href="<?=DEFAULT_URL?>/gerenciamento/banner/"><?=system_showText(LANG_SITEMGR_NAVBAR_BANNER);?><? if (DEMO_MODE) { ?><span>*</span><? } ?></a></li>
					<? $availablemodules++; ?>
				<? } ?>
			<? } ?>
			<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_CLASSIFIEDS)) { ?>
				<? if (CLASSIFIED_FEATURE == "on") { ?>
					<li><a href="<?=DEFAULT_URL?>/gerenciamento/classified/"><?=system_showText(LANG_SITEMGR_NAVBAR_CLASSIFIED);?><? if (DEMO_MODE) { ?><span>*</span><? } ?></a></li>
					<? $availablemodules++; ?>
				<? } ?>
			<? } ?>
			<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_ARTICLES)) { ?>
				<? if (ARTICLE_FEATURE == "on") { ?>
					<li><a href="<?=DEFAULT_URL?>/gerenciamento/article/"><?=system_showText(LANG_SITEMGR_NAVBAR_ARTICLE);?><? if (DEMO_MODE) { ?><span>*</span><? } ?></a></li>
					<? $availablemodules++; ?>
				<? } ?>
			<? } ?>
			<?
			if (!$availablemodules) {
				?><li class="noModules"><?=system_showText(LANG_SITEMGR_NAVBAR_NOMODULES)?></li><?
			}
			unset($availablemodules);
			?>
as
			<? if (!$_SESSION[SESS_SM_ID]) { ?>
				<dt>xxx<a href="<?=DEFAULT_URL?>/gerenciamento/seocenter.php"><?=system_showText(LANG_SITEMGR_NAVBAR_SEOCENTER)?></a></dt>
			<? } ?>

			<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_ACCOUNTS)) { ?>
				<? if ((strpos($_SERVER["PHP_SELF"], "sitemgr/account") !== false) || (strpos($_SERVER["PHP_SELF"], "sitemgr/smaccount") !== false)) { ?>
					<dt>qqq<?=system_showText(LANG_SITEMGR_NAVBAR_ACCOUNTS)?></dt>
				<? } else { ?>
					<dt>qqq<a href="<?=DEFAULT_URL?>/gerenciamento/account/"><?=system_showText(LANG_SITEMGR_NAVBAR_ACCOUNTS)?></a></a>
				<? } ?>
				<? if ((strpos($_SERVER["PHP_SELF"], "sitemgr/account") !== false) || (strpos($_SERVER["PHP_SELF"], "sitemgr/smaccount") !== false)) { ?>
					<li><a href="<?=DEFAULT_URL?>/gerenciamento/account/"><?=system_showText(LANG_SITEMGR_NAVBAR_MEMBERACCOUNTS)?></a></li>
					<li><a href="<?=DEFAULT_URL?>/gerenciamento/smaccount/"><?=system_showText(LANG_SITEMGR_NAVBAR_SITEMGRACCOUNTS)?></a></li>
				<? } ?>
			<? } ?>
zzz
			<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_PAYMENT)) { ?>
				<? if (PAYMENT_FEATURE == "on") { ?>
					<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on") || (MANUALPAYMENT_FEATURE == "on")) { ?>
						<? if ((strpos($_SERVER["PHP_SELF"], "sitemgr/transactions") !== false) || (strpos($_SERVER["PHP_SELF"], "sitemgr/invoices") !== false) || (strpos($_SERVER["PHP_SELF"], "sitemgr/custominvoices") !== false) || (strpos($_SERVER["PHP_SELF"], "sitemgr/discountcode") !== false)) { ?>
							<dt>xxx<?=system_showText(LANG_SITEMGR_NAVBAR_PAYMENT)?></dt>
						<? } else { ?>
							<? if ((MANUALPAYMENT_FEATURE == "on") || (CREDITCARDPAYMENT_FEATURE == "on")) { ?>
								<dt><a href="<?=DEFAULT_URL?>/gerenciamento/transactions/index.php"><?=system_showText(LANG_SITEMGR_NAVBAR_PAYMENT)?></a></dt>
							<? } elseif (INVOICEPAYMENT_FEATURE == "on") { ?>
								<dt><a href="<?=DEFAULT_URL?>/gerenciamento/invoices/index.php"><?=system_showText(LANG_SITEMGR_NAVBAR_PAYMENT)?></a></dt>
							<? } ?>
						<? } ?>
						<? if ((strpos($_SERVER["PHP_SELF"], "sitemgr/transactions") !== false) || (strpos($_SERVER["PHP_SELF"], "sitemgr/invoices") !== false) || (strpos($_SERVER["PHP_SELF"], "sitemgr/custominvoices") !== false) || (strpos($_SERVER["PHP_SELF"], "sitemgr/discountcode") !== false)) { ?>
							<? if ((MANUALPAYMENT_FEATURE == "on") || (CREDITCARDPAYMENT_FEATURE == "on")) { ?>
								<li><a href="<?=DEFAULT_URL?>/gerenciamento/transactions/index.php"><?=system_showText(LANG_SITEMGR_NAVBAR_TRANSACTIONHISTORY)?></a></li>
							<? } ?>
							<? if (INVOICEPAYMENT_FEATURE == "on") { ?>
								<li><a href="<?=DEFAULT_URL?>/gerenciamento/invoices/index.php"><?=system_showText(LANG_SITEMGR_NAVBAR_INVOICEHISTORY)?></a></li>
							<? } ?>
							<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
								<? if (CUSTOM_INVOICE_FEATURE == "on") { ?>
									<li><a href="<?=DEFAULT_URL?>/gerenciamento/custominvoices/index.php"><?=system_showText(LANG_SITEMGR_NAVBAR_CREATEINVOICE)?></a></li>
								<? } ?>
							<? } ?>
							<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
								<li><a href="<?=DEFAULT_URL?>/gerenciamento/discountcode/"><?=ucwords(system_showText(LANG_LABEL_DISCOUNTCODE))?></a></li>
							<? } ?>
						<? } ?>
					<? } ?>
				<? } ?>
			<? } ?>

			<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_IMPORTEXPORT)) { ?>
				<? if ((strpos($_SERVER["PHP_SELF"], "sitemgr/import") !== false) || (strpos($_SERVER["PHP_SELF"], "sitemgr/export") !== false)) { ?>
					<dt><?=system_showText(LANG_SITEMGR_NAVBAR_IMPORTEXPORT)?></dt>
				<? } else { ?>
					<dt><a href="<?=DEFAULT_URL?>/gerenciamento/import/"><?=system_showText(LANG_SITEMGR_NAVBAR_IMPORTEXPORT)?></a></dt>
				<? } ?>
				<? if ((strpos($_SERVER["PHP_SELF"], "sitemgr/import") !== false) || (strpos($_SERVER["PHP_SELF"], "sitemgr/export") !== false)) { ?>
					<li><a href="<?=DEFAULT_URL?>/gerenciamento/import/"><?=system_showText(LANG_SITEMGR_NAVBAR_IMPORTLISTINGS)?></a></li>
					<li><a href="<?=DEFAULT_URL?>/gerenciamento/export/"><?=system_showText(LANG_SITEMGR_NAVBAR_EXPORTDATA)?></a></li>
				<? } ?>
			<? } ?>

			<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_CATEGORIES)) { ?>
				<? if ((strpos($_SERVER["PHP_SELF"], "sitemgr/listingcategs") !== false) || (strpos($_SERVER["PHP_SELF"], "sitemgr/eventcategs") !== false) || (strpos($_SERVER["PHP_SELF"], "sitemgr/classifiedcategs") !== false) || (strpos($_SERVER["PHP_SELF"], "sitemgr/articlecategs") !== false)) { ?>
					<dt><?=system_showText(LANG_SITEMGR_NAVBAR_CATEGORIES)?></dt>
				<? } else { ?>
					<dt><a href="<?=DEFAULT_URL?>/gerenciamento/estabelecimentoscategs/index.php"><?=system_showText(LANG_SITEMGR_NAVBAR_CATEGORIES)?></a></dt>
				<? } ?>
				<? if ((strpos($_SERVER["PHP_SELF"], "sitemgr/listingcategs") !== false) || (strpos($_SERVER["PHP_SELF"], "sitemgr/eventcategs") !== false) || (strpos($_SERVER["PHP_SELF"], "sitemgr/classifiedcategs") !== false) || (strpos($_SERVER["PHP_SELF"], "sitemgr/articlecategs") !== false)) { ?>
					<li><a href="<?=DEFAULT_URL?>/gerenciamento/estabelecimentoscategs/index.php"><?=system_showText(LANG_SITEMGR_NAVBAR_LISTING)?></a></li>
					<? if (EVENT_FEATURE == "on") { ?>
						<li><a href="<?=DEFAULT_URL?>/gerenciamento/eventcategs/index.php"><?=system_showText(LANG_SITEMGR_NAVBAR_EVENT)?><? if (DEMO_MODE) { echo "<span>*</span>"; } ?></a></li>
					<? } ?>
					<? if (CLASSIFIED_FEATURE == "on") { ?>
						<li><a href="<?=DEFAULT_URL?>/gerenciamento/classifiedcategs/index.php"><?=system_showText(LANG_SITEMGR_NAVBAR_CLASSIFIED)?><? if (DEMO_MODE) { echo "<span>*</span>"; } ?></a></li>
					<? } ?>
					<? if (ARTICLE_FEATURE == "on") { ?>
						<li><a href="<?=DEFAULT_URL?>/gerenciamento/articlecategs/index.php"><?=system_showText(LANG_SITEMGR_NAVBAR_ARTICLE)?><? if (DEMO_MODE) { echo "<span>*</span>"; } ?></a></li>
					<? } ?>
				<? } ?>
			<? } ?>

			<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_LOCATIONS)) { ?>
				<? if ((strpos($_SERVER["PHP_SELF"], "sitemgr/locations") !== false)) { ?>
					<dt><?=system_showText(LANG_SITEMGR_NAVBAR_LOCATIONS)?></dt>
				<? } else { ?>
					<dt><a href="<?=DEFAULT_URL?>/gerenciamento/locations/"><?=system_showText(LANG_SITEMGR_NAVBAR_LOCATIONS)?></a></dt>
				<? } ?>
				<? if ((strpos($_SERVER["PHP_SELF"], "sitemgr/locations") !== false)) { ?>
					<li><a href="<?=DEFAULT_URL?>/gerenciamento/locations/countries.php"><?=system_showText(LANG_SITEMGR_NAVBAR_COUNTRIES)?></a></li>
					<li><a href="<?=DEFAULT_URL?>/gerenciamento/locations/states.php"><?=system_showText(LANG_SITEMGR_NAVBAR_STATES)?></a></li>
					<li><a href="<?=DEFAULT_URL?>/gerenciamento/locations/regions.php"><?=system_showText(LANG_SITEMGR_NAVBAR_CITIES)?></a></li>
				<? } ?>
			<? } ?>

			<? if (permission_hasSMPermSection(SITEMGR_PERMISSION_GOOGLESETTINGS)) { ?>
				<? if (GOOGLE_ADS_ENABLED == "on" || GOOGLE_MAPS_ENABLED == "on" || GOOGLE_ANALYTICS_ENABLED == "on") { ?>
					<? if ((strpos($_SERVER["PHP_SELF"], "sitemgr/googleprefs") !== false)) { ?>
						<dt><?=system_showText(LANG_SITEMGR_NAVBAR_GOOGLESETTINGS)?></dt>
					<? } else { ?>
						<?
						$google_default_link = DEFAULT_URL."/gerenciamento/googleprefs";
						if (GOOGLE_ADS_ENABLED == "on")           $google_link = $google_default_link."/googleads.php";
						elseif (GOOGLE_MAPS_ENABLED == "on")      $google_link = $google_default_link."/googlemaps.php";
						elseif (GOOGLE_ANALYTICS_ENABLED == "on") $google_link = $google_default_link."/googleanalytics.php";
						?>
						<dt><a href="<?=$google_link?>"><?=system_showText(LANG_SITEMGR_NAVBAR_GOOGLESETTINGS)?></a></dt>
					<? } ?>
					<? if ((strpos($_SERVER["PHP_SELF"], "sitemgr/googleprefs") !== false)) { ?>
						<? if (GOOGLE_ADS_ENABLED == "on") { ?>
							<li><a href="<?=DEFAULT_URL?>/gerenciamento/googleprefs/googleads.php"><?=system_showText(LANG_SITEMGR_NAVBAR_GOOGLEADS)?></a></li>
						<? } ?>
						<? if (GOOGLE_MAPS_ENABLED == "on") { ?>
							<? $has_menu_item = true; ?>
							<li><a href="<?=DEFAULT_URL?>/gerenciamento/googleprefs/googlemaps.php"><?=system_showText(LANG_SITEMGR_NAVBAR_GOOGLEMAPS)?></a></li>
						<? } ?>
						<? if (GOOGLE_ANALYTICS_ENABLED == "on") { ?>
							<? $has_menu_item = true; ?>
							<li><a href="<?=DEFAULT_URL?>/gerenciamento/googleprefs/googleanalytics.php"><?=system_showText(LANG_SITEMGR_NAVBAR_GOOGLEANALYTICS)?></a></li>
						<? } ?>
					<? } ?>
				<? } ?>
			<? } ?>

			<? if (!$_SESSION[SESS_SM_ID]) { ?>
				<? if ((strpos($_SERVER["PHP_SELF"], "sitemgr/reports") !== false)) { ?>
					<dt><?=system_showText(LANG_SITEMGR_NAVBAR_REPORTS)?></dt>
				<? } else { ?>
					<dt><a href="<?=DEFAULT_URL?>/gerenciamento/reports/statisticreport.php"><?=system_showText(LANG_SITEMGR_NAVBAR_REPORTS)?></a></dt>
				<? } ?>
				<? if ((strpos($_SERVER["PHP_SELF"], "sitemgr/reports") !== false)) { ?>
					<li><a href="<?=DEFAULT_URL?>/gerenciamento/reports/statisticreport.php"><?=system_showText(LANG_SITEMGR_NAVBAR_STATISTICREPORT)?></a></li>
				<? } ?>
			<? } ?>

            <? if (MULTILANGUAGE_FEATURE == 'on') { ?>
			<? if (!$_SESSION[SESS_SM_ID]) { ?>
                <? if ((strpos($_SERVER["PHP_SELF"], "sitemgr/langcenter") !== false)) { ?>
				<dt><?=system_showText(LANG_SITEMGR_NAVBAR_LANGUAGECENTER)?></dt>
                <? } else { ?>
                <dt><a href="<?=DEFAULT_URL?>/gerenciamento/langcenter/"><?=system_showText(LANG_SITEMGR_NAVBAR_LANGUAGECENTER)?></a></dt>
                <? } ?>
                <? if ((strpos($_SERVER["PHP_SELF"], "sitemgr/langcenter") !== false)) { ?>
				<li><a href="<?=DEFAULT_URL?>/gerenciamento/langcenter/"><?=system_showText(LANG_SITEMGR_NAVBAR_LANGUAGES)?></a></li>
                <? } ?>
			<? } ?>
            <? } ?>

		</dl>
	</div>

	<? if (DEMO_MODE) { ?>
		<br /><p class="optionsNote">* Portal Package</p>
	<? } ?>

	<div id="bottom-navbar">&nbsp;</div>

</div>
