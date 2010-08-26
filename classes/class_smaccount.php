<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classes/class_smaccount.php
	# ----------------------------------------------------------------------------------------------------

	class SMAccount extends Handle {

		var $id;
		var $updated;
		var $entered;
		var $username;
		var $password;
		var $permission;
		var $iprestriction;
		var $name;
		var $phone;
		var $email;
		var $selected_items = array();

		function SMAccount($var='') {

			if (is_numeric($var) && ($var)) {
				$db = db_getDBObject();
				$sql = "SELECT * FROM SMAccount WHERE id = $var";
				$row = mysql_fetch_array($db->query($sql));
				$this->makeFromRow($row);
				$this->fillLocation($row['id']);
				
			} else {
				$this->makeFromRow($var);
			}
		}

		function makeFromRow($row='') {
			$this->id				= ($row["id"])				? $row["id"]			: ($this->id			? $this->id				: 0);
			$this->updated			= ($row["updated"])			? $row["updated"]		: ($this->updated		? $this->updated		: "");
			$this->entered			= ($row["entered"])			? $row["entered"]		: ($this->entered		? $this->entered		: "");
			$this->username			= ($row["username"])		? $row["username"]		: ($this->username		? $this->username		: "");
			$this->password			= ($row["password"])		? $row["password"]		: ($this->password		? $this->password		: "");
			$this->permission		= ($row["permission"])		? $row["permission"]	: ($this->permission	? $this->permission		: 0);
			$this->name				= ($row["name"])			? $row["name"]			: "";
			$this->phone			= ($row["phone"])			? $row["phone"]			: "";
			$this->email			= ($row["email"])			? $row["email"]			: "";
			$this->iprestriction	= ($row["iprestriction"])	? $row["iprestriction"]	: ($this->iprestriction	? $this->iprestriction	: "");
			$this->selected_items =  ($row["selected_items"])	? $row["selected_items"]: "";
			
		}


		function fillLocation($id){
			
		/*	$db = db_getDBObject();
			$sql = "SELECT * FROM Contact_Location WHERE contact_id = $id";
			$location = mysql_fetch_array($db->query($sql));
			echo "<script>";
			echo "merda";
				foreach ($location as $row){
	
					echo "$(\"#chb-\"+".$row['city_id'].").attr(\"checked\",dtnode.isSelected()).addClass(\"hidden\");";
				}
			echo "});";
			echo "</script>"; */
						
		}

		function Save() {
				$dbObj = db_getDBObject();
				$sql_delete_location = "DELETE from Contact_Location where contact_id = '$this->id'";
				$dbObj->query($sql_delete_location);
				$number_of_selected_items = count($this->selected_items);
						for ($i = 0; $i < $number_of_selected_items; $i++){
							if (strlen($this->selected_items[$i]) > 3) {
								$sql_insert_location = "Insert into Contact_Location values('".$this->id."', '".$this->selected_items[$i]."');";
							 	$dbObj->query($sql_insert_location);			
							
								}
							} 
			$insert_password = $this->password;
			$this->prepareToSave();
			
			if ($this->id) {
				$sql  = "UPDATE SMAccount SET"
					. " updated       = NOW(),"
					. " username      = $this->username,"
					. " permission    = $this->permission,"
					. " iprestriction = $this->iprestriction,"
					. " name          = $this->name,"
					. " phone         = $this->phone,"
					. " email         = $this->email"
					. " WHERE id      = $this->id";
				$dbObj->query($sql);

			} else {
				$sql = "INSERT INTO SMAccount"
					. " ("
					. " updated,"
					. " entered,"
					. " username,"
					. " password,"
					. " permission,"
					. " iprestriction,"
					. " name,"
					. " phone,"
					. " email"
					. " )"
					. " VALUES"
					. " ("
					. " NOW(),"
					. " NOW(),"
					. " $this->username,"
					. " ".db_formatString(md5($insert_password)).","
					. " $this->permission,"
					. " $this->iprestriction,"
					. " $this->name,"
					. " $this->phone,"
					. " $this->email"
					. " )";
				$dbObj->query($sql);
				$this->id = mysql_insert_id($dbObj->link_id);
			}
		//$this->prepareToUse();


		}

		function updatePassword() {
			$dbObj = db_getDBObject();
			$sql = "UPDATE SMAccount SET password = ".db_formatString(md5($this->password))." WHERE id = $this->id";
			$dbObj->query($sql);
		}

		function Delete() {
			$dbObj = db_getDBObject();
			$sql = "DELETE FROM SMAccount WHERE id = $this->id";
			$dbObj->query($sql);
		}

	}

?>
