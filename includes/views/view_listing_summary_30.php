<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/views/view_listing_summary_30.php
	# ----------------------------------------------------------------------------------------------------

?>

<a name="<?=$listingtemplate_friendly_url;?>"></a>

<div class="summary" <?=$templateCSSDetail;?>>

	<div class="baseIconNavbar">
		<?=$listingtemplate_icon_navbar?>
	</div>

	<div class="summaryContent">

        <div class="summaryTitle">
		
			<? if (strpos($_SERVER["PHP_SELF"], "results.php") !== false) { ?>
				<? if ((strlen(trim($listing->getLocationString("A", true))) > 0) || (strlen(trim($listing->getLocationString("s", true))) > 0) || (strlen(trim($listing->getLocationString("r", true))) > 0)) { ?>
					<div class="summaryNumber">
						<a href="#topPage" onclick="javascript:myclick(<?=($mapNumber);?>);"><span><?=$mapNumber;?></span></a>
					</div>
				<? } ?>
			<? } ?>

			<h3 <?=$templateCSSTitle;?>><?=$listingtemplate_title?></h3>

			<? if ($listingtemplate_complementaryinfo) { ?>
				<p class="complementaryInfo"><?=$listingtemplate_complementaryinfo?></p>
			<? } ?>

		</div>

		<div class="summaryDescription">

			<?=$listingtemplate_designations?>

			<? if ($listingtemplate_claim) { ?>
				<p class="claim">
					<?=$listingtemplate_claim?>
				</p>
			<? } ?>

		</div>

	</div>

	<div class="summaryComplementaryContent">

		<? if(($listingtemplate_address) || ($listingtemplate_address2) || ($listingtemplate_location)) echo "<address class=\"summarySpacer\">\n"; ?>

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

		<? if ($listingtemplate_phone) { ?>
			<p class="complementaryInfo"><strong><?=system_showText(LANG_LISTING_LETTERPHONE)?>: </strong><?=$listingtemplate_phone?></p>
		<? } ?>

		<? if ($listingtemplate_url) { ?>
			<p class="complementaryInfo"><strong><?=system_showText(LANG_LISTING_LETTERWEBSITE)?>: </strong><?=$listingtemplate_url?></p>
		<? } ?>

		<? if ($listingtemplate_email) { ?>
			<p class="complementaryInfo"><strong><?=system_showText(LANG_LISTING_LETTEREMAIL)?>: </strong><?=$listingtemplate_email?></p>
		<? } ?>

		<? if ($listingtemplate_review) { ?>
			<?=$listingtemplate_review?>
		<? } ?>

	</div>

</div>