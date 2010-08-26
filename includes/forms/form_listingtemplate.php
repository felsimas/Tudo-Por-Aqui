<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_listingtemplate.php
	# ----------------------------------------------------------------------------------------------------

?>

<br />

<? if ($message_listingtemplate) {?>
	<br /><br /><p class="errorMessage"><?=$message_listingtemplate?></p>
<? } ?>

<script language="javascript" type="text/javascript">
	function JS_addCategory(text, id) {
		seed = document.listingtemplate.seed;
		feed = document.listingtemplate.feed;
		var flag=true;
		for (i=0;i<feed.length;i++) if (feed.options[i].value==id) flag=false;
		if (text && id && flag) {
			feed.options[feed.length] = new Option(text, id);
			alert("<?=system_showText(LANG_LABEL_CATEGORY);?> '"+text+"' <?=system_showText(LANG_MSG_CATEGORY_SUCCESSFULLY_ADDED)?>");
		} else {
			if (!flag) alert("<?=system_showText(LANG_MSG_CATEGORY_ALREADY_INSERTED)?>");
			else alert("<?=system_showText(LANG_MSG_SELECT_VALID_CATEGORY)?>");
		}
	}
	function JS_removeCategory() {
		feed = document.listingtemplate.feed;
		if (feed.selectedIndex >= 0) feed.remove(feed.selectedIndex);
	}
	function JS_displayCategoryPath() {
		feed = document.listingtemplate.feed;
		if (feed.selectedIndex == -1) {
			alert("<?=system_showText(LANG_MSG_SELECT_CATEGORY_FIRST);?>");
		} else {
			var winl = (((screen.width) / 2) - 350);
			var wint = (((screen.height) / 2) - 150);
			var winprop = 'titlebar=no, toolbar=no, location=no, directories=no, status=no, width=700, height=150, left='+winl+', top='+wint+', menubar=no, scrollbars=yes, resizable=yes';
			window.open("../listing/category_detail.php?id="+feed.options[feed.selectedIndex].value, "popup", winprop);
		}
		return;
	}
	function JS_submit() {
		feed = document.listingtemplate.feed;
		return_categories = document.listingtemplate.return_categories;
		if (return_categories.value.length > 0) return_categories.value="";
		for (i=0;i<feed.length;i++) {
			if (!isNaN(feed.options[i].value)) {
				if (return_categories.value.length > 0) return_categories.value = return_categories.value + "," + feed.options[i].value;
				else return_categories.value = return_categories.value + feed.options[i].value;
			}
		}
		document.listingtemplate.submit();
	}
</script>

<table border="0" cellpadding="2" cellspacing="0" class="standard-table">

	<tr>
		<th colspan="2" class="standard-tabletitle"><?=ucwords(system_showText(LANG_SITEMGR_LISTINGTEMPLATE))?> - <?=system_showText(LANG_SITEMGR_INFORMATION)?></th>
	</tr>

	<tr>
		<th><?=system_showText(LANG_SITEMGR_TITLE)?>:</th>
		<td>
			<input type="text" name="title" value="<?=$title?>" maxlength="100" onBlur="easyFriendlyUrl(this.value, 'friendly_url', '<?=FRIENDLYURL_VALIDCHARS?>', '<?=FRIENDLYURL_SEPARATOR?>');" />
		</td>
	</tr>

	<tr>
		<th><?=system_showText(LANG_SITEMGR_LABEL_PAGENAME)?>:</th>
		<td>
			<input type="text" name="friendly_url" id="friendly_url" value="<?=$friendly_url?>" maxlength="150" onBlur="easyFriendlyUrl(this.value, 'friendly_url', '<?=FRIENDLYURL_VALIDCHARS?>', '<?=FRIENDLYURL_SEPARATOR?>');" />
		</td>
	</tr>

	<tr>
		<th><?=system_showText(LANG_SITEMGR_STATUS)?>:</th>
		<td>
			<table class="table-status">
				<tr>
					<td class="td-checkbox"><input type="radio" name="status" value="enabled" <? if ((!$status) || ($status == "enabled")) echo "checked"; ?> class="inputCheck" /></td>
					<td><span class="label-field-form"><?=system_showText(LANG_SITEMGR_LABEL_ENABLED)?></span></td>
					<td class="td-checkbox"><input type="radio" name="status" value="disabled" <? if ($status == "disabled") echo "checked"; ?> class="inputCheck" /></td>
					<td><span class="label-field-form"><?=system_showText(LANG_SITEMGR_LABEL_DISABLED)?></span></td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<th><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_ADDITIONALPRICE)?>:</th>
		<td>
			<input type="text" name="price" value="<?=$price?>" />
		</td>
	</tr>

