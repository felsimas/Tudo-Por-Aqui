<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_bannersettings.php
	# ----------------------------------------------------------------------------------------------------

?>

<? // Banner Javascript /////////////////////////////////////////////////////// ?>
<script language="javascript" src="<?=DEFAULT_URL?>/scripts/banner.js"></script>
<? ///////////////////////////////////////////////////////////////////////////// ?>

<script>
	function toogleTrans(obj) {
		if (obj.checked == true) {
			document.getElementById("trans_form").style.display = 'block';
		} else {
			document.getElementById("trans_form").style.display = 'none';
		}
	}
	function emptyDate(obj) {
		if (obj.value == "00/00/0000") {
			return true;
		} else {
			return false;
		}
	}
</script>

<div id="header-form"><?=ucwords(system_showText(LANG_SITEMGR_MODIFY))?> <?=system_showText(LANG_SITEMGR_BANNER_SING)?> <?=ucwords(system_showText(LANG_SITEMGR_MENU_SETTINGS))?> - <?=$bannerObj->getString("caption")?></div>

<? if ($message_bannersettings) { ?>
	<div class="response-msg error ui-corner-all"><?=$message_bannersettings?></div>
<? } ?>

<? if ($bannerObj->needToCheckOut()) { ?>
	<div class="response-msg notice ui-corner-all"><?=system_showText(LANG_SITEMGR_UNPAIDITEM)?></div>
<? } ?>

<table cellpadding="0" cellspacing="0" class="table-form table-form-settings table-form-margin">

	<? if (!$bannerObj->hasRenewalDate()) { ?>
		<input type="hidden" name="hasrenewaldate" value="no" />
	<? } ?>
	<? if (!$bannerObj->hasImpressions()) { ?>
		<input type="hidden" name="hasimpressions" value="no" />
	<? } ?>

	<tr class="tr-form">
		<td align="right" class="td-title-form"><input type="radio" name="expiration_setting" id="expiration_setting" value="<?=BANNER_EXPIRATION_IMPRESSION?>" <?=(($bannerObj->getString("expiration_setting") == BANNER_EXPIRATION_IMPRESSION) ? "checked" : "" )?> onclick="bannerDisableRenewalDate()" class="inputCheck" /></td>
		<td align="right" class="td-title-form"><?=system_showText(LANG_SITEMGR_IMPRESSIONS)?>:</td>
		<td align="left" class="td-form">
			<input type="text" name="impressions" id="impressions" value="<?=$bannerObj->getString("impressions");?>" maxlength="6" <?=((!$bannerObj->getString("expiration_setting") || $bannerObj->getString("expiration_setting") != BANNER_EXPIRATION_IMPRESSION) ? "disabled=true" : "")?> class="input-form-settings" />
			<span class="warning"><?=system_showText(LANG_SITEMGR_UNPAID)?> <?=system_showText(LANG_SITEMGR_IMPRESSIONS)?>: <?=$bannerObj->getString("unpaid_impressions");?></span>
		</td>
	</tr>

	<tr class="tr-form">
		<td align="right" class="td-title-form"><input type="radio" name="expiration_setting" id="expiration_setting" value="<?=BANNER_EXPIRATION_RENEWAL_DATE?>" <?=((!$bannerObj->getString("expiration_setting") || $bannerObj->getString("expiration_setting") == BANNER_EXPIRATION_RENEWAL_DATE) ? "checked" : "" )?> onclick="bannerDisableImpressions()" class="inputCheck" /></td>
		<td align="right" class="td-title-form"><?=system_showText(LANG_SITEMGR_RENEWALDATE)?>:</td>
		<td align="left" class="td-form">
			<input type="text" name="renewal_date" id="renewal_date" value="<?=$bannerObj->getDate("renewal_date")?>"  <?=(($bannerObj->getString("expiration_setting") && $bannerObj->getString("expiration_setting") != BANNER_EXPIRATION_RENEWAL_DATE) ? "disabled=true" : "" )?> class="input-form-settings" />
			<a href="javascript:void(0);" onclick="if (emptyDate(document.getElementById('renewal_date'))) { document.getElementById('renewal_date').value=''; } cal_renewal_date.popup()" title="<?=system_showText(LANG_SITEMGR_CLICKHERETOSELECTRENEWALDATE)?>"><img src="<?=DEFAULT_URL?>/images/calendar/cal.gif" alt="<?=system_showText(LANG_SITEMGR_LABEL_CALENDAR)?>" title="<?=system_showText(LANG_SITEMGR_CLICKHERETOSELECTRENEWALDATE)?>" border="0" class="iconAlign" /></a>
			<?
			//Pre-fill the renewal_date based upon the term purchased for each module
			$bannerObj->renewal_date = $bannerObj->getNextRenewalDate();
			$renewal_date = $bannerObj->getDate("renewal_date");
			?>
			&nbsp;<a href="javascript:void(0);" title="auto-fill renewal date" onclick="document.forms['banner'].elements['renewal_date'].value='<?=$renewal_date; ?>'"><?=system_showText(LANG_SITEMGR_RENEWALDATE_AUTOFILL)?></a>
			<span>(<?=format_printDateStandard()?>)</span>
		</td>
	</tr>

	<tr class="tr-form">
		<td align="right" class="td-title-form"></td>
		<td align="right" class="td-title-form"><?=system_showText(LANG_SITEMGR_STATUS)?>:</td>
		<td align="left" class="td-form"><?=$statusDropDown?>
		</td>
	</tr>

