<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_searchclaim.php
	# ----------------------------------------------------------------------------------------------------

?>

<? // Account Search Javascript /////////////////////////////////////////////////////////////////////// ?>
<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/accountsearch.js"></script>
<? //////////////////////////////////////////////////////////////////////////////////////////////////// ?>

<? if ($message_searchclaim) { ?>
	<div class="response-msg error ui-corner-all"><?=$message_searchclaim?></div>
<? } ?>

<? // Account Search ////////////////////////////////////////////////////////////////////////////////// ?>
<?
if (!$user) {
	$acct_search_table_title = system_showText(LANG_SITEMGR_ACCOUNTSEARCH_SELECT)." ".system_showText(LANG_SITEMGR_CLAIM).".";
	$acct_search_field_name = "search_account_id";
	$acct_search_field_value = $search_account_id;
	$acct_search_required_mark = false;
	$acct_search_form_width = "96%";
	$acct_search_cell_width = "";
	$return = system_generateAjaxAccountSearch($acct_search_table_title, $acct_search_field_name, $acct_search_field_value, $acct_search_required_mark, $acct_search_form_width,$acct_search_cell_width);
	echo $return;
}
?>
<? //////////////////////////////////////////////////////////////////////////////////////////////////// ?>

<table border="0" cellpadding="2" cellspacing="2" class="standard-table" style="margin-top: 20px;">

	<tr>
		<th>&nbsp;</th>
		<td><input type="checkbox" value="1" name="search_no_owner" <?=($search_no_owner==1) ? "checked" : "";?> class="inputAlign" /><?=system_showText(LANG_SITEMGR_NOOWNER)?><span><?=system_showText(LANG_SITEMGR_ACCOUNTSEARCH_NOOWNER_INFO)?></span></td>	</tr>

	<tr>
		<th><?=ucwords(system_showText(LANG_SITEMGR_CLAIM))?> <?=system_showText(LANG_SITEMGR_ID)?>:</th>
		<td><input type="text" name="search_id" value="<?=$search_id?>" class="input-form-searchlisting" /></td>
	</tr>

	<tr>
		<th><?=ucwords(system_showText(LANG_SITEMGR_LISTING))?> <?=system_showText(LANG_SITEMGR_TITLE)?>:</th>
		<td><input type="text" name="search_title" value="<?=$search_title?>" class="input-form-searchlisting" /></td>
	</tr>

	<tr>
		<th>Status:</th>
		<td>
			<table style="width: auto;" cellpadding="0" cellspacing="0">
				<tr>
					<td class="td-checkbox"><input type="radio" name="search_status" value="progress" <? if ($search_status == "progress") echo "checked"; ?> class="inputCheck" /></td>
					<td><span class="label-field-form"><?=system_showText(LANG_SITEMGR_CLAIM_STATUS_PROGRESS)?></span></td>
					<td class="td-checkbox"><input type="radio" name="search_status" value="incomplete" <? if ($search_status == "incomplete") echo "checked"; ?> class="inputCheck" /></td>
					<td><span class="label-field-form"><?=system_showText(LANG_SITEMGR_CLAIM_STATUS_INCOMPLETE)?></span></td>
					<td class="td-checkbox"><input type="radio" name="search_status" value="complete" <? if ($search_status == "complete") echo "checked"; ?> class="inputCheck" /></td>
					<td><span class="label-field-form"><?=system_showText(LANG_SITEMGR_CLAIM_STATUS_COMPLETE)?></span></td>
					<td class="td-checkbox"><input type="radio" name="search_status" value="approved" <? if ($search_status == "approved") echo "checked"; ?> class="inputCheck" /></td>
					<td><span class="label-field-form"><?=system_showText(LANG_SITEMGR_CLAIM_STATUS_APPROVED)?></span></td>
					<td class="td-checkbox"><input type="radio" name="search_status" value="denied" <? if ($search_status == "denied") echo "checked"; ?> class="inputCheck" /></td>
					<td><span class="label-field-form"><?=system_showText(LANG_SITEMGR_CLAIM_STATUS_DENIED)?></span></td>
				</tr>
			</table>
		</td>
	</tr>

</table>