</table>

<table border="0" cellpadding="2" cellspacing="0" class="standard-table">

	<tr>
		<th colspan="3" class="standard-tabletitle"><?=ucwords(system_showText(LANG_SITEMGR_LISTINGTEMPLATE))?> - <?=ucwords(system_showText(LANG_SITEMGR_LISTINGTEMPLATE_DETAILLAYOUT))?></th>
	</tr>

	<?
	$templateLayoutIDs = explode(",", TEMPLATE_LAYOUTIDS);
	$templateLayoutNames = explode(",", TEMPLATE_LAYOUTNAMES);
	$templateLayoutSamples = explode(",", TEMPLATE_LAYOUTSAMPLES);
	for ($i=0; $i<count($templateLayoutIDs); $i++) {
	?>
		<tr>
			<td style="text-align: right; width: 30px;"><input type="radio" name="layout_id" value="<?=$templateLayoutIDs[$i];?>" class="inputRadio" <? if (($templateLayoutIDs[$i] == $layout_id) || (!$i && !$layout_id)) { echo "checked"; } ?> /></td>
			<td style="width: 150px;"><img src="<?=DEFAULT_URL;?>/images/content/<?=$templateLayoutSamples[$i];?>" /></td>
			<td style="text-align: left;"><?=$templateLayoutNames[$i];?></td>
		</tr>
	<?
	}
	?>

</table>

<table border="0" cellpadding="2" cellspacing="0" class="standard-table">

	<tr>
		<th colspan="4" class="standard-tabletitle"><?=ucwords(system_showText(LANG_SITEMGR_LISTINGTEMPLATE))?> - <?=ucwords(system_showText(LANG_SITEMGR_LISTINGTEMPLATE_COLORS))?> <span><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_RGBSPAN)?></span></th>
	</tr>

	<tr>
		<th><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_BACKGROUND)?>:</th>
		<td>
			#<input type="text" name="color_background" value="<?=$color_background?>" />
		</td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_BORDER)?>:</th>
		<td>
			#<input type="text" name="color_border" value="<?=$color_border?>" />
		</td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_LABEL)?>:</th>
		<td>
			#<input type="text" name="color_label" value="<?=$color_label?>" />
		</td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_TEXT)?>:</th>
		<td>
			#<input type="text" name="color_text" value="<?=$color_text?>" />
		</td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_TITLEBACKGROUND)?>:</th>
		<td>
			#<input type="text" name="color_titlebackground" value="<?=$color_titlebackground?>" />
		</td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_TITLEBORDER)?>:</th>
		<td>
			#<input type="text" name="color_titleborder" value="<?=$color_titleborder?>" />
		</td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_TITLETEXT)?>:</th>
		<td>
			#<input type="text" name="color_titletext" value="<?=$color_titletext?>" />
		</td>
	</tr>

</table>

<table border="0" cellpadding="2" cellspacing="0" class="standard-table">

	<tr>
		<th colspan="4" class="standard-tabletitle wrap"><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_SELECTCATEGORIES)?>&nbsp;<span>(<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_CATEGORYTIP)?>)</span></th>
	</tr>

	<input type="hidden" name="return_categories" value="">
	<tr>
		<td colspan="2" class="treeView">
			<ul id="listing_categorytree_id_0" class="categoryTreeview">&nbsp;</ul>
			<table width="100%" border="0" cellpadding="2" class="tableCategoriesADDED" cellspacing="0">
				<tr>
					<th colspan="2" class="tableCategoriesTITLE alignLeft"><strong><?=ucfirst(system_showText(LANG_SITEMGR_CATEGORIES))?>:</strong></th>
				</tr>
				<tr>
					<td colspan="2" class="tableCategoriesCONTENT"><?=$feedDropDown?></td>
				</tr>
				<tr>
					<td class="tableCategoriesBUTTONS" colspan="2">
						<center>
							<button type="button" value="<?=system_showText(LANG_BUTTON_VIEWCATEGORYPATH)?>" onclick="JS_displayCategoryPath();"><?=system_showText(LANG_BUTTON_VIEWCATEGORYPATH)?></button>
							<button type="button" value="<?=system_showText(LANG_BUTTON_REMOVESELECTEDCATEGORY)?>" onclick="JS_removeCategory();"><?=system_showText(LANG_BUTTON_REMOVESELECTEDCATEGORY)?></button>
						</center>
					</td>
				</tr>
			</table>
		</td>
	</tr>

</table>

<table border="0" cellpadding="2" cellspacing="0" class="standard-table">

	<tr>
		<th colspan="4" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_COMMONFIELDS)?></th>
	</tr>

	<tr>
		<th class="extraFieldsLabel">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_FIELD)?>
		</th>
		<th class="extraFieldsLabel">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_LABEL)?>
		</th>
		<th class="extraFieldsLabel">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_TOOLTIP)?>
		</th>
	</tr>

	<tr>
		<td class="extraFieldsShort">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_LISTINGTITLE)?>
		</td>
		<td>
			<input type="text" name="label[title]" value="<?=$label["title"]?>" class="commonFieldExplode" />
		</td>
		<td>
			<input type="text" name="instructions[title]" value="<?=$instructions["title"]?>" class="commonFieldExplode" />
		</td>
	</tr>

	<tr>
		<td class="extraFieldsShort">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_ADDRESSLINE1)?>
		</td>
		<td>
			<input type="text" name="label[address]" value="<?=$label["address"]?>" class="commonFieldExplode" />
		</td>
		<td>
			<input type="text" name="instructions[address]" value="<?=$instructions["address"]?>" class="commonFieldExplode" />
		</td>
	</tr>

	<tr>
		<td class="extraFieldsShort">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_ADDRESSLINE2)?>
		</td>
		<td>
			<input type="text" name="label[address2]" value="<?=$label["address2"]?>" class="commonFieldExplode" />
		</td>
		<td>
			<input type="text" name="instructions[address2]" value="<?=$instructions["address2"]?>" class="commonFieldExplode" />
		</td>
	</tr>

</table>

<script language="javascript" type="text/javascript">
	<!--

	function checkboxLabelChanging(pos) {
		if (document.getElementById('custom_checkbox' + (pos+1))) {
			document.getElementById('custom_checkbox' + (pos+1)).className = "isVisible";
		}
	}

	function dropdownLabelChanging(pos) {
		if (document.getElementById('custom_dropdown' + (pos+1))) {
			document.getElementById('custom_dropdown' + (pos+1)).className = "isVisible";
		}
	}

	function textLabelChanging(pos) {
		if (document.getElementById('custom_text' + (pos+1))) {
			document.getElementById('custom_text' + (pos+1)).className = "isVisible";
		}
	}

	function shortdescLabelChanging(pos) {
		if (document.getElementById('custom_short_desc' + (pos+1))) {
			document.getElementById('custom_short_desc' + (pos+1)).className = "isVisible";
		}
	}

	function longdescLabelChanging(pos) {
		if (document.getElementById('custom_long_desc' + (pos+1))) {
			document.getElementById('custom_long_desc' + (pos+1)).className = "isVisible";
		}
	}

	//-->
</script>

