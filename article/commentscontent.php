<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /listing/comments.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

?>

	<? if ($error_message) { ?>
		<?="<p class=\"errorMessage\">".$error_message."</p>";?>
	<? } else { ?>

		<p class="standardTitle"><?=system_showText(LANG_REVIEWSOF)?> <span><?=$articleObj->getString("title")?></span></p>

		<?
		$level = new ArticleLevel();
		$article = $articleObj;
		$user = true;
		include(INCLUDES_DIR . "/views/view_article_summary_".$article->getString('level').".php");
		unset($user);
		unset($article);

		if ($pageObj->getString("pages") > 1) echo "<br />";

		include(EDIRECTORY_ROOT."/frontend/paging.php");

		if ($reviewsArr) {
			foreach ($reviewsArr as $each_rate) {
				if ($each_rate->getString("review")) {
					$each_rate->extract();
					include(INCLUDES_DIR."/views/view_review_detail.php");
					echo $item_reviewcomment;
				}
			}
		} else {
			echo "<div class=\"response-msg notice ui-corner-all\">".system_showText(LANG_REVIEW_NORECORD)."</div>";
		}
		?>

	<? } ?>