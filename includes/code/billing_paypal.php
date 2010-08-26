<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/code/billing_paypal.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# INCLUDE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/conf/payment_paypal.inc.php");

	if (strpos($_SERVER["PHP_SELF"], "receipt.php") === false) {

		extract($_POST);
		extract($_GET);

		if ($txn_id || $subscr_id || $receipt_id){

			$payment_success = "y";
			
			$payment_message .= "<p class=\"successMessage\">\n";

			if ($txn_id) {
				$payment_message .= system_showText(LANG_LABEL_TRANSACTION_STATUS).": $payment_status <br />\n";
				$payment_message .= system_showText(LANG_LABEL_TRANSACTION_ID).": $txn_id <br />\n";
			} elseif ($receipt_id) {
				$payment_message .= system_showText(LANG_LABEL_TRANSACTION_STATUS).": $payment_status <br />\n";
				$payment_message .= system_showText(LANG_LABEL_RECEIPT_ID).": $receipt_id <br />\n";
			} elseif ($subscr_id) {
				$payment_message .= system_showText(LANG_LABEL_TRANSACTION_STATUS).": ".system_showText(LANG_LABEL_COMPLETED)." <br />\n";
				$payment_message .= system_showText(LANG_LABEL_SUBSCRIBE_ID).": $subscr_id <br />\n";
			}

			if ($payment_status == "Completed") {
				if ($process == "claim") $payment_message .= "<br />\n".system_showText(LANG_MSG_TRANSACTIONS_MAY_NOT_OCCUR_IMMEDIATELY)."<br />\n".system_showText(LANG_MSG_AFTER_PAYMENT_IS_PROCESSED_INFO_ABOUT)."<br />\n".system_showText(LANG_MSG_MAY_BE_FOUND_IN_TRANSACTION_HISTORY)."\n";
				else $payment_message .= "<br />\n".system_showText(LANG_MSG_TRANSACTIONS_MAY_NOT_OCCUR_IMMEDIATELY)."<br />\n".system_showText(LANG_MSG_AFTER_PAYMENT_IS_PROCESSED_INFO_ABOUT)."<br />\n".system_showText(LANG_MSG_MAY_BE_FOUND_IN_YOUR)." <a href=\"".DEFAULT_URL."/membros/transactions/index.php\">".system_showText(LANG_LABEL_TRANSACTION_HISTORY)."</a>\n";
			} elseif ($payment_status == "Pending") {
				if ($process == "claim") $payment_message .= "<br />\n".system_showText(LANG_MSG_PENDING_PAYMENTS_TAKE_3_4_DAYS_TO_BE_APPROVED)."<br />\n".system_showText(LANG_MSG_TRANSACTIONS_MAY_NOT_OCCUR_IMMEDIATELY)."<br />\n".system_showText(LANG_MSG_AFTER_PAYMENT_IS_PROCESSED_INFO_ABOUT)."<br />\n".system_showText(LANG_MSG_MAY_BE_FOUND_IN_TRANSACTION_HISTORY)."\n";
				else $payment_message .= "<br />\n".system_showText(LANG_MSG_PENDING_PAYMENTS_TAKE_3_4_DAYS_TO_BE_APPROVED)."<br />\n".system_showText(LANG_MSG_TRANSACTIONS_MAY_NOT_OCCUR_IMMEDIATELY)."<br />\n".system_showText(LANG_MSG_AFTER_PAYMENT_IS_PROCESSED_INFO_ABOUT)."<br />\n".system_showText(LANG_MSG_MAY_BE_FOUND_IN_YOUR)." <a href=\"".DEFAULT_URL."/membros/transactions/index.php\">".system_showText(LANG_LABEL_TRANSACTION_HISTORY)."</a>\n";
			}

		} else {
		
			$payment_message .= "<p class=\"errorMessage\">\n";

			$payment_message .= system_showText(LANG_LABEL_TRANSACTION_STATUS).": ".system_showText(LANG_LABEL_CANCELED)." <br />\n";
			if ($process == "signup") $try_again_message = "<a href=\"".DEFAULT_URL."/membros/".$process."/payment.php?payment_method=paypal\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";
			elseif ($process == "claim") $try_again_message = "<a href=\"".DEFAULT_URL."/membros/".$process."/payment.php?payment_method=paypal&claimlistingid=".$claimlistingid."\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";
			else $try_again_message = "<a href=\"".DEFAULT_URL."/membros/billing/index.php\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";

		}

		$payment_message .= $try_again_message."\n</p>";

	} else {

		// read the post from PayPal system and add 'cmd'
		$req = 'cmd=_notify-validate';

		foreach ($_POST as $key => $value) {
			$value = urlencode(stripslashes($value));
			$req .= "&$key=$value"; 
		}

		// post back to PayPal system to validate
		$header .= "POST ".PAYPAL_URL_FOLDER." HTTP/1.0\r\n";
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$header .= "Content-Length: " . strlen($req) . "\r\n\r\n"; 

		$fp = fsockopen ('ssl://'.PAYPAL_URL, 443, $errno, $errstr, 30);

		if (!$fp) {

			setting_get("sitemgr_email",$sitemgr_email);
			$eDirMailerObj = new EDirMailer(EDIR_ADMIN_EMAIL, "IPN FAILURE", system_showText(LANG_MSG_CONNECTION_FAILURE)."\n".$_SERVER["SERVER_NAME"], $sitemgr_email);
			$eDirMailerObj->send();
			exit;

		} else {

			fputs ($fp, $header . $req);

			while (!feof($fp)) {

				$res = fgets ($fp, 1024);

				if (strcmp ($res, "VERIFIED") == 0) {

					$params = split("&",urldecode($req));

					foreach($params as $each_param){
						$arr_aux_params = split("=",$each_param);
						for($i=0; $i < count($arr_aux_params); $i++){
							if($i%2 == 0 || $i == 0){
								$filtered_params["{$arr_aux_params[$i]}"] = $arr_aux_params[$i+1];
							}
						}
					}

					foreach($filtered_params as $key => $value){

						if($key == "custom"){

							$arr_custom_param =  split("::",$value);
							foreach($arr_custom_param as $each_custom_param){
								$arr_custom_param_values = split(":",$each_custom_param);
								for($i=0; $i < count($arr_custom_param_values); $i++){
									if($i%2 == 0 || $i == 0){
										$transaction["{$arr_custom_param_values[$i]}"] = trim($arr_custom_param_values[$i+1]);
									}
								}
							}

						} elseif($key == "payment_date" || $key == "subscr_date"){

							$t_date = strtotime($value);
							$date = date("Y-m-d H:i:s",$t_date);
							$transaction[$key] = trim($date);

						} else {

							$transaction[$key] = trim($value);

						}

					}

					$accountObj                             = new Account($transaction["account_id"]);
					$transactionLog["account_id"]           = $transaction["account_id"];
					$transactionLog["username"]             = $accountObj->getString("username");
					$transactionLog["ip"]                   = $transaction["ip"];
					$transactionLog["transaction_id"]       = $transaction["txn_id"];
					$transactionLog["transaction_status"]   = $transaction["payment_status"];
					$transactionLog["transaction_datetime"] = $transaction["payment_date"];
					$transactionLog["transaction_amount"]   = $transaction["mc_gross"];
					$transactionLog["transaction_currency"] = $transaction["mc_currency"];
					$transactionLog["system_type"]          = "paypal";
					$transactionLog["recurring"]            = "n";
					$transactionLog["notes"]                = "";

					if ($transaction["txn_type"] == "subscr_payment") $transactionLog["recurring"] = "y";

					// Debuging by e-mail
					//setting_get("sitemgr_email",$sitemgr_email);
					//if ($transaction) foreach ($transaction as $key => $value) $email_content .= "$key => $value\n\n";
					//$eDirMailerObj = new EDirMailer(EDIR_ADMIN_EMAIL, "VERIFIED IPN", $res."\n".$email_content."\n".$_SERVER["SERVER_NAME"], $sitemgr_email);
					//$eDirMailerObj->send();

				} else if (strcmp ($res, "INVALID") == 0) {

					// log for manual investigation
					setting_get("sitemgr_email",$sitemgr_email);
					if($transaction){
						foreach ($transaction as $key => $value){
							$email_content .= "$key => $value\n\n";
						}
					}
					$eDirMailerObj = new EDirMailer(EDIR_ADMIN_EMAIL, "INVALID IPN", $res."\n".$email_content."\n".$_SERVER["SERVER_NAME"], $sitemgr_email);
					$eDirMailerObj->send();

				}

			}

			fclose ($fp);

		}

		// Sign up will not be loged. Just the payment itself.
		if ($transaction["txn_type"] != "subscr_payment" && $transaction["txn_type"] != "cart") unset($transaction);

		if ($transaction["num_cart_items"]){

			unset($itemArray);
			unset($listingArray);
			unset($eventArray);
			unset($bannerArray);
			unset($classifiedArray);
			unset($articleArray);
			unset($customInvoiceArray);

			for ($i=1; $i <= $transaction["num_cart_items"]; $i++) {

				unset($item);
				$item = $transaction["item_number$i"];

				unset($tempItem);
				$tempItem = explode(":", $item);
				$itemType = $tempItem[0];
				$itemID = $tempItem[1];

				unset($tempItem);
				$tempItem["id"] = $itemID;
				$tempItem["type"] = $itemType;

				$tempItem["amount"] = $transaction["mc_gross_$i"];

				$itemArray[] = $tempItem;
				if ($itemType == "listing") $listingArray[] = $tempItem;
				if ($itemType == "event") $eventArray[] = $tempItem;
				if ($itemType == "banner") $bannerArray[] = $tempItem;
				if ($itemType == "classified") $classifiedArray[] = $tempItem;
				if ($itemType == "article") $articleArray[] = $tempItem;
				if ($itemType == "custominvoice") $customInvoiceArray[] = $tempItem;

			}

		} else {

			unset($itemArray);
			unset($listingArray);
			unset($eventArray);
			unset($bannerArray);
			unset($classifiedArray);
			unset($articleArray);
			unset($customInvoiceArray);

			if ($transaction["option_name1"] == "itemsPaid") {

				$itemArrayAux = split("\|",$transaction["option_selection1"]);

				if ($itemArrayAux) foreach ($itemArrayAux as $item_aux) {

					unset($tempItem);
					$tempItem = explode(":", $item_aux);
					$itemType = $tempItem[0];
					$itemID = $tempItem[1];

					unset($tempItem);
					$tempItem["id"] = $itemID;
					if ($itemType == "l") $tempItem["type"] = "listing";
					if ($itemType == "e") $tempItem["type"] = "event";
					if ($itemType == "b") $tempItem["type"] = "banner";
					if ($itemType == "c") $tempItem["type"] = "classified";
					if ($itemType == "a") $tempItem["type"] = "article";
					if ($itemType == "i") $tempItem["type"] = "custominvoice";

					$itemArray[] = $tempItem;

					if ($tempItem["type"] == "listing") {
						unset($lObj);
						$lObj = new Listing($tempItem["id"]);
						$tempItem["amount"] = format_money($lObj->getPrice());
						unset($lObj);
						$listingArray[] = $tempItem;
					}

					if ($tempItem["type"] == "event") {
						unset($eObj);
						$eObj = new Event($tempItem["id"]);
						$tempItem["amount"] = format_money($eObj->getPrice());
						unset($eObj);
						$eventArray[] = $tempItem;
					}

					if ($tempItem["type"] == "banner") {
						unset($bObj);
						$bObj = new Banner($tempItem["id"]);
						$tempItem["amount"] = format_money($bObj->getPrice());
						unset($bObj);
						$bannerArray[] = $tempItem;
					}

					if ($tempItem["type"] == "classified") {
						unset($cObj);
						$cObj = new Classified($tempItem["id"]);
						$tempItem["amount"] = format_money($cObj->getPrice());
						unset($cObj);
						$classifiedArray[] = $tempItem;
					}

					if ($tempItem["type"] == "article") {
						unset($aObj);
						$aObj = new Article($tempItem["id"]);
						$tempItem["amount"] = format_money($aObj->getPrice());
						unset($aObj);
						$articleArray[] = $tempItem;
					}

					if ($tempItem["type"] == "custominvoice") {
						unset($iObj);
						$iObj = new CustomInvoice($tempItem["id"]);
						$tempItem["amount"] = format_money($iObj->getPrice());
						unset($iObj);
						$customInvoiceArray[] = $tempItem;
					}

				}

			}

		}

		if ($itemArray && $transaction) {

			$db = db_getDBObject();
			$sql = "SELECT id FROM Payment_Log WHERE transaction_id = '".$transaction["txn_id"]."' AND system_type = 'paypal'";
			$r = $db->query($sql);

			if (mysql_num_rows($r) > 0) {

				$row = mysql_fetch_assoc($r);
				$transactionLog["return_fields"] = system_array2nvp($transaction, " || ");
				$paymentLogObj = new PaymentLog($row["id"]);
				$paymentLogObj->MakeFromRow($transactionLog);
				$paymentLogObj->Save();

			} else {

				$transactionLog["return_fields"] = system_array2nvp($transaction, " || ");
				$paymentLogObj = new PaymentLog($transactionLog);
				$paymentLogObj->Save();

				if ($listingArray) {

					$levelObj = new ListingLevel();
					foreach ($listingArray as $each_listing) {

						$listingObj = new Listing($each_listing["id"]);

						$dbObjCat = db_getDBObject();
						$sqlCat = "SELECT cat_1_id, cat_2_id, cat_3_id, cat_4_id, cat_5_id FROM Listing WHERE id = ".$listingObj->getString("id")."";
						$rCat = $dbObjCat->query($sqlCat);
						$row = mysql_fetch_assoc($rCat);
						$category_amount = 0;
						if ($row["cat_1_id"]) $category_amount++;
						if ($row["cat_2_id"]) $category_amount++;
						if ($row["cat_3_id"]) $category_amount++;
						if ($row["cat_4_id"]) $category_amount++;
						if ($row["cat_5_id"]) $category_amount++;

						$payment_listing_log["payment_log_id"] = $paymentLogObj->getString("id");
						$payment_listing_log["listing_id"]     = $each_listing["id"];
						$payment_listing_log["listing_title"]  = $listingObj->getString("title", false);
						$payment_listing_log["discount_id"]    = $listingObj->getString("discount_id");
						$payment_listing_log["level"]          = $listingObj->getString("level");
						$payment_listing_log["renewal_date"]   = $listingObj->getString("renewal_date");
						$payment_listing_log["categories"]     = ($category_amount) ? $category_amount : 0;
						$payment_listing_log["amount"]         = $each_listing["amount"];

						$payment_listing_log["extra_categories"] = 0;
						if (($category_amount > 0) && (($category_amount - $levelObj->getFreeCategory($listingObj->getString("level"))) > 0)) {
							$payment_listing_log["extra_categories"] = $category_amount - $levelObj->getFreeCategory($listingObj->getString("level"));
						} else {
							$payment_listing_log["extra_categories"] = 0;
						}

						$payment_listing_log["listingtemplate_title"] = "";
						if (LISTINGTEMPLATE_FEATURE == "on") {
							if ($listingObj->getString("listingtemplate_id")) {
								$listingTemplateObj = new ListingTemplate($listingObj->getString("listingtemplate_id"));
								$payment_listing_log["listingtemplate_title"] = $listingTemplateObj->getString("title", false);
							}
						}

						$paymentListingLogObj = new PaymentListingLog($payment_listing_log);
						$paymentListingLogObj->Save();

					}

				}

				if ($eventArray) {

					foreach ($eventArray as $each_event) {

						$eventObj = new Event($each_event["id"]);

						$payment_event_log["payment_log_id"] = $paymentLogObj->getString("id");
						$payment_event_log["event_id"]       = $each_event["id"];
						$payment_event_log["event_title"]    = $eventObj->getString("title",false);
						$payment_event_log["level"]          = $eventObj->getString("level");
						$payment_event_log["renewal_date"]   = $eventObj->getString("renewal_date");
						$payment_event_log["discount_id"]    = $eventObj->getString("discount_id");
						$payment_event_log["amount"]         = $each_event["amount"];

						$paymentEventLogObj = new PaymentEventLog($payment_event_log);
						$paymentEventLogObj->Save();

					}

				}

				if ($bannerArray) {

					foreach ($bannerArray as $each_banner) {

						$bannerObj = new Banner($each_banner["id"]);

						$payment_banner_log["payment_log_id"] = $paymentLogObj->getString("id");
						$payment_banner_log["banner_id"]      = $each_banner["id"];
						$payment_banner_log["banner_caption"] = $bannerObj->getString("caption",false);
						$payment_banner_log["level"]          = $bannerObj->getString("type");
						$payment_banner_log["renewal_date"]   = $bannerObj->getString("renewal_date");
						$payment_banner_log["discount_id"]    = $bannerObj->getString("discount_id");
						$payment_banner_log["impressions"]    = $bannerObj->getNumber("unpaid_impressions");
						$payment_banner_log["amount"]         = $each_banner["amount"];

						$paymentBannerLogObj = new PaymentBannerLog($payment_banner_log);
						$paymentBannerLogObj->Save();

					}

				}

				if ($classifiedArray) {

					foreach ($classifiedArray as $each_classified) {

						$classifiedObj = new Classified($each_classified["id"]);

						$payment_classified_log["payment_log_id"]   = $paymentLogObj->getString("id");
						$payment_classified_log["classified_id"]    = $each_classified["id"];
						$payment_classified_log["classified_title"] = $classifiedObj->getString("title",false);
						$payment_classified_log["level"]            = $classifiedObj->getString("level");
						$payment_classified_log["renewal_date"]     = $classifiedObj->getString("renewal_date");
						$payment_classified_log["discount_id"]      = $classifiedObj->getString("discount_id");
						$payment_classified_log["amount"]           = $each_classified["amount"];

						$paymentClassifiedLogObj = new PaymentClassifiedLog($payment_classified_log);
						$paymentClassifiedLogObj->Save();

					}

				}

				if ($articleArray) {

					foreach ($articleArray as $each_article) {

						$articleObj = new Article($each_article["id"]);

						$payment_article_log["payment_log_id"] = $paymentLogObj->getString("id");
						$payment_article_log["article_id"]     = $each_article["id"];
						$payment_article_log["article_title"]  = $articleObj->getString("title",false);
						$payment_article_log["level"]          = $articleObj->getString("level");
						$payment_article_log["renewal_date"]   = $articleObj->getString("renewal_date");
						$payment_article_log["discount_id"]    = $articleObj->getString("discount_id");
						$payment_article_log["amount"]         = $each_article["amount"];

						$paymentArticleLogObj = new PaymentArticleLog($payment_article_log);
						$paymentArticleLogObj->Save();

					}

				}

				if ($customInvoiceArray) {

					foreach ($customInvoiceArray as $each_custominvoice) {

						$customInvoiceObj = new CustomInvoice($each_custominvoice["id"]);
						
						$payment_custominvoice_log["payment_log_id"]    = $paymentLogObj->getString("id");
						$payment_custominvoice_log["custom_invoice_id"] = $each_custominvoice["id"];
						$payment_custominvoice_log["title"]             = $customInvoiceObj->getString("title");
						$payment_custominvoice_log["date"]              = $customInvoiceObj->getString("date");
						$payment_custominvoice_log["items"]             = $customInvoiceObj->getTextItems();
						$payment_custominvoice_log["items_price"]       = $customInvoiceObj->getTextPrices();
						$payment_custominvoice_log["amount"]            = $each_custominvoice["amount"];

						$paymentCustomInvoiceLogObj = new PaymentCustomInvoiceLog($payment_custominvoice_log);
						$paymentCustomInvoiceLogObj->Save();

					}

				}

			}

		}

		if ($itemArray && strtolower($transaction["payment_status"]) == "completed") {

			$db = db_getDBObject();
			$sql = "SELECT id FROM Payment_Log WHERE transaction_id = '".$transaction["txn_id"]."' AND system_type = 'paypal'";
			$r = $db->query($sql);
			$row = mysql_fetch_assoc($r);
			$paymentLogID = $row["id"];
			unset($db, $sql, $r, $row);

			if ($listingArray) {

				$listingStatus = new ItemStatus();

				foreach ($listingArray as $each_listing){

					$listingObj = new Listing($each_listing["id"]);

					$db = db_getDBObject();
					$sql ="UPDATE Payment_Listing_Log SET renewal_date = '".$listingObj->getNextRenewalDate()."' WHERE payment_log_id = '".$paymentLogID."' AND listing_id = '".$listingObj->getString("id")."'";
					$r = $db->query($sql);

					$listingObj->setString("renewal_date", $listingObj->getNextRenewalDate());
					$listingObj->setString("status", $listingStatus->getDefaultStatus());
					$listingObj->save();

					unset($listingObj);

				}

			}

			if ($eventArray) {

				$eventStatus = new ItemStatus();

				foreach ($eventArray as $each_event){

					$eventObj = new Event($each_event["id"]);

					$db = db_getDBObject();
					$sql ="UPDATE Payment_Event_Log SET renewal_date = '".$eventObj->getNextRenewalDate()."' WHERE payment_log_id = '".$paymentLogID."' AND event_id = '".$eventObj->getString("id")."'";
					$r = $db->query($sql);

					$eventObj->setString("renewal_date", $eventObj->getNextRenewalDate());
					$eventObj->setString("status", $eventStatus->getDefaultStatus());
					$eventObj->save();

					unset($eventObj);

				}

			}

			if ($bannerArray) {

				$bannerStatus = new ItemStatus();

				foreach ($bannerArray as $each_banner){

					$bannerObj = new Banner($each_banner["id"]);

					if($bannerObj->getString("expiration_setting") == BANNER_EXPIRATION_IMPRESSION){

						$sql = "UPDATE Banner set impressions = impressions + ".$bannerObj->getNumber("unpaid_impressions").", renewal_date = '0000-00-00', unpaid_impressions = 0 WHERE id = ".$bannerObj->getNumber("id");
						$dbObj = db_getDBObject();
						$result = $dbObj->query($sql);

						$id = $bannerObj->getNumber("id");
						$unpaid_impressions[$id] = $bannerObj->getNumber("unpaid_impressions");

					} elseif ($bannerObj->getString("expiration_setting") == BANNER_EXPIRATION_RENEWAL_DATE){

						$db = db_getDBObject();
						$sql ="UPDATE Payment_Banner_Log SET renewal_date = '".$bannerObj->getNextRenewalDate()."' WHERE payment_log_id = '".$paymentLogID."' AND banner_id = '".$bannerObj->getString("id")."'";
						$r = $db->query($sql);

						$bannerObj->setString("renewal_date", $bannerObj->getNextRenewalDate());
						$bannerObj->setString("status", $bannerStatus->getDefaultStatus());
						$bannerObj->Save();

					}

					unset($bannerObj);

				}

			}

			if ($classifiedArray) {

				$classifiedStatus = new ItemStatus();

				foreach ($classifiedArray as $each_classified){

					$classifiedObj = new Classified($each_classified["id"]);

					$db = db_getDBObject();
					$sql ="UPDATE Payment_Classified_Log SET renewal_date = '".$classifiedObj->getNextRenewalDate()."' WHERE payment_log_id = '".$paymentLogID."' AND classified_id = '".$classifiedObj->getString("id")."'";
					$r = $db->query($sql);

					$classifiedObj->setString("renewal_date", $classifiedObj->getNextRenewalDate());
					$classifiedObj->setString("status", $classifiedStatus->getDefaultStatus());
					$classifiedObj->save();

					unset($classifiedObj);

				}

			}

			if ($articleArray) {

				$articleStatus = new ItemStatus();

				foreach ($articleArray as $each_article){

					$articleObj = new Article($each_article["id"]);

					$db = db_getDBObject();
					$sql ="UPDATE Payment_Article_Log SET renewal_date = '".$articleObj->getNextRenewalDate()."' WHERE payment_log_id = '".$paymentLogID."' AND article_id = '".$articleObj->getString("id")."'";
					$r = $db->query($sql);

					$articleObj->setString("renewal_date", $articleObj->getNextRenewalDate());
					$articleObj->setString("status", $articleStatus->getDefaultStatus());
					$articleObj->save();

					unset($articleObj);

				}

			}

			if ($customInvoiceArray) {

				foreach ($customInvoiceArray as $each_custominvoice){

					$customInvoiceObj = new CustomInvoice($each_custominvoice["id"]);
					$customInvoiceObj->setString("paid", "y");
					$customInvoiceObj->save();

					unset($customInvoiceObj);

				}

			}

			$paymentLogObj = new PaymentLog($paymentLogID);
			$paymentLogObj->sendNotification();

		}

	}

?>