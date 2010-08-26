<?


	if (MODREWRITE_FEATURE == "on") {
		$detailLink = "/".$listing->getString("friendly_url").".html";
	} else {
		$detailLink = "".LISTING_DEFAULT_URL."/detail.php?id=".$listing->getNumber("id");
	}

    $listingtemplate_friendly_url = $listing->getString("friendly_url");
    
	if ($listing->getNumber("listingtemplate_id") > 0) {
		$templateObj = new ListingTemplate($listing->getNumber("listingtemplate_id"));
		if($templateObj && $templateObj->getString("status")=="enabled") {
			$template_title_field = $templateObj->getListingTemplateFields("title");
			$template_address_field = $templateObj->getListingTemplateFields("address");
			$template_address2_field = $templateObj->getListingTemplateFields("address2");
		}
	}

	$listingtemplate_icon_navbar = "";
	if (!strpos($_SERVER["PHP_SELF"], "print.php")) {
		include(EDIRECTORY_ROOT."/includes/views/icon_listing.php");
		$listingtemplate_icon_navbar = $icon_navbar;
		$icon_navbar = "";
	}
	
	$listingtemplate_claim = "";
	if (CLAIM_FEATURE == "on") {
		if (!$listing->getNumber("account_id")) {
			if ($listing->getString("claim_disable") == "n") {
				customtext_get("claim_textlink", $claim_textlink, EDIR_LANGUAGE);
				if ($claim_textlink) $claim_textlink_string = $claim_textlink;
				$listingtemplate_claim = "<a href=\"".$claim_link."\">".$claim_textlink_string."</a>";
			}
		}
	}

	$listingtemplate_video_snippet_width = "";
	$listingtemplate_video_snippet_height = "";
	$listingtemplate_video_snippet = "";
	if ($listing->getString("video_snippet")) {
		$listingtemplate_video_snippet_width = IMAGE_LISTING_THUMB_WIDTH + 25;
		$listingtemplate_video_snippet_height = IMAGE_LISTING_THUMB_HEIGHT + 10;
		$listingtemplate_video_snippet = system_getVideoSnippetCode($listing->getString("video_snippet", false), IMAGE_LISTING_THUMB_WIDTH, IMAGE_LISTING_THUMB_HEIGHT);
	}

	$listingtemplate_image_width = "";
	$listingtemplate_image_heigth = "";
	$listingtemplate_image = "";
	$listingtemplate_image_width = IMAGE_LISTING_THUMB_WIDTH + 25;
	$listingtemplate_image_heigth = IMAGE_LISTING_THUMB_HEIGHT + 10;
	$imageObj = new Image($listing->getNumber("thumb_id"));
	if ($imageObj->imageExists()) {
		if (($user) && ($level->getDetail($listing->getNumber("level")) == "y")) {
			$listingtemplate_image .= "<a href=\"".$detailLink."\">";
			$listingtemplate_image .= $imageObj->getTag(true, IMAGE_LISTING_THUMB_WIDTH, IMAGE_LISTING_THUMB_HEIGHT, $listing->getString("title", true));
			$listingtemplate_image .= "</a>";
		} else {
			$listingtemplate_image .= $imageObj->getTag(true, IMAGE_LISTING_THUMB_WIDTH, IMAGE_LISTING_THUMB_HEIGHT, $listing->getString("title", true));
		}
	} else {
		if (($user) && ($level->getDetail($listing->getNumber("level")) == "y")) {
			$listingtemplate_image .= "<div class=\"noimage\" style=\"width:".(IMAGE_LISTING_THUMB_WIDTH+5)."px; height:".(IMAGE_LISTING_THUMB_HEIGHT)."px; cursor: pointer;\">";
			$listingtemplate_image .= "<a href=\"".$detailLink."\" style=\"width:".(IMAGE_LISTING_THUMB_WIDTH+5)."px; height:".(IMAGE_LISTING_THUMB_HEIGHT)."px;\">&nbsp;</a>";
			$listingtemplate_image .= "</div>";
		} else {
			$listingtemplate_image .= "<div class=\"noimage\" style=\"width:".(IMAGE_LISTING_THUMB_WIDTH+5)."px; height:".(IMAGE_LISTING_THUMB_HEIGHT)."px;\">&nbsp;</div>";
		}
	}

	$listingtemplate_google_maps = "";
	if (GOOGLE_MAPS_ENABLED == "on") { 
		$google_image_id = $listing->getNumber("thumb_id");
		$google_title = $listing->getString('title');
		$google_phone = $listing->getString('phone');
		$google_address = $listing->getString('address');
		$google_address2 = $listing->getString('address2');
		$google_zipcode = $listing->getString('zip_code');
		$google_maptuning = $listing->getString('maptuning');
		$google_location = $listing->getLocationString("r, s, z", true);
		$google_country = $listing->getLocationString("C", true);
		$google_state = $listing->getLocationString("s", true);
		$google_city = $listing->getLocationString("r", true);
		$google_zip = $listing->getLocationString("z", true);
		$google_maptuning = $listing->getLocationString("t", true);
		$google_location_showaddress = $listing->getLocationString("A, r, s", true);
		$show_html = true;
		include(INCLUDES_DIR."/views/view_google_maps.php");
		$listingtemplate_google_maps = $google_maps;
		$google_maps = "";
	}

	$listingtemplate_title = "";
	if (($user) && ($level->getDetail($listing->getNumber("level")) == "y")) {
		$listingtemplate_title = "<a href=\"".$detailLink."\">".$listing->getString("title", true)."<img border=\"o\" alt=\"Site\" src=\"images/url.jpg\"/></a>";
	} else {
		$listingtemplate_title = $listing->getString("title", true);
	}
	if (zipproximity_getDistanceLabel($zip, "listing", $listing->getNumber("id"), $distance_label)) {
		$listingtemplate_title .= " (".$distance_label.")";
	}
	
	$listingdetailsbtn = "";
	$listingdetailsbtn .= "<div id=\"vejamais\">";
	$listingdetailsbtn .= "<a href=\"".$detailLink."\"><img border=\"o\" alt=\"Site\" src=\"images/vejamais.jpg\"/></a>";
	$listingdetailsbtn .= "</div>";
	

	$listingtemplate_complementaryinfo = "";
	$listingtemplate_complementaryinfo = system_itemRelatedCategories($listing->getNumber("id"), "listing", $user);

	$listingtemplate_designations = "";
	include(INCLUDES_DIR."/tables/table_choice.php");
	$listingtemplate_designations = $designations;
	$designations = "";

	$listingtemplate_address = "";
	if ($listing->getString("address")) {
		$listingtemplate_address = nl2br($listing->getString("address", true));
	}

	$listingtemplate_address2 = "";
	if ($listing->getString("address2")) {
		$listingtemplate_address2 = nl2br($listing->getString("address2", true));
	}

	$listingtemplate_location = "";
	$listingtemplate_location = $listing->getLocationString("r, s z", true);

	$listingtemplate_description = "";
	if ($listing->getStringLang(EDIR_LANGUAGE, "description")) {
		$listingtemplate_description = nl2br($listing->getStringLang(EDIR_LANGUAGE, "description", true));
	}

	$listingtemplate_phone = "";
	if ($listing->getString("phone")) {
		if ($user) {
			$listingtemplate_phone .= "<span class=\"numeroTelefone\">".$listing->getString("phone", true)."</span>";
		} else {
			$listingtemplate_phone = $listing->getString("phone", true);
		}
	}

	$listingtemplate_fax = "";
	if ($listing->getString("fax")) {
		if ($user) {
			$listingtemplate_fax .= "<span id=\"faxLink".$listing->getNumber("id")."\" class=\"controlFaxShow\"><a href=\"javascript:showFax('".$listing->getNumber("id")."','".DEFAULT_URL."');\">".system_showText(LANG_LISTING_VIEWFAX)."</a></span>";
			$listingtemplate_fax .= "<span id=\"faxNumber".$listing->getNumber("id")."\" class=\"controlFaxHide\">".$listing->getString("fax", true)."</span>";
		} else {
			$listingtemplate_fax = $listing->getString("fax", true);
		}
	}

	$listingtemplate_url = "";
	if ($listing->getString("url")) {
		$display_url = $listing->getString("url");
		if ($listing->getString("display_url")) {
			$display_url = $listing->getString("display_url");
		}
		$display_url = wordwrap($display_url, 30, "<br />", true);
		if ($user) {
			$listingtemplate_url = "<a href=\"".DEFAULT_URL."/listing_reports.php?report=website&amp;id=".$listing->getNumber("id")."\" target=\"_blank\">".$display_url."</a>";
		} else {
			$listingtemplate_url = "<a href=\"javascript:void(0);\">".$display_url."</a>";
		}
	}

	$listingtemplate_email = "";
	if ($listing->getString("email")) {
		if ($user){
			if ($level->getDetail($listing->getNumber("level")) == "y") {
		//		$listingtemplate_email = "<a href=\"".$detailLink."#info\">".$listing->getString("email", true)."</a>";
			
				$listingtemplate_email = $listing->getString("email", true);
				
			
			} else {
				$listingtemplate_email = "<a href=\"javascript: void(0);\" onclick=\"javascript:window.open('".LISTING_DEFAULT_URL."/emailform.php?id=".$listing->getNumber("id")."&amp;receiver=owner', 'popup', 'toolbar=0, location=0, directories=0, status=0, width=700, height=370, screenX=0, screenY=0, menubar=0, scrollbars, resizable');\">".$listing->getString("email", true)."</a>";
			}
		} else {
			$listingtemplate_email = "<a href=\"javascript:void(0);\">".$listing->getString("email", true)."</a>";
		}
	}

	$listingtemplate_attachment_file = "";
	if ($listing->getString("attachment_file")) {
		if (file_exists(EXTRAFILE_DIR."/".$listing->getString("attachment_file"))) {
			$listingtemplate_attachment_file .= "<p>";
				$listingtemplate_attachment_file .= "<a href=\"".EXTRAFILE_URL."/".$listing->getString("attachment_file")."\" target=\"_blank\">";
					if ($listing->getString("attachment_caption")) {
						$listingtemplate_attachment_file .= $listing->getString("attachment_caption");
					} else {
						$listingtemplate_attachment_file .= system_showText(LANG_LISTING_ATTACHMENT);
					}
				$listingtemplate_attachment_file .= "</a>";
			$listingtemplate_attachment_file .= "</p>";
		}
	}

	$listingtemplate_category_tree = "";
	$categories = $listing->getCategories();
	if ($categories) {
		foreach ($categories as $categoryObj) {
			if (strpos($categoryObj->getString("lang"), EDIR_LANGUAGE) !== false) {
				$arr_full_path[] = $categoryObj->getFullPath();
			}
		}
		if ($arr_full_path) $listingtemplate_category_tree = system_generateCategoryTree($categories, $arr_full_path, "listing", $user, EDIR_LANGUAGE);
	}

	$listingtemplate_long_description = "";
	if ($listing->getStringLang(EDIR_LANGUAGE, "long_description")) {
		$listingtemplate_long_description = nl2br($listing->getStringLang(EDIR_LANGUAGE, "long_description", true));
	}

	$listingtemplate_hours_work = "";
	if ($listing->getString("hours_work")) {
		$listingtemplate_hours_work = nl2br($listing->getString("hours_work", true));
	}

	$listingtemplate_locations = "";
	if ($listing->getString("locations")) {
		$listingtemplate_locations = nl2br($listing->getString("locations", true));
	}

	$listingtemplate_gallery = "";
	$listingtemplate_gallery = system_showFrontGallery($listing->getGalleries(), $listing->getNumber("level"), $user, 4, $user, "listing");

	$listingtemplate_review = "";
	setting_get("review_listing_enabled", $review_enabled);
	if ($review_enabled == "on") {
		$item_type = 'listing';
		$item_id   = $listing->getNumber('id');
		$itemObj   = $listing;
		include(INCLUDES_DIR."/views/view_review.php");
		$listingtemplate_review .= $item_review;
		$item_review = "";
	}

	$listing_review_bellow_title = "";
	setting_get("review_listing_enabled", $review_enabled);
	if ($review_enabled == "on") {
		$item_type = 'listing';
		$item_id   = $listing->getNumber('id');
		$itemObj   = $listing;
		include(INCLUDES_DIR."/views/view_review_bellow_title.php");
		$listing_review_bellow_title .= $item_review;
		$item_review = "";
	}
	
	
	
	
	$moreinfo_link = "";
	$moreinfo_label = "";
	if ($level->getDetail($listing->getNumber("level")) == "y") {
		if ($user) {
			$moreinfo_link = $detailLink;
			$moreinfo_label = system_showText(LANG_LISTING_MOREINFO) . " &raquo;";
		} else {
			$moreinfo_link = "javascript:void(0);";
			$moreinfo_label = system_showText(LANG_LISTING_MOREINFO);
		}
	}

	$listingviewtype = "summary";
	include(INCLUDES_DIR."/views/view_listing.php");

?>
