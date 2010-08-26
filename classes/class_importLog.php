<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classes/class_importLog.php
	# ----------------------------------------------------------------------------------------------------

	class ImportLog extends Handle {

		var $id;
		var $date;
		var $time;
		var $filename;
		var $linesadded;
		var $totallines;
		var $phisicalname;
		var $status;
		var $progress;
		var $history;

		function ImportLog($var='') {
			if (is_numeric($var) && ($var)) {
				$db = db_getDBObject();
				$sql = "SELECT * FROM ImportLog WHERE status<>'D' AND id = $var";
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

			if ($row['date']) $this->date = $row['date'];
			else if (!$this->date) $this->date = 0;

			if ($row['time']) $this->time = $row['time'];
			else if (!$this->time) $this->time = "";

			if ($row['filename']) $this->filename = $row['filename'];
			else if (!$this->filename) $this->filename = "";

			if ($row['phisicalname']) $this->phisicalname = $row['phisicalname'];
			else if (!$this->phisicalname) $this->phisicalname = "";

			if ($row['linesadded']) $this->linesadded = $row['linesadded'];
			else if (!$this->linesadded) $this->linesadded = "0";

			if ($row['totallines']) $this->totallines = $row['totallines'];
			else if (!$this->totallines) $this->totallines = "0";

			if ($row['status']) $this->status = $row['status'];
			else if (!$this->status) $this->status = "P";

			if ($row['progress']) $this->progress = $row['progress'];
			else if (!$this->progress) $this->progress = "0%";

			if ($row['history']) $this->history = $row['history'];
			else if (!$this->history) $this->history = "";

		}

		function Save() {
			$this->prepareToSave();
			$dbObj = db_getDBObject();
			if ($this->id) {
				$sql  = "UPDATE ImportLog SET"
					. " date         = $this->date,"
					. " time         = $this->time,"
					. " filename     = $this->filename,"
					. " linesadded   = $this->linesadded,"
					. " totallines   = $this->totallines,"
					. " phisicalname = $this->phisicalname,"
					. " status       = $this->status,"
					. " progress     = $this->progress"
					. " WHERE id     = $this->id";
				$dbObj->query($sql);
			} else {
				$sql = "INSERT INTO ImportLog"
					. " (date, time, filename, linesadded, totallines, phisicalname, status, progress, history)"
					. " VALUES"
					. " ($this->date, $this->time, $this->filename, $this->linesadded, $this->totallines, $this->phisicalname, $this->status, $this->progress, '')";
				$dbObj->query($sql);
				$this->id = mysql_insert_id($dbObj->link_id);
			}
			$this->prepareToUse();
		}

		function Delete() {
			$dbObj = db_getDBObJect();
			$sql = "UPDATE ImportLog SET status = 'D' WHERE id = $this->id";
			$dbObj->query($sql);
			@unlink(IMPORT_FOLDER."/".$this->phisicalname);
		}

		function getImports() {
			$dbObj = db_getDBObJect();
			$sql = "SELECT id FROM ImportLog WHERE status<>'D' ORDER BY id DESC";
			$result = $dbObj->query($sql);
			if ($result) {
				while ($row = mysql_fetch_assoc($result)) {
					$id = $row['id'];
					$logarray[] = new ImportLog($id);
				}
				return $logarray;
			} else return NULL;
		}

		function setHistory($history) {
			$history = $history."\n";
			$dbObj = db_getDBObJect();
			$aux_str = addslashes($history);
			$sql = "UPDATE ImportLog SET history = CONCAT(history, '".$aux_str."') WHERE id = '".$this->id."'";
			$dbObj->query($sql);
		}

	}

?>