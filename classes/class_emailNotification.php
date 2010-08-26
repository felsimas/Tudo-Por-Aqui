<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classes/class_emailNotification.php
	# ----------------------------------------------------------------------------------------------------

	class EmailNotification extends Handle {

		var $id;
		var $email;
		var $days;
		var $deactivate;
		var $updated;
		var $bcc;
		var $about;
		var $subject;
		var $content_type;
		var $body;
		var $lang;

		function EmailNotification($var="", $lang=EDIR_DEFAULT_LANGUAGE) {
			$this->lang = $lang;
			if (is_numeric($var) && ($var)) {
				$db = db_getDBObject();
				if ($lang != EDIR_DEFAULT_LANGUAGE) {
					$sql = "SELECT e.email, e.days, e.deactivate, e.bcc, e.about, e.content_type, l.* FROM Email_Notification e, Email_Notification_Lang l WHERE e.id=l.id AND l.id = $var AND l.lang='$this->lang'";
				} else {
					$sql = "SELECT * FROM Email_Notification WHERE id = $var";
				}
				$result = $db->query($sql);
				$row = mysql_fetch_array($result);
				$row["id"] = ($row["id"]) ? $row["id"] : $var;
				$this->makeFromRow($row);
			} else {
				$this->makeFromRow($var);
			}
		}

		function makeFromRow($row="") {
			$this->id           = ($row["id"])           ? $row["id"]           : ($this->id           ? $this->id           : 0);
			$this->email        = ($row["email"])        ? $row["email"]        : "";
			$this->days         = ($row["days"])         ? $row["days"]         : ($this->days         ? $this->days         : 0);
			$this->deactivate   = ($row["deactivate"])   ? $row["deactivate"]   : 0;
			$this->updated      = ($row["updated"])      ? $row["updated"]      : "";
			$this->bcc          = ($row["bcc"])          ? $row["bcc"]          : "";
			$this->about        = ($row["about"])        ? $row["about"]        : ($this->about        ? $this->about        : "");
			$this->subject      = ($row["subject"])      ? $row["subject"]      : ($this->subject      ? $this->subject      : "");
			$this->content_type = ($row["content_type"]) ? $row["content_type"] : ($this->content_type ? $this->content_type : "");
			$this->body         = ($row["body"])         ? $row["body"]         : ($this->body         ? $this->body         : "");
		}

		function Save() {

			$dbObj = db_getDBObject();

			$langaux = $this->lang;

			$this->prepareToSave();

			if ($this->id) {

				if ($langaux != EDIR_DEFAULT_LANGUAGE) {

					$sql  = "SELECT * FROM Email_Notification_Lang WHERE lang=$this->lang AND id=$this->id";

					$verify = $dbObj->query($sql);

					if (mysql_numrows($verify) < 1) {

						$sql =	"INSERT INTO Email_Notification_Lang"
								. " (id, "
								. " lang, "
								. " subject, "
								. " body) "
								. " VALUES"
								. " ($this->id,"
								. " $this->lang,"
								. " $this->subject,"
								. " $this->body)";

					} else {

						$sql =	"UPDATE Email_Notification_Lang SET"
								. " updated  = NOW(),"
								. " subject  = $this->subject,"
								. " body     = $this->body"
								. " WHERE id = $this->id AND lang = $this->lang";

					}

					$dbObj->query($sql);

				} else {

					$sql = "UPDATE Email_Notification SET"
					. " email        = $this->email,"
					. " days         = $this->days,"
					. " deactivate   = $this->deactivate,"
					. " updated      = NOW(),"
					. " bcc          = $this->bcc,"
					. " about        = $this->about,"
					. " subject      = $this->subject,"
					. " content_type = $this->content_type,"
					. " body         = $this->body"
					. " WHERE id     = $this->id";

					$dbObj->query($sql);

				}

			} else {

				$sql = "INSERT INTO Email_Notification"
					. " ("
					. " email,"
					. " days,"
					. " deactivate,"
					. " updated,"
					. " bcc,"
					. " about,"
					. " subject,"
					. " content_type,"
					. " body"
					. " )"
					. " VALUES"
					. " ("
					. " $this->email,"
					. " $this->days,"
					. " $this->deactivate,"
					. " NOW(),"
					. " $this->bcc,"
					. " $this->about,"
					. " $this->subject,"
					. " $this->content_type,"
					. " $this->body"
					. " )";

				$dbObj->query($sql);

				$this->id = mysql_insert_id($dbObj->link_id);

			}

			$this->prepareToUse();

		}

		function restoreSubject() {
			
			$dbObj = db_getDBObject();
			$sql = "SELECT subject FROM Email_Notification_Default WHERE id = ".$this->id;
			$result = $dbObj->query($sql);

			if (mysql_numrows($result) > 0) {
				return mysql_result($result, 0, "subject");
			}

			return "";

		}

		function restoreBody($type="text") {

			$dbObj = db_getDBObject();
			$sql = "SELECT body_$type FROM Email_Notification_Default WHERE id = ".$this->id;
			$result = $dbObj->query($sql);

			if (mysql_numrows($result) > 0) {
				return mysql_result($result, 0, "body_$type");
			}

			return "";

		}

	}

?>
