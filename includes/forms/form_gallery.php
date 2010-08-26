<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_gallery.php
	# ----------------------------------------------------------------------------------------------------
?>

<script language="javascript" type="text/javascript" src="<?=DEFAULT_URL?>/scripts/common.js"></script>

<script language="javascript" type="text/javascript">
	function JS_submit() {
		document.gallery.submit();
	}
</script>

<? // Account Search Javascript /////////////////////////////////////////////////////// ?>
<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/accountsearch.js"></script>
<? //////////////////////////////////////////////////////////////////////////////////// ?>

<div class="response-msg notice ui-corner-all"><span>* <?=system_showText(LANG_LABEL_REQUIRED_FIELD)?> </span></div>
<?
if ($message_gallery) { 
	echo "<div class=\"response-msg error ui-corner-all\"><span>";
	echo $message_gallery;
	echo "</span></div>";
}
?>

<? // Account Search ////////////////////////////////////////////////////////////////// ?>
<? if (!$membros && !$item_id) { ?>



	<?
	$acct_search_table_title = system_showText(LANG_SITEMGR_ACCOUNTSEARCH_SELECT)." ".system_showText(LANG_SITEMGR_SEARCH);
	$acct_search_field_name = "account_id";
	$acct_search_field_value = $account_id;
	$acct_search_required_mark = false;
	$acct_search_form_width = "95%";
	$acct_search_cell_width = "";
	$return = system_generateAjaxAccountSearch($acct_search_table_title, $acct_search_field_name, $acct_search_field_value, $acct_search_required_mark, $acct_search_form_width, $acct_search_cell_width);
	echo $return;
	?>

<? } ?>
<? //////////////////////////////////////////////////////////////////////////////////// ?>

<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
	<tr>
		<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_LABEL_INFORMATION);?></th>
	</tr>
	<tr>
		<th class="wrap">* <?=system_showText(LANG_GALLERY_TITLE);?>:</th>
		<td><input type="text" name="title" value="<?=$title?>" maxlength="100" /></td>
	</tr>
</table>