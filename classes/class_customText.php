<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classes/class_customtext.php
	# ----------------------------------------------------------------------------------------------------

	class CustomText extends Handle {
		
		var $name;
		var $value;
		var $lang;
		
		function CustomText($var='', $lang=EDIR_DEFAULT_LANGUAGE) {
			$this->lang = $lang;
			if ($var) {
				$db = db_getDBObject();
				$sql = "SELECT * FROM CustomText WHERE name = ".db_formatString($var);
				if ($this->lang != EDIR_DEFAULT_LANGUAGE) {
					$sql = "SELECT * FROM CustomText_Lang WHERE name = ".db_formatString($var)." AND lang = ".db_formatString($this->lang);
				}
				$row = mysql_fetch_array($db->query($sql));
				$this->makeFromRow($row);
			} else {
				$this->makeFromRow($var);
			}
		}
		
		function makeFromRow($row='') {
			
			$this->name		= ($row["name"])	? $row["name"]	: ($this->name	? $this->name	: 0);
			$this->value	= ($row["value"])	? $row["value"]	: "";
			
		}
		
		function Save($update = true) {
			
			$langaux = $this->lang;
			
			$this->prepareToSave();
			
			$dbObj = db_getDBObject();
			
			if ($update) {
				
				if ($langaux != EDIR_DEFAULT_LANGUAGE) {
					
					$sql    = "SELECT * FROM CustomText_Lang WHERE lang=$this->lang AND name=$this->name";
					$verify = $dbObj->query($sql);
					
					if (!mysql_numrows($verify)) {
						
						$sql =	"INSERT INTO CustomText_Lang"
							. " (name, "
							. " lang, "
							. " value)"
							. " VALUES"
							. " ($this->name,"
							. " $this->lang,"
							. " $this->value)";
						
					} else {
						
						$sql =	"UPDATE CustomText_Lang SET"
							. " name  = $this->name,"
							. " lang  = $this->lang,"
							. " value = $this->value"
							. " WHERE name = $this->name AND lang = $this->lang";
						
					}
					
				} else {
				
					$sql = "UPDATE CustomText SET"
						. " value      = $this->value"
						. " WHERE name = $this->name";
					
				}

				$dbObj->query($sql);
				
			} else {
				
				$sql = "INSERT INTO CustomText"
					. " (name,"
					. " value)"
					. " VALUES"
					. " ($this->name,"
					. " $this->value)";
				
				$dbObj->query($sql);
				
			}
			
			$this->prepareToUse();
			
		}
		
		function Delete() {
			$dbObj = db_getDBObJect();
			$sql = "DELETE FROM CustomText WHERE name = ".db_formatString($this->name);
			$dbObj->query($sql);
			if (mysql_affected_rows($dbObj->link_id)) {
				return true;
			}
			return false;
		}
		
	}
	
?>