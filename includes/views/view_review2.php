<?

					

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/views/view_review.php
	# ----------------------------------------------------------------------------------------------------

	$item_review = "";
	
	if (!$item_type) $item_type = 'listing';
	
	if (!$itemObj) {
    	if ($item_type == 'listing') {
    		$itemObj = new Listing($item_id);
    	} else if ($item_type == 'article') {
    	    $itemObj = new Article($item_id);
    	}
    }
	
	$item_default_url = constant(strtoupper($item_type).'_DEFAULT_URL');

	###################################################################
	######################     REVIEWS    #############################
	###################################################################

	setting_get("review_".$item_type."_enabled", $review_enabled);
	if ($review_enabled == "on") {

		$rateObj = new Review();
		$rate_avg = $rateObj->getRateAvgByItem($item_type, $itemObj->getString("id"));
		unset($rate_stars);

		if ($rate_avg) {

			$db = db_getDBObject();
			$sql ="SELECT * FROM Review WHERE item_type = '$item_type' AND item_id = '".$itemObj->getString("id")."' and approved=1 ";
			$r = $db->query($sql);
			$review_amount =mysql_affected_rows();

			$rate_stars .= "<li class=\"ratingStar\">&nbsp;&nbsp;";
			for ($x=0 ; $x < 5 ;$x++) {
				if ($rate_avg > $x) {
						$y = $x + 1;
						//$rate_stars .= "<img src='".DEFAULT_URL."/images/".$y."s.jpg' alt='Star On' />";
				}
				
				else ;//$rate_stars .= "<img src='".DEFAULT_URL."/images/estrelao.jpg' alt='Star Off' />";
			}
			$rate_stars .= "</li>";
			
			//Link to open the Review Form
			$linkReviewFormPopup = $item_default_url."/reviewformpopup.php?width=740&height=400&item_type=".$item_type."&item_id=".$itemObj->getNumber("id");
			$linkReviewFormPopup = "tb_show('', '$linkReviewFormPopup');void(0);";
			
			$item_review .= "<ul class=\"rating\">";

				//if ($user) {

					$sql = "SELECT * FROM Review WHERE item_type = '$item_type' AND item_id = ".$itemObj->getNumber("id")." AND review IS NOT NULL AND review != '' AND approved=1";
					$dbObj = db_getDBObject();
					$result = $dbObj->query($sql);
					$review_str = $review_amount == 1 ? system_showText(LANG_REVIEWCOUNT) : system_showText(LANG_REVIEWCOUNT_PLURAL);

					if (mysql_num_rows($result) > 0) {

						if (MODREWRITE_FEATURE == "on") {
							$reviewsLink = $item_default_url."/reviews/".$itemObj->getString("friendly_url");
						} else {
							$reviewsLink = $item_default_url."/comments.php?item_type=".$item_type."&item_id=".$itemObj->getNumber("id");
						}

						$item_review .= "<a href='".$reviewsLink."'>".$rate_stars."</a>";//<li class=\"ratingReview\"><a href='".$reviewsLink."'>(".$review_amount." " . $review_str . ")</a></li><li class=\"ratingSeeComment\"><a href='".$reviewsLink."'>".system_showText(LANG_REVIEWSEECOMMENTS)."</a></li>";

					} else {
						$item_review .= $rate_stars."<li class=\"ratingReview\">(".$review_amount." " . $review_str . ")</li>";
					}

				//} else {

					$sql = "SELECT * FROM Review WHERE item_type = '$item_type' AND item_id = ".$itemObj->getNumber("id")." AND review IS NOT NULL AND review != ''";
					$dbObj = db_getDBObject();
					$result = $dbObj->query($sql);
					$plural = $review_amount == 1 ? false : true;
					if ($review_amount > 0) {
						//$item_review .= $rate_stars."<li class=\"ratingReview\"><a href='javascript:void(0);'>(" . $review_amount . " " . system_showText(($plural ? LANG_REVIEWCOUNT_PLURAL : LANG_REVIEWCOUNT)) . ")</a></li><li class=\"ratingSeeComment\"><a href='javascript:void(0);'>".system_showText(LANG_REVIEWSEECOMMENTS)."</a></li>";
					} else {
						//$item_review .= $rate_stars."<li class=\"ratingReview\">(".$review_amount." " . system_showText(($plural ? LANG_REVIEWCOUNT_PLURAL : LANG_REVIEWCOUNT)) . ")</li>";
					}

				//}

		



				

			$item_review .= "</ul>";

		}

	}

	###################################################################
	###################################################################
	###################################################################

?>
