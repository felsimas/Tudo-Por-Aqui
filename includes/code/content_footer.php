<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/code/content_footer.php
	# ----------------------------------------------------------------------------------------------------

	extract($_POST);
	extract($_GET);
	
	if ($_SERVER['REQUEST_METHOD'] == "POST") {	
		/* setting copyright */
		if (!customtext_set("footer_copyright", $copyright, $lang)) {
			if (!customtext_new("footer_copyright", $copyright, $lang)) {
				$error = true;
				$actions = "";
			}
		}
		if (!$error) {
			$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_CONTENT_FOOTER_SUCCESS);
		} else {
			$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
		}
		if($actions) {
			$message_footer .= implode("<br />", $actions);
		}
	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------

	/**
	* Field values
	*/
	customtext_get("footer_copyright", $copyright, $lang);

?>
