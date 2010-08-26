<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classes/class_export.php
	# ----------------------------------------------------------------------------------------------------

	/**
	 * class used to export listings, classifieds, banners, articles, accounts, events.
	 * @author Rafael Guarinon
	 * @version 1.0
	 * @name Export
	 * @since 02/01/2007 
	 * TODO: when merging an export there's an issue with fields with the same name in both tables.
	 */
	class Export extends Handle {

		/**
		 * Class attributes
		 *
		 * @var string table
		 * @var int limit
		 * @var int offset
		 * @var int file_num
		 * @var int total_files
		 * @var string file_name
		 * @var string file_ext
		 * @var array excluded_fields
		 * @var string is_zipped
		 * @var string export_path
		 * @var int total data
		 * @var merge_export
		 * @var merge_where
		 */
		
		var $table;
		var $primary;
		var $limit;
		var $offset;
		var $file_num;
		var $total_files;
		var $file_name;
		var $file_ext;
		var $excluded_fields = array();
		var $is_zipped;
		var $export_path;
		var $total_data;
		var $merge_export;
		var $merge_where;

		/**
		 * Class constructor
		 *
		 * @param string $table
		 * @param boolean zipped
		 * @return Export object
		 * @author Rafael Guarinon
	 	 * @version 1.0
	 	 * @name Export
	 	 * @since 02/01/2007
		 * 
		 */
		function Export($table, $zipped = true, $file_name = "") {

			if ($table) {
				// initial parameters
				$this->table        = $table;
				$this->primary		= "id";
				$this->offset       = $this->getDefaultOffset($this->table);
				if ($file_name != "") {
					$this->file_name    = $file_name;
				} else {
					$this->file_name    = strtolower($table);
				}
				$this->file_ext     = $this->getDefaultFileExt();
				$this->is_zipped    = $this->getDefaultIsZipped();
				$this->export_path  = $this->getDefaultPath();
				$this->is_zipped    = $zipped;
				$this->merge_export = false;
			}

		}

		/**
		 * Class method => exportFieldTreatment (removes some chars from the values)
		 *
		 * @param string/int $field
		 * @return $value
		 * @author Rafael Guarinon
	 	 * @version 1.0
	 	 * @name Export
	 	 * @since 02/01/2007
		 */
		function exportFieldTreatment($field) {

			if ($field) {
				$value = str_replace("\n","",$field);
				$value = str_replace("\r","",$field);
				//$value = addslashes($value);
				return $value;
			} else {
				return false;
			}
		}

		/**
		 * Class method => generateExportData (generates the export data and saves it to a xls file)
		 *
		 * @return boolean true/false
		 * @author Rafael Guarinon
	 	 * @version 1.0
	 	 * @name generateExportData
	 	 * @since 02/01/2007
		 */
		function generateExportData() {

			// database object
			$dbObj = db_getDBObject();

			// total data
			$this->total_data = $dbObj->getRowCount($this->table);

			// total files => total_data/offset
			$this->total_files = ceil($this->total_data / $this->offset);

			if ($this->total_data > 0) {

				if ($this->file_num < $this->total_files) {

					// limit => file_num * offset
					$this->limit = $this->file_num * $this->offset;

					// query
					if ($this->merge_export == false)
						$sql = "SELECT * FROM ".$this->table." WHERE 1 ORDER BY $this->primary LIMIT ".$this->limit.", ".$this->offset;
					else
						$sql = $this->generateMergeSQL();

					$result = $dbObj->query($sql);

					$export_data = array();
					$line = 0;

					// xls class object
					$xlsObj = new xlsGenerator();
					// xls path
					$xlsObj->default_dir = $this->export_path;

					// reading array and filling xls in
					while ($row = mysql_fetch_assoc($result)) {
						// xls header
						if($lin == 0) {
							$header_fields = $this->getHeader();
							$x = 0;
							foreach($header_fields as $each_header_field)
								$xlsObj->WriteText_pos(0,$x++,$each_header_field);
							$lin++;
						}
						$j=0;
						// xls content
						foreach($row as $key => $value) {
							// verifying excluded fields
							if (!in_array(strtolower($key), $this->excluded_fields)) {
								// value correction
								$value = $this->getValueByKey($key, $value);
								$value = $this->exportFieldTreatment($value);
								$xlsObj->WriteText_pos($lin,$j++,$value);
							}
						}
						$lin++;
					}
					// saving file
					$xlsObj->SaveFile($this->file_name."_".$this->file_num.".".$this->file_ext);

					return true;
				}

				return false;
			}

			return false;
		}

		/**
		 * Class method => generateMergeSQL (generates the export sql for merge exports)
		 *
		 * @return string sql
		 * @author Rafael Guarinon
	 	 * @version 1.0
	 	 * @name generateMergeSQL
	 	 * @since 02/09/2007
		 */
		function generateMergeSQL() {

			if ($this->merge_export) {

				$sql = "SELECT * FROM ".$this->table.", ".$this->merge_export." WHERE ".(($this->merge_where) ? $this->merge_where : "1")." ORDER BY $this->primary LIMIT ".$this->limit.", ".$this->offset;

				return $sql;
			}
		}

		/**
		 * Class method => getDefaultFileExt (retrieves default file extension for the export file)
		 *
		 * @return string file extension
		 * @author Rafael Guarinon
	 	 * @version 1.0
	 	 * @name getDefaultFileExt
	 	 * @since 02/01/2007
		 */
		function getDefaultFileExt() {

			return DEFAULT_EXPORT_EXTENSION;

		}

		/**
		 * Class method => getDefaultIsZipped (retrieves default is zipped property)
		 *
		 * @return string is zipped
		 * @author Rafael Guarinon
	 	 * @version 1.0
	 	 * @name getDefaultIsZipped
	 	 * @since 02/01/2007
		 */
		function getDefaultIsZipped() {

			return DEFAULT_EXPORT_ZIPPED;
		}

		/**
		 * Class method => getDefaultPath (retrieves default file extension for the export file)
		 *
		 * @return string file path
		 * @author Rafael Guarinon
	 	 * @version 1.0
	 	 * @name getDefaultPath
	 	 * @since 02/01/2007
		 */
		function getDefaultPath() {

			return EDIRECTORY_ROOT."/custom";

		}
		
		/**
		 * Class method => getDefaultOffset (retrieves the offset for the selected table)
		 *
		 * @param string table
		 * @return int offset value
		 * @author Rafael Guarinon
	 	 * @version 1.0
	 	 * @name getDefaultOffset
	 	 * @since 02/01/2007
		 */
		function getDefaultOffset($table) {

			$table_name = trim(strtoupper($table));
			if (defined($table_name."_LIMIT")) {
				$constant_value = constant($table_name."_LIMIT");
			} else {
				$constant_value	= 10000;
			}

			if ($constant_value) {
				return $constant_value;
			} else {
				return false;
			}
		}

		/**
		 * Class method => setExcludedField (add a field to be excluded during the export)
		 * @param string field
		 * @author Rafael Guarinon
	 	 * @version 1.0
	 	 * @name setExcludedField
	 	 * @since 02/01/2007
		 */
		function setExcludedField($field) {

			if (strpos($field, ",") !== false) {
				$fieldArray = explode(",", $field);
				foreach ($fieldArray as $each_field) {
					$this->excluded_fields[] = (string)trim(strtolower($each_field));
				}
			} else {
				$this->excluded_fields[] = (string)trim(strtolower($field));
			}
		}

		/**
		 * Class method => getHeader (returns the xls header)
		 *
		 * @return array header_fields
		 * @author Rafael Guarinon
	 	 * @version 1.0
	 	 * @name getHeader
	 	 * @since 02/01/2007
		 */
		function getHeader() {

			$dbObj = db_getDBObject();
			// select fields from table
			if ($this->merge_export == false) {
				$sql = "SHOW FIELDS FROM ".$this->table;
				$r   = $dbObj->query($sql);
				while ($row = mysql_fetch_assoc($r)) $fields[] = $row;
			} else {
				$sql  = "SHOW FIELDS FROM ".$this->table;
				$r    = $dbObj->query($sql);
				while ($row = mysql_fetch_assoc($r)) $fields[] = $row;

				$sql2 = "SHOW FIELDS FROM ".$this->merge_export;
				$r2	  = $dbObj->query($sql2);
				while ($row2 = mysql_fetch_assoc($r2)) $fields[] = $row2;
			}

			if ($fields) {
				foreach ($fields as $each_field)  {
					//if field is not an excluded one
					$each_field["Field"] = (string)trim(strtolower($each_field["Field"]));
					if (!in_array($each_field["Field"], $this->excluded_fields)) {
						// name verification
						switch ($each_field["Field"]) {
							case "account_id"			:	$each_field["Field"] = "Account"; 									break;
							case "estado_id"			:	$each_field["Field"] = "Country"; 									break;
							case "cidade_id"				:	$each_field["Field"] = "State"; 									break;
							case "bairro_id"			:	$each_field["Field"] = "City"; 										break;
							case "renewal_date"			:	$each_field["Field"] = "Renewal Date"; 								break;
							case "expiration_date"		:	$each_field["Field"] = "Expiration Date";							break;
							case "summarydesc"			:	$each_field["Field"] = "Summary Description";						break;
							case "contact_name"			:	$each_field["Field"] = "Contact Name";								break;
							case "zip_code"				:	$each_field["Field"] = ucwords(ZIPCODE_LABEL);						break;
							case "friendly_url"			:	$each_field["Field"] = "Friendly Url";								break;
							case "display_url"			:	$each_field["Field"] = "Display Url";								break;
							case "publication_date"		:	$each_field["Field"] = "Publication Date";							break;
							case "image_caption"		:	$each_field["Field"] = "Image Caption";								break;
							case "target_window"		:	$each_field["Field"] = "Target Window";								break;
							case "content_line1"		:	$each_field["Field"] = "Content Line 1";							break;
							case "content_line2"		:	$each_field["Field"] = "Content Line 2";							break;
							case "unpaid_impressions"	:	$each_field["Field"] = "Unpaid Impressions";						break;
							default						:	$each_field["Field"] = ucwords(strtolower($each_field["Field"]));
						}
						$header_fields[] = $each_field["Field"];
					}
				}
				// returns array
				if ($header_fields) {
					return $header_fields;
				} else {
					return false;
				}
			}
		}

		/**
		 * Class method => getValuesByKey (returns some specific values like country name, account username, etc)
		 *
		 * @param string key
		 * @param string/int value
		 * @return string/int value
		 * @author Rafael Guarinon
	 	 * @version 1.0
	 	 * @name getValuesByKey
	 	 * @since 02/01/2007
		 */
		function getValueByKey($key, $value) {

			if ($key) {

				$dbObj = db_getDBObject();

				switch ($key) {

					case "account_id" :
						$sql = "SELECT username FROM Account WHERE id = $value";
						$r   = $dbObj->query($sql);
						$row = mysql_fetch_assoc($r);
						if ($row["username"]) return $row["username"];
						else return false;
						break;

					case "estado_id" :
						$sql = "SELECT name FROM Location_Country WHERE id = $value";
						$r   = $dbObj->query($sql);
						$row = mysql_fetch_assoc($r);
						if ($row["name"]) return $row["name"];
						else return false;
						break;

					case "cidade_id" :
						$sql = "SELECT name FROM Location_State WHERE id = $value";
						$r   = $dbObj->query($sql);
						$row = mysql_fetch_assoc($r);
						if ($row["name"]) return $row["name"];
						else return false;
						break;

					case "bairro_id" :
						$sql = "SELECT name FROM Location_Region WHERE id = $value";
						$r	 = $dbObj->query($sql);
						$row = mysql_fetch_assoc($r);
						if ($row["name"]) return $row["name"];
						else return false;
						break;

					case "type" :
						$sql = "SELECT name FROM BannerLevel WHERE value = $value";
						$r   = $dbObj->query($sql);
						$row = mysql_fetch_assoc($r);
						if ($row["name"]) return $row["name"];
						else return false;

					case "level" :
						if ($this->table == "Listing")			$levelObj = new ListingLevel();
						elseif ($this->table == "Event")		$levelObj = new EventLevel();
						elseif ($this->table == "Classified")	$levelObj = new ClassifiedLevel();
						elseif ($this->table == "Article")		$levelObj = new ArticleLevel();
						elseif ($this->table == "Banner")		$levelObj = new BannerLevel();
						return ucwords($levelObj->getLevel($value));
						break;

					case "status" :
						if ($this->table == "Listing")			$statusObj = new ItemStatus();
						elseif ($this->table == "Event")		$statusObj = new ItemStatus();
						elseif ($this->table == "Classified")	$statusObj = new ItemStatus();
						elseif ($this->table == "Article")		$statusObj = new ItemStatus();
						elseif ($this->table == "Banner")		$statusObj = new ItemStatus();
						elseif ($this->table == "Invoice")		return $value;
						return ucwords($statusObj->getStatus($value));
						break;

					default :
						return $value;
						break;
				}

			} else {
				return false;
			}

		}

		/**
		 * Class method => getZippedExportFile (zips the exported file)
		 *
		 * @param boolean force_download
		 * @param boolean remove_files
		 * @author Rafael Guarinon
	 	 * @version 1.0
	 	 * @name getExportedFile
	 	 * @since 02/01/2007
		 */
		function getExportedFile($force_download = true, $remove_files = true) {

			if ($this->total_files > 0 && $this->is_zipped == true) {

				$zipObj = new zipGenerator();
				
				$i=0;
				$eof = false;
				do {
					$file_name = $this->file_name."_".$i.".".$this->file_ext;
					if (file_exists($this->export_path."/".$file_name)) {
						$fileContents = file_get_contents($this->export_path."/".$file_name);
						$zipObj->addFile($fileContents, $file_name);
					} else {
						$eof = true;
					}
					$i++;
				} while (!$eof);

				$fileName = $this->export_path."/".$this->file_name.".zip";
				$fd = fopen ($fileName, "wb");
				$out = fwrite ($fd, $zipObj->getZippedfile());
				fclose ($fd);

				if ($force_download)
					$zipObj->forceDownload($fileName);

				if ($remove_files) {

					for ($l=0;$l<=$this->file_num;$l++) {
						$file_name = $this->export_path."/".$this->file_name."_".$l.".".$this->file_ext;
						@unlink($file_name);
					}

					@unlink($this->export_path."/".$this->file_name."s".".".$this->file_ext);
					@unlink($fileName);
				}
			}
		}

	} //end class