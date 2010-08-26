<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /iapp/classified/view.php
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
	# CLASSIFIED
	# ----------------------------------------------------------------------------------------------------
	unset($classifiedMsg);
	if ($_GET["id"]) {
		$classified = new Classified($_GET["id"]);
		$level = new ClassifiedLevel();
		if ((!$classified->getNumber("id")) || ($classified->getNumber("id") <= 0)) {
			$classifiedMsg = ucwords(CLASSIFIED_FEATURE_NAME)." not found!";
		} elseif ($classified->getString("status") != "A") {
			$classifiedMsg = ucwords(CLASSIFIED_FEATURE_NAME)." not available!";
		} elseif ($level->getDetail($classified->getNumber("level")) != "y") {
			$classifiedMsg = ucwords(CLASSIFIED_FEATURE_NAME)." not available!";
		}
	} else {
		$classifiedMsg = ucwords(CLASSIFIED_FEATURE_NAME)." not available!";
	}

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	$section = "classified";
	$backButton = true;
	$headerTitle = ucwords(CLASSIFIED_FEATURE_NAME)." Detail";
	$homeButton = false;
	$contactButton = false;
	$searchButton = false;
	$searchButtonLink = "";
	include(EDIRECTORY_ROOT."/iapp/layout/header.php");

?>
	<div class="detail">
	<? if (!$classifiedMsg) { ?>

		<div class="itemDetail">

			<h1><?=$classified->getString("title")?></h1>
			<div class="img">
			<?
			$imageObj = new Image($classified->getNumber("thumb_id"));
			if ($imageObj->imageExists()) {
				echo $imageObj->getTag(true, IMAGE_CLASSIFIED_THUMB_WIDTH, IMAGE_CLASSIFIED_THUMB_HEIGHT, $classified->getString("title"));
			}
			?>
			</div>

			<? if ($classified->getString("address") || $classified->getString("address2") || $classified->getNumber("cidade_id") || $classified->getNumber("bairro_id") || $classified->getString("zip_code")) { ?>
				<address>
					<? if ($classified->getString("address")) { ?>
						<span><?=$classified->getString("address")?></span>
					<? } ?>
					<? if ($classified->getString("address2")) { ?>
						<span><?=$classified->getString("address2")?></span>
					<? } ?>
					<? if ($classified->getNumber("cidade_id") || $classified->getNumber("bairro_id") || $classified->getString("zip_code")) { ?>
						<span>
							<?=$classified->getLocationString("r, s z", true);?>
						</span>
					<? } ?>
				</address>
			<? } ?>

			<? if ($classified->getString("phone")) { ?>
				<p><span class="bold">t:</span> <?=$classified->getString("phone")?></p>
			<? } ?>

			<? if ($classified->getString("fax")) { ?>
				<p><span class="bold">f:</span> <?=$classified->getString("fax")?></p>
			<? } ?>

			<? if ($classified->getString("summarydesc")) { ?>
				<?
				$classifiedsummarydesc = $classified->getString("summarydesc");
				if (strlen($classifiedsummarydesc) > MAX_DESC_LEN) {
					$classifiedsummarydesc = substr($classifiedsummarydesc, 0, (MAX_DESC_LEN-3))."...";
				}
				?>
				<p><?=$classifiedsummarydesc?></p>
			<? } ?>

			<? if ($classified->getString("detaildesc")) { ?>
				<?
				$classifieddetaildesc = $classified->getString("detaildesc");
				if (strlen($classifieddetaildesc) > MAX_LONGDESC_LEN) {
					$classifieddetaildesc = substr($classifieddetaildesc, 0, (MAX_LONGDESC_LEN-3))."...";
				}
				?>
				<p><?=$classifieddetaildesc?></p>
			<? } ?>

		</div>

	<? } else { ?>
		<p class="warning"><?=$classifiedMsg;?></p>
	<? } ?>
	</div>
<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/iapp/layout/footer.php");
?>
