<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /conf/payment_psigate.inc.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# PSIGATE CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	if (PSIGATEPAYMENT_FEATURE == "on") {
		if (REALTRANSACTION == "on") {
			$psigate_storeid = "";
			$psigate_passphrase = "";
			$dbObjPayment = db_getDBObject();
			$sql = "SELECT * FROM Setting_Payment WHERE name LIKE 'PSIGATE_%'";
			$result = $dbObjPayment->query($sql);
			while ($row = mysql_fetch_assoc($result)) {
				if ($row["name"] == "PSIGATE_STOREID") $psigate_storeid = crypt_decrypt($row["value"]);
				if ($row["name"] == "PSIGATE_PASSPHRASE") $psigate_passphrase = crypt_decrypt($row["value"]);
			}
			unset($dbObjPayment);
			define(PSIGATE_STOREID, $psigate_storeid);
			define(PSIGATE_PASSPHRASE, $psigate_passphrase);
			define(PSIGATE_URL, "https://secure.psigate.com:7934/Messenger/XMLMessenger");
		} else {
			define(PSIGATE_STOREID, "teststore");
			define(PSIGATE_PASSPHRASE, "psigate1234");
			define(PSIGATE_URL, "https://dev.psigate.com:7989/Messenger/XMLMessenger");
		}
		define(PSIGATE_CURRENCY, PAYMENT_CURRENCY);
	}

?>
