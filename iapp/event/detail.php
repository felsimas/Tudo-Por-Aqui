<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /iapp/event/view.php
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
	# EVENT
	# ----------------------------------------------------------------------------------------------------
	unset($eventMsg);
	if ($_GET["id"]) {
		$event = new Event($_GET["id"]);
		$level = new EventLevel();
		if ((!$event->getNumber("id")) || ($event->getNumber("id") <= 0)) {
			$eventMsg = ucwords(EVENT_FEATURE_NAME)." not found!";
		} elseif ($event->getString("status") != "A") {
			$eventMsg = ucwords(EVENT_FEATURE_NAME)." not available!";
		} elseif ($level->getDetail($event->getNumber("level")) != "y") {
			$eventMsg = ucwords(EVENT_FEATURE_NAME)." not available!";
		}
	} else {
		$eventMsg = ucwords(EVENT_FEATURE_NAME)." not available!";
	}

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	$section = "event";
	$backButton = true;
	$headerTitle = ucwords(EVENT_FEATURE_NAME)." Detail";
	$homeButton = false;
	$contactButton = false;
	$searchButton = false;
	$searchButtonLink = "";
	include(EDIRECTORY_ROOT."/iapp/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$str_date = $event->getDateString();
	$str_time = $event->getTimeString();

?>
	<div class="detail">
	<? if (!$eventMsg) { ?>

		<div class="itemDetail">

			<h1><?=$event->getString("title")?></h1>
			<div class="img">
			<?
			$imageObj = new Image($event->getNumber("thumb_id"));
			if ($imageObj->imageExists()) {
				echo $imageObj->getTag(true, IMAGE_EVENT_THUMB_WIDTH, IMAGE_EVENT_THUMB_HEIGHT, $event->getString("title"));
			}
			?>
			</div>

			<? if ($str_date) { ?>
				<p class="eventDateTime"><span class="bold">Date:</span> <?=$str_date?></p>
			<? } ?>

			<? if ($str_time) { ?>
				<p class="eventDateTime"><span class="bold">Time:</span> <?=$str_time?></p>
			<? } ?>

			<? if ($event->getString("address") || $event->getString("address2") || $event->getNumber("cidade_id") || $event->getNumber("bairro_id") || $event->getString("zip_code")) { ?>
				<address>
					<? if ($event->getString("address")) { ?>
						<span><?=$event->getString("address")?></span>
					<? } ?>
					<? if ($event->getString("address2")) { ?>
						<span><?=$event->getString("address2")?></span>
					<? } ?>
					<? if ($event->getNumber("cidade_id") || $event->getNumber("bairro_id") || $event->getString("zip_code")) { ?>
						<span>
							<?=$event->getLocationString("r, s z", true);?>
						</span>
					<? } ?>
				</address>
			<? } ?>

			<? if ($event->getString("phone")) { ?>
				<p><span class="bold">t:</span> <?=$event->getString("phone")?></p>
			<? } ?>

			<? if ($event->getString("description")) { ?>
				<?
				$eventdescription = $event->getString("description");
				if (strlen($eventdescription) > MAX_DESC_LEN) {
					$eventdescription = substr($eventdescription, 0, (MAX_DESC_LEN-3))."...";
				}
				?>
				<p><?=$eventdescription?></p>
			<? } ?>

			<? if ($event->getString("long_description")) { ?>
				<?
				$eventlongdescription = $event->getString("long_description");
				if (strlen($eventlongdescription) > MAX_LONGDESC_LEN) {
					$eventlongdescription = substr($eventlongdescription, 0, (MAX_LONGDESC_LEN-3))."...";
				}
				?>
				<p><?=$eventlongdescription?></p>
			<? } ?>

		</div>

	<? } else { ?>
		<p class="warning"><?=$eventMsg;?></p>
	<? } ?>
	</div>
<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/iapp/layout/footer.php");
?>