<?
$count_customcheckbox = 0;
$count_customdropdown = 0;
$count_customtext = 0;
$count_customshortdesc = 0;
$count_customlongdesc = 0;
$dbObjCustom = db_getDBObJect();
$sqlCustom = "DESC Listing";
$resultCustom = $dbObjCustom->query($sqlCustom);
while ($rowCustom = mysql_fetch_assoc($resultCustom)) {
	if (strpos($rowCustom["Field"], "custom_checkbox") !== false) {
		$count_customcheckbox++;
	} elseif (strpos($rowCustom["Field"], "custom_dropdown") !== false) {
		$count_customdropdown++;
	} elseif (strpos($rowCustom["Field"], "custom_text") !== false) {
		$count_customtext++;
	} elseif (strpos($rowCustom["Field"], "custom_short_desc") !== false) {
		$count_customshortdesc++;
	} elseif (strpos($rowCustom["Field"], "custom_long_desc") !== false) {
		$count_customlongdesc++;
	}
}
?>

<table border="0" cellpadding="2" cellspacing="0" class="standard-table">

	<tr>
		<th colspan="3" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_EXTRACHECKBOXFIELDS)?></th>
	</tr>

	<tr>
		<th class="extraFieldsLabel">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_LABEL)?>
		</th>
		<th class="extraFieldsLabel">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_TOOLTIP)?>
		</th>
		<th class="extraFieldsLabel extraFieldsShort">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_SEARCH)?>
		</th>
	</tr>

	<?
	$showextrafield = 0;
	for ($i=0; $i<$count_customcheckbox; $i++) {
		?>
		<tr id="custom_checkbox<?=$i?>"
		<?
		if ($label["custom_checkbox$i"]) {
			echo "class=\"isVisible\"";
			$showextrafield = $i+1;
		} elseif ($i == $showextrafield) {
			echo "class=\"isVisible\"";
		} else {
			echo "class=\"isHidden\"";
		}
		?>
		>
			<td>
				<input type="text" name="label[custom_checkbox<?=$i?>]" value="<?=$label["custom_checkbox$i"]?>" onKeyDown="checkboxLabelChanging(<?=$i?>)" class="extraCheckboxExplode" />
			</td>
			<td>
				<input type="text" name="instructions[custom_checkbox<?=$i?>]" value="<?=$instructions["custom_checkbox$i"]?>" class="extraCheckboxExplode" />
			</td>
			<td class="alignCenter extraFieldsShort">
				<input type="checkbox" name="search[custom_checkbox<?=$i?>]" value="y" <?=($search["custom_checkbox$i"]=="y") ? "checked" : ""?> class="inputRadio" />
			</td>
		</tr>
		<?
	}
	?>
	
</table>

<table border="0" cellpadding="2" cellspacing="0" class="standard-table">

	<tr>
		<th colspan="5" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_EXTRADROPDOWNFIELDS)?></th>
	</tr>

	<tr>
		<th class="extraFieldsLabel">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_LABEL)?>
		</th>
		<th class="extraFieldsLabel">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_VALUES)?>
		</th>
		<th class="extraFieldsLabel">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_TOOLTIP)?>
		</th>
		<th class="extraFieldsLabel extraFieldsShort">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_REQUIRED)?>
		</th>
		<th class="extraFieldsLabel extraFieldsShort">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_SEARCH)?>
		</th>
	</tr>

	<?
	$showextrafield = 0;
	for ($i=0; $i<$count_customdropdown; $i++) {
		?>
		<tr id="custom_dropdown<?=$i?>"
		<?
		if ($label["custom_dropdown$i"]) {
			echo "class=\"isVisible\"";
			$showextrafield = $i+1;
		} elseif ($i == $showextrafield) {
			echo "class=\"isVisible\"";
		} else {
			echo "class=\"isHidden\"";
		}
		?>
		>
			<td>
				<input type="text" name="label[custom_dropdown<?=$i?>]" value="<?=$label["custom_dropdown$i"]?>" onKeyDown="dropdownLabelChanging(<?=$i?>)" class="extraFieldExplode" style="width: 160px;" />
			</td>
			<td>
				<textarea name="fieldvalues[custom_dropdown<?=$i?>]" style="width: 160px;"><?=$fieldvalues["custom_dropdown$i"]?></textarea>
			</td>
			<td>
				<input type="text" name="instructions[custom_dropdown<?=$i?>]" value="<?=$instructions["custom_dropdown$i"]?>" class="extraFieldExplode" style="width: 160px;" />
			</td>
			<td class="alignCenter extraFieldsShort">
				<input type="checkbox" name="required[custom_dropdown<?=$i?>]" value="y" <?=($required["custom_dropdown$i"]=="y") ? "checked" : ""?> class="inputRadio" />
			</td>
			<td class="alignCenter extraFieldsShort">
				<input type="checkbox" name="search[custom_dropdown<?=$i?>]" value="y" <?=($search["custom_dropdown$i"]=="y") ? "checked" : ""?> class="inputRadio" />
			</td>
		</tr>
		<?
	}
	?>

