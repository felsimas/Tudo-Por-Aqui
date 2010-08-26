<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /iapp/article/view.php
	# ----------------------------------------------------------------------------------------------------

?>

	<? if ($level->getDetail($article["level"]) == "y") { ?>
	<div class="itemViewDetail">
		<span rel="<?=DEFAULT_URL;?>/iapp/article/detail.php?id=<?=$article["id"];?>">
			<?
			$imageObj = new Image($article["thumb_id"]);
			if ($imageObj->imageExists()) {
				echo $imageObj->getTag(true, (IMAGE_ARTICLE_THUMB_WIDTH/2), (IMAGE_ARTICLE_THUMB_HEIGHT/2), $article["title"], true);
			}
			?>
		</span>
	<? } else { ?>
	<div class="itemView">
	<? } ?>

			<h1><?=$article["title"]?></h1>
			<? if ($article["publication_date"] || $article["author"]) { ?>
				<p class="articleInfo">
					<?
					if ($article["publication_date"]) echo $article["publication_date"];
					if ($article["publication_date"] && $article["author"]) echo " - ";
					if ($article["author"]) echo "By ".$article["author"];
					?>
				</p>
			<? } ?>
			<? if ($article["abstract"]) { ?>
				<?
				if (strlen($article["abstract"]) > MAX_DESC_LEN) {
					$article["abstract"] = substr($article["abstract"], 0, (MAX_DESC_LEN-3))."...";
				}
				?>
				<p><?=$article["abstract"]?></p>
			<? } ?>

	<? if ($level->getDetail($article["level"]) == "y") { ?>
		</span>
		<div class="clear"></div>
	</div>
	<? } else {?>
	</div>
	<? } ?>
