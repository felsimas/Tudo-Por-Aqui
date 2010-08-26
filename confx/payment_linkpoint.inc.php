<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /conf/payment_linkpoint.inc.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LINKPOINT CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	if (LINKPOINTPAYMENT_FEATURE == "on") {
		if (REALTRANSACTION == "on") {
			$linkpoint_configfile = "";
			$linkpoint_keyfile = "";
			$dbObjPayment = db_getDBObject();
			$sql = "SELECT * FROM Setting_Payment WHERE name LIKE 'LINKPOINT_%'";
			$result = $dbObjPayment->query($sql);
			while ($row = mysql_fetch_assoc($result)) {
				if ($row["name"] == "LINKPOINT_CONFIGFILE") $linkpoint_configfile = crypt_decrypt($row["value"]);
				if ($row["name"] == "LINKPOINT_KEYFILE") $linkpoint_keyfile = crypt_decrypt($row["value"]);
			}
			unset($dbObjPayment);
			define(LINKPOINT_CONFIGFILE, $linkpoint_configfile);
			define(LINKPOINT_KEYFILE, $linkpoint_keyfile);
			define(LINKPOINT_HOST, "secure.linkpt.net");
		} else {
			define(LINKPOINT_CONFIGFILE, "1909740134");
			define(LINKPOINT_KEYFILE, "1909740134.pem");
			define(LINKPOINT_HOST, "staging.linkpt.net");
		}
		define(LINKPOINT_PORT, "1129");
		define(LINKPOINT_CURRENCY, PAYMENT_CURRENCY);
		if (LINKPOINTRECURRING_FEATURE == "on") {
			// LINKPOINT_RECURRINGTYPE
			// empty means without recurring
			// m (month) means monthly recurring
			// y (year) means yearly recurring
			// this line below must match to all *_RENEWAL_PERIOD constants
			// if LINKPOINT_RECURRINGTYPE is m, all *_RENEWAL_PERIOD must be 1M
			// if LINKPOINT_RECURRINGTYPE is y, all *_RENEWAL_PERIOD must be 1Y
			define(LINKPOINT_RECURRINGTYPE, "");
		}
	}

?>
