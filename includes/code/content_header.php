<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/code/content_header.php
	# ----------------------------------------------------------------------------------------------------

	extract($_POST);
	extract($_GET);

	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		/* setting title */
		if (!customtext_set("header_title", $header_title, $lang)) {
			if (!customtext_new("header_title", $header_title, $lang)) {
				$error = true;
				$actions = "";
			}
		}

		/* setting author */
		if (!customtext_set("header_author", $header_author, $lang)) {
			if (!customtext_new("header_author", $header_author, $lang)) {
				$error = true;
				$actions = "";
			}
		}

		/* setting description */
		if (!customtext_set("header_description", $header_description, $lang)) {
			if (!customtext_new("header_description", $header_description, $lang)) {
				$error = true;
			}
		}

		/* setting keywords */
		if (!customtext_set("header_keywords", $header_keywords, $lang)) {
			if (!customtext_new("header_keywords", $header_keywords, $lang)) {
				$error = true;
			}
		}
		
		if ($error) {
			$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
		}

		/* header image file */
		if ($_FILES["header_image"]["tmp_name"] || $restore_image) {
			$filename = EDIRECTORY_ROOT.IMAGE_HEADER_PATH;
			$image_upload = image_uploadForHeader($filename, $_FILES["header_image"]["tmp_name"], $restore_image);
			if (!$image_upload["success"]) {
				$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MSGERROR_ALERTUPLOADIMAGE1);
				$error = true;
			}
		}
		
		/* rss logo file */
		if ($_FILES["rss_logo"]["tmp_name"] || $restore_logo_rrs) {
			$filename = EDIRECTORY_ROOT.RSS_LOGO_PATH;
			$image_upload = image_uploadForRss($filename, $_FILES["rss_logo"]["tmp_name"], $restore_logo_rrs);
			if (!$image_upload["success"]) {
				$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MSGERROR_ALERTUPLOADIMAGE1);
				$error = true;
			}
		}
        
        /* mobile logo file */
        if ($_FILES["mobile_logo"]["tmp_name"] || $restore_logo_mobile) {
            $filename = EDIRECTORY_ROOT.MOBILE_LOGO_PATH;
            $image_upload = image_uploadForMobile($filename, $_FILES["mobile_logo"]["tmp_name"], $restore_logo_mobile);
            if (!$image_upload["success"]) {
                $actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MSGERROR_ALERTUPLOADIMAGE1);
                $error = true;
            }
        }

		if($actions) {
			$message_header .= implode("<br />", $actions);
		} else {
			$message_header  = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_CONTENT_HEADER_SUCCESS);
		}

	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------

	/**
	* Field values
	*/

	customtext_get("header_title", $header_title, $lang);

	customtext_get("header_author", $header_author, $lang);

	customtext_get("header_description", $header_description, $lang);

	customtext_get("header_keywords", $header_keywords, $lang);

?>
