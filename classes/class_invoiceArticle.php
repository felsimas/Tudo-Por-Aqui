<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classes/class_invoiceArticle.php
	# ----------------------------------------------------------------------------------------------------

	class InvoiceArticle extends Handle {

		var $invoice_id;
		var $article_id;
		var $article_title;
		var $discount_id;
		var $level;
		var $renewal_date;
		var $amount;
		
		function InvoiceArticle($var="") {
			if (is_array($var) && ($var))
				$this->makeFromRow($var);
		}

		function makeFromRow($row="") {

			$this->invoice_id		= ($row["invoice_id"])		? $row["invoice_id"]		: ($this->invoice_id		? $this->invoice_id		: 0);
			$this->article_id		= ($row["article_id"])		? $row["article_id"]		: ($this->article_id		? $this->article_id		: 0);
			$this->article_title	= ($row["article_title"])	? $row["article_title"]		: ($this->article_title		? $this->article_title	: "");
			$this->discount_id		= ($row["discount_id"])		? $row["discount_id"]		: ($this->discount_id		? $this->discount_id	: "");
			$this->level			= ($row["level"])			? $row["level"]				: ($this->level				? $this->level			: 0);
			$this->renewal_date		= ($row["renewal_date"])	? $row["renewal_date"]		: ($this->renewal_date		? $this->renewal_date	: 0);
			$this->amount			= ($row["amount"])			? $row["amount"]			: ($this->amount			? $this->amount			: 0);
		}

		function Save() {

			$this->PrepareToSave();

			$dbObj = db_getDBObject();

			$sql = "INSERT INTO Invoice_Article"
				. " (invoice_id,"
				. " article_id,"
				. " article_title,"
				. " discount_id,"
				. " level,"
				. " renewal_date,"
				. " amount"
				. " )"
				. " VALUES"
				. " ("
				. " $this->invoice_id,"
				. " $this->article_id,"
				. " $this->article_title,"
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