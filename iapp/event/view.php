<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /iapp/event/view.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	if ($event["cidade_id"]) {
		if (!$stateArray[$event["cidade_id"]]) {
			$sqlState = "SELECT name FROM Location_State WHERE id = ".$event["cidade_id"]."";
			$resultState = $dbObj->query($sqlState);
			if ($resultState) {
				if ($state = mysql_fetch_assoc($resultState)) {
					$stateArray[$event["cidade_id"]] = $state["name"];
				}
			}
		}
	}

	if ($event["bairro_id"]) {
		if (!$regionArray[$event["bairro_id"]]) {
			$sqlRegion = "SELECT name FROM Location_Region WHERE id = ".$event["bairro_id"]."";
			$resultRegion = $dbObj->query($sqlRegion);
			if ($resultRegion) {
				if ($region = mysql_fetch_assoc($resultRegion)) {
					$regionArray[$event["bairro_id"]] = $region["name"];
				}
			}
		}
	}

	if ($event["start_date"] == $event["end_date"]) $str_date = $event["start_date"];
	else $str_date = $event["start_date"]." - ".$event["end_date"];

	$str_time = "";
	if ($event["has_start_time"] == "y") {
		$startTimeStr = explode(":", $event["start_time"]);
		if ($startTimeStr[0] > "12") {
			$start_time_hour = $startTimeStr[0] - 12;
			$start_time_am_pm = "pm";
		} elseif ($startTimeStr[0] == "12") {
			$start_time_hour = 12;
			$start_time_am_pm = "pm";
		} elseif ($startTimeStr[0] == "00") {
			$start_time_hour = 12;
			$start_time_am_pm = "am";
		} else {
			$start_time_hour = $startTimeStr[0];
			$start_time_am_pm = "am";
		}
		if ($start_time_hour < 10) $start_time_hour = "0".($start_time_hour+0);
		$start_time_min = $startTimeStr[1];
		$str_time .= $start_time_hour.":".$start_time_min." ".$start_time_am_pm;
	} else {
		$str_time .= "No Info";
	}
	$str_time .= " - ";
	if ($event["has_end_time"] == "y") {
		$endTimeStr = explode(":", $event["end_time"]);
		if ($endTimeStr[0] > "12") {
			$end_time_hour = $endTimeStr[0] - 12;
			$end_time_am_pm = "pm";
		} elseif ($endTimeStr[0] == "12") {
			$end_time_hour = 12;
			$end_time_am_pm = "pm";
		} elseif ($endTimeStr[0] == "00") {
			$end_time_hour = 12;
			$end_time_am_pm = "am";
		} else {
			$end_time_hour = $endTimeStr[0];
			$end_time_am_pm = "am";
		}
		if ($end_time_hour < 10) $end_time_hour = "0".($end_time_hour+0);
		$end_time_min = $endTimeStr[1];
		$str_time .= $end_time_hour.":".$end_time_min." ".$end_time_am_pm;
	} else {
		$str_time .= "No Info";
	}
	if (($event["has_start_time"] == "n") && ($event["has_end_time"] == "n")) {
		$str_time = "";
	}

?>

	<? if ($level->getDetail($event["level"]) == "y") { ?>
	<div class="itemViewDetail">
		<span rel="<?=DEFAULT_URL;?>/iapp/event/detail.php?id=<?=$event["id"];?>">
			<?
			$imageObj = new Image($event["thumb_id"]);
			if ($imageObj->imageExists()) {
				echo $imageObj->getTag(true, (IMAGE_EVENT_THUMB_WIDTH/2), (IMAGE_EVENT_THUMB_HEIGHT/2), $event["title"], true);
			}
			?>
		</span>
	<? } else { ?>
	<div class="itemView">
	<? } ?>

			<h1><?=$event["title"]?></h1>
			<? if ($str_date) { ?>
				<p class="eventDateTime"><span class="bold">Date:</span> <?=$str_date?></p>
			<? } ?>
			<? if ($str_time) { ?>
				<p class="eventDateTime"><span class="bold">Time:</span> <?=$str_time?></p>
			<? } ?>
			<? if ($event["address"] || $event["address2"] || $event["cidade_id"] || $event["bairro_id"] || $event["zip_code"]) { ?>
				<address>
					<? if ($event["address"]) { ?>
						<span><?=$event["address"]?></span>
					<? } ?>
					<? if ($event["address2"]) { ?>
						<span><?=$event["address2"]?></span>
					<? } ?>
					<? if ($event["cidade_id"] || $event["bairro_id"] || $event["zip_code"]) { ?>
						<span>
							<?
							if ($event["bairro_id"]) echo $regionArray[$event["bairro_id"]];
							if ($event["cidade_id"] && $event["bairro_id"] ) echo ", ";
							if ($event["cidade_id"]) echo $stateArray[$event["cidade_id"]];
							if ($event["cidade_id"] || $event["bairro_id"] ) echo " ";
							if ($event["zip_code"]) echo $event["zip_code"];
							?>
						</span>
					<? } ?>
				</address>
			<? } ?>
			<? if ($event["phone"]) { ?>
				<p><span class="bold">t:</span> <?=$event["phone"]?></p>
			<? } ?>
			<? if ($event["description"]) { ?>
				<?
				if (strlen($event["description"]) > MAX_DESC_LEN) {
					$event["description"] = substr($event["description"], 0, (MAX_DESC_LEN-3))."...";
				}
				?>
				<p><?=$event["description"]?></p>
			<? } ?>

	<? if ($level->getDetail($event["level"]) == "y") { ?>
		</span>
		<div class="clear"></div>
	</div>
	<? } else {?>
	</div>
	<? } ?>
