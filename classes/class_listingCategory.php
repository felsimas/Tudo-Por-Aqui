<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classes/class_listingCategory.php
	# ----------------------------------------------------------------------------------------------------

	class ListingCategory extends Handle {

		var $id;
		var $lang;
		var $title;
		var $title1;
		var $title2;
		var $title3;
		var $title4;
		var $friendly_url;
		var $friendly_url1;
		var $friendly_url2;
		var $friendly_url3;
		var $friendly_url4;
		var $category_id;
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
		var $active_listing;

		function ListingCategory($var='') {
			if (is_numeric($var) && ($var)) {
				$db = db_getDBObject();
				$sql = "SELECT * FROM ListingCategory WHERE id = $var";
				$row = mysql_fetch_array($db->query($sql));
				$this->makeFromRow($row);
			} else {
				$this->makeFromRow($var);
			}
		}

		function makeFromRow($row='') {

			$this->id             = ($row["id"])             ? $row["id"]             : ($this->id             ? $this->id             : 0);
			$this->lang           = ($row["lang"])           ? $row["lang"]           : "";
			$this->title          = ($row["title"])          ? $row["title"]          : ($this->title          ? $this->title          : "");
			$this->title1         = ($row["title1"])         ? $row["title1"]         : "";
			$this->title2         = ($row["title2"])         ? $row["title2"]         : "";
			$this->title3         = ($row["title3"])         ? $row["title3"]         : "";
			$this->title4         = ($row["title4"])         ? $row["title4"]         : "";
			$this->friendly_url   = ($row["friendly_url"])   ? $row["friendly_url"]   : ($this->friendly_url   ? $this->friendly_url   : "");
			$this->friendly_url1  = ($row["friendly_url1"])  ? $row["friendly_url1"]  : "";
			$this->friendly_url2  = ($row["friendly_url2"])  ? $row["friendly_url2"]  : "";
			$this->friendly_url3  = ($row["friendly_url3"])  ? $row["friendly_url3"]  : "";
			$this->friendly_url4  = ($row["friendly_url4"])  ? $row["friendly_url4"]  : "";
			$this->category_id    = ($row["category_id"])    ? $row["category_id"]    : ($this->category_id    ? $this->category_id    : 0);
			$this->seo_description	= ($row["seo_description"])		? $row["seo_description"]	: "";
			$this->seo_description1	= ($row["seo_description1"])	? $row["seo_description1"]	: "";
			$this->seo_description2	= ($row["seo_description2"])	? $row["seo_description2"]	: "";
			$this->seo_description3	= ($row["seo_description3"])	? $row["seo_description3"]	: "";
			$this->seo_description4	= ($row["seo_description4"])	? $row["seo_description4"]	: "";
			$this->keywords       = ($row["keywords"])       ? $row["keywords"]       : ($this->keywords       ? $this->keywords       : "");
			$this->keywords1      = ($row["keywords1"])      ? $row["keywords1"]      : ($this->keywords1      ? $this->keywords1      : "");
			$this->keywords2      = ($row["keywords2"])      ? $row["keywords2"]      : ($this->keywords2      ? $this->keywords2      : "");
			$this->keywords3      = ($row["keywords3"])      ? $row["keywords3"]      : ($this->keywords3      ? $this->keywords3      : "");
			$this->keywords4      = ($row["keywords4"])      ? $row["keywords4"]      : ($this->keywords4      ? $this->keywords4      : "");
			$this->seo_keywords		= ($row["seo_keywords"])	? $row["seo_keywords"]	: "";
			$this->seo_keywords1	= ($row["seo_keywords1"])	? $row["seo_keywords1"]	: "";
			$this->seo_keywords2	= ($row["seo_keywords2"])	? $row["seo_keywords2"]	: "";
			$this->seo_keywords3	= ($row["seo_keywords3"])	? $row["seo_keywords3"]	: "";
			$this->seo_keywords4	= ($row["seo_keywords4"])	? $row["seo_keywords4"]	: "";
			$this->active_listing = ($row["active_listing"]) ? $row["active_listing"] : ($this->active_listing ? $this->active_listing : 0);

		}

		function Save() {

			$this->prepareToSave();

			$dbObj = db_getDBObject();

			$this->friendly_url = strtolower($this->friendly_url);

			if ($this->id) {

				$sql = "UPDATE ListingCategory SET"
					. " lang = $this->lang,"
					. " title = $this->title,"
					. " title1 = $this->title1,"
					. " title2 = $this->title2,"
					. " title3 = $this->title3,"
					. " title4 = $this->title4,"
					. " friendly_url = $this->friendly_url,"
					. " friendly_url1 = $this->friendly_url1,"
					. " friendly_url2 = $this->friendly_url2,"
					. " friendly_url3 = $this->friendly_url3,"
					. " friendly_url4 = $this->friendly_url4,"
					. " category_id = $this->category_id,"
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
					. " active_listing = $this->active_listing"
					. " WHERE id = $this->id";
				$dbObj->query($sql);

			} else {

				$sql = "INSERT INTO ListingCategory"
					. " (lang,"
					. " title,"
					. " title1,"
					. " title2,"
					. " title3,"
					. " title4,"
					. " friendly_url,"
					. " friendly_url1,"
					. " friendly_url2,"
					. " friendly_url3,"
					. " friendly_url4,"
					. " category_id,"
					. " seo_description,"
					. " seo_description1,"
					. " seo_description2,"
					. " seo_description3,"
					. " seo_description4,"
					. " keywords,"
					. " keywords1,"
					. " keywords2,"
					. " keywords3,"
					. " keywords4,"
					. " seo_keywords,"
					. " seo_keywords1,"
					. " seo_keywords2,"
					. " seo_keywords3,"
					. " seo_keywords4,"
					. " active_listing)"
					. " VALUES"
					. " ($this->lang,"
					. " $this->title,"
					. " $this->title1,"
					. " $this->title2,"
					. " $this->title3,"
					. " $this->title4,"
					. " $this->friendly_url,"
					. " $this->friendly_url1,"
					. " $this->friendly_url2,"
					. " $this->friendly_url3,"
					. " $this->friendly_url4,"
					. " $this->category_id,"
					. " $this->seo_description,"
					. " $this->seo_description1,"
					. " $this->seo_description2,"
					. " $this->seo_description3,"
					. " $this->seo_description4,"
					. " $this->keywords,"
					. " $this->keywords1,"
					. " $this->keywords2,"
					. " $this->keywords3,"
					. " $this->keywords4,"
					. " $this->seo_keywords,"
					. " $this->seo_keywords1,"
					. " $this->seo_keywords2,"
					. " $this->seo_keywords3,"
					. " $this->seo_keywords4,"
					. " $this->active_listing)";

				$dbObj->query($sql);
				$this->id = mysql_insert_id($dbObj->link_id);

			}

			$this->prepareToUse();

		}

		function Delete() {

			if ($this->id != 0) {

				$dbObj = db_getDBObJect();

				$sql = "SELECT * FROM ListingCategory WHERE category_id = $this->id";
				$r = $dbObj->query($sql);
				while ($row = mysql_fetch_array($r)) {
					$sql = "SELECT * FROM ListingCategory WHERE category_id = $row[id]";
					$r2 = $dbObj->query($sql);
					while ($row2 = mysql_fetch_array($r2)) {
						$sql = "SELECT * FROM ListingCategory WHERE category_id = $row2[id]";
						$r3 = $dbObj->query($sql);
						while ($row3 = mysql_fetch_array($r3)) {
							$sql = "SELECT * FROM ListingCategory WHERE category_id = $row3[id]";
							$r4 = $dbObj->query($sql);
							while ($row4 = mysql_fetch_array($r4)) {
								$sql = "UPDATE Listing SET cat_1_id = 0, parcat_1_level1_id = 0 WHERE cat_1_id = $row4[id]";
								$dbObj->query($sql);
								$sql = "UPDATE Listing SET cat_2_id = 0, parcat_2_level1_id = 0 WHERE cat_2_id = $row4[id]";
								$dbObj->query($sql);
								$sql = "UPDATE Listing SET cat_3_id = 0, parcat_3_level1_id = 0 WHERE cat_3_id = $row4[id]";
								$dbObj->query($sql);
								$sql = "UPDATE Listing SET cat_4_id = 0, parcat_4_level1_id = 0 WHERE cat_4_id = $row4[id]";
								$dbObj->query($sql);
								$sql = "UPDATE Listing SET cat_5_id = 0, parcat_5_level1_id = 0 WHERE cat_5_id = $row4[id]";
								$dbObj->query($sql);
							}
							$sql = "UPDATE Listing SET cat_1_id = 0, parcat_1_level1_id = 0 WHERE cat_1_id = $row3[id]";
							$dbObj->query($sql);
							$sql = "UPDATE Listing SET cat_2_id = 0, parcat_2_level1_id = 0 WHERE cat_2_id = $row3[id]";
							$dbObj->query($sql);
							$sql = "UPDATE Listing SET cat_3_id = 0, parcat_3_level1_id = 0 WHERE cat_3_id = $row3[id]";
							$dbObj->query($sql);
							$sql = "UPDATE Listing SET cat_4_id = 0, parcat_4_level1_id = 0 WHERE cat_4_id = $row3[id]";
							$dbObj->query($sql);
							$sql = "UPDATE Listing SET cat_5_id = 0, parcat_5_level1_id = 0 WHERE cat_5_id = $row3[id]";
							$dbObj->query($sql);
						}
						$sql = "UPDATE Listing SET cat_1_id = 0, parcat_1_level1_id = 0 WHERE cat_1_id = $row2[id]";
						$dbObj->query($sql);
						$sql = "UPDATE Listing SET cat_2_id = 0, parcat_2_level1_id = 0 WHERE cat_2_id = $row2[id]";
						$dbObj->query($sql);
						$sql = "UPDATE Listing SET cat_3_id = 0, parcat_3_level1_id = 0 WHERE cat_3_id = $row2[id]";
						$dbObj->query($sql);
						$sql = "UPDATE Listing SET cat_4_id = 0, parcat_4_level1_id = 0 WHERE cat_4_id = $row2[id]";
						$dbObj->query($sql);
						$sql = "UPDATE Listing SET cat_5_id = 0, parcat_5_level1_id = 0 WHERE cat_5_id = $row2[id]";
						$dbObj->query($sql);
					}
					$sql = "UPDATE Listing SET cat_1_id = 0, parcat_1_level1_id = 0 WHERE cat_1_id = $row[id]";
					$dbObj->query($sql);
					$sql = "UPDATE Listing SET cat_2_id = 0, parcat_2_level1_id = 0 WHERE cat_2_id = $row[id]";
					$dbObj->query($sql);
					$sql = "UPDATE Listing SET cat_3_id = 0, parcat_3_level1_id = 0 WHERE cat_3_id = $row[id]";
					$dbObj->query($sql);
					$sql = "UPDATE Listing SET cat_4_id = 0, parcat_4_level1_id = 0 WHERE cat_4_id = $row[id]";
					$dbObj->query($sql);
					$sql = "UPDATE Listing SET cat_5_id = 0, parcat_5_level1_id = 0 WHERE cat_5_id = $row[id]";
					$dbObj->query($sql);
				}

				$sql = "UPDATE Listing SET cat_1_id = 0, parcat_1_level1_id = 0 WHERE cat_1_id = $this->id";
				$dbObj->query($sql);
				$sql = "UPDATE Listing SET cat_2_id = 0, parcat_2_level1_id = 0 WHERE cat_2_id = $this->id";
				$dbObj->query($sql);
				$sql = "UPDATE Listing SET cat_3_id = 0, parcat_3_level1_id = 0 WHERE cat_3_id = $this->id";
				$dbObj->query($sql);
				$sql = "UPDATE Listing SET cat_4_id = 0, parcat_4_level1_id = 0 WHERE cat_4_id = $this->id";
				$dbObj->query($sql);
				$sql = "UPDATE Listing SET cat_5_id = 0, parcat_5_level1_id = 0 WHERE cat_5_id = $this->id";
				$dbObj->query($sql);

				$sql = "SELECT * FROM ListingCategory WHERE category_id = $this->id";
				$r = $dbObj->query($sql);
				while ($row = mysql_fetch_array($r)) {
					$sql = "SELECT * FROM ListingCategory WHERE category_id = $row[id]";
					$r2 = $dbObj->query($sql);
					while ($row2 = mysql_fetch_array($r2)) {
						$sql = "SELECT * FROM ListingCategory WHERE category_id = $row2[id]";
						$r3 = $dbObj->query($sql);
						while ($row3 = mysql_fetch_array($r3)) {
							$sql = "SELECT * FROM ListingCategory WHERE category_id = $row3[id]";
							$r4 = $dbObj->query($sql);
							while ($row4 = mysql_fetch_array($r4)) {
								$sql = "DELETE FROM ListingCategory WHERE id = $row4[id]";
								$dbObj->query($sql);
							}
							$sql = "DELETE FROM ListingCategory WHERE id = $row3[id]";
							$dbObj->query($sql);
						}
						$sql = "DELETE FROM ListingCategory WHERE id = $row2[id]";
						$dbObj->query($sql);
					}
					$sql = "DELETE FROM ListingCategory WHERE id = $row[id]";
					$dbObj->query($sql);
				}

				$sql = "DELETE FROM ListingCategory WHERE id = $this->id LIMIT 1";
				$dbObj->query($sql);

				$sql = "UPDATE Banner SET category_id = 0 WHERE category_id = $this->id AND section = 'listing'";
				$dbObj->query($sql);

			}

		}

		function retrieveAllCategories($lang=false){
			$dbObj = db_getDBObJect();
			$sql = "SELECT * FROM ListingCategory WHERE category_id = '0'";
			if ($lang) $sql .= " AND lang LIKE ".db_formatString("%".$lang."%")."";
			$sql .= " ORDER BY title";
			$result = $dbObj->query($sql);
			while($row = mysql_fetch_assoc($result)) $data[] = $row;
			if($data) return $data; else return false;
		}

		function retrieveAllSubCatById($id='', $lang=false){
			$dbObj = db_getDBObJect();
			$sql = "SELECT * FROM ListingCategory WHERE category_id = $id";
			if ($lang) $sql .= " AND lang LIKE ".db_formatString("%".$lang."%")."";
			$sql .= " ORDER BY title";
			$result = $dbObj->query($sql);
			while($row = mysql_fetch_assoc($result)) $data[] = $row;
			if($data) return $data; else return false;
		}

		function getLevel() {
			$dbObj = db_getDBObJect();
			$cat_level = 0;
			$category_id = $this->getString("id");
			while($category_id != 0) {
				$sql = "SELECT category_id FROM ListingCategory WHERE id = $category_id";
				$result = $dbObj->query($sql);
				$row = mysql_fetch_assoc($result);
				$category_id = $row["category_id"];
				$cat_level++;
			}
			return $cat_level;
		}

		function getFullPath() {
			$dbObj = db_getDBObJect();
			$category_id = $this->id;
			$i=0;
			while ($category_id != 0) {
				$sql = "SELECT * FROM ListingCategory WHERE id = $category_id";
				$result = $dbObj->query($sql);
				$row = mysql_fetch_assoc($result);
				$path[$i]["id"] = $row["id"];
				$path[$i]["dad"] = $row["category_id"];
				$path[$i]["title"] = $row["title"];
				$path[$i]["title1"] = $row["title1"];
				$path[$i]["title2"] = $row["title2"];
				$path[$i]["title3"] = $row["title3"];
				$path[$i]["title4"] = $row["title4"];
				$path[$i]["friendly_url"] = $row["friendly_url"];
				$path[$i]["friendly_url1"] = $row["friendly_url1"];
				$path[$i]["friendly_url2"] = $row["friendly_url2"];
				$path[$i]["friendly_url3"] = $row["friendly_url3"];
				$path[$i]["friendly_url4"] = $row["friendly_url4"];
				$path[$i]["active_listing"] = $row["active_listing"];
				$i++;
				$category_id = $row["category_id"];
			}
			if ($path) {
				$path = array_reverse($path);
				for($i=0; $i < count($path); $i++) $path[$i]["level"] = $i+1;
				return($path);
			} else {
				return false;
			}
		}

	}

?>
