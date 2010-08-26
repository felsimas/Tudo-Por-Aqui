<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_adminemail.php
	# ----------------------------------------------------------------------------------------------------

?>

<? if ($message_confemail) { ?>
	<div id="warning" class="<?=$message_style?>">
		<?=$message_confemail?>
	</div>
<? } ?>

<table border="0" cellpadding="2" cellspacing="2" class="standard-table">
	<tr>
		<th class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_EMAILSENDINGCONFIGURATION)?> <span><?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_EDIRECTORYEMAILSENDER)?></span></th>
	</tr>
</table>

<table cellpadding="2" cellspacing="0" border="0" class="standard-table">
	<tr>
		<th style="width:140px;"><?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_LABEL_SENDMETHOD)?>:</th>
		<td>
			<select name="emailconf_method" id="method" onchange="changeMethod(this)">
				<option value="mail" <? if (!$emailconf_method || $emailconf_method == 'mail') echo "selected=\"selected\""; ?>><?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_OPTION_PHPDEFAULT)?></option>
				<option value="smtp" <? if ($emailconf_method == 'smtp') echo "selected=\"selected\""; ?>><?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_OPTION_SMTPSERVER)?></option>
			</select>
		</td>
	</tr>
</table>

<table id="form-smtp" cellpadding="2" cellspacing="0" border="0" class="standard-table" style="display:<? if (!$emailconf_method || $emailconf_method == 'mail') { ?>none<? } else { ?>block<? } ?>;">
	<tr>
		<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_SMTPSERVERINFORMATION)?></th>
	</tr>
	<tr>
		<th style="width:140px;"><?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_LABEL_SERVER)?>:</th>
		<td>
			<input style="width:250px;" type="text" name="emailconf_host" id="host" <? if ($emailconf_host) echo "value=\"$emailconf_host\""; ?> />&nbsp;<?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_LABEL_PORT)?>:&nbsp;
			<input style="width:55px;" type="text" name="emailconf_port" id="port" <? if ($emailconf_port) echo "value=\"$emailconf_port\""; ?> />
			<input type="hidden" name="emailconf_protocol" id="protocol" <? if ($emailconf_protocol) echo "value=\"$emailconf_protocol\""; ?> />
		</td>
	</tr>
	<tr>
		<th style="width:140px;"><input class="standard-table-putradio" type="radio" name="emailconf_auth" id="auth1" value="normal" onclick="switchAuth(this.value)" /></th>
		<td>
		<label for="auth1"><?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_SERVERREQUIRESAUTHENTICATION1)?></label>
		</td>
	</tr>
	<tr>
		<th style="width:140px;"><input class="standard-table-putradio" type="radio" name="emailconf_auth" id="auth2" value="secure" onclick="switchAuth(this.value)" /></th>
		<td>
		<label for="auth2"><?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_SERVERREQUIRESAUTHENTICATION2)?></label></td>
	</tr>
	<tr>
		<th style="width:140px;"><input class="standard-table-putradio" type="radio" name="emailconf_auth" id="auth3" value="noauth" onclick="switchAuth(this.value)" /></th>
		<td>
		<label for="auth3"><?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_SERVERREQUIRESAUTHENTICATION3)?></label>
		</td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_SITEMGR_LABEL_EMAILADDRESS)?>:</th>
		<td>
			<input style="width:250px;" type="text" name="emailconf_email" id="email" <? if ($emailconf_email) echo "value=\"$emailconf_email\""; ?> onkeyup="emailChange(this.value)" onkeypress="emailChange(this.value)" onblur="emailBlur(this.form)" />&nbsp;<span id="email_status" style="display:inline"></span>
		</td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_SITEMGR_LABEL_USERNAME)?>:</th>
		<td>
			<input style="width:250px;" type="text" name="emailconf_username" id="username" <? if ($emailconf_username) echo "value=\"$emailconf_username\""; ?> />
		</td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_SITEMGR_LABEL_PASSWORD)?>:</th>
		<td>
			<input style="width:250px;" type="password" name="emailconf_password" id="password" />
		</td>
	</tr>
	<tr>
		<th></th>
		<td>
		<div id="response"></div>
		</td>
	</tr>
</table>

<table cellpadding="2" cellspacing="0" border="0" class="standard-table" style="margin-top:0px;padding-top:0px;">
	<tr>
		<th></th>
		<td><button type="submit" name="bt_submit" id="bt_submit" value="Submit" class="ui-state-default ui-corner-all<? if ($emailconf_method == 'smtp') { ?> ui-state-default ui-corner-all-disabled<? } ?>" <? if ($emailconf_method == 'smtp') { ?>disabled="disabled"<? } ?> style="width:200px;"><?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_SAVECONFIGURATION)?></button></td>
	</tr>
</table>
