<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/views/view_rating.php
	# ----------------------------------------------------------------------------------------------------

	$listing_reviewcomment = "";

	if ($rating) {
		unset($rate_stars);
		for ($x=0 ; $x < 5 ;$x++) {
			if ($rating > $x) $rate_stars .= "<img src=\"".DEFAULT_URL."/images/design/img_rateSmallStarOn.gif\" alt=\"Star On\" align=\"bottom\" />";
			else $rate_stars .= "<img src=\"".DEFAULT_URL."/images/design/img_rateSmallStarOff.gif\" alt=\"Star Off\" align=\"bottom\" />";
		}
	}

	$listing_reviewcomment .= "<table align=\"center\" border=\"1\" cellpadding=\"0\" cellspacing=\"0\" class=\"rateComments\">";

	if ($show_listing) {

		$listing_reviewcomment .= "<tr>";
			$listing_reviewcomment .= "<th>";
				$listing_reviewcomment .= "<a href=\"".$url_base."/listing/view.php?id=".$listing_id."\">";
					$listingObj = new Listing($listing_id);
					$listing_reviewcomment .= $listingObj->getString("title");
				$listing_reviewcomment .= "</a>";
			$listing_reviewcomment .= "</th>";
		$listing_reviewcomment .= "</tr>";

	}

	$listing_reviewcomment .= "<tr>";
		$listing_reviewcomment .= "<th class=\"rateCommentssubTitle\">".$review_title." ".$rate_stars." <span>- ".format_date($added, DEFAULT_DATE_FORMAT." H:i:s", "datetime")."</span></th>";
	$listing_reviewcomment .= "</tr>";

	$listing_reviewcomment .= "<tr>";
		$listing_reviewcomment .= "<td>";
			$listing_reviewcomment .= "<strong>";
				$listing_reviewcomment .= ($reviewer_name) ? $reviewer_name : "N/A";
			$listing_reviewcomment .= "</strong>";
			$listing_reviewcomment .= " from ";
			$listing_reviewcomment .= "<strong>";
				$listing_reviewcomment .= ($reviewer_location) ? $reviewer_location : "N/A";
			$listing_reviewcomment .= "</strong>";
			$listing_reviewcomment .= "<br />";
			$listing_reviewcomment .= (nl2br($review)) ? nl2br($review) : "N/A";
		$listing_reviewcomment .= "</td>";
	$listing_reviewcomment .= "</tr>";

	$listing_reviewcomment .= "</table>";

?>
