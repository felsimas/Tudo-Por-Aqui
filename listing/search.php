<?

	include("../conf/loadconfig.inc.php");

	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", FALSE);
	header("Pragma: no-cache");
	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

	$langIndex = language_getIndex(EDIR_LANGUAGE);

	if ($_GET["template_id"]) {
		$listingtemplate = new ListingTemplate($_GET["template_id"]);
		if ($listingtemplate && $listingtemplate->getNumber("id") && is_numeric($listingtemplate->getNumber("id")) && ($listingtemplate->getNumber("id")>0)) {
			$templatecategories = $listingtemplate->getCategories();
		}
		if ($templatecategories) {
			foreach ($templatecategories as $templatecategory) {
				$arraycategories[] = $templatecategory->getNumber("id");
			}
			$categories = db_getFromDBBySQL("listingcategory", "SELECT * FROM ListingCategory WHERE category_id = 0 AND id IN (".(implode(",", $arraycategories)).")AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." ORDER BY title");
		} else {
			$categories = db_getFromDBBySQL("listingcategory", "SELECT * FROM ListingCategory WHERE category_id = 0 AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." ORDER BY title");
		}
	} else {
		$categories = db_getFromDBBySQL("listingcategory", "SELECT * FROM ListingCategory WHERE category_id = 0 AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." ORDER BY title");
	}
	if ($categories) {
		foreach ($categories as $category) {
			if (LISTINGCATEGORY_SCALABILITY_OPTIMIZATION != "on") {
				$valueArray[] = "";
				$nameArray[] = "---------------------------";
			}
			$valueArray[] = $category->getNumber("id");
			$nameArray[] = $category->getString("title".$langIndex);
			if (LISTINGCATEGORY_SCALABILITY_OPTIMIZATION != "on") {
				$subcategories = db_getFromDBBySQL("listingcategory", "SELECT * FROM ListingCategory WHERE category_id = ".db_formatNumber($category->getNumber("id"))." AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." ORDER BY title");
				if ($subcategories) {
					foreach ($subcategories as $subcategory) {
						$valueArray[] = $subcategory->getNumber("id");
						$nameArray[] = "&nbsp;&nbsp;".$subcategory->getString("title".$langIndex);
					}
				}
			}
		}
	}
	if (LISTINGCATEGORY_SCALABILITY_OPTIMIZATION != "on") {
		$valueArray[] = "";
		$nameArray[] = "---------------------------";
	}
	$categoryDD = html_selectBoxCat("category_id", $nameArray, $valueArray, "", "", "", system_showText(LANG_SEARCH_LABELCBCATEGORY));

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
	
	<span class="clear"></span>

	<?
	if (""=="") {
		
		if (""=="") {
			if ($_GET["template_id"]) {
				?><fieldset id="templateSearchTabs" class="baseTemplateSearch"><?
					?>
					<div id="advancedTemplateSearchID" class="templateTabContent">
						<?
						$searchTemplateInclude = true;
						$template_id = $_GET["template_id"];
						include(LISTING_EDIRECTORY_ROOT."/search_template.php");
						?>
					</div>
					<?
				?></fieldset><?
			} else {
				unset($listingTemplates);
				$dbObjLT = db_getDBObject();
				$sqlLT = "SELECT id FROM ListingTemplate WHERE status = 'enabled' ORDER BY title";
				$resultLT = $dbObjLT->query($sqlLT);
				while ($rowLT = mysql_fetch_assoc($resultLT)) {
					$listingTemplates[] = new ListingTemplate($rowLT["id"]);
				}
				if ($listingTemplates) {
					$iLT = 0;
					?><fieldset id="templateSearchTabs" class="baseTemplateSearch"><?
						foreach ($listingTemplates as $each_listingTemplate) {
							if (!$iLT) echo "<label class=\"altLabel\">".system_showText(LANG_SEARCH_LABELBROWSE).":</label>";
							?><span class="templateSearchTab" id="templateActiveID<?=$each_listingTemplate->getNumber("id");?>"><a href="javascript:void(0);" onclick="showAdvancedTemplateSearch('<?=$each_listingTemplate->getNumber("id");?>', '<?=EDIRECTORY_FOLDER.str_replace(NON_SECURE_URL, "", LISTING_DEFAULT_URL);?>');"><?=$each_listingTemplate->getString("title");?></a></span><?
							$iLT++;
						}
						?><div id="advancedTemplateSearchID" class="templateTabContent isHidden"></div><?
					?></fieldset><?
				}
			}
		}
	}
	?>
