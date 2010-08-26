<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/views/view_summary_rating.php
	# ----------------------------------------------------------------------------------------------------

	$listing_review = "";

	###################################################################
	######################     RATINGS    #############################
	###################################################################

	setting_get("rating_enabled", $rating_enabled);
	if ($rating_enabled == "on") {

		$rateObj = new Rating();
		$rate_avg = $rateObj->getRateAvgByListing($listing->getString("id"));
		unset($rate_stars);

		if ($rate_avg) {

			$db = db_getDBObject();
			$sql ="SELECT * FROM Rating WHERE listing_id = '".$listing->getString("id")."' and approved=1 ";
			$r = $db->query($sql);
			$rating_amount =mysql_affected_rows();

			for ($x=0 ; $x < 5 ;$x++) {
				if ($rate_avg > $x) $rate_stars .= "<li class=\"ratingStar\"><img src='".DEFAULT_URL."/images/design/img_rateSmallStarOn.gif' alt='Star On' /></li>";
				else $rate_stars .= "<li class=\"ratingStar\"><img src='".DEFAULT_URL."/images/design/img_rateSmallStarOff.gif' alt='Star Off' /></li>";
			}

			$listing_review .= "<ul class=\"rating\">";

				$listing_review .= "<li class=\"ratingLeftSpace\">&nbsp;</li>";

				if ($user) {

					$sql = "SELECT * FROM Rating WHERE listing_id = ".$listing->getNumber("id")." AND review IS NOT NULL AND review != '' AND approved=1";
					$dbObj = db_getDBObject();
					$result = $dbObj->query($sql);
					$plural = $rating_amount == 1 ? "" : "s";

					if (mysql_num_rows($result) > 0) {

						if (MODREWRITE_FEATURE == "on") {
							$reviewcommentsLink = "".LISTING_DEFAULT_URL."/reviews/".$listing->getString("friendly_url");
						} else {
							$reviewcommentsLink = "".LISTING_DEFAULT_URL."/reviewcomments.php?listing_id=".$listing->getNumber("id");
						}

						$listing_review .= $rate_stars."<li class=\"ratingReview\"><a href='".$reviewcommentsLink."'>(".$rating_amount." review" . $plural . ")</a></li><li class=\"ratingSeeComment\"><a href='".$reviewcommentsLink."'>See comments</a></li>";

					} else {
						$listing_review .= $rate_stars." <li class=\"ratingReview\">(".$rating_amount." review" . $plural . ")</li>";
					}

				} else {

					$sql = "SELECT * FROM Rating WHERE listing_id = ".$listing->getNumber("id")." AND review IS NOT NULL AND review != ''";
					$dbObj = db_getDBObject();
					$result = $dbObj->query($sql);
					$plural = $rating_amount == 1 ? "" : "s";
					if ($rating_amount > 0) {
						$listing_review .= $rate_stars."<li class=\"ratingReview\"><a href='javascript:void(0);'>(".$rating_amount." review" . $plural . ")</a></li><li class=\"ratingSeeComment\"><a href='javascript:void(0);'>See comments</a></li>";
					} else {
						$listing_review .= $rate_stars." <li class=\"ratingReview\">(".$rating_amount." review" . $plural . ")</li>";
					}

				}

				if ($user) {

					if (!$bt_rate_off){
						if ($rating_amount > 0) {
							$listing_review .= "<li class=\"ratingImage\"><a href='".LISTING_DEFAULT_URL."/review.php?listing_id=".$listing->getNumber("id")."'>Rate it!</a></li>";
						} else {
							 $listing_review .= "<li class=\"ratingText\"><a href=\"".LISTING_DEFAULT_URL."/review.php?listing_id=".$listing->getNumber("id")."\">Be the first to rate this listing!</a></li>";
						}
					}

				} else {

					if (!$bt_rate_off){
						if ($rating_amount > 0) {
							$listing_review .= "<li class=\"ratingImage\"><a href='javascript:void(0);'>Rate it!</a></li>";
						} else {
							 $listing_review .= "<li class=\"ratingText\"><a href='javascript:void(0);'>Be the first to rate this ".LISTING_FEATURE_NAME."!</a></li>";
						}
					}

				}

			$listing_review .= "</ul>";

		}

	}

	###################################################################
	###################################################################
	###################################################################

?>
