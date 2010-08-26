<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classes/class_content.php
	# ----------------------------------------------------------------------------------------------------

	class Content extends Handle {

		var $id;
		var $updated;
		var $type;
		var $title;
		var $description;
		var $keywords;
		var $url;
		var $content;
		var $section;
		var $lang;
		var $sitemap;

		function Content($var='', $lang=EDIR_DEFAULT_LANGUAGE) {
			$this->lang = $lang;
			if (is_numeric($var) && ($var)) {
				$db = db_getDBObject();
				$sql = "SELECT * FROM Content WHERE id = $var";
				if ($lang != EDIR_DEFAULT_LANGUAGE) {
					$sql = "SELECT c.section, c.type, l.* FROM Content c, Content_Lang l WHERE c.id=l.id AND l.id = $var AND l.lang='$this->lang'";
				}
				$row = mysql_fetch_array($db->query($sql));
				$row['id'] = $var;
				$this->makeFromRow($row);
			} else {
				$this->makeFromRow($var);
			}
		}

		function makeFromRow($row='') {

			$this->id			= ($row['id'])			? $row['id']			: 0;
			$this->updated		= ($row['updated'])		? $row['updated']		: 0;
			$this->type			= ($row['type'])		? $row['type']			: "";
			$this->title		= ($row['title'])		? $row['title']			: "";
			$this->description	= ($row['description'])	? $row['description']	: "";
			$this->keywords		= ($row['keywords'])	? $row['keywords']		: "";
			$this->url			= ($row['url'])			? $row['url']			: "";
			$this->section		= ($row['section'])		? $row['section']		: "";
			$this->content		= ($row['content'])		? $row['content']		: "";
			$this->sitemap		= ($row['sitemap'])		? 1						: 0;

		}

		function Save() {

			$langaux = $this->lang;

			$this->prepareToSave();

			$dbObj = db_getDBObject();

			if ($this->id) {

				if ($langaux != EDIR_DEFAULT_LANGUAGE) {

					$sql    = "SELECT * FROM Content_Lang WHERE lang=$this->lang AND id=$this->id";
					$verify = $dbObj->query($sql);

					if (!mysql_numrows($verify)) {

						$sql =	"INSERT INTO Content_Lang"
								. " (id,"
								. " title,"
								. " description,"
								. " keywords,"
								. " lang,"
								. " content)"
								. " VALUES"
								. " ($this->id,"
								. " $this->title,"
								. " $this->description,"
								. " $this->keywords,"
								. " $this->lang,"
								. " $this->content)";

					} else {

						$sql =	"UPDATE Content_Lang SET"
								. " updated = NOW(),"
								. " title = $this->title,"
								. " description = $this->description,"
								. " keywords = $this->keywords,"
								. " content = $this->content"
								. " WHERE id = $this->id AND lang = $this->lang";

					}

					$dbObj->query($sql);

				} else {

					$sql =	"UPDATE Content SET"
							. " updated = NOW(), "
							. " type = $this->type,"
							. " title = $this->title,"
							. " description = $this->description,"
							. " keywords = $this->keywords,"
							. " url = $this->url,"
							. " section  = $this->section,"
							. " content = $this->content,"
							. " sitemap = $this->sitemap"
							. " WHERE id = $this->id";
					$dbObj->query($sql);

				}

			} else {

					$sql =	"INSERT INTO Content"
							. " (type, "
							. " title, "
							. " description, "
							. " keywords, "
							. " url, "
							. " section, "
							. " content, "
							. " sitemap)"
							. " VALUES"
							. " ($this->type,"
							. " $this->title,"
							. " $this->description,"
							. " $this->keywords,"
							. " $this->url,"
							. " $this->section,"
							. " $this->content,"
							. " $this->sitemap)";

					$dbObj->query($sql);
					$this->id = mysql_insert_id($dbObj->link_id);

			}

			$this->prepareToUse();

		}

		function Delete() {

			$dbObj = db_getDBObJect();
			$sql = "DELETE FROM Content WHERE id = $this->id";
			$dbObj->query($sql);

		}

		function isRepeated(){
			$dbObj = db_getDBObJect();
			$sql = "SELECT * FROM Content WHERE type = ".db_formatString($this->type)."";
			if($this->id) $sql .= " AND id != $this->id";
			$result = $dbObj->query($sql);
			$row = mysql_fetch_assoc($result);
			if ($row) return true; else return false;
		}

		function isRepeatedURL() {
			$dbObj = db_getDBObJect();
			$sql = "SELECT * FROM Content WHERE url = ".db_formatString($this->url)."";
			if($this->id) $sql .= " AND id != $this->id";
			$result = $dbObj->query($sql);
			$row = mysql_fetch_assoc($result);
			if ($row) return true; else return false;
		}

		function retrieveAllContents(){
			$dbObj = db_getDBObJect();
			$sql = "SELECT * FROM Content ORDER BY type";
			$result = $dbObj->query($sql);
			while($row = mysql_fetch_assoc($result)) $data[] = $row;
			if ($data) return $data; else return false;
		}

		function retrieveIDByType($contenttype){
			$dbObj = db_getDBObJect();
			$sql = "SELECT id FROM Content WHERE type = ".db_formatString($contenttype)."";
			$result = $dbObj->query($sql);
			$row = mysql_fetch_assoc($result);
			if ($row) return $row["id"]; else return false;
		}

		function retrieveIDByURL($contenturl){
			if (!$contenturl) return false;
			$dbObj = db_getDBObJect();
			$sql = "SELECT id FROM Content WHERE url = ".db_formatString($contenturl)."";
			$result = $dbObj->query($sql);
			$row = mysql_fetch_assoc($result);
			if ($row) return $row["id"]; else return false;
		}

		function retrieveContentByType($contenttype){
			$dbObj = db_getDBObJect();
			if ($this->lang == EDIR_DEFAULT_LANGUAGE) {
				$sql = "SELECT content FROM Content WHERE type = ".db_formatString($contenttype)."";
			} else {
				$sql = "SELECT Content_Lang.content FROM Content, Content_Lang WHERE Content.id = Content_Lang.id AND Content.type = ".db_formatString($contenttype)." AND Content_Lang.lang = ".db_formatString($this->lang)."";
			}
			$result = $dbObj->query($sql);
			$row = mysql_fetch_assoc($result);
			if ($row) return $row["content"]; else return false;
		}

		function retrieveContentByURL($contenturl){
			if (!$contenturl) return false;
			$dbObj = db_getDBObJect();
			if ($this->lang == EDIR_DEFAULT_LANGUAGE) {
				$sql = "SELECT content FROM Content WHERE url = ".db_formatString($contenturl)."";
			} else {
				$sql = "SELECT Content_Lang.content FROM Content, Content_Lang WHERE Content.id = Content_Lang.id AND url = ".db_formatString($contenturl)." AND Content_Lang.lang = ".db_formatString($this->lang)."";
			}
			$result = $dbObj->query($sql);
			$row = mysql_fetch_assoc($result);
			if ($row) return $row["content"]; else return false;
		}

		function retrieveContentInfoByType($contenttype){
			$dbObj = db_getDBObJect();
			if ($this->lang == EDIR_DEFAULT_LANGUAGE) {
				$sql = "SELECT * FROM Content WHERE type = ".db_formatString($contenttype)."";
			} else {
				$sql = "SELECT Content.*, Content_Lang.* FROM Content, Content_Lang WHERE Content.id = Content_Lang.id AND Content.type = ".db_formatString($contenttype)." AND Content_Lang.lang = ".db_formatString($this->lang)."";
			}
			$result = $dbObj->query($sql);
			$row = mysql_fetch_assoc($result);
			if ($row) return $row; else return false;
		}

		function retrieveContentInfoByURL($contenturl){
			if (!$contenturl) return false;
			$dbObj = db_getDBObJect();
			if ($this->lang == EDIR_DEFAULT_LANGUAGE) {
				$sql = "SELECT * FROM Content WHERE url = ".db_formatString($contenturl)."";
			} else {
				$sql = "SELECT Content.*, Content_Lang.* FROM Content, Content_Lang WHERE Content.id = Content_Lang.id AND url = ".db_formatString($contenturl)." AND Content_Lang.lang = ".db_formatString($this->lang)."";
			}
			$result = $dbObj->query($sql);
			$row = mysql_fetch_assoc($result);
			if ($row) return $row; else return false;
		}

	}

?>
