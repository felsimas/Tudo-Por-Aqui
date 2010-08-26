<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/custominvoices/view_items.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (PAYMENT_FEATURE != "on") { exit; }
	if ((CREDITCARDPAYMENT_FEATURE != "on") && (INVOICEPAYMENT_FEATURE != "on")) { exit; }
	if (CUSTOM_INVOICE_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/gerenciamento/custominvoices";
	$url_base = "".DEFAULT_URL."/gerenciamento";
	$sitemgr = 1;

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------	

	$customInvoiceItems = false;

	if (!$view || $view != "payment_log") {
		if ($id) {
			$customInvoice = new CustomInvoice($id);
			$account = new Account($customInvoice->getNumber("account_id"));
			$customInvoiceItems = $customInvoice->getItems();
		} else {
			exit;
		}

	} else {

		if (!$items && !$items_price) { exit; }

		$customInvoice = new CustomInvoice($id);

		$customInvoiceItems = true;

		$customInvoicePaymentItems = $items;
		$customInvoicePaymentPrices = $items_price;

		$customInvoicePaymentItems = explode("\n", $customInvoicePaymentItems);
		$customInvoicePaymentPrices = explode("\n", $customInvoicePaymentPrices);

	}

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

?>

<html>

	<head>

		<? $headertag_title = (($headertag_title) ? ($headertag_title) : (EDIRECTORY_TITLE)); ?>
		<title><?=$headertag_title?></title>

		<? $headertag_author = (($headertag_author) ? ($headertag_author) : ("Sis Dir 2009 - Classificados")); ?>
		<meta name="author" content="<?=$headertag_author?>" />

		<? $headertag_description = (($headertag_description) ? ($headertag_description) : (EDIRECTORY_TITLE)); ?>
		<meta name="description" content="<?=$headertag_description?>" />

		<? $headertag_keywords = (($headertag_keywords) ? ($headertag_keywords) : (EDIRECTORY_TITLE)); ?>
		<meta name="keywords" content="<?=$headertag_keywords?>" />

		<meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />

		<meta name="ROBOTS" content="index, follow" />

		<link href="<?=DEFAULT_URL?>/gerenciamento/layout/general_sitemgr.css" rel="stylesheet" type="text/css" />

		<style type="text/css" media="all"> 

			/* CSS DIFFERENCES - GLOBAL DEFINITIONS */

			body { margin-top: 10px; background-color: #FFFFFF; text-align: center; } 

			.link-table:link,
			.link-table:active,
			.link-table:visited,
			.link-table:hover
			{
				font: normal 10px Verdana, Arial, Helvetica, sans-serif;
				color: #3B4B5B;
				text-align: left;
				text-decoration: none;
			}

			.link-table:hover
			{
				text-decoration: underline;
			}
			
			h1 {font: normal 18px Arial, Helvetica, sans-serif; color: #000; text-align: left; padding: 0 15px 15px 15px;}
			
			h2 {font: bold 12px Verdana, Arial, Verdana, Helvetica, sans-serif Arial, Helvetica, sans-serif; text-align: left; color: #003F7E; padding-bottom: 10px; padding-left: 8px; margin: 0 5px 0 20px; background: #FFF url("../../images/design/bullet_orderTitle.gif") 0 4px no-repeat; border: 0; border-bottom: 1px solid #EEE; margin-bottom:10px;}
			
			ul.basePreviewNavbar{height: 30px; padding: 0; margin: 0 0 10px 0; background: #FBFBFB; border: 1px solid #EEE;}
			
				ul.basePreviewNavbar li{list-style: none; float: right;}
				
				ul.basePreviewNavbar li a:link,
				ul.basePreviewNavbar li a:active,
				ul.basePreviewNavbar li a:visited,
				ul.basePreviewNavbar li a:hover{background: url("../../images/icon_delete.gif") 94% 50% no-repeat; font: normal 10px Arial, Helvetica, sans-serif; color: #000; display: block; padding: 8px 30px 8px 10px; border: 0;}
				
					ul.basePreviewNavbar li a:hover{color: #9B350C;}

		</style>

	</head>

	<body>

	<? if($customInvoiceItems){ ?>

		<h1><?=ucwords(system_showText(LANG_SITEMGR_CUSTOMINVOICE))?> <?=system_showText(LANG_SITEMGR_TITLE)?>: <?=$customInvoice->getString("title");?></h1>

		<h2><?=ucwords(system_showText(LANG_SITEMGR_CUSTOMINVOICE))?> <?=system_showText(LANG_SITEMGR_ITEMS)?></h2>

		<table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">
			<tr>
				<th><?=system_showText(LANG_SITEMGR_LABEL_DESCRIPTION)?></th>
				<th style="width:70px;"><?=system_showText(LANG_SITEMGR_LABEL_PRICE)?></th>
			</tr>
			<? if (!$view || $view != "payment_log") { ?>
				<? foreach($customInvoiceItems as $each_custominvoice_item) { ?>
					<tr>
						<td><?=$each_custominvoice_item["description"]?></td>
						<td><?=CURRENCY_SYMBOL." ".format_money($each_custominvoice_item["price"])?></td>
					</tr>
				<? } ?>
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
			<div class="response-msg inf ui-corner-all"><?=system_showText(LANG_SITEMGR_CUSTOMINVOICE_NOITEMSFOUND)?></div>
	<? } ?>
		<ul class="basePreviewNavbar">
			<li><a href="javascript:window.close();"><?=system_showText(LANG_SITEMGR_CLOSEWINDOW)?></a></li>
		</ul>
	</body>

</html>