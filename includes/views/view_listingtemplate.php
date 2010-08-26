<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/views/view_listingtemplate.php
	# ----------------------------------------------------------------------------------------------------

	$templateFields = $listingTemplate->getListingTemplateFields();
	if($templateFields){
	?>

	<div id="header-view"><?=ucwords(system_showText(LANG_SITEMGR_LISTINGTEMPLATE))?></div>
	<table cellpadding="2" cellspacing="0" class="table-table">
		<tr class="th-table">
			<td class="td-th-table">
				<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_LABEL)?>
			</td>
			<td class="td-th-table">
				<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_TOOLTIP)?>
			</td>
			<td class="td-th-table">
				<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_TYPE)?>
			</td>
		</tr>
		<? foreach ($templateFields as $each_field) { ?>
			<tr class="tr-account">
				<td align="left">
					<div class="label-field-account">
						<?=$each_field["label"]?>
					</div>
				</td>
				<td align="left" class="td-account">
					<span class="label-field-account">
						<?=$each_field["instructions"]?>&nbsp;
					</span>
				</td>
				<td align="left" class="td-account">
					<span class="label-field-account">
						<?
						if ($each_field["field"] != "address2") $fieldType = ereg_replace("[0-9]", "", $each_field["field"]);
						else $fieldType = $each_field["field"];
						switch ($fieldType) {
							case "custom_text"       : echo "Text";              break;
							case "custom_short_desc" : echo "Short Description"; break;
							case "custom_long_desc"  : echo "Long Description";  break;
							case "custom_checkbox"   : echo "Checkbox";          break;
							case "custom_dropdown"   : echo "Dropdown";          break;
							case "title"             : echo "Title";             break;
							case "address"           : echo "Address Line1";     break;
							case "address2"          : echo "Address Line2";     break;
						}
						?>
					</span>
				</td>
			</tr>
		<? } ?>
	</table>

	<?
	}
?>
