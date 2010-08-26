<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /listing/search_template.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (LISTINGTEMPLATE_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	if (!$searchTemplateInclude) {
		header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", FALSE);
		header("Pragma: no-cache");
		header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);
	}

	$dbObjLT = db_getDBObject();
	$sqlLT = "SELECT id FROM ListingTemplate WHERE id = ".db_formatNumber($_GET["template_id"])." AND status = 'enabled' ORDER BY title";
	$resultLT = $dbObjLT->query($sqlLT);
	if ($rowLT = mysql_fetch_assoc($resultLT)) {
		$listingTemplate = new ListingTemplate($rowLT["id"]);
		$listingTemplateFields = $listingTemplate->getListingTemplateFields();
		if ($listingTemplateFields) {
			echo "<span class=\"clear\"></span>";
			$lineBreak = false;
			foreach ($listingTemplateFields as $each_listingTemplateField) {
				if ((strpos($each_listingTemplateField["field"], "custom_checkbox") !== false) && ($each_listingTemplateField["search"] == "y")) {
					$lineBreak = true;
					?>
					<div class="templateCheckbox">
						<input type="checkbox" name="<?=str_replace("custom_", "", $each_listingTemplateField["field"]);?>" value="y" class="inputAuto" />
						<label><?=$each_listingTemplateField["label"];?></label>
					</div>
					<?
				} elseif ((strpos($each_listingTemplateField["field"], "custom_dropdown") !== false) && ($each_listingTemplateField["search"] == "y")) {
					$lineBreak = true;
					?>
					<div class="templateDropdown">
						<select name="<?=str_replace("custom_", "", $each_listingTemplateField["field"]);?>">
							<option value=""><?=$each_listingTemplateField["label"];?></option>
							<?
							$auxfieldvalues = explode(",", $each_listingTemplateField["fieldvalues"]);
							foreach ($auxfieldvalues as $fieldvalue) {
								?><option value="<?=$fieldvalue;?>"><?=$fieldvalue;?></option><?
							}
							?>
						</select>
					</div>
					<?
				} elseif (strpos($each_listingTemplateField["field"], "custom_text") !== false) {
					if ($each_listingTemplateField["searchbykeyword"] == "y") {
						if ($lineBreak) {
							echo "<span class=\"clear\"></span>";
							$lineBreak = false;
						}
						?>
						<div class="templateText">
							<label><?=$each_listingTemplateField["label"];?>:</label>
							<input type="text" name="<?=str_replace("custom_", "", $each_listingTemplateField["field"]);?>" value="" />
						</div>
						<?
					} elseif ($each_listingTemplateField["searchbyrange"] == "y") {
						if ($lineBreak) {
							echo "<span class=\"clear\"></span>";
							$lineBreak = false;
						}
						?>
						<div class="templateRange">
							<label><?=$each_listingTemplateField["label"];?>:</label>
							<?=system_showText(LANG_SEARCH_LABELFROM)?> <input type="text" name="from<?=str_replace("custom_", "", $each_listingTemplateField["field"]);?>" value="" />
							<?=system_showText(LANG_SEARCH_LABELTO)?> <input type="text" name="to<?=str_replace("custom_", "", $each_listingTemplateField["field"]);?>" value="" />
						</div>
						<?
					}
				} elseif ((strpos($each_listingTemplateField["field"], "custom_short_desc") !== false) && ($each_listingTemplateField["searchbykeyword"] == "y")) {
					if ($lineBreak) {
						echo "<span class=\"clear\"></span>";
						$lineBreak = false;
					}
					?>
					<div class="templateDescription">
						<label><?=$each_listingTemplateField["label"];?>:</label>
						<input type="text" name="<?=str_replace("custom_", "", $each_listingTemplateField["field"]);?>" value="" />
					</div>
					<?
				} elseif ((strpos($each_listingTemplateField["field"], "custom_long_desc") !== false) && ($each_listingTemplateField["searchbykeyword"] == "y")) {
					if ($lineBreak) {
						echo "<span class=\"clear\"></span>";
						$lineBreak = false;
					}
					?>
					<div class="templateLongDescription">
						<label><?=$each_listingTemplateField["label"];?>:</label>
						<input type="text" name="<?=str_replace("custom_", "", $each_listingTemplateField["field"]);?>" value="" />
					</div>
					<?
				}
			}
			?><span class="clear"></span><?
		}
	}

?>
