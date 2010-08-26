<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/invoices/settings.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (PAYMENT_FEATURE != "on") { exit; }
	if (INVOICEPAYMENT_FEATURE != "on") { exit; }

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

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	if ($id) {
		$db = db_getDBObject();
		$sql ="SELECT * FROM Invoice WHERE id = ".$id;
		$r = $db->query($sql);
		if(mysql_num_rows($r)==0) {
			header("Location: ".DEFAULT_URL."/gerenciamento/invoices/".(($search_page) ? "search.php" : "index.php")."?message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
			exit;
		} else {
			$res = mysql_fetch_assoc($r);
			if ($res["status"]=="R") {
				header("Location: ".DEFAULT_URL."/gerenciamento/invoices/".(($search_page) ? "search.php" : "index.php")."?message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
				exit;
			}
		}
		$invoiceObj = new Invoice($id);
	} else {
		header("Location: ".DEFAULT_URL."/gerenciamento/invoices/".(($search_page) ? "search.php" : "index.php")."?message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		if (validate_form("invoicesettings", $_POST, $message_invoicesettings)) {

			if($status) {
				$invoiceObj->setString("status", $status);
				$invoiceObj->Save();
			}

			if($status == "R") {

				$invoiceObj->setString("payment_date", date("Y")."-".date("m")."-".date("d")." ".date("H").":".date("i").":".date("s"));
				$invoiceObj->Save();

				$db = db_getDBObject();
				$sql ="SELECT * FROM Invoice_Listing WHERE invoice_id = ".$invoiceObj->getString("id")."";
				$r = $db->query($sql);

				while($row = mysql_fetch_assoc($r)) $listing_ids[] = $row["listing_id"];

				if ($listing_ids) {

					$listingStatus = new ItemStatus();

					foreach ($listing_ids as $each_listing_id) $listings[] = new Listing($each_listing_id);

					if ($listings) foreach ($listings as $listing) {

						$db = db_getDBObject();
						$sql ="UPDATE Invoice_Listing SET renewal_date = '".$listing->getNextRenewalDate()."' WHERE invoice_id = ".$invoiceObj->getString("id")." AND listing_id = ".$listing->getString("id")."";
						$r = $db->query($sql);

						$listing->setString("renewal_date", $listing->getNextRenewalDate());
						$listing->setString("status", $listingStatus->getDefaultStatus());
						$listing->Save();

					}

				}

				$db = db_getDBObject();
				$sql ="SELECT * FROM Invoice_Event WHERE invoice_id = ".$invoiceObj->getString("id")."";
				$r = $db->query($sql);

				while($row = mysql_fetch_assoc($r)) $event_ids[] = $row["event_id"];

				if ($event_ids) {

					$eventStatus = new ItemStatus();

					foreach ($event_ids as $each_event_id) $events[] = new Event($each_event_id);

					if ($events) foreach ($events as $event) {

						$db = db_getDBObject();
						$sql ="UPDATE Invoice_Event SET renewal_date = '".$event->getNextRenewalDate()."' WHERE invoice_id = ".$invoiceObj->getString("id")." AND event_id = ".$event->getString("id")."";
						$r = $db->query($sql);

						$event->setString("renewal_date", $event->getNextRenewalDate());
						$event->setString("status", $eventStatus->getDefaultStatus());
						$event->Save();

					}

				}

				$db = db_getDBObject();
				$sql ="SELECT * FROM Invoice_Banner WHERE invoice_id = ".$invoiceObj->getString("id")."";
				$r = $db->query($sql);

				while ($row = mysql_fetch_assoc($r)) $banner_ids[] = $row["banner_id"];

				if ($banner_ids) {

					$bannerStatus = new ItemStatus();

					foreach ($banner_ids as $each_banner_id) $banners[] = new Banner($each_banner_id);

					if ($banners) foreach ($banners as $banner) {

						if($banner->getString("expiration_setting") == BANNER_EXPIRATION_IMPRESSION){

							$sql = "UPDATE Banner set impressions = impressions + ".$banner->getNumber("unpaid_impressions").", renewal_date = '0000-00-00', unpaid_impressions = 0 WHERE id = ".$banner->getNumber("id");
							$dbObj = db_getDBObject();
							$result = $dbObj->query($sql);

						} elseif ($banner->getString("expiration_setting") == BANNER_EXPIRATION_RENEWAL_DATE){

							$db = db_getDBObject();
							$sql ="UPDATE Invoice_Banner SET renewal_date = '".$banner->getNextRenewalDate()."' WHERE invoice_id = ".$invoiceObj->getString("id")." AND banner_id = ".$banner->getString("id")."";
							$r = $db->query($sql);

							$banner->setString("renewal_date", $banner->getNextRenewalDate());
							$banner->setString("status", $bannerStatus->getDefaultStatus());
							$banner->Save();

						}

					}

				}

				$db = db_getDBObject();
				$sql ="SELECT * FROM Invoice_Classified WHERE invoice_id = ".$invoiceObj->getString("id")."";
				$r = $db->query($sql);

				while($row = mysql_fetch_assoc($r)) $classified_ids[] = $row["classified_id"];

				if ($classified_ids) {

					$classifiedStatus = new ItemStatus();

					foreach ($classified_ids as $each_classified_id) $classifieds[] = new Classified($each_classified_id);

					if ($classifieds) foreach ($classifieds as $classified) {

						$db = db_getDBObject();
						$sql ="UPDATE Invoice_Classified SET renewal_date = '".$classified->getNextRenewalDate()."' WHERE invoice_id = ".$invoiceObj->getString("id")." AND classified_id = ".$classified->getString("id")."";
						$r = $db->query($sql);

						$classified->setString("renewal_date", $classified->getNextRenewalDate());
						$classified->setString("status", $classifiedStatus->getDefaultStatus());
						$classified->Save();

					}

				}

				$db = db_getDBObject();
				$sql ="SELECT * FROM Invoice_Article WHERE invoice_id = ".$invoiceObj->getString("id")."";
				$r = $db->query($sql);

				while($row = mysql_fetch_assoc($r)) $article_ids[] = $row["article_id"];

				if ($article_ids) {

					$articleStatus = new ItemStatus();

					foreach ($article_ids as $each_article_id) $articles[] = new Article($each_article_id);

					if ($articles) foreach ($articles as $article) {

						$db = db_getDBObject();
						$sql ="UPDATE Invoice_Article SET renewal_date = '".$article->getNextRenewalDate()."' WHERE invoice_id = ".$invoiceObj->getString("id")." AND article_id = ".$article->getString("id")."";
						$r = $db->query($sql);

						$article->setString("renewal_date", $article->getNextRenewalDate());
						$article->setString("status", $articleStatus->getDefaultStatus());
						$article->Save();

					}

				}

				$db = db_getDBObject();
				$sql ="SELECT * FROM Invoice_CustomInvoice WHERE invoice_id = ".$invoiceObj->getString("id")."";
				$r = $db->query($sql);

				while($row = mysql_fetch_assoc($r)) $custominvoice_ids[] = $row["custom_invoice_id"];

				if ($custominvoice_ids) {

					foreach ($custominvoice_ids as $each_custominvoice_id) $customInvoices[] = new CustomInvoice($each_custominvoice_id);

					if ($customInvoices) foreach ($customInvoices as $customInvoice) {

						$customInvoice->setString("paid", "y");
						$customInvoice->Save();

					}

				}

			}

			header("Location: ".DEFAULT_URL."/gerenciamento/invoices/".(($search_page) ? "search.php" : "index.php")."?message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
			exit;

		}

	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	$invoiceStatusObj = new InvoiceStatus();
	unset($arrayValue);
	unset($arrayName);
	$arrayValue = $invoiceStatusObj->getValues();
	$arrayName = $invoiceStatusObj->getNames();
	unset($arrayValueDD);
	unset($arrayNameDD);
	for ($i=0; $i<count($arrayValue); $i++) {
		if ($arrayValue[$i] != "E") {
			$arrayValueDD[] = $arrayValue[$i];
			$arrayNameDD[] = $arrayName[$i];
		}
	}
	$statusDropDown = html_selectBox("status", $arrayNameDD, $arrayValueDD, $invoiceObj->getString("status"), "", "class='input-dd-form-settings'", "-- ".system_showText(LANG_LABEL_SELECT_ALLSTATUS)." --");

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

			<? include(INCLUDES_DIR."/tables/table_invoice_submenu.php"); ?>
			
			<div class="baseForm">

			<form name="invoicesettings" action="<?=$_SERVER["PHP_SELF"]?>" method="post">
				<input type="hidden" name="id" value="<?=$id?>" />
				<? include(INCLUDES_DIR."/forms/form_invoicesettings.php"); ?>
				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<input type="hidden" name="letra" value="<?=$letra?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />
				<button type="submit" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
				<button type="button" name="back" value="Back" class="ui-state-default ui-corner-all" onclick="document.getElementById('forminvoicesettignscancel').submit();"><?=system_showText(LANG_SITEMGR_BACK)?></button>
			</form>
			<form id="forminvoicesettignscancel" action="<?=DEFAULT_URL?>/gerenciamento/invoices/<?=(($search_page) ? "search.php" : "index.php");?>" method="post">
				<?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
				<input type="hidden" name="letra" value="<?=$letra?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />
			</form>
			
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