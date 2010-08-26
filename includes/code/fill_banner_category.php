<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/code/fill_banner_category.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	// Security Check
	session_start();
	if(sess_isSitemgrLogged() == false && sess_isAccountLogged() == false){ exit; }

	header("Content-Type: text/xml; charset=".EDIR_CHARSET);

	$langIndex = language_getIndex(EDIR_LANGUAGE);

	if ($_GET["section"]) {

		$section = $_GET["section"];

		$return = "<?xml version=\"1.0\" encoding=\"iso-8859-1\" standalone=\"yes\"?>\n";
		$return .= "<response>\n";

		if ($section == "general") {
			$return .= "<id>0</id>\n";
			$return .= "<name>".system_showText(LANG_ALLPAGESBUTITEMPAGES)."</name>\n";
		} else {

			$return .= "<id>0</id>\n";
			$return .= "<name>".system_showText(LANG_NONCATEGORYSEARCH)."</name>\n";

			if ($section == "listing") $tableCategory = "listingcategory";
			elseif ($section == "event") $tableCategory = "eventcategory";
			elseif ($section == "classified") $tableCategory = "classifiedcategory";
			elseif ($section == "article") $tableCategory = "articlecategory";

			$categories = db_getFromDB($tableCategory, "category_id", 0, "all", "title");

			if ($categories) {

				foreach ($categories as $category) {

					if (CATEGORY_SCALABILITY_OPTIMIZATION != "on") {
						$return .= "<id>0</id>\n";
						$return .= "<name>--------------------------------------------------</name>\n";
					}

					$return .= "<id>".$category->getNumber("id")."</id>\n";
					if ($category->getString("title".$langIndex)) {
						$return .= "<name>".html_entity_decode(htmlspecialchars($category->getString("title".$langIndex)))."</name>\n";
					} else {
						$return .= "<name>".html_entity_decode(htmlspecialchars($category->getString("title")))."</name>\n";
					}

					if (CATEGORY_SCALABILITY_OPTIMIZATION != "on") {

						$subcategories = db_getFromDB($tableCategory, "category_id", $category->getNumber("id"), "all", "title");

						if ($subcategories) {

							foreach ($subcategories as $subcategory) {

								$return .= "<id>".$subcategory->getNumber("id")."</id>\n";
								if ($subcategory->getString("title".$langIndex)) {
									$return .= "<name>- ".html_entity_decode(htmlspecialchars($subcategory->getString("title".$langIndex)))."</name>\n";
								} else {
									$return .= "<name>- ".html_entity_decode(htmlspecialchars($subcategory->getString("title")))."</name>\n";
								}

								$subcategories2 = db_getFromDB($tableCategory, "category_id", $subcategory->getNumber("id"), "all", "title");

								if ($subcategories2) {

									foreach ($subcategories2 as $subcategory2) {

										$return .= "<id>".$subcategory2->getNumber("id")."</id>\n";
										if ($subcategory2->getString("title".$langIndex)) {
											$return .= "<name>-- ".html_entity_decode(htmlspecialchars($subcategory2->getString("title".$langIndex)))."</name>\n";
										} else {
											$return .= "<name>-- ".html_entity_decode(htmlspecialchars($subcategory2->getString("title")))."</name>\n";
										}

										$subcategories3 = db_getFromDB($tableCategory, "category_id", $subcategory2->getNumber("id"), "all", "title");

										if ($subcategories3) {

											foreach ($subcategories3 as $subcategory3) {

												$return .= "<id>".$subcategory3->getNumber("id")."</id>\n";
												if ($subcategory3->getString("title".$langIndex)) {
													$return .= "<name>--- ".html_entity_decode(htmlspecialchars($subcategory3->getString("title".$langIndex)))."</name>\n";
												} else {
													$return .= "<name>--- ".html_entity_decode(htmlspecialchars($subcategory3->getString("title")))."</name>\n";
												}

												$subcategories4 = db_getFromDB($tableCategory, "category_id", $subcategory3->getNumber("id"), "all", "title");

												if ($subcategories4) {

													foreach ($subcategories4 as $subcategory4) {

														$return .= "<id>".$subcategory4->getNumber("id")."</id>\n";
														if ($subcategory4->getString("title".$langIndex)) {
															$return .= "<name>---- ".html_entity_decode(htmlspecialchars($subcategory4->getString("title".$langIndex)))."</name>\n";
														} else {
															$return .= "<name>---- ".html_entity_decode(htmlspecialchars($subcategory4->getString("title")))."</name>\n";
														}

													}

												}

											}

										}

									}

								}

							}

						}

					}

				}

			}

			if (CATEGORY_SCALABILITY_OPTIMIZATION != "on") {
				$return .= "<id>0</id>\n";
				$return .= "<name>--------------------------------------------------</name>\n";
			}

		}

		$return .= "</response>\n";

		echo $return;

	}

?>
