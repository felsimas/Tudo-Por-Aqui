<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classes/class_discountCode.php
	# ----------------------------------------------------------------------------------------------------

	class DiscountCode extends Handle {

		var $id;
		var $amount;
		var $type;
		var $status;
		var $expire_date;
		var $recurring;
		var $listing;
		var $event;
		var $banner;
		var $classified;
		var $article;

		function DiscountCode($var="") {
			if (!is_array($var) && ($var)) {
				$db = db_getDBObject();
				$sql = "SELECT * FROM Discount_Code WHERE id = ".db_formatString($var)."";
				$row = mysql_fetch_array($db->query($sql));
				$this->makeFromRow($row);
			} else {
				$this->makeFromRow($var);
			}
		}

		function makeFromRow($row="") {

			$this->x_id					= ($row["x_id"])					? $row["x_id"]					: 0;
			$this->id					= ($row["id"])						? $row["id"]					: ($this->id				? $this->id				: "");
			$this->amount				= ($row["amount"])					? $row["amount"]				: ($this->amount			? $this->amount			: 0);
			$this->type					= ($row["type"])					? $row["type"]					: ($this->type				? $this->type			: "monetary value");
			$this->status				= ($row["status"])					? $row["status"]				: ($this->status			? $this->status			: "A");
			$this->expire_date			= ($row["expire_date"])				? $row["expire_date"]			: ($this->expire_date		? $this->expire_date	: 0);
			$this->recurring			= ($row["recurring"])				? $row["recurring"]				: ($this->recurring			? $this->recurring		: "no");
			$this->listing				= ($row["listing"])					? $row["listing"]				: "";
			$this->event				= ($row["event"])					? $row["event"]					: "";
			$this->banner				= ($row["banner"])					? $row["banner"]				: "";
			$this->classified			= ($row["classified"])				? $row["classified"]			: "";
			$this->article				= ($row["article"])					? $row["article"]				: "";

		}

		function Save() {

			$this->prepareToSave();

			$dbObj = db_getDBObject();

			if ($this->x_id) {
				$sql  = "UPDATE Discount_Code SET"
					. " id = $this->id,"
					. " amount = $this->amount,"
					. " type = $this->type,"
					. " status = $this->status,"
					. " expire_date = $this->expire_date,"
					. " listing = $this->listing,"
					. " event = $this->event,"
					. " banner = $this->banner,"
					. " classified = $this->classified,"
					. " article = $this->article,"
					. " recurring = $this->recurring"
					. " WHERE id = $this->x_id";
				$dbObj->query($sql);
			} else {
				$sql = "INSERT INTO Discount_Code"
					. " (id, amount, type, status, expire_date, listing, event, banner, classified, article, recurring)"
					. " VALUES"
					. " ($this->id, $this->amount, $this->type, $this->status, $this->expire_date, $this->listing, $this->event, $this->banner, $this->classified, $this->article, $this->recurring)";
				$dbObj->query($sql);
				$this->id = mysql_insert_id($dbObj->link_id);
			}

			$this->prepareToUse();
		}

		function Delete() {

			$dbObj = db_getDBObJect();
			$sql = "DELETE FROM Discount_Code WHERE id = '$this->id'";
			$dbObj->query($sql);

		}

	}
?>