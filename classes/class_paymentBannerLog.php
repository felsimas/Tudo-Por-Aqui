<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classes/class_paymentBannerLog.php
	# ----------------------------------------------------------------------------------------------------

	class PaymentBannerLog extends Handle {

		var $payment_log_id;
		var $banner_id;
		var $banner_caption;
		var $discount_id;
		var $level;
		var $renewal_date;
		var $impressions;
		var $amount;

		function PaymentBannerLog($var="") {
			if (is_numeric($var) && ($var)) {
				$db = db_getDBObject();
				$sql = "SELECT * FROM Payment_Banner_Log WHERE payment_log_id = $var";
				$row = mysql_fetch_array($db->query($sql));
				$this->makeFromRow($row);
			} else {
				$this->makeFromRow($var);
			}
		}

		function makeFromRow($row="") {

			$this->payment_log_id	= ($row["payment_log_id"])	? $row["payment_log_id"]	: ($this->payment_log_id	? $this->payment_log_id	: 0);
			$this->banner_id		= ($row["banner_id"])		? $row["banner_id"]			: ($this->banner_id			? $this->banner_id		: 0);
			$this->banner_caption	= ($row["banner_caption"])	? $row["banner_caption"]	: ($this->banner_caption	? $this->banner_caption	: "");
			$this->discount_id		= ($row["discount_id"])		? $row["discount_id"]		: ($this->discount_id		? $this->discount_id	: "");
			$this->level			= ($row["level"])			? $row["level"]				: ($this->level				? $this->level			: 0);
			$this->renewal_date		= ($row["renewal_date"])	? $row["renewal_date"]		: ($this->renewal_date		? $this->renewal_date	: 0);
			$this->impressions		= ($row["impressions"])		? $row["impressions"]		: ($this->impressions		? $this->impressions	: 0);
			$this->amount			= ($row["amount"])			? $row["amount"]			: ($this->amount			? $this->amount			: 0);

		}

		function Save() {

			$this->PrepareToSave();

			$dbObj = db_getDBObject();

			$sql = "INSERT INTO Payment_Banner_Log"
				. " (payment_log_id,"
				. " banner_id,"
				. " banner_caption,"
				. " discount_id,"
				. " level,"
				. " renewal_date,"
				. " impressions,"
				. " amount"
				. " )"
				. " VALUES"
				. " ("
				. " $this->payment_log_id,"
				. " $this->banner_id,"
				. " $this->banner_caption,"
				. " $this->discount_id,"
				. " $this->level,"
				. " $this->renewal_date,"
				. " $this->impressions,"
				. " $this->amount"
				. " )";

			$dbObj->query($sql);

			$this->id = mysql_insert_id($dbObj->link_id);

			$this->PrepareToUse();

		}

	}

?>
