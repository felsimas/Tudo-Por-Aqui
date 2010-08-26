<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classes/class_paymentListingLog.php
	# ----------------------------------------------------------------------------------------------------

	class PaymentListingLog extends Handle {

		var $payment_log_id;
		var $listing_id;
		var $listing_title;
		var $discount_id;
		var $level;
		var $renewal_date;
		var $categories;
		var $extra_categories;
		var $listingtemplate_title;
		var $amount;

		function PaymentListingLog($var="") {
			if (is_numeric($var) && ($var)) {
				$db = db_getDBObject();
				$sql = "SELECT * FROM Payment_Listing_Log WHERE payment_log_id = $var";
				$row = mysql_fetch_array($db->query($sql));
				$this->makeFromRow($row);
			} else {
				$this->makeFromRow($var);
			}
		}

		function makeFromRow($row="") {

			$this->payment_log_id			= ($row["payment_log_id"])			? $row["payment_log_id"]		: ($this->payment_log_id		? $this->payment_log_id			: 0);
			$this->listing_id				= ($row["listing_id"])				? $row["listing_id"]			: ($this->listing_id			? $this->listing_id				: 0);
			$this->listing_title			= ($row["listing_title"])			? $row["listing_title"]			: ($this->listing_title			? $this->listing_title			: "");
			$this->discount_id				= ($row["discount_id"])				? $row["discount_id"]			: ($this->discount_id			? $this->discount_id			: "");
			$this->level					= ($row["level"])					? $row["level"]					: ($this->level					? $this->level					: 0);
			$this->renewal_date				= ($row["renewal_date"])			? $row["renewal_date"]			: ($this->renewal_date			? $this->renewal_date			: 0);
			$this->categories				= ($row["categories"])				? $row["categories"]			: ($this->categories			? $this->categories				: 0);
			$this->extra_categories			= ($row["extra_categories"])		? $row["extra_categories"]		: ($this->extra_categories		? $this->extra_categories		: 0);
			$this->listingtemplate_title	= ($row["listingtemplate_title"])	? $row["listingtemplate_title"]	: ($this->listingtemplate_title	? $this->listingtemplate_title	: "");
			$this->amount					= ($row["amount"])					? $row["amount"]				: ($this->amount				? $this->amount					: 0);

		}

		function Save() {

			$this->PrepareToSave();

			$dbObj = db_getDBObject();

			$sql = "INSERT INTO Payment_Listing_Log"
				. " (payment_log_id,"
				. " listing_id,"
				. " listing_title,"
				. " discount_id,"
				. " level,"
				. " renewal_date,"
				. " categories,"
				. " extra_categories,"
				. " listingtemplate_title,"
				. " amount"
				. " )"
				. " VALUES"
				. " ("
				. " $this->payment_log_id,"
				. " $this->listing_id,"
				. " $this->listing_title,"
				. " $this->discount_id,"
				. " $this->level,"
				. " $this->renewal_date,"
				. " $this->categories,"
				. " $this->extra_categories,"
				. " $this->listingtemplate_title,"
				. " $this->amount"
				. " )";

			$dbObj->query($sql);

			$this->id = mysql_insert_id($dbObj->link_id);

			$this->PrepareToUse();

		}

	}

?>
