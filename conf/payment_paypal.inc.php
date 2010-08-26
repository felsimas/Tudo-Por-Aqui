<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /conf/payment_paypal.inc.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# PAYPAL CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	if (PAYPALPAYMENT_FEATURE == "on") {
		if (REALTRANSACTION == "on") {
			$paypal_account = "";
			$dbObjPayment = db_getDBObject();
			$sql = "SELECT * FROM Setting_Payment WHERE name LIKE 'PAYPAL_%'";
			$result = $dbObjPayment->query($sql);
			while ($row = mysql_fetch_assoc($result)) {
				if ($row["name"] == "PAYPAL_ACCOUNT") $paypal_account = crypt_decrypt($row["value"]);
			}
			unset($dbObjPayment);
			define(PAYPAL_ACCOUNT, $paypal_account);
			define(PAYPAL_URL, "www.paypal.com");
		} else {
			define(PAYPAL_ACCOUNT, "test@demodirectory.com");
			define(PAYPAL_URL, "www.sandbox.paypal.com");
		}
		define(PAYPAL_URL_FOLDER, "/cgi-bin/webscr");
		define(PAYPAL_LC, "US");
		define(PAYPAL_CURRENCY, PAYMENT_CURRENCY);
		if (PAYPALRECURRING_FEATURE == "on") {
			// these lines below must match to all *_RENEWAL_PERIOD constants
			// all *_RENEWAL_PERIOD must be PAYPAL_RECURRINGCYCLE plus PAYPAL_RECURRINGUNIT
			define(PAYPAL_RECURRINGCYCLE, "");
			define(PAYPAL_RECURRINGUNIT, "");
			// 0 (zero) means unlimited
			define(PAYPAL_RECURRINGTIMES, "");
		}
	}

?>
