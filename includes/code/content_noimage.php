<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/code/content_noimage.php
	# ----------------------------------------------------------------------------------------------------

	extract($_POST);
	extract($_GET);

	$success = false;

	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		/* noimage image file */
		if ($_FILES["noimage_image"]["tmp_name"] || $restore_image) {
			$filename = EDIRECTORY_ROOT.NOIMAGE_PATH."/".NOIMAGE_NAME.".".NOIMAGE_IMGEXT;
			$image_upload = image_uploadForNoImage($filename, $_FILES["noimage_image"]["tmp_name"], $restore_image);
			if (!$image_upload["success"]) {
				$error = true;
			}
		}

		if (!$error) {
			$success = true;
			$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_CONTENT_NOIMAGE_SUCCESS);
		} else {
			$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
		}

		if($actions) {
			$message_noimage .= implode("<br />", $actions);
		}

	}

?>
