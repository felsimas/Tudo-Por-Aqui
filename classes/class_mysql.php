<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classes/class_mysql.php
	# ----------------------------------------------------------------------------------------------------

	class mysql {

		function mysql($DB_KEY) {
			$this->_reset_properties();
			$this->SERVER_NAME = $_SERVER[SERVER_NAME];
			$this->PHP_SELF    = $_SERVER[PHP_SELF];
			$this->db_host  = constant("_".$DB_KEY."_HOST");
			$this->db_user  = constant("_".$DB_KEY."_USER");
			$this->db_pass  = constant("_".$DB_KEY."_PASS");
			$this->db_name  = constant("_".$DB_KEY."_NAME");
			$this->db_email = constant("_".$DB_KEY."_EMAIL");
			$this->db_debug = constant("_".$DB_KEY."_DEBUG");
			if ($this->db_debug == "display") {
				$this->db_debug = 1;
			} else {
				$this->db_debug = 0;
			}
			$this->link_id = @mysql_connect($this->db_host,$this->db_user,$this->db_pass);
			if ( $this->link_id ) {
				$this->db_name=$this->db_name;
				$this->select_db_name = mysql_select_db($this->db_name,$this->link_id);
				if ( !$this->select_db_name ) {
					$this->_handle_error("constructor: select_db",$this->db_debug);
				}
			} else {
				$this->_handle_error("constructor: mysql_connect",$this->db_debug);
			}
		}

	# ----------------------------------------------------------------------------------------------------
	# external methods
	# ----------------------------------------------------------------------------------------------------
		function query(&$query,$db_debug=0) {
			$db_debug = max($db_debug,$this->db_debug);
			$result=mysql_query($query,$this->link_id);
			if ( !$result ) {
				$this->_handle_error($query,$db_debug);
			}
			$this->result=$result;
			return $this->result;
		}

	# ----------------------------------------------------------------------------------------------------
	# convinence method - returns number of rows for a query
	# good for doing counts 
	# ----------------------------------------------------------------------------------------------------
		function numRowsQuery(&$query, $db_debug = 0) {
			$result = $this->query($query);
			return mysql_num_rows($result);
		}

		/* 
		 * optimized method. because the following query is code optmized in mysql for faster performance
		 * (see mysql docs)
		 */
		function getRowCount($table){
			$sql = "SELECT COUNT(*) as total FROM $table";
			$db = db_getDBObject();
			if($r = $db->query($sql)){
				$row = mysql_fetch_assoc($r);
				return $row["total"];
			}
		}

		function getRowCountSQL($sql){
			$db = db_getDBObject();
			if($r = $db->query($sql)){
				$row = mysql_fetch_array($r);
				return $row[0];
			}
		}

	# ----------------------------------------------------------------------------------------------------
	# internal methods
	# ----------------------------------------------------------------------------------------------------
		function _handle_error($query,$db_debug=0) {
			$db_debug   = max($db_debug,$this->db_debug);
			$to      = $this->db_email;
			$from    = "db_debug@".$this->SERVER_NAME;
			$subject = "ERROR: http://".$this->SERVER_NAME.$this->PHP_SELF;
			$message  = "\n\n$subject\n\n";
			$message .= "Query: $query\n\n";
			if ($this->link_id) {
				$message .= " Errno: ".mysql_errno($this->link_id)."\n";
				$message .= " Error: ".mysql_error($this->link_id)."\n";
			}
			$message .= "_SERVER data\n";
			$server_values = array('REMOTE_ADDR','REMOTE_PORT','SCRIPT_FILENAME','REQUEST_METHOD','QUERY_STRING','REQUEST_URI');
			while ( list($temp,$name)=each($server_values) ) {
				$message .= sprintf("%15s : %s\n",$name,$_SERVER[$name]);
			}
			if ($db_debug) {
				echo "<PRE>$message</PRE>\n";
			} else {
			   	echo $query." ".$db_debug." ".$message;
				$this->_mymail($to,$subject,$message,$from);
			}
		}

		function _reset_properties() {
			$this->SERVER_NAME    = "";
			$this->PHP_SELF       = "";
			$this->db_email       = "";
			$this->db_host        = "";
			$this->db_user        = "";
			$this->db_pass        = "";
			$this->db_name        = "";
			$this->db_debug       = "";
			$this->link_id        = "";
			$this->result         = "";
			$this->select_db_name = "";
		}

		function _mymail($to,$subject,$message,$from,$xheaders="") {
			$eDirMailerObj = new EDirMailer($to, $subject, $message, $from);
			if ($xheaders) $eDirMailerObj->setExtraHeaders($xheaders);
			return $eDirMailerObj->send();
		}

		function getMaxValue($table,$field) {
			$sql = "SELECT MAX($field) as max_value FROM $table";
			$r = $this->query($sql);
			$max_value_arr = mysql_fetch_assoc($r);
			if ($max_value_arr) return $max_value_arr["max_value"]; else return false;
		}

	}

?>
