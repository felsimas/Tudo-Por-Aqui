<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/views/view_contact.php
	# ----------------------------------------------------------------------------------------------------

?>

<table cellpadding="2" cellspacing="0" class="table-contact">
	<tr class="tr-contact">
		<td align="right" class="td-contact">
			<div class="label-contact">
				<?=system_showText(LANG_SITEMGR_LABEL_NAME)?>:
			</div>
		</td>
		<td align="left" class="td-contact">
			<span class="label-field-contact">
				<? echo $contact->getString("last_name").", ".$contact->getString("first_name"); ?>
			</span>
		</td>
	</tr>
	<tr class="tr-contact">
		<td align="right" class="td-contact">
			<div class="label-contact">
				<?=system_showText(LANG_SITEMGR_LABEL_COMPANY)?>:
			</div>
		</td>
		<td align="left" class="td-account">
			<span class="label-field-contact">
				<? echo $contact->getString("company"); ?>
			</span>
		</td>
	</tr>
	<tr class="tr-contact">
		<td align="right" class="td-contact">
			<div class="label-contact">
				<?=system_showText(LANG_SITEMGR_LABEL_ADDRESS)?>:
			</div>
		</td>
		<td align="left" class="td-account">
			<span class="label-field-contact">
				<?
				if ($contact->getString("address")) {
					echo $contact->getString("address");
					if ($contact->getString("address2")) {
						echo " (".$contact->getString("address2").")";
					}
				}
				?>
			</span>
		</td>
	</tr>
	<tr class="tr-contact">
		<td align="right" class="td-contact">
			<div class="label-contact">
				<?=system_showText(LANG_SITEMGR_LABEL_STATE)?> / <?=system_showText(LANG_SITEMGR_LABEL_CITY)?> / <?=ucwords(ZIPCODE_LABEL)?>:
			</div>
		</td>
		<td align="left" class="td-account">
			<span class="label-field-contact">
				<?
				echo $contact->getString("state").", ".$contact->getString("city").", ".$contact->getString("zip");
				?>
			</span>
		</td>
	</tr>
	<tr class="tr-contact">
		<td align="right" class="td-contact">
			<div class="label-contact">
				<?=system_showText(LANG_SITEMGR_LABEL_COUNTRY)?>:
			</div>
		</td>
		<td align="left" class="td-account">
			<span class="label-field-contact">
				<?
				echo $contact->getString("country");
				?>
			</span>
		</td>
	</tr>
	<tr class="tr-contact">
		<td align="right" class="td-contact">
			<div class="label-contact">
				<?=system_showText(LANG_SITEMGR_LABEL_PHONE)?>:
			</div>
		</td>
		<td align="left" class="td-account">
			<span class="label-field-contact">
				<?
				echo $contact->getString("phone")."<strong> / ".system_showText(LANG_SITEMGR_LABEL_FAX).":</strong> ".$contact->getString("fax");
				?>
			</span>
		</td>
	</tr>
	<tr class="tr-contact">
		<td align="right" class="td-contact">
			<div class="label-contact">
				<?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>:
			</div>
		</td>
		<td align="left" class="td-account">
			<span class="label-field-contact">
				<?=$contact->getString("email")?>
			</span>
		</td>
	</tr>
	<tr class="tr-contact">
		<td align="right" class="td-contact">
			<div class="label-contact">
				<?=system_showText(LANG_SITEMGR_LABEL_URL)?>:
			</div>
		</td>
		<td align="left" class="td-account">
			<span class="label-field-contact">
				<?=$contact->getString("url")?>
			</span>
		</td>
	</tr>
</table>