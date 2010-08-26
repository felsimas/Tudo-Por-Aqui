<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classes/class_paymentEventLog.php
	# ----------------------------------------------------------------------------------------------------

	class PaymentEventLog extends Handle {

		var $payment_log_id;
		var $event_id;
		var $event_title;
		var $discount_id;
		var $level;
		var $renewal_date;
		var $amount;

		function PaymentEventLog($var="") {
			if (is_numeric($var) && ($var)) {
				$db = db_getDBObject();
				$sql = "SELECT * FROM Payment_Event_Log WHERE payment_log_id = $var";
				$row = mysql_fetch_array($db->query($sql));
				$this->makeFromRow($row);
			} else {
				$this->makeFromRow($var);
			}
		}

		function makeFromRow($row="") {

			$this->payment_log_id	= ($row["payment_log_id"])	? $row["payment_log_id"]	: ($this->payment_log_id	? $this->payment_log_id	: 0);
			$this->event_id			= ($row["event_id"])		? $row["event_id"]			: ($this->event_id			? $this->event_id		: 0);
			$this->event_title		= ($row["event_title"])		? $row["event_title"]		: ($this->event_title		? $this->event_title	: "");
			$this->discount_id		= ($row["discount_id"])		? $row["discount_id"]		: ($this->discount_id		? $this->discount_id	: "");
			$this->level			= ($row["level"])			? $row["level"]				: ($this->level				? $this->level			: 0);
			$this->renewal_date		= ($row["renewal_date"])	? $row["renewal_date"]		: ($this->renewal_date		? $this->renewal_date	: 0);
			$this->amount			= ($row["amount"])			? $row["amount"]			: ($this->amount			? $this->amount			: 0);

		}

		function Save() {

			$this->PrepareToSave();

			$dbObj = db_getDBObject();

			$sql = "INSERT INTO Payment_Event_Log"
				. " (payment_log_id,"
				. " event_id,"
				. " event_title,"
				. " discount_id,"
				. " level,"
				. " renewal_date,"
				. " amount"
				. " )"
				. " VALUES"
				. " ("
				. " $this->payment_log_id,"
				. " $this->event_id,"
				. " $this->event_title,"
				. " $this->discount_id,"
				. " $this->level,"
				. " $this->renewal_date,"
				. " $this->amount"
				. " )";

			$dbObj->query($sql);

			$this->id = mysql_insert_id($dbObj->link_id);

			$this->PrepareToUse();

		}

	}

?>
