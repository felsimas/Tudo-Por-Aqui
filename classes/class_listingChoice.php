<?php



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classes/class_listingChoice.php
	# ----------------------------------------------------------------------------------------------------

	class ListingChoice extends Handle {

		var $id;
		var $editor_choice_id;
		var $listing_id;

		/**
		* Listing Choice
		******************************************************/
		function ListingChoice($editor="", $listing="") {

			if ( (is_numeric($editor) && ($editor)) && (is_numeric($listing) && ($listing)) ) {
				
			  $dbObj = db_getDBObject();
				$sql  = "SELECT * FROM Listing_Choice";
				$sql .= " WHERE editor_choice_id = $editor";
				$sql .= " AND   listing_id       = $listing";

				$row = mysql_fetch_array($dbObj->query($sql));
				
				$this->makeFromRow($row);

			} else {

				$this->makeFromRow($row);
			
			}
		}

		/**
		* makeFromRow
		******************************************************/
		function makeFromRow($row="") {
		  
		  	$this->id				= ($row["id"])				 ? $row["id"]				: 0;
			$this->editor_choice_id = ($row["editor_choice_id"]) ? $row["editor_choice_id"] : 0;
			$this->listing_id       = ($row["listing_id"])       ? $row["listing_id"]       : 0;

		}

		/**
		* Save
		******************************************************/
		function Save() {
			$this->prepareToSave();

			$dbObj = db_getDBObject();
			$sql = "INSERT INTO Listing_Choice"
				. " (editor_choice_id,"
				. "  listing_id)"
				. " VALUES"
				. " ($this->editor_choice_id,"
				. "  $this->listing_id)";
				
			$dbObj->query($sql); 
			$this->id = mysql_insert_id($dbObj->link_id);
			
			$this->prepareToUse();

		}

		/**
		* Delete 
		******************************************************/
		function Delete() {

			$sql  = "DELETE FROM Listing_Choice";
			$sql .= " WHERE listing_id = $this->listing_id";

			$dbObj = db_getDBObject();
			$dbObj->query($sql);

		}
		
		/**
		* Delete Listing Choice that are Available
		*******************************************************/
		function DeleteAvailable() {

			$sql  = "DELETE FROM Listing_Choice";
			$sql .= " WHERE listing_id       = $this->listing_id";
			$sql .= " AND   editor_choice_id = $this->editor_choice_id";

			$dbObj = db_getDBObject();
			$dbObj->query($sql);

		}
	
	}

?>
