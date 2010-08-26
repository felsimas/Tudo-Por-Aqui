<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_searchbanner.php
	# ----------------------------------------------------------------------------------------------------

?>

<?  // Account Search Javascript /////////////////////////////////////////////////////// ?>

<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/accountsearch.js"></script>

<?  //////////////////////////////////////////////////////////////////////////////////// ?>

<?  // Banner Javascript /////////////////////////////////////////////////////////////// ?>

<script language="javascript" src="<?=DEFAULT_URL?>/scripts/banner.js"></script>

<? if ($message_searchbanner) { ?>
	<div id="warning" class="errorMessage">
		<?=$message_searchbanner?>
	</div>
<? } ?>
<?  // Account Search //////////////////////////////////////////////////////////////////
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
//////////////////////////////////////////////////////////////////////////////////////// ?>

<table border="0" cellpadding="2" cellspacing="0" class="standard-table" style="margin-top: 15px;">
	<tr>
		<th>&nbsp;</th>
		<td><input type="checkbox" value="1" name="search_no_owner" <?=($search_no_owner==1) ? "checked" : "";?> class="inputAlign" /><?=system_showText(LANG_SITEMGR_NOOWNER)?><span><?=system_showText(LANG_SITEMGR_ACCOUNTSEARCH_NOOWNER_INFO)?></span></td>
	</tr>
	<tr>
			<th><?=system_showText(LANG_SITEMGR_LABEL_SECTION)?>:</th><? /* SECTION */ ?>
			<td nowrap>

				<input type="radio" name="search_section" value="general" <? if ($search_section == "general") echo "checked"; ?> onclick="fillBannerCategorySelect('<?=DEFAULT_URL?>', this.form.search_category, this.value, this.form);" class="inputAlign" /> <?=system_showText(LANG_SITEMGR_LABEL_GENERALPAGES)?> 

				<input type="radio" name="search_section" value="listing" <? if ($search_section == "listing") echo "checked"; ?> onclick="fillBannerCategorySelect('<?=DEFAULT_URL?>', this.form.search_category, this.value, this.form);" class="inputAlign" /> <?=ucwords(system_showText(LANG_SITEMGR_LISTING))?>

		</td>
		</tr>
	<tr>
	<? // ================== CATEGORY ==========================?>
	<tr>
		<th><?=ucwords(system_showText(LANG_SITEMGR_CATEGORY))?>:</th>
		<td>
			<?=$categoryDropDown?>
		</td>
	</tr>
		<th>
			<?=system_showText(LANG_SITEMGR_LABEL_CAPTION)?>:
		</th>
		<td>
			<input type="text" name="search_caption" value="<?=$search_caption?>" class='input-dd-form-searchbanner' />
		</td>
	</tr>
	<? if (!$user) { ?>
	<tr>
		<th><?=system_showText(LANG_SITEMGR_LABEL_TYPE)?>: </th>
		<td>
			<?=$typeDropDown?>
		</td>
	</tr>
	<? } ?>
	<tr>
		<th>
			<?=system_showText(LANG_SITEMGR_STATUS)?>:
		</th>
		<td>
			<?=$statusDropDown?>
		</td>
	</tr>
	<tr>
		<th class="alignTop"><?=system_showText(LANG_SITEMGR_LABEL_EXPIRATION)?>:</th>
		<td>
		<input type="text" name="search_expiration_date" value="<?=$search_expiration_date?>" style="width:80px;" maxlength="10" /><a href="javascript:void(0);" onclick="cal_expiration_date.popup()" title="<?=system_showText(LANG_SITEMGR_CLICKHERETOSELECTEXPIRATIONDATE)?>"><img src="<?=DEFAULT_URL?>/images/calendar/cal.gif" alt="<?=system_showText(LANG_SITEMGR_LABEL_CALENDAR)?>" title="<?=system_showText(LANG_SITEMGR_LABEL_CALENDAR)?>" border="0" class="iconAlign" /></a>
		&nbsp;
		<input type="radio" name="search_opt_expiration_date" value="1" class="inputCheck" <?php if (!isset($search_opt_expiration_date) || intval($search_opt_expiration_date) == 1) { echo "checked"; } ?> />
		&nbsp; <?=system_showText(LANG_SITEMGR_LABEL_EXPIRATION_OPT1)?>&nbsp; <?=system_showText(LANG_SITEMGR_LABEL_OR)?> &nbsp;
		<input type="radio" name="search_opt_expiration_date" value="2" class="inputCheck" <?php if (intval($search_opt_expiration_date) == 2) { echo "checked"; } ?> />
		&nbsp;
		<?=system_showText(LANG_SITEMGR_LABEL_EXPIRATION_OPT2)?>
		<span>(<?=format_printDateStandard()?>)</span>
		</td>
	</tr>
	<tr>
		<th><?=ucwords(LANG_LABEL_DISCOUNTCODE)?>:</th>
		<td><input type="text" name="search_discount" value="<?=$search_discount?>" maxlength="10" class="input-form-searchbanner" /></td>
	</tr>
	
</table>