</table>

<table border="0" cellpadding="2" cellspacing="0" class="standard-table">

	<tr>
		<th colspan="5" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_EXTRATEXTFIELDS)?></th>
	</tr>

	<tr>
		<th class="extraFieldsLabel">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_LABEL)?>
		</th>
		<th class="extraFieldsLabel">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_TOOLTIP)?>
		</th>
		<th class="extraFieldsLabel extraFieldsShort">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_REQUIRED)?>
		</th>
		<th class="extraFieldsLabel extraFieldsShort wrap">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_SEARCHBYKEYWORD)?>
		</th>
		<th class="extraFieldsLabel extraFieldsShort wrap">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_SEARCHBYRANGE)?>
		</th>
	</tr>

	<?
	$showextrafield = 0;
	for ($i=0; $i<$count_customtext; $i++) {
		?>
		<tr id="custom_text<?=$i?>"
		<?
		if ($label["custom_text$i"]) {
			echo "class=\"isVisible\"";
			$showextrafield = $i+1;
		} elseif ($i == $showextrafield) {
			echo "class=\"isVisible\"";
		} else {
			echo "class=\"isHidden\"";
		}
		?>
		>
			<td>
				<input type="text" name="label[custom_text<?=$i?>]" value="<?=$label["custom_text$i"]?>" onKeyDown="textLabelChanging(<?=$i?>)" class="extraFieldExplode" />
			</td>
			<td>
				<input type="text" name="instructions[custom_text<?=$i?>]" value="<?=$instructions["custom_text$i"]?>" class="extraFieldExplode" />
			</td>
			<td class="alignCenter extraFieldsShort">
				<input type="checkbox" name="required[custom_text<?=$i?>]" value="y" <?=($required["custom_text$i"]=="y") ? "checked" : ""?> class="inputRadio" />
			</td>
			<td class="alignCenter extraFieldsShort">
				<input type="checkbox" name="searchbykeyword[custom_text<?=$i?>]" value="y" <?=($searchbykeyword["custom_text$i"]=="y") ? "checked" : ""?> class="inputRadio" />
			</td>
			<td class="alignCenter extraFieldsShort">
				<input type="checkbox" name="searchbyrange[custom_text<?=$i?>]" value="y" <?=($searchbyrange["custom_text$i"]=="y") ? "checked" : ""?> class="inputRadio" />
			</td>
		</tr>
		<?
	}
	?>

</table>

