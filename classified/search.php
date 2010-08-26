<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classified/search.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLASSIFIED_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", FALSE);
	header("Pragma: no-cache");
	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

	$langIndex = language_getIndex(EDIR_LANGUAGE);

	$categories = db_getFromDBBySQL("classifiedcategory", "SELECT * FROM ClassifiedCategory WHERE category_id = 0 AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." ORDER BY title");
	if ($categories) {
		foreach ($categories as $category) {
			if (CLASSIFIEDCATEGORY_SCALABILITY_OPTIMIZATION != "on") {
				$valueArray[] = "";
				$nameArray[] = "---------------------------";
			}
			$valueArray[] = $category->getNumber("id");
			$nameArray[] = $category->getString("title".$langIndex);
			if (CLASSIFIEDCATEGORY_SCALABILITY_OPTIMIZATION != "on") {
				$subcategories = db_getFromDBBySQL("classifiedcategory", "SELECT * FROM ClassifiedCategory WHERE category_id = ".db_formatNumber($category->getNumber("id"))." AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." ORDER BY title");
				if ($subcategories) {
					foreach ($subcategories as $subcategory) {
						$valueArray[] = $subcategory->getNumber("id");
						$nameArray[] = "&nbsp;&nbsp;".$subcategory->getString("title".$langIndex);
					}
				}
			}
		}
	}
	if (CLASSIFIEDCATEGORY_SCALABILITY_OPTIMIZATION != "on") {
		$valueArray[] = "";
		$nameArray[] = "---------------------------";
	}
	$categoryDD = html_selectBoxCat("category_id", $nameArray, $valueArray, "", "", "", system_showText(LANG_SEARCH_LABELCBCATEGORY), "classified");

	$countryObj = new LocationCountry();
	$allCountries = $countryObj->retrieveAllCountries();

	?>

	<span class="clear"></span>

	<fieldset class="baseAdvancedSearch">
		<legend><?=system_showText(LANG_SEARCH_LABELMATCH)?>:</legend>
		<p><input type="radio" name="match" value="exactmatch" class="inputAuto" /> <?=system_showText(LANG_SEARCH_LABELMATCH_EXACTMATCH)?></p>
		<p><input type="radio" name="match" value="anyword" class="inputAuto" /> <?=system_showText(LANG_SEARCH_LABELMATCH_ANYWORD)?></p>
		<p><input type="radio" name="match" value="allwords" class="inputAuto" /> <?=system_showText(LANG_SEARCH_LABELMATCH_ALLWORDS)?></p>
	</fieldset>

	<fieldset class="baseAdvancedSearch">
		<legend><?=system_showText(LANG_SEARCH_LABELCATEGORY)?>:</legend>
		<?=$categoryDD;?>
	</fieldset>

	<fieldset class="baseAdvancedSearch">
		<legend><?=system_showText(LANG_SEARCH_LABELLOCATION)?>:</legend>
		<select name="estado_id" id="estado_id" onchange="fillSelect('<?=DEFAULT_URL?>', this.form.cidade_id, this.value, this.form);">
			<option value=""><?=system_showText(LANG_SEARCH_LABELCBCOUNTRY)?></option>
			<?
			if ($allCountries) {
				foreach ($allCountries as $each_country) {
					?><option value="<?=$each_country["id"]?>"><?=$each_country["name"]?></option><?
				}
			}
			?>
		</select>
		<select name="cidade_id" id="cidade_id" onchange="fillSelect('<?=DEFAULT_URL?>', this.form.bairro_id, this.value, this.form);">
			<option value=""><?=system_showText(LANG_SEARCH_LABELCBSTATE)?></option>
		</select>
		<select name="bairro_id" id="bairro_id">
			<option value=""><?=system_showText(LANG_SEARCH_LABELCBCITY)?></option>
		</select>
	</fieldset>

	<? if (ZIPCODE_PROXIMITY == "on") { ?>
		<fieldset class="baseAdvancedSearch">
			<legend><?=ucwords(ZIPCODE_LABEL)?>:</legend>
			<p><input type="text" name="dist" value="" class="inputSmall" />
			<?=ucwords(ZIPCODE_UNIT_LABEL_PLURAL)." ".system_showText(LANG_SEARCH_LABELZIPCODE_OF)?></p>
			<p><input type="text" name="zip" value="" class="inputSmall" />
			<?=ucwords(ZIPCODE_LABEL)?></p>
		</fieldset>
	<? } ?>
