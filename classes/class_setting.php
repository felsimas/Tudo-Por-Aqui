<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classes/class_setting.php
	# ----------------------------------------------------------------------------------------------------

	class Setting extends Handle {
		
		var $name;
		var $value;
		
		function Setting($var='') {
			if ($var) {
				$db = db_getDBObject();
				$sql = "SELECT * FROM Setting WHERE name = ".db_formatString($var);
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
			
			$this->prepareToSave();
			
			$dbObj = db_getDBObject();
			
			if ($update) {
				
				$sql = "UPDATE Setting SET"
					. " value      = $this->value"
					. " WHERE name = $this->name";

				$dbObj->query($sql);
				
			} else {
				
				$sql = "INSERT INTO Setting"
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
			$sql = "DELETE FROM Setting WHERE name = ".db_formatString($this->name);
			$dbObj->query($sql);
			if (mysql_affected_rows($dbObj->link_id)) {
				return true;
			}
			return false;
		}
		
	}
	
?>