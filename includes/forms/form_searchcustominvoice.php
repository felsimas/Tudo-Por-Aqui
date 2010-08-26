<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_searchcustominvoice.php
	# ----------------------------------------------------------------------------------------------------

?>

<?  // Account Search Javascript /////////////////////////////////////////////////////// ?>

<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/accountsearch.js"></script>

<?  //////////////////////////////////////////////////////////////////////////////////// ?>

<?  // Account Search //////////////////////////////////////////////////////////////////
if (!$user) {
	$acct_search_table_title = system_showText(LANG_SITEMGR_ACCOUNTSEARCH_SELECT)." ".system_showText(LANG_SITEMGR_CUSTOMINVOICE).".";
	$acct_search_field_name = "search_account_id";
	$acct_search_field_value = $search_account_id;
	$acct_search_required_mark = false;
	$acct_search_form_width = "95%";
	$acct_search_cell_width = "";
	$return = system_generateAjaxAccountSearch($acct_search_table_title, $acct_search_field_name, $acct_search_field_value, $acct_search_required_mark, $acct_search_form_width, $acct_search_cell_width);
	echo $return;
}
//////////////////////////////////////////////////////////////////////////////////////// ?>

<table border="0" cellpadding="2" cellspacing="2" class="standard-table" style="margin-top: 0;">
	<tr>
		<th>
			<?=system_showText(LANG_SITEMGR_TITLE)?>:
		</th>
		<td>
			<input type="text" name="search_title" value="<?=$search_title?>" maxlength="100" />
		</td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_SITEMGR_LABEL_DATERANGE)?>:</th>
		<td>
			<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td style="font-weight: bold; color: #295978; width: 30px;"><?=system_showText(LANG_SITEMGR_LABEL_FROM)?>:</td>
					<td style="width:120px"><input type="text" name="search_date_from" value="<?=$search_date_from?>" style="width:85px;" maxlength="10" /><a href="javascript:void(0);" onclick="cal_date_from.popup()" title="<?=system_showText(LANG_SITEMGR_CLICKHERETOSELECTSTARTDATE)?>"><img src="<?=DEFAULT_URL?>/images/calendar/cal.gif" alt="<?=system_showText(LANG_SITEMGR_LABEL_CALENDAR)?>" title="<?=system_showText(LANG_SITEMGR_LABEL_CALENDAR)?>" border="0" class="iconAlign" /></a></td>
					<td style="font-weight: bold; color: #295978; width: 20px;"><?=system_showText(LANG_SITEMGR_LABEL_TO)?>:</td>
					<td style="width:120px"><input type="text" name="search_date_to" value="<?=$search_date_to?>" style="width:85px;" maxlength="10" /><a href="javascript:void(0);" onclick="cal_date_to.popup()" title="<?=system_showText(LANG_SITEMGR_CLICKHERETOSELECTENDDATE)?>"><img src="<?=DEFAULT_URL?>/images/calendar/cal.gif" alt="<?=system_showText(LANG_SITEMGR_LABEL_CALENDAR)?>" title="<?=system_showText(LANG_SITEMGR_LABEL_CALENDAR)?>" border="0" class="iconAlign" /></a></td>
					<td style="width:100px" align="left">(<?=format_printDateStandard()?>)</td>
				</tr>
			</table>
		</td>
	</tr>
	<? if (!$user) { ?>
	<tr>
		<th><?=system_showText(LANG_SITEMGR_STATUS)?>:</th>
		<td>
			<table>
				<tr>
					<td class="radio">
						<input type="radio" name="search_status" value="paid" <?=($search_status == "paid") ? "checked" : ""?> class="inputCheck" />
					</td>
					<td>
							<?=system_showText(LANG_SITEMGR_CUSTOMINVOICE_PAID)?>
					</td>
					<td class="radio">
						<input type="radio" name="search_status" value="sent" <?=($search_status == "sent") ? "checked" : ""?> class="inputCheck" />
					</td>
					<td>
							<?=system_showText(LANG_SITEMGR_CUSTOMINVOICE_SENT)?>
					</td>
					<td class="radio">
						<input type="radio" name="search_status" value="pending" <?=($search_status == "pending") ? "checked" : ""?> class="inputCheck" />
					</td>
					<td>
							<?=system_showText(LANG_SITEMGR_CUSTOMINVOICE_NOTSENT)?>
					</td>						
				</tr>			
			</table>
		</td>		
	</tr>
	<? } ?>	
</table>

