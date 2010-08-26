<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/views/view_account.php
	# ----------------------------------------------------------------------------------------------------

?>

<div id="header-view">
			<?=system_showText(LANG_SITEMGR_SMACCOUNT_ACCOUNTINFORMATION)?>
		</div>

		<br class="clear" />
		<div style="text-align:left; padding-left:20px">
		
<table cellpadding="2" cellspacing="0" class="table-account">
	<tr class="tr-account">
		<td align="right" class="td-account">
			<div class="label-account">
				<?=system_showText(LANG_SITEMGR_LABEL_USERNAME)?>:
			</div>
		</td>
		<td align="left" class="td-account">
			<span class="label-field-account">
				<?=$account->getString("username")?>
			</span>
		</td>
	</tr>
	<tr class="tr-account">
		<td align="right" class="td-account">
			<div class="label-account">
				<?=system_showText(LANG_SITEMGR_LASTUPDATED)?>:
			</div>
		</td>
		<td align="left" class="td-account">
			<span class="label-field-account">
				<?=format_dateFromDB($account->getNumber("updated"), DEFAULT_DATE_FORMAT." h:ia")?>
			</span>
		</td>
	</tr>
	<tr class="tr-account">
		<td align="right" class="td-account">
			<div class="label-account">
				<?=system_showText(LANG_SITEMGR_DATECREATED)?>:
			</div>
		</td>
		<td align="left" class="td-account">
			<span class="label-field-account">
				<?=(($account->getString("entered") != "0000-00-00 00:00:00") ? (format_date($account->getString("entered"), DEFAULT_DATE_FORMAT." h:ia", "datetime")) : ("---"))?>
			</span>
		</td>
	</tr>
</table>
</div>
<div id="header-view">
			<?=system_showText(LANG_SITEMGR_SMACCOUNT_ACCOUNTCONTACTINFORMATION)?>
		</div>

		<br class="clear" />
		<div style="text-align:left; padding-left:20px">

<table cellpadding="2" cellspacing="0" class="table-account">
	<tr class="tr-account">
		<td align="right" class="td-account">
			<div class="label-account">
				<?=system_showText(LANG_SITEMGR_LABEL_NAME)?>:
			</div>
		</td>
		<td align="left" class="td-account">
			<span class="label-field-account">
				<?=$account->getNumber("name")?>
			</span>
		</td>
	</tr>
	<tr class="tr-account">
		<td align="right" class="td-account">
			<div class="label-account">
				<?=system_showText(LANG_SITEMGR_LABEL_PHONE)?>:
			</div>
		</td>
		<td align="left" class="td-account">
			<span class="label-field-account">
				<?=$account->getNumber("phone")?>
			</span>
		</td>
	</tr>
	<tr class="tr-account">
		<td align="right" class="td-account">
			<div class="label-account">
				<?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>:
			</div>
		</td>
		<td align="left" class="td-account">
			<span class="label-field-account">
				<?=$account->getNumber("email")?>
			</span>
		</td>
	</tr>
</table>
</div>