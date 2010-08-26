<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /sitemapcontent.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

?>

	<? $langIndex = language_getIndex(EDIR_LANGUAGE); ?>

	<h2 class="standardTitle"><?=system_showText(LANG_MENU_SITEMAP);?></h2>

	<ul class="sitemapList">

		<li class="standardSubTitle">
			<a href="<?=DEFAULT_URL?>/index.php" class="sitemapSection"><?=system_showText(LANG_MENU_HOME);?></a>
		</li>

		<li class="standardSubTitle">
			<a href="<?=LISTING_DEFAULT_URL?>/" class="sitemapSection"><?=system_showText(LANG_MENU_LISTING);?></a>
			<?
			unset($categories);
			if (LISTINGCATEGORY_SCALABILITY_OPTIMIZATION == "on") {
				$sql = "SELECT * FROM ListingCategory WHERE category_id = '0' AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." ORDER BY active_listing DESC LIMIT 20";
				$categories = db_getFromDBBySQL("listingcategory", $sql);
			} else {
				$categories = db_getFromDBBySQL("listingcategory", "SELECT * FROM ListingCategory WHERE category_id = 0 AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." ORDER BY title");
			}
			if ($categories) {
				echo "<ul>";
					foreach ($categories as $category) {
						echo "<li><a href=\"".LISTING_DEFAULT_URL."/guide/".$category->getString("friendly_url".$langIndex)."\">".$category->getString("title".$langIndex)."</a></li>";
					}
					if (LISTINGCATEGORY_SCALABILITY_OPTIMIZATION == "on") {
						echo "<li class=\"viewMore\"><a href=\"".LISTING_DEFAULT_URL."/allcategories.php\">".system_showText(LANG_LISTING_VIEWALLCATEGORIES)." &raquo;</a></li>";
					}
				echo "</ul>";
			}
			unset($categories);
			?>
		</li>

		<? if (EVENT_FEATURE == "on") { ?>

			<li class="standardSubTitle">
				<a href="<?=EVENT_DEFAULT_URL?>/" class="sitemapSection"><?=system_showText(LANG_MENU_EVENT);?></a>
				<?
				unset($categories);
				if (EVENTCATEGORY_SCALABILITY_OPTIMIZATION == "on") {
					$sql = "SELECT * FROM EventCategory WHERE category_id = '0' AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." ORDER BY active_event DESC LIMIT 20";
					$categories = db_getFromDBBySQL("eventcategory", $sql);
				} else {
					$categories = db_getFromDBBySQL("eventcategory", "SELECT * FROM EventCategory WHERE category_id = 0 AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." ORDER BY title");
				}
				if ($categories) {
					echo "<ul>";
						foreach ($categories as $category) {
							echo "<li><a href=\"".EVENT_DEFAULT_URL."/guide/".$category->getString("friendly_url".$langIndex)."\">".$category->getString("title".$langIndex)."</a></li>";
						}
						if (EVENTCATEGORY_SCALABILITY_OPTIMIZATION == "on") {
							echo "<li class=\"viewMore\"><a href=\"".EVENT_DEFAULT_URL."/allcategories.php\">".system_showText(LANG_EVENT_VIEWALLCATEGORIES)." &raquo;</a></li>";
						}
					echo "</ul>";
				}
				unset($categories);
				?>
			</li>

		<? } ?>

		<? if (CLASSIFIED_FEATURE == "on") { ?>

			<li class="standardSubTitle">
				<a href="<?=CLASSIFIED_DEFAULT_URL?>/" class="sitemapSection"><?=system_showText(LANG_MENU_CLASSIFIED);?></a>
				<?
				unset($categories);
				if (CLASSIFIEDCATEGORY_SCALABILITY_OPTIMIZATION == "on") {
					$sql = "SELECT * FROM ClassifiedCategory WHERE category_id = '0' AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." ORDER BY active_classified DESC LIMIT 20";
					$categories = db_getFromDBBySQL("classifiedcategory", $sql);
				} else {
					$categories = db_getFromDBBySQL("classifiedcategory", "SELECT * FROM ClassifiedCategory WHERE category_id = 0 AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." ORDER BY title");
				}
				if ($categories) {
					echo "<ul>";
						foreach ($categories as $category) {
							echo "<li><a href=\"".CLASSIFIED_DEFAULT_URL."/guide/".$category->getString("friendly_url".$langIndex)."\">".$category->getString("title".$langIndex)."</a></li>";
						}
						if (CLASSIFIEDCATEGORY_SCALABILITY_OPTIMIZATION == "on") {
							echo "<li class=\"viewMore\"><a href=\"".CLASSIFIED_DEFAULT_URL."/allcategories.php\">".system_showText(LANG_CLASSIFIED_VIEWALLCATEGORIES)." &raquo;</a></li>";
						}
					echo "</ul>";
				}
				unset($categories);
				?>
			</li>

		<? } ?>

		<? if (ARTICLE_FEATURE == "on") { ?>

			<li class="standardSubTitle">
				<a href="<?=ARTICLE_DEFAULT_URL?>/" class="sitemapSection"><?=system_showText(LANG_MENU_ARTICLE);?></a>
				<?
				unset($categories);
				if (ARTICLECATEGORY_SCALABILITY_OPTIMIZATION == "on") {
					$sql = "SELECT * FROM ArticleCategory WHERE category_id = '0' AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." ORDER BY active_article DESC LIMIT 20";
					$categories = db_getFromDBBySQL("articlecategory", $sql);
				} else {
					$categories = db_getFromDBBySQL("articlecategory", "SELECT * FROM ArticleCategory WHERE category_id = 0 AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." ORDER BY title");
				}
				if ($categories) {
					echo "<ul>";
						foreach ($categories as $category) {
							echo "<li><a href=\"".ARTICLE_DEFAULT_URL."/guide/".$category->getString("friendly_url".$langIndex)."\">".$category->getString("title".$langIndex)."</a></li>";
						}
						if (ARTICLECATEGORY_SCALABILITY_OPTIMIZATION == "on") {
							echo "<li class=\"viewMore\"><a href=\"".ARTICLE_DEFAULT_URL."/allcategories.php\">".system_showText(LANG_ARTICLE_VIEWALLCATEGORIES)." &raquo;</a></li>";
						}
					echo "</ul>";
				}
				unset($categories);
				?>
			</li>

		<? } ?>

		<li class="standardSubTitle">
			<a href="<?=PROMOTION_DEFAULT_URL?>/" class="sitemapSection"><?=system_showText(LANG_MENU_PROMOTION);?></a>
			<?
			unset($categories);
			if (LISTINGCATEGORY_SCALABILITY_OPTIMIZATION == "on") {
				$sql = "SELECT * FROM ListingCategory WHERE category_id = '0' AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." ORDER BY active_listing DESC LIMIT 20";
				$categories = db_getFromDBBySQL("listingcategory", $sql);
			} else {
				$categories = db_getFromDBBySQL("listingcategory", "SELECT * FROM ListingCategory WHERE category_id = 0 AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." ORDER BY title");
			}
			if ($categories) {
				echo "<ul>";
					foreach ($categories as $category) {
						echo "<li><a href=\"".PROMOTION_DEFAULT_URL."/guide/".$category->getString("friendly_url".$langIndex)."\">".$category->getString("title".$langIndex)."</a></li>";
					}
					if (LISTINGCATEGORY_SCALABILITY_OPTIMIZATION == "on") {
						echo "<li class=\"viewMore\"><a href=\"".PROMOTION_DEFAULT_URL."/allcategories.php\">".system_showText(LANG_PROMOTION_VIEWALLCATEGORIES)." &raquo;</a></li>";
					}
				echo "</ul>";
			}
			unset($categories);
			?>
		</li>

		<li class="standardSubTitle">
			<a href="<?=DEFAULT_URL?>/advertise.php" class="sitemapSection"><?=system_showText(LANG_MENU_ADVERTISE);?></a>
		</li>

		<li class="standardSubTitle">
			<a href="<?=DEFAULT_URL?>/faq.php?keyword=" class="sitemapSection" target="_blank"><?=system_showText(LANG_MENU_FAQ);?></a>
		</li>

		<li class="standardSubTitle">
			<a href="<?=DEFAULT_URL?>/registro" class="sitemapSection"><?=system_showText(LANG_MENU_CONTACT);?></a>
		</li>

	</ul>
