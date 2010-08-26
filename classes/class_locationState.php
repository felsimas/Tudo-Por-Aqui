<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classes/class_LocationState.php
	# ----------------------------------------------------------------------------------------------------

	class LocationState extends Handle {

		var $id;
		var $estado_id;
		var $name;
		var $abbreviation;
		var $friendly_url;
		var $seo_description;
		var $seo_keywords;
        var $popular;

		function LocationState($var='') {
			if (is_numeric($var) && ($var)) {
				$db = db_getDBObject();
				$sql = "SELECT * FROM Location_State WHERE id = $var";
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

			if ($row['estado_id']) $this->estado_id = $row['estado_id'];
			else if (!$this->estado_id) $this->estado_id = 0;

			if ($row['name']) $this->name = $row['name'];
			else if (!$this->name) $this->name = "";

			$this->abbreviation = $row['abbreviation'];

			if ($row['friendly_url']) $this->friendly_url = $row['friendly_url'];
			else if (!$this->friendly_url) $this->friendly_url = "";

			$this->seo_description = $row['seo_description'];
			$this->seo_keywords = $row['seo_keywords'];
            
            $this->popular = $row['popular'];

		}

		function Save() {

			$this->prepareToSave();

			$dbObj = db_getDBObject();

			$this->friendly_url = strtolower($this->friendly_url);

			if ($this->id) {
				$sql  = "UPDATE Location_State SET"
					. " estado_id = $this->estado_id,"
					. " name = $this->name,"
					. " abbreviation = $this->abbreviation,"
					. " friendly_url = $this->friendly_url,"
					. " seo_description = $this->seo_description,"
					. " seo_keywords = $this->seo_keywords"
					. " WHERE id = $this->id";
				$dbObj->query($sql);
			} else {
				$sql = "INSERT INTO Location_State"
					. " (estado_id, name, abbreviation, friendly_url, seo_description, seo_keywords)"
					. " VALUES"
					. " ($this->estado_id, $this->name, $this->abbreviation, $this->friendly_url, $this->seo_description, $this->seo_keywords)";
				$dbObj->query($sql);
				$this->id = mysql_insert_id($dbObj->link_id);
			}

			$this->prepareToUse();

		}

		function Delete() {
			$dbObj = db_getDBObJect();
			$sql = "SELECT * FROM Location_Region WHERE cidade_id = $this->id";
			$result = $dbObj->query($sql);
			while($row = mysql_fetch_assoc($result)) $region_data[] = $row;
			if($region_data)
				foreach($region_data as $each_region){
				$locationRegion = new LocationRegion($each_region["id"]);
				$locationRegion->Delete();
				}
			$sql = "DELETE FROM Location_State WHERE id = $this->id";
			$dbObj->query($sql);
		}
        
        function setPopular() {
            
            if (!$this->id) return false;
            
            $dbObj = db_getDBObJect();
            $sql    = "UPDATE Location_State SET popular='y'  WHERE id=$this->id";
            return $dbObj->query($sql);
            
        }
        
        function retrievePopulars() {
            
            $dbObj  = db_getDBObJect();
            $sql    = "SELECT Location_State.*, Location_Country.friendly_url AS country_friendly_url "
                    . "FROM Location_State LEFT JOIN Location_Country ON Location_State.estado_id = Location_Country.id "
                    . "WHERE Location_State.popular='y' GROUP BY Location_State.id ORDER BY Location_State.estado_id, Location_State.name ";
                     
            $result =  $dbObj->query($sql);
            
            $rows = array();
            while ($row = mysql_fetch_array($result)) $rows[] = $row;
            
            return $rows;
            
        }
	
		function isRepeated(){
			if(!$this->name || !$this->estado_id) return true;
			$dbObj = db_getDBObJect();
			$sql = "SELECT * FROM Location_State WHERE name = ".db_formatString($this->name)." AND estado_id = $this->estado_id";
			if($this->id) $sql .= " AND id != $this->id";
			$result = $dbObj->query($sql);
			$row = mysql_fetch_assoc($result);
			if($row) return true; else return false;
		}

		function retrievedIfRepeated() {

			$sql = "SELECT * FROM Location_State WHERE friendly_url = ".db_formatString($this->friendly_url)." AND estado_id = $this->estado_id";
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

		function retrieveAllStates(){
			$dbObj = db_getDBObJect();
			$sql = "SELECT * FROM Location_State ORDER BY name";
			$result = $dbObj->query($sql);
			while($row = mysql_fetch_assoc($result)) $data[] = $row;
			if($data) return $data; else return false;
		}

		function retrieveStateById(){
			$dbObj = db_getDBObJect();
			$sql = "SELECT * FROM Location_State WHERE id = $this->id";
			$result = $dbObj->query($sql);
			$row = mysql_fetch_assoc($result);
			if($row) return $row; else return false;
		}

		function retrieveStatesByCountry(){
			if(!$this->estado_id) return false;
			$dbObj = db_getDBObJect();
			$sql = "SELECT * FROM Location_State WHERE estado_id = $this->estado_id ORDER BY name";
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

			$sql = "SELECT friendly_url FROM Location_State WHERE friendly_url = '".$this->getString("friendly_url")."'";

			if($this->getString("estado_id"))
				$sql .= " AND estado_id = $this->estado_id ";

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