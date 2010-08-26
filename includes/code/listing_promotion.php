<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/code/listing_promotion.php
	# ----------------------------------------------------------------------------------------------------

	$errorPage = "$url_redirect/".(($search_page) ? "search.php" : "index.php")."?message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."";
	$level = new ListingLevel();

	if ($id) {
		$listing = new Listing($id);
		if ((!$listing->getNumber("id")) || ($listing->getNumber("id") <= 0)) {
			header("Location: ".$errorPage);
			exit;
		}
		if ((sess_getAccountIdFromSession() != $listing->getNumber("account_id")) && (!strpos($url_base, "/gerenciamento"))) {
			header("Location: ".$errorPage);
			exit;
		}
		$listingHasPromotion = $level->getHasPromotion($listing->getNumber("level"));
		if ((!$listingHasPromotion) || ($listingHasPromotion != "y")) {
			header("Location: ".$errorPage);
			exit;
		}
	} else {
		header("Location: ".$errorPage);
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		if ($promotion_id >= 0) {

			$listing->setNumber("promotion_id", $promotion_id);
			$listing->Save();

			$message = system_showText(LANG_MSG_PROMOTION_SUCCESSFULLY_CHANGED);

			header("Location: $url_redirect/".(($search_page) ? "search.php" : "index.php")."?message=".urlencode($message)."&screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
			exit;

		} else {

			if (strpos($url_base, "/membros")) {

				$by_key = array("id", "account_id");
				$by_value = array(db_formatNumber($promotion_id*(-1)), sess_getAccountIdFromSession());
				$myPromotion = db_getFromDB("promotion", $by_key, $by_value);

				$by_key = array("promotion_id", "account_id");
				$by_value = array(db_formatNumber($myPromotion->getNumber("id")), sess_getAccountIdFromSession());
				$myListing = db_getFromDB("listing", $by_key, $by_value);

			} else {

				$myPromotion = db_getFromDB("promotion", "id", db_formatNumber($promotion_id*(-1)));
				$myListing = db_getFromDB("listing", "promotion_id", $myPromotion->getNumber("id"));

			}

			$message_listingpromotion = system_showText(LANG_MSGERROR_PROMOTIONOPERATIONNOTALLOWED1)." \"".$myPromotion->getString("name")."\" ".system_showText(LANG_MSGERROR_PROMOTIONOPERATIONNOTALLOWED2)." \"".$myListing->getString("title")."\".";

		}

	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	$listing->extract();

	// Construct the Promotion Drop Down
	$promotions = db_getFromDBBySQL("promotion", "SELECT * FROM Promotion WHERE account_id=".$listing->getNumber("account_id")." AND end_date>=DATE_FORMAT(NOW(), '%Y-%m-%d') ORDER BY name ", "array");
	$promos = db_getFromDBBySQL("promotion", "SELECT DISTINCT promotion_id FROM Listing WHERE promotion_id > 0", "array");
	if ($promos) foreach ($promos as $myPromo) {
		$promo[] = $myPromo[0];
	}
	$promotionDropDown = "<select name=\"promotion_id\" class=\"input-dd-form-listing\">";
		if ($promotion_id > 0 ) $promotionDropDown .= "<option value=\"\" selected=\"selected\">-- ".system_showText(LANG_LABEL_NO_PROMOTION)." --</option>";
		else $promotionDropDown .= "<option value=\"\" selected=\"selected\">-- ".system_showText(LANG_LABEL_SELECT_PROMOTION)." --</option>";
		if ($promotions) foreach ($promotions as $promotion) {
			$val = $promotion["id"];
			$sel = "";
			$dis = "";
			if (($promotion_id == $promotion["id"]) && ($promotion_id != "")) {
				$sel = "selected";
			}
			if (($promo) && (in_array($promotion["id"], $promo)) && ($promotion["id"] != $promotion_id)) {
				$dis = "style=\"color: #DDD;\"";
				$val = "-".$promotion["id"];
			}
			$promotionDropDown .= "<option value=\"".$val."\" $sel $dis>".$promotion["name"]."</option>";
		}
	$promotionDropDown .= "</select>";

?>