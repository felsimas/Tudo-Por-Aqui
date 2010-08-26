<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_invoiceinfo.php
	# ----------------------------------------------------------------------------------------------------

?>

<div id="header-form">
	<?=system_showText(LANG_SITEMGR_INVOICE_INVOICEINFO_DIRECTORYACCOUNTINFORMATION)?>
</div>

<? if ($message_invoiceinfo) { ?>
	<?=$message_invoiceinfo?>
<? } ?>

<table cellpadding="2" cellspacing="0" border="0" class="table-form">

	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_LABEL_COMPANYNAME)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="invoice_company" value="<?=$invoice_company?>" class="input-form-adminemail" />
		</td>
	</tr>

	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_LABEL_ADDRESS)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="invoice_address" value="<?=$invoice_address?>" class="input-form-adminemail" />
		</td>
	</tr>

	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_LABEL_CITY)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="invoice_city" value="<?=$invoice_city?>" class="input-form-adminemail" />
		</td>
	</tr>

	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_LABEL_SELECT_STATE)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="invoice_state" value="<?=$invoice_state?>" class="input-form-adminemail" />
		</td>
	</tr>

	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form"><?=system_showText(LANG_SITEMGR_LABEL_COUNTRY)?>:</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="invoice_country" value="<?=$invoice_country?>" class="input-form-adminemail" />
		</td>
	</tr>

	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=ucwords(ZIPCODE_LABEL)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="invoice_zipcode" value="<?=$invoice_zipcode?>" class="input-form-adminemail" />
		</td>
	</tr>

	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_LABEL_PHONE)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="invoice_phone" value="<?=$invoice_phone?>" class="input-form-adminemail" />
		</td>
	</tr>

	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_LABEL_FAX)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="invoice_fax" value="<?=$invoice_fax?>" class="input-form-adminemail" />
		</td>
	</tr>

	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="invoice_email" value="<?=$invoice_email?>" class="input-form-adminemail" />
		</td>
	</tr>
	
	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_LABEL_NOTES)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="invoice_notes" value="<?=$invoice_notes?>" class="input-form-adminemail" maxlength="250" />
		</td>
	</tr>

	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_LABEL_INVOICELOGO)?> <span style="font-size: 9px;">(<?=IMAGE_INVOICE_LOGO_WIDTH?>px x <?=IMAGE_INVOICE_LOGO_HEIGHT?>px):</span><br /><br />
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="file" name="image" class="input-form-adminemail" /><br /><span style="font-family: Verdana; font-size: 10px; color: #6A6A6A;"><?=system_showText(LANG_SITEMGR_MSGTRANSPARENTGIF)?>. <?=system_showText(LANG_SITEMGR_MSGMAXFILESIZE)?> <?=UPLOAD_MAX_SIZE;?> MB.</span>
			<input type="hidden" name="invoice_image" value="<?=$invoice_image?>" />
		</td>
	</tr>

	<tr class="tr-form">
		<td class="td-form" colspan="2">
			<?
			if ($invoice_image) {
				$imageObj = new Image($invoice_image);
				if ($imageObj->imageExists()) {
					echo $imageObj->getTag(true, IMAGE_INVOICE_LOGO_WIDTH, IMAGE_INVOICE_LOGO_HEIGHT, system_showText(LANG_SITEMGR_LABEL_INVOICELOGO));
				}
			}
			?>
		</td>
	</tr>

	<? if ($invoice_image) { ?>
		<tr class="tr-form">
			<td class="td-form" colspan="2">
				<center class="label-form"><input type="checkbox" name="remove_image" value="1" style="width: auto;" class="inputCheck" /><?=system_showText(LANG_SITEMGR_CHECKTOREMOVEIMAGE)?></center>
			</td>
		</tr>
	<? } ?>

</table>
