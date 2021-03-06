<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classes/class_LocationRegion.php
	# ----------------------------------------------------------------------------------------------------

	class LocationRegion extends Handle {

		var $id;
		var $cidade_id;
		var $name;
		var $abbreviation;
		var $friendly_url;
		var $seo_description;
		var $seo_keywords;

		function LocationRegion($var='') {
			if (is_numeric($var) && ($var)) {
				$db = db_getDBObject();
				$sql = "SELECT * FROM Location_Region WHERE id = $var";
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

			if ($row['cidade_id']) $this->cidade_id = $row['cidade_id'];
			else if (!$this->cidade_id) $this->cidade_id = 0;

			if ($row['name']) $this->name = $row['name'];
			else if (!$this->name) $this->name = "";

			$this->abbreviation = $row['abbreviation'];

			if ($row['friendly_url']) $this->friendly_url = $row['friendly_url'];
			else if (!$this->friendly_url) $this->friendly_url = "";

			$this->seo_description = $row['seo_description'];
			$this->seo_keywords = $row['seo_keywords'];

		}

		function Save() {

			$this->prepareToSave();

			$dbObj = db_getDBObject();

			$this->friendly_url = strtolower($this->friendly_url);

			if ($this->id) {
				$sql  = "UPDATE Location_Region SET"
					. " cidade_id = $this->cidade_id,"
					. " name = $this->name,"
					. " abbreviation = $this->abbreviation,"
					. " friendly_url = $this->friendly_url,"
					. " seo_description = $this->seo_description,"
					. " seo_keywords = $this->seo_keywords"
					. " WHERE id = $this->id";
				$dbObj->query($sql);
			} else {
				$sql = "INSERT INTO Location_Region"
					. " (cidade_id, name, abbreviation, friendly_url, seo_description, seo_keywords)"
					. " VALUES"
					. " ($this->cidade_id, $this->name, $this->abbreviation, $this->friendly_url, $this->seo_description, $this->seo_keywords)";
				$dbObj->query($sql);
				$this->id = mysql_insert_id($dbObj->link_id);
			}

			$this->prepareToUse();

		}

		function Delete() {
			$dbObj = db_getDBObJect();
			$sql = "SELECT * FROM Location_City WHERE bairro_id = $this->id";
			$result = $dbObj->query($sql);
			while($row = mysql_fetch_assoc($result)) $city_data[] = $row;
			if($city_data)
				foreach($city_data as $each_city){
					$locationCity = new LocationCity($each_city["id"]);
					$locationCity->Delete();
				}
			$sql = "DELETE FROM Location_Region WHERE id = $this->id";
			$dbObj->query($sql);
		}

		function isRepeated(){
			if(!$this->name || !$this->cidade_id) return true;
			$dbObj = db_getDBObJect();
			$sql = "SELECT * FROM Location_Region WHERE name = ".db_formatString($this->name)." AND cidade_id = $this->cidade_id";
			if($this->id) $sql .= " AND id != $this->id";
			$result = $dbObj->query($sql);
			$row = mysql_fetch_assoc($result);
			if($row) return true; else return false;
		}

		function retrievedIfRepeated() {

			$sql = "SELECT * FROM Location_Region WHERE friendly_url = ".db_formatString($this->friendly_url)." AND cidade_id = $this->cidade_id";
			if ($this->id) $sql .= " AND id != $this->id";

			$dbObj = db_getDBObJect();
			$result = $dbObj->query($sql);
			$row = mysql_fetch_assoc($result);

			if ($row["id"]) {
				return $row["id"];
			} else {
				return false;
			}

		}

		function retrieveAllRegions(){
			$dbObj = db_getDBObJect();
			$sql = "SELECT * FROM Location_Region ORDER BY name";
			$result = $dbObj->query($sql);
			while($row = mysql_fetch_assoc($result)) $data[] = $row;
			if($data) return $data; else return false;
		}

		function retrieveRegionById(){
			$dbObj = db_getDBObJect();
			$sql = "SELECT * FROM Location_Region WHERE id = $this->id";
			$result = $dbObj->query($sql);
			$row = mysql_fetch_assoc($result);
			if($row) return $row; else return false;
		}

		function retrieveRegionsByState(){
			if(!$this->cidade_id) return false;
			$dbObj = db_getDBObJect();
			$sql = "SELECT * FROM Location_Region WHERE cidade_id = $this->cidade_id ORDER BY name";
			$result = $dbObj->query($sql);
			while($row = mysql_fetch_assoc($result)) $data[] = $row;
			if($data) return $data; else return false;
		}

		function isValidFriendlyUrl(&$error_message) {

			if(!$this->getString("friendly_url")){
				$error_message = "&#149;&nbsp; Friendly Title is required, please do not leave it blank.";
				return false;
			}

			$dbObj = db_getDBObJect();

			$sql = "SELECT friendly_url FROM Location_Region WHERE friendly_url = '".$this->getString("friendly_url")."'";

			if($this->getString("cidade_id"))
				$sql .= " AND cidade_id = $this->cidade_id ";

			if($this->getString("id"))
				$sql .= " AND id != ".$this->getString("id");

			$sql .= " LIMIT 1";

			$rs = $dbObj->query($sql);

			if(mysql_num_rows($rs) > 0){
				$error_message = "&#149;&nbsp; Friendly Title already in use, please choose another Friendly Title";
				return false;
			}

			if(!ereg(FRIENDLYURL_REGULAREXPRESSION, $this->getString("friendly_url"))){
				$error_message = "&#149;&nbsp; Friendly Url contain invalid chars";
				return false;
			}

			return true;

		}

	}
?>