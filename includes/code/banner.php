<?

# ----------------------------------------------------------------------------------------------------
	// fixing url field if needed.
	if($_POST["destination_url"]) {
		if (eregi("http://",$destination_url) || eregi("https://",$destination_url) || eregi("ftp://",$destination_url)) {
			if (strpos($_POST["destination_url"], "http://") === 0) $_POST["destination_url"] = substr($_POST["destination_url"], 7);
			if (strpos($_POST["destination_url"], "https://") === 0) $_POST["destination_url"] = substr($_POST["destination_url"], 8);
			if (strpos($_POST["destination_url"], "ftp://") === 0) $_POST["destination_url"] = substr($_POST["destination_url"], 6);
		}
	}

	// Security ////////////////////////////////////////////////////////////////
	if ((sess_isAccountLogged()) && (strpos($url_base, "/membros"))) {

		unset($_POST["renewal_date"]); unset($_GET["renewal_date"]); unset($renewal_date);
		unset($_POST["start_date"]); unset($_GET["start_date"]); unset($start_date);
		unset($_POST["status"]);       unset($_GET["status"]);       unset($status);
		unset($_POST["account_id"]);   unset($_GET["account_id"]);   unset($account_id);

		$_POST["account_id"] = sess_getAccountIdFromSession();

		$id = ($_POST["id"]) ? $_POST["id"] : (($_GET["id"]) ? $_GET["id"] : "");

		if ($id) {

			$bannerObj =& new Banner($id);
			$levelObj = new BannerLevel(EDIR_DEFAULT_LANGUAGE, true);

			if($_POST["account_id"] != $bannerObj->getNumber("account_id")) {
				header("Location: $url_redirect/index.php");
				exit;
			}

			// code to get banner price - begin
			$bannerLevelObjTmp = new BannerLevel(EDIR_DEFAULT_LANGUAGE, true);
			$thisTmpPrice = 0;
			if ($bannerObj->getString("expiration_setting") == BANNER_EXPIRATION_RENEWAL_DATE) {
				$thisTmpPrice = $bannerLevelObjTmp->getPrice($bannerObj->getNumber("type"));
			}
			if ($bannerObj->getString("expiration_setting") == BANNER_EXPIRATION_IMPRESSION) {
				$thisTmpPrice = $bannerLevelObjTmp->getImpressionPrice($bannerObj->getNumber("type"));
			}
			unset($bannerLevelObjTmp);
			// code to get banner price - end

			##################################################
			// problem was that free banners can NOT CHANGED type.
			if ($thisTmpPrice > 0) {
				// so now if banner is free, member can CHANGED its type.
				if (
						(
							($bannerObj->getString("expiration_setting") == BANNER_EXPIRATION_IMPRESSION) && 
							($bannerObj->getString("impressions") > 0)
						)
						||
						(
							($bannerObj->getString("expiration_setting") == BANNER_EXPIRATION_RENEWAL_DATE) && 
							(!$bannerObj->needToCheckOut())
						)
						||
						(($bannerObj) && ($bannerObj->getPrice() <= 0))
					) {

						unset($_POST["type"]); unset($_GET["type"]); unset($type);
						$_POST["type"] = $bannerObj->getNumber("type");

					}
			}
			##################################################

			if (!is_int($_POST["unpaid_impressions"] / $levelObj->getImpressionBlock($_POST["type"]))) {
				unset($_POST["unpaid_impressions"]);
			}
		}

		unset($bannerObj);
		unset($levelObj);

	}
	////////////////////////////////////////////////////////////////////////////

	extract($_POST);
	extract($_GET);

	/**
	* Images upload
	****************************************************************************/
	if ($_FILES){

		$uploadObj =& new UploadFiles();

		$i = 0;
		foreach($_FILES as $key => $file){
			$labelsuffix = "";
			if ($i) $labelsuffix = $i;

			$types               = array("1" => "GIF", "2" => "JPG", "13" => "SWF", "4" => "SWF");
			$info                = getimagesize($file["tmp_name"]);
			$extension           = strtolower($types[$info[2]]);
			$row_image['type']   = $types[$info[2]];
			$row_image['width']  = $info[0];
			$row_image['height'] = $info[1];

			$imageObj =& new Image($row_image);
			$imageObj->Save();

			$file_name = "photo_".$imageObj->getNumber("id").".".$extension;

			$supported_extensions = array(	"gif"  => "image/gif",
											"jpg"  => "image/jpeg,image/pjpeg",
											"jpeg" => "image/jpeg,image/pjpeg",
											"swf"  => "application/x-shockwave-flash");

			$uploadObj->set("name",$file_name);								// file name.
			$uploadObj->set("type",$file["type"]);							// file type.
			$uploadObj->set("tmp_name",$file["tmp_name"]);					// tmp file name.
			$uploadObj->set("error",$file["error"]);						// file error.
			$uploadObj->set("size",$file["size"]);							// file size.
			$uploadObj->set("fld_name",$key);								// file field name.
			$uploadObj->set("max_file_size",409600);						// banners will have max 400Kb.
			$uploadObj->set("supported_extensions",$supported_extensions);	// Allowed extensions and types for uploaded file.
			$uploadObj->set("randon_name",FALSE);							// Generate a unique name for uploaded file? bool(true/false).
			$uploadObj->set("replace",FALSE);								// Replace existent files or not? bool(true/false).
			$uploadObj->set("file_perm",0444);								// Permission for uploaded file. 0444 (Read only).
			$uploadObj->set("dst_dir",IMAGE_DIR);							// Destination directory for uploaded files.
			$result = $uploadObj->moveFileToDestination();					// $result = bool (true/false). Succeed or not.

			if(!$result){ // no image uploaded

				// deleting the image from database because the upload fail.
				$imageObj->Delete();
				unset($imageObj);

			} else { // image uploaded

				$_POST["image_id".$labelsuffix] = $imageObj->getNumber("id");
				$_POST["file"] = true; // to form validation work.

				// delete image that will be replaced.
				if($id) {
					$bannerObj =& new Banner($id);
					$imageObj  =& new Image($bannerObj->getNumber("image_id".$labelsuffix));
					$imageObj->Delete();
				}

				unset($bannerObj);
				unset($imageObj);

			}

			$i++;
		}

	}

	/**
	* Messages
	****************************************************************************/
	if($uploadObj && ($uploadObj->getString("succeed_files_track") || $uploadObj->getString("fail_files_track"))){
		foreach($uploadObj->getString("succeed_files_track") as $each_succed){
			$banner = ucwords(str_replace("_"," ",$each_succed["field_name"]));
			$message .= system_showText(LANG_UPLOAD_WARNING).": ".$each_succed["msg"]."<br />";
		}
		foreach($uploadObj->getString("fail_files_track") as $each_failure){
			$banner = ucwords(str_replace("_"," ",$each_failure["field_name"]));
			$error_message .= system_showText(LANG_UPLOAD_WARNING).": ".$each_failure["msg"]."<br />";
		}
	}

	/**
	* Delete operation
	****************************************************************************/
	if ($operation == "delete" ) {

		$message .= system_showText(LANG_MSG_BANNER_SUCCESSFULLY_DELETED);

		$bannerObj =& new Banner($id);
		$bannerObj->Delete();
		unset($bannerObj);

		header("Location: ".$url_redirect."/".(($search_page) ? "search.php" : "index.php")."?message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
		exit;

	}

	/**
	* Insert Operation
	****************************************************************************/
	if ($operation == "add") {

		if ((validate_form("banner", $_POST, $val_message)) && is_valid_discount_code($_POST["discount_id"], "banner", $_POST["id"], $val_message, $discount_error_num)) {

			if (($uploadObj->error_type == 0) || ($uploadObj->error_type == 6)) {
				$message = "";
			}
			$error_message .= $val_message."<br />";
			$message .= system_showText(LANG_MSG_BANNER_SUCCESSFULLY_ADDED);

			$emailNotification = true;

			// Saving Banner
			$bannerObj =& new Banner($_POST);
			if (strpos($url_base, "/gerenciamento")) {
				$bannerObj->setDate("renewal_date", $_POST['renewal_date']); // set date of correct format
				$bannerObj->setDate("start_date", $_POST['start_date']); // set date of correct format
			}
			if (!$bannerObj->hasImpressions()) {
				$bannerObj->setNumber("unpaid_impressions", 0);
				$bannerObj->setString("unlimited_impressions", "y");
			} else {
				$bannerObj->setString("unlimited_impressions", "n");
			}
			$bannerObj->Save();
			$id = $bannerObj->getString("id");

			if ((sess_isAccountLogged()) && (strpos($url_base, "/membros"))) {
				$acctId = sess_getAccountIdFromSession();
				$accountObj = new Account($acctId);
				$contactObj = new Contact($acctId);
				setting_get("sitemgr_send_email",$sitemgr_send_email);
				setting_get("sitemgr_email",$sitemgr_email);
				$sitemgr_emails = split(",",$sitemgr_email);
				setting_get("sitemgr_banner_email",$sitemgr_banner_email);
				$sitemgr_banner_emails = split(",",$sitemgr_banner_email);
				$sitemgr_msg = "
					<html>
						<head>
							<style>
								.email_style_settings{
									font-size:12px;
									font-family:Verdana, Arial, Sans-Serif;
									color:#000;
								}
							</style>
						</head>
						<body>
							<div class=\"email_style_settings\">
								Site Manager,<br /><br />";
				$sitemgr_msg .= "The ".BANNER_FEATURE_NAME." \"".$bannerObj->getString("caption")."\" was created by the administrator \"".system_showAccountUserName($accountObj->getString("username"))."\" and needs to be revised by you.<br /><br />";
				$sitemgr_msg .= "
								<a href=\"".DEFAULT_URL."/gerenciamento/banner/view.php?id=".$bannerObj->getNumber("id")."\" target=\"_blank\">".DEFAULT_URL."/gerenciamento/banner/view.php?id=".$bannerObj->getNumber("id")."</a><br /><br />
							</div>
						</body>
					</html>";
				$error = false;
				if ($sitemgr_send_email == "on" && $emailNotification) {
					if ($sitemgr_emails[0]) {
						foreach ($sitemgr_emails as $sitemgr_email) {
							//system_mail($sitemgr_email, "[".EDIRECTORY_TITLE."] ".ucwords(BANNER_FEATURE_NAME)." Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_email>", "text/html", '', '', $error);
						}
					}
				}
				if ($sitemgr_banner_emails[0] && $emailNotification) {
					foreach ($sitemgr_banner_emails as $sitemgr_banner_email) {
						//system_mail($sitemgr_banner_email, "[".EDIRECTORY_TITLE."] ".ucwords(BANNER_FEATURE_NAME)." Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_banner_email>", "text/html", '', '', $error);
					}
				}
			}

			if ($_POST["account_id"] > 0) {
				$accountObj = new Account($_POST["account_id"]);
				$contactObj = new Contact($_POST["account_id"]);
				if($emailNotificationObj = system_checkEmail(SYSTEM_NEW_BANNER, $contactObj->getString("lang"))) {
					if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];
					$subject = $emailNotificationObj->getString("subject");
					$body    = $emailNotificationObj->getString("body");
					$body    = system_replaceEmailVariables($body,$id,'banner');
					$subject = system_replaceEmailVariables($subject,$id,'banner');
					$body    = str_replace("DEFAULT_URL", DEFAULT_URL, $body);
					$body = html_entity_decode($body);
					$subject = html_entity_decode($subject);
					//system_mail($contactObj->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error);
				}
			}

			$newest = "1";

			unset($bannerObj);

			if (strpos($url_base, "/membros")) header("Location: ".$url_redirect."/index.php?message=".urlencode($message)."&newest=".$newest);
			else header("Location: ".$url_redirect."/".(($search_page) ? "search.php" : "index.php")."?message=".urlencode($message)."&newest=".$newest."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
			exit;

		} else {

			$imageObj = new Image($_POST["image_id"]);
			$imageObj->Delete();
			unset($imageObj);
			$imageObj = new Image($_POST["image_id1"]);
			$imageObj->Delete();
			unset($imageObj);
			$imageObj = new Image($_POST["image_id2"]);
			$imageObj->Delete();
			unset($imageObj);
			$imageObj = new Image($_POST["image_id3"]);
			$imageObj->Delete();
			unset($imageObj);
			$imageObj = new Image($_POST["image_id4"]);
			$imageObj->Delete();
			unset($imageObj);

		}

		$error_message .= $val_message."<br />";

	}

	/**
	* Update Operation
	****************************************************************************/
	if ($operation == "update") {

		if ((validate_form("banner", $_POST, $val_message)) && is_valid_discount_code($_POST["discount_id"], "banner", $_POST["id"], $val_message, $discount_error_num)) {

			if (($uploadObj->error_type == 0) || ($uploadObj->error_type == 6)) {
				$message = "";
			}
			$error_message .= $val_message;
			$message .= system_showText(LANG_MSG_BANNER_SUCCESSFULLY_UPDATED);

			$status = new ItemStatus();
			$bannerObj =& new Banner($id); // Loading banner info into object

			// Change or not status to Pending and define renew_date
			if (strpos($url_base, "/gerenciamento")) {
				$_POST["status"] = $bannerObj->getString("status");
			} else {
				$bannerStatusObj = new ItemStatus();
				if ($bannerObj->getNumber("type") != $_POST["type"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($bannerObj->getNumber("section") != $_POST["section"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($bannerObj->getNumber("category_id") != $_POST["category_id"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($bannerObj->getString("target_window") != $_POST["target_window"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($bannerObj->getString("caption") != $_POST["caption"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($bannerObj->getString("caption1") != $_POST["caption1"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($bannerObj->getString("caption2") != $_POST["caption2"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($bannerObj->getString("caption3") != $_POST["caption3"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($bannerObj->getString("caption4") != $_POST["caption4"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($bannerObj->getString("discount_id") != $_POST["discount_id"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($bannerObj->getString("destination_protocol") != $_POST["destination_protocol"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($bannerObj->getString("destination_url") != $_POST["destination_url"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($bannerObj->getString("display_url") != $_POST["display_url"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($bannerObj->getString("content_line1") != $_POST["content_line1"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($bannerObj->getString("content_line11") != $_POST["content_line11"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($bannerObj->getString("content_line12") != $_POST["content_line12"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($bannerObj->getString("content_line13") != $_POST["content_line13"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($bannerObj->getString("content_line14") != $_POST["content_line14"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($bannerObj->getString("content_line2") != $_POST["content_line2"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($bannerObj->getString("content_line21") != $_POST["content_line21"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($bannerObj->getString("content_line22") != $_POST["content_line22"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($bannerObj->getString("content_line23") != $_POST["content_line23"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($bannerObj->getString("content_line24") != $_POST["content_line24"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($_POST["image_id"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($_POST["image_id1"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($_POST["image_id2"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($_POST["image_id3"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
				if ($_POST["image_id4"]) { $_POST["status"] = $bannerStatusObj->getDefaultStatus(); $changed = true; }
			}

			if (!$bannerObj->hasRenewalDate()) {
				$_POST["renewal_date"] = "0000-00-00";
				$_POST["start_date"] = "0000-00-00";
			}
			if (!$bannerObj->hasImpressions()) {
				$_POST["unpaid_impressions"] = 0;
				$_POST["unlimited_impressions"] = "y";
			} else {
				$_POST["unlimited_impressions"] = "n";
			}

			// member can create a banner free and check out it
			// aftet, renewal date will to some periods or impressions will to some blocks
			// because banner is free, member can change his banner type any time
			// if he change his banner type, he MUST pay for this new banner type (it isnt free anymore)
			// any change in banner type, renewal date and impressions go to like new banner
			// ps: just for the case new banner type
			if ($bannerObj->getNumber("type") != $_POST["type"]) {
				$_POST["renewal_date"] = "00/00/0000";
				$_POST["start_date"] = "00/00/0000";
				$_POST["impressions"] = 0;
			}

			$bannerObj->makeFromRow($_POST); // Loading new info into banner

			if($_POST["type"] < 50) { // Image banners don't have following fields.
				$bannerObj->setString("content_line1","");
				$bannerObj->setString("content_line2","");
				$bannerObj->setString("display_url","");
			} else { // Text banners don't have images.
				$imageObj = New Image($bannerObj->getNumber("image_id"));
				$imageObj->Delete();
				$bannerObj->setNumber("image_id", "0");
				$imageObj = New Image($bannerObj->getNumber("image_id1"));
				$imageObj->Delete();
				$bannerObj->setNumber("image_id1", "0");
				$imageObj = New Image($bannerObj->getNumber("image_id2"));
				$imageObj->Delete();
				$bannerObj->setNumber("image_id2", "0");
				$imageObj = New Image($bannerObj->getNumber("image_id3"));
				$imageObj->Delete();
				$bannerObj->setNumber("image_id3", "0");
				$imageObj = New Image($bannerObj->getNumber("image_id4"));
				$imageObj->Delete();
				$bannerObj->setNumber("image_id4", "0");
			}

			$bannerObj->Save(); // Saving Banner

			if ((sess_isAccountLogged() && $changed) && (strpos($url_base, "/membros"))) {

				$acctId = sess_getAccountIdFromSession();
				$accountObj = new Account($acctId);
				$contactObj = new Contact($acctId);

				setting_get("sitemgr_send_email",$sitemgr_send_email);
				setting_get("sitemgr_email",$sitemgr_email);
				$sitemgr_emails = split(",",$sitemgr_email);
				setting_get("sitemgr_banner_email",$sitemgr_banner_email);
				$sitemgr_banner_emails = split(",",$sitemgr_banner_email);

				$sitemgr_msg = "
					<html>
						<head>
							<style>
								.email_style_settings{
									font-size:12px;
									font-family:Verdana, Arial, Sans-Serif;
									color:#000;
								}
							</style>
						</head>
						<body>
							<div class=\"email_style_settings\">
								Site Manager,<br /><br />";
				$sitemgr_msg .= "The ".BANNER_FEATURE_NAME." \"".$bannerObj->getString("caption")."\" was changed by the administrator \"".system_showAccountUserName($accountObj->getString("username"))."\" and needs to be revised by you.<br /><br />";
				$sitemgr_msg .= "
								<a href=\"".DEFAULT_URL."/gerenciamento/banner/view.php?id=".$bannerObj->getNumber("id")."\" target=\"_blank\">".DEFAULT_URL."/gerenciamento/banner/view.php?id=".$bannerObj->getNumber("id")."</a><br /><br />
							</div>
						</body>
					</html>";
                $error = false;
				if ($sitemgr_send_email == "on") {
					if ($sitemgr_emails[0]) {
						foreach ($sitemgr_emails as $sitemgr_email) {
							//system_mail($sitemgr_email, "[".EDIRECTORY_TITLE."] ".ucwords(BANNER_FEATURE_NAME)." Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_email>", "text/html", '', '', $error);
						}
					}
				}
				if ($sitemgr_banner_emails[0]) {
					foreach ($sitemgr_banner_emails as $sitemgr_banner_email) {
						//system_mail($sitemgr_banner_email, "[".EDIRECTORY_TITLE."] ".ucwords(BANNER_FEATURE_NAME)." Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_banner_email>", "text/html", '', '', $error);
					}
				}

			}

			unset($bannerObj);

			header("Location: ".$url_redirect."/".(($search_page) ? "search.php" : "index.php")."?process=".$process."&newest=".$newest."&message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
			exit;

		}

		$error_message .= $val_message."<br />";

	}


	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------

	/**
	* Field values
	****************************************************************************/
	if ($id) {

		$bannerObj    =& new Banner($id);
		$banner_types = $bannerObj->GetString("banner_types");

		// Making local vars from banner object.
		$destination_url		= ($_POST["destination_url"])		? $_POST["destination_url"]			: $bannerObj->getString("destination_url");
		$display_url			= ($_POST["display_url"])			? $_POST["display_url"]				: $bannerObj->getString("display_url");
		$destination_protocol	= ($_POST["destination_protocol"])	? $_POST["destination_protocol"]	: $bannerObj->getString("destination_protocol");
		$caption				= ($_POST["caption"])				? $_POST["caption"]					: $bannerObj->getString("caption");
		$caption1				= ($_POST["caption1"])				? $_POST["caption1"]				: $bannerObj->getString("caption1");
		$caption2				= ($_POST["caption2"])				? $_POST["caption2"]				: $bannerObj->getString("caption2");
		$caption3				= ($_POST["caption3"])				? $_POST["caption3"]				: $bannerObj->getString("caption3");
		$caption4				= ($_POST["caption4"])				? $_POST["caption4"]				: $bannerObj->getString("caption4");
		$discount_id			= ($_POST["discount_id"])			? $_POST["discount_id"]				: $bannerObj->getString("discount_id");
		$id						= $bannerObj->getString("id");
		$image_id				= ($_POST["image_id"])				? $_POST["image_id"]				: $bannerObj->getNumber("image_id");
		$image_id1				= ($_POST["image_id1"])				? $_POST["image_id1"]				: $bannerObj->getNumber("image_id1");
		$image_id2				= ($_POST["image_id2"])				? $_POST["image_id2"]				: $bannerObj->getNumber("image_id2");
		$image_id3				= ($_POST["image_id3"])				? $_POST["image_id3"]				: $bannerObj->getNumber("image_id3");
		$image_id4				= ($_POST["image_id4"])				? $_POST["image_id4"]				: $bannerObj->getNumber("image_id4");
		$type					= ($_POST["type"])					? $_POST["type"]					: $bannerObj->getString("type");
		$section				= ($_POST["section"])				? $_POST["section"]					: $bannerObj->getString("section");
		$account_id				= ($_POST["account_id"])			? $_POST["account_id"]				: $bannerObj->getString("account_id");
		$category_id			= ($_POST["category_id"])			? $_POST["category_id"]				: $bannerObj->getString("category_id");
		$renewal_date			= ($_POST["renewal_date"])			? $_POST["renewal_date"]			: $bannerObj->getDate("renewal_date");
		$start_date				= ($_POST["start_date"])			? $_POST["start_date"]			: $bannerObj->getDate("start_date");
		$target_window			= ($_POST["target_window"])			? $_POST["target_window"]			: $bannerObj->getNumber("target_window");
		$content_line1			= ($_POST["content_line1"])			? $_POST["content_line1"]			: $bannerObj->getNumber("content_line1");
		$content_line11			= ($_POST["content_line11"])		? $_POST["content_line11"]			: $bannerObj->getNumber("content_line11");
		$content_line12			= ($_POST["content_line12"])		? $_POST["content_line12"]			: $bannerObj->getNumber("content_line12");
		$content_line13			= ($_POST["content_line13"])		? $_POST["content_line13"]			: $bannerObj->getNumber("content_line13");
		$content_line14			= ($_POST["content_line14"])		? $_POST["content_line14"]			: $bannerObj->getNumber("content_line14");
		$content_line2			= ($_POST["content_line2"])			? $_POST["content_line2"]			: $bannerObj->getNumber("content_line2");
		$content_line21			= ($_POST["content_line21"])		? $_POST["content_line21"]			: $bannerObj->getNumber("content_line21");
		$content_line22			= ($_POST["content_line22"])		? $_POST["content_line22"]			: $bannerObj->getNumber("content_line22");
		$content_line23			= ($_POST["content_line23"])		? $_POST["content_line23"]			: $bannerObj->getNumber("content_line23");
		$content_line24			= ($_POST["content_line24"])		? $_POST["content_line24"]			: $bannerObj->getNumber("content_line24");
		$expiration_setting		= ($_POST["expiration_setting"])	? $_POST["expiration_setting"]		: $bannerObj->getNumber("expiration_setting");
		$unpaid_impressions		= ($_POST["unpaid_impressions"])	? $_POST["unpaid_impressions"]		: (($_POST["type"] == $bannerObj->getNumber("type") || !$_POST["type"]) ? $bannerObj->getNumber("unpaid_impressions") : "0");
		$impressions			= ($_POST["impressions"])			? $_POST["impressions"] 			: $bannerObj->getNumber("impressions");
		$show_type				= ($_POST["show_type"])				? $_POST["show_type"] 				: $bannerObj->getNumber("show_type");
		$script					= ($_POST["script"])				? $_POST["script"] 					: $bannerObj->getString("script");

		unset($bannerObj);

		$thisBannerObject = new Banner($id);

	}

	/**
	* Banner Drop Down
	****************************************************************************/
	$bannerObj = new Banner();
    $bannerLevel = new BannerLevel(EDIR_DEFAULT_LANGUAGE, true);

	$nameArray  = array();
	$valueArray = array();

	foreach($bannerObj->banner_types as $each_type => $each_value){

		$bannerLevelObj = new BannerLevel();
        if($bannerLevelObj->getActive($each_value)) {
		    $banner_size = "(".$bannerLevelObj->getWidth($each_value)."px x ".$bannerLevelObj->getHeight($each_value)."px)";

		    $nameArray[]  = ucwords($bannerLevel->getDisplayName($each_value))." ".$banner_size;
		    $valueArray[] = $each_value;
        }

	}

	$type = (int)$type==0 ? "1" : $type;
	$banner_script = (strpos($url_base, "/gerenciamento")) ? "onchange=\"bannerCheckType(this.value,'".DEFAULT_URL."')\"" : "onchange=\"bannerCheckType(this.value,'".DEFAULT_URL."'); bannerFillSelect('".DEFAULT_URL."',this.form.unpaid_impressions, this.value)\"";
	$bannerTypeDropDown = html_selectBox("type", $nameArray, $valueArray, $type, $banner_script, "class='input-dd-form-banner'", "-- ".system_showText(LANG_LABEL_SELECT_TYPE)." --");

	unset($bannerObj);

	/**
	* Impressions Drop Down
	****************************************************************************/
	$nameArray  = array();
	$valueArray = array();

	for($i=0; $i < 50; $i++){
		$bannerLevelObj = new BannerLevel(EDIR_DEFAULT_LANGUAGE, true);
		$type = ($type) ? $type : $bannerLevelObj->getDefaultLevel();
		$nameArray[]  = $bannerLevelObj->getImpressionBlock($type)*$i;
		$valueArray[] = $bannerLevelObj->getImpressionBlock($type)*$i;
	}
	$disabled = (!$expiration_setting || $expiration_setting != BANNER_EXPIRATION_IMPRESSION) ? "disabled=true" : "";
	$bannerImpressionDropDown = html_selectBox("unpaid_impressions", $nameArray, $valueArray, $unpaid_impressions, "id='unpaid_impressions' $disabled", "style=\" width: 80px;\"");

	unset($bannerLevelObj);

	/**
	* Category Drop Down
	****************************************************************************/
	$nameArray  = array();
	$valueArray = array();
	if (!$section || $section == "general") {
		$categoryDropDown = html_selectBox("category_id", $nameArray, $valueArray, $category_id, "id=\"category_id\" disabled", "class='input-dd-form-banner' style='width: 350px;'", system_showText(LANG_ALLPAGESBUTITEMPAGES));
	} else {
		if ($section == "listing") $tableCategory = "listingcategory";
		elseif ($section == "event") $tableCategory = "eventcategory";
		elseif ($section == "classified") $tableCategory = "classifiedcategory";
		elseif ($section == "article") $tableCategory = "articlecategory";
		$categories = db_getFromDB($tableCategory, "category_id", 0, "all", "title");
		if ($categories) {
			foreach ($categories as $category) {
				$valueArray[]  = "";
				$nameArray[]   = "--------------------------------------------------";
				$valueArray[]  = $category->getNumber("id");
				$nameArray[]   = $category->getString("title");
				$subcategories = db_getFromDB($tableCategory, "category_id", $category->getNumber("id"), "all", "title");
				if ($subcategories) {
					foreach ($subcategories as $subcategory) {
						$valueArray[] = $subcategory->getNumber("id");
						$nameArray[]  = "- ".$subcategory->getString("title");
						$subcategories2 = db_getFromDB($tableCategory, "category_id", $subcategory->getNumber("id"), "all", "title");
						if ($subcategories2) {
							foreach ($subcategories2 as $subcategory2) {
								$valueArray[] = $subcategory2->getNumber("id");
								$nameArray[]  = "-- ".$subcategory2->getString("title");
								$subcategories3 = db_getFromDB($tableCategory, "category_id", $subcategory2->getNumber("id"), "all", "title");
								if ($subcategories3) {
									foreach ($subcategories3 as $subcategory3) {
										$valueArray[] = $subcategory3->getNumber("id");
										$nameArray[]  = "--- ".$subcategory3->getString("title");
										$subcategories4 = db_getFromDB($tableCategory, "category_id", $subcategory3->getNumber("id"), "all", "title");
										if ($subcategories4) {
											foreach ($subcategories4 as $subcategory4) {
												$valueArray[] = $subcategory4->getNumber("id");
												$nameArray[]  = "---- ".$subcategory4->getString("title");
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
		$valueArray[] = "";
		$nameArray[] = "--------------------------------------------------";
		$categoryDropDown = html_selectBox("category_id", $nameArray, $valueArray, $category_id, "id=\"category_id\"", "class='input-dd-form-banner' style='width:350px;'", system_showText(LANG_SITEMGR_LABEL_NONCATEGORYSEARCH));
	}

?>
