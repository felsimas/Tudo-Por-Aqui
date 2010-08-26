<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/billing/view_custominvoice_items.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (PAYMENT_FEATURE != "on") { exit; }
	if (CREDITCARDPAYMENT_FEATURE != "on" && INVOICEPAYMENT_FEATURE != "on") { exit; }
	if (CUSTOM_INVOICE_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	$url_base = "".DEFAULT_URL."/membros";

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------

	$customInvoiceItems = false;

	if (!$view || $view != "payment_log") {
		if ($id) {
			$customInvoice = new CustomInvoice($id);
			if ($customInvoice->getNumber("account_id") != sess_getAccountIdFromSession()) {
				exit;
			}
			$customInvoiceItems = $customInvoice->getItems();
		} else {
			exit;
		}
	} else {

		if (!$items && !$items_price) { exit; }

		$customInvoice = new CustomInvoice($id);
		if ($customInvoice->getNumber("account_id") != sess_getAccountIdFromSession()) {
			exit;
		}

		$customInvoiceItems = true;

		$customInvoicePaymentItems = $items;
		$customInvoicePaymentPrices = $items_price;

		$customInvoicePaymentItems = explode("\n", $customInvoicePaymentItems);
		$customInvoicePaymentPrices = explode("\n", $customInvoicePaymentPrices);

	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>

		<meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />
		<title><?=EDIRECTORY_TITLE?></title>

		<link href="<?=DEFAULT_URL?>/layout/general_structure.css" rel="stylesheet" type="text/css" media="all"/>
		<link href="<?=DEFAULT_URL?>/membros/layout/general_members.css" rel="stylesheet" type="text/css" media="all"/>

		<style type="text/css" media="all">

			* {text-decoration: none; padding: 0; margin: 0;}

			body {text-align: center; margin: 10px; background: #FFF;}

			/* ILSTING > EMAIL TO FRIEND 
			/////////////////////////////////////////////////////*/

				div.customInvoice
				{/*width: 96%;*/ font: normal 11px Verdana, Arial, Helvetica, sans-serif; text-align: left; margin: 0 auto 0 auto; padding: 0; background: #FFF;}

				div.customInvoice h2 {font: bold 12px Verdana, Arial, Verdana, Helvetica, sans-serif Arial, Helvetica, sans-serif; margin: 0 10px 0 10px; text-align: left; color: #003F7E; padding: 20px 0 8px 8px; background: #FFF url("../../images/design/bullet_orderTitle.gif") 0 24px no-repeat; border: 0; border-bottom: 1px solid #EEE;}

				a.closeLink:link,
				a.closeLink:active,
				a.closeLink:visited,
				a.closeLink:hover { padding-top: 10px; padding-right: 20px; display: block; text-align: right; color: #CC0000;}
				
				.basePreviewNavbar
				{ background: #FBFBFB; border: 1px solid #EEE; height: 30px; margin: 10px 0 10px 0; padding: 0; }
				
					.basePreviewNavbar li
					{ float: right; list-style: none; }
					
					.basePreviewNavbar li a,
					.basePreviewNavbar li a:visited
					{ background: url("../../images/icon_delete.gif") 94% 50% no-repeat; border: 0; color: #666; display: block; font-size: 10px; padding: 8px 30px 8px 10px; }
					
						ul.basePreviewNavbar li a:hover
						{ color: #000; }

		</style>

	</head>

	<body>

		<div class="customInvoice">

		<? if($customInvoiceItems){ ?>

			<h1 class="standardTitle"><?=system_showText(LANG_LABEL_CUSTOM_INVOICE_TITLE)?>: <span><?=$customInvoice->getString("title");?></span></h1>

			<h2><?=system_showText(LANG_LABEL_CUSTOM_INVOICE_ITEMS)?></h2>

			<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">
				<tr>
					<th><?=system_showText(LANG_LABEL_DESCRIPTION)?></th>
					<th style="width: 70px;"><?=system_showText(LANG_LABEL_PRICE)?></th>
				</tr>
				<? if (!$view || $view != "payment_log") { ?>
					<? foreach($customInvoiceItems as $each_custominvoice_item) { ?>
						<tr>
							<td><?=$each_custominvoice_item["description"]?></td>
							<td><?=CURRENCY_SYMBOL." ".format_money($each_custominvoice_item["price"])?></td>
						</tr>
					<? }?>
				<? } else { ?>
						<?
						if ($customInvoicePaymentItems && $customInvoicePaymentPrices) {
							foreach ($customInvoicePaymentItems as $key => $each_item) {
							?>
								<tr>
									<td><?=$each_item?></td>
									<td><?=CURRENCY_SYMBOL." ".format_money($customInvoicePaymentPrices[$key])?></td>
								</tr>
							<?
							}
						}
						?>
				<? } ?>
			</table>

		<? } else { ?>
				<div class="response-msg inf ui-corner-all"><?=system_showText(LANG_MSG_NO_ITEMS_FOUND)?></div>
		<? } ?>

			<ul class="basePreviewNavbar">
				<li><a href="javascript:window.close();"><?=system_showText(LANG_LABEL_CLOSETHISWINDOW)?></a></li>
			</ul>

		</div>

	</body>

</html>
