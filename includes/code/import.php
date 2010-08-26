<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/code/import.php
	# ----------------------------------------------------------------------------------------------------

	if ($fileupload) {
		if ($_FILES && $_FILES["file"]["name"]) {
			if ($_FILES["file"]["size"] <= (1100000*MAX_MB_FILE_SIZE_ALLOWED)) {
				$uploadObj =& new UploadFiles();
				foreach ($_FILES as $key => $file) {
					$uploadname = $file["name"];
					$name_check = explode(".", $uploadname);
					if (strtolower($name_check[count($name_check)-1]) == "csv") {
						$file_name = system_generateFileName().".csv";
						$supported_extensions = array("csv"=>"all");
						$uploadObj->set("name", $file_name);
						$uploadObj->set("type", $file["type"]);
						$uploadObj->set("tmp_name", $file["tmp_name"]);
						$uploadObj->set("error", $file["error"]);
						$uploadObj->set("size", $file["size"]);
						$uploadObj->set("max_file_size", (1100000*MAX_MB_FILE_SIZE_ALLOWED));
						$uploadObj->set("randon_name", false);
						$uploadObj->set("replace", true);
						$uploadObj->set("file_perm", 0444);
						$uploadObj->set("dst_dir", IMPORT_FOLDER);
						$uploadObj->set("supported_extensions", $supported_extensions);
						$result = $uploadObj->moveFileToDestination();
						if (!$result) {
							$errors = $uploadObj->get("msg");
							$messageErrorUpload = system_showText(LANG_SITEMGR_MSGERROR_ERRORUPLOADINGFILE)."<br />".$errors[$uploadObj->get("error_type")];
							$file = false;
						} else {
							$file = "uploadbybrowser";
							$importlog = new ImportLog();
							$importlog->setString("date", date("Y-m-d"));
							$importlog->setString("time", date("H:i:s"));
							$importlog->setString("filename", $uploadname);
							$importlog->setString("linesadded", "0");
							$importlog->setString("phisicalname", $file_name);
							$importlog->setString("status", "P");
							$importlog->setString("progress", "0%");
							$importlog->setString("totallines", "0");
							$importlog->setString("history", "");
							$importlog->Save();
							$importID = $importlog->getNumber("id");
							$importlog->setHistory(system_showText(LANG_SITEMGR_IMPORT_SUCCESSUPLOADED));
						}
					} else {
						$file = false;
						$messageErrorUpload = system_showText(LANG_SITEMGR_MSGERROR_ERRORUPLOADINGFILE)."<br />".system_showText(LANG_SITEMGR_MSGERROR_FILEEXTENSIONNOTALLOWED)."";
					}
				}
			} else {
				$file = false;
				$messageErrorUpload = system_showText(LANG_SITEMGR_MSGERROR_ERRORUPLOADINGFILE)."<br />".system_showText(LANG_SITEMGR_MSGERROR_MAXFILESIZEALLOWEDIS)." ".MAX_MB_FILE_SIZE_ALLOWED."MB";
			}
		} else {
			$file = false;
			$messageErrorUpload = system_showText(LANG_SITEMGR_MSGERROR_ERRORUPLOADINGFILE)."<br />".system_showText(LANG_SITEMGR_MSGERROR_FILENOTENTERED)."";
		}
	}

	if ($ftpupload) {
		if ($filename) {
			$name_check = explode(".", $filename);
			if (strtolower($name_check[count($name_check)-1]) == "csv") {
				$file = "uploadbyftp";
				$uploadname = $filename;
				$importlog = new ImportLog();
				$importlog->setString("date", date("Y-m-d"));
				$importlog->setString("time", date("H:i:s"));
				$importlog->setString("filename", $filename);
				$importlog->setString("linesadded", "0");
				$importlog->setString("phisicalname", $filename);
				$importlog->setString("status", "P");
				$importlog->setString("progress", "0%");
				$importlog->setString("totallines", "0");
				$importlog->setString("history", "");
				$importlog->Save();
				$importID = $importlog->getNumber("id");
				$importlog->setHistory(system_showText(LANG_SITEMGR_IMPORT_FILEUPLOADEDBYFTP));
			} else {
				$file = false;
				$messageErrorFTPUpload = system_showText(LANG_SITEMGR_ERROR).":<br />".system_showText(LANG_SITEMGR_MSGERROR_FILEEXTENSIONNOTALLOWED);
			}
		} else {
			$file = false;
			$messageErrorFTPUpload = system_showText(LANG_SITEMGR_ERROR).":<br />".system_showText(LANG_SITEMGR_MSGERROR_FILENOTENTERED);
		}
	}

	if ($file && $importID) {
		$import_stop = false;
		$importlogObj = new ImportLog($importID);
		$filename = IMPORT_FOLDER."/".$importlogObj->getString("phisicalname");
		$handle = fopen(EDIRECTORY_ROOT."/gerenciamento/import/edirectory_sample.csv", "r");
		$sample_header = fgets($handle);
		fclose($handle);
		if (file_exists($filename)) {
			if (!$handle = fopen($filename, "r")) {
				$import_stop = true;
				$importlogObj->setHistory(system_showText(LANG_SITEMGR_IMPORT_PROBLEMWITHIMPORTEDFILE)." (".$importlogObj->getString("phisicalname").").");
			}
			$imported_header = fgets($handle);
			if (!fclose($handle)) {
				$import_stop = true;
				$importlogObj->setHistory(system_showText(LANG_SITEMGR_IMPORT_PROBLEMWITHIMPORTEDFILE)." (".$importlogObj->getString("phisicalname").").");
			}
		} else {
			$import_stop = true;
			$importlogObj->setHistory(system_showText(LANG_SITEMGR_IMPORT_FILEDOESNOTEXISTS)." (".$importlogObj->getString("phisicalname").").");
		}
		if (!$import_stop) {
			$sample_header = explode(",", $sample_header);
			$imported_header = explode(",", $imported_header);
			unset($wrong_imported_header);
			unset($wrong_header_fields);
			if (count($sample_header) < count($imported_header)) {
				$import_stop = true;
				$wrong_imported_header = true;
			}
			for ($i = 0; $i < count($sample_header); $i++) {
				$sample_header[$i] = str_replace("\n\r", "", $sample_header[$i]);
				$sample_header[$i] = str_replace("\r\n", "", $sample_header[$i]);
				$sample_header[$i] = str_replace("\n", "", $sample_header[$i]);
				$sample_header[$i] = str_replace("\r", "", $sample_header[$i]);
				$imported_header[$i] = str_replace("\n\r", "", $imported_header[$i]);
				$imported_header[$i] = str_replace("\r\n", "", $imported_header[$i]);
				$imported_header[$i] = str_replace("\n", "", $imported_header[$i]);
				$imported_header[$i] = str_replace("\r", "", $imported_header[$i]);
				if ($sample_header[$i] != $imported_header[$i]) {
					$import_stop = true;
					$wrong_header_fields[] = ereg_replace("[^A-Za-z0-9 ]", "", $sample_header[$i]);
				}
			}
		}
		if ($import_stop) {
			if ($wrong_imported_header) {
				$importlogObj->setHistory(system_showText(LANG_SITEMGR_IMPORT_CSVHEADERDOESNOTMATCH));
			}
			if ($wrong_header_fields) {
				$importlogObj->setHistory(system_showText(LANG_SITEMGR_IMPORT_CSVHEADERDOESNOTMATCH_ATFIELDS)." ".implode(", ", $wrong_header_fields).".");
			}
			$filename = IMPORT_FOLDER."/".$importlogObj->getString("phisicalname");
			if (file_exists($filename)) {
				if (!@unlink($filename)) {
					$importlogObj->setHistory(system_showText(LANG_SITEMGR_IMPORT_PROBLEMWITHIMPORTEDFILE)." (".$importlogObj->getString("phisicalname").").");
				}
			}
			$importlogObj = new ImportLog($importID);
			$importlogObj->setString("status", "F");
			$importlogObj->setString("progress", "100%");
			$importlogObj->save();
		}
	}

	$levelObj = new ListingLevel();
	$levelvalues = $levelObj->getLevelValues();
	setting_get("import_from_export", $import_from_export);
	setting_get("import_enable_listing_active", $import_enable_listing_active);
	setting_get("import_defaultlevel", $import_defaultlevel);
	setting_get("import_sameaccount", $import_sameaccount);
	setting_get("import_account_id", $import_account_id);

?>
