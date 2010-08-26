<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classes/class_invoice.php
	# ----------------------------------------------------------------------------------------------------

	class Invoice extends Handle {

		var $id;
		var $account_id;
		var $username;
		var $ip;
		var $date;
		var $status;
		var $amount;
		var $currency;
		var $expire_date;
		var $payment_date;

		function Invoice($var="") {

			if (is_numeric($var) && ($var)) {
				$db = db_getDBObject();
				$sql = "SELECT * FROM Invoice WHERE id = $var";
				$row = mysql_fetch_array($db->query($sql));
				$this->makeFromRow($row);
			} else {
				$this->makeFromRow($var);
			}

		}

		function makeFromRow($row="") {

			$invoiceStatusObj = new InvoiceStatus();

			$this->id			= ($row["id"])				? $row["id"]			: ($this->id			? $this->id				: 0);
			$this->account_id	= ($row["account_id"])		? $row["account_id"]	: ($this->account_id	? $this->account_id		: 0);
			$this->username		= ($row["username"])		? $row["username"]		: ($this->username		? $this->username		: "");
			$this->ip			= ($row["ip"])				? $row["ip"]			: ($this->ip			? $this->ip				: "");
			$this->date			= ($row["date"])			? $row["date"]			: ($this->date			? $this->date			: "");
			$this->status		= ($row["status"])			? $row["status"]		: ($this->status		? $this->status			: $invoiceStatusObj->getDefaultStatus());
			$this->amount		= ($row["amount"])			? $row["amount"]		: ($this->amount		? $this->amount			: 0);
			$this->currency		= ($row["currency"])		? $row["currency"]		: ($this->currency		? $this->currency		: "");
			$this->expire_date	= ($row["expire_date"])		? $row["expire_date"]	: ($this->expire_date	? $this->expire_date	: "");
			$this->payment_date	= ($row["payment_date"])	? $row["payment_date"]	: ($this->payment_date	? $this->payment_date	: 0);

		}

		function Save() {

			$this->PrepareToSave();

			$dbObj = db_getDBObject();

			if ($this->id) {

				$sql  = "UPDATE Invoice SET"
					. " account_id = $this->account_id,"
					. " username = $this->username,"
					. " ip = $this->ip,"
					. " date = $this->date,"
					. " status = $this->status,"
					. " amount = $this->amount,"
					. " currency = $this->currency,"
					. " expire_date = $this->expire_date,"
					. " payment_date = $this->payment_date"
					. " WHERE id = $this->id";
				
					$dbObj->query($sql);

			} else {

				$sql = "INSERT INTO Invoice"
					. " (account_id,"
					. " username,"
					. " ip,"
					. " date,"
					. " status,"
					. " amount,"
					. " currency,"
					. " expire_date,"
					. " payment_date"
					. " )"
					. " VALUES"
					. " ("
					. " $this->account_id,"
					. " $this->username,"
					. " $this->ip,"
					. " $this->date,"
					. " $this->status,"
					. " $this->amount,"
					. " $this->currency,"
					. " $this->expire_date,"
					. " $this->payment_date"
					. " )";

				$dbObj->query($sql);

				$this->id = mysql_insert_id($dbObj->link_id);

			}

			$this->PrepareToUse();

		}

	}

?>