</table>

	<? if ($bannerObj->getString("account_id")) { ?>

		<table cellpadding="0" cellspacing="0" class="table-form table-form-settings">
			<tr class="tr-form">
				<td align="right" class="td-title-form"><div class="label-form"><input type="checkbox" name="email_notification" id="email_notification" <?=(($_POST["email_notification"] == "1" || !isset($_POST["email_notification"])) ? "checked=\"checked\"" : "" );?> value="1" class="inputCheck" /></div></td>
				<td align="left" class="td-form"><?=system_showText(LANG_SITEMGR_SETTING_SENDNOTIFICATION)?></td>
			</tr>
		</table>

		<? if (PAYMENT_FEATURE == "on") { ?>
			<? if (MANUALPAYMENT_FEATURE == "on") { ?>

				<table cellpadding="0" cellspacing="0" class="table-form table-form-settings">
					<tr class="tr-form">
						<td align="right" class="td-title-form">&nbsp;</td>
						<td align="right" class="td-title-form">
							<div class="label-form">
								<input type="checkbox" name="add_transaction" id="add_transaction" <?=(($_POST["add_transaction"] == "1") ? "checked=\"checked\"" : "" )?> value="1" onclick="toogleTrans(this)" class="inputCheck" />
							</div>
						</td>
						<td align="left" class="td-form">
							<div class="label-form"><?=system_showText(LANG_SITEMGR_SETTING_ADDTRANSACTIONRECORD)?></div>
						</td>
					</tr>
				</table>

				<div id="trans_form" class="base-table-form-account" style="display: <?=(($_POST["add_transaction"] == "1") ? "block" : "none" )?>;">
					<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/accountsearch.js"></script>
					<?
					$acct_search_table_title = system_showText(LANG_SITEMGR_ACCOUNTSEARCH_SELECT)." ".system_showText(LANG_SITEMGR_BANNER_SING);
					$acct_search_field_name = "account_id";
					$acct_search_field_value = $account_id;
					$acct_search_required_mark = false;
					$acct_search_form_width = "95%";
					$acct_search_cell_width = "";
					$return = system_generateAjaxAccountSearch($acct_search_table_title, $acct_search_field_name, $acct_search_field_value, $acct_search_required_mark, $acct_search_form_width, $acct_search_cell_width);
					echo $return;
					?>
					<table cellpadding="0" cellspacing="0" class="table-form table-form-settings">
						<tr>
							<td align="right" class="td-title-form">
								<div class="label-form"><?=system_showText(LANG_SITEMGR_LABEL_AMOUNT)?>: </div>
							</td>
							<td align="left" class="td-form">
								<input type="text" name="amount" id="amount" value="<?=$_POST["amount"]?>" class="input-form-settings" />
							</td>
						</tr>
						<tr class="tr-form">
							<td align="right" class="td-title-form">
								<div class="label-form">
									<?=system_showText(LANG_SITEMGR_LABEL_NOTES)?>:
								</div>
							</td>
							<td align="left" class="td-form">
								<textarea class="input-textarea-form-settings" name="notes" id="notes" value="1" cols="50" rows="5"><?=$_POST["notes"]?></textarea>
							</td>
						</tr>
					</table>
				</div>

			<? } ?>
		<? } ?>

	<? } ?>
