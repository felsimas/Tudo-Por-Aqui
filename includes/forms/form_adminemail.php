<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_adminemail.php
	# ----------------------------------------------------------------------------------------------------

?>

<div id="header-form">
	<?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_ADMINISTRATOREMAIL)?>
</div>

<div class="response-msg inf ui-corner-all">
	<?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_THEASEEMAILSAREREQUIRED)?><br />
	<?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_PLEASESEPARATEWITHCOMMA)?>
</div>

<? if ($message_adminemail) { ?>
	<div id="warning" class="<?=$message_style?>">
		<?=$message_adminemail?>
	</div>
<? } ?>

<table border="0" cellpadding="2" cellspacing="2" class="standard-table">
	<tr>
		<th class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_GENERALEMAIL)?> <span><?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_GENERALEMAIL_SPAN)?></span></th>
	</tr>
</table>

<table cellpadding="2" cellspacing="0" border="0" class="table-form">
	<tr>
		<th class="table-formTitle"><?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_GENERALEMAIL)?>:</th>
	</tr>
	<tr>
		<td>
		
			<table cellpadding="2" cellspacing="0" border="0">
				<tr>
					<th>*<?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>:</th>
					<td><input type="text" name="sitemgr_email" value="<?=$sitemgr_email?>" /></td>
				</tr>
				<tr>
					<th><input type="checkbox" name="send_email" <?=$send_email_checked?> class="inputCheck" /></th>
					<td><?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_SENDNOTIFICATIONONTHISACCOUNT)?></td>
				</tr>
			</table>
			
		</td>
	</tr>
</table>

<table border="0" cellpadding="2" cellspacing="2" class="standard-table">
	<tr>
		<th class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_SPECIFICEMAIL)?> <span><?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_SPECIFICEMAIL_SPAN)?></span></th>
	</tr>
</table>

<table cellpadding="2" cellspacing="0" border="0" class="table-form">
	<tr>
		<th class="table-formTitle"><?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_LISTINGADDUPDATE)?></th>
	</tr>
	<tr>
		<td>
			<table cellpadding="2" cellspacing="0" border="0">
				<tr>
					<th><?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>:</th>
					<td>
						<input type="text" name="sitemgr_listing_email" value="<?=$sitemgr_listing_email?>" class="input-form-adminemail" style="width: 400px;" />
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<? if (EVENT_FEATURE == "on") { ?>
		<tr>
			<th class="table-formTitle"><?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_EVENTADDUPDATE)?></th>
		</tr>
		<tr>
			<td>
				<table cellpadding="2" cellspacing="0" border="0">
					<tr>
						<th><?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>:</th>
						<td><input type="text" name="sitemgr_event_email" value="<?=$sitemgr_event_email?>" class="input-form-adminemail" style="width: 400px;" /></td>
					</tr>
				</table>
			</td>
		</tr>
	<? } ?>
	<? if (BANNER_FEATURE == "on") { ?>
		<tr>
			<th class="table-formTitle"><b><?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_BANNERADDUPDATE)?></b></th>
		</tr>
		<tr>
			<td>
				<table cellpadding="2" cellspacing="0" border="0" >
					<tr>
						<th><?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>:</th>
						<td><input type="text" name="sitemgr_banner_email" value="<?=$sitemgr_banner_email?>" class="input-form-adminemail" style="width: 400px;" /></td>
					</tr>
				</table>
			</td>
		</tr>
	<? } ?>
	<? if (CLASSIFIED_FEATURE == "on") { ?>
		<tr>
			<th class="table-formTitle"><b><?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_CLASSIFIEDADDUPDATE)?></b></th>
		</tr>
		<tr>
			<td>
				<table cellpadding="2" cellspacing="0" border="0">
					<tr>
						<th><?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>:</th>
						<td><input type="text" name="sitemgr_classified_email" value="<?=$sitemgr_classified_email?>" class="input-form-adminemail" style="width: 400px;" /></td>
					</tr>
				</table>
			</td>
		</tr>
	<? } ?>
	<? if (ARTICLE_FEATURE == "on") { ?>
		<tr>
			<th class="table-formTitle"><b><?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_ARTICLEADDUPDATE)?></b></th>
		</tr>
		<tr>
			<td>
				<table cellpadding="2" cellspacing="0" border="0">
					<tr>
						<th><?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>:</th>
						<td><input type="text" name="sitemgr_article_email" value="<?=$sitemgr_article_email?>" class="input-form-adminemail" style="width: 400px;" /></td>
					</tr>
				</table>
			</td>
		</tr>
	<? } ?>
	<tr>
		<th class="table-formTitle"><b><?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_ACCOUNTADD)?></b></th>
	</tr>
	<tr>
		<td>
			<table cellpadding="2" cellspacing="0" border="0">
				<tr>
					<th><?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>:</th>
					<td><input type="text" name="sitemgr_account_email" value="<?=$sitemgr_account_email?>" class="input-form-adminemail" style="width: 400px;" /></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<th class="table-formTitle"><b><?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_CONTACTUS)?></b></th>
	</tr>
	<tr>
		<td>
			<table cellpadding="2" cellspacing="0" border="0">
				<tr>
					<th><?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>:</th>
					<td><input type="text" name="sitemgr_contactus_email" value="<?=$sitemgr_contactus_email?>" class="input-form-adminemail" style="width: 400px;" /></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<th class="table-formTitle"><b><?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_HELPSUPPORT)?></b></th>
	</tr>
	<tr>
		<td>
			<table cellpadding="2" cellspacing="0" border="0">
				<tr>
					<th><?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>:</th>
					<td><input type="text" name="sitemgr_support_email" value="<?=$sitemgr_support_email?>" class="input-form-adminemail" style="width: 400px;" /></td>
				</tr>
			</table>
		</td>
	</tr>
	<? if (PAYMENT_FEATURE == "on") { ?>
		<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
			<tr>
				<th class="table-formTitle"><b><?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_PAYMENTRECEIVED)?></b></th>
			</tr>
			<tr>
				<td>
					<table cellpadding="2" cellspacing="0">
						<tr>
							<th><?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>:</th>
							<td><input type="text" name="sitemgr_payment_email" value="<?=$sitemgr_payment_email?>" class="input-form-adminemail" style="width: 400px;" /></td>
						</tr>
					</table>
				</td>
			</tr>
		<? } ?>
	<? } ?>
	<tr>
		<th class="table-formTitle"><b><?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_REVIEWS)?></b></th>
	</tr>
	<tr>
		<td>
			<table cellpadding="2" cellspacing="0">
				<tr>
					<th><?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>:</th>
					<td><input type="text" name="sitemgr_rate_email" value="<?=$sitemgr_rate_email?>" class="input-form-adminemail" style="width: 400px;" /></td>
				</tr>
			</table>
		</td>
	</tr>
	<? if (CLAIM_FEATURE == "on") { ?>
		<tr>
			<th class="table-formTitle"><b><?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_CLAIMLISTING)?></b></th>
		</tr>
		<tr>
			<td>
				<table cellpadding="2" cellspacing="0">
					<tr>
						<th><?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>:</th>
						<td><input type="text" name="sitemgr_claim_email" value="<?=$sitemgr_claim_email?>" class="input-form-adminemail" style="width: 400px;" /></td>
					</tr>
				</table>
			</td>
		</tr>
	<? } ?>
</table>
