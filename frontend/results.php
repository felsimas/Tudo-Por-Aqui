<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /frontend/results.php
	# ----------------------------------------------------------------------------------------------------

?>

	<div class="relatedSearch">

	<?

	$message_related_search = "<h2 class=\"standardTitle\">".system_showText(system_highlightLastWord(LANG_LABEL_RELATEDSEARCH))."</h2>";
	$message_browse_section = "<h2 class=\"standardTitle\">".system_showText(system_highlightLastWord(LANG_LABEL_BROWSESECTION))."</h2>";

	$this_items = 0;

	if ($keyword || $where) {

		$langIndex = language_getIndex(EDIR_LANGUAGE);

		$dbObj = db_getDBObject();

		####################################################################################################
		### LISTING
		####################################################################################################
		unset($searchReturn);
		$searchReturn = search_frontListingSearch($_GET, "count");
		$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." ".(($searchReturn["where_clause"])?("WHERE ".$searchReturn["where_clause"]):(""))." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))."";
		$result = $dbObj->query($sql);
		$row = mysql_fetch_array($result);
		$listingsRelatedSearch = $row[0];

		if ($listingsRelatedSearch > 0) {
			if ($this_items == 0) {
				if ($keyword || $where) echo $message_related_search;
				else echo $message_browse_section;
			}
			$this_items += $listingsRelatedSearch;
			?>
			<dl class="generalResults">

				<dt class="standardSubTitle"><a href="<?=LISTING_DEFAULT_URL?>/results.php?keyword=<?=$keyword?>&amp;where=<?=$where?>"><?=system_showText(LANG_MENU_LISTING);?></a> <span class="resultadosInfo">(<?=$listingsRelatedSearch?>)</span></dt>

				<?
				if (CATEGORY_SCALABILITY_OPTIMIZATION != "on") {
					$categories = db_getFromDBBySQL("listingcategory", "SELECT * FROM ListingCategory WHERE category_id = 0 AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." ORDER BY title");
					if ($categories) {
						foreach ($categories as $category) {

							$this_category_id = $category->getNumber("id");

							unset($searchReturn);
							$_GET["category_id"] = $this_category_id;
							$searchReturn = search_frontListingSearch($_GET, "count");
							$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." ".(($searchReturn["where_clause"])?("WHERE ".$searchReturn["where_clause"]):(""))." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))."";
							unset($_GET["category_id"]);

							$result = $dbObj->query($sql);
							$row = mysql_fetch_array($result);
							$thislistings = $row[0];

							if ($thislistings > 0) {
								?>
								<dd class="resultadosInfo">
									<a href="<?=LISTING_DEFAULT_URL?>/results.php?keyword=<?=$keyword?>&amp;where=<?=$where?>&amp;category_id=<?=$this_category_id?>"><?=$category->getString("title".$langIndex)?></a> <span>(<?=$thislistings?>)</span>
								</dd>
								<?
							}

						}
					}
				}
				?>

			</dl>

			<?
		}
		####################################################################################################

		####################################################################################################
		### EVENT
		####################################################################################################
		if (EVENT_FEATURE == "on") {

			unset($searchReturn);
			$searchReturn = search_frontEventSearch($_GET, "count");
			$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." ".(($searchReturn["where_clause"])?("WHERE ".$searchReturn["where_clause"]):(""))." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))."";
			$result = $dbObj->query($sql);
			$row = mysql_fetch_array($result);
			$eventsRelatedSearch = $row[0];

			if ($eventsRelatedSearch > 0) {
				if ($this_items == 0) {
					if ($keyword || $where) echo $message_related_search;
				else echo $message_browse_section;
				}
				$this_items += $eventsRelatedSearch;
				?>
				<dl class="generalResults">

					<dt class="standardSubTitle"><a href="<?=EVENT_DEFAULT_URL?>/results.php?keyword=<?=$keyword?>&amp;where=<?=$where?>"><?=system_showText(LANG_MENU_EVENT);?></a> <span class="resultadosInfo">(<?=$eventsRelatedSearch?>)</span></dt>

					<?
					if (CATEGORY_SCALABILITY_OPTIMIZATION != "on") {
						$categories = db_getFromDBBySQL("eventcategory", "SELECT * FROM EventCategory WHERE category_id = 0 AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." ORDER BY title");
						if ($categories) {
							foreach ($categories as $category) {

								$this_category_id = $category->getNumber("id");

								unset($searchReturn);
								$_GET["category_id"] = $this_category_id;
								$searchReturn = search_frontEventSearch($_GET, "count");
								$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." ".(($searchReturn["where_clause"])?("WHERE ".$searchReturn["where_clause"]):(""))." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))."";
								unset($_GET["category_id"]);

								$result = $dbObj->query($sql);
								$row = mysql_fetch_array($result);
								$thisevents = $row[0];

								if ($thisevents > 0) {
									?>
									<dd class="resultadosInfo">
										<a href="<?=EVENT_DEFAULT_URL?>/results.php?keyword=<?=$keyword?>&amp;where=<?=$where?>&amp;category_id=<?=$this_category_id?>"><?=$category->getString("title".$langIndex)?></a> <span>(<?=$thisevents?>)</span>
									</dd>
									<?
								}

							}
						}
					}
					?>

					

				</dl>

				<?
			}

		}
		####################################################################################################

		####################################################################################################
		### CLASSIFIED
		####################################################################################################
		if (CLASSIFIED_FEATURE == "on") {

			unset($searchReturn);
			$searchReturn = search_frontClassifiedSearch($_GET, "count");
			$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." ".(($searchReturn["where_clause"])?("WHERE ".$searchReturn["where_clause"]):(""))." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))."";
			$result = $dbObj->query($sql);
			$row = mysql_fetch_array($result);
			$classifiedsRelatedSearch = $row[0];

			if ($classifiedsRelatedSearch > 0) {
				if ($this_items == 0) {
					if ($keyword || $where) echo $message_related_search;
				else echo $message_browse_section;
				}
				$this_items += $classifiedsRelatedSearch;
				?>
				<dl class="generalResults">

					<dt class="standardSubTitle"><a href="<?=CLASSIFIED_DEFAULT_URL?>/results.php?keyword=<?=$keyword?>&amp;where=<?=$where?>"><?=system_showText(LANG_MENU_CLASSIFIED);?></a> <span class="resultadosInfo">(<?=$classifiedsRelatedSearch?>)</span></dt>

					<?
					if (CATEGORY_SCALABILITY_OPTIMIZATION != "on") {
						$categories = db_getFromDBBySQL("classifiedcategory", "SELECT * FROM ClassifiedCategory WHERE category_id = 0 AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." ORDER BY title");
						if ($categories) {
							foreach ($categories as $category) {

								$this_category_id = $category->getNumber("id");

								unset($searchReturn);
								$_GET["category_id"] = $this_category_id;
								$searchReturn = search_frontClassifiedSearch($_GET, "count");
								$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." ".(($searchReturn["where_clause"])?("WHERE ".$searchReturn["where_clause"]):(""))." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))."";
								unset($_GET["category_id"]);

								$result = $dbObj->query($sql);
								$row = mysql_fetch_array($result);
								$thisclassifieds = $row[0];

								if ($thisclassifieds > 0) {
									?>
									<dd class="resultadosInfo">
										<a href="<?=CLASSIFIED_DEFAULT_URL?>/results.php?keyword=<?=$keyword?>&amp;where=<?=$where?>&amp;category_id=<?=$this_category_id?>"><?=$category->getString("title".$langIndex)?></a> <span>(<?=$thisclassifieds?>)</span>
									</dd>
									<?
								}

							}
						}
					}
					?>
				</dl>

				<?
			}

		}
		####################################################################################################

		####################################################################################################
		### ARTICLE
		####################################################################################################
		if (ARTICLE_FEATURE == "on") {

			unset($searchReturn);
			$searchReturn = search_frontArticleSearch($_GET, "count");
			$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." ".(($searchReturn["where_clause"])?("WHERE ".$searchReturn["where_clause"]):(""))." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))."";
			$result = $dbObj->query($sql);
			$row = mysql_fetch_array($result);
			$articlesRelatedSearch = $row[0];

			if ($articlesRelatedSearch > 0) {
				if ($this_items == 0) {
					if ($keyword || $where) echo $message_related_search;
				else echo $message_browse_section;
				}
				$this_items += $articlesRelatedSearch;
				?>
				<dl class="generalResults">

					<dt class="standardSubTitle"><a href="<?=ARTICLE_DEFAULT_URL?>/results.php?keyword=<?=$keyword?>&amp;where=<?=$where?>"><?=system_showText(LANG_MENU_ARTICLE);?></a> <span class="resultadosInfo">(<?=$articlesRelatedSearch?>)</span></dt>

					<?
					if (CATEGORY_SCALABILITY_OPTIMIZATION != "on") {
						$categories = db_getFromDBBySQL("articlecategory", "SELECT * FROM ArticleCategory WHERE category_id = 0 AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." ORDER BY title");
						if ($categories) {
							foreach ($categories as $category) {

								$this_category_id = $category->getNumber("id");

								unset($searchReturn);
								$_GET["category_id"] = $this_category_id;
								$searchReturn = search_frontArticleSearch($_GET, "count");
								$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." ".(($searchReturn["where_clause"])?("WHERE ".$searchReturn["where_clause"]):(""))." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))."";
								unset($_GET["category_id"]);

								$result = $dbObj->query($sql);
								$row = mysql_fetch_array($result);
								$thisarticles = $row[0];

								if ($thisarticles > 0) {
									?>
									<dd class="resultadosInfo">
										<a href="<?=ARTICLE_DEFAULT_URL?>/results.php?keyword=<?=$keyword?>&amp;where=<?=$where?>&amp;category_id=<?=$this_category_id?>"><?=$category->getString("title".$langIndex)?></a> <span>(<?=$thisarticles?>)</span>
									</dd>
									<?
								}

							}
						}
					}
					?>
				</dl>

				<?
			}

		}
		####################################################################################################

		####################################################################################################
		### PROMOTION
		####################################################################################################

		unset($searchReturn);
		$searchReturn = search_frontPromotionSearch($_GET, "count");
		$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." ".(($searchReturn["where_clause"])?("WHERE ".$searchReturn["where_clause"]):(""))." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))."";
		$result = $dbObj->query($sql);
		$row = mysql_fetch_array($result);
		$promotionsRelatedSearch = $row[0];

		if ($promotionsRelatedSearch > 0) {
			if ($this_items == 0) {
				if ($keyword || $where) echo $message_related_search;
				else echo $message_browse_section;
			}
			$this_items += $promotionsRelatedSearch;
			?>
			<dl class="generalResults">

				<dt class="standardSubTitle"><a href="<?=PROMOTION_DEFAULT_URL?>/results.php?keyword=<?=$keyword?>&amp;where=<?=$where?>"><?=system_showText(LANG_MENU_PROMOTION);?></a> <span class="resultadosInfo">(<?=$promotionsRelatedSearch?>)</span></dt>

				<?
				if (CATEGORY_SCALABILITY_OPTIMIZATION != "on") {
					$categories = db_getFromDBBySQL("listingcategory", "SELECT * FROM ListingCategory WHERE category_id = 0 AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." ORDER BY title");
					if ($categories) {
						foreach ($categories as $category) {

							$this_category_id = $category->getNumber("id");

							unset($searchReturn);
							$_GET["category_id"] = $this_category_id;
							$searchReturn = search_frontPromotionSearch($_GET, "count");
							$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." ".(($searchReturn["where_clause"])?("WHERE ".$searchReturn["where_clause"]):(""))." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))."";
							unset($_GET["category_id"]);

							$result = $dbObj->query($sql);
							$row = mysql_fetch_array($result);
							$thispromotions = $row[0];

							if ($thispromotions > 0) {
								?>
								
								<dd class="resultadosInfo"><a href="<?=PROMOTION_DEFAULT_URL?>/results.php?keyword=<?=$keyword?>&amp;where=<?=$where?>&amp;category_id=<?=$this_category_id?>"><?=$category->getString("title".$langIndex)?></a> <span>(<?=$thispromotions?>)</span></dd>
								
								<?
							}

						}
					}
				}
				?>
			</dl>

			<?
		}
		####################################################################################################

	}

	if (!$this_items) {

	
echo "<div id=\"featured_listing\">	
		<div class=\"box-t1\"><div class=\"box-t2\"><div class=\"box-t3\"/>	
		</div></div></div>
		<div class=\"box-1\"><div class=\"box-2\"><div class=\"box-3\">";

		echo "<dl class=\"generalResults\">";
			echo "<a href=\"".LISTING_DEFAULT_URL."/\"><dt class=\"standardSubTitle\">".system_showText(LANG_MENU_LISTING)."</a></dt>";
			if (EVENT_FEATURE == "on") { echo "<a href=\"".EVENT_DEFAULT_URL."/\"><dt class=\"standardSubTitle\">".system_showText(LANG_MENU_EVENT)."</a></dt>"; }
			echo "<a href=\"".PROMOTION_DEFAULT_URL."/\"><dt class=\"standardSubTitle\">".system_showText(LANG_MENU_PROMOTION)."</a></dt>";
		echo "</dl>";
		echo "</div></div></div>";
		echo "	<div class=\"box-b1\">
				<div class=\"box-b2\">
					<div class=\"box-b3\"/>
					</div>
				</div>
			</div></div>";
		
	}

	?>
	</div>