<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /iapp/listing/view.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# DEFINE
	# ----------------------------------------------------------------------------------------------------
	define(MAX_DESC_LEN, 100);
	define(MAX_LONGDESC_LEN, 200);

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	# ----------------------------------------------------------------------------------------------------
	# LISTING
	# ----------------------------------------------------------------------------------------------------
	unset($listingMsg);
	if ($_GET["id"]) {
		$listing = new Listing($_GET["id"]);
		$level = new ListingLevel();
		if ((!$listing->getNumber("id")) || ($listing->getNumber("id") <= 0)) {
			$listingMsg = ucwords(LISTING_FEATURE_NAME)." not found!";
		} elseif ($listing->getString("status") != "A") {
			$listingMsg = ucwords(LISTING_FEATURE_NAME)." not available!";
		} elseif ($level->getDetail($listing->getNumber("level")) != "y") {
			$listingMsg = ucwords(LISTING_FEATURE_NAME)." not available!";
		}
	} else {
		$listingMsg = ucwords(LISTING_FEATURE_NAME)." not available!";
	}

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	$section = "listing";
	$backButton = true;
	$headerTitle = ucwords(LISTING_FEATURE_NAME)." Detail";
	$homeButton = false;
	$contactButton = false;
	$searchButton = false;
	$searchButtonLink = "";
	include(EDIRECTORY_ROOT."/iapp/layout/header.php");

?>
	<div class="detail">
	<? if (!$listingMsg) { ?>

		<div class="itemDetail">

			<h1><?=$listing->getString("title")?></h1>
			<div class="img">
			<?
			$imageObj = new Image($listing->getNumber("thumb_id"));
			if ($imageObj->imageExists()) {
				echo $imageObj->getTag(true, IMAGE_LISTING_THUMB_WIDTH, IMAGE_LISTING_THUMB_HEIGHT, $listing->getString("title"));
			}
			?>
			</div>

			<? if ($listing->getString("address") || $listing->getString("address2") || $listing->getNumber("cidade_id") || $listing->getNumber("bairro_id") || $listing->getString("zip_code")) { ?>
				<address>
					<? if ($listing->getString("address")) { ?>
						<span><?=$listing->getString("address")?></span>
					<? } ?>
					<? if ($listing->getString("address2")) { ?>
						<span><?=$listing->getString("address2")?></span>
					<? } ?>
					<? if ($listing->getNumber("cidade_id") || $listing->getNumber("bairro_id") || $listing->getString("zip_code")) { ?>
						<span>
							<?=$listing->getLocationString("r, s z", true);?>
						</span>
					<? } ?>
				</address>
			<? } ?>

			<? if ($listing->getString("phone")) { ?>
				<p><span class="bold">t:</span> <?=$listing->getString("phone")?></p>
			<? } ?>

			<? if ($listing->getString("fax")) { ?>
				<p><span class="bold">f:</span> <?=$listing->getString("fax")?></p>
			<? } ?>

			<? if ($listing->getString("description")) { ?>
				<?
				$listingdescription = $listing->getString("description");
				if (strlen($listingdescription) > MAX_DESC_LEN) {
					$listingdescription = substr($listingdescription, 0, (MAX_DESC_LEN-3))."...";
				}
				?>
				<p><?=$listingdescription?></p>
			<? } ?>

			<? if ($listing->getString("long_description")) { ?>
				<?
				$listinglongdescription = $listing->getString("long_description");
				if (strlen($listinglongdescription) > MAX_LONGDESC_LEN) {
					$listinglongdescription = substr($listinglongdescription, 0, (MAX_LONGDESC_LEN-3))."...";
				}
				?>
				<p><?=$listinglongdescription?></p>
			<? } ?>

		</div>

	<? } else { ?>
		<p class="warning"><?=$listingMsg;?></p>
	<? } ?>
	</div>
<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/iapp/layout/footer.php");
?>
