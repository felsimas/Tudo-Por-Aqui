<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classes/class_classifiedLevel.php
	# ----------------------------------------------------------------------------------------------------

	class ClassifiedLevel {

		##################################################
		# PRIVATE
		##################################################

		var $default;
		var $value;
		var $name;
		var $detail;
		var $images;
		var $price;
		var $content;
        var $lang;
		var $active;

		function ClassifiedLevel($lang=EDIR_DEFAULT_LANGUAGE, $listAll = false) {
			
			$this->lang = $lang;

			$dbObj = db_getDBObject();
            if($listAll) {
			    $sql = "SELECT * FROM ClassifiedLevel ORDER BY value";
            } else {
                $sql = "SELECT * FROM ClassifiedLevel WHERE active = 'y' ORDER BY value";
            }
			$result = $dbObj->query($sql);
			while ($row = mysql_fetch_assoc($result)) {

				if ($row["defaultlevel"] == "y") $this->default = $row["value"];
				$this->value[] = $row["value"];
				$this->name[] = $row["name"];
				$this->detail[] = $row["detail"];
				$this->images[] = $row["images"];
				$this->price[] = $row["price"];
                $this->content[] = $row["content"];
				$this->active[] = $row["active"];

			}

		}

		function getValues() {
			return $this->value;
		}

		function getNames() {
			return $this->name;
		}

		function union($key, $value) {
			for ($i=0; $i<count($key); $i++) {
				$aux[$key[$i]] = $value[$i];
			}
			return $aux;
		}

		function getValueName() {
			return $this->union($this->getValues(), $this->getNames());
		}

		function getDefault() {
            $activeArray =  array_filter($this->union($this->value, $this->active), 'validateActive');
            if(array_key_exists($this->default, $activeArray)) {
                return $this->default;
            } else {
                krsort($activeArray);
                $newActiveArray = array_keys($activeArray);
                return $newActiveArray[0];
            }
        }

		function getName($value) {
			if (is_numeric($value)){
				$value_name = $this->getValueName();
				return $value_name[$value];
			}
		}

		##################################################
		# PRIVATE
		##################################################

		##################################################
		# PUBLIC
		##################################################

		function getLevel($value) {
			if ($this->getName($value)) return $this->getName($value);
			else return $this->getLevel($this->getDefaultLevel());
		}

		function getDetail($value) {
			$detailArray = $this->union($this->value, $this->detail);
			if (isset($detailArray[$value])) return $detailArray[$value];
			else return $detailArray[$this->default];
		}

		function getImages($value) {
			$imagesArray = $this->union($this->value, $this->images);
			if (isset($imagesArray[$value])) return $imagesArray[$value];
			else return $imagesArray[$this->default];
		}

		function getPrice($value) {
			$priceArray = $this->union($this->value, $this->price);
			if (isset($priceArray[$value])) return $priceArray[$value];
			else return $priceArray[$this->default];
		}

		function getContent($value) {
			$contentArray = $this->union($this->value, $this->content);
			
			if ($this->lang != EDIR_DEFAULT_LANGUAGE) {
				$dbObj = db_getDBObject();
				$sql   = "SELECT content FROM ClassifiedLevel_Lang WHERE value='$value' AND lang='$this->lang'";
				$result = $dbObj->query($sql);
				if (mysql_numrows($result)) {
					return mysql_result($result, 0, "content");
				} else {
					return "";
				}
			}
			
			if (isset($contentArray[$value])) return $contentArray[$value];
			else return $contentArray[$this->default];
			
		}

		function getDefaultLevel() {
			return $this->getDefault();
		}

		function getLevelValues() {
			return $this->getValues();
		}

		function getLevelNames() {
			return $this->getNames();
		}

		function showLevel($value) {
			if ($this->getName($value)) return ucwords($this->getName($value));
			else return ucwords($this->getLevel($this->getDefaultLevel()));
		}

		function showLevelNames() {
			$names = $this->getNames();
			foreach ($names as $name) {
				$array[] = ucwords($name);
			}
			return $array;
		}
        
        function getActive($value) {
            $activeArray = $this->union($this->value, $this->active);            
            return $activeArray[$value];            
        }

		##################################################
		# PUBLIC
		##################################################

	}

?>
