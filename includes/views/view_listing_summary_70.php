<?


?>

<a name="<?=$listingtemplate_friendly_url;?>"></a>
	


<div class="resultado" >



<!-- 
			<? if (strpos($_SERVER["PHP_SELF"], "results.php") !== false) { ?>
				<? if ((strlen(trim($listing->getLocationString("A", true))) > 0) || (strlen(trim($listing->getLocationString("s", true))) > 0) || (strlen(trim($listing->getLocationString("r", true))) > 0)) { ?>
					<div class="summaryNumber">
						<a href="#topPage" onclick="javascript:myclick(<?=($mapNumber);?>);"><span><?=$mapNumber;?></span></a>
					</div>
				<? } ?>
			<? } ?> !-->

			<h2 <?=$templateCSSTitle;?>><?=$listingtemplate_title?></h2>

	<div id="estrelas">			
		<?=$listingtemplate_review?>
	</div>

	

		<!-- <div class="summaryImage">
			<?=$listingtemplate_image?>
		</div> !-->

		<div class="summaryDescription">

			<?=$listingtemplate_designations?>

		
	
			
		<?php 	if ($listingtemplate_address != null) { ?>
			<h4><?php echo utf8_decode("Endereço: ")?><?=$listingtemplate_address?> <?=$listingtemplate_address2?> - <?=$listingtemplate_location?></h4>
		<?php } ?>
		
		
		<?php 	if ($listingtemplate_phone != null) { ?>
		

			<h4><?=system_showText("Telefone")?>: <?=$listingtemplate_phone?></h4>
		<?php } ?>


	<!-- 	<?php 	if ($listingtemplate_fax != null) { ?>
	
			<h4><?=system_showText(LANG_LISTING_LETTERFAX)?>: <?=$listingtemplate_fax?></h4>

		<?php } ?>

		<?php 	if ($listingtemplate_url != null) { ?>

			<h4><?=system_showText(LANG_LISTING_LETTERWEBSITE)?>: <?=$listingtemplate_url?></h4>
		<?php } ?> -->	


			<?php 	if ($listingtemplate_email != null) { ?>

			<h3><?=$listingtemplate_email?></h3>

			<?php } ?>


		
			
			

		</div>


<?=$listingdetailsbtn ?>
		



</div>

