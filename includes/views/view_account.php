<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/views/view_account.php
	# ----------------------------------------------------------------------------------------------------

?>

<table cellpadding="2" cellspacing="0" class="table-account">
	<tr class="tr-account">
		<td align="right" class="td-account">
			<div class="label-account">
				<?=system_showText(LANG_SITEMGR_LABEL_USERNAME)?>:
			</div>
		</td>
		<td align="left" class="td-account">
			<span class="label-field-account">
				<?=system_showAccountUserName($account->getString("username"));?>
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
				<?=format_dateFromDB($account->getNumber("entered"), DEFAULT_DATE_FORMAT." h:ia")?>
			</span>
		</td>
	</tr>
	<tr class="tr-account">
		<td align="right" class="td-account">
			<div class="label-account">
				<?=system_showText(LANG_SITEMGR_LASTLOGIN)?>:
			</div>
		</td>
		<td align="left" class="td-account">
			<span class="label-field-account">
				<?
				if ($account->getNumber("lastlogin") != 0) {
					echo format_dateFromDB($account->getNumber("lastlogin"), DEFAULT_DATE_FORMAT." h:ia");
				} else echo system_showText(LANG_SITEMGR_ACCOUNT_NEWACCOUNT);
				?>
			</span>
		</td>
	</tr>
</table>
