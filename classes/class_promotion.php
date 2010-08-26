<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classes/class_promotion.php
	# ----------------------------------------------------------------------------------------------------

	class Promotion extends Handle {

		var $id;
		var $account_id;
		var $image_id;
		var $thumb_id;
		var $updated;
		var $entered;
		var $name;
		var $seo_name;
		var $offer;
		var $offer1;
		var $offer2;
		var $offer3;
		var $offer4;
		var $description;
		var $description1;
		var $description2;
		var $description3;
		var $description4;
		var $seo_description;
		var $seo_description1;
		var $seo_description2;
		var $seo_description3;
		var $seo_description4;
		var $keywords;
		var $keywords1;
		var $keywords2;
		var $keywords3;
		var $keywords4;
		var $seo_keywords;
		var $seo_keywords1;
		var $seo_keywords2;
		var $seo_keywords3;
		var $seo_keywords4;
		var $start_date;
		var $end_date;
		var $html;
		var $conditions;
		var $conditions1;
		var $conditions2;
		var $conditions3;
		var $conditions4;

		function Promotion($var='') {
			if (is_numeric($var) && ($var)) {
				$db = db_getDBObject();
				$sql = "SELECT * FROM Promotion WHERE id = $var";
				$row = mysql_fetch_array($db->query($sql));
				$this->makeFromRow($row);
			}
			else {
				$this->makeFromRow($var);
			}
		}

		function makeFromRow($row='') {

			if ($row['id']) $this->id = $row['id'];
			else if (!$this->id) $this->id = 0;

			$this->account_id	= ($row["account_id"])	? $row["account_id"]	: 0;

			if ($row['image_id']) $this->image_id = $row['image_id'];
			else if (!$this->image_id) $this->image_id = 0;
			if ($row['thumb_id']) $this->thumb_id = $row['thumb_id'];
			else if (!$this->thumb_id) $this->thumb_id = 0;
			if ($row['updated']) $this->updated = $row['updated'];
			else if (!$this->updated) $this->updated = 0;
			if ($row['entered']) $this->entered = $row['entered'];
			else if (!$this->entered) $this->entered = 0;

			$this->name		= ($row["name"])		? $row["name"]		: ($this->name		? $this->name		: "");
			$this->seo_name	= ($row["seo_name"])	? $row["seo_name"]	: ($this->seo_name	? $this->seo_name	: "");

			$this->offer = $row['offer'];
			$this->offer1 = $row['offer1'];
			$this->offer2 = $row['offer2'];
			$this->offer3 = $row['offer3'];
			$this->offer4 = $row['offer4'];
			$this->description = $row['description'];
			$this->description1 = $row['description1'];
			$this->description2 = $row['description2'];
			$this->description3 = $row['description3'];
			$this->description4 = $row['description4'];

			$this->seo_description	= ($row["seo_description"])		? $row["seo_description"]	: ($this->seo_description	? $this->seo_description	: "");
			$this->seo_description1	= ($row["seo_description1"])	? $row["seo_description1"]	: ($this->seo_description1	? $this->seo_description1	: "");
			$this->seo_description2	= ($row["seo_description2"])	? $row["seo_description2"]	: ($this->seo_description2	? $this->seo_description2	: "");
			$this->seo_description3	= ($row["seo_description3"])	? $row["seo_description3"]	: ($this->seo_description3	? $this->seo_description3	: "");
			$this->seo_description4	= ($row["seo_description4"])	? $row["seo_description4"]	: ($this->seo_description4	? $this->seo_description4	: "");

			$this->keywords = $row['keywords'];
			$this->keywords1 = $row['keywords1'];
			$this->keywords2 = $row['keywords2'];
			$this->keywords3 = $row['keywords3'];
			$this->keywords4 = $row['keywords4'];

			$this->seo_keywords		= ($row["seo_keywords"])	? $row["seo_keywords"]	: ($this->seo_keywords	? $this->seo_keywords	: "");
			$this->seo_keywords1	= ($row["seo_keywords1"])	? $row["seo_keywords1"]	: ($this->seo_keywords1	? $this->seo_keywords1	: "");
			$this->seo_keywords2	= ($row["seo_keywords2"])	? $row["seo_keywords2"]	: ($this->seo_keywords2	? $this->seo_keywords2	: "");
			$this->seo_keywords3	= ($row["seo_keywords3"])	? $row["seo_keywords3"]	: ($this->seo_keywords3	? $this->seo_keywords3	: "");
			$this->seo_keywords4	= ($row["seo_keywords4"])	? $row["seo_keywords4"]	: ($this->seo_keywords4	? $this->seo_keywords4	: "");

			$this->conditions = $row['conditions'];
			$this->conditions1 = $row['conditions1'];
			$this->conditions2 = $row['conditions2'];
			$this->conditions3 = $row['conditions3'];
			$this->conditions4 = $row['conditions4'];

			$this->setDate("start_date", $row["start_date"]);
			$this->setDate("end_date", $row["end_date"]);

			$this->html = $row['html'];
		}

		function Save() {
			$this->prepareToSave();
			$dbObj = db_getDBObject();
			if ($this->id) {
				$sql  = "UPDATE Promotion SET"
					. " account_id = $this->account_id,"
					. " image_id = $this->image_id,"
					. " thumb_id = $this->thumb_id,"
					. " updated = NOW(),"
					. " name = $this->name,"
					. " seo_name = $this->seo_name,"
					. " offer = $this->offer,"
					. " offer1 = $this->offer1,"
					. " offer2 = $this->offer2,"
					. " offer3 = $this->offer3,"
					. " offer4 = $this->offer4,"
					. " description = $this->description,"
					. " description1 = $this->description1,"
					. " description2 = $this->description2,"
					. " description3 = $this->description3,"
					. " description4 = $this->description4,"
					. " seo_description = $this->seo_description,"
					. " seo_description1 = $this->seo_description1,"
					. " seo_description2 = $this->seo_description2,"
					. " seo_description3 = $this->seo_description3,"
					. " seo_description4 = $this->seo_description4,"
					. " keywords = $this->keywords,"
					. " keywords1 = $this->keywords1,"
					. " keywords2 = $this->keywords2,"
					. " keywords3 = $this->keywords3,"
					. " keywords4 = $this->keywords4,"
					. " seo_keywords = $this->seo_keywords,"
					. " seo_keywords1 = $this->seo_keywords1,"
					. " seo_keywords2 = $this->seo_keywords2,"
					. " seo_keywords3 = $this->seo_keywords3,"
					. " seo_keywords4 = $this->seo_keywords4,"
					. " conditions = $this->conditions,"
					. " conditions1 = $this->conditions1,"
					. " conditions2 = $this->conditions2,"
					. " conditions3 = $this->conditions3,"
					. " conditions4 = $this->conditions4,"
					. " start_date = $this->start_date,"
					. " end_date = $this->end_date,"
					. " html = $this->html"
					. " WHERE id = $this->id";
				$dbObj->query($sql);
			} else {
				$sql = "INSERT INTO Promotion"
					. " (account_id, image_id, thumb_id, updated, entered, name, seo_name, offer, offer1, offer2, offer3, offer4, description, description1, description2, description3, description4, seo_description, seo_description1, seo_description2, seo_description3, seo_description4, keywords, keywords1, keywords2, keywords3, keywords4, seo_keywords, seo_keywords1, seo_keywords2, seo_keywords3, seo_keywords4, fulltextsearch_keyword, fulltextsearch_where, conditions, conditions1, conditions2, conditions3, conditions4, start_date, end_date, html)"
					. " VALUES"
					. " ($this->account_id, $this->image_id, $this->thumb_id, NOW(), NOW(), $this->name, $this->name, $this->offer, $this->offer1, $this->offer2, $this->offer3, $this->offer4, $this->description, $this->description1, $this->description2, $this->description3, $this->description4, $this->description, $this->description1, $this->description2, $this->description3, $this->description4, $this->keywords, $this->keywords1, $this->keywords2, $this->keywords3, $this->keywords4, ".str_replace(" || ", ", ", $this->keywords).", ".str_replace(" || ", ", ", $this->keywords1).", ".str_replace(" || ", ", ", $this->keywords2).", ".str_replace(" || ", ", ", $this->keywords3).", ".str_replace(" || ", ", ", $this->keywords4).", '', '', $this->conditions, $this->conditions1, $this->conditions2, $this->conditions3, $this->conditions4, $this->start_date, $this->end_date, $this->html)";
				$dbObj->query($sql);
				$this->id = mysql_insert_id($dbObj->link_id);
			}
			$this->prepareToUse();
			$this->setFullTextSearch();
		}

		function Delete() {

			$dbObj = db_getDBObJect();

			$sql = "DELETE FROM Promotion WHERE id = $this->id";
			$dbObj->query($sql);

			$sql = "UPDATE Listing SET promotion_id = 0 WHERE promotion_id = $this->id";
			$dbObj->query($sql);

			if ($this->image_id) {
				$image = new Image($this->image_id);
				if ($image) $image->Delete();
			}
			if ($this->thumb_id) {
				$image = new Image($this->thumb_id);
				if ($image) $image->Delete();
			}

		}

		function updateImage($imageArray) {
			unset($imageObj);
			if ($this->image_id) {
				$imageobj = new Image($this->image_id);
				if ($imageobj) $imageobj->delete();
			}
			$this->image_id = $imageArray["image_id"];
			unset($imageObj);
			if ($this->thumb_id) {
				$imageObj = new Image($this->thumb_id);
				if ($imageObj) $imageObj->delete();
			}
			$this->thumb_id = $imageArray["thumb_id"];
			unset($imageObj);
		}

		function setFullTextSearch() {

			$dbObj = db_getDBObject();

			if ($this->name) {
				$fulltextsearch_keyword[] = $this->name;
			}

			if ($this->keywords) {
				$fulltextsearch_keyword[] = str_replace(" || ", " ", $this->keywords);
			}
			if ($this->keywords1) {
				$fulltextsearch_keyword[] = str_replace(" || ", " ", $this->keywords1);
			}
			if ($this->keywords2) {
				$fulltextsearch_keyword[] = str_replace(" || ", " ", $this->keywords2);
			}
			if ($this->keywords3) {
				$fulltextsearch_keyword[] = str_replace(" || ", " ", $this->keywords3);
			}
			if ($this->keywords4) {
				$fulltextsearch_keyword[] = str_replace(" || ", " ", $this->keywords4);
			}

			if ($this->offer) {
				$fulltextsearch_keyword[] = substr($this->offer, 0, 100);
			}
			if ($this->offer1) {
				$fulltextsearch_keyword[] = substr($this->offer1, 0, 100);
			}
			if ($this->offer2) {
				$fulltextsearch_keyword[] = substr($this->offer2, 0, 100);
			}
			if ($this->offer3) {
				$fulltextsearch_keyword[] = substr($this->offer3, 0, 100);
			}
			if ($this->offer4) {
				$fulltextsearch_keyword[] = substr($this->offer4, 0, 100);
			}

			if ($this->description) {
				$fulltextsearch_keyword[] = substr($this->description, 0, 100);
			}
			if ($this->description1) {
				$fulltextsearch_keyword[] = substr($this->description1, 0, 100);
			}
			if ($this->description2) {
				$fulltextsearch_keyword[] = substr($this->description2, 0, 100);
			}
			if ($this->description3) {
				$fulltextsearch_keyword[] = substr($this->description3, 0, 100);
			}
			if ($this->description4) {
				$fulltextsearch_keyword[] = substr($this->description4, 0, 100);
			}

			if (is_array($fulltextsearch_keyword)) {
				$fulltextsearch_keyword_sql = db_formatString(implode(" ", $fulltextsearch_keyword));
				$sql = "UPDATE Promotion SET fulltextsearch_keyword = $fulltextsearch_keyword_sql WHERE id = $this->id";
				$result = $dbObj->query($sql);
			}
			if (is_array($fulltextsearch_where)) {
				$fulltextsearch_where_sql = db_formatString(implode(" ", $fulltextsearch_where));
				$sql = "UPDATE Promotion SET fulltextsearch_where = $fulltextsearch_where_sql WHERE id = $this->id";
				$result = $dbObj->query($sql);
			}

		}

	}

?>
