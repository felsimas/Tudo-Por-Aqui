<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_searchtransaction.php
	# ----------------------------------------------------------------------------------------------------

?>

<?  // Account Search Javascript /////////////////////////////////////////////////////// ?>

<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/accountsearch.js"></script>

<?  //////////////////////////////////////////////////////////////////////////////////// ?>

<? if ($message_searchtransaction) { ?>
	<div id="warning" class="errorMessage">
		<?=$message_searchtransaction?>
	</div>
<? } ?>

<?  // Account Search ////////////////////////////////////////////////////////////////// ?>
<? if (!$membros) { 
	$acct_search_table_title = system_showText(LANG_SITEMGR_ACCOUNTSEARCH_SELECT_DEFAULT);
	$acct_search_field_name = "search_account_id";
	$acct_search_field_value = $search_account_id;
	$acct_search_required_mark = false;
	$acct_search_form_width = "95%";
	$acct_search_cell_width = "";
	$return = system_generateAjaxAccountSearch($acct_search_table_title, $acct_search_field_name, $acct_search_field_value, $acct_search_required_mark, $acct_search_form_width, $acct_search_cell_width);
	echo $return;
} ?>
<?  //////////////////////////////////////////////////////////////////////////////////// ?>

<table border="0" cellpadding="2" cellspacing="0" class="standard-table" style="margin-top: 0;">

	<tr>
		<th>
			<?=system_showText(LANG_SITEMGR_LABEL_TRANSACTIONID)?>:
		</td>
		<td>
			<input type="text" name="search_id" value="<?=$search_id?>" class="input-form-searchaccount" />
		</td>
	</tr>

	<tr>
		<th>
			<?=system_showText(LANG_SITEMGR_LABEL_PAYMENTSYSTEM)?>:
		</td>
		<td>
			<?=$systemsDropDown; ?>
		</td>
	</tr>

	<tr>
		<th><?=system_showText(LANG_SITEMGR_LABEL_AMOUNTRANGE)?>: </th>
		<td>
		&nbsp;<?=strtolower(system_showText(LANG_SITEMGR_LABEL_FROM))?>:&nbsp;
		<input type="text" name="search_amount_range1" value="<? if ($search_amount_range1) echo format_money($search_amount_range1)?>" style="width:80px;" maxlength="10" />
		&nbsp;<?=strtolower(system_showText(LANG_SITEMGR_LABEL_TO))?>:&nbsp;
		<input type="text" name="search_amount_range2" value="<? if ($search_amount_range2) echo format_money($search_amount_range2)?>" style="width:80px;" maxlength="10" />
		</td>
	</tr>

	<tr>
		<th><?=system_showText(LANG_SITEMGR_LABEL_PAYMENTDATERANGE)?>: </th>
		<td>
		&nbsp;<?=strtolower(system_showText(LANG_SITEMGR_LABEL_FROM))?>:&nbsp;
		<input type="text" name="search_date_range1" value="<?=$search_date_range1?>" style="width:80px;" maxlength="10" /><a href="javascript:void(0);" onclick="cal_date_range1.popup()" title="<?=system_showText(LANG_SITEMGR_CLICKHERETOSELECTSTARTDATE)?>"><img src="<?=DEFAULT_URL?>/images/calendar/cal.gif" alt="<?=system_showText(LANG_SITEMGR_LABEL_CALENDAR)?>" title="<?=system_showText(LANG_SITEMGR_LABEL_CALENDAR)?>" border="0" class="iconAlign" /></a>
		&nbsp;<?=strtolower(system_showText(LANG_SITEMGR_LABEL_TO))?>:&nbsp;
		<input type="text" name="search_date_range2" value="<?=$search_date_range2?>" style="width:80px;" maxlength="10" /><a href="javascript:void(0);" onclick="cal_date_range2.popup()" title="<?=system_showText(LANG_SITEMGR_CLICKHERETOSELECTENDDATE)?>"><img src="<?=DEFAULT_URL?>/images/calendar/cal.gif" alt="<?=system_showText(LANG_SITEMGR_LABEL_CALENDAR)?>" title="<?=system_showText(LANG_SITEMGR_LABEL_CALENDAR)?>" border="0" class="iconAlign" /></a>
		&nbsp;(<?=format_printDateStandard()?>)
		</td>
	</tr>

</table>