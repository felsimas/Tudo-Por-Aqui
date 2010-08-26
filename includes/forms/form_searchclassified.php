<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_searchclassified.php
	# ----------------------------------------------------------------------------------------------------

?>

<? // Account Search Javascript /////////////////////////////////////////////////////////////////////// ?>
<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/accountsearch.js"></script>
<? //////////////////////////////////////////////////////////////////////////////////////////////////// ?>

<? if ($message_searchclassified) { ?>
	<div id="warning" class="errorMessage">
		<?=$message_searchclassified?>
	</div>
<? } ?>

<? // Account Search ////////////////////////////////////////////////////////////////////////////////// ?>
<?
if (!$user) {
	$acct_search_table_title = system_showText(LANG_SITEMGR_ACCOUNTSEARCH_SELECT)." ".system_showText(LANG_SITEMGR_SEARCH);
	$acct_search_field_name = "search_account_id";
	$acct_search_field_value = $search_account_id;
	$acct_search_required_mark = false;
	$acct_search_form_width = "95%";
	$acct_search_cell_width = "";
	$return = system_generateAjaxAccountSearch($acct_search_table_title, $acct_search_field_name, $acct_search_field_value, $acct_search_required_mark, $acct_search_form_width, $acct_search_cell_width);
	echo $return;
}
?>
<? //////////////////////////////////////////////////////////////////////////////////////////////////// ?>

<table border="0" cellpadding="2" cellspacing="0" class="standard-table" style="margin-top: 15px;">
	<tr>
		<th>&nbsp;</th>
		<td><input type="checkbox" value="1" name="search_no_owner" <?=($search_no_owner==1) ? "checked" : "";?> class="inputAlign" /><?=system_showText(LANG_SITEMGR_NOOWNER)?><span><?=system_showText(LANG_SITEMGR_ACCOUNTSEARCH_NOOWNER_INFO)?></span></td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_SITEMGR_CLASSIFIED_CLASSIFIEDTITLE)?>:</th>
		<td><input type="text" name="search_title" value="<?=$search_title?>" class="input-form-searchclassifieds" /></td>
	</tr>

	<tr>
		<th><?=system_showText(LANG_SITEMGR_CLASSIFIED_CLASSIFIEDLEVEL)?>:</th>
		<td>
			<table>
				<tr>
					<?
					$level = new ClassifiedLevel();
					$levelvalues = $level->getLevelValues();
					foreach ($levelvalues as $levelvalue) {
						?>
						<td class="td-checkbox"><input type="radio" name="search_level" value="<?=$levelvalue?>" <? if ($search_level == $levelvalue) echo "checked"; ?> class="inputCheck" /></td>
						<td><span class="label-field-form"><?=$level->showLevel($levelvalue)?></span></td>
						<?
					}
					?>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<th><?=ucwords(system_showText(LANG_SITEMGR_CATEGORY))?>:</th>
		<td><?=$categoryDropDown?></td>
	</tr>

	<tr>
		<th><?=system_showText(LANG_SITEMGR_LABEL_COUNTRY)?>:</th>
		<td>
			<select name="search_country" id="search_country" OnChange="fillSelectSearchPage('<?=DEFAULT_URL?>', this.form.search_state, this.value, this.form);">
				<option value=""><?=system_showText(LANG_LABEL_SELECT_COUNTRY)?></option>
				<?
				if ($countries) foreach ($countries as $each_country) {
					$selected = ($search_country == $each_country["id"]) ? "selected" : "";
					?><option <?=$selected?> value="<?=$each_country["id"]?>"><?=$each_country["name"]?></option><?
					unset($selected);
				}
				?>
			</select>
		</td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_SITEMGR_LABEL_STATE)?>:</th>
		<td>
			<select name="search_state" id="search_state" OnChange="fillSelectSearchPage('<?=DEFAULT_URL?>', this.form.search_region, this.value, this.form);">
				<option value=""><?=system_showText(LANG_LABEL_SELECT_STATE)?></option>
				<?
				if ($selected_states) foreach ($selected_states as $each_state) {
					if ($selected_state) $selected = ($selected_state->getString("id") == $each_state["id"]) ? "selected" : "";
					?><option <?=$selected?> value="<?=$each_state["id"];?>"><?=$each_state["name"];?></option>
				<?
					unset($selected);
				}
				?>
			</select>
		</td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_SITEMGR_LABEL_CITY)?>:</th>
		<td>
			<select name="search_region" id="search_region">
				<option value=""><?=system_showText(LANG_LABEL_SELECT_CITY)?></option>
				<?
				if ($selected_regions) foreach ($selected_regions as $each_region) {
					if ($selected_region) $selected = ($selected_region->getString("id") == $each_region["id"]) ? "selected" : "";
					?><option <?=$selected?> value="<?=$each_region["id"];?>"><?=$each_region["name"];?></option><?
					unset($selected);
				}
				?>
			</select>
		</td>
	</tr>
	<tr>
		<th><?=ucwords(ZIPCODE_LABEL)?>:</th>
		<td><input type="text" name="search_zipcode" value="<?=$search_zipcode?>" maxlength="10" class="input-form-searchclassifieds" /></td>
	</tr>

	<? if (!$user) { ?>
		<tr>
			<th><?=system_showText(LANG_SITEMGR_STATUS)?>:</th>
			<td><?=$statusDropDown?></td>
		</tr>
	<? } ?>

		<tr>
			<th class="alignTop"><?=system_showText(LANG_SITEMGR_LABEL_EXPIRATION)?>: </th>
			<td>
			<input type="text" name="search_expiration_date" value="<?=$search_expiration_date?>" style="width:80px;" maxlength="10" /><a href="javascript:void(0);" onclick="cal_expiration_date.popup()" title="<?=system_showText(LANG_SITEMGR_CLICKHERETOSELECTEXPIRATIONDATE)?>"><img src="<?=DEFAULT_URL?>/images/calendar/cal.gif" alt="<?=system_showText(LANG_SITEMGR_LABEL_CALENDAR)?>" title="<?=system_showText(LANG_SITEMGR_LABEL_CALENDAR)?>" border="0" class="iconAlign" /></a>
			&nbsp;
			<input type="radio" name="search_opt_expiration_date" value="1" class="inputCheck" <?php if (!isset($search_opt_expiration_date) || intval($search_opt_expiration_date) == 1) { echo "checked"; } ?> />
			&nbsp;<?=system_showText(LANG_SITEMGR_LABEL_EXPIRATION_OPT1)?>&nbsp; <?=system_showText(LANG_SITEMGR_LABEL_OR)?> &nbsp;
			<input type="radio" name="search_opt_expiration_date" value="2" class="inputCheck" <?php if (intval($search_opt_expiration_date) == 2) { echo "checked"; } ?> />
			&nbsp;
			<?=system_showText(LANG_SITEMGR_LABEL_EXPIRATION_OPT2)?>
			<span>(<?=format_printDateStandard()?>)</span>
			</td>
		</tr>
	<tr>
		<th><?=ucwords(LANG_LABEL_DISCOUNTCODE)?>:</th>
		<td><input type="text" name="search_discount" value="<?=$search_discount?>" maxlength="10" class="input-form-searchclassifieds" /></td>
	</tr>
	
</table>
