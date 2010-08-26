<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classes/class_account.php
	# ----------------------------------------------------------------------------------------------------

	class Account extends Handle {

		var $id;
		var $entered;
		var $updated;
		var $agree_tou;
		var $lastlogin;
		var $username;
		var $password;
		var $foreignaccount;
		var $foreignaccount_done;

		function Account($var='') {
			if (is_numeric($var) && ($var)) {
				$db = db_getDBObject();
				$sql = "SELECT * FROM Account WHERE id = $var";
				$row = mysql_fetch_array($db->query($sql));
				$this->makeFromRow($row);
			} else {
				$this->makeFromRow($var);
			}
		}

		function makeFromRow($row='') {
			if ($row['id']) $this->id = $row['id'];
			else if (!$this->id) $this->id = 0;
			if ($row['entered']) $this->entered = $row['entered'];
			else if (!$this->entered) $this->entered = 0;
			if ($row['updated']) $this->updated = $row['updated'];
			else if (!$this->updated) $this->updated = 0;
			if ($row['agree_tou']) $this->agree_tou = $row['agree_tou'];
			else if (!$this->agree_tou) $this->agree_tou = 0;
			if ($row['lastlogin']) $this->lastlogin = $row['lastlogin'];
			else if (!$this->lastlogin) $this->lastlogin = 0;
			if ($row['username']) $this->username = $row['username'];
			else if (!$this->username) $this->username = "";
			if ($row['password']) $this->password = $row['password'];
			else if (!$this->password) $this->password = "";
			if ($row['foreignaccount']) $this->foreignaccount = $row['foreignaccount'];
			else if (!$this->foreignaccount) $this->foreignaccount = "n";
			if ($row['foreignaccount_done']) $this->foreignaccount_done = $row['foreignaccount_done'];
			else if (!$this->foreignaccount_done) $this->foreignaccount_done = "n";
		}

		function Save() {
			$insert_password = $this->password;
			$this->prepareToSave();
			$dbObj = db_getDBObject();
			if ($this->id) {
				$sql  = "UPDATE Account SET"
					. " updated = NOW(),"
					. " username = $this->username,"
					. " foreignaccount = $this->foreignaccount,"
					. " foreignaccount_done = $this->foreignaccount_done"
					. " WHERE id = $this->id";
				$dbObj->query($sql);
			} else {
				$sql = "INSERT INTO Account"
					. " (entered, updated, agree_tou, username, password, foreignaccount, foreignaccount_done)"
					. " VALUES"
					. " (NOW(), NOW(), $this->agree_tou, $this->username, ".db_formatString(((strtolower(PASSWORD_ENCRYPTION) == "on") ? md5($insert_password) : $insert_password)).", $this->foreignaccount, $this->foreignaccount_done)";
				$dbObj->query($sql);
				$this->id = mysql_insert_id($dbObj->link_id);
			}
			$this->prepareToUse();
		}

		function updateLastLogin() {
			$dbObj = db_getDBObject();
			$sql = "UPDATE Account SET lastlogin = NOW() WHERE id = $this->id";
			$dbObj->query($sql);
		}

		function updatePassword() {
			$dbObj = db_getDBObject();
			$sql = "UPDATE Account SET updated = NOW(), password = ".db_formatString(((strtolower(PASSWORD_ENCRYPTION) == "on") ? md5($this->password) : $this->password))." WHERE id = $this->id";
			$dbObj->query($sql);
		}

		function setForeignAccountAuth($auth) {
			$dbObj = db_getDBObject();
			$sql = "UPDATE Account SET foreignaccount_auth = ".db_formatString($auth)." WHERE id = $this->id";
			$dbObj->query($sql);
		}

		function setForeignAccountRedirect($redirect) {
			$dbObj = db_getDBObject();
			$sql = "UPDATE Account SET foreignaccount_redirect = ".db_formatString($redirect)." WHERE id = $this->id";
			$dbObj->query($sql);
		}

		function getForeignAccountRedirect() {
			$redirect = "";
			$dbObj = db_getDBObject();
			$sql = "SELECT foreignaccount_redirect FROM Account WHERE id = $this->id";
			$result = $dbObj->query($sql);
			$row = mysql_fetch_assoc($result);
			if ($row["foreignaccount_redirect"]) $redirect = $row["foreignaccount_redirect"];
			return $redirect;
		}

		function Delete() {

			/**
			* Contact cascade
			**/
			$sql = "SELECT * FROM Contact WHERE account_id = $this->id";
			$contactObj = db_getFromDBBySQL("contact", $sql, "object");
			foreach ($contactObj as $each_contact) $each_contact->Delete();

			/**
			* Listing cascade
			**/
			$sql = "SELECT * FROM Listing WHERE account_id = $this->id";
			$ListingObj = db_getFromDBBySQL("listing", $sql, "object");
			foreach ($ListingObj as $each_listing) $each_listing->Delete();

			/**
			* Gallery cascade
			**/
			$sql = "SELECT * FROM Gallery WHERE account_id = $this->id";
			$GalleryObj = db_getFromDBBySQL("gallery", $sql, "object");
			foreach ($GalleryObj as $each_gallery) $each_gallery->Delete();

			/**
			* Promotion cascade
			**/
			$sql = "SELECT * FROM Promotion WHERE account_id = $this->id";
			$promotionObj = db_getFromDBBySQL("promotion", $sql, "object");
			foreach ($promotionObj as $each_promotion) $each_promotion->Delete();

			/**
			* Event cascade
			**/
			$sql = "SELECT * FROM Event WHERE account_id = $this->id";
			$eventObj = db_getFromDBBySQL("event", $sql, "object");
			foreach ($eventObj as $each_event) $each_event->Delete();

			/**
			* Banner cascade
			**/
			$sql = "SELECT * FROM Banner WHERE account_id = $this->id";
			$bannerObj = db_getFromDBBySQL("banner", $sql, "object");
			foreach ($bannerObj as $each_banner) $each_banner->Delete();

			/**
			* Classified cascade
			**/
			$sql = "SELECT * FROM Classified WHERE account_id = $this->id";
			$ClassifiedObj = db_getFromDBBySQL("classified", $sql, "object");
			foreach ($ClassifiedObj as $each_classified) $each_classified->Delete();

			/**
			* Article cascade
			**/
			$sql = "SELECT * FROM Article WHERE account_id = $this->id";
			$articleObj = db_getFromDBBySQL("article", $sql, "object");
			foreach ($articleObj as $each_article) $each_article->Delete();

			/**
			* Custom invoice
			**/
			$sql = "SELECT * FROM CustomInvoice WHERE account_id = $this->id";
			$custominvoiceObj = db_getFromDBBySQL("custominvoice", $sql, "object");
			foreach ($custominvoiceObj as $each_custominvoice) $each_custominvoice->Delete();

			/**
			* ForgotPassword cascade
			**/
			$dbObj = db_getDBObject();
			$sql = "DELETE FROM Forgot_Password WHERE account_id = $this->id";
			$dbObj->query($sql);

			/**
			* Invoice
			**/
			$dbObj = db_getDBObject();
			$sql = "UPDATE Invoice SET account_id = '0' WHERE account_id = $this->id";
			$dbObj->query($sql);

			/**
			* Payment_Log
			**/
			$dbObj = db_getDBObject();
			$sql = "UPDATE Payment_Log SET account_id = '0' WHERE account_id = $this->id";
			$dbObj->query($sql);

			/**
			* Claim
			**/
			$dbObj = db_getDBObject();
			$sql = "UPDATE Claim SET status = 'incomplete' WHERE account_id = $this->id AND status = 'progress'";
			$dbObj->query($sql);
			$sql = "UPDATE Claim SET account_id = '0' WHERE account_id = $this->id";
			$dbObj->query($sql);

			/**
			* Deleting this object
			**/
			$dbObj = db_getDBObject();
			$sql = "DELETE FROM Account WHERE id = $this->id";
			$dbObj->query($sql);

		}

		function getCustomInvoicesNumber() {
			$dbObj = db_getDBObject();
			$sql = "SELECT COUNT(id) as custom_invoice_number FROM CustomInvoice WHERE account_id = $this->id AND paid != 'y' AND sent = 'y'";
			$r = $dbObj->query($sql);
			$row = mysql_fetch_assoc($r);
			if ($row["custom_invoice_number"]) return $row["custom_invoice_number"];
			else return false;
		}

	}

?>
