<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /iapp/listing/view.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	if ($listing["cidade_id"]) {
		if (!$stateArray[$listing["cidade_id"]]) {
			$sqlState = "SELECT name FROM Location_State WHERE id = ".$listing["cidade_id"]."";
			$resultState = $dbObj->query($sqlState);
			if ($resultState) {
				if ($state = mysql_fetch_assoc($resultState)) {
					$stateArray[$listing["cidade_id"]] = $state["name"];
				}
			}
		}
	}

	if ($listing["bairro_id"]) {
		if (!$regionArray[$listing["bairro_id"]]) {
			$sqlRegion = "SELECT name FROM Location_Region WHERE id = ".$listing["bairro_id"]."";
			$resultRegion = $dbObj->query($sqlRegion);
			if ($resultRegion) {
				if ($region = mysql_fetch_assoc($resultRegion)) {
					$regionArray[$listing["bairro_id"]] = $region["name"];
				}
			}
		}
	}

?>

	<? if ($level->getDetail($listing["level"]) == "y") { ?>
	<div class="itemViewDetail">
		<span rel="<?=DEFAULT_URL;?>/iapp/listing/detail.php?id=<?=$listing["id"];?>">
			<?
			$imageObj = new Image($listing["thumb_id"]);
			if ($imageObj->imageExists()) {
				echo $imageObj->getTag(true, (IMAGE_LISTING_THUMB_WIDTH/2), (IMAGE_LISTING_THUMB_HEIGHT/2), $listing["title"], true);
			}
			?>
		</span>
	<? } else { ?>
	<div class="itemView">
	<? } ?>

			<h1><?=$listing["title"]?></h1>
			<? if ($listing["address"] || $listing["address2"] || $listing["cidade_id"] || $listing["bairro_id"] || $listing["zip_code"]) { ?>
				<address>
					<? if ($listing["address"]) { ?>
						<span><?=$listing["address"]?></span>
					<? } ?>
					<? if ($listing["address2"]) { ?>
						<span><?=$listing["address2"]?></span>
					<? } ?>
					<? if ($listing["cidade_id"] || $listing["bairro_id"] || $listing["zip_code"]) { ?>
						<span>
							<?
							if ($listing["bairro_id"]) echo $regionArray[$listing["bairro_id"]];
							if ($listing["cidade_id"] && $listing["bairro_id"] ) echo ", ";
							if ($listing["cidade_id"]) echo $stateArray[$listing["cidade_id"]];
							if ($listing["cidade_id"] || $listing["bairro_id"] ) echo " ";
							if ($listing["zip_code"]) echo $listing["zip_code"];
							?>
						</span>
					<? } ?>
				</address>
			<? } ?>
			<? if ($listing["phone"]) { ?>
				<p><span class="bold">t:</span> <?=$listing["phone"]?></p>
			<? } ?>
			<? if ($listing["description"]) { ?>
				<?
				if (strlen($listing["description"]) > MAX_DESC_LEN) {
					$listing["description"] = substr($listing["description"], 0, (MAX_DESC_LEN-3))."...";
				}
				?>
				<p><?=$listing["description"]?></p>
			<? } ?>

	<? if ($level->getDetail($listing["level"]) == "y") { ?>
		</span>
		<div class="clear"></div>
	</div>
	<? } else {?>
	</div>
	<? } ?>
