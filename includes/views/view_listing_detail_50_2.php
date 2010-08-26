

<div class="detail template2" <?=$templateCSSDetail;?>>

	<? if (!strpos($_SERVER["PHP_SELF"], "print.php")) { ?>
		<div class="baseIconNavbar">
			<?=$listingtemplate_icon_navbar?>
		</div>
	<? } ?>

	<div class="detailComplementaryContent" style="width: <?=$listingtemplate_image_width?>px;">

		<h3 class="detailTitle" <?=$templateCSSLabel;?>><?=system_showText(LANG_LABEL_PHOTO_GALLERY);?></h3>

		<div class="imgDetail">
			<?=$listingtemplate_image?>
		</div>

		<div class="detailGallery">
			<?=$listingtemplate_gallery?>
		</div>

		<? if ($listingtemplate_video_snippet) { ?>
			<h3 class="detailTitle" <?=$templateCSSLabel;?>><?=system_showText(LANG_LABEL_VIDEO);?></h3>
			<div class="videoDetail">
				<?=$listingtemplate_video_snippet?>
			</div>
		<? } ?>

		<h3 class="detailTitle" <?=$templateCSSLabel;?>><?=system_showText(LANG_LABEL_MAPLOCATION);?></h3>
		<div id='map' name='map' class='googleBase'>&nbsp;</div>

	</div>

	<div class="detailContent">

		<h2 <?=$templateCSSTitle;?>><?=$listingtemplate_title?></h2>

		<? if ($listingtemplate_category_tree) { ?>
			<p class="complementaryInfo">
				<?=$listingtemplate_category_tree?>
			</p>
		<? } ?>

		<? if ($listingtemplate_claim) { ?>
			<p class="claim">
				<?=$listingtemplate_claim?>
			</p>
		<? } ?>

		<? if ($listingtemplate_designations) { ?>
			<div class="designations">
				<?=$listingtemplate_designations?>
			</div>
		<? } ?>

		<h3 class="detailTitle" <?=$templateCSSLabel;?>><?=system_showText(LANG_LABEL_OVERVIEW);?></h3>

		<? if(($listingtemplate_address) || ($listingtemplate_address2) || ($listingtemplate_location)) echo "<address>\n"; ?>

		<? if ($listingtemplate_address) { ?>
			<span><?=$listingtemplate_address?></span>
		<? } ?>

		<? if ($listingtemplate_address2) { ?>
			<span><?=$listingtemplate_address2?></span>
		<? } ?>

		<? if ($listingtemplate_location) { ?>
			<span><?=$listingtemplate_location?></span>
		<? } ?>

		<? if(($listingtemplate_address) || ($listingtemplate_address2) || ($listingtemplate_location)) echo "\n</address>\n"; ?>

		<? if ($listingtemplate_description) { ?>
			<p class="summaryDescription" <?=$templateCSSText;?>><?=$listingtemplate_description?></p>
		<? }?>

		<? if ($listingtemplate_phone) { ?>
			<p><strong><?=system_showText(LANG_LISTING_LETTERPHONE)?>:</strong> <?=$listingtemplate_phone?></p>
		<? } ?>

		<? if ($listingtemplate_fax) { ?>
			<p><strong><?=system_showText(LANG_LISTING_LETTERFAX)?>:</strong> <?=$listingtemplate_fax?></p>
		<? } ?>

		<? if ($listingtemplate_url) { ?>
			<p><strong><?=system_showText(LANG_LISTING_LETTERWEBSITE)?>:</strong> <?=$listingtemplate_url?></p>
		<? } ?>

		<? if ($listingtemplate_email) { ?>
			<p><strong><?=system_showText(LANG_LISTING_LETTEREMAIL)?>:</strong> <?=$listingtemplate_email?></p>
		<? } ?>

		<? if ($listingtemplate_attachment_file) { ?>
			<h3 class="detailTitle" <?=$templateCSSLabel;?>><?=ucfirst(system_showText(LANG_LABEL_ADDITIONALINFORMATION))?></h3>
			<?=$listingtemplate_attachment_file?>
		<? } ?>

		<? if ($listingtemplate_long_description) { ?>
			<h3 class="detailTitle" <?=$templateCSSLabel;?>><?=system_showText(LANG_LABEL_DESCRIPTION);?></h3>
			<p><?=$listingtemplate_long_description?></p>
		<? } ?>

		<? if ($listingtemplate_hours_work) { ?>
			<h3 class="detailTitle" <?=$templateCSSLabel;?>><?=system_showText(LANG_LISTING_HOURS_OF_WORK)?></h3>
			<p><?=$listingtemplate_hours_work?></p>
		<? } ?>

		<? if ($listingtemplate_locations) { ?>
			<h3 class="detailTitle" <?=$templateCSSLabel;?>><?=system_showText(LANG_LOCATIONS)?></h3>
			<p><?=$listingtemplate_locations?></p>
		<? } ?>

		<?=$templateExtraFields;?>

	</div>

	<? if ($listingtemplate_summary_review) { ?>
		<div class="detailRatings">
			<h3 class="detailTitle" <?=$templateCSSLabel;?>><?=system_showText(LANG_REVIEWTITLE)?> <span class="complementaryInfo"><?=$listingtemplate_summary_review?></span></h3>
			<? if ($listingtemplate_review) { ?>
			<?=$listingtemplate_review?>
			<? } ?>
		</div>
	<? } ?>

</div>

<?=$listingtemplate_google_maps?>