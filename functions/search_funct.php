<?


	function search_frontListingSearch($search_for, $section) {

		$searchReturn["select_columns"] = false;
		$searchReturn["from_tables"]    = false;
		$searchReturn["where_clause"]   = false;
		$searchReturn["group_by"]       = false;
		$searchReturn["order_by"]       = false;

		if (($section == "listing") || ($section == "random") || ($section == "mobile")) {
			$searchReturn["select_columns"] = "Listing.*, review.avgrating, review.countrating, Report_Listing.views";
		} elseif ($section == "count") {
			$searchReturn["select_columns"] = "COUNT(DISTINCT(Listing.id))";
		} elseif ($section == "rss") {
			$searchReturn["select_columns"] = "Listing.id";
		}




		$searchReturn["from_tables"] = "Listing left JOIN ( SELECT item_id, avg( rating ) AS avgrating, count( rating ) AS countrating FROM `Review` WHERE approved =1 GROUP BY item_id ) review ON Listing.id = review.item_id left JOIN ( SELECT listing_id, sum( report_amount ) AS views FROM `Report_Listing` WHERE 1 GROUP BY listing_id ) Report_Listing ON Listing.id = Report_Listing.listing_id";

		if (isset($search_for["id"]) && is_numeric($search_for["id"])) {
			$where_clause[] = "Listing.id = ".$search_for["id"]."";
		}

		if (isset($search_for["template_id"]) && is_numeric($search_for["template_id"])) {
			$where_clause[] = "Listing.listingtemplate_id = ".$search_for["template_id"]."";
			for ($i=0; $i<10; $i++) {
				if ($search_for["checkbox".$i] == "y") $where_clause[] = "Listing.custom_checkbox".$i." = ".db_formatString($search_for["checkbox".$i])."";
				if ($search_for["dropdown".$i]) $where_clause[] = "Listing.custom_dropdown".$i." = ".db_formatString($search_for["dropdown".$i])."";
				if ($search_for["text".$i]) $where_clause[] = "Listing.custom_text".$i." LIKE ".db_formatString("%".$search_for["text".$i]."%")."";
				if ($search_for["fromtext".$i]) $where_clause[] = "CAST(Listing.custom_text".$i." AS SIGNED INTEGER) >= CAST(".db_formatNumber($search_for["fromtext".$i])." AS SIGNED INTEGER)";
				if ($search_for["totext".$i]) $where_clause[] = "CAST(Listing.custom_text".$i." AS SIGNED INTEGER) <= CAST(".db_formatNumber($search_for["totext".$i])." AS SIGNED INTEGER)";
				if ($search_for["short_desc".$i]) $where_clause[] = "Listing.custom_short_desc".$i." LIKE ".db_formatString("%".$search_for["short_desc".$i]."%")."";
				if ($search_for["long_desc".$i]) $where_clause[] = "Listing.custom_long_desc".$i." LIKE ".db_formatString("%".$search_for["long_desc".$i]."%")."";
			}
		}

		$where_clause[] = "Listing.status = 'A'";

		if ($search_for["category_id"]) {
			$where_clause[] = "(Listing.cat_1_id = ".$search_for["category_id"]." OR Listing.parcat_1_level1_id = ".$search_for["category_id"]." OR Listing.parcat_1_level2_id = ".$search_for["category_id"]." OR Listing.parcat_1_level3_id = ".$search_for["category_id"]." OR Listing.parcat_1_level4_id = ".$search_for["category_id"]." OR Listing.cat_2_id = ".$search_for["category_id"]." OR Listing.parcat_2_level1_id = ".$search_for["category_id"]." OR Listing.parcat_2_level2_id = ".$search_for["category_id"]." OR Listing.parcat_2_level3_id = ".$search_for["category_id"]." OR Listing.parcat_2_level4_id = ".$search_for["category_id"]." OR Listing.cat_3_id = ".$search_for["category_id"]." OR Listing.parcat_3_level1_id = ".$search_for["category_id"]." OR Listing.parcat_3_level2_id = ".$search_for["category_id"]." OR Listing.parcat_3_level3_id = ".$search_for["category_id"]." OR Listing.parcat_3_level4_id = ".$search_for["category_id"]." OR Listing.cat_4_id = ".$search_for["category_id"]." OR Listing.parcat_4_level1_id = ".$search_for["category_id"]." OR Listing.parcat_4_level2_id = ".$search_for["category_id"]." OR Listing.parcat_4_level3_id = ".$search_for["category_id"]." OR Listing.parcat_4_level4_id = ".$search_for["category_id"]." OR Listing.cat_5_id = ".$search_for["category_id"]." OR Listing.parcat_5_level1_id = ".$search_for["category_id"]." OR Listing.parcat_5_level2_id = ".$search_for["category_id"]." OR Listing.parcat_5_level3_id = ".$search_for["category_id"]." OR Listing.parcat_5_level4_id = ".$search_for["category_id"].")";
			// The GROUP BY needs to be used when it has relationship table between item and category.
			//if ($section != "count") {
			//	$searchReturn["group_by"] = "Listing.id";
			//}
		}

		if ($search_for["estado_id"] || $search_for["cidade_id"] || $search_for["bairro_id"] || $search_for["city_id"] || $search_for["area_id"]) {
			if ($search_for["estado_id"]) {
				$sql_location[] = "Listing.estado_id = ".$search_for["estado_id"]."";
			}
			if ($search_for["cidade_id"]) {
				$sql_location[] = "Listing.cidade_id = ".$search_for["cidade_id"]."";
			}
			if ($search_for["bairro_id"]) {
				$sql_location[] = "Listing.bairro_id = ".$search_for["bairro_id"]."";
			}
			if ($search_for["city_id"]) {
				$sql_location[] = "Listing.city_id = ".$search_for["city_id"]."";
			}
			if ($search_for["area_id"]) {
				$sql_location[] = "Listing.area_id = ".$search_for["area_id"]."";
			}
			if ($sql_location) {
				$where_clause[] = "(".implode(" AND ", $sql_location).")";
			}
		}

		if (($search_for["keyword"]) && ($section != "mobile")) {
			$search_for["keyword"] = str_replace("\\", "", $search_for["keyword"]);
			$search_for_keyword_fields[] = "Listing.fulltextsearch_keyword";
			$where_clause[] = search_getSQLFullTextSearch($search_for["keyword"], $search_for_keyword_fields, "keyword_score", $order_by_keyword_score, $search_for["match"]);
		}

		if (($search_for["where"]) && ($section != "mobile")) {
			$search_for["where"] = str_replace("\\", "", $search_for["where"]);
			$search_for["where"] = str_replace(",", "", $search_for["where"]);
			$search_for_where_fields[] = "Listing.fulltextsearch_where";
			$where_clause[] = search_getSQLFullTextSearch($search_for["where"], $search_for_where_fields, "where_score", $order_by_where_score, "allwords");
		}

		if (($search_for["keyword"]) && ($section == "mobile")) {
			$search_for["where"] = $search_for["keyword"];
			$search_for["keyword"] = str_replace("\\", "", $search_for["keyword"]);
			$search_for_keyword_fields[] = "Listing.fulltextsearch_keyword";
			$search_for["where"] = str_replace("\\", "", $search_for["where"]);
			$search_for["where"] = str_replace(",", "", $search_for["where"]);
			$search_for_where_fields[] = "Listing.fulltextsearch_where";
			$where_clause[] = "(".search_getSQLFullTextSearch($search_for["keyword"], $search_for_keyword_fields, "keyword_score", $order_by_keyword_score, $search_for["match"])." OR ".search_getSQLFullTextSearch($search_for["where"], $search_for_where_fields, "where_score", $order_by_where_score, "allwords").")";
		}

		if ($search_for["zip"]) {
			$search_for["zip"] = str_replace("\\", "", $search_for["zip"]);
			$search_for["dist"] = str_replace("\\", "", $search_for["dist"]);
			if (ZIPCODE_PROXIMITY == "on") {
				if (zipproximity_getWhereZipCodeProximity($search_for["zip"], $search_for["dist"], $whereZipCodeProximity, $order_by_zipcode_score)) {
					$where_clause[] = $whereZipCodeProximity;
					if ($order_by_zipcode_score && ($section != "count") && ($section != "random")) {
						$searchReturn["select_columns"] .= ", ".$order_by_zipcode_score;
					}
				} else {
					$where_clause[] = "Listing.zip_code = ".db_formatString($search_for["zip"])."";
				}
			} else {
				$where_clause[] = "Listing.zip_code = ".db_formatString($search_for["zip"])."";
			}
		}

		if ($where_clause && (count($where_clause) > 0)) {
			$searchReturn["where_clause"] = implode(" AND ", $where_clause);
		}

		if (($section == "listing") || ($section == "mobile") || ($section == "rss")) {
			$searchReturn["order_by"] = "avgrating desc, review.countrating desc, Report_Listing.views DESC, Listing.level DESC, Listing.random_number DESC, Listing.title, Listing.id";
		} elseif ($section == "random") {
			$searchReturn["order_by"] = ((LISTING_SCALABILITY_OPTIMIZATION == "on")?("random_number DESC"):("RAND()"));
		} elseif ($section == "count") {
			$searchReturn["order_by"] = "Listing.id";
		}

		if ($search_for["keyword"] && $order_by_keyword_score && ($section != "count") && ($section != "random")) {
			$searchReturn["select_columns"] .= ", ".$order_by_keyword_score;
		}

		if ($search_for["where"] && $order_by_where_score && ($section != "count") && ($section != "random")) {
			$searchReturn["select_columns"] .= ", ".$order_by_where_score;
		}

		if ((($search_for["keyword"] && $order_by_keyword_score) || ($search_for["where"] && $order_by_where_score) || ($search_for["zip"] && $order_by_zipcode_score)) && ($section != "count") && ($section != "random")) {
			$searchReturn["order_by"] = "Listing.level DESC";
			if ($order_by_keyword_score) {
				$searchReturn["order_by"] .= ", keyword_score DESC";
			}
			if ($order_by_where_score) {
				$searchReturn["order_by"] .= ", where_score DESC";
			}
			if ($order_by_zipcode_score) {
				$searchReturn["order_by"] .= ", zipcode_score";
			}
		}

		return $searchReturn;

	}

	function search_frontPromotionSearch($search_for, $section) {

		$searchReturn["select_columns"] = false;
		$searchReturn["from_tables"] = false;
		$searchReturn["where_clause"] = false;
		$searchReturn["group_by"] = false;
		$searchReturn["order_by"] = false;

		if (($section == "promotion") || ($section == "random")) {
			$searchReturn["select_columns"] = "Promotion.*";
		} elseif ($section == "count") {
			$searchReturn["select_columns"] = "COUNT(DISTINCT(Promotion.id))";
		}

		$searchReturn["from_tables"] = "Promotion, Listing";

		if (isset($search_for["id"]) && is_numeric($search_for["id"])) {
			$where_clause[] = "Promotion.id = ".$search_for["id"]."";
		}

		$where_clause[] = "Listing.status = 'A'";

		$where_clause[] = "Promotion.end_date >= DATE_FORMAT(NOW(), '%Y-%m-%d')";

		$where_clause[] = "Listing.promotion_id > 0";

		$where_clause[] = "Listing.promotion_id = Promotion.id";

		$levelObj = new ListingLevel(EDIR_DEFAULT_LANGUAGE, true);
		$levels = $levelObj->getLevelValues();
		foreach ($levels as $each_level) {
			if ($levelObj->getHasPromotion($each_level) == "y") {
				$allowed_levels[] = $each_level;
			}
		}
		$search_levels = ($allowed_levels ? implode(",", $allowed_levels) : "0");
		$where_clause[] = "Listing.level IN ($search_levels)";

		if ($search_for["category_id"]) {
			$where_clause[] = "(Listing.cat_1_id = ".$search_for["category_id"]." OR Listing.parcat_1_level1_id = ".$search_for["category_id"]." OR Listing.parcat_1_level2_id = ".$search_for["category_id"]." OR Listing.parcat_1_level3_id = ".$search_for["category_id"]." OR Listing.parcat_1_level4_id = ".$search_for["category_id"]." OR Listing.cat_2_id = ".$search_for["category_id"]." OR Listing.parcat_2_level1_id = ".$search_for["category_id"]." OR Listing.parcat_2_level2_id = ".$search_for["category_id"]." OR Listing.parcat_2_level3_id = ".$search_for["category_id"]." OR Listing.parcat_2_level4_id = ".$search_for["category_id"]." OR Listing.cat_3_id = ".$search_for["category_id"]." OR Listing.parcat_3_level1_id = ".$search_for["category_id"]." OR Listing.parcat_3_level2_id = ".$search_for["category_id"]." OR Listing.parcat_3_level3_id = ".$search_for["category_id"]." OR Listing.parcat_3_level4_id = ".$search_for["category_id"]." OR Listing.cat_4_id = ".$search_for["category_id"]." OR Listing.parcat_4_level1_id = ".$search_for["category_id"]." OR Listing.parcat_4_level2_id = ".$search_for["category_id"]." OR Listing.parcat_4_level3_id = ".$search_for["category_id"]." OR Listing.parcat_4_level4_id = ".$search_for["category_id"]." OR Listing.cat_5_id = ".$search_for["category_id"]." OR Listing.parcat_5_level1_id = ".$search_for["category_id"]." OR Listing.parcat_5_level2_id = ".$search_for["category_id"]." OR Listing.parcat_5_level3_id = ".$search_for["category_id"]." OR Listing.parcat_5_level4_id = ".$search_for["category_id"].")";
			// The GROUP BY needs to be used when it has relationship table between item and category.
			//if ($section != "count") {
			//	$searchReturn["group_by"] = "Promotion.id";
			//}
		}

		if ($search_for["estado_id"] || $search_for["cidade_id"] || $search_for["bairro_id"] || $search_for["city_id"] || $search_for["area_id"]) {
			if ($search_for["estado_id"]) {
				$sql_location[] = "Listing.estado_id = ".$search_for["estado_id"]."";
			}
			if ($search_for["cidade_id"]) {
				$sql_location[] = "Listing.cidade_id = ".$search_for["cidade_id"]."";
			}
			if ($search_for["bairro_id"]) {
				$sql_location[] = "Listing.bairro_id = ".$search_for["bairro_id"]."";
			}
			if ($search_for["city_id"]) {
				$sql_location[] = "Listing.city_id = ".$search_for["city_id"]."";
			}
			if ($search_for["area_id"]) {
				$sql_location[] = "Listing.area_id = ".$search_for["area_id"]."";
			}
			if ($sql_location) {
				$where_clause[] = "(".implode(" AND ", $sql_location).")";
			}
		}

		if (($search_for["keyword"]) && ($section != "mobile")) {
			$search_for["keyword"] = str_replace("\\", "", $search_for["keyword"]);
			$search_for_keyword_fields_promotion[] = "Promotion.fulltextsearch_keyword";
			$search_for_keyword_fields_listing[] = "Listing.fulltextsearch_keyword";
			$where_clause[] = "(".search_getSQLFullTextSearch($search_for["keyword"], $search_for_keyword_fields_promotion, "keyword_score", $order_by_keyword_score, $search_for["match"])." OR ".search_getSQLFullTextSearch($search_for["keyword"], $search_for_keyword_fields_listing, "keyword_score", $order_by_keyword_score, $search_for["match"]).")";
		}

		if (($search_for["where"]) && ($section != "mobile")) {
			$search_for["where"] = str_replace("\\", "", $search_for["where"]);
			$search_for["where"] = str_replace(",", "", $search_for["where"]);
			$search_for_where_fields[] = "Listing.fulltextsearch_where";
			$where_clause[] = search_getSQLFullTextSearch($search_for["where"], $search_for_where_fields, "where_score", $order_by_where_score, "allwords");
		}

		if (($search_for["keyword"]) && ($section == "mobile")) {
			$search_for["where"] = $search_for["keyword"];
			$search_for["keyword"] = str_replace("\\", "", $search_for["keyword"]);
			$search_for_keyword_fields_promotion[] = "Promotion.fulltextsearch_keyword";
			$search_for_keyword_fields_listing[] = "Listing.fulltextsearch_keyword";
			$search_for["where"] = str_replace("\\", "", $search_for["where"]);
			$search_for["where"] = str_replace(",", "", $search_for["where"]);
			$search_for_where_fields[] = "Listing.fulltextsearch_where";
			$where_clause[] = "((".search_getSQLFullTextSearch($search_for["keyword"], $search_for_keyword_fields_promotion, "keyword_score", $order_by_keyword_score, $search_for["match"])." OR ".search_getSQLFullTextSearch($search_for["keyword"], $search_for_keyword_fields_listing, "keyword_score", $order_by_keyword_score, $search_for["match"]).") OR ".search_getSQLFullTextSearch($search_for["where"], $search_for_where_fields, "where_score", $order_by_where_score, "allwords").")";
		}

		if ($search_for["zip"]) {
			$search_for["zip"] = str_replace("\\", "", $search_for["zip"]);
			$search_for["dist"] = str_replace("\\", "", $search_for["dist"]);
			if (ZIPCODE_PROXIMITY == "on") {
				if (zipproximity_getWhereZipCodeProximity($search_for["zip"], $search_for["dist"], $whereZipCodeProximity, $order_by_zipcode_score)) {
					$where_clause[] = $whereZipCodeProximity;
					if ($order_by_zipcode_score && ($section != "count") && ($section != "random")) {
						$searchReturn["select_columns"] .= ", ".$order_by_zipcode_score;
					}
				} else {
					$where_clause[] = "Listing.zip_code = ".db_formatString($search_for["zip"])."";
				}
			} else {
				$where_clause[] = "Listing.zip_code = ".db_formatString($search_for["zip"])."";
			}
		}

		if ($where_clause && (count($where_clause) > 0)) {
			$searchReturn["where_clause"] = implode(" AND ", $where_clause);
		}

		if (($section == "promotion")) {
			$searchReturn["order_by"] = "Promotion.random_number DESC, Promotion.end_date, Promotion.name, Promotion.id";
		} elseif ($section == "random") {
			$searchReturn["order_by"] = ((PROMOTION_SCALABILITY_OPTIMIZATION == "on")?("random_number DESC"):("RAND()"));
		} elseif ($section == "count") {
			$searchReturn["order_by"] = "Promotion.id";
		}

		if ($search_for["keyword"] && $order_by_keyword_score && ($section != "count") && ($section != "random")) {
			$searchReturn["select_columns"] .= ", ".$order_by_keyword_score;
		}

		if ($search_for["where"] && $order_by_where_score && ($section != "count") && ($section != "random")) {
			$searchReturn["select_columns"] .= ", ".$order_by_where_score;
		}

		if ((($search_for["keyword"] && $order_by_keyword_score) || ($search_for["where"] && $order_by_where_score) || ($search_for["zip"] && $order_by_zipcode_score)) && ($section != "count") && ($section != "random")) {
			$searchReturn["order_by"] = "";
			if ($order_by_keyword_score) {
				if ($searchReturn["order_by"]) $searchReturn["order_by"] .= ", keyword_score DESC";
				else $searchReturn["order_by"] .= "keyword_score DESC";
			}
			if ($order_by_where_score) {
				if ($searchReturn["order_by"]) $searchReturn["order_by"] .= ", where_score DESC";
				else $searchReturn["order_by"] .= "where_score DESC";
			}
			if ($order_by_zipcode_score) {
				if ($searchReturn["order_by"]) $searchReturn["order_by"] .= ", zipcode_score";
				else $searchReturn["order_by"] .= "zipcode_score";
			}
		}

		return $searchReturn;

	}

	function search_frontEventSearch($search_for, $section) {

		$searchReturn["select_columns"] = false;
		$searchReturn["from_tables"] = false;
		$searchReturn["where_clause"] = false;
		$searchReturn["group_by"] = false;
		$searchReturn["order_by"] = false;

		if (($section == "event") || ($section == "random") || ($section == "mobile")) {
			$searchReturn["select_columns"] = "Event.*";
		} elseif ($section == "count") {
			$searchReturn["select_columns"] = "COUNT(DISTINCT(Event.id))";
		} elseif ($section == "rss") {
			$searchReturn["select_columns"] = "Event.id";
		}

		$searchReturn["from_tables"] = "Event";

		if (isset($search_for["id"]) && is_numeric($search_for["id"])) {
			$where_clause[] = "Event.id = ".$search_for["id"]."";
		}

		$where_clause[] = "Event.status = 'A'";

		$withoutDate = true;
		if (($search_for["this_date"]) && (!$search_for["month"])) {
			$search_for["this_date"] = substr($search_for["this_date"], 0, 4)."-".substr($search_for["this_date"], 4, 2)."-".substr($search_for["this_date"], 6);
			$where_clause[] = "DATE_FORMAT(Event.start_date, '%Y-%m-%d') <= ".db_formatString($search_for["this_date"])." AND DATE_FORMAT(Event.end_date, '%Y-%m-%d') >= ".db_formatString($search_for["this_date"])."";
			$withoutDate = false;
		}
		if ($search_for["month"]) {
			$search_for["month"] = substr($search_for["month"], 0, 4)."-".substr($search_for["month"], 4);
			$where_clause[] = "DATE_FORMAT(Event.start_date, '%Y-%m') <= ".db_formatString($search_for["month"])." AND DATE_FORMAT(Event.end_date, '%Y-%m') >= ".db_formatString($search_for["month"])."";
			$withoutDate = false;
		}
		if ($withoutDate) {
			$where_clause[] = "Event.end_date >= DATE_FORMAT(NOW(), '%Y-%m-%d')";
		}

		if ($search_for["category_id"]) {
			$where_clause[] = "(Event.cat_1_id = ".$search_for["category_id"]." OR Event.parcat_1_level1_id = ".$search_for["category_id"]." OR Event.cat_2_id = ".$search_for["category_id"]." OR Event.parcat_2_level1_id = ".$search_for["category_id"]." OR Event.cat_3_id = ".$search_for["category_id"]." OR Event.parcat_3_level1_id = ".$search_for["category_id"]." OR Event.cat_4_id = ".$search_for["category_id"]." OR Event.parcat_4_level1_id = ".$search_for["category_id"]." OR Event.cat_5_id = ".$search_for["category_id"]." OR Event.parcat_5_level1_id = ".$search_for["category_id"].")";
			// The GROUP BY needs to be used when it has relationship table between item and category.
			//if ($section != "count") {
			//	$searchReturn["group_by"] = "Event.id";
			//}
		}

		if ($search_for["estado_id"] || $search_for["cidade_id"] || $search_for["bairro_id"] || $search_for["city_id"] || $search_for["area_id"]) {
			if ($search_for["estado_id"]) {
				$sql_location[] = "Event.estado_id = ".$search_for["estado_id"]."";
			}
			if ($search_for["cidade_id"]) {
				$sql_location[] = "Event.cidade_id = ".$search_for["cidade_id"]."";
			}
			if ($search_for["bairro_id"]) {
				$sql_location[] = "Event.bairro_id = ".$search_for["bairro_id"]."";
			}
			if ($search_for["city_id"]) {
				$sql_location[] = "Event.city_id = ".$search_for["city_id"]."";
			}
			if ($search_for["area_id"]) {
				$sql_location[] = "Event.area_id = ".$search_for["area_id"]."";
			}
			if ($sql_location) {
				$where_clause[] = "(".implode(" AND ", $sql_location).")";
			}
		}

		if (($search_for["keyword"]) && ($section != "mobile")) {
			$search_for["keyword"] = str_replace("\\", "", $search_for["keyword"]);
			$search_for_keyword_fields[] = "Event.fulltextsearch_keyword";
			$where_clause[] = search_getSQLFullTextSearch($search_for["keyword"], $search_for_keyword_fields, "keyword_score", $order_by_keyword_score, $search_for["match"]);
		}

		if (($search_for["where"]) && ($section != "mobile")) {
			$search_for["where"] = str_replace("\\", "", $search_for["where"]);
			$search_for["where"] = str_replace(",", "", $search_for["where"]);
			$search_for_where_fields[] = "Event.fulltextsearch_where";
			$where_clause[] = search_getSQLFullTextSearch($search_for["where"], $search_for_where_fields, "where_score", $order_by_where_score, "allwords");
		}

		if (($search_for["keyword"]) && ($section == "mobile")) {
			$search_for["where"] = $search_for["keyword"];
			$search_for["keyword"] = str_replace("\\", "", $search_for["keyword"]);
			$search_for_keyword_fields[] = "Event.fulltextsearch_keyword";
			$search_for["where"] = str_replace("\\", "", $search_for["where"]);
			$search_for["where"] = str_replace(",", "", $search_for["where"]);
			$search_for_where_fields[] = "Event.fulltextsearch_where";
			$where_clause[] = "(".search_getSQLFullTextSearch($search_for["keyword"], $search_for_keyword_fields, "keyword_score", $order_by_keyword_score, $search_for["match"])." OR ".search_getSQLFullTextSearch($search_for["where"], $search_for_where_fields, "where_score", $order_by_where_score, "allwords").")";
		}

		if ($search_for["zip"]) {
			$search_for["zip"] = str_replace("\\", "", $search_for["zip"]);
			$search_for["dist"] = str_replace("\\", "", $search_for["dist"]);
			if (ZIPCODE_PROXIMITY == "on") {
				if (zipproximity_getWhereZipCodeProximity($search_for["zip"], $search_for["dist"], $whereZipCodeProximity, $order_by_zipcode_score)) {
					$where_clause[] = $whereZipCodeProximity;
					if ($order_by_zipcode_score && ($section != "count") && ($section != "random")) {
						$searchReturn["select_columns"] .= ", ".$order_by_zipcode_score;
					}
				} else {
					$where_clause[] = "Event.zip_code = ".db_formatString($search_for["zip"])."";
				}
			} else {
				$where_clause[] = "Event.zip_code = ".db_formatString($search_for["zip"])."";
			}
		}

		if ($where_clause && (count($where_clause) > 0)) {
			$searchReturn["where_clause"] = implode(" AND ", $where_clause);
		}

		if (($section == "event") || ($section == "mobile") || ($section == "rss")) {
			$searchReturn["order_by"] = "Event.level DESC, Event.random_number DESC, Event.end_date, Event.title, Event.id";
		} elseif ($section == "random") {
			$searchReturn["order_by"] = ((EVENT_SCALABILITY_OPTIMIZATION == "on")?("random_number DESC"):("RAND()"));
		} elseif ($section == "count") {
			$searchReturn["order_by"] = "Event.id";
		}

		if ($search_for["keyword"] && $order_by_keyword_score && ($section != "count") && ($section != "random")) {
			$searchReturn["select_columns"] .= ", ".$order_by_keyword_score;
		}

		if ($search_for["where"] && $order_by_where_score && ($section != "count") && ($section != "random")) {
			$searchReturn["select_columns"] .= ", ".$order_by_where_score;
		}

		if ((($search_for["keyword"] && $order_by_keyword_score) || ($search_for["where"] && $order_by_where_score) || ($search_for["zip"] && $order_by_zipcode_score)) && ($section != "count") && ($section != "random")) {
			$searchReturn["order_by"] = "Event.level DESC";
			if ($order_by_keyword_score) {
				$searchReturn["order_by"] .= ", keyword_score DESC";
			}
			if ($order_by_where_score) {
				$searchReturn["order_by"] .= ", where_score DESC";
			}
			if ($order_by_zipcode_score) {
				$searchReturn["order_by"] .= ", zipcode_score";
			}
		}

		return $searchReturn;

	}

	function search_frontClassifiedSearch($search_for, $section) {

		$searchReturn["select_columns"] = false;
		$searchReturn["from_tables"] = false;
		$searchReturn["where_clause"] = false;
		$searchReturn["group_by"] = false;
		$searchReturn["order_by"] = false;

		if (($section == "classified") || ($section == "random") || ($section == "mobile")) {
			$searchReturn["select_columns"] = "Classified.*";
		} elseif ($section == "count") {
			$searchReturn["select_columns"] = "COUNT(DISTINCT(Classified.id))";
		} elseif ($section == "rss") {
			$searchReturn["select_columns"] = "Classified.id";
		}

		$searchReturn["from_tables"] = "Classified";

		if (isset($search_for["id"]) && is_numeric($search_for["id"])) {
			$where_clause[] = "Classified.id = ".$search_for["id"]."";
		}

		$where_clause[] = "Classified.status = 'A'";

		if ($search_for["category_id"]) {
			$where_clause[] = "(Classified.cat_1_id = ".$search_for["category_id"]." OR Classified.parcat_1_level1_id = ".$search_for["category_id"].")";
			// The GROUP BY needs to be used when it has relationship table between item and category.
			//if ($section != "count") {
			//	$searchReturn["group_by"] = "Classified.id";
			//}
		}

		if ($search_for["estado_id"] || $search_for["cidade_id"] || $search_for["bairro_id"] || $search_for["city_id"] || $search_for["area_id"]) {
			if ($search_for["estado_id"]) {
				$sql_location[] = "Classified.estado_id = ".$search_for["estado_id"]."";
			}
			if ($search_for["cidade_id"]) {
				$sql_location[] = "Classified.cidade_id = ".$search_for["cidade_id"]."";
			}
			if ($search_for["bairro_id"]) {
				$sql_location[] = "Classified.bairro_id = ".$search_for["bairro_id"]."";
			}
			if ($search_for["city_id"]) {
				$sql_location[] = "Classified.city_id = ".$search_for["city_id"]."";
			}
			if ($search_for["area_id"]) {
				$sql_location[] = "Classified.area_id = ".$search_for["area_id"]."";
			}
			if ($sql_location) {
				$where_clause[] = "(".implode(" AND ", $sql_location).")";
			}
		}

		if (($search_for["keyword"]) && ($section != "mobile")) {
			$search_for["keyword"] = str_replace("\\", "", $search_for["keyword"]);
			$search_for_keyword_fields[] = "Classified.fulltextsearch_keyword";
			$where_clause[] = search_getSQLFullTextSearch($search_for["keyword"], $search_for_keyword_fields, "keyword_score", $order_by_keyword_score, $search_for["match"]);
		}

		if (($search_for["where"]) && ($section != "mobile")) {
			$search_for["where"] = str_replace("\\", "", $search_for["where"]);
			$search_for["where"] = str_replace(",", "", $search_for["where"]);
			$search_for_where_fields[] = "Classified.fulltextsearch_where";
			$where_clause[] = search_getSQLFullTextSearch($search_for["where"], $search_for_where_fields, "where_score", $order_by_where_score, "allwords");
		}

		if (($search_for["keyword"]) && ($section == "mobile")) {
			$search_for["where"] = $search_for["keyword"];
			$search_for["keyword"] = str_replace("\\", "", $search_for["keyword"]);
			$search_for_keyword_fields[] = "Classified.fulltextsearch_keyword";
			$search_for["where"] = str_replace("\\", "", $search_for["where"]);
			$search_for["where"] = str_replace(",", "", $search_for["where"]);
			$search_for_where_fields[] = "Classified.fulltextsearch_where";
			$where_clause[] = "(".search_getSQLFullTextSearch($search_for["keyword"], $search_for_keyword_fields, "keyword_score", $order_by_keyword_score, $search_for["match"])." OR ".search_getSQLFullTextSearch($search_for["where"], $search_for_where_fields, "where_score", $order_by_where_score, "allwords").")";
		}

		if ($search_for["zip"]) {
			$search_for["zip"] = str_replace("\\", "", $search_for["zip"]);
			$search_for["dist"] = str_replace("\\", "", $search_for["dist"]);
			if (ZIPCODE_PROXIMITY == "on") {
				if (zipproximity_getWhereZipCodeProximity($search_for["zip"], $search_for["dist"], $whereZipCodeProximity, $order_by_zipcode_score)) {
					$where_clause[] = $whereZipCodeProximity;
					if ($order_by_zipcode_score && ($section != "count") && ($section != "random")) {
						$searchReturn["select_columns"] .= ", ".$order_by_zipcode_score;
					}
				} else {
					$where_clause[] = "Classified.zip_code = ".db_formatString($search_for["zip"])."";
				}
			} else {
				$where_clause[] = "Classified.zip_code = ".db_formatString($search_for["zip"])."";
			}
		}

		if ($where_clause && (count($where_clause) > 0)) {
			$searchReturn["where_clause"] = implode(" AND ", $where_clause);
		}

		if (($section == "classified") || ($section == "mobile") || ($section == "rss")) {
			$searchReturn["order_by"] = "Classified.level DESC, Classified.random_number DESC, Classified.title, Classified.id";
		} elseif ($section == "random") {
			$searchReturn["order_by"] = ((CLASSIFIED_SCALABILITY_OPTIMIZATION == "on")?("random_number DESC"):("RAND()"));
		} elseif ($section == "count") {
			$searchReturn["order_by"] = "Classified.id";
		}

		if ($search_for["keyword"] && $order_by_keyword_score && ($section != "count") && ($section != "random")) {
			$searchReturn["select_columns"] .= ", ".$order_by_keyword_score;
		}

		if ($search_for["where"] && $order_by_where_score && ($section != "count") && ($section != "random")) {
			$searchReturn["select_columns"] .= ", ".$order_by_where_score;
		}

		if ((($search_for["keyword"] && $order_by_keyword_score) || ($search_for["where"] && $order_by_where_score) || ($search_for["zip"] && $order_by_zipcode_score)) && ($section != "count") && ($section != "random")) {
			$searchReturn["order_by"] = "Classified.level DESC";
			if ($order_by_keyword_score) {
				$searchReturn["order_by"] .= ", keyword_score DESC";
			}
			if ($order_by_where_score) {
				$searchReturn["order_by"] .= ", where_score DESC";
			}
			if ($order_by_zipcode_score) {
				$searchReturn["order_by"] .= ", zipcode_score";
			}
		}

		return $searchReturn;

	}

	function search_frontArticleSearch($search_for, $section) {

		$searchReturn["select_columns"] = false;
		$searchReturn["from_tables"] = false;
		$searchReturn["where_clause"] = false;
		$searchReturn["group_by"] = false;
		$searchReturn["order_by"] = false;

		if (($section == "article") || ($section == "random") || ($section == "mobile")) {
			$searchReturn["select_columns"] = "Article.*";
		} elseif ($section == "count") {
			$searchReturn["select_columns"] = "COUNT(DISTINCT(Article.id))";
		} elseif ($section == "rss") {
			$searchReturn["select_columns"] = "Article.id";
		}

		$searchReturn["from_tables"] = "Article";

		if (isset($search_for["id"]) && is_numeric($search_for["id"])) {
			$where_clause[] = "Article.id = ".$search_for["id"]."";
		}

		$where_clause[] = "Article.status = 'A'";

		$where_clause[] = "Article.publication_date <= DATE_FORMAT(NOW(), '%Y-%m-%d')";

		if ($search_for["category_id"]) {
			$where_clause[] = "(Article.cat_1_id = ".$search_for["category_id"]." OR Article.parcat_1_level1_id = ".$search_for["category_id"]." OR Article.cat_2_id = ".$search_for["category_id"]." OR Article.parcat_2_level1_id = ".$search_for["category_id"]." OR Article.cat_3_id = ".$search_for["category_id"]." OR Article.parcat_3_level1_id = ".$search_for["category_id"]." OR Article.cat_4_id = ".$search_for["category_id"]." OR Article.parcat_4_level1_id = ".$search_for["category_id"]." OR Article.cat_5_id = ".$search_for["category_id"]." OR Article.parcat_5_level1_id = ".$search_for["category_id"].")";
			// The GROUP BY needs to be used when it has relationship table between item and category.
			//if ($section != "count") {
			//	$searchReturn["group_by"] = "Article.id";
			//}
		}

		if (($search_for["keyword"]) && ($section != "mobile")) {
			$search_for["keyword"] = str_replace("\\", "", $search_for["keyword"]);
			$search_for_keyword_fields[] = "Article.fulltextsearch_keyword";
			$where_clause[] = search_getSQLFullTextSearch($search_for["keyword"], $search_for_keyword_fields, "keyword_score", $order_by_keyword_score, $search_for["match"]);
		}

		if (($search_for["where"]) && ($section != "mobile")) {
			$search_for["where"] = str_replace("\\", "", $search_for["where"]);
			$search_for["where"] = str_replace(",", "", $search_for["where"]);
			$search_for_where_fields[] = "Article.fulltextsearch_where";
			$where_clause[] = search_getSQLFullTextSearch($search_for["where"], $search_for_where_fields, "where_score", $order_by_where_score, "allwords");
		}

		if (($search_for["keyword"]) && ($section == "mobile")) {
			$search_for["where"] = $search_for["keyword"];
			$search_for["keyword"] = str_replace("\\", "", $search_for["keyword"]);
			$search_for_keyword_fields[] = "Article.fulltextsearch_keyword";
			$search_for["where"] = str_replace("\\", "", $search_for["where"]);
			$search_for["where"] = str_replace(",", "", $search_for["where"]);
			$search_for_where_fields[] = "Article.fulltextsearch_where";
			$where_clause[] = "(".search_getSQLFullTextSearch($search_for["keyword"], $search_for_keyword_fields, "keyword_score", $order_by_keyword_score, $search_for["match"])." OR ".search_getSQLFullTextSearch($search_for["where"], $search_for_where_fields, "where_score", $order_by_where_score, "allwords").")";
		}

		if ($search_for["zip"]) {
			$search_for["zip"] = str_replace("\\", "", $search_for["zip"]);
			$search_for["dist"] = str_replace("\\", "", $search_for["dist"]);
			if (ZIPCODE_PROXIMITY == "on") {
				if (zipproximity_getWhereZipCodeProximity($search_for["zip"], $search_for["dist"], $whereZipCodeProximity, $order_by_zipcode_score)) {
					$where_clause[] = $whereZipCodeProximity;
					if ($order_by_zipcode_score && ($section != "count") && ($section != "random")) {
						$searchReturn["select_columns"] .= ", ".$order_by_zipcode_score;
					}
				} else {
					$where_clause[] = "Article.zip_code = ".db_formatString($search_for["zip"])."";
				}
			} else {
				$where_clause[] = "Article.zip_code = ".db_formatString($search_for["zip"])."";
			}
		}

		if ($where_clause && (count($where_clause) > 0)) {
			$searchReturn["where_clause"] = implode(" AND ", $where_clause);
		}

		if (($section == "article") || ($section == "mobile") || ($section == "rss")) {
			$searchReturn["order_by"] = "Article.level DESC, Article.random_number DESC, Article.publication_date DESC, Article.updated DESC, Article.entered DESC, Article.title, Article.id";
		} elseif ($section == "random") {
			$searchReturn["order_by"] = ((ARTICLE_SCALABILITY_OPTIMIZATION == "on")?("random_number DESC"):("RAND()"));
		} elseif ($section == "count") {
			$searchReturn["order_by"] = "Article.id";
		}

		if ($search_for["keyword"] && $order_by_keyword_score && ($section != "count") && ($section != "random")) {
			$searchReturn["select_columns"] .= ", ".$order_by_keyword_score;
		}

		if ($search_for["where"] && $order_by_where_score && ($section != "count") && ($section != "random")) {
			$searchReturn["select_columns"] .= ", ".$order_by_where_score;
		}

		if ((($search_for["keyword"] && $order_by_keyword_score) || ($search_for["where"] && $order_by_where_score) || ($search_for["zip"] && $order_by_zipcode_score)) && ($section != "count") && ($section != "random")) {
			$searchReturn["order_by"] = "Article.level DESC";
			if ($order_by_keyword_score) {
				$searchReturn["order_by"] .= ", keyword_score DESC";
			}
			if ($order_by_where_score) {
				$searchReturn["order_by"] .= ", where_score DESC";
			}
			if ($order_by_zipcode_score) {
				$searchReturn["order_by"] .= ", zipcode_score";
			}
		}

		return $searchReturn;

	}

	function search_getSQLFullTextSearch($searchfor, $fields, $order_by_fieldname, &$order_by_score, $force_specific_search="") {

		$order_by_score = "";
		unset($sql_aux);
		unset($searchfor_aux);
		unset($searchfor_array);
		if (($force_specific_search != "exactmatch") && ($force_specific_search != "anyword") && ($force_specific_search != "allwords")) {
			$force_specific_search = "";
		}

		$searchfor = trim($searchfor);
		$searchfor = str_replace("&quot;", "\"", $searchfor);

		$words_array = explode(" ", $searchfor);

		$thesaurus = false;
		if (count($words_array) == 2) {
			$thesaurus = str_replace(" ", "", $searchfor);
		}

		$force_text_search = false;
		if (count($words_array) >= 2) {
			foreach ($words_array as $each_word) {
				if (strlen($each_word) <= 3) {
					$force_text_search = true;
					break;
				}
			}
		}

		if ($force_specific_search == "exactmatch") {

			$searchfor = db_formatString($searchfor);
			$searchfor = substr($searchfor, 1, strlen($searchfor)-2);

			foreach ($fields as $field) {
				$sql_aux[] = "(".$field." = '$searchfor' OR ".$field." LIKE '$searchfor %' OR ".$field." LIKE '% $searchfor' OR ".$field." LIKE '% $searchfor %')";
			}

			return "(".(implode(" OR ", $sql_aux)).")";

		} elseif (((strlen($searchfor) <= 3) && (!$force_specific_search)) || ((strlen($searchfor) <= 3) && ($force_specific_search == "anyword"))) {

			$searchfor_aux = $searchfor;
			$searchfor_aux = db_formatString($searchfor_aux);
			$searchfor_aux = substr($searchfor_aux, 1, strlen($searchfor_aux)-2);
			$searchfor_array[] = $searchfor_aux;

			$searchfor_aux = Inflector::singularize($searchfor);
			$searchfor_aux = db_formatString($searchfor_aux);
			$searchfor_aux = substr($searchfor_aux, 1, strlen($searchfor_aux)-2);
			$searchfor_array[] = $searchfor_aux;

			$searchfor_aux = Inflector::pluralize($searchfor);
			$searchfor_aux = db_formatString($searchfor_aux);
			$searchfor_aux = substr($searchfor_aux, 1, strlen($searchfor_aux)-2);
			$searchfor_array[] = $searchfor_aux;

			$searchfor_array = array_unique($searchfor_array);

			foreach ($searchfor_array as $each_searchfor) {
				foreach ($fields as $field) {
					$sql_aux[] = $field." = '$each_searchfor'";
					$sql_aux[] = $field." LIKE '$each_searchfor %'";
					$sql_aux[] = $field." LIKE '% $each_searchfor'";
					$sql_aux[] = $field." LIKE '% $each_searchfor %'";
				}
			}

			return "(".(implode(" OR ", $sql_aux)).")";

		} elseif ((($force_text_search) && (!$force_specific_search)) || (($force_text_search) && ($force_specific_search == "anyword"))) {

			$searchfor_aux = $searchfor;
			$searchfor_aux = db_formatString($searchfor_aux);
			$searchfor_aux = substr($searchfor_aux, 1, strlen($searchfor_aux)-2);
			$searchfor_array[] = $searchfor_aux;

			unset($searchfor_aux_array);
			foreach ($words_array as $each_searchfor) {
				$searchfor_aux_array[] = Inflector::singularize($each_searchfor);
			}
			$searchfor_aux = implode(" ", $searchfor_aux_array);
			$searchfor_aux = db_formatString($searchfor_aux);
			$searchfor_aux = substr($searchfor_aux, 1, strlen($searchfor_aux)-2);
			$searchfor_array[] = $searchfor_aux;

			unset($searchfor_aux_array);
			foreach ($words_array as $each_searchfor) {
				$searchfor_aux_array[] = Inflector::pluralize($each_searchfor);
			}
			$searchfor_aux = implode(" ", $searchfor_aux_array);
			$searchfor_aux = db_formatString($searchfor_aux);
			$searchfor_aux = substr($searchfor_aux, 1, strlen($searchfor_aux)-2);
			$searchfor_array[] = $searchfor_aux;

			if ($thesaurus) {
				$searchfor_aux = $thesaurus;
				$searchfor_aux = db_formatString($searchfor_aux);
				$searchfor_aux = substr($searchfor_aux, 1, strlen($searchfor_aux)-2);
				$searchfor_array[] = $searchfor_aux;
			}

			$searchfor_array = array_unique($searchfor_array);

			foreach ($searchfor_array as $each_searchfor) {
				foreach ($fields as $field) {
					$sql_aux[] = $field." = '$each_searchfor'";
					$sql_aux[] = $field." LIKE '$each_searchfor %'";
					$sql_aux[] = $field." LIKE '% $each_searchfor'";
					$sql_aux[] = $field." LIKE '% $each_searchfor %'";
				}
			}

			return "(".(implode(" OR ", $sql_aux)).")";

		} elseif ($force_specific_search == "allwords") {

			if ((strlen($searchfor) <= 3) || ($force_text_search)) {

				foreach ($words_array as $each_searchfor) {
					$searchfor = db_formatString($each_searchfor);
					$searchfor = substr($searchfor, 1, strlen($searchfor)-2);
					$searchfor_array[] = $searchfor;
				}

				$searchfor_array = array_unique($searchfor_array);

				foreach ($fields as $field) {
					unset($sqlaux);
					foreach ($searchfor_array as $each_searchfor) {
						$sqlaux[] = "(".$field." = '$each_searchfor' OR ".$field." LIKE '$each_searchfor %' OR ".$field." LIKE '% $each_searchfor' OR ".$field." LIKE '% $each_searchfor %')";
					}
					$sql_aux[] = "(".(implode(" AND ", $sqlaux)).")";
				}

				return "(".(implode(" OR ", $sql_aux)).")";

			} else {

				foreach ($words_array as $each_searchfor) {
					$searchfor_array[] = "+".$each_searchfor;
				}

				$searchfor_array = array_unique($searchfor_array);

				$formated_searchfor = db_formatString(implode(" ", $searchfor_array));

				return "MATCH (".implode(", ", $fields).") AGAINST (".$formated_searchfor." IN BOOLEAN MODE)";

			}

		} else {

			foreach ($words_array as $each_searchfor) {
				$searchfor_array[] = $each_searchfor;
				$searchfor_array[] = Inflector::singularize($each_searchfor);
				$searchfor_array[] = Inflector::pluralize($each_searchfor);
			}

			if ($thesaurus) {
				$searchfor_array[] = $thesaurus;
			}

			$searchfor_array = array_unique($searchfor_array);

			$formated_searchfor = db_formatString(implode(" ", $searchfor_array));

			$order_by_score = "MATCH (".implode(", ", $fields).") AGAINST (".$formated_searchfor.") AS ".$order_by_fieldname;

			return "MATCH (".implode(", ", $fields).") AGAINST (".$formated_searchfor.")";

		}

		return "";

	}

?>