<table border="0" cellpadding="2" cellspacing="0" class="standard-table">

	<tr>
		<th colspan="4" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_EXTRASHORTDESCRIPTIONFIELDS)?></th>
	</tr>

	<tr>
		<th class="extraFieldsLabel">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_LABEL)?>
		</th>
		<th class="extraFieldsLabel">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_TOOLTIP)?>
		</th>
		<th class="extraFieldsLabel extraFieldsShort">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_REQUIRED)?>
		</th>
		<th class="extraFieldsLabel extraFieldsShort">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_SEARCHBYKEYWORD)?>
		</th>
	</tr>

	<?
	$showextrafield = 0;
	for ($i=0; $i<$count_customshortdesc; $i++) {
		?>
		<tr id="custom_short_desc<?=$i?>"
		<?
		if ($label["custom_short_desc$i"]) {
			echo "class=\"isVisible\"";
			$showextrafield = $i+1;
		} elseif ($i == $showextrafield) {
			echo "class=\"isVisible\"";
		} else {
			echo "class=\"isHidden\"";
		}
		?>
		>
			<td>
				<input type="text" name="label[custom_short_desc<?=$i?>]" value="<?=$label["custom_short_desc$i"]?>" onKeyDown="shortdescLabelChanging(<?=$i?>)" class="extraFieldExplode" />
			</td>
			<td>
				<input type="text" name="instructions[custom_short_desc<?=$i?>]" value="<?=$instructions["custom_short_desc$i"]?>" class="extraFieldExplode" />
			</td>
			<td class="alignCenter extraFieldsShort">
				<input type="checkbox" name="required[custom_short_desc<?=$i?>]" value="y" <?=($required["custom_short_desc$i"]=="y") ? "checked" : ""?> class="inputRadio" />
			</td>
			<td class="alignCenter extraFieldsShort">
				<input type="checkbox" name="searchbykeyword[custom_short_desc<?=$i?>]" value="y" <?=($searchbykeyword["custom_short_desc$i"]=="y") ? "checked" : ""?> class="inputRadio" />
			</td>
		</tr>
		<?
	}
	?>

</table>

<table border="0" cellpadding="2" cellspacing="0" class="standard-table">

	<tr>
		<th colspan="4" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_EXTRALONGDESCRIPTIONFIELDS)?></th>
	</tr>

	<tr>
		<th class="extraFieldsLabel">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_LABEL)?>
		</th>
		<th class="extraFieldsLabel">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_TOOLTIP)?>
		</th>
		<th class="extraFieldsLabel extraFieldsShort">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_REQUIRED)?>
		</th>
		<th class="extraFieldsLabel extraFieldsShort">
			<?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_SEARCHBYKEYWORD)?>
		</th>
	</tr>

	<?
	$showextrafield = 0;
	for ($i=0; $i<$count_customlongdesc; $i++) {
		?>
		<tr id="custom_long_desc<?=$i?>"
		<?
		if ($label["custom_long_desc$i"]) {
			echo "class=\"isVisible\"";
			$showextrafield = $i+1;
		} elseif ($i == $showextrafield) {
			echo "class=\"isVisible\"";
		} else {
			echo "class=\"isHidden\"";
		}
		?>
		>
			<td>
				<input type="text" name="label[custom_long_desc<?=$i?>]" value="<?=$label["custom_long_desc$i"]?>" onKeyDown="longdescLabelChanging(<?=$i?>)" class="extraFieldExplode" />
			</td>
			<td>
				<input type="text" name="instructions[custom_long_desc<?=$i?>]" value="<?=$instructions["custom_long_desc$i"]?>" class="extraFieldExplode" />
			</td>
			<td class="alignCenter extraFieldsShort">
				<input type="checkbox" name="required[custom_long_desc<?=$i?>]" value="y" <?=($required["custom_long_desc$i"]=="y") ? "checked" : ""?> class="inputRadio" />
			</td>
			<td class="alignCenter extraFieldsShort">
				<input type="checkbox" name="searchbykeyword[custom_long_desc<?=$i?>]" value="y" <?=($searchbykeyword["custom_long_desc$i"]=="y") ? "checked" : ""?> class="inputRadio" />
			</td>
		</tr>
		<?
	}
	?>

</table>

<script language="javascript" type="text/javascript" src="<?=DEFAULT_URL?>/scripts/categorytree.js"></script>
<script language="javascript" type="text/javascript">
	loadCategoryTree('main', 'listing_', 'ListingCategory', 0, 0, '<?=EDIRECTORY_FOLDER?>');
</script>
