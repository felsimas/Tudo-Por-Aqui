<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classes/class_invoiceCustomInvoice.php
	# ----------------------------------------------------------------------------------------------------

	class InvoiceCustomInvoice extends Handle {

		var $invoice_id;
		var $custom_invoice_id;
		var $title;
		var $date;
		var $items;
		var $items_price;
		var $amount;

		function InvoiceCustomInvoice($var="") {
			if (is_array($var) && ($var)) $this->makeFromRow($var);
		}

		function makeFromRow($row="") {
			$this->invoice_id			= ($row["invoice_id"])			? $row["invoice_id"]		: ($this->invoice_id		? $this->invoice_id			: 0);
			$this->custom_invoice_id	= ($row["custom_invoice_id"])	? $row["custom_invoice_id"]	: ($this->custom_invoice_id	? $this->custom_invoice_id	: 0);
			$this->title				= ($row["title"])				? $row["title"]				: ($this->title				? $this->title				: 0);
			$this->date					= ($row["date"])				? $row["date"]				: ($this->date				? $this->date				: 0);
			$this->items				= ($row["items"])				? $row["items"]				: ($this->items				? $this->items				: 0);
			$this->items_price			= ($row["items_price"])			? $row["items_price"]		: ($this->items_price		? $this->items_price		: 0);
			$this->amount				= ($row["amount"])				? $row["amount"]			: ($this->amount			? $this->amount				: 0);
		}

		function Save() {

			$this->PrepareToSave();

			$dbObj = db_getDBObject();

			$sql = "INSERT INTO Invoice_CustomInvoice"
				. " (invoice_id,"
				. " custom_invoice_id,"
				. " title,"
				. " date,"
				. " items,"
				. " items_price,"
				. " amount"
				. " )"
				. " VALUES"
				. " ("
				. " $this->invoice_id,"
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
