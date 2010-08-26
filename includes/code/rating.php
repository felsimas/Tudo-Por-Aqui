<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/code/rating.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($listing_id) {
		$listingObj = new Listing($listing_id);
	} else {
		header("location: ".DEFAULT_URL."/index.php");
		exit;
	}

	// RATING STARS //
	$rating_stars = "";

	# ----------------------------------------------------------------------------------------------------
	# REVIEW/RATING EXECUTION
	# ----------------------------------------------------------------------------------------------------
	$success_rating = false;
	if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST["submit"]) {

		setting_get("rating_manditory", $rating_manditory);
		setting_get("rating_approve", $rating_approve);

		// COOKIE RETRIEVAL ////////////////////////////////////////////////////
		if ($_COOKIE["rating"]) {
			$cookie_value = $_COOKIE["rating"];
			$cookie_arr   = explode(":",$_COOKIE["rating"]);
		}
		////////////////////////////////////////////////////////////////////////

		if (!strpos($url_base, "/gerenciamento")) {

			// SECURITY CHECK FOR SIMPLE USERS //////////////////////////////////////////////////////
			$allowed = true;

			// form validation
			if (!$_POST["rating"]) {
				$message_rating = "Please select a rating for this ".LISTING_FEATURE_NAME."!";
				$allowed = false;
			} elseif ($_POST["rating"] > 5 ) {
				$message_rating = "Fraud detected! Please select a rating for this ".LISTING_FEATURE_NAME."!";
				$allowed = false;
			} elseif (!trim($_POST["review"]) || !trim($_POST["review_title"])) {
				$message_rating = "\"Comment\" and \"Comment Title\" are required to post a comment!";
				$allowed = false;
			}

			if ($rating_manditory == "on") {
				if (!trim($_POST["reviewer_name"]) || !trim($_POST["reviewer_email"])) {
					$message_rating = "\"Name\" and \"E-mail\" are required to post a comment!";
					$allowed = false;
				}
			}

			if ($_POST["reviewer_email"] && !validate_email($_POST["reviewer_email"])) {
				$message_rating = "Please type a valid e-mail address!";
				$allowed = false;
			}

			// cookie denial
			if ($cookie_arr) {
				foreach ($cookie_arr as $eah_cookie_value) {
					if ($listing_id == $eah_cookie_value) {
						$message_rating = "You have already given your opinion on this ".LISTING_FEATURE_NAME.". Thank you.";
						$allowed = false;
					}
				}
			}

			// ip denial, store and deny ips just for a few minutes to avoid robots
			$ratingObj = new Rating();
			$denied_ips = $ratingObj->getDeniedIpsByListing($listingObj->getString("id"));
			if ($denied_ips) {
				foreach ($denied_ips as $each_ip) {
					if ($_SERVER["REMOTE_ADDR"] == $each_ip) {
						$message_rating = "You have already given your opinion on this ".LISTING_FEATURE_NAME.". Thank you.";
						$allowed = false;
					}
				}
			}

			////////////////////////////////////////////////////////////////////////

		} else $allowed=true; // SITEMGR

		for ($i = 1; $i < 6; $i++) {
			$img  = "<img "; 
			$img .= ($i <= $rating) ? "src=\"".DEFAULT_URL."/images/design/img_rateStarOn.gif\" alt=\"Star On\"" : "src=\"".DEFAULT_URL."/images/design/img_rateStarOff.gif\" alt=\"Star Off\"";
			$img .= "onclick=\"setRatingLevel($i)\"";
			$img .= "onmouseout=\"resetRatingLevel()\"";
			$img .= "onmouseover=\"setDisplayRatingLevel($i)\"";
			$img .= "name=\"star$i\" />";
			$rating_stars .= "<dd>".$img."</dd>";
		}

		// RATING //////////////////////////////////////////////////////////////
		if ($allowed) {

			if (!strpos($url_base, "/gerenciamento")) {
				// insert rating into database
				$_POST["ip"] = $_SERVER["REMOTE_ADDR"];
				$ratingObj = new Rating($_POST);
				if ($rating_approve != "on") {
					$ratingObj->setNumber("approved", 1);
				}
				$ratingObj->Save();
			} else {
				// Sitemgr is updating/editing the rating
				// Do not overwrite IP and Dates
				$ratingObj = new Rating($id);
				if ($rating_approve != "on") {
					$ratingObj->setNumber("approved", 1);
				}
				$ratingObj->setString("rating",$rating);
				$ratingObj->setString("review_title",$review_title);
				$ratingObj->setString("review",$review);
				$ratingObj->setString("reviewer_name",$reviewer_name);
				$ratingObj->setString("reviewer_email",$reviewer_email);
				$ratingObj->setString("reviewer_location",$reviewer_location);
				$ratingObj->Save();
				header ("Location: ".$url_redirect);
				exit;
			}

			// this line below exists just to load added field value into the object.
			$ratingObj = new Rating($ratingObj->getString("id"));

			// write new cookie value which append a new listing id
			$value = ($cookie_value) ? $cookie_value.":".$listing_id : $listing_id;

			// remove old cookie and set the new one
			setcookie("rating", "$value", time()-3600, "".EDIRECTORY_FOLDER."");
			setcookie("rating", "$value", time()+60*60*24*30*120, "".EDIRECTORY_FOLDER."");

			if ($ratingObj->getString("review")) {

				setting_get("sitemgr_send_email",$sitemgr_send_email);
				setting_get("sitemgr_email",$sitemgr_email);
				$sitemgr_emails = split(",",$sitemgr_email);
				setting_get("sitemgr_rate_email",$sitemgr_rate_email);
				$sitemgr_rate_emails = split(",",$sitemgr_rate_email);

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
								Site Manager,<br /><br />"

								."\"".$listingObj->getString("title")."\" has a new review - ".$ratingObj->getString("rating")." stars <br />"
								.$ratingObj->getString("reviewer_name")." (".$ratingObj->getString("reviewer_email").") from ".$ratingObj->getString("reviewer_location")." wrote: <br />"
								.$ratingObj->getString("review_title")."<br />"
								.$ratingObj->getString("review")."<br />"
								.format_date($ratingObj->getString("added"), DEFAULT_DATE_FORMAT." H:i:s", "datetime")."<br /><br />"
								."Click on the link below to go to the rating administration :<br />"
								."<a href=\"".DEFAULT_URL."/gerenciamento/rating/view.php?id=".$ratingObj->getString("id")."\" target=\"_blank\">".DEFAULT_URL."/gerenciamento/rating/view.php?id=".$ratingObj->getString("id")."</a><br /><br />"

							."</div>
						</body>
					</html>";

				// sending e-mail to site manager
				if ($sitemgr_send_email == "on") {
					if ($sitemgr_emails[0]) {
						foreach ($sitemgr_emails as $sitemgr_email) {
							system_mail($sitemgr_email, "[".EDIRECTORY_TITLE."] Rate Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_email>", "text/html");
						}
					}
				}
				if ($sitemgr_rate_emails[0]) {
					foreach ($sitemgr_rate_emails as $sitemgr_rate_email) {
						system_mail($sitemgr_rate_email, "[".EDIRECTORY_TITLE."] Rate Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_rate_email>", "text/html");
					}
				}

			}

			// success message
			$message_rating = "Thanks for the feedback!";

			if ($rating_approve == "on") {
				$message_rating .= " Your review has been submitted for approval.";
			}
			$success_rating = true;

		}
		////////////////////////////////////////////////////////////////////////

	}

	# ----------------------------------------------------------------------------------------------------
	# FORM DEFINES
	# ----------------------------------------------------------------------------------------------------

	// deal with quotes problem on form validation failure
	$_POST = format_magicQuotes($_POST);
	$_GET  = format_magicQuotes($_GET);
	extract($_POST);
	extract($_GET);

?>
