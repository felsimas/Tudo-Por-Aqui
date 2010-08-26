<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classes/class_forgotPassword.php
	# ----------------------------------------------------------------------------------------------------

	class forgotPassword extends Handle {

		var $account_id;
		var $unique_key;
		var $entered;
		var $section;

		function forgotPassword($var='') {
			if (!is_array($var) && ($var)) {
				$db = db_getDBObject();
				$sql = "SELECT * FROM Forgot_Password WHERE unique_key = '$var'";
				$row = mysql_fetch_array($db->query($sql));
				$this->makeFromRow($row);
			} else {
				$this->makeFromRow($var);
			}
		}

		function makeFromRow($row='') {
			$this->account_id = ($row["account_id"]) ? $row["account_id"] : ($this->account_id  ? $this->account_id : 0);
			$this->unique_key = ($row["unique_key"]) ? $row["unique_key"] : ($this->unique_key  ? $this->unique_key : "");
			$this->entered    = ($row["entered"])    ? $row["entered"]    : ($this->entered     ? $this->entered    : 0);
			$this->section    = ($row["section"])    ? $row["section"]    : ($this->section     ? $this->section    : "");
		}

		function Save() {

			$this->prepareToSave();

			$dbObj = db_getDBObject();

			$sql = "INSERT INTO Forgot_Password"
				. " (account_id, unique_key, entered, section)"
				. " VALUES"
				. " ($this->account_id, $this->unique_key, $this->entered, $this->section)";

			$dbObj->query($sql);
			$this->account_id = mysql_insert_id($dbObj->link_id);

			$this->prepareToUse();

		}

		function Delete() {
			$dbObj = db_getDBObJect();
			$sql = "DELETE FROM Forgot_Password WHERE unique_key = ".db_formatString($this->unique_key)."";
			$dbObj->query($sql);
			$sql = "DELETE FROM Forgot_Password WHERE section = ".db_formatString($this->section)." AND account_id = ".db_formatNumber($this->account_id)."";
			$dbObj->query($sql);
		}

	}

?>