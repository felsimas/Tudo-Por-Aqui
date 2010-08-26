<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_searchpromotion.php
	# ----------------------------------------------------------------------------------------------------

?>

<?  // Account Search Javascript /////////////////////////////////////////////////////// ?>

<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/accountsearch.js"></script>

<?  //////////////////////////////////////////////////////////////////////////////////// ?>

<? if ($message_searchpromotion) { ?>
	<div id="warning" class="errorMessage">
		<?=$message_searchpromotion?>
	</div>
<? } ?>

<?  // Account Search //////////////////////////////////////////////////////////////////
if (!$user) {
	$acct_search_table_title = system_showText(LANG_SITEMGR_ACCOUNTSEARCH_SELECT_DEFAULT);
	$acct_search_field_name = "search_account_id";
	$acct_search_field_value = $search_account_id;
	$acct_search_required_mark = false;
	$acct_search_form_width = "95%";
	$acct_search_cell_width = "";
	$return = system_generateAjaxAccountSearch($acct_search_table_title, $acct_search_field_name, $acct_search_field_value, $acct_search_required_mark, $acct_search_form_width, $acct_search_cell_width);
	echo $return;
}
//////////////////////////////////////////////////////////////////////////////////////// ?>

<table border="0" cellpadding="2" cellspacing="2" class="standard-table" style="margin-top: 15px;">
	<tr>
		<th>&nbsp;</th>
		<td><input type="checkbox" value="1" name="search_no_owner" <?=($search_no_owner==1) ? "checked" : "";?> class="inputAlign" /><?=system_showText(LANG_SITEMGR_ACCOUNTSEARCH_NOOWNER)?><span><?=system_showText(LANG_SITEMGR_ACCOUNTSEARCH_NOOWNER_INFO)?></span></td>
	</tr>
	<tr>
		<th>
			<?=system_showText(LANG_SITEMGR_PROMOTION_PROMOTIONNAME)?>:
		</th>
		<td>
			<input type="text" name="search_name" value="<?=$search_name?>" class="input-form-searchaccount" />
		</td>
	</tr>
</table>