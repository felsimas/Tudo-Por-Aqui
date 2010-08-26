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
$rate_stars = "";

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
	else{
		$rate_stars .= "<img src=\"".DEFAULT_URL."/images/estrelao.jpg\" alt=\"Star Off\" align=\"bottom\" /><img src=\"".DEFAULT_URL."/images/estrelao.jpg\" alt=\"Star Off\" align=\"bottom\" /><img src=\"".DEFAULT_URL."/images/estrelao.jpg\" alt=\"Star Off\" align=\"bottom\" /><img src=\"".DEFAULT_URL."/images/estrelao.jpg\" alt=\"Star Off\" align=\"bottom\" /><img src=\"".DEFAULT_URL."/images/estrelao.jpg\" alt=\"Star Off\" align=\"bottom\" />";}

    if (!$itemObj) {
    	if ($item_type == 'listing') {
    		$itemObj = new Listing($item_id);
    	} else if ($item_type == 'article') {
    	    $itemObj = new Article($item_id);
    	}
    } 
       
$item_review="";
		if (!$bt_rate_off){
						if ($review_amount > 0) {
						//	$item_review .= "<center><br>&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"javascript:void(0)\" onclick=\"".$linkReviewFormPopup."\" >" . system_showText(LANG_REVIEWRATEIT) . "</center></a>";
						$item_review .= "";
						
						} else {
							 $item_noreview = "<center><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"javascript:void(0)\" onclick=\"".$linkReviewFormPopup."\" >" . system_showText(LANG_REVIEWBETHEFIRST) . "</center></a>";
						}
					}
	$item_reviewcomment .= "<div class=\"rateStarsTitle\">".$rate_stars."</div>".$item_review;






?>