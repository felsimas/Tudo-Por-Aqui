<?



	##################################################
	// AVAILABLE VARS
	// $listingtemplate_icon_navbar
	// $listingtemplate_video_snippet_width
	// $listingtemplate_video_snippet_height
	// $listingtemplate_video_snippet
	// $listingtemplate_image_width
	// $listingtemplate_image_heigth
	// $listingtemplate_image
	// $listingtemplate_google_maps
	// $listingtemplate_title
	// $listingtemplate_designations
	// $listingtemplate_address
	// $listingtemplate_address2
	// $listingtemplate_location
	// $listingtemplate_description
	// $listingtemplate_phone
	// $listingtemplate_fax
	// $listingtemplate_url
	// $listingtemplate_email
	// $listingtemplate_attachment_file
	// $listingtemplate_category_tree
	// $listingtemplate_long_description
	// $listingtemplate_hours_work
	// $listingtemplate_locations
	// $listingtemplate_gallery
	// $listingtemplate_rating
	// $extra_fields
	##################################################

?>

<div class="listingSummary">

	<h2 class="listingSummaryTitle"><?=$listingtemplate_title?></h2>
	
	
	<div class="listingSummaryContent">
		<?=$listingtemplate_designations?>
		
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
		
		<? if ($listingtemplate_phone) { ?>
			<p><strong>t: </strong><?=$listingtemplate_phone?></p>
		<? } ?>
		
	</div>
	
	<br class="clear" />
	
	<? if ($listingtemplate_rating) { ?>
		<?=$listingtemplate_rating?>
	<? } ?>

</div>