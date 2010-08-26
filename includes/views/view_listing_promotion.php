<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/views/view_listing_promotion.php
	# ----------------------------------------------------------------------------------------------------

	$listingObj = new Listing();
	$listings = $listingObj->retrieveListingsbyPromotion_id($promotion->getNumber("id"));
	$promotion_link = "javascript:window.open('".PROMOTION_DEFAULT_URL."/promotion.php?id=".$promotion->getNumber("id")."', 'popup', 'toolbar=0, location=0, directories=0, status=0, width=".(IMAGE_PROMOTION_FULL_WIDTH+100).", height=".(IMAGE_PROMOTION_FULL_HEIGHT+100).", screenX=0, screenY=0, menubar=0, scrollbars=no, resizable=0');";
	
	if ($listings) {
	
		echo "<script type=\"text/javascript\">var listing_id = ".$listings[0]->getString("id")."</script>";
		
	}

?>

<a name="<?=$listings[0]->getString('friendly_url');?>"></a>

<div class="summary">

	<div class="baseIconNavbar"><? include(EDIRECTORY_ROOT."/includes/views/icon_promotion.php"); ?></div>

	<div class="summaryTitle">

		<? if (strpos($_SERVER["PHP_SELF"], "results.php") !== false) { ?>
			<? if ((strlen(trim($listings[0]->getLocationString("A", true))) > 0) || (strlen(trim($listings[0]->getLocationString("s", true))) > 0) || (strlen(trim($listings[0]->getLocationString("r", true))) > 0) || (strlen(trim($listings[0]->getLocationString("z", true))) > 0)) { ?>
				<div class="summaryNumber">
					<a href="#topPage" onclick="javascript:myclick(<?=($mapNumber);?>);"><span><?=$mapNumber;?></span></a>
				</div>
			<? } ?>
		<? } ?>
		
		<h3><a href="javascript:void(0);" onclick="<?=$promotion_link?>"><?=$promotion->getString("name");?></a></h3>
		
		<p class="complementaryInfo">
			<?=system_showText(LANG_PROMOTION_OFFEREDBY)?>
			<?
			if ($listings) {

				$level = new ListingLevel();

				if ($level->getDetail($listings[0]->getNumber("level")) == "y") {

					if (MODREWRITE_FEATURE == "on") {
						$listing_link = "".LISTING_DEFAULT_URL."/".$listings[0]->getString("friendly_url").".html";
					} else {
						$listing_link = "".LISTING_DEFAULT_URL."/detail.php?id=".$listings[0]->getNumber("id")."";
					}

				} else {

					$listing_link = "".LISTING_DEFAULT_URL."/results.php?id=".$listings[0]->getNumber("id");
				}

				?>
				<a href="<?=$listing_link?>"><?=$listings[0]->getString("title");?></a>
			<?
			}
			echo system_itemRelatedCategories($listings[0]->getNumber("id"), "listing", $user);
			?>
		</p>

	</div>

</div>