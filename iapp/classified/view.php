<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /iapp/classified/view.php
	# ----------------------------------------------------------------------------------------------------

?>

	<? if ($level->getDetail($classified["level"]) == "y") { ?>
	<div class="itemViewDetail">
		<span rel="<?=DEFAULT_URL;?>/iapp/classified/detail.php?id=<?=$classified["id"];?>">
			<?
			$imageObj = new Image($classified["thumb_id"]);
			if ($imageObj->imageExists()) {
				echo $imageObj->getTag(true, (IMAGE_CLASSIFIED_THUMB_WIDTH/2), (IMAGE_CLASSIFIED_THUMB_HEIGHT/2), $classified["title"], true);
			}
			?>
		</span>
	<? } else { ?>
	<div class="itemView">
	<? } ?>

			<h1><?=$classified["title"]?></h1>
			<? if ($classified["phone"]) { ?>
				<p><span class="bold">t:</span> <?=$classified["phone"]?></p>
			<? } ?>
			<? if ($classified["summarydesc"]) { ?>
				<?
				if (strlen($classified["summarydesc"]) > MAX_DESC_LEN) {
					$classified["summarydesc"] = substr($classified["summarydesc"], 0, (MAX_DESC_LEN-3))."...";
				}
				?>
				<p><?=$classified["summarydesc"]?></p>
			<? } ?>

	<? if ($level->getDetail($classified["level"]) == "y") { ?>
		</span>
		<div class="clear"></div>
	</div>
	<? } else {?>
	</div>
	<? } ?>
