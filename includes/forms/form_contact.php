
<table border="0" cellpadding="2" cellspacing="0" class="standard-table">
	<tr>
		<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_LABEL_CONTACT_INFORMATION);?> <span><?=system_showText(LANG_MSG_INFO_NOT_DISPLAYED);?></span></th>
	</tr>
	<? if(strlen(trim($message_contact))>0) {?>
	<tr>
		<td colspan="2" style="background: none;"><p class="errorMessage"><?=$message_contact?></p></td>
	</tr>
	<? } ?>
	<!-- <tr>
		<th>* <?=system_showText(LANG_LABEL_LANGUAGE);?>:</th>
		<td>
			<?=language_langOptions($lang);?>
			<span><?=system_showText(LANG_LABEL_LANGUAGETIP)?></span>
		</td>
	</tr> -->
	<tr>
		<th width="130px">* <?=system_showText(LANG_LABEL_FIRST_NAME);?>:</th>
		<td><input type="text" name="first_name" value="<?=$first_name?>" /></td>
	</tr>
	<tr>
		<th>* <?=system_showText(LANG_LABEL_LAST_NAME);?>:</th>
		<td><input type="text" name="last_name" value="<?=$last_name?>" /></td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_LABEL_COMPANY);?>:</th>
		<td><input type="text" name="company" value="<?=$company?>" /></td>
	</tr>
	<tr>
		<th valign="top"><?=system_showText(LANG_LABEL_ADDRESS1)?>:</th>
		<td><input type="text" name="address" value="<?=$address?>" maxlength="50" />
			<span><?=system_showText(LANG_ADDRESS_EXAMPLE)?></span>
		</td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_LABEL_ADDRESS2)?>:</th>
		<td><input type="text" name="address2" value="<?=$address2?>" maxlength="50" />
			<span><?=system_showText(LANG_ADDRESS2_EXAMPLE)?></span>
		</td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_LABEL_CITY)?>:</th>
		<td><input type="text" name="city" value="<?=$city?>" /></td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_LABEL_STATE)?>:</th>
		<td><input type="text" name="state" value="<?=$state?>" /></td>
	</tr>
	<tr>
		<th><?=ucwords(ZIPCODE_LABEL)?>:</th>
		<td><input type="text" name="zip" value="<?=$zip?>" /></td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_LABEL_COUNTRY)?>:</th>
		<td><input type="text" name="country" value="<?=$country?>" /></td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_LABEL_PHONE)?>:</th>
		<td><input type="text" name="phone" value="<?=$phone?>" /></td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_LABEL_FAX)?>:</th>
		<td><input type="text" name="fax" value="<?=$fax?>" /></td>
	</tr>
	<tr>
		<th>* <?=system_showText(LANG_LABEL_EMAIL)?>:</th>
		<td><input type="text" name="email" value="<?=$email?>" /></td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_LABEL_URL)?>:</th>
		<td><input type="text" name="url" value="<?=$url?>" /></td>
	</tr>
</table>
