<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classes/class_bannerLevel.php
	# ----------------------------------------------------------------------------------------------------

	class BannerLevel {

		##################################################
		# PRIVATE
		##################################################

		var $default;
		var $value;
		var $name;
		var $price;
		var $width;
		var $height;
		var $impression_block;
		var $impression_price;
		var $content;
        var $lang;
        var $active;
		var $displayName;

		function BannerLevel($lang = EDIR_DEFAULT_LANGUAGE, $listAll = false) {
			
			$this->lang = $lang;
			
			$dbObj = db_getDBObject();
            if($listAll) {
			    $sql = "SELECT * FROM BannerLevel ORDER BY value";
            } else {
                $sql = "SELECT * FROM BannerLevel WHERE active = 'y' ORDER BY value";
            }
			$result = $dbObj->query($sql);
			while ($row = mysql_fetch_assoc($result)) {

				if ($row["defaultlevel"] == "y") $this->default = $row["value"];
				$this->value[] = $row["value"];
				$this->name[] = $row["name"];
				$this->price[] = $row["price"];
				$this->width[] = $row["width"];
				$this->height[] = $row["height"];
				$this->impression_block[] = $row["impression_block"];
				$this->impression_price[] = $row["impression_price"];
                $this->content[] = $row["content"];
                $this->active[] = $row["active"];
				$this->displayName[] = $row["displayName"];
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
                ksort($activeArray);
                $newActiveArray = array_keys($activeArray);
                return $newActiveArray[0];
            }
        }

        function getName($value) {
            /*
            if (is_numeric($value)){
                $value_name = $this->getValueName();
                return $value_name[$value];
            }
            */
            return $this->getDisplayName($value);
        }

		function getDisplayName($value) {
			if (is_numeric($value)){
				$value_name = $this->union($this->value, $this->displayName);
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

		function getPrice($value, $expiration_setting = BANNER_EXPIRATION_RENEWAL_DATE) {
			if($expiration_setting == BANNER_EXPIRATION_RENEWAL_DATE){
				$priceArray = $this->union($this->value, $this->price);
			} elseif ($expiration_setting == BANNER_EXPIRATION_IMPRESSION){
				$priceArray = $this->union($this->value, $this->impression_price);
			}
			if (isset($priceArray[$value])) return $priceArray[$value];
			else return $priceArray[$this->default];
		}

		function getImpressionBlock($value) {
			$impression_block_array = $this->union($this->value, $this->impression_block);
			if (isset($impression_block_array[$value])) return $impression_block_array[$value];
			else return $impression_block_array[$this->default];
		}

		function getImpressionPrice($value) {
			$impression_price_array = $this->union($this->value, $this->impression_price);
			if (isset($impression_price_array[$value])) return $impression_price_array[$value];
			else return $impression_price_array[$this->default];
		}

		function getWidth($value) {
			$widthArray = $this->union($this->value, $this->width);
			if (isset($widthArray[$value])) return $widthArray[$value];
			else return $widthArray[$this->default];
		}

		function getHeight($value) {
			$heightArray = $this->union($this->value, $this->height);
			if (isset($heightArray[$value])) return $heightArray[$value];
			else return $heightArray[$this->default];
		}

		function getContent($value) {
			$contentArray = $this->union($this->value, $this->content);
			
			if ($this->lang != EDIR_DEFAULT_LANGUAGE) {
				$dbObj = db_getDBObject();
				$sql   = "SELECT content FROM BannerLevel_Lang WHERE value='$value' AND lang='$this->lang'";
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
