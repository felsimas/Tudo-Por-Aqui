<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/layout/navbar.php
	# ----------------------------------------------------------------------------------------------------

?>

	<div class="sidebar">

		<h3 class="standardTitle"><?=system_showText(system_highlightLastWord(LANG_MENU_MEMBEROPTIONS));?></h3>

		<dl class="memberMenu">

			<dt><a href="<?=DEFAULT_URL?>/membros/listing/"><?=system_showText(LANG_MENU_LISTING);?></a></dt>
			<? if (strpos($_SERVER["PHP_SELF"], "membros/listing") !== false) { ?>
				<dd><a href="<?=DEFAULT_URL?>/membros/listing/listinglevel.php"><?=system_showText(LANG_MENU_ADDLISTING);?></a></dd>
				<dd><a href="<?=DEFAULT_URL?>/membros/listing/"><?=system_showText(LANG_MENU_MANAGELISTING);?></a></dd>
			<? } ?>

			<dt><a href="<?=DEFAULT_URL?>/membros/gallery/"><?=system_showText(LANG_MENU_GALLERY);?></a></dt>
			<? if (strpos($_SERVER["PHP_SELF"], "membros/gallery") !== false) { ?>
				<dd><a href="<?=DEFAULT_URL?>/membros/gallery/gallery.php"><?=system_showText(LANG_MENU_ADDGALLERY);?></a></dd>
				<dd><a href="<?=DEFAULT_URL?>/membros/gallery/"><?=system_showText(LANG_MENU_MANAGEGALLERY);?></a></dd>
			<? } ?>

			<dt><a href="<?=DEFAULT_URL?>/membros/promotion/"><?=system_showText(LANG_MENU_PROMOTION);?></a></dt>
			<? if (strpos($_SERVER["PHP_SELF"], "membros/promotion") !== false) { ?>
				<dd><a href="<?=DEFAULT_URL?>/membros/promotion/promotion.php"><?=system_showText(LANG_MENU_ADDPROMOTION);?></a></dd>
				<dd><a href="<?=DEFAULT_URL?>/membros/promotion/"><?=system_showText(LANG_MENU_MANAGEPROMOTION);?></a></dd>
			<? } ?>

			<? if (EVENT_FEATURE == "on") { ?>
				<dt><a href="<?=DEFAULT_URL?>/membros/event/"><?=system_showText(LANG_MENU_EVENT);?></a></dt>
				<? if (strpos($_SERVER["PHP_SELF"], "membros/event") !== false) { ?>
					<dd><a href="<?=DEFAULT_URL?>/membros/event/eventlevel.php"><?=system_showText(LANG_MENU_ADDEVENT);?></a></dd>
					<dd><a href="<?=DEFAULT_URL?>/membros/event/"><?=system_showText(LANG_MENU_MANAGEEVENT);?></a></dd>
				<? } ?>
			<? } ?>

			<? if (BANNER_FEATURE == "on") { ?>
				<dt><a href="<?=DEFAULT_URL?>/membros/banner/"><?=system_showText(LANG_MENU_BANNER);?></a></dt>
				<? if (strpos($_SERVER["PHP_SELF"], "membros/banner") !== false) { ?>
					<dd><a href="<?=DEFAULT_URL?>/membros/banner/add.php"><?=system_showText(LANG_MENU_ADDBANNER);?></a></dd>
					<dd><a href="<?=DEFAULT_URL?>/membros/banner/"><?=system_showText(LANG_MENU_MANAGEBANNER);?></a></dd>
				<? } ?>
			<? } ?>


		</dl>

		<? if (PAYMENT_FEATURE == "on") { ?>
			<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on") || (MANUALPAYMENT_FEATURE == "on")) { ?>
				<dl class="memberMenu">
					<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
						<dt><a href="<?=DEFAULT_URL?>/membros/billing/index.php"><?=system_showText(LANG_MENU_CHECKOUT);?></a></dt>
						<? if (strpos($_SERVER["PHP_SELF"], "membros/billing") !== false) { ?>
							<dd><a href="<?=DEFAULT_URL?>/membros/billing/index.php"><?=system_showText(LANG_MENU_MAKEPAYMENT);?></a></dd>
						<? } ?>
					<? } ?>
					<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on") || (MANUALPAYMENT_FEATURE == "on")) { ?>
						<? if ((MANUALPAYMENT_FEATURE == "on") || (CREDITCARDPAYMENT_FEATURE == "on")) { ?>
							<dt><a href="<?=DEFAULT_URL?>/membros/transactions/index.php"><?=system_showText(LANG_MENU_HISTORY);?></a></dt>
						<? } elseif (INVOICEPAYMENT_FEATURE == "on") { ?>
							<dt><a href="<?=DEFAULT_URL?>/membros/invoices/index.php"><?=system_showText(LANG_MENU_HISTORY);?></a></dt>
						<? } ?>
						<? if ((strpos($_SERVER["PHP_SELF"], "membros/transactions") !== false) || (strpos($_SERVER["PHP_SELF"], "membros/invoices") !== false)) { ?>
							<? if ((MANUALPAYMENT_FEATURE == "on") || (CREDITCARDPAYMENT_FEATURE == "on")) { ?>
								<dd><a href="<?=DEFAULT_URL?>/membros/transactions/index.php"><?=system_showText(LANG_MENU_TRANSACTIONHISTORY);?></a></dd>
							<? } ?>
							<? if (INVOICEPAYMENT_FEATURE == "on") { ?>
								<dd><a href="<?=DEFAULT_URL?>/membros/invoices/index.php"><?=system_showText(LANG_MENU_INVOICEHISTORY);?></a></dd>
							<? } ?>
						<? } ?>
					<? } ?>
				</dl>
			<? } ?>
		<? } ?>

	</div>
