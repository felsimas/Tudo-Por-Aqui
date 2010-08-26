<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /mobile/listingview.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (MOBILE_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$langIndex = language_getIndex(EDIR_LANGUAGE);

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

	<div class="itemView listingView">
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
			<p><span class="bold"><?=system_showText(LANG_LISTING_LETTERPHONE);?>:</span> <?=$listing["phone"]?></p>
		<? } ?>
		<? if ($listing["description".$langIndex]) { ?>
			<?
			if (strlen($listing["description".$langIndex]) > MAX_DESC_LEN) {
				$listing["description".$langIndex] = substr($listing["description".$langIndex], 0, (MAX_DESC_LEN-3))."...";
			}
			?>
			<p><?=$listing["description".$langIndex]?></p>
		<? } ?>
	</div>
