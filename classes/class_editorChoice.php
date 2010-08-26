<?php



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classes/class_editorChoice.php
	# ----------------------------------------------------------------------------------------------------

	class EditorChoice extends Handle {

		var $id;
		var $available;
		var $name;
		var $image_id;
		var $image;

		/**
		* Editor Choice
		******************************************************/
		function EditorChoice($var="") {
			if (is_numeric($var) && ($var)) {
				$dbObj = db_getDBObject();
				$sql = "SELECT * FROM Editor_Choice WHERE id = $var";
				$row = mysql_fetch_array($dbObj->query($sql));
				if($row["image_id"]){
					$sql = "SELECT * FROM Image WHERE id = {$row["image_id"]}";
					$image = mysql_fetch_array($dbObj->query($sql));
				}
				$this->image = ($image) ? $image : "";
				$this->makeFromRow($row);
			} else {
				$this->makeFromRow($var);
			}
		}

		/**
		* makeFromRow
		******************************************************/
		function makeFromRow($row="") {
			$this->id			= ($row["id"])			? $row["id"]		: 0;
			$this->available	= ($row["available"])	? $row["available"]	: 0;
			$this->name			= ($row["name"])		? $row["name"]		: "";
			$this->image_id		= ($row["image_id"])	? $row["image_id"]	: 0;
		}

		/**
		* Save
		******************************************************/
		function Save() {
			$this->prepareToSave();
			if ($this->id) {
				$dbObj = db_getDBObject();
				$sql = "UPDATE Editor_Choice SET"
					. " available = $this->available,"
					. " name      = $this->name,"
					. " image_id  = $this->image_id"
					. " WHERE id  = $this->id";
				$dbObj->query($sql);
			} else {
				$dbObj = db_getDBObject();
				$sql = "INSERT INTO Editor_Choice"
					. " (available,"
					. " name,"
					. " image_id)"
					. " VALUES"
					. " ($this->available,"
					. " $this->name,"
					. " $this->image_id)";
				$dbObj->query($sql); 
				$this->id = mysql_insert_id($dbObj->link_id);
			}
			$this->prepareToUse();
		}

		/**
		* Delete
		******************************************************/
		function Delete() {
			$imageObj = new Image($this->image_id);
			$imageObj->Delete();
			$sql = "DELETE FROM Listing_Choice WHERE editor_choice_id = $this->id";
			$dbObj = db_getDBObject();
			$dbObj->query($sql);
			$sql = "DELETE FROM Editor_Choice WHERE id = $this->id";
			$dbObj = db_getDBObject();
			$dbObj->query($sql);
		}

		/**
		* retrieve
		******************************************************/
		function retrieve($id){
			$sql = "SELECT * FROM Editor_Choice WHERE id = $id";
			$dbObj = db_getDBObject();
			$result = $dbObj->query($sql);
			$data = mysql_fetch_assoc($result);
			return $data;
		}

	}

?>
