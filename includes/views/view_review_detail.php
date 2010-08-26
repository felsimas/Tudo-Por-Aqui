<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/views/view_review_detail.php
	# ----------------------------------------------------------------------------------------------------

	$item_reviewcomment = "";
	
	if (!$item_type) $item_type = 'listing';
	
	if (!$itemObj) {
    	if ($item_type == 'listing') {
    		$itemObj = new Listing($item_id);
    	} else if ($item_type == 'article') {
    	    $itemObj = new Article($item_id);
    	}
    }
	
	$item_default_url = @constant(strtoupper($item_type).'_DEFAULT_URL');

	$item_reviewcomment .= "<div class=\"rateComments\">";

	if ($rating) {
		unset($rate_stars);
		for ($x=0 ; $x < 5 ;$x++) {
			if ($rating > $x) {
				$y = $x + 1;
				$rate_stars .= "<img src=\"".DEFAULT_URL."/images/".$y."s.jpg\" alt=\"Star On\" align=\"bottom\" />";
			}
			else $rate_stars .= "<img src=\"".DEFAULT_URL."/images/estrelao.jpg\" alt=\"Star Off\" align=\"bottom\" />";
		}
	}

    if (!$itemObj) {
    	if ($item_type == 'listing') {
    		$itemObj = new Listing($item_id);
    	} else if ($item_type == 'article') {
    	    $itemObj = new Article($item_id);
    	}
    } 
    
	if ($show_item) {

        if (!$user) $linkstr = "javascript:void(0)";
        if (strpos($url_base, 'sitemgr')) {
            $linkstr = $url_base."/".$item_type."/view.php?id=".$item_id;
        } else {
            $linkstr = $item_default_url."/detail.php?id=".$item_id;
        }
		$item_reviewcomment .= "<h3><a href=\"".$linkstr."\">";
			$item_reviewcomment .= $itemObj->getString("title");
		$item_reviewcomment .= "</a></h3>";

	}
	$item_reviewcomment_bellow_title .= "<div class=\"rateStars\">".$rate_stars."</div>";
	
	$item_reviewcomment .= "<div class=\"rateStars\">".$rate_stars."</div>";

//	$item_reviewcomment .= "<h3>".$review_title."</h3>";

	$item_reviewcomment .= "<p class=\"complementaryInfo\">";
		$item_reviewcomment .= "<strong>";
			$item_reviewcomment .= ($reviewer_name) ? $reviewer_name : system_showText(LANG_NA);
		$item_reviewcomment .= "</strong>";
		$item_reviewcomment .= " ".system_showText(LANG_FROM)." ";
		$item_reviewcomment .= "<strong>";
			$item_reviewcomment .= ($reviewer_location) ? $reviewer_location : system_showText(LANG_NA);
		$item_reviewcomment .= "</strong>";
		$item_reviewcomment .= "  - ".format_date($added, DEFAULT_DATE_FORMAT." H:i:s", "datetime");
	$item_reviewcomment .= "</p>";
	$item_reviewcomment .= "<img style=\"vertical-align: bottom;\" class=\"CommentArrow\" alt=\"\" src=\"http://www.outofhandfestival.com/components/com_jomcomment/templates/chatterx/images/spacer.gif\">";
	$item_reviewcomment .= "<p class=\"review\">".((nl2br($review)) ? nl2br($review) : system_showText(LANG_NA))."</p>";
	
    if($responseapproved == 1) {
	    $item_reviewcomment .= "<div class=\"response\">";
		   // $item_reviewcomment .= "<h4>Resposta: " . $review_title . "</h4>";
			$item_reviewcomment .= "<h4>" . $listing->getString('title') . "</h4>";
			
			
			$item_reviewcomment .= "<img style=\"vertical-align: bottom;\" class=\"CommentArrow\" alt=\"\" src=\"http://www.outofhandfestival.com/components/com_jomcomment/templates/chatterx/images/spacer.gif\">";
		   
		 $item_reviewcomment .= "<p class=\"review\">". nl2br($response) . "</p>";
	    $item_reviewcomment .= "</div>";
    }

	$item_reviewcomment .= "</div>";
?>