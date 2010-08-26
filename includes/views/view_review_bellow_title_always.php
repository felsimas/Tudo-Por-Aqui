<?
$item_review="";
	if (!$bt_rate_off){
						if ($review_amount > 0) {
							$item_review .= "<center><br><a href=\"javascript:void(0)\" onclick=\"".$linkReviewFormPopup."\" >" . system_showText(LANG_REVIEWRATEIT) . "</center></a>";
						} else {
							 $item_review .= "<center><br><a href=\"javascript:void(0)\" onclick=\"".$linkReviewFormPopup."\" >" . system_showText(LANG_REVIEWBETHEFIRST) . "</center></a>";
						}
					}






?>