<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/code/editor_choice.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	$message_editorchoice = "";
	$message_error_editorchoice = "";

	/**
	* Images upload
	****************************************************************************/
	$file = $_FILES["file"];

	foreach ($_POST['name'] as $k => $name) {
		if ((!$_POST['image'][$k] && (($name && !$file["name"][$k]) || (!$name && $file["name"][$k]))) || ( $_POST['image'][$k] && ((!$name) || (!$name && $file["name"][$k])))) {
			$message_error_editorchoice .= "&#149;&nbsp;".system_showText(LANG_SITEMGR_SETTINGS_EDITORCHOICE_MSGERROR_REQUIREDTOFINISHUPDATE1)." ".($k+1)." ".system_showText(LANG_SITEMGR_SETTINGS_EDITORCHOICE_MSGERROR_REQUIREDTOFINISHUPDATE2)."<br />";
		}
	}

	if ((!$message_editorchoice) || (!$message_error_editorchoice)) {

		foreach ($_POST['name'] as $k => $name) {

			if ($name) {

				if (!$_POST['image'][$k] || $file["name"][$k]) {

					$uploadObj =& new UploadFiles();

					$types     = array("1" => "GIF", "2" => "JPG");
					$info      = getimagesize($file["tmp_name"][$k]);
					$extension = strtolower($types[$info[2]]);

					$row_image['type']   = $types[$info[2]];
					$row_image['width']  = $info[0];
					$row_image['height'] = $info[1];

					$imageObj =& new Image($row_image);
					$imageObj->Save();

					$file_name = "photo_".$imageObj->getNumber("id").".".$extension;

					$supported_extensions = array(	"GIF"  => "image/gif",
													"JPG"  => "image/jpeg,image/pjpeg",
													"JPEG" => "image/jpeg,image/pjpeg");

					$uploadObj->set("name", $file_name);							// file name.
					$uploadObj->set("type", $file["type"][$k]);						// file type.
					$uploadObj->set("tmp_name", $file["tmp_name"][$k]);				// tmp file name.
					$uploadObj->set("error", $file["error"][$k]);					// file error.
					$uploadObj->set("size", $file["size"][$k]);						// file size.
					$uploadObj->set("fld_name", $k);								// file field name.
					$uploadObj->set("max_file_size", 40960);						// Max size allowed for uploaded file in bytes = 40 KB.
					$uploadObj->set("supported_extensions", $supported_extensions);	// Allowed extensions and types for uploaded file.
					$uploadObj->set("randon_name", FALSE);							// Generate a unique name for uploaded file? bool(true/false).
					$uploadObj->set("replace", FALSE);								// Replace existent files or not? bool(true/false).
					$uploadObj->set("file_perm", 0444);								// Permission for uploaded file. 0444 (Read only).
					$uploadObj->set("dst_dir", IMAGE_DIR);							// Destination directory for uploaded files.
					$result = $uploadObj->moveFileToDestination();					// $result = bool (true/false). Succeed or not.

					if ($uploadObj && $uploadObj->getString("fail_files_track")) {
						foreach ($uploadObj->getString("fail_files_track") as $each_failure){
							$message_error_editorchoice .= "&#149;&nbsp; ".system_showText(LANG_SITEMGR_SETTINGS_EDITORCHOICE_FILE)." ". ($k + 1) .": ".$each_failure["msg"]."<br />";
							$result = false;
						}
					}

					if (!$result){ // no image uploaded

						// deleting the image from database because the upload fail.
						$imageObj->Delete();
						unset($imageObj);

					} else { // image uploaded

						$_POST["image_id"] = $imageObj->getString("id");
						$_POST["file"] = true; // to form validation work.

						$editorChoiceObj =& new EditorChoice($_POST['choice'][$k]);

						// delete image that will be replaced.
						if ($_POST['image'][$k]) {
							$imageDelObj =& new Image($editorChoiceObj->getString("image_id"));
							$imageDelObj->Delete();
						}

						$editorChoiceObj->available = ($_POST["available_$k"]) ? "1" : "0";
						$editorChoiceObj->image_id  = $imageObj->id;
						$editorChoiceObj->name      = $name;
						$editorChoiceObj->save();

						unset($editorChoiceObj);
						unset($imageDelObj);
						unset($imageObj);

						$message_editorchoice .= "&#149;&nbsp; ".system_showText(LANG_SITEMGR_SETTINGS_EDITORCHOICE_FILE)." ". ($k + 1) .": ".system_showText(LANG_SITEMGR_SETTINGS_EDITORCHOICE_DESIGNATIONWASUPDATED)."<br />";

					}

				} else {

					$editorChoiceObj =& new EditorChoice($_POST['choice'][$k]);
					$editorChoiceObj->available= ($_POST["available_$k"]) ? "1" : "0";
					$editorChoiceObj->name = $name;
					$editorChoiceObj->save();

					$message_editorchoice .= "&#149;&nbsp; ".system_showText(LANG_SITEMGR_SETTINGS_EDITORCHOICE_FILE)." ". ($k + 1) .": ".system_showText(LANG_SITEMGR_SETTINGS_EDITORCHOICE_DESIGNATIONWASUPDATED)."<br />";

				}

			}

		}

	}

?>
