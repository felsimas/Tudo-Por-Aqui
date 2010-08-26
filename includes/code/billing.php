<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/code/billing.php
	# ----------------------------------------------------------------------------------------------------

	$max_item_sum = 50;

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	extract($_POST);
	extract($_GET);

	if ($second_step && !$payment_method) {
		$payment_message = system_showText(LANG_MSG_NO_PAYMENT_METHOD_SELECTED);
	} else {



		/**
		* Listing bill information
		*******************************************************************************/

		if (!$second_step) {
			$dbObject = db_getDBObject();
			$sql = "SELECT count(id) FROM Listing WHERE account_id = ".sess_getAccountIdFromSession();
			$result = $dbObject->query($sql);
			if ($row = mysql_fetch_array($result)) {
				$total_listing_sum = $row[0];
			}
			unset($dbObject);
			if ($total_listing_sum <= 50) {
				$listings = db_getFromDB("listing", "account_id", sess_getAccountIdFromSession(), "", "title", "array");
			} else {
				$overlisting_msg = system_showText(LANG_MSG_OVERITEM_MORETHAN)." ".$max_item_sum." ".system_showText(LANG_LISTING_FEATURE_NAME_PLURAL).". ".system_showText(LANG_MSG_OVERITEM_CONTACTADMIN).".";
			}
		} else {
			if ($listing_id) {
				for ($i=0; $i < count($listing_id); $i++) {
					$listingObj = new Listing($listing_id[$i]);
					if (!is_valid_discount_code($discountlisting_id[$i], "listing", $listing_id[$i], $payment_message, $error_num)) {
						$payment_message = substr($payment_message, 0 ,-1);
						$payment_message .= " ".system_showText(LANG_ON_LISTING)." \"<b>".$listingObj->getString("title")."</b>\"<br />";
					} elseif (is_array($discountlisting_id)){
						$listingObj->setString("discount_id", $discountlisting_id[$i]);
						$listingObj->Save();
						unset($listingObj);
					}
					$by_key = array("id", "account_id");
					$by_value = array(db_formatNumber($listing_id[$i]), sess_getAccountIdFromSession());
					$listings[] = db_getFromDB("listing", $by_key, $by_value, "1", "title", "array");
				}
			}
		}

		if ($listings) {

			$levelObj = new ListingLevel();

			foreach ($listings as $each_listing) {

				if ($second_step) {
					$auxListingObj = new Listing($each_listing["id"]);
					$each_listing["renewal_date"] = $auxListingObj->getNextRenewalDate();
					unset($auxListingObj);
				}

				// retrieving categories related with listing
				$db = db_getDBObject();
				$sql = "SELECT cat_1_id, cat_2_id, cat_3_id, cat_4_id, cat_5_id FROM Listing WHERE id = {$each_listing["id"]}";
				$r = $db->query($sql);
				$row = mysql_fetch_assoc($r);
				$category_amount = 0;
				if ($row["cat_1_id"]) $category_amount++;
				if ($row["cat_2_id"]) $category_amount++;
				if ($row["cat_3_id"]) $category_amount++;
				if ($row["cat_4_id"]) $category_amount++;
				if ($row["cat_5_id"]) $category_amount++;

				// setting some of the bill information
				$bill_info["listings"]["{$each_listing["id"]}"]["title"]           = htmlspecialchars($each_listing["title"]);
				$bill_info["listings"]["{$each_listing["id"]}"]["level"]           = $levelObj->getLevel($each_listing["level"]);
				$bill_info["listings"]["{$each_listing["id"]}"]["level_number"]    = $each_listing["level"];
				$bill_info["listings"]["{$each_listing["id"]}"]["logo"]            = ($each_listing["image_id"]) ? 1 : 0;
				$bill_info["listings"]["{$each_listing["id"]}"]["url"]             = ($each_listing["url"]) ? 1 : 0;
				$bill_info["listings"]["{$each_listing["id"]}"]["category_amount"] = ($category_amount) ? $category_amount : 0;
				$bill_info["listings"]["{$each_listing["id"]}"]["renewal_date"]    = $each_listing["renewal_date"];
				$bill_info["listings"]["{$each_listing["id"]}"]["discount_id"]     = $each_listing["discount_id"];
				$bill_info["listings"]["{$each_listing["id"]}"]["status"]          = $each_listing["status"];

				if (LISTINGTEMPLATE_FEATURE == "on") {
					if ($each_listing["listingtemplate_id"]) {
						$listingTemplateObj = new ListingTemplate($each_listing["listingtemplate_id"]);
						$bill_info["listings"]["{$each_listing["id"]}"]["listingtemplate"] = $listingTemplateObj->getString("title");
					}
				}

				// Need To Check Out
				$thisListing = new Listing($each_listing["id"]);
				if ($thisListing->needToCheckOut()) $bill_info["listings"]["{$each_listing["id"]}"]["needtocheckout"] = "y";
				else $bill_info["listings"]["{$each_listing["id"]}"]["needtocheckout"] = "n";
				unset($thisListing);

				if (($category_amount > 0) && (($category_amount - $levelObj->getFreeCategory($each_listing["level"])) > 0)) {
					$bill_info["listings"]["{$each_listing["id"]}"]["extra_category_amount"] = $category_amount - $levelObj->getFreeCategory($each_listing["level"]);
				} else {
					$bill_info["listings"]["{$each_listing["id"]}"]["extra_category_amount"] = 0;
				}

				// Bill pricing
				$thisListing = new Listing($each_listing["id"]);
				$bill_info["listings"]["{$each_listing["id"]}"]["total_fee"] = $thisListing->getPrice();
				unset($thisListing);

				if ($bill_info["listings"]["{$each_listing["id"]}"]["total_fee"] <= 0) {
					unset($bill_info["listings"]["{$each_listing["id"]}"]);
					continue;
				}

				// Setting total bill
				if($bill_info["listings"]["{$each_listing["id"]}"]["total_fee"])
					$bill_info["total_bill"] += $bill_info["listings"]["{$each_listing["id"]}"]["total_fee"];

				// Money format for listing fees
				if($bill_info["listings"]["{$each_listing["id"]}"]["total_fee"])
					$bill_info["listings"]["{$each_listing["id"]}"]["total_fee"] = format_money($bill_info["listings"]["{$each_listing["id"]}"]["total_fee"]);

			}

			// There is no listing been payed.
			if (empty($bill_info["listings"])) unset($bill_info["listings"]);

		}



		/**
		* Event bill information
		*******************************************************************************/

		if (!$second_step) {
			if (EVENT_FEATURE == "on") {
				$dbObject = db_getDBObject();
				$sql = "SELECT count(id) FROM Event WHERE account_id = ".sess_getAccountIdFromSession();
				$result = $dbObject->query($sql);
				if ($row = mysql_fetch_array($result)) {
					$total_event_sum = $row[0];
				}
				unset($dbObject);
				if ($total_event_sum <= 50) {
					$events = db_getFromDB("event", "account_id", sess_getAccountIdFromSession(), "", "title", "array");
				} else {
					$overevent_msg = system_showText(LANG_MSG_OVERITEM_MORETHAN)." ".$max_item_sum." ".system_showText(LANG_EVENT_FEATURE_NAME_PLURAL).". ".system_showText(LANG_MSG_OVERITEM_CONTACTADMIN).".";
				}
			}
		} else {
			if ($event_id) {
				for ($i=0; $i < count($event_id); $i++) {
					$eventObj = new Event($event_id[$i]);
					if (!is_valid_discount_code($discountevent_id[$i], "event", $event_id[$i], $payment_message, $error_num)) {
						$payment_message = substr($payment_message, 0 ,-1);
						$payment_message .= " ".system_showText(LANG_ON_EVENT)." \"<b>".$eventObj->getString("title")."</b>\"<br />";
					} elseif (is_array($discountevent_id)){
						$eventObj->setString("discount_id", $discountevent_id[$i]);
						$eventObj->Save();
						unset($eventObj);
					}
					$by_key = array("id", "account_id");
					$by_value = array(db_formatNumber($event_id[$i]), sess_getAccountIdFromSession());
					$events[] = db_getFromDB("event", $by_key, $by_value, "1", "title", "array");
				}
			}
		}

		if ($events) {

			$eventLevelObj = new EventLevel();

			foreach ($events as $each_event) {

				if ($second_step) {
					$auxEventObj = new Event($each_event["id"]);
					$each_event["renewal_date"] = $auxEventObj->getNextRenewalDate();
					unset($auxEventObj);
				}

				// setting some of the bill information
				$bill_info["events"]["{$each_event["id"]}"]["title"]        = htmlspecialchars($each_event["title"]);
				$bill_info["events"]["{$each_event["id"]}"]["level"]        = $eventLevelObj->getLevel($each_event["level"]);
				$bill_info["events"]["{$each_event["id"]}"]["level_number"] = $each_event["level"];
				$bill_info["events"]["{$each_event["id"]}"]["renewal_date"] = $each_event["renewal_date"];
				$bill_info["events"]["{$each_event["id"]}"]["discount_id"]  = $each_event["discount_id"];
				$bill_info["events"]["{$each_event["id"]}"]["status"]       = $each_event["status"];

				// Need To Check Out
				$thisEvent = new Event($each_event["id"]);
				if ($thisEvent->needToCheckOut()) $bill_info["events"]["{$each_event["id"]}"]["needtocheckout"] = "y";
				else $bill_info["events"]["{$each_event["id"]}"]["needtocheckout"] = "n";
				unset($thisEvent);

				// Bill pricing
				$thisEvent = new Event($each_event["id"]);
				$bill_info["events"]["{$each_event["id"]}"]["total_fee"] = $thisEvent->getPrice();
				unset($thisEvent);

				if ($bill_info["events"]["{$each_event["id"]}"]["total_fee"] <= 0) {
					unset($bill_info["events"]["{$each_event["id"]}"]);
					continue;
				}

				// Setting total bill
				if($bill_info["events"]["{$each_event["id"]}"]["total_fee"])
					$bill_info["total_bill"] += $bill_info["events"]["{$each_event["id"]}"]["total_fee"];

				// Money format for event fees
				if($bill_info["events"]["{$each_event["id"]}"]["total_fee"])
					$bill_info["events"]["{$each_event["id"]}"]["total_fee"] = format_money($bill_info["events"]["{$each_event["id"]}"]["total_fee"]);

			}

			// There is no event been payed.
			if (empty($bill_info["events"])) unset($bill_info["events"]);

		}



		/**
		* Banner bill information
		*******************************************************************************/

		if (!$second_step) {
			if (BANNER_FEATURE == "on") {
				$dbObject = db_getDBObject();
				$sql = "SELECT count(id) FROM Banner WHERE account_id = ".sess_getAccountIdFromSession();
				$result = $dbObject->query($sql);
				if ($row = mysql_fetch_array($result)) {
					$total_banner_sum = $row[0];
				}
				unset($dbObject);
				if ($total_banner_sum <= 50) {
					$banners = db_getFromDB("banner", "account_id", sess_getAccountIdFromSession(), "", "caption", "array");
				} else {
					$overbanner_msg = system_showText(LANG_MSG_OVERITEM_MORETHAN)." ".$max_item_sum." ".system_showText(LANG_BANNER_FEATURE_NAME_PLURAL).". ".system_showText(LANG_MSG_OVERITEM_CONTACTADMIN).".";
				}
			}
		} else {
			if ($banner_id) {
				for ($i=0; $i < count($banner_id); $i++) {
					$bannerObj = new Banner($banner_id[$i]);
					if (!is_valid_discount_code($discountbanner_id[$i], "banner", $banner_id[$i], $payment_message, $error_num)) {
						$payment_message = substr($payment_message, 0 ,-1);
						$payment_message .= " ".system_showText(LANG_ON_BANNER)." \"<b>".$bannerObj->getString("caption")."</b>\"<br />";
					} elseif (is_array($discountbanner_id)){
						$bannerObj->setString("discount_id", $discountbanner_id[$i]);
						$bannerObj->Save();
						unset($bannerObj);
					}
					$by_key = array("id", "account_id");
					$by_value = array(db_formatNumber($banner_id[$i]), sess_getAccountIdFromSession());
					$banners[] = db_getFromDB("banner", $by_key, $by_value, "1", "caption", "array");
				}
			}
		}

		if ($banners) {

			$bannerLevelObj = new BannerLevel();

			foreach ($banners as $each_banner) {

				if($each_banner["expiration_setting"] == BANNER_EXPIRATION_IMPRESSION){

					$each_banner["renewal_date"] = false;

				} elseif ($each_banner["expiration_setting"] == BANNER_EXPIRATION_RENEWAL_DATE){

					if ($second_step) {
						$auxBannerObj = new Banner($each_banner["id"]);
						$each_banner["renewal_date"] = $auxBannerObj->getNextRenewalDate();
						unset($auxBannerObj);
					}

				}

				// setting some of the bill information
				$bill_info["banners"]["{$each_banner["id"]}"]["caption"]            = htmlspecialchars($each_banner["caption"]);
				$bill_info["banners"]["{$each_banner["id"]}"]["level"]              = $bannerLevelObj->getLevel($each_banner["type"]);
				$bill_info["banners"]["{$each_banner["id"]}"]["level_number"]       = $each_banner["type"];
				$bill_info["banners"]["{$each_banner["id"]}"]["expiration_setting"] = $each_banner["expiration_setting"];
				$bill_info["banners"]["{$each_banner["id"]}"]["renewal_date"]       = $each_banner["renewal_date"];
				$bill_info["banners"]["{$each_banner["id"]}"]["discount_id"]        = $each_banner["discount_id"];
				$bill_info["banners"]["{$each_banner["id"]}"]["unpaid_impressions"] = $each_banner["unpaid_impressions"];
				$bill_info["banners"]["{$each_banner["id"]}"]["status"]             = $each_banner["status"];

				// Need To Check Out
				$thisBanner = new Banner($each_banner["id"]);
				if ($thisBanner->needToCheckOut()) $bill_info["banners"]["{$each_banner["id"]}"]["needtocheckout"] = "y";
				else $bill_info["banners"]["{$each_banner["id"]}"]["needtocheckout"] = "n";
				unset($thisBanner);

				// Bill pricing
				$thisBanner = new Banner($each_banner["id"]);
				$bill_info["banners"]["{$each_banner["id"]}"]["total_fee"] = $thisBanner->getPrice();
				unset($thisBanner);

				if ($bill_info["banners"]["{$each_banner["id"]}"]["total_fee"] <= 0) {
					unset($bill_info["banners"]["{$each_banner["id"]}"]);
					continue;
				}

				// Setting total bill
				if($bill_info["banners"]["{$each_banner["id"]}"]["total_fee"])
					$bill_info["total_bill"] += $bill_info["banners"]["{$each_banner["id"]}"]["total_fee"];

				// Money format for banner fees
				if($bill_info["banners"]["{$each_banner["id"]}"]["total_fee"])
					$bill_info["banners"]["{$each_banner["id"]}"]["total_fee"] = format_money($bill_info["banners"]["{$each_banner["id"]}"]["total_fee"]);

			}

			// There is no banner been payed.
			if (empty($bill_info["banners"])) unset($bill_info["banners"]);

		}



		/**
		* Classified bill information
		*******************************************************************************/

		if (!$second_step) {
			if (CLASSIFIED_FEATURE == "on") {
				$dbObject = db_getDBObject();
				$sql = "SELECT count(id) FROM Classified WHERE account_id = ".sess_getAccountIdFromSession();
				$result = $dbObject->query($sql);
				if ($row = mysql_fetch_array($result)) {
					$total_classified_sum = $row[0];
				}
				unset($dbObject);
				if ($total_classified_sum <= 50) {
					$classifieds = db_getFromDB("classified", "account_id", sess_getAccountIdFromSession(), "", "title", "array");
				} else {
					$overclassified_msg = system_showText(LANG_MSG_OVERITEM_MORETHAN)." ".$max_item_sum." ".system_showText(LANG_CLASSIFIED_FEATURE_NAME_PLURAL).". ".system_showText(LANG_MSG_OVERITEM_CONTACTADMIN).".";
				}
			}
		} else {
			if( $classified_id) {
				for ($i=0; $i < count($classified_id); $i++) {
					$classifiedObj = new Classified($classified_id[$i]);
					if (!is_valid_discount_code($discountclassified_id[$i], "classified", $classified_id[$i], $payment_message, $error_num)) {
						$payment_message = substr($payment_message, 0 ,-1);
						$payment_message .= " ".system_showText(LANG_ON_CLASSIFIED)." \"<b>".$classifiedObj->getString("title")."</b>\"<br />";
					} elseif (is_array($discountclassified_id)){
						$classifiedObj->setString("discount_id", $discountclassified_id[$i]);
						$classifiedObj->Save();
						unset($classifiedObj);
					}
					$by_key = array("id", "account_id");
					$by_value = array(db_formatNumber($classified_id[$i]), sess_getAccountIdFromSession());
					$classifieds[] = db_getFromDB("classified", $by_key, $by_value, "1", "title", "array");
				}
			}
		}

		if ($classifieds) {

			$classifiedLevelObj = new ClassifiedLevel();

			foreach ($classifieds as $each_classified) {

				if ($second_step) {
					$auxClassifiedObj = new Classified($each_classified["id"]);
					$each_classified["renewal_date"] = $auxClassifiedObj->getNextRenewalDate();
					unset($auxClassifiedObj);
				}

				// setting some of the bill information
				$bill_info["classifieds"]["{$each_classified["id"]}"]["title"]        = htmlspecialchars($each_classified["title"]);
				$bill_info["classifieds"]["{$each_classified["id"]}"]["level"]        = $classifiedLevelObj->getLevel($each_classified["level"]);
				$bill_info["classifieds"]["{$each_classified["id"]}"]["level_number"] = $each_classified["level"];
				$bill_info["classifieds"]["{$each_classified["id"]}"]["renewal_date"] = $each_classified["renewal_date"];
				$bill_info["classifieds"]["{$each_classified["id"]}"]["discount_id"]  = $each_classified["discount_id"];
				$bill_info["classifieds"]["{$each_classified["id"]}"]["status"]       = $each_classified["status"];

				// Need To Check Out
				$thisClassified = new Classified($each_classified["id"]);
				if ($thisClassified->needToCheckOut()) $bill_info["classifieds"]["{$each_classified["id"]}"]["needtocheckout"] = "y";
				else $bill_info["classifieds"]["{$each_classified["id"]}"]["needtocheckout"] = "n";
				unset($thisClassified);

				// Bill pricing
				$thisClassified = new Classified($each_classified["id"]);
				$bill_info["classifieds"]["{$each_classified["id"]}"]["total_fee"] = $thisClassified->getPrice();
				unset($thisClassified);

				if ($bill_info["classifieds"]["{$each_classified["id"]}"]["total_fee"] <= 0) {
					unset($bill_info["classifieds"]["{$each_classified["id"]}"]);
					continue;
				}

				// Setting total bill
				if($bill_info["classifieds"]["{$each_classified["id"]}"]["total_fee"])
					$bill_info["total_bill"] += $bill_info["classifieds"]["{$each_classified["id"]}"]["total_fee"];

				// Money format for classified fees
				if($bill_info["classifieds"]["{$each_classified["id"]}"]["total_fee"])
					$bill_info["classifieds"]["{$each_classified["id"]}"]["total_fee"] = format_money($bill_info["classifieds"]["{$each_classified["id"]}"]["total_fee"]);

			}

			// There is no classified been payed.
			if (empty($bill_info["classifieds"])) unset($bill_info["classifieds"]);

		}



		/**
		* Article bill information
		*******************************************************************************/

		if (!$second_step) {
			if (ARTICLE_FEATURE == "on") {
				$dbObject = db_getDBObject();
				$sql = "SELECT count(id) FROM Article WHERE account_id = ".sess_getAccountIdFromSession();
				$result = $dbObject->query($sql);
				if ($row = mysql_fetch_array($result)) {
					$total_article_sum = $row[0];
				}
				unset($dbObject);
				if ($total_article_sum <= 50) {
					$articles = db_getFromDB("article", "account_id", sess_getAccountIdFromSession(), "", "title", "array");
				} else {
					$overarticle_msg = system_showText(LANG_MSG_OVERITEM_MORETHAN)." ".$max_item_sum." ".system_showText(LANG_ARTICLE_FEATURE_NAME_PLURAL).". ".system_showText(LANG_MSG_OVERITEM_CONTACTADMIN).".";
				}
			}
		} else {
			if ($article_id) {
				for ($i=0; $i < count($article_id); $i++) {
					$articleObj = new Article($article_id[$i]);
					if (!is_valid_discount_code($discountarticle_id[$i], "article", $article_id[$i], $payment_message, $error_num)) {
						$payment_message = substr($payment_message, 0 ,-1);
						$payment_message .= " ".system_showText(LANG_ON_ARTICLE)." \"<b>".$articleObj->getString("title")."</b>\"<br />";
					} elseif (is_array($discountarticle_id)){
						$articleObj->setString("discount_id", $discountarticle_id[$i]);
						$articleObj->Save();
						unset($articleObj);
					}
					$by_key = array("id", "account_id");
					$by_value = array(db_formatNumber($article_id[$i]), sess_getAccountIdFromSession());
					$articles[] = db_getFromDB("article", $by_key, $by_value, "1", "title", "array");
				}
			}
		}

		if ($articles) {

			$articleLevelObj = new ArticleLevel();

			foreach($articles as $each_article){

				if ($second_step) {
					$auxArticleObj = new Article($each_article["id"]);
					$each_article["renewal_date"] = $auxArticleObj->getNextRenewalDate();
					unset($auxArticleObj);
				}

				// setting some of the bill information
				$bill_info["articles"]["{$each_article["id"]}"]["title"]        = htmlspecialchars($each_article["title"]);
				$bill_info["articles"]["{$each_article["id"]}"]["level"]        = $articleLevelObj->getLevel($each_article["level"]);
				$bill_info["articles"]["{$each_article["id"]}"]["level_number"] = $each_article["level"];
				$bill_info["articles"]["{$each_article["id"]}"]["renewal_date"] = $each_article["renewal_date"];
				$bill_info["articles"]["{$each_article["id"]}"]["discount_id"]  = $each_article["discount_id"];
				$bill_info["articles"]["{$each_article["id"]}"]["status"]       = $each_article["status"];

				// Need To Check Out
				$thisArticle = new Article($each_article["id"]);
				if ($thisArticle->needToCheckOut()) $bill_info["articles"]["{$each_article["id"]}"]["needtocheckout"] = "y";
				else $bill_info["articles"]["{$each_article["id"]}"]["needtocheckout"] = "n";
				unset($thisArticle);

				// Bill pricing
				$thisArticle = new Article($each_article["id"]);
				$bill_info["articles"]["{$each_article["id"]}"]["total_fee"] = $thisArticle->getPrice();
				unset($thisArticle);

				if ($bill_info["articles"]["{$each_article["id"]}"]["total_fee"] <= 0) {
					unset($bill_info["articles"]["{$each_article["id"]}"]);
					continue;
				}

				// Setting total bill
				if($bill_info["articles"]["{$each_article["id"]}"]["total_fee"])
					$bill_info["total_bill"] += $bill_info["articles"]["{$each_article["id"]}"]["total_fee"];

				// Money format for article fees
				if($bill_info["articles"]["{$each_article["id"]}"]["total_fee"])
					$bill_info["articles"]["{$each_article["id"]}"]["total_fee"] = format_money($bill_info["articles"]["{$each_article["id"]}"]["total_fee"]);

			}

			// There is no article been payed.
			if (empty($bill_info["articles"])) unset($bill_info["articles"]);

		}



		/**
		* Custom Invoice bill information
		*******************************************************************************/

		if (CUSTOM_INVOICE_FEATURE == "on") {

			if (!$second_step) {

				$by_key = array("account_id", "paid", "sent");
				$by_value = array(sess_getAccountIdFromSession(), "''", "'y'");
				$customInvoices = db_getFromDB("custominvoice", $by_key, $by_value, "", "id DESC", "array");

			} else {

				if($custom_invoice_id){
					for($i=0; $i < count($custom_invoice_id); $i++){
						$customInvoiceObj = new CustomInvoice($custom_invoice_id[$i]);
						$by_key = array("id", "account_id");
						$by_value = array(db_formatNumber($custom_invoice_id[$i]), sess_getAccountIdFromSession());
						$customInvoices[] = db_getFromDB("custominvoice", $by_key, $by_value, "1", "id DESC", "array");
					}
				}

			}

			if ($customInvoices) {

				foreach($customInvoices as $each_custom_invoice){

					$customInvoiceObj = new CustomInvoice($each_custom_invoice["id"]);

					// setting some of the bill information
					$bill_info["custominvoices"]["{$each_custom_invoice["id"]}"]["id"]     = $each_custom_invoice["id"];
					$bill_info["custominvoices"]["{$each_custom_invoice["id"]}"]["amount"] = $customInvoiceObj->getPrice();
					$bill_info["custominvoices"]["{$each_custom_invoice["id"]}"]["title"]  = htmlspecialchars($each_custom_invoice["title"]);
					$bill_info["custominvoices"]["{$each_custom_invoice["id"]}"]["date"]   = $each_custom_invoice["date"];

					// Setting total bill
					if($bill_info["custominvoices"]["{$each_custom_invoice["id"]}"]["amount"])
						$bill_info["total_bill"] += $bill_info["custominvoices"]["{$each_custom_invoice["id"]}"]["amount"];

					// Money format for custom invoice ammount
					if($bill_info["custominvoices"]["{$each_custom_invoice["id"]}"]["amount"])
							$bill_info["custominvoices"]["{$each_custom_invoice["id"]}"]["amount"] = format_money($bill_info["custominvoices"]["{$each_custom_invoice["id"]}"]["amount"]);

					// There is not custom invoice being payed.
					if(empty($bill_info["custominvoices"])) unset($bill_info["custominvoices"]);

					if ($bill_info["custominvoices"]["{$each_custom_invoice["id"]}"]["amount"] <= 0) {
						unset($bill_info["custominvoices"]["{$each_custom_invoice["id"]}"]);
						continue;
					}

				}

			}
		}

		// Money format for total bill
		$bill_info["total_bill"] = format_money($bill_info["total_bill"]);
		////////////////////////////////////////////////////////////////////////



		// INVOICE /////////////////////////////////////////////////////////////
		if ($second_step) {

			if (($payment_method == "invoice") && ($bill_info["total_bill"] > 0)) {

				if (($bill_info["listings"]) || ($bill_info["events"]) || ($bill_info["banners"]) || ($bill_info["classifieds"]) || ($bill_info["articles"]) || ($bill_info["custominvoices"])) {

					$invoiceStatusObj = new InvoiceStatus();
					$accountObj       = new Account($acctId);

					$arr_invoice["account_id"]  = $acctId;
					$arr_invoice["username"]    = $accountObj->getString("username");
					$arr_invoice["ip"]          = $_SERVER["REMOTE_ADDR"];
					$arr_invoice["date"]        = date("Y")."-".date("m")."-".date("d")." ".date("H").":".date("i").":".date("s");
					$arr_invoice["status"]      = $invoiceStatusObj->getDefault();
					$arr_invoice["amount"]      = str_replace(",","",$bill_info["total_bill"]);
					$arr_invoice["currency"]    = INVOICEPAYMENT_CURRENCY;
					$arr_invoice["expire_date"] = date("Y-m-d",mktime(0,0,0,date("m")+1,date("d"),date("Y")));

					$invoiceObj = new Invoice($arr_invoice);
					$invoiceObj->Save();

					$bill_info["invoice_number"] = $invoiceObj->getString("id");

					$levelObj = new ListingLevel();
					if ($bill_info["listings"]) foreach ($bill_info["listings"] as $id => $info) {

						$listingObj = new Listing($id);

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

						$arr_invoice_listing["invoice_id"]    = $invoiceObj->getString("id");
						$arr_invoice_listing["listing_id"]    = $id;
						$arr_invoice_listing["listing_title"] = $listingObj->getString("title", false);
						$arr_invoice_listing["discount_id"]   = $listingObj->getString("discount_id");
						$arr_invoice_listing["level"]         = $listingObj->getString("level");
						$arr_invoice_listing["renewal_date"]  = $listingObj->getString("renewal_date");
						$arr_invoice_listing["categories"]    = ($category_amount) ? $category_amount : 0;
						$arr_invoice_listing["amount"]        = str_replace(",","",$info["total_fee"]);

						$arr_invoice_listing["extra_categories"] = 0;
						if (($category_amount > 0) && (($category_amount - $levelObj->getFreeCategory($listingObj->getString("level"))) > 0)) {
							$arr_invoice_listing["extra_categories"] = $category_amount - $levelObj->getFreeCategory($listingObj->getString("level"));
						} else {
							$arr_invoice_listing["extra_categories"] = 0;
						}

						$arr_invoice_listing["listingtemplate_title"] = "";
						if (LISTINGTEMPLATE_FEATURE == "on") {
							if ($listingObj->getString("listingtemplate_id")) {
								$listingTemplateObj = new ListingTemplate($listingObj->getString("listingtemplate_id"));
								$arr_invoice_listing["listingtemplate_title"] = $listingTemplateObj->getString("title", false);
							}
						}

						$invoiceListingObj = new InvoiceListing($arr_invoice_listing);
						$invoiceListingObj->Save();

						unset($listingObj);
						unset($invoiceListingObj);

					}

					if ($bill_info["events"]) foreach ($bill_info["events"] as $id => $info) {

						$eventObj = new Event($id);

						$arr_invoice_event["invoice_id"]   = $invoiceObj->getString("id");
						$arr_invoice_event["event_id"]     = $id;
						$arr_invoice_event["event_title"]  = $eventObj->getString("title",false);
						$arr_invoice_event["discount_id"]  = $eventObj->getString("discount_id");
						$arr_invoice_event["level"]        = $eventObj->getString("level");
						$arr_invoice_event["renewal_date"] = $eventObj->getString("renewal_date");
						$arr_invoice_event["amount"]       = str_replace(",","",$info["total_fee"]);

						$invoiceEventObj = new InvoiceEvent($arr_invoice_event);
						$invoiceEventObj->Save();

						unset($eventObj);
						unset($invoiceEventObj);

					}

					if ($bill_info["banners"]) foreach ($bill_info["banners"] as $id => $info) {

						$bannerObj = new Banner($id);

						$arr_invoice_banner["invoice_id"]     = $invoiceObj->getString("id");
						$arr_invoice_banner["banner_id"]      = $id;
						$arr_invoice_banner["banner_caption"] = $bannerObj->getString("caption",false);
						$arr_invoice_banner["discount_id"]    = $bannerObj->getString("discount_id");
						$arr_invoice_banner["level"]          = $bannerObj->getString("type");
						$arr_invoice_banner["renewal_date"]   = $bannerObj->getString("renewal_date");
						$arr_invoice_banner["impressions"]    = $bannerObj->getString("unpaid_impressions");
						$arr_invoice_banner["amount"]         = str_replace(",","",$info["total_fee"]);

						$invoiceBannerObj = new InvoiceBanner($arr_invoice_banner);
						$invoiceBannerObj->Save();

						unset($bannerObj);
						unset($invoiceBannerObj);

					}

					if ($bill_info["classifieds"]) foreach ($bill_info["classifieds"] as $id => $info) {

						$classifiedObj = new Classified($id);

						$arr_invoice_classified["invoice_id"]       = $invoiceObj->getString("id");
						$arr_invoice_classified["classified_id"]    = $id;
						$arr_invoice_classified["classified_title"] = $classifiedObj->getString("title",false);
						$arr_invoice_classified["discount_id"]      = $classifiedObj->getString("discount_id");
						$arr_invoice_classified["level"]            = $classifiedObj->getString("level");
						$arr_invoice_classified["renewal_date"]     = $classifiedObj->getString("renewal_date");
						$arr_invoice_classified["amount"]           = str_replace(",","",$info["total_fee"]);

						$invoiceClassifiedObj = new InvoiceClassified($arr_invoice_classified);
						$invoiceClassifiedObj->Save();

						unset($classifiedObj);
						unset($invoiceClassifiedObj);

					}

					if ($bill_info["articles"]) foreach ($bill_info["articles"] as $id => $info) {

						$articleObj = new Article($id);

						$arr_invoice_article["invoice_id"]    = $invoiceObj->getString("id");
						$arr_invoice_article["article_id"]    = $id;
						$arr_invoice_article["article_title"] = $articleObj->getString("title",false);
						$arr_invoice_article["discount_id"]   = $articleObj->getString("discount_id");
						$arr_invoice_article["level"]         = $articleObj->getString("level");
						$arr_invoice_article["renewal_date"]  = $articleObj->getString("renewal_date");
						$arr_invoice_article["amount"]        = str_replace(",","",$info["total_fee"]);

						$invoiceArticleObj = new InvoiceArticle($arr_invoice_article);
						$invoiceArticleObj->Save();

						unset($articleObj);
						unset($invoiceArticleObj);

					}

					if ($bill_info["custominvoices"]) foreach ($bill_info["custominvoices"] as $id => $info) {

						$customInvoiceObj = new CustomInvoice($id);

						$arr_invoice_custominvoice["invoice_id"]        = $invoiceObj->getString("id");
						$arr_invoice_custominvoice["custom_invoice_id"] = $id;
						$arr_invoice_custominvoice["title"]             = $customInvoiceObj->getString("title");
						$arr_invoice_custominvoice["date"]              = $customInvoiceObj->getString("date");
						$arr_invoice_custominvoice["items"]             = $customInvoiceObj->getTextItems();
						$arr_invoice_custominvoice["items_price"]       = $customInvoiceObj->getTextPrices();
						$arr_invoice_custominvoice["amount"]            = str_replace(",","",$info["amount"]);

						$invoiceCustomInvoiceObj = new InvoiceCustomInvoice($arr_invoice_custominvoice);
						$invoiceCustomInvoiceObj->Save();

						unset($customInvoiceObj);
						unset($invoiceCustomInvoiceObj);

					}

				}

			}

		}
		////////////////////////////////////////////////////////////////////////



	}

?>
