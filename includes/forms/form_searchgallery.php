<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_searchgallery.php
	# ----------------------------------------------------------------------------------------------------

?>

<? // Account Search Javascript /////////////////////////////////////////////////////////////////////// ?>
<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/accountsearch.js"></script>
<? //////////////////////////////////////////////////////////////////////////////////////////////////// ?>

<? if ($message_searchgallery) { ?>
	<div class="response-msg error ui-corner-all"><?=$message_searchgallery?></div>
<? } ?>

<? // Account Search ////////////////////////////////////////////////////////////////////////////////// ?>
<?
if (!$user) {
	$acct_search_table_title = system_showText(LANG_SITEMGR_ACCOUNTSEARCH_SELECT)." ".system_showText(LANG_SITEMGR_SEARCH);
	$acct_search_field_name  = "search_account_id";
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
		<td><input type="checkbox" value="1" name="search_no_owner" <?=($search_no_owner==1) ? "checked" : "";?> class="inputAlign" /><?=system_showText(LANG_SITEMGR_ACCOUNTSEARCH_NOOWNER)?><span><?=system_showText(LANG_SITEMGR_ACCOUNTSEARCH_NOOWNER_INFO)?></span></td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_SITEMGR_GALLERY_GALLERYTITLE)?>:</th>
		<td><input type="text" name="search_title" value="<?=$search_title?>" class="input-form-searchgallery" /></td>
	</tr>
	<tr>
		<th></th>
		<td style="display:none">
			<input type="radio" name="search_section" value="listing" <? echo "checked"; ?> class="inputAlign" /> <?=ucwords(system_showText(LANG_SITEMGR_LISTING))?>

		</td>
	</tr>
</table>
