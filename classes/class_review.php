<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classes/class_review.php
	# ----------------------------------------------------------------------------------------------------

	class Review extends Handle {

		var $id;
		var $item_type;
		var $item_id;
		var $added;
		var $ip;
		var $rating;
		var $review_title;
		var $review;
		var $reviewer_name;
		var $reviewer_email;
		var $reviewer_location;
		var $approved;
		var $response;
		var $responseapproved;

		function Review($var="") {
			if (is_numeric($var) && ($var)) {
				$db = db_getDBObject();
				$sql = "SELECT * FROM Review WHERE id = $var";
				$row = mysql_fetch_array($db->query($sql));
				$this->makeFromRow($row);
			} else {
				$this->makeFromRow($var);
			}
		}

		function makeFromRow($row="") {

			$this->id                    = ($row["id"])                     ? $row["id"]                    : ($this->id                    ? $this->id                     : 0);
			$this->item_type             = ($row["item_type"])              ? $row["item_type"]             : ($this->item_type             ? $this->item_type              : "");
			$this->item_id               = ($row["item_id"])                ? $row["item_id"]               : ($this->item_id               ? $this->item_id                : 0);
			$this->added                 = ($row["added"])                  ? $row["added"]                 : ($this->added                 ? $this->added                  : "");
			$this->ip                    = ($row["ip"])                     ? $row["ip"]                    : ($this->ip                    ? $this->ip                     : "");
			$this->rating                = ($row["rating"])                 ? $row["rating"]                : ($this->rating                ? $this->rating                 : "");
			$this->review_title          = ($row["review_title"])           ? $row["review_title"]          : "";
			$this->review                = ($row["review"])                 ? $row["review"]                : "";
			$this->reviewer_name         = ($row["reviewer_name"])          ? $row["reviewer_name"]         : "";
			$this->reviewer_email        = ($row["reviewer_email"])         ? $row["reviewer_email"]        : "";
			$this->reviewer_location     = ($row["reviewer_location"])      ? $row["reviewer_location"]     : "";
			$this->approved              = ($row["approved"])               ? $row["approved"]              : 0;
			$this->response              = ($row["response"])               ? $row["response"]              : "";
			$this->responseapproved      = ($row["responseapproved"])       ? $row["responseapproved"]      : 0;

		}

		function Save() {

			$dbObj = db_getDBObject();

			$this->prepareToSave();

			if ($this->id) {

				$sql = "UPDATE Review SET"
					. " item_type         = $this->item_type,"
					. " item_id           = $this->item_id,"
					. " added             = $this->added,"
					. " ip                = $this->ip,"
					. " rating            = $this->rating,"
					. " review_title      = $this->review_title,"
					. " review            = $this->review,"
					. " reviewer_name     = $this->reviewer_name,"
					. " reviewer_email    = $this->reviewer_email,"
					. " reviewer_location = $this->reviewer_location,"
					. " approved          = $this->approved,"
					. " response          = $this->response,"
					. " responseapproved  = $this->responseapproved"
					. " WHERE id          = $this->id";

					$dbObj->query($sql);

			} else {

				$sql = "INSERT INTO Review"
					. " (item_type,"
					. " item_id,"
					. " added,"
					. " ip,"
					. " rating,"
					. " review_title,"
					. " review,"
					. " reviewer_name,"
					. " reviewer_email,"
					. " reviewer_location,"
					. " approved,"
					. " response,"
					. " responseapproved"
					. " )"
					. " VALUES"
					. " ("
					. " $this->item_type,"
					. " $this->item_id,"
					. " NOW(),"
					. " $this->ip,"
					. " $this->rating,"
					. " $this->review_title,"
					. " $this->review,"
					. " $this->reviewer_name,"
					. " $this->reviewer_email,"
					. " $this->reviewer_location,"
					. " $this->approved,"
					. " $this->response,"
					. " $this->responseapproved"
					. " )";

				$dbObj->query($sql);

				$this->id = mysql_insert_id($dbObj->link_id);

			}

			$this->prepareToUse();

		}

		function Delete() {
			$dbObj = db_getDBObJect();
			$sql = "DELETE FROM Review WHERE id = $this->id";
			$dbObj->query($sql);
		}

		function getRateAvgByItem($item_type, $item_id) {
			$dbObj = db_getDBObJect();
			$sql = "SELECT AVG(rating) as rate FROM Review WHERE item_type = ".db_formatString($item_type)." AND item_id = ".db_formatNumber($item_id)." AND approved = '1' ";
			$result = $dbObj->query($sql);
			if ($result) while ($row = mysql_fetch_assoc($result)) $rate = $row["rate"];
			return (isset($rate) && $rate != 0) ? round($rate) : system_showText(LANG_NA);
		}

		function getDeniedIpsByItem($item_type, $item_id) {
			$dbObj = db_getDBObJect();
			$sql = "SELECT ip FROM Review WHERE (added >= DATE_SUB(NOW(), INTERVAL '5' MINUTE)) AND item_type = ".db_formatString($item_type)." AND item_id = ".db_formatNumber($item_id)."";
			$result = $dbObj->query($sql);
			if ($result) while ($row = mysql_fetch_assoc($result)) $ips[] = $row["ip"];
			return $ips;
		}
	}

?>
