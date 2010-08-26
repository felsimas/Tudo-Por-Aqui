<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/code/billing_linkpoint.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# INCLUDE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/conf/payment_linkpoint.inc.php");

	extract($_POST);
	extract($_GET);

	if ($pay) {

		$validationok = "yes";

		if (!is_array($listing_id) && !is_array($event_id) && !is_array($banner_id) && !is_array($classified_id) && !is_array($article_id) && !is_array($custominvoice_id)) {
			$validationok = "no";
			if ($process == "signup") $payment_message = "<p class=\"errorMessage\">".system_showText(LANG_MSG_SYSTEM_FAILURE_TRY_AGAIN)."<br />\n<a href=\"".DEFAULT_URL."/membros/".$process."/payment.php?payment_method=linkpoint\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a></p>\n";
			elseif ($process == "claim") $payment_message = "<p class=\"errorMessage\">".system_showText(LANG_MSG_SYSTEM_FAILURE_TRY_AGAIN)."<br />\n<a href=\"".DEFAULT_URL."/membros/".$process."/payment.php?payment_method=linkpoint&claimlistingid=".$claimlistingid."\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a></p>\n";
			else $payment_message = "<p class=\"errorMessage\">".system_showText(LANG_MSG_SYSTEM_FAILURE_TRY_AGAIN)."<br />\n<a href=\"".DEFAULT_URL."/membros/billing/index.php\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a></p>\n";
		}

		if (!$cardnumber || !$cardexpmonth || !$cardexpyear || !$name || !$country || (!$state && !$state2)  || !$city || !$address1 || !$zip || !$phone || !$email) {
			$validationok = "no";
			if ($process == "signup") $payment_message = "<p class=\"errorMessage\">".system_showText(LANG_MSG_FILL_ALL_REQUIRED_FIELDS)."<br />\n<a href=\"".DEFAULT_URL."/membros/".$process."/payment.php?payment_method=linkpoint\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a></p>\n";
			elseif ($process == "claim") $payment_message = "<p class=\"errorMessage\">".system_showText(LANG_MSG_FILL_ALL_REQUIRED_FIELDS)."<br /><a href=\"".DEFAULT_URL."/membros/".$process."/payment.php?payment_method=linkpoint&claimlistingid=".$claimlistingid."\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a></p>\n";
			else $payment_message = "<p class=\"errorMessage\">".system_showText(LANG_MSG_FILL_ALL_REQUIRED_FIELDS)."<br />\n<a href=\"".DEFAULT_URL."/membros/billing/index.php\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a></p>\n";
		}

		// installments calculation
		$installments = 0;
		if ($recurring_type == "m") {
			if ($cardexpyear == date("y")) {
				$installments = $cardexpmonth - date("m");
			} else {
				$installments = (12 - date("m")) + (($cardexpyear - date("y") - 1) * 12) + $cardexpmonth;
			}
		}
		if ($recurring_type == "y") {
			if ($cardexpmonth >= date("m")) $installments = ($cardexpyear-date("y"));
			else $installments = (($cardexpyear-date("y"))-1);
		}

		if ($installments < 0) {
			$validationok = "no";
			if ($process == "signup") $payment_message = "<p class=\"errorMessage\">".system_showText(LANG_MSG_WRONG_CARD_EXPIRATION_TRY_AGAIN)."<br />\n<a href=\"".DEFAULT_URL."/membros/".$process."/payment.php?payment_method=linkpoint\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a></p>\n";
			elseif ($process == "claim") $payment_message = "<p class=\"errorMessage\">".system_showText(LANG_MSG_WRONG_CARD_EXPIRATION_TRY_AGAIN)."<br />\n<a href=\"".DEFAULT_URL."/membros/".$process."/payment.php?payment_method=linkpoint&claimlistingid=".$claimlistingid."\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a></p>\n";
			else $payment_message = "<p class=\"errorMessage\">".system_showText(LANG_MSG_WRONG_CARD_EXPIRATION_TRY_AGAIN)."<br />\n<a href=\"".DEFAULT_URL."/membros/billing/index.php\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a></p>\n";
		} else {
			$installments += 1; // increase one installment because the first is charged immediately.
			$renewal_increase = $installments;
		}

	}

	if ($pay && $validationok == "yes") {

		if ($item_price) {

			$cart_id = strtoupper(uniqid("")); // Unique cart identification, internal use.

			// Mercant info data fields
			$myorder["host"]       = LINKPOINT_HOST;
			$myorder["port"]       = LINKPOINT_PORT;
			$myorder["keyfile"]    = EDIRECTORY_ROOT."/membros/billing/".LINKPOINT_KEYFILE;
			$myorder["configfile"] = LINKPOINT_CONFIGFILE;

			// Billing data fields
			$myorder["name"]     = $name;
			$myorder["country"]  = $country;
			$myorder["state"]    = ($state2) ? $state2 : $state;
			$myorder["city"]     = $city;
			$myorder["address1"] = $address1;
			$myorder["zip"]      = $zip;
			$myorder["phone"]    = $phone;
			$myorder["email"]    = $email;
			$myorder["zip"]      = $zip;

			// Transaction Details fields
			$myorder["ip"] = $_SERVER["REMOTE_ADDR"];

			// Order data fields
			$myorder["ordertype"] = "SALE";

			// Credit Card data fields
			$myorder["cardnumber"]   = $cardnumber;
			$myorder["cardexpmonth"] = $cardexpmonth;
			$myorder["cardexpyear"]  = $cardexpyear;

			// Payment data fields
			$charge_total = 0;
			for($itemCount=0 ; $itemCount < count($item_id); $itemCount++) {
				$charge_total = $charge_total + $item_price[$itemCount];
			}
			$charge_total = format_money($charge_total);
			$myorder["chargetotal"] = str_replace(",","",$charge_total);

			// Periodic params (recurring)
			if ($installments > 1) {
				$myorder["action"]       = "SUBMIT";
				$myorder["installments"] = $installments;
				$myorder["threshold"]    = "3";
				$myorder["startdate"]    = "immediate";
				$myorder["periodicity"]  = $recurring_type;
			}

			// Itens and options data fields (Just for not recurring billings)
			if ($installments == 1) {
				for($i=0 ; $i < count($item_id); $i++) {
					$myorder["items"][$i]["id"]          = $item_id[$i];
					$myorder["items"][$i]["description"] = $item_description[$i];
					$myorder["items"][$i]["quantity"]    = "1";
					$myorder["items"][$i]["price"]       = $item_price[$i];
				}
			}

			// Debuging on/off
			if ($debugging) $myorder["debugging"] = "off";

			// Send transaction
			include_once(EDIRECTORY_ROOT."/membros/billing/lphp.php");
			$mylphp = new lphp;
			$order_result = $mylphp->curl_process($myorder);
			unset($mylphp);

			if (!is_array($order_result)) { // Transaction failure

				$order_result = array();
				$order_result["r_approved"] = (!$order_result["r_approved"]) ? strtoupper(system_showText(LANG_LABEL_FAILURE))  : $order_result["r_approved"];
				$order_result["r_error"]    = (!$order_result["r_error"])    ? system_showText(LANG_MSG_COULD_NOT_CONNECT)      : $order_result["r_error"];

				$payment_message .=  "<p class=\"errorMessage\">".system_showText(LANG_LABEL_TRANSACTION_STATUS).": ".strtoupper(system_showText(LANG_LABEL_FAILURE))." <br />\n";
				if ($process == "signup") $try_again_message .=  system_showText(LANG_LABEL_TRANSACTION_ERROR).":  ".system_showText(LANG_MSG_COULD_NOT_CONNECT)." <a href=\"".DEFAULT_URL."/membros/".$process."/payment.php?payment_method=linkpoint\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";
				elseif ($process == "claim") $try_again_message .=  system_showText(LANG_LABEL_TRANSACTION_ERROR).":  ".system_showText(LANG_MSG_COULD_NOT_CONNECT)." <a href=\"".DEFAULT_URL."/membros/".$process."/payment.php?payment_method=linkpoint&claimlistingid=".$claimlistingid."\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";
				else $try_again_message .=  system_showText(LANG_LABEL_TRANSACTION_ERROR).":  ".system_showText(LANG_MSG_COULD_NOT_CONNECT)." <a href=\"".DEFAULT_URL."/membros/billing/index.php\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";

			} elseif ($order_result["r_approved"] != "APPROVED") {

				$order_result["r_approved"] = (!$order_result["r_approved"]) ? strtoupper(system_showText(LANG_LABEL_FAILURE)) : $order_result["r_approved"];

				if ($signup) {
					$payment_message .= "<p class=\"successMessage\">".system_showText(LANG_MSG_THANKS_FOR_MAKING_THE_PAYMENT)."<br />\n";
					$payment_message .= system_showText(LANG_MSG_SITEMGR_WILL_REVIEW_YOUR_ITEMS)."</p>\n";
				}

				$payment_message .=  "<p class=\"errorMessage\">".system_showText(LANG_LABEL_TRANSACTION_STATUS).": ".$order_result["r_approved"]." <br />\n";
				$payment_message .=  system_showText(LANG_LABEL_TRANSACTION_ERROR).": ".$order_result["r_error"]." <br />\n";

				if ($process == "signup") $try_again_message .=  "<a href=\"".DEFAULT_URL."/membros/".$process."/payment.php?payment_method=linkpoint\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";
				elseif ($process == "claim") $try_again_message .=  "<a href=\"".DEFAULT_URL."/membros/".$process."/payment.php?payment_method=linkpoint&claimlistingid=".$claimlistingid."\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";
				else $try_again_message .=  "<a href=\"".DEFAULT_URL."/membros/billing/index.php\">".system_showText(LANG_MSG_CLICK_HERE_TO_TRY_AGAIN)."</a>\n";

			} else { // Transaction success

				$payment_success = "y";
				
				$payment_message .= "<p class=\"successMessage\">";

				if ($recurring_type == "m") { 
					if ($signup) {
						$payment_message .= system_showText(LANG_MSG_THANKS_FOR_MAKING_THE_PAYMENT)."<br />\n";
						$payment_message .= system_showText(LANG_MSG_SITEMGR_WILL_REVIEW_YOUR_ITEMS)."<br />\n<br />\n";
					}
					$payment_message .= system_showText(LANG_LABEL_MONTHLY_BILL_AMOUNT).": ".CURRENCY_SYMBOL." {$charge_total}<br />\n";
					$payment_message .= system_showText(LANG_LABEL_TRANSACTION_STATUS).": $order_result[r_approved]<br />\n";
					$payment_message .= system_showText(LANG_LABEL_TRANSACTION_OID).": $order_result[r_ordernum]<br />\n";
					$payment_message .= system_showText(LANG_LABEL_TRANSACTION_CODE).": $order_result[r_code]<br />\n";
				} elseif ($recurring_type == "y") {
					if ($signup) {
						$payment_message .= system_showText(LANG_MSG_THANKS_FOR_MAKING_THE_PAYMENT)."<br />\n";
						$payment_message .= system_showText(LANG_MSG_SITEMGR_WILL_REVIEW_YOUR_ITEMS)."<br />\n<br />\n";
					}
					$payment_message .= system_showText(LANG_LABEL_YEARLY_BILL_AMOUNT).": ".CURRENCY_SYMBOL." {$charge_total}<br />\n";
					$payment_message .= system_showText(LANG_LABEL_TRANSACTION_STATUS).": $order_result[r_approved]<br />\n";
					$payment_message .= system_showText(LANG_LABEL_TRANSACTION_OID).": $order_result[r_ordernum]<br />\n";
					$payment_message .= system_showText(LANG_LABEL_TRANSACTION_CODE).": $order_result[r_code]<br />\n";
				} else {
					if ($signup) {
						$payment_message .= system_showText(LANG_MSG_THANKS_FOR_MAKING_THE_PAYMENT)."<br />\n";
						$payment_message .= system_showText(LANG_MSG_SITEMGR_WILL_REVIEW_YOUR_ITEMS)."<br />\n<br />\n";
					}
					$payment_message .= system_showText(LANG_LABEL_BILL_AMOUNT).": ".CURRENCY_SYMBOL." {$charge_total}<br />\n";
					$payment_message .= system_showText(LANG_LABEL_TRANSACTION_STATUS).": $order_result[r_approved]<br />\n";
					$payment_message .= system_showText(LANG_LABEL_TRANSACTION_OID).": $order_result[r_ordernum]<br />\n";
					$payment_message .= system_showText(LANG_LABEL_TRANSACTION_CODE).": $order_result[r_code]<br />\n";
				}
				if ($process == "claim") $payment_message .= system_showText(LANG_MSG_INFO_ABOUT_TRANSACTION_MAY_BE_FOUND)."<br />\n".system_showText(LANG_MSG_IN_YOUR_TRANSACTION_HISTORY)."<br />\n";
				else $payment_message .= system_showText(LANG_MSG_INFO_ABOUT_TRANSACTION_MAY_BE_FOUND)."<br />\n".system_showText(LANG_MSG_IN_YOUR)." <a href=\"".DEFAULT_URL."/membros/transactions/index.php\">".system_showText(LANG_LABEL_TRANSACTION_HISTORY)."</a>\n";
				
				$payment_message .= "</p>";

				if (is_array($order_result)) {
					foreach($order_result as $key => $value){
						if($key == "r_time"){
							$value = strtotime($value);
							$value = date("Y-m-d H:i:s",$value);
						}
						$log_linkpoint["$key"] = $value;
					}
				}

				$log_linkpoint["cart_id"]                = $cart_id;
				$log_linkpoint["chargetotal"]            = $myorder["chargetotal"];
				$log_linkpoint["ordertype"]              = $myorder["ordertype"];
				$log_linkpoint["threshold"]              = $myorder["threshold"];
				$log_linkpoint["installments"]           = $myorder["installments"];
				$log_linkpoint["server_time"]            = date("Y-m-d H:i:s");
				$log_linkpoint["periodicity"]            = $myorder["periodicity"];
				$log_linkpoint["startdate"]              = $myorder["startdate"];
				$log_linkpoint["action"]                 = $myorder["action"];
				$log_linkpoint["last_cardnumber_digits"] = substr($myorder["cardnumber"], -4, strlen($myorder["cardnumber"]));
				$log_linkpoint["cardexpmonth"]           = $myorder["cardexpmonth"];
				$log_linkpoint["cardexpyear"]            = $myorder["cardexpyear"];
				$log_linkpoint["description"]            = ($recurring_type == "m") ? ("Monthly Recurring") : (($recurring_type == "y") ? ("Yearly Recurring") : ("Normal Payment"));

				$log["account_id"]           = $acctId;
				$accountObj                  = new Account($log["account_id"]);
				$log["username"]             = $accountObj->getString("username");
				$log["ip"]                   = $_SERVER["REMOTE_ADDR"];
				$log["transaction_id"]       = $log_linkpoint["cart_id"];
				$log["transaction_status"]   = $log_linkpoint["r_approved"];
				$log["transaction_datetime"] = $log_linkpoint["server_time"];
				$log["transaction_amount"]   = $log_linkpoint["chargetotal"];
				$log["transaction_currency"] = LINKPOINT_CURRENCY;
				$log["system_type"]          = "linkpoint";
				$log["recurring"]            = "n";
				$log["notes"]                = "";

				if ($log_linkpoint["periodicity"]) $log["recurring"] = "y";

				$log["return_fields"] = system_array2nvp($log_linkpoint, " || ");
				$paymentLogObj = new PaymentLog($log);
				$paymentLogObj->Save();

				if (!empty($listing_id[0])) {

					$listingStatus = new ItemStatus();

					$priceAux = 0;
					$levelObj = new ListingLevel();
					foreach($listing_id as $each_listing_id){

						$listingObj = new Listing($each_listing_id);
						$listingObj->setString("renewal_date", $listingObj->getNextRenewalDate($renewal_increase));
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

						$log_listing["payment_log_id"] = $paymentLogObj->getNumber("id");
						$log_listing["listing_id"]     = $listingObj->getString("id");
						$log_listing["listing_title"]  = $listingObj->getString("title", false);
						$log_listing["level"]          = $listingObj->getString("level");
						$log_listing["renewal_date"]   = $listingObj->getString("renewal_date");
						$log_listing["discount_id"]    = $listingObj->getString("discount_id");
						$log_listing["categories"]     = ($category_amount) ? $category_amount : 0;
						$log_listing["amount"]         = str_replace(",","",$listing_price[$priceAux]);
						$priceAux++;

						$log_listing["extra_categories"] = 0;
						if (($category_amount > 0) && (($category_amount - $levelObj->getFreeCategory($listingObj->getString("level"))) > 0)) {
							$log_listing["extra_categories"] = $category_amount - $levelObj->getFreeCategory($listingObj->getString("level"));
						} else {
							$log_listing["extra_categories"] = 0;
						}

						$log_listing["listingtemplate_title"] = "";
						if (LISTINGTEMPLATE_FEATURE == "on") {
							if ($listingObj->getString("listingtemplate_id")) {
								$listingTemplateObj = new ListingTemplate($listingObj->getString("listingtemplate_id"));
								$log_listing["listingtemplate_title"] = $listingTemplateObj->getString("title", false);
							}
						}

						$paymentListingLogObj = new PaymentListingLog($log_listing);
						$paymentListingLogObj->Save();

					}

					unset($listingObj);

				}

				if (!empty($event_id[0])) {

					$eventStatus = new ItemStatus();

					$priceAux = 0;
					foreach($event_id as $each_event_id){

						$eventObj = new Event($each_event_id);
						$eventObj->setString("renewal_date", $eventObj->getNextRenewalDate($renewal_increase));
						$eventObj->setString("status", $eventStatus->getDefaultStatus());
						$eventObj->Save();

						$log_event["payment_log_id"] = $paymentLogObj->getNumber("id");
						$log_event["event_id"]       = $eventObj->getString("id");
						$log_event["event_title"]    = $eventObj->getString("title",false);
						$log_event["level"]          = $eventObj->getString("level");
						$log_event["renewal_date"]   = $eventObj->getString("renewal_date");
						$log_event["discount_id"]    = $eventObj->getString("discount_id");
						$log_event["amount"]         = str_replace(",","",$event_price[$priceAux]);
						$priceAux++;

						$paymentEventLogObj = new PaymentEventLog($log_event);
						$paymentEventLogObj->Save();

					}

					unset($eventObj);

				}

				if (!empty($banner_id[0])) {

					$bannerStatus = new ItemStatus();

					$priceAux = 0;
					foreach($banner_id as $each_banner_id){

						$bannerObj = new Banner($each_banner_id);

						if($bannerObj->getString("expiration_setting") == BANNER_EXPIRATION_IMPRESSION){

							$sql = "UPDATE Banner set impressions = impressions + ".$bannerObj->getNumber("unpaid_impressions").", renewal_date = '0000-00-00', unpaid_impressions = 0 WHERE id = ".$bannerObj->getNumber("id");
							$dbObj = db_getDBObject();
							$result = $dbObj->query($sql);

							$id = $bannerObj->getNumber("id");
							$unpaid_impressions[$id] = $bannerObj->getNumber("unpaid_impressions");

						} elseif ($bannerObj->getString("expiration_setting") == BANNER_EXPIRATION_RENEWAL_DATE){

							$bannerObj->setString("renewal_date", $bannerObj->getNextRenewalDate($renewal_increase));
							$bannerObj->setString("status", $bannerStatus->getDefaultStatus());
							$bannerObj->Save();

						}

						$log_banner["payment_log_id"] = $paymentLogObj->getNumber("id");
						$log_banner["banner_id"]      = $bannerObj->getString("id");
						$log_banner["banner_caption"] = $bannerObj->getString("caption",false);
						$log_banner["level"]          = $bannerObj->getString("type");
						$log_banner["renewal_date"]   = $bannerObj->getString("renewal_date");
						$log_banner["discount_id"]    = $bannerObj->getString("discount_id");
						$log_banner["impressions"]    = ($unpaid_impressions[$each_banner_id]) ? $unpaid_impressions[$each_banner_id] : 0;
						$log_banner["amount"]         = str_replace(",","",$banner_price[$priceAux]);
						$priceAux++;

						$paymentBannerLogObj = new PaymentBannerLog($log_banner);
						$paymentBannerLogObj->Save();

					}

					unset($bannerObj);

				}

				if (!empty($classified_id[0])) {

					$classifiedStatus = new ItemStatus();

					$priceAux = 0;
					foreach($classified_id as $each_classified_id){

						$classifiedObj = new Classified($each_classified_id);
						$classifiedObj->setString("renewal_date", $classifiedObj->getNextRenewalDate($renewal_increase));
						$classifiedObj->setString("status", $classifiedStatus->getDefaultStatus());
						$classifiedObj->save();

						$log_classified["payment_log_id"]   = $paymentLogObj->getNumber("id");
						$log_classified["classified_id"]    = $classifiedObj->getString("id");
						$log_classified["classified_title"] = $classifiedObj->getString("title",false);
						$log_classified["level"]            = $classifiedObj->getString("level");
						$log_classified["renewal_date"]     = $classifiedObj->getString("renewal_date");
						$log_classified["discount_id"]      = $classifiedObj->getString("discount_id");
						$log_classified["amount"]           = str_replace(",","",$classified_price[$priceAux]);
						$priceAux++;

						$paymentClassifiedLogObj = new PaymentClassifiedLog($log_classified);
						$paymentClassifiedLogObj->Save();

					}

					unset($classifiedObj);

				}

				if (!empty($article_id[0])) {

					$articleStatus = new ItemStatus();

					$priceAux = 0;
					foreach($article_id as $each_article_id){

						$articleObj = new Article($each_article_id);
						$articleObj->setString("renewal_date", $articleObj->getNextRenewalDate($renewal_increase));
						$articleObj->setString("status", $articleStatus->getDefaultStatus());
						$articleObj->Save();

						$log_article["payment_log_id"] = $paymentLogObj->getNumber("id");
						$log_article["article_id"]     = $articleObj->getString("id");
						$log_article["article_title"]  = $articleObj->getString("title",false);
						$log_article["level"]          = $articleObj->getString("level");
						$log_article["renewal_date"]   = $articleObj->getString("renewal_date");
						$log_article["discount_id"]    = $articleObj->getString("discount_id");
						$log_article["amount"]         = str_replace(",","",$article_price[$priceAux]);
						$priceAux++;

						$paymentArticleLogObj = new PaymentArticleLog($log_article);
						$paymentArticleLogObj->Save();

					}

					unset($articleObj);

				}

				if (!empty($custominvoice_id[0])) {

					$priceAux = 0;
					foreach($custominvoice_id as $each_custominvoice_id){

						$customInvoiceObj = new CustomInvoice($each_custominvoice_id);
						$customInvoiceObj->setString("paid", "y");
						$customInvoiceObj->Save();

						$log_custominvoice["payment_log_id"]    = $paymentLogObj->getNumber("id");
						$log_custominvoice["custom_invoice_id"] = $customInvoiceObj->getString("id");
						$log_custominvoice["title"]             = $customInvoiceObj->getString("title");
						$log_custominvoice["date"]              = $customInvoiceObj->getString("date");
						$log_custominvoice["items"]             = $customInvoiceObj->getTextItems();
						$log_custominvoice["items_price"]       = $customInvoiceObj->getTextPrices();
						$log_custominvoice["amount"]            = str_replace(",","",$custominvoice_price[$priceAux]);
						$priceAux++;

						$paymentCustomInvoiceLogObj = new PaymentCustomInvoiceLog($log_custominvoice);
						$paymentCustomInvoiceLogObj->Save();

					}

					unset($customInvoiceObj);

				}

				$paymentLogObj->sendNotification();

			}

			$payment_message .= $try_again_message."</p>";

		}

	}

?>