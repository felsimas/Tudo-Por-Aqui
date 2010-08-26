<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /mobile/articleview.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (ARTICLE_FEATURE != "on") { exit; }
	if (MOBILE_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$langIndex = language_getIndex(EDIR_LANGUAGE);

?>

	<div class="itemView articleView">
		<h1><?=$article["title"]?></h1>
		<? if ($article["publication_date"] || $article["author"]) { ?>
			<p class="articleInfo">
				<?
				if ($article["publication_date"]) echo $article["publication_date"];
				if ($article["publication_date"] && $article["author"]) echo " - ";
				if ($article["author"]) echo system_showText(LANG_BY)." ".$article["author"];
				?>
			</p>
		<? } ?>
		<? if ($article["abstract".$langIndex]) { ?>
			<?
			if (strlen($article["abstract".$langIndex]) > MAX_DESC_LEN) {
				$article["abstract".$langIndex] = substr($article["abstract".$langIndex], 0, (MAX_DESC_LEN-3))."...";
			}
			?>
			<p><?=$article["abstract".$langIndex]?></p>
		<? } ?>
	</div>
