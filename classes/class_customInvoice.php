<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classes/class_customInvoice.php
	# ----------------------------------------------------------------------------------------------------

	class CustomInvoice extends Handle {

		var $id;
		var $account_id;
		var $title;
		var $date;
		var $sent_date;
		var $amount;
		var $paid;
		var $sent;
		var $completed;

		function CustomInvoice($var="") {

			if (is_numeric($var) && ($var)) {
				$db = db_getDBObject();
				$sql = "SELECT * FROM CustomInvoice WHERE id = $var";
				$row = mysql_fetch_array($db->query($sql));
				$this->makeFromRow($row);
			} else {
				$this->makeFromRow($var);
			}

		}

		function makeFromRow($row="") {

			$this->id			= ($row["id"])			? $row["id"]			: ($this->id			? $this->id			: 0);
			$this->account_id	= ($row["account_id"])	? $row["account_id"]	: ($this->account_id	? $this->account_id	: 0);
			$this->title		= ($row["title"])		? $row["title"]			: ($this->title			? $this->title		: 0);
			$this->date			= ($row["date"])		? $row["date"]			: ($this->date			? $this->date		: "");
			$this->sent_date	= ($row["sent_date"])	? $row["sent_date"]		: ($this->sent_date		? $this->sent_date	: "");
			$this->amount		= ($row["amount"])		? $row["amount"]		: ($this->amount		? $this->amount		: 0);
			$this->paid			= ($row["paid"])		? $row["paid"]			: ($this->paid			? $this-paid		: "");
			$this->sent			= ($row["sent"])		? $row["sent"]			: ($this->sent			? $this->sent		: "");
			$this->completed	= ($row["completed"])	? $row["completed"]		: ($this->completed		? $this->completed	: "y");

		}

		function Save() {

			$this->PrepareToSave();

			$dbObj = db_getDBObject();

			if ($this->id) {

				$sql  = "UPDATE CustomInvoice SET"
					. " account_id = $this->account_id,"
					. " title = $this->title,"
					. " date = NOW(),"
					. " sent_date = $this->sent_date,"
					. " amount = $this->amount,"
					. " paid = $this->paid,"
					. " sent = $this->sent,"
					. " completed = $this->completed"
					. " WHERE id = $this->id";
				$dbObj->query($sql);

			} else {

				$sql = "INSERT INTO CustomInvoice"
					. " (account_id,"
					. " title,"
					. " date,"
					. " sent_date,"
					. " amount,"
					. " paid,"
					. " sent,"
					. " completed"
					. " )"
					. " VALUES"
					. " ("
					. " $this->account_id,"
					. " $this->title,"
					. " NOW(),"
					. " $this->sent_date,"
					. " $this->amount,"
					. " $this->paid,"
					. " $this->sent,"
					. " $this->completed"
					. " )";
				$dbObj->query($sql);
				$this->id = mysql_insert_id($dbObj->link_id);

			}

			$this->PrepareToUse();

		}

		function setItems($items_desc, $items_price) {
			$dbObj = db_getDBObject();
			$sql = "DELETE FROM CustomInvoice_Items WHERE custominvoice_id = $this->id";
			$dbObj->query($sql);
			if ($items_desc && (count($items_desc) == count($items_price)) && $this->id) {
				foreach ($items_desc as $key => $each_item_desc) {
					if ($each_item_desc) {
						$sql = "INSERT INTO CustomInvoice_Items (custominvoice_id, description, price) VALUES ($this->id, ".db_formatString($each_item_desc).", ".db_formatString($items_price[$key]).")";
						$result = $dbObj->query($sql);
					}
				}
			} else {
				return false;
			}
		}

		function getItems() {
			if ($this->id) {
				$dbObj = db_getDBObject();
				$sql = "SELECT * FROM CustomInvoice_Items WHERE custominvoice_id='".$this->id."' ORDER BY id";
				$result = $dbObj->query($sql);
				while($row = mysql_fetch_assoc($result)) $data[] = $row;
				if ($data) return $data;
				else return false;
			}
		}

		function getTextItems() {

			if ($this->id) {

				$dbObj = db_getDBObject();
				$sql = "SELECT * FROM CustomInvoice_Items WHERE custominvoice_id='".$this->id."' ORDER BY id";
				$result = $dbObj->query($sql);
				while($row = mysql_fetch_assoc($result)) $data[] = $row;

				if ($data) {
					foreach ($data as $each_item) {
						$textItems[] = $each_item["description"];
					}
				}

				if ($textItems) $return_items = implode("\n", $textItems);
				return $return_items;

			}

		}

		function getTextPrices() {

			if ($this->id) {

				$dbObj = db_getDBObject();
				$sql = "SELECT * FROM CustomInvoice_Items WHERE custominvoice_id='".$this->id."' ORDER BY id";
				$result = $dbObj->query($sql);
				while($row = mysql_fetch_assoc($result)) $data[] = $row;

				if ($data) {
					foreach ($data as $each_item) {
						$textPrices[] = $each_item["price"];
					}
				}

				if ($textPrices) $return_prices = implode("\n", $textPrices);
				return $return_prices;

			}

		}

		function getPrice() {
			return $this->amount;
		}

		function Delete() {

			$dbObj = db_getDBObject();

			$sql = "UPDATE Invoice_CustomInvoice SET custom_invoice_id = '0' WHERE custom_invoice_id = $this->id";
			$dbObj->query($sql);

			$sql = "UPDATE Payment_CustomInvoice_Log SET custom_invoice_id = '0' WHERE custom_invoice_id = $this->id";
			$dbObj->query($sql);

			$sql = "DELETE FROM CustomInvoice_Items WHERE custominvoice_id = $this->id";
			$dbObj->query($sql);

			$sql = "DELETE FROM CustomInvoice WHERE id = $this->id";
			$dbObj->query($sql);

		}

	}

?>
