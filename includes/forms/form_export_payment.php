<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_export_payment.php
	# ----------------------------------------------------------------------------------------------------

	list($df_start_month, $df_start_day, $df_start_year) = split("/",date("m/d/Y", mktime(0 , 0, 0, date("m"), date("d"), date("Y")-1)));
?>

<? if ($message_export_payment) { ?>
	<div id="warning" class="errorMessage">
		<?=$message_export_payment?>
	</div>
<? } ?>

<?  // Account Search Javascript /////////////////////////////////////////////////////// ?>

<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/accountsearch.js"></script>

<?  // Account Search ////////////////////////////////////////////////////////////////// ?>

	<?
	$acct_search_table_title = system_showText(LANG_SITEMGR_ACCOUNTSEARCH_SELECT)." ".system_showText(LANG_SITEMGR_EXPORT);
	$acct_search_field_name = "account_id";
	$acct_search_field_value = $account_id;
	$acct_search_required_mark = false;
	$acct_search_form_width = "95%";
	$return = system_generateAjaxAccountSearch($acct_search_table_title, $acct_search_field_name, $acct_search_field_value, $acct_search_required_mark, $acct_search_form_width);
	echo $return;
	?>


<?  //////////////////////////////////////////////////////////////////////////////////// ?>
<table cellpadding="2" cellspacing="2" border="0" align="center" style="width: 520px; margin-top: 10px;" class="table-form">
	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form"><?=system_showText(LANG_SITEMGR_LABEL_STARTDATE)?>:</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="start_month" value="<?=($_POST["start_month"]) ? $_POST["start_month"] : $df_start_month?>" maxlength="2" style="width:25px" />/
			<input type="text" name="start_day" value="<?=($_POST["start_day"]) ? $_POST["start_day"] : $df_start_day?>" maxlength="2" style="width:25px" />/
			<input type="text" name="start_year" value="<?=($_POST["start_year"]) ? $_POST["start_year"] : $df_start_year?>" maxlength="4" style="width:35px" />
		</td>
	</tr>
	<tr>
		<td align="right" class="td-form">
			<div class="label-form"><?=system_showText(LANG_SITEMGR_LABEL_ENDDATE)?>:</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="end_month" value="<?=($_POST["end_month"]) ? $_POST["end_month"] : date("m")?>" maxlength="2" style="width:25px" />/
			<input type="text" name="end_day" value="<?=($_POST["end_day"]) ? $_POST["end_day"] : date("d")?>" maxlength="2" style="width:25px" />/
			<input type="text" name="end_year" value="<?=($_POST["end_year"]) ? $_POST["end_year"] : date("Y")?>" maxlength="4" style="width:35px" />
		</td>
	</tr>
	<tr>
		<td align="right"><div class="label-form"><?=system_showText(LANG_SITEMGR_EXPORT_RECORDTYPE)?>:</div></td>
		<td colspan=2 nowrap>
			<table cellpadding=0 cellspacing=0 border="0" align="left">
				<tr>
					<td align="right" class="td-form" width=10>
						<input type="radio" name="type" value="invoice" <?=$type_invoice?> class="inputCheck" />
					</td>
					<td nowrap><div class="label-form"><?=system_showText(LANG_SITEMGR_EXPORT_INVOICERECORDS)?></div></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td colspan=2 nowrap>
			<table cellpadding=0 cellspacing=0 border="0" align="left">
				<tr>
					<td align="left" class="td-form" width=10>
						<input type="radio" name="type" value="payment" <?=$type_online?> class="inputCheck" />
					</td>
					<td nowrap><div class="label-form"><?=system_showText(LANG_SITEMGR_EXPORT_TRANSACTIONRECORDS)?></div></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="right"><div class="label-form"><?=system_showText(LANG_SITEMGR_EXPORT_DELIMITER)?>:</div></td>
		<td colspan=2 nowrap>
			<table cellpadding=0 cellspacing=0 border="0" align="left">
				<tr>
					<td align="right" class="td-form" width=10>
						<input type="radio" name="delimiter" value="semicolon" class="inputCheck" />
					</td>
					<td nowrap><div class="label-form">[ ; ] - <?=system_showText(LANG_SITEMGR_EXPORT_SEMICOLON)?></div></td>
					<td align="right" class="td-form" width=10>
						<input type="radio" name="delimiter" value="comma" checked="checked" class="inputCheck" />
					</td>
					<td nowrap><div class="label-form">[ , ] - <?=system_showText(LANG_SITEMGR_EXPORT_COMMA)?></div></td>
				</tr>
			</table>
		</td>
	</tr>
</table>