<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/code/billing_worldpay.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# INCLUDE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/conf/payment_worldpay.inc.php");

	extract($_POST);
	extract($_GET);

	if (strpos($_SERVER["PHP_SELF"], "callback.php") === false) {

		$payment_success = "y";

		$payment_message = "<p class=\"successMessage\">\n";
		if ($process == "claim") $payment_message .= system_showText(LANG_MSG_IF_TRANSACTION_WAS_CONFIRMED)."<br />\n".system_showText(LANG_MSG_YOUR_TRANSACTION_AFTER_PAYMENT_PROCESSED)."<br />\n(".system_showText(LANG_MSG_TRANSACTIONS_MAY_NOT_OCCUR_IMMEDIATELY).")<br />\n";
		else $payment_message .= system_showText(LANG_MSG_IF_TRANSACTION_WAS_CONFIRMED)."<br />\n".system_showText(LANG_LABEL_YOUR)." <a href=\"".DEFAULT_URL."/membros/transactions/index.php\">".system_showText(LANG_LABEL_TRANSACTION_HISTORY)."</a> ".system_showText(LANG_MSG_AFTER_PAYMENT_IS_PROCESSED)."<br />\n(".system_showText(LANG_MSG_TRANSACTIONS_MAY_NOT_OCCUR_IMMEDIATELY).")\n";
		$payment_message .= $try_again_message."\n</p>";

	} else {

		$transaction_worldpay = $_POST;

		if ($transaction_worldpay["transStatus"]) {

			if ($transaction_worldpay["transStatus"] != "Y") {
			
				$payment_message = "<p class=\"errorMessage\">\n";

				$payment_message .= system_showText(LANG_LABEL_STATUS).": ".strtoupper(system_showText(LANG_LABEL_FAILURE)).".<br />\n";
				$payment_message .= system_showText(LANG_LABEL_TRANSACTION_ERROR).": ".system_showText(LANG_LABEL_TRANSACTION_CANCELED)."<br />\n";
				if ($process == "signup") $try_again_message = "<a href=\"".DEFAULT_URL."/membros/".$process."/payment.php?payment_method=worldpay\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";
				elseif ($process == "claim") $try_again_message = "<a href=\"".DEFAULT_URL."/membros/".$process."/payment.php?payment_method=worldpay&claimlistingid=".$claimlistingid."\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";
				else $try_again_message = "<a href=\"".DEFAULT_URL."/membros/billing/index.php\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";

			} else {

				$transaction_worldpay["trans_id"]            = $transaction_worldpay["transId"];
				$transaction_worldpay["cart_id"]             = $transaction_worldpay["cartId"];
				$transaction_worldpay["inst_id"]             = $transaction_worldpay["instId"];
				$transaction_worldpay["trans_status"]        = $transaction_worldpay["transStatus"];
				$transaction_worldpay["trans_time"]          = date("Y-m-d H:i:s", ceil($transaction_worldpay["transTime"]/1000));
				$transaction_worldpay["currency"]            = $transaction_worldpay["authCurrency"];
				$transaction_worldpay["avs"]                 = $transaction_worldpay["AVS"];
				$transaction_worldpay["card_type"]           = $transaction_worldpay["cardType"];
				$transaction_worldpay["server_ip"]           = $transaction_worldpay["ipAddress"];
				$transaction_worldpay["client_ip"]           = $transaction_worldpay["MC_ip"];
				$transaction_worldpay["amount"]              = $transaction_worldpay["authAmount"];
				$transaction_worldpay["local_response_time"] = date("Y-m-d H:i:s");
				$transaction_worldpay["description"]         = $transaction_worldpay["desc"];

				$accountObj                          = new Account($MC_account_id);
				$transaction["account_id"]           = $MC_account_id;
				$transaction["username"]             = $accountObj->getString("username");
				$transaction["ip"]                   = $_SERVER["REMOTE_ADDR"];
				$transaction["transaction_id"]       = $transaction_worldpay["trans_id"];
				$transaction["transaction_status"]   = $transaction_worldpay["trans_status"];
				$transaction["transaction_datetime"] = $transaction_worldpay["trans_time"];
				$transaction["transaction_amount"]   = $transaction_worldpay["amount"];
				$transaction["transaction_currency"] = WORLDPAY_CURRENCY;
				$transaction["system_type"]          = "worldpay";
				$transaction["recurring"]            = "n";
				$transaction["notes"]                = "";

				$transaction["listing_ids"]           = $MC_listing_ids;
				$transaction["listing_amounts"]       = $MC_listing_amounts;
				$transaction["event_ids"]             = $MC_event_ids;
				$transaction["event_amounts"]         = $MC_event_amounts;
				$transaction["banner_ids"]            = $MC_banner_ids;
				$transaction["banner_amounts"]        = $MC_banner_amounts;
				$transaction["classified_ids"]        = $MC_classified_ids;
				$transaction["classified_amounts"]    = $MC_classified_amounts;
				$transaction["article_ids"]           = $MC_article_ids;
				$transaction["article_amounts"]       = $MC_article_amounts;
				$transaction["custominvoice_ids"]     = $MC_custominvoice_ids;
				$transaction["custominvoice_amounts"] = $MC_custominvoice_amounts;

				$payment_success = "y";
				
				$payment_message = "<p class=\"successMessage\">\n";

				$payment_message .= system_showText(LANG_LABEL_STATUS).": ".system_showText(LANG_LABEL_APPROVED)."<br />\n";
				$payment_message .= system_showText(LANG_LABEL_TRANSACTION_CODE).": ".$transaction["transaction_id"]."<br />\n";
				$payment_message .= system_showText(LANG_LABEL_TRANSACTION_AMOUNT).": ".$transaction["transaction_amount"]."<br />\n";
				if ($process == "claim") $payment_message .= "<br />\n".system_showText(LANG_MSG_TRANSACTIONS_MAY_NOT_OCCUR_IMMEDIATELY)."<br />\n".system_showText(LANG_MSG_AFTER_PAYMENT_IS_PROCESSED_INFO_ABOUT)."<br />\n".system_showText(LANG_MSG_MAY_BE_FOUND_IN_TRANSACTION_HISTORY)."\n";
                else $payment_message .= "<br />\n".system_showText(LANG_MSG_TRANSACTIONS_MAY_NOT_OCCUR_IMMEDIATELY)."<br />\n".system_showText(LANG_MSG_AFTER_PAYMENT_IS_PROCESSED_INFO_ABOUT)."<br />\n".system_showText(LANG_MSG_MAY_BE_FOUND_IN_YOUR)." <a href=\"".DEFAULT_URL."/membros/transactions/index.php\">".system_showText(LANG_LABEL_TRANSACTION_HISTORY)."</a>\n";

				$transaction["return_fields"] = system_array2nvp($transaction_worldpay, " || ");
				$paymentLogObj = new PaymentLog($transaction);
				$paymentLogObj->Save();

				$listing_ids = split("::",$transaction["listing_ids"]);
				$listing_amounts = split("::",$transaction["listing_amounts"]);
				$event_ids = split("::",$transaction["event_ids"]);
				$event_amounts = split("::",$transaction["event_amounts"]);
				$banner_ids = split("::",$transaction["banner_ids"]);
				$banner_amounts = split("::",$transaction["banner_amounts"]);
				$classified_ids = split("::",$transaction["classified_ids"]);
				$classified_amounts = split("::",$transaction["classified_amounts"]);
				$article_ids = split("::",$transaction["article_ids"]);
				$article_amounts = split("::",$transaction["article_amounts"]);
				$custominvoice_ids = split("::",$transaction["custominvoice_ids"]);
				$custominvoice_amounts = split("::",$transaction["custominvoice_amounts"]);

				if (!empty($listing_ids[0])) {

					$listingStatus = new ItemStatus();

					$amountAux = 0;
					$levelObj = new ListingLevel();
					foreach($listing_ids as $each_listing_id){

						$listingObj = new Listing($each_listing_id);
						$listingObj->setString("renewal_date", $listingObj->getNextRenewalDate());
						$listingObj->setString("status", $listingStatus->getDefaultStatus());
						$listingObj->Save();

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

						$transaction_listing_log["payment_log_id"] = $paymentLogObj->getNumber("id");
						$transaction_listing_log["listing_id"]     = $each_listing_id;
						$transaction_listing_log["listing_title"]  = $listingObj->getString("title", false);
						$transaction_listing_log["level"]          = $listingObj->getString("level");
						$transaction_listing_log["renewal_date"]   = $listingObj->getString("renewal_date");
						$transaction_listing_log["discount_id"]    = $listingObj->getString("discount_id");
						$transaction_listing_log["categories"]     = ($category_amount) ? $category_amount : 0;
						$transaction_listing_log["amount"]         = str_replace(",","",$listing_amounts[$amountAux]);
						$amountAux++;

						$transaction_listing_log["extra_categories"] = 0;
						if (($category_amount > 0) && (($category_amount - $levelObj->getFreeCategory($listingObj->getString("level"))) > 0)) {
							$transaction_listing_log["extra_categories"] = $category_amount - $levelObj->getFreeCategory($listingObj->getString("level"));
						} else {
							$transaction_listing_log["extra_categories"] = 0;
						}

						$transaction_listing_log["listingtemplate_title"] = "";
						if (LISTINGTEMPLATE_FEATURE == "on") {
							if ($listingObj->getString("listingtemplate_id")) {
								$listingTemplateObj = new ListingTemplate($listingObj->getString("listingtemplate_id"));
								$transaction_listing_log["listingtemplate_title"] = $listingTemplateObj->getString("title", false);
							}
						}

						$paymentListingLogObj = new PaymentListingLog($transaction_listing_log);
						$paymentListingLogObj->Save();

					}

					unset($listingObj);

				}

				if (!empty($event_ids[0])) {

					$eventStatus = new ItemStatus();

					$amountAux = 0;
					foreach($event_ids as $each_event_id){

						$eventObj = new Event($each_event_id);
						$eventObj->setString("renewal_date", $eventObj->getNextRenewalDate());
						$eventObj->setString("status", $eventStatus->getDefaultStatus());
						$eventObj->Save();

						$transaction_event_log["payment_log_id"] = $paymentLogObj->getNumber("id");
						$transaction_event_log["event_id"]       = $each_event_id;
						$transaction_event_log["event_title"]    = $eventObj->getString("title",false);
						$transaction_event_log["level"]          = $eventObj->getString("level");
						$transaction_event_log["renewal_date"]   = $eventObj->getString("renewal_date");
						$transaction_event_log["discount_id"]    = $eventObj->getString("discount_id");
						$transaction_event_log["amount"]         = str_replace(",","",$event_amounts[$amountAux]);
						$amountAux++;

						$paymentEventLogObj = new PaymentEventLog($transaction_event_log);
						$paymentEventLogObj->Save();

					}

					unset($eventObj);

				}

				if (!empty($banner_ids[0])) {

					$bannerStatus = new ItemStatus();

					$amountAux = 0;
					foreach($banner_ids as $each_banner_id){

						$bannerObj = new Banner($each_banner_id);

						if($bannerObj->getString("expiration_setting") == BANNER_EXPIRATION_IMPRESSION){

							$sql = "UPDATE Banner set impressions = impressions + ".$bannerObj->getNumber("unpaid_impressions").", renewal_date = '0000-00-00', unpaid_impressions = 0 WHERE id = ".$bannerObj->getNumber("id");
							$dbObj = db_getDBObject();
							$result = $dbObj->query($sql);

							$id = $bannerObj->getNumber("id");
							$unpaid_impressions[$id] = $bannerObj->getNumber("unpaid_impressions");

						} elseif ($bannerObj->getString("expiration_setting") == BANNER_EXPIRATION_RENEWAL_DATE){

							$bannerObj->setString("renewal_date", $bannerObj->getNextRenewalDate());
							$bannerObj->setString("status", $bannerStatus->getDefaultStatus());
							$bannerObj->Save();

						}

						$transaction_banner_log["payment_log_id"] = $paymentLogObj->getNumber("id");
						$transaction_banner_log["banner_id"]      = $each_banner_id;
						$transaction_banner_log["banner_caption"] = $bannerObj->getString("caption",false);
						$transaction_banner_log["level"]          = $bannerObj->getString("type");
						$transaction_banner_log["renewal_date"]   = $bannerObj->getString("renewal_date");
						$transaction_banner_log["discount_id"]    = $bannerObj->getString("discount_id");
						$transaction_banner_log["impressions"]    = ($unpaid_impressions[$each_banner_id]) ? $unpaid_impressions[$each_banner_id] : 0;
						$transaction_banner_log["amount"]         = str_replace(",","",$banner_amounts[$amountAux]);
						$amountAux++;

						$paymentBannerLogObj = new PaymentBannerLog($transaction_banner_log);
						$paymentBannerLogObj->Save();

					}

					unset($bannerObj);

				}

				if (!empty($classified_ids[0])) {

					$classifiedStatus = new ItemStatus();

					$amountAux = 0;
					foreach($classified_ids as $each_classified_id){

						$classifiedObj = new Classified($each_classified_id);
						$classifiedObj->setString("renewal_date", $classifiedObj->getNextRenewalDate());
						$classifiedObj->setString("status", $classifiedStatus->getDefaultStatus());
						$classifiedObj->save();

						$transaction_classified_log["payment_log_id"]   = $paymentLogObj->getNumber("id");
						$transaction_classified_log["classified_id"]    = $each_classified_id;
						$transaction_classified_log["classified_title"] = $classifiedObj->getString("title",false);
						$transaction_classified_log["level"]            = $classifiedObj->getString("level");
						$transaction_classified_log["renewal_date"]     = $classifiedObj->getString("renewal_date");
						$transaction_classified_log["discount_id"]      = $classifiedObj->getString("discount_id");
						$transaction_classified_log["amount"]           = str_replace(",","",$classified_amounts[$amountAux]);
						$amountAux++;

						$paymentClassifiedLogObj = new PaymentClassifiedLog($transaction_classified_log);
						$paymentClassifiedLogObj->Save();

					}

					unset($classifiedObj);

				}

				if (!empty($article_ids[0])) {

					$articleStatus = new ItemStatus();

					$amountAux = 0;
					foreach($article_ids as $each_article_id){

						$articleObj = new Article($each_article_id);
						$articleObj->setString("renewal_date", $articleObj->getNextRenewalDate());
						$articleObj->setString("status", $articleStatus->getDefaultStatus());
						$articleObj->Save();

						$transaction_article_log["payment_log_id"] = $paymentLogObj->getNumber("id");
						$transaction_article_log["article_id"]     = $each_article_id;
						$transaction_article_log["article_title"]  = $articleObj->getString("title",false);
						$transaction_article_log["level"]          = $articleObj->getString("level");
						$transaction_article_log["renewal_date"]   = $articleObj->getString("renewal_date");
						$transaction_article_log["discount_id"]    = $articleObj->getString("discount_id");
						$transaction_article_log["amount"]         = str_replace(",","",$article_amounts[$amountAux]);
						$amountAux++;

						$paymentArticleLogObj = new PaymentArticleLog($transaction_article_log);
						$paymentArticleLogObj->Save();

					}

					unset($articleObj);

				}

				if (!empty($custominvoice_ids[0])) {

					$amountAux = 0;
					foreach($custominvoice_ids as $each_custominvoice_id){

						$customInvoiceObj = new CustomInvoice($each_custominvoice_id);
						$customInvoiceObj->setString("paid", "y");
						$customInvoiceObj->Save();

						$transaction_custominvoice_log["payment_log_id"]    = $paymentLogObj->getNumber("id");
						$transaction_custominvoice_log["custom_invoice_id"] = $each_custominvoice_id;
						$transaction_custominvoice_log["title"]             = $customInvoiceObj->getString("title");
						$transaction_custominvoice_log["date"]              = $customInvoiceObj->getString("date");
						$transaction_custominvoice_log["items"]             = $customInvoiceObj->getTextItems();
						$transaction_custominvoice_log["items_price"]       = $customInvoiceObj->getTextPrices();
						$transaction_custominvoice_log["amount"]            = str_replace(",","",$custominvoice_amounts[$amountAux]);
						$amountAux++;

						$paymentCustomInvoiceLogObj = new PaymentCustomInvoiceLog($transaction_custominvoice_log);
						$paymentCustomInvoiceLogObj->Save();

					}

					unset($customInvoiceObj);

				}

				$paymentLogObj->sendNotification();

			}

			$payment_message .= $try_again_message."</p>";

		} else {
			$payment_message .= "<p class=\"errorMessage\">\n";
			$payment_message .= system_showText(LANG_LABEL_STATUS).":".system_showText(LANG_LABEL_ERROR)."<br />\n";
			$payment_message .= system_showText(LANG_MSG_PAYMENT_GATEWAY_COULD_NOT_RESPOND)."<br />\n";
			$payment_message .= "<a href=\"".DEFAULT_URL."/membros/billing/index.php\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a></p>\n";
		}

		if ($payment_success != "y") {
			setting_get("sitemgr_email", $sitemgr_email);
			//$eDirMailerObj = new EDirMailer(EDIR_ADMIN_EMAIL, "WorldPay Error", $payment_message."\n".$_SERVER["SERVER_NAME"], $sitemgr_email);
			//$eDirMailerObj->send();
			exit;
		}

	}

?>