<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classes/class_paymentCustomInvoiceLog.php
	# ----------------------------------------------------------------------------------------------------

	class PaymentCustomInvoiceLog extends Handle {

		var $payment_log_id;
		var $custom_invoice_id;
		var $title;
		var $date;
		var $items;
		var $items_price;
		var $amount;

		function PaymentCustomInvoiceLog($var="") {
			if (is_numeric($var) && ($var)) {
				$db = db_getDBObject();
				$sql = "SELECT * FROM Payment_CustomInvoice_Log WHERE payment_log_id = $var";
				$row = mysql_fetch_array($db->query($sql));
				$this->makeFromRow($row);
			} else {
				$this->makeFromRow($var);
			}
		}

		function makeFromRow($row="") {

			$this->payment_log_id		= ($row["payment_log_id"])		? $row["payment_log_id"]	: ($this->payment_log_id	? $this->payment_log_id		: 0);
			$this->custom_invoice_id	= ($row["custom_invoice_id"])	? $row["custom_invoice_id"]	: ($this->custom_invoice_id	? $this->custom_invoice_id	: 0);
			$this->title				= ($row["title"])				? $row["title"]				: ($this->title				? $this->title				: "");
			$this->date					= ($row["date"])				? $row["date"]				: ($this->date				? $this->date				: 0);
			$this->items				= ($row["items"])				? $row["items"]				: ($this->items				? $this->items				: "");
			$this->items_price			= ($row["items_price"])			? $row["items_price"]		: ($this->items_price		? $this->items_price		: "");
			$this->amount				= ($row["amount"])				? $row["amount"]			: ($this->amount			? $this->amount				: 0);

		}

		function Save() {

			$this->PrepareToSave();

			$dbObj = db_getDBObject();

			$sql = "INSERT INTO Payment_CustomInvoice_Log"
				. " (payment_log_id,"
				. " custom_invoice_id,"
				. " title,"
				. " date,"
				. " items,"
				. " items_price,"
				. " amount"
				. " )"
				. " VALUES"
				. " ("
				. " $this->payment_log_id,"
				. " $this->custom_invoice_id,"
				. " $this->title,"
				. " $this->date,"
				. " $this->items,"
				. " $this->items_price,"
				. " $this->amount"
				. " )";

			$dbObj->query($sql);

			$this->id = mysql_insert_id($dbObj->link_id);

			$this->PrepareToUse();

		}

	}

?>
