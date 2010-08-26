<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classes/class_listingTemplate.php
	# ----------------------------------------------------------------------------------------------------

	class ListingTemplate extends Handle {

		var $id;
		var $layout_id;
		var $title;
		var $friendly_url;
		var $updated;
		var $entered;
		var $status;
		var $price;
		var $color_background;
		var $color_border;
		var $color_label;
		var $color_text;
		var $color_titlebackground;
		var $color_titleborder;
		var $color_titletext;

		function ListingTemplate($var='') {
			if (is_numeric($var) && ($var)) {
				$db = db_getDBObject();
				$sql = "SELECT * FROM ListingTemplate WHERE id = $var";
				$row = mysql_fetch_array($db->query($sql));
				$this->makeFromRow($row);
			} else {
				$this->makeFromRow($var);
			}
		}

		function makeFromRow($row='') {
			$this->id						= ($row["id"])						? $row["id"]					: ($this->id			? $this->id				: 0);
			$this->layout_id				= ($row["layout_id"])				? $row["layout_id"]				: ($this->layout_id		? $this->layout_id		: 0);
			$this->title					= ($row["title"])					? $row["title"]					: ($this->title			? $this->title			: "");
			$this->friendly_url				= ($row["friendly_url"])			? $row["friendly_url"]			: ($this->friendly_url	? $this->friendly_url	: "");
			$this->updated					= ($row["updated"])					? $row["updated"]				: ($this->updated		? $this->updated		: "");
			$this->entered					= ($row["entered"])					? $row["entered"]				: ($this->entered		? $this->entered		: "");
			$this->status					= ($row["status"])					? $row["status"]				: ($this->status		? $this->status			: "");
			$this->price					= ($row["price"])					? $row["price"]					: ($this->price			? $this->price			: "0.00");
			$this->color_background			= ($row["color_background"])		? $row["color_background"]		: "";
			$this->color_border				= ($row["color_border"])			? $row["color_border"]			: "";
			$this->color_label				= ($row["color_label"])				? $row["color_label"]			: "";
			$this->color_text				= ($row["color_text"])				? $row["color_text"]			: "";
			$this->color_titlebackground	= ($row["color_titlebackground"])	? $row["color_titlebackground"]	: "";
			$this->color_titleborder		= ($row["color_titleborder"])		? $row["color_titleborder"]		: "";
			$this->color_titletext			= ($row["color_titletext"])			? $row["color_titletext"]		: "";
		}

		function Save() {
			$this->prepareToSave();
			$dbObj = db_getDBObject();
			if ($this->id) {
				$sql  = "UPDATE ListingTemplate SET"
					. " layout_id             = $this->layout_id,"
					. " title                 = $this->title,"
					. " friendly_url          = $this->friendly_url,"
					. " updated               = NOW(),"
					. " status                = $this->status,"
					. " price                 = $this->price,"
					. " color_background      = $this->color_background,"
					. " color_border          = $this->color_border,"
					. " color_label           = $this->color_label,"
					. " color_text            = $this->color_text,"
					. " color_titlebackground = $this->color_titlebackground,"
					. " color_titleborder     = $this->color_titleborder,"
					. " color_titletext       = $this->color_titletext"
					. " WHERE id  = $this->id";
				$dbObj->query($sql);
			} else {
				$sql = "INSERT INTO ListingTemplate"
					. " ("
					. " layout_id,"
					. " title,"
					. " friendly_url,"
					. " updated,"
					. " entered,"
					. " status,"
					. " price,"
					. " color_background,"
					. " color_border,"
					. " color_label,"
					. " color_text,"
					. " color_titlebackground,"
					. " color_titleborder,"
					. " color_titletext,"
					. " cat_id"
					. " )"
					. " VALUES"
					. " ("
					. " $this->layout_id,"
					. " $this->title,"
					. " $this->friendly_url,"
					. " NOW(),"
					. " NOW(),"
					. " $this->status,"
					. " $this->price,"
					. " $this->color_background,"
					. " $this->color_border,"
					. " $this->color_label,"
					. " $this->color_text,"
					. " $this->color_titlebackground,"
					. " $this->color_titleborder,"
					. " $this->color_titletext,"
					. " ''"
					. " )";
				$dbObj->query($sql);
				$this->id = mysql_insert_id($dbObj->link_id);
			}
			$this->prepareToUse();
		}

		function clearListingTemplateFields() {
			$dbObj = db_getDBObject();
			$sql = "DELETE FROM ListingTemplate_Field WHERE listingtemplate_id = $this->id";
			$dbObj->query($sql);
		}

		function addListingTemplateField($ltf) {
			$dbObj = db_getDBObject();
			$sql = "INSERT INTO ListingTemplate_Field"
				. " ("
				. " listingtemplate_id,"
				. " field,"
				. " label,"
				. " fieldvalues,"
				. " instructions,"
				. " required,"
				. " search,"
				. " searchbykeyword,"
				. " searchbyrange,"
				. " show_order"
				. " )"
				. " VALUES"
				. " ("
				. " ".db_formatNumber($this->id).","
				. " ".db_formatString($ltf["field"]).","
				. " ".db_formatString($ltf["label"]).","
				. " ".db_formatString($ltf["fieldvalues"]).","
				. " ".db_formatString($ltf["instructions"]).","
				. " ".db_formatString($ltf["required"]).","
				. " ".db_formatString($ltf["search"]).","
				. " ".db_formatString($ltf["searchbykeyword"]).","
				. " ".db_formatString($ltf["searchbyrange"]).","
				. " ".db_formatString($ltf["show_order"]).""
				. " )";
			$dbObj->query($sql);
		}

		function getListingTemplateFields($field_name="") {
			$dbObj = db_getDBObject();
			$sql = "SELECT * FROM ListingTemplate_Field WHERE listingtemplate_id = $this->id ";
			if (strlen(trim($field_name))>0) {
				$field_name = db_formatString($field_name);
				$sql .= " AND field=$field_name ";
			}
			$sql .= " ORDER BY show_order";
			$result = $dbObj->query($sql);
			if ($result && (mysql_num_rows($result) >= 1)) {
				while ($row = mysql_fetch_array($result)) {
					$fields[] = $row;
				}
				if ($fields) {
					return $fields;
				}
			}
			return false;
		}

		function Delete() {

			$this->clearListingTemplateFields();

			$dbObj = db_getDBObject();

			$sql = "UPDATE Listing SET listingtemplate_id = '0' WHERE listingtemplate_id = $this->id";
			$dbObj->query($sql);

			$sql = "DELETE FROM ListingTemplate WHERE id = $this->id";
			$dbObj->query($sql);

		}

		function getCategories() {
			$dbObj = db_getDBObject();
			$sql = "SELECT cat_id FROM ListingTemplate WHERE id = $this->id";
			$r = $dbObj->query($sql);
			while ($row = mysql_fetch_array($r)) {
				if ($row["cat_id"]) {
					$cat_id = explode(",", $row["cat_id"]);
					foreach ($cat_id as $catid) {
						$categories[] = new ListingCategory($catid);
					}
				}
			}
			return $categories;
		}

		function setCategories($array) {
			$dbObj = db_getDBObject();
			$cat_id = "";
			if ($array) {
				foreach ($array as $category) {
					if ($category) {
						$catid[] = $category;
					}
				}
			}
			if ($catid) $cat_id = implode(",", $catid);
			$sql = "UPDATE ListingTemplate SET cat_id = ".db_formatString($cat_id)." WHERE id = $this->id";
			$dbObj->query($sql);
		}

	}

?>
