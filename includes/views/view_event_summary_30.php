<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/views/view_event_summary_30.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# DEFINES
	# ----------------------------------------------------------------------------------------------------

	if (MODREWRITE_FEATURE == "on") {
		$detailLink = "".EVENT_DEFAULT_URL."/".$event->getString("friendly_url").".html";
	} else {
		$detailLink = "".EVENT_DEFAULT_URL."/detail.php?id=".$event->getString("id");
	}

	$str_date = $event->getDateString();
	$str_time = $event->getTimeString();

?>

<a name="<?=$event->getString('friendly_url');?>"></a>

<div class="summary">

	<div class="baseIconNavbar">
		<? include(EDIRECTORY_ROOT."/includes/views/icon_event.php"); ?>
	</div>

	<div class="summaryContent">

		<div class="summaryTitle">

			<? if (strpos($_SERVER["PHP_SELF"], "results.php") !== false) { ?>
				<? if ((strlen(trim($event->getLocationString("A", true))) > 0) || (strlen(trim($event->getLocationString("s", true))) > 0) || (strlen(trim($event->getLocationString("r", true))) > 0)) { ?>
					<div class="summaryNumber">
						<a href="#topPage" onclick="javascript:myclick(<?=($mapNumber);?>);"><span><?=$mapNumber;?></span></a>
					</div>
				<? } ?>
			<? } ?>

			<h3>
				<? if (($user) && ($level->getDetail($event->getNumber("level")) == "y")) { ?>
					<a href="<?=$detailLink?>">
				<? } ?>
				<?=$event->getString("title")?>
				<?
				if (zipproximity_getDistanceLabel($zip, "event", $event->getNumber("id"), $distance_label)) {
					echo " (".$distance_label.")";
				}
				?>
				<? if (($user) && ($level->getDetail($event->getNumber("level")) == "y")) { ?>
					</a>
				<? } ?>
			</h3>
			
			<p class="complementaryInfo"><?=system_itemRelatedCategories($event->getNumber("id"), "event", $user);?></p>

		</div>
		
		<div class="summaryImage">

				<?
				$imageObj = new Image($event->getNumber("thumb_id"));
				if ($imageObj->imageExists()) {
					if (($user) && ($level->getDetail($event->getNumber("level")) == "y")) echo "<a href=\"".$detailLink."\">";
					echo $imageObj->getTag(true, IMAGE_EVENT_THUMB_WIDTH, IMAGE_EVENT_THUMB_HEIGHT, $event->getString("title"));
					if (($user) && ($level->getDetail($event->getNumber("level")) == "y")) echo "</a>";
				} else {
					echo "<div class=\"noimage\" style=\"width:".(IMAGE_EVENT_THUMB_WIDTH+5)."px; height:".(IMAGE_EVENT_THUMB_HEIGHT)."px;\">";
					if (($user) && ($level->getDetail($event->getNumber("level")) == "y")) echo "<a href=\"".$detailLink."\">";
					echo "&nbsp;";
					if (($user) && ($level->getDetail($event->getNumber("level")) == "y")) echo "</a>";
					echo "</div>";
				}
				?>

		</div>

		<p class="summaryDescription"><?=nl2br($event->getStringLang(EDIR_LANGUAGE, "description", true))?></p>

	</div>

	<div class="summaryComplementaryContent">
	
		<p class="complementaryInfo"><strong><?=system_showText(LANG_EVENT_DATE)?>:</strong> <?=$str_date?></p>
	
		<? if ($str_time) { ?>
		<p class="complementaryInfo summarySpacer"><strong><?=system_showText(LANG_EVENT_TIME)?>:</strong> <?=$str_time?></p>
		<? } ?>
		
		<? $location = $event->getLocationString("r, s z"); ?>
		
		<? if(($event->getString("address")) || ($event->getString("address2")) || ($location)) echo "<address class=\"summarySpacer\">\n"; ?>

		<? if ($event->getString("address")) { ?>
			<span><?=$event->getString("address")?></span>
		<? } ?>

		<? if ($event->getString("address2")) { ?>
			<span><?=$event->getString("address2")?></span>
		<? } ?>

		<? if ($location) { ?>
			<span><?=$location?></span>
		<? } ?>
		
		<? if(($event->getString("address")) || ($event->getString("address2")) || ($location)) echo "\n</address>\n"; ?>
		
		<? if ($event->getString("phone")) { ?>
			<p class="complementaryInfo"><strong><?=system_showText(LANG_EVENT_LETTERPHONE)?>: </strong><?=$event->getString("phone")?></p>
		<? } ?>
		
	</div>
	
</div>