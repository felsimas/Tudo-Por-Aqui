<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classes/class_paymentLog.php
	# ----------------------------------------------------------------------------------------------------

	class PaymentLog extends Handle {

		var $id;
		var $account_id;
		var $username;
		var $ip;
		var $transaction_id;
		var $transaction_status;
		var $transaction_datetime;
		var $transaction_amount;
		var $transaction_currency;
		var $system_type;
		var $recurring;
		var $notes;
		var $return_fields;

		function PaymentLog($var="") {
			if (is_numeric($var) && ($var)) {
				$db = db_getDBObject();
				$sql = "SELECT * FROM Payment_Log WHERE id = $var";
				$row = mysql_fetch_array($db->query($sql));
				$this->makeFromRow($row);
			} else {
				$this->makeFromRow($var);
			}
		}

		function makeFromRow($row="") {

			$this->id					= ($row["id"])						? $row["id"]					: ($this->id					? $this->id						: 0);
			$this->account_id			= ($row["account_id"])				? $row["account_id"]			: ($this->account_id			? $this->account_id				: 0);
			$this->username				= ($row["username"])				? $row["username"]				: ($this->username				? $this->username				: "");
			$this->ip					= ($row["ip"])						? $row["ip"]					: ($this->ip					? $this->ip						: "");
			$this->transaction_id		= ($row["transaction_id"])			? $row["transaction_id"]		: ($this->transaction_id		? $this->transaction_id			: "");
			$this->transaction_status	= ($row["transaction_status"])		? $row["transaction_status"]	: ($this->transaction_status	? $this->transaction_status		: "");
			$this->transaction_datetime	= ($row["transaction_datetime"])	? $row["transaction_datetime"]	: ($this->transaction_datetime	? $this->transaction_datetime	: "");
			$this->transaction_amount	= ($row["transaction_amount"])		? $row["transaction_amount"]	: ($this->transaction_amount	? $this->transaction_amount		: 0);
			$this->transaction_currency	= ($row["transaction_currency"])	? $row["transaction_currency"]	: ($this->transaction_currency	? $this->transaction_currency	: "");
			$this->system_type			= ($row["system_type"])				? $row["system_type"]			: ($this->system_type			? $this->system_type			: "");
			$this->recurring			= ($row["recurring"])				? $row["recurring"]				: ($this->recurring				? $this->recurring				: "");
			$this->notes				= ($row["notes"])					? $row["notes"]					: ($this->notes					? $this->notes					: "");
			$this->return_fields		= ($row["return_fields"])			? $row["return_fields"]			: ($this->return_fields			? $this->return_fields			: "");

		}

		function Save() {

			$this->PrepareToSave();

			$dbObj = db_getDBObject();

			if ($this->id) {

				$sql = "UPDATE Payment_Log SET"
					. " account_id           = $this->account_id,"
					. " username             = $this->username,"
					. " ip                   = $this->ip,"
					. " transaction_id       = $this->transaction_id,"
					. " transaction_status   = $this->transaction_status,"
					. " transaction_datetime = $this->transaction_datetime,"
					. " transaction_amount   = $this->transaction_amount,"
					. " transaction_currency = $this->transaction_currency,"
					. " system_type          = $this->system_type,"
					. " recurring            = $this->recurring,"
					. " notes                = $this->notes,"
					. " return_fields        = $this->return_fields"
					. " WHERE id = $this->id";

				$dbObj->query($sql);

			} else {

				$sql = "INSERT INTO Payment_Log"
					. " ("
					. " account_id,"
					. " username,"
					. " ip,"
					. " transaction_id,"
					. " transaction_status,"
					. " transaction_datetime,"
					. " transaction_amount,"
					. " transaction_currency,"
					. " system_type,"
					. " recurring,"
					. " notes,"
					. " return_fields"
					. " )"
					. " VALUES"
					. " ("
					. " $this->account_id,"
					. " $this->username,"
					. " $this->ip,"
					. " $this->transaction_id,"
					. " $this->transaction_status,"
					. " $this->transaction_datetime,"
					. " $this->transaction_amount,"
					. " $this->transaction_currency,"
					. " $this->system_type,"
					. " $this->recurring,"
					. " $this->notes,"
					. " $this->return_fields"
					. " )";

				$dbObj->query($sql);

				$this->id = mysql_insert_id($dbObj->link_id);

			}

			$this->PrepareToUse();

		}

		function sendNotification() {

			$db = db_getDBObject();

			$header_sitemgr_msg = "
				<html>
					<head>
						<style>
							.BODY,DIV,TABLE,TD {
								font-size: 11px;
								font-family: Verdana, Arial, Sans-Serif;
								color: #000;
							}
							.TABLE,TD {
								border: 1px #2967A3 solid;
							}
						</style>
					</head>\n
					<body>
						<div>
							Site Manager,
							<br />\n<br />\n
							A transaction was made and needs to be revised by you.
							<br />\n<br />\n
				";

			$body_sitemgr_msg .= "";
			$body_sitemgr_msg .= "
							<b style=\"color:#2967A3\">Transaction Info :</b>
							<br />\n<br />\n
							<b>Status:</b> <b style=\"color:#003365\">".$this->transaction_status."</b>
							<br />\n
							<b>Account:</b> ".system_showAccountUserName($this->username)."
							<br />\n
							<b>Transaction ID:</b> ".$this->transaction_id."
							<br />\n
							<b>Transaction Time:</b> ".format_date($this->transaction_datetime, DEFAULT_DATE_FORMAT." H:i:s", "datetime")."
							<br />\n
							<b>IP:</b> ".$this->ip."
							<br />\n
							<b>Amount:</b> ".$this->transaction_amount." (".$this->transaction_currency.")
							<br />\n
							<b>Gateway:</b> ".$this->system_type."
				";
			if ($this->recurring == "y") {
				$body_sitemgr_msg .= "
							<em>(prices amount are per installments)</em>
					";
			}
			$body_sitemgr_msg .= "
							<br />\n
				";

			$sql ="SELECT * FROM Payment_Listing_Log WHERE payment_log_id = ".$this->id."";
			$r = $db->query($sql);
			while ($row = mysql_fetch_assoc($r)) $listings[] = $row;

			if (!empty($listings[0])) {

				$body_sitemgr_msg .= "
							<br />\n
							<b style=\"color:#2967A3\">".ucwords(LISTING_FEATURE_NAME)."(s) Info:</b>
							<br />\n<br />\n
							<table cellpadding=\"2\" cellspacing=\"2\" border=\"0\">
								<tr>
									<td><b>Title</b></td>
									<td><b>Extra Category</b></td>
									<td><b>Level</b></td>
									<td><b>".ucwords(LANG_LABEL_DISCOUNTCODE)."</b></td>
									<td><b>Renewal Date</b></td>
									<td><b>Amount (".$this->transaction_currency.")</b></td>
								</tr>\n
					";

				$listingLevelObj = new ListingLevel();

				foreach ($listings as $each_listing) {

					$body_sitemgr_msg .= "
								<tr>
									<td>".$each_listing["listing_title"]."".($each_listing["listingtemplate_title"]?"<br>(".$each_listing["listingtemplate_title"].")":"")."</td>
									<td>".$each_listing["extra_categories"]."</td>
									<td>".ucwords($listingLevelObj->getLevel($each_listing["level"]))."</td>
									<td>".(($each_listing["discount_id"]) ? $each_listing["discount_id"] : system_showText(LANG_NA))."</td>
									<td>".(format_date($each_listing["renewal_date"], DEFAULT_DATE_FORMAT, "date"))."</td>
									<td>".$each_listing["amount"]."</td>
								</tr>\n
						";

					$sitemgr_link[] = "<a href=\"".DEFAULT_URL."/gerenciamento/estabelecimentos/view.php?id=".$each_listing["listing_id"]."\" target=\"_blank\">".ucwords(LISTING_FEATURE_NAME).": ".$each_listing["listing_title"]."</a><br />\n";

				}

				$body_sitemgr_msg .= "
							</table>
					";

			}

			$sql ="SELECT * FROM Payment_Event_Log WHERE payment_log_id = ".$this->id."";
			$r = $db->query($sql);
			while ($row = mysql_fetch_assoc($r)) $events[] = $row;

			if (!empty($events[0])) {

				$body_sitemgr_msg .= "
							<br />\n
							<b style=\"color:#2967A3\">".ucwords(EVENT_FEATURE_NAME)."(s) Info:</b>
							<br />\n<br />\n
							<table cellpadding=\"2\" cellspacing=\"2\" border=\"0\">
								<tr>
									<td><b>Title</b></td>
									<td><b>Level</b></td>
									<td><b>".ucwords(LANG_LABEL_DISCOUNTCODE)."</b></td>
									<td><b>Renewal Date</b></td>
									<td><b>Amount (".$this->transaction_currency.")</b></td>
								</tr>\n
					";

				$eventLevelObj = new EventLevel();

				foreach ($events as $each_event) {

					$body_sitemgr_msg .= "
								<tr>
									<td>".$each_event["event_title"]."</td>
									<td>".ucwords($eventLevelObj->getLevel($each_event["level"]))."</td>
									<td>".(($each_event["discount_id"]) ? $each_event["discount_id"] : system_showText(LANG_NA))."</td>
									<td>".(format_date($each_event["renewal_date"], DEFAULT_DATE_FORMAT, "date"))."</td>
									<td>".$each_event["amount"]."</td>
								</tr>\n
						";

					$sitemgr_link[] = "<a href=\"".DEFAULT_URL."/gerenciamento/event/view.php?id=".$each_event["event_id"]."\" target=\"_blank\">".ucwords(EVENT_FEATURE_NAME).": ".$each_event["event_title"]."</a><br />\n";

				}

				$body_sitemgr_msg .= "
							</table>
					";

			}

			$sql ="SELECT * FROM Payment_Banner_Log WHERE payment_log_id = ".$this->id."";
			$r = $db->query($sql);
			while ($row = mysql_fetch_assoc($r)) $banners[] = $row;

			if (!empty($banners[0])) {

				$body_sitemgr_msg .= "
							<br />\n
							<b style=\"color:#2967A3\">".ucwords(BANNER_FEATURE_NAME)."(s) Info:</b>
							<br />\n<br />\n
							<table cellpadding=\"2\" cellspacing=\"2\" border=\"0\">
								<tr>
									<td><b>Caption</b></td>
									<td><b>Impressions</b></td>
									<td><b>Level</b></td>
									<td><b>".ucwords(LANG_LABEL_DISCOUNTCODE)."</b></td>
									<td><b>Renewal Date</b></td>
									<td><b>Amount (".$this->transaction_currency.")</b></td>
								</tr>\n
					";

				$bannerLevelObj = new BannerLevel();

				foreach ($banners as $each_banner) {

					$body_sitemgr_msg .= "
								<tr>
									<td>".$each_banner["banner_caption"]."</td>
									<td>".(($each_banner["impressions"]) ? ($each_banner["impressions"]) : ("Unlimited"))."</td>
									<td>".ucwords($bannerLevelObj->getLevel($each_banner["level"]))."</td>
									<td>".(($each_banner["discount_id"]) ? $each_banner["discount_id"] : system_showText(LANG_NA))."</td>
									<td>".(($each_banner["renewal_date"] != "0000-00-00") ? format_date($each_banner["renewal_date"], DEFAULT_DATE_FORMAT, "date") : "Unlimited")."</td>
									<td>".$each_banner["amount"]."</td>
								</tr>\n
						";

					$sitemgr_link[] = "<a href=\"".DEFAULT_URL."/gerenciamento/banner/view.php?id=".$each_banner["banner_id"]."\" target=\"_blank\">".ucwords(BANNER_FEATURE_NAME).": ".$each_banner["banner_caption"]."</a><br />\n";

				}

				$body_sitemgr_msg .= "
							</table>
					";

			}

			$sql ="SELECT * FROM Payment_Classified_Log WHERE payment_log_id = ".$this->id."";
			$r = $db->query($sql);
			while ($row = mysql_fetch_assoc($r)) $classifieds[] = $row;

			if (!empty($classifieds[0])) {

				$body_sitemgr_msg .= "
							<br />\n
							<b style=\"color:#2967A3\">".ucwords(CLASSIFIED_FEATURE_NAME)."(s) Info:</b>
							<br />\n<br />\n
							<table cellpadding=\"2\" cellspacing=\"2\" border=\"0\">
								<tr>
									<td><b>Title</b></td>
									<td><b>Level</b></td>
									<td><b>".ucwords(LANG_LABEL_DISCOUNTCODE)."</b></td>
									<td><b>Renewal Date</b></td>
									<td><b>Amount (".$this->transaction_currency.")</b></td>
								</tr>\n
					";

				$classifiedLevelObj = new ClassifiedLevel();

				foreach ($classifieds as $each_classified) {

					$body_sitemgr_msg .= "
								<tr>
									<td>".$each_classified["classified_title"]."</td>
									<td>".ucwords($classifiedLevelObj->getLevel($each_classified["level"]))."</td>
									<td>".(($each_classified["discount_id"]) ? $each_classified["discount_id"] : system_showText(LANG_NA))."</td>
									<td>".(format_date($each_classified["renewal_date"], DEFAULT_DATE_FORMAT, "datetime"))."</td>
									<td>".$each_classified["amount"]."</td>
								</tr>\n
						";

					$sitemgr_link[] = "<a href=\"".DEFAULT_URL."/gerenciamento/classified/view.php?id=".$each_classified["classified_id"]."\" target=\"_blank\">".ucwords(CLASSIFIED_FEATURE_NAME).": ".$each_classified["classified_title"]."</a><br />\n";

				}

				$body_sitemgr_msg .= "
							</table>
					";

			}

			$sql ="SELECT * FROM Payment_Article_Log WHERE payment_log_id = ".$this->id."";
			$r = $db->query($sql);
			while ($row = mysql_fetch_assoc($r)) $articles[] = $row;

			if (!empty($articles[0])) {

				$body_sitemgr_msg .= "
							<br />\n
							<b style=\"color:#2967A3\">".ucwords(ARTICLE_FEATURE_NAME)."(s) Info:</b>
							<br />\n<br />\n
							<table cellpadding=\"2\" cellspacing=\"2\" border=\"0\">
								<tr>
									<td><b>Title</b></td>
									<td><b>Level</b></td>
									<td><b>".ucwords(DISCOUNTCODE_LABEL)."</b></td>
									<td><b>Renewal Date</b></td>
									<td><b>Amount (".$this->transaction_currency.")</b></td>
								</tr>\n
					";

				$articleLevelObj = new ArticleLevel();

				foreach ($articles as $each_article) {

					$body_sitemgr_msg .= "
								<tr>
									<td>".$each_article["article_title"]."</td>
									<td>".ucwords($articleLevelObj->getLevel($each_article["level"]))."</td>
									<td>".(($each_article["discount_id"]) ? $each_article["discount_id"] : system_showText(LANG_NA))."</td>
									<td>".(format_date($each_article["renewal_date"], DEFAULT_DATE_FORMAT, "date"))."</td>
									<td>".$each_article["amount"]."</td>
								</tr>\n
						";

					$sitemgr_link[] = "<a href=\"".DEFAULT_URL."/gerenciamento/article/view.php?id=".$each_article["article_id"]."\" target=\"_blank\">".ucwords(ARTICLE_FEATURE_NAME).": ".$each_article["article_title"]."</a><br />\n";

				}

				$body_sitemgr_msg .= "
							</table>
					";

			}

			$sql ="SELECT * FROM Payment_CustomInvoice_Log WHERE payment_log_id = ".$this->id."";
			$r = $db->query($sql);
			while ($row = mysql_fetch_assoc($r)) $custominvoices[] = $row;

			if (!empty($custominvoices[0])) {

				$body_sitemgr_msg .= "
							<br />\n
							<b style=\"color:#2967A3\">Custom Invoice(s) Info:</b>
							<br />\n<br />\n
							<table cellpadding=\"2\" cellspacing=\"2\" border=\"0\">
								<tr>
									<td><b>Title</b></td>
									<td><b>Items</b></td>
									<td><b>Date</b></td>
									<td><b>Amount (".$this->transaction_currency.")</b></td>
								</tr>\n
					";

				foreach ($custominvoices as $each_custominvoice) {

					$custom_invoice_items = explode("\n", $each_custominvoice["items"]);
					$custom_invoice_prices = explode("\n", $each_custominvoice["items_price"]);
					if ($custom_invoice_items) {
						for ($i=0; $i<count($custom_invoice_items); $i++) {
							$custom_invoice_desc[] = $custom_invoice_items[$i]." - ".$custom_invoice_prices[$i];
						}
					}
					$customInvoiceItems = ($custom_invoice_desc) ? implode("<br />\n", $custom_invoice_desc) : "";

					$body_sitemgr_msg .= "
								<tr>
									<td>".$each_custominvoice["title"]."</td>
									<td>".$customInvoiceItems."</td>
									<td>".format_date($each_custominvoice["date"])."</td>
									<td>".$each_custominvoice["amount"]."</td>
								</tr>\n
						";

					unset($custom_invoice_items, $custom_invoice_prices, $custom_invoice_desc, $customInvoiceItems);

					$sitemgr_link[] = "<a href=\"".DEFAULT_URL."/gerenciamento/custominvoices/view.php?id=".$each_custominvoice["custom_invoice_id"]."\" target=\"_blank\">Custom Invoice: ".$each_custominvoice["title"]."</a><br />\n";

				}

				$body_sitemgr_msg .= "
							</table>
					";

			}

			$footer_sitemgr_msg = "
							<br />\n<br />\n
							Please login to the directory at the links below to revise and/or activate these items.
							<br />\n
				";

			if ($sitemgr_link) foreach ($sitemgr_link as $sitemgrLink) $footer_sitemgr_msg .= $sitemgrLink."\n";

			$footer_sitemgr_msg .= "
							<br />\n<br />\n
							".EDIRECTORY_TITLE."
						</div>
					</body>
				</html>
				";

			$sitemgr_msg = $header_sitemgr_msg.$body_sitemgr_msg.$footer_sitemgr_msg;

			setting_get("sitemgr_send_email",$sitemgr_send_email);
			setting_get("sitemgr_email",$sitemgr_email);
			$sitemgr_emails = split(",",$sitemgr_email);
			setting_get("sitemgr_payment_email",$sitemgr_payment_email);
			$sitemgr_payment_emails = split(",",$sitemgr_payment_email);

			$error = false;
			if($sitemgr_send_email == "on") {
				if ($sitemgr_emails[0]) {
					foreach ($sitemgr_emails as $sitemgr_email) {
						system_mail($sitemgr_email, "[".EDIRECTORY_TITLE."] Transaction Notification - ".$this->transaction_id."", $sitemgr_msg, EDIRECTORY_TITLE." <".$sitemgr_email.">", "text/html", '', '', $error);
					}
				}
			}
			if ($sitemgr_payment_emails[0]) {
				foreach ($sitemgr_payment_emails as $sitemgr_payment_email) {
					system_mail($sitemgr_payment_email, "[".EDIRECTORY_TITLE."] Transaction Notification - ".$this->transaction_id."", $sitemgr_msg, EDIRECTORY_TITLE." <".$sitemgr_payment_email.">", "text/html", '', '', $error);
				}
			}

		}

	}

?>
