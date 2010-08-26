<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classes/class_googleSettings.php
	# ----------------------------------------------------------------------------------------------------

	class GoogleSettings extends Handle {

		var $id;
		var $name;
		var $value;

		function GoogleSettings($var='') {
			if (is_numeric($var) && ($var)) {
				$db = db_getDBObject();
				$sql = "SELECT * FROM Setting_Google WHERE id = $var";
				$row = mysql_fetch_array($db->query($sql));
				$this->makeFromRow($row);
			}
		}

		function makeFromRow($row='') {

			$this->id		= ($row['id'])		? $row['id']		: 0;
			$this->name		= ($row['name'])	? $row['name']		: 0;
			$this->value	= ($row['value'])	? $row['value']		: "";

		}

		function Save() {

			$this->prepareToSave();

			$dbObj = db_getDBObject();
			if ($this->id) {
				$sql =	"UPDATE Setting_Google SET"
						. " name  = $this->name, "
						. " value = $this->value"
						. " WHERE id = $this->id";
				$dbObj->query($sql);
			}

			$this->prepareToUse();

		}

		/*--------- chars not allowed => " ' \ /  ----------*/
		function formatValue($value) {

			if ($value) {
				/* replacing bad characters */
				$value = ereg_replace("\"", "", $value);
				$value = ereg_replace("'", "", $value);
				$value = ereg_replace("/", "", $value);
				$value = ereg_replace("\\\\", "", $value);

				if ($value) return $value;
				else return false;

			} else {
				return false;
			}

		}

	}

?>
