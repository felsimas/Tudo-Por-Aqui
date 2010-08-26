<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /listing/search.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	if (!$position) $position = "vertical";

	if ($position != "advanced") {

		$categories = db_getFromDB("listingcategory", "category_id", 0, "all", "title");
		if ($categories) {
			foreach ($categories as $category) {
				if (LISTINGCATEGORY_SCALABILITY_OPTIMIZATION != "on") {
					$valueArray[] = "";
					$nameArray[] = "---------------------------";
				}
				$valueArray[] = $category->getNumber("id");
				$nameArray[] = $category->getString("title");
				if (LISTINGCATEGORY_SCALABILITY_OPTIMIZATION != "on") {
					$subcategories = db_getFromDB("listingcategory", "category_id", $category->getNumber("id"), "all", "title");
					if ($subcategories) {
						foreach ($subcategories as $subcategory) {
							$valueArray[] = $subcategory->getNumber("id");
							$nameArray[] = "&nbsp;&nbsp;".$subcategory->getString("title");
						}
					}
				}
			}
		}
		if (LISTINGCATEGORY_SCALABILITY_OPTIMIZATION != "on") {
			$valueArray[] = "";
			$nameArray[] = "---------------------------";
		}
		$categoryDD = html_selectBoxCat("category_id", $nameArray, $valueArray, $_GET["category_id"], "", "class='".$position."-input-dd-simplesearch'", "Select a Category");

	}

	if ($position == "advanced") {

		$valueArray = array();
		$nameArray = array();
		$sqlMainCat = "SELECT * FROM ListingCategory WHERE category_id = 0 AND active_listing > 0 ORDER BY title";
		$dbObjMainCat = db_getDBObJect();
		$resultMainCat = $dbObjMainCat->query($sqlMainCat);
		if ($resultMainCat) {
			while ($rowMainCat = mysql_fetch_assoc($resultMainCat)) {
				if (LISTINGCATEGORY_SCALABILITY_OPTIMIZATION != "on") {
					$valueArray[] = "";
					$nameArray[] = "---------------------------";
				}
				$valueArray[] = $rowMainCat["id"];
				$nameArray[] = $rowMainCat["title"];
				if (LISTINGCATEGORY_SCALABILITY_OPTIMIZATION != "on") {
					$sqlSubCat = "SELECT * FROM ListingCategory WHERE category_id = '".$rowMainCat["id"]."' AND active_listing > 0 ORDER BY title";
					$dbObjSubCat = db_getDBObJect();
					$resultSubCat = $dbObjSubCat->query($sqlSubCat);
					while ($rowSubCat = mysql_fetch_assoc($resultSubCat)) {
						$valueArray[] = $rowSubCat["id"];
						$nameArray[] = "&nbsp;&nbsp;".$rowSubCat["title"];
					}
				}
			}
		}
		if (LISTINGCATEGORY_SCALABILITY_OPTIMIZATION != "on") {
			$valueArray[] = "";
			$nameArray[] = "---------------------------";
		}
		$categoryDDAdvanced = html_selectBoxCat("category_id", $nameArray, $valueArray, $category_id, "", "", "Select a Category");

	}

	$countryObj = new LocationCountry();
	$countries  = $countryObj->retrieveAllCountries();

		
	if($_GET["city_id"]) {
		$areaObj= new LocationArea();
		$areaObj->SetString("city_id",$_GET["city_id"]);
		$selected_areas = $areaObj->retrieveAreasByCity();
	}

	$selected_country = ($_GET["estado_id"]) ? new LocationCountry($_GET["estado_id"]) : FALSE;
	$selected_state   = ($_GET["cidade_id"])   ? new LocationState($_GET["cidade_id"])     : FALSE;
	$selected_region  = ($_GET["bairro_id"])  ? new LocationRegion($_GET["bairro_id"])   : FALSE;
	$selected_city    = ($_GET["city_id"])    ? new LocationCity($_GET["city_id"])       : FALSE;
	$selected_area    = ($_GET["area_id"])    ? new LocationArea($_GET["area_id"])       : FALSE;

	# ----------------------------------------------------------------------------------------------------
	# VERTICAL SEARCH
	# ----------------------------------------------------------------------------------------------------
	if ($position == "vertical") {
		?>

		<form name="advancedsearch_form" method="get" action="<?=LISTING_DEFAULT_URL?>/results.php">

					<table border="0" align="center" cellpadding="0" cellspacing="10" class="advancedsearch">
				<tr>
					<th>Keyword:</th>
					<td><input type="text" name="keyword" value="<?=$keyword?>" /></td>
					<th>Category:</th>
					<td><?=$categoryDDAdvanced?></td>
				</tr>
				<tr>
					<th>Location:</th>
					<td>
						<select name="estado_id" id="estado_id" onchange="fillSelect('<?=DEFAULT_URL?>', this.form.cidade_id, this.value, this.form);">
							<option value="">Select a Country</option>
							<?
							if($countries) foreach($countries as $each_country){
								$selected = ($estado_id == $each_country["id"]) ? "selected" : "";
								?>
								<option <?=$selected?> value="<?=$each_country["id"]?>"><?=$each_country["name"]?></option>
								<?
								unset($selected);
							}
							?>
						</select>
						<select name="cidade_id" id="cidade_id" onchange="fillSelect('<?=DEFAULT_URL?>', this.form.bairro_id, this.value, this.form);">
							<option value="">Select a State</option>
							<?
							if($selected_states) foreach($selected_states as $each_state){
								if($selected_state) $selected = ($selected_state->GetString("id") == $each_state["id"]) ? "selected" : "";
								?>
								<option <?=$selected?> value="<?=$each_state["id"];?>"><?=$each_state["name"];?></option>
								<?
								unset($selected);
							}
							?>
						</select>
						<select name="bairro_id" id="bairro_id">
							<option value="">Select a City</option>
							<?
							if($selected_regions) foreach($selected_regions as $each_region){
								if($selected_region) $selected = ($selected_region->getString("id") == $each_region["id"]) ? "selected" : "" ;
								?>
								<option <?=$selected?> value="<?=$each_region["id"];?>"><?=$each_region["name"];?></option>
								<?
								unset($selected);
							}
							?>
						</select>
					</td>
					<? if (ZIPCODE_PROXIMITY == "on") { ?>
						<th>
							<span style="margin-top: 20px;"><?=ucwords(ZIPCODE_LABEL)?>:</span>
						</th>
						<td>
							<span><input type="text" name="dist" value="<?=$dist?>" class="advancedInputSmall" /> <?=ucwords(ZIPCODE_UNIT)?>s of<br /><input type="text" name="zip" value="<?=$zip?>" class="advancedInputSmall" /> <?=ucwords(ZIPCODE_LABEL)?></span>
						</td>
					<? } ?>
				</tr>
				<tr>
					<th colspan="4" style="width: auto;">
						<ul class="standardButton">
							<li><button type="submit">Search</button></li>
						</ul>
					</th>
				</tr>
			</table>

		</form>

		<?
	}

	# ----------------------------------------------------------------------------------------------------
	# ADVANCED SEARCH
	# ----------------------------------------------------------------------------------------------------
	if ($position == "advanced") {
		?>

		<form name="advancedsearch_form" method="get" action="<?=LISTING_DEFAULT_URL?>/results.php">

			<h1 class="advancedsearchTITLE">Advanced <span>Search</span></h1>

			<table border="0" align="center" cellpadding="0" cellspacing="10" class="advancedsearch">
				<tr>
					<th>Keyword:</th>
					<td><input type="text" name="keyword" value="<?=$keyword?>" /></td>
					<th>Category:</th>
					<td><?=$categoryDDAdvanced?></td>
				</tr>
				<tr>
					<th>Location:</th>
					<td>
						<select name="estado_id" id="estado_id" onchange="fillSelect('<?=DEFAULT_URL?>', this.form.cidade_id, this.value, this.form);">
							<option value="">Select a Country</option>
							<?
							if($countries) foreach($countries as $each_country){
								$selected = ($estado_id == $each_country["id"]) ? "selected" : "";
								?>
								<option <?=$selected?> value="<?=$each_country["id"]?>"><?=$each_country["name"]?></option>
								<?
								unset($selected);
							}
							?>
						</select>
						<select name="cidade_id" id="cidade_id" onchange="fillSelect('<?=DEFAULT_URL?>', this.form.bairro_id, this.value, this.form);">
							<option value="">Select a State</option>
							<?
							if($selected_states) foreach($selected_states as $each_state){
								if($selected_state) $selected = ($selected_state->GetString("id") == $each_state["id"]) ? "selected" : "";
								?>
								<option <?=$selected?> value="<?=$each_state["id"];?>"><?=$each_state["name"];?></option>
								<?
								unset($selected);
							}
							?>
						</select>
						<select name="bairro_id" id="bairro_id">
							<option value="">Select a City</option>
							<?
							if($selected_regions) foreach($selected_regions as $each_region){
								if($selected_region) $selected = ($selected_region->getString("id") == $each_region["id"]) ? "selected" : "" ;
								?>
								<option <?=$selected?> value="<?=$each_region["id"];?>"><?=$each_region["name"];?></option>
								<?
								unset($selected);
							}
							?>
						</select>
					</td>
					<? if (ZIPCODE_PROXIMITY == "on") { ?>
						<th>
							<span style="margin-top: 20px;"><?=ucwords(ZIPCODE_LABEL)?>:</span>
						</th>
						<td>
							<span><input type="text" name="dist" value="<?=$dist?>" class="advancedInputSmall" /> <?=ucwords(ZIPCODE_UNIT)?>s of<br /><input type="text" name="zip" value="<?=$zip?>" class="advancedInputSmall" /> <?=ucwords(ZIPCODE_LABEL)?></span>
						</td>
					<? } ?>
				</tr>
				<tr>
					<th colspan="4" style="width: auto;">
						<ul class="standardButton">
							<li><button type="submit">Search</button></li>
						</ul>
					</th>
				</tr>
			</table>

		</form>

		<?
	}

?>
