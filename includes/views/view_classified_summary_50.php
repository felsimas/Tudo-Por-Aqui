<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/views/view_classified_summary_50.php
	# ----------------------------------------------------------------------------------------------------

	if (MODREWRITE_FEATURE == "on") {
		$detailLink = "".CLASSIFIED_DEFAULT_URL."/".$classified->getString("friendly_url").".html";
	} else {
		$detailLink = "".CLASSIFIED_DEFAULT_URL."/detail.php?id=".$classified->getNumber("id");
	}

?>

<a name="<?=$classified->getString('friendly_url');?>"></a>

<div class="summary showcase">

	<div class="baseIconNavbar">
		<? include(EDIRECTORY_ROOT."/includes/views/icon_classified.php"); ?>
	</div>

	<div class="summaryContent">

		<div class="summaryTitle">

			<? if (strpos($_SERVER["PHP_SELF"], "results.php") !== false) { ?>
				<? if ((strlen(trim($classified->getLocationString("A", true))) > 0) || (strlen(trim($classified->getLocationString("s", true))) > 0) || (strlen(trim($classified->getLocationString("r", true))) > 0)) { ?>
					<div class="summaryNumber">
						<a href="#topPage" onclick="javascript:myclick(<?=($mapNumber);?>);"><span><?=$mapNumber;?></span></a>
					</div>
				<? } ?>
			<? } ?>
		
			<h3>
				<? if (($user) && ($level->getDetail($classified->getNumber("level")) == "y")) { ?>
					<a href="<?=$detailLink?>">
				<? } ?>
				<?=$classified->getString("title")?>
				<?
				if (zipproximity_getDistanceLabel($zip, "classified", $classified->getNumber("id"), $distance_label)) {
					echo " (".$distance_label.")";
				}
				?>
				<? if (($user) && ($level->getDetail($classified->getNumber("level")) == "y")) { ?>
					</a>
				<? } ?>
			</h3>

			<p class="complementaryInfo"><?=system_itemRelatedCategories($classified->getNumber("id"), "classified", $user);?></p>

		</div>
			
		<div class="summaryImage">
			<?
			$imageObj = new Image($classified->getNumber("thumb_id"));
			if ($imageObj->imageExists()) {
				if (($user) && ($level->getDetail($classified->getNumber("level")) == "y")) echo "<a href=\"".$detailLink."\">";
				echo $imageObj->getTag(true, IMAGE_CLASSIFIED_THUMB_WIDTH, IMAGE_CLASSIFIED_THUMB_HEIGHT, $classified->getString("title"));
				if (($user) && ($level->getDetail($classified->getNumber("level")) == "y")) echo "</a>";
			} else {
				echo "<div class=\"noimage\" style=\"width:".(IMAGE_CLASSIFIED_THUMB_WIDTH+5)."px; height:".(IMAGE_CLASSIFIED_THUMB_HEIGHT)."px;\">";
				if (($user) && ($level->getDetail($classified->getNumber("level")) == "y")) echo "<a href=\"".$detailLink."\">";
				echo "&nbsp;";
				if (($user) && ($level->getDetail($classified->getNumber("level")) == "y")) echo "</a>";
				echo "</div>";
			}
			?>
		</div>
		
		<? if ($classified->getString("summarydesc")) { ?>
			<p class="summaryDescription"><?=nl2br($classified->getStringLang(EDIR_LANGUAGE, "summarydesc", true))?></p>
		<? } ?>

	</div>
		
	<div class="summaryComplementaryContent">

		<? if ($classified->getString("phone")) echo "<p class=\"complementaryInfo summarySpacer\">".nl2br($classified->getString("phone", true))."</p>"; ?>
		
		<? if ($classified->getString("email")) { ?>
			<p class="complementaryInfo summarySpacer"><a href="javascript: void(0);" <? if ($user) { ?> onclick="javascript:window.open('<?=CLASSIFIED_DEFAULT_URL?>/emailform.php?classi_id=<?=$classified->getNumber("id")?>&amp;receiver=owner', 'popup', 'toolbar=0, location=0, directories=0, status=0, width=700, height=420, screenX=0, screenY=0, menubar=0, scrollbars, resizable=0')" <? } ?>><?=nl2br($classified->getString("email", true))?></a></p>
		<? } ?>
		
		<? if ($classified->getString("url")) { ?>
			<? if ($user){ ?>
				<p class="complementaryInfo summarySpacer"><a href="<?=nl2br($classified->getString("url", true))?>" target="_blank"><?=nl2br($classified->getString("url", true))?></a></p>
			<? } else { ?>
				<p class="complementaryInfo"><a href="javascript:void(0);"><?=nl2br($classified->getString("url", true))?></a></p>
			<? } ?>
		<? } ?>
		
	</div>
	
</div>