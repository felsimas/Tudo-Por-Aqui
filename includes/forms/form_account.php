<?


	$readonly = "";

?>

<div class="response-msg notice ui-corner-all">
	<span>* <?=system_showText(LANG_LABEL_REQUIRED_FIELD)?></span>
</div>

<script language="javascript" type="text/javascript" src="<?=DEFAULT_URL?>/scripts/checkpasswordstrength.js"></script>

<table border="0" cellpadding="2" cellspacing="0" class="standard-table">

	<tr>
		<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_LABEL_ACCOUNT_INFORMATION)?></th>
	</tr>

	<? if ((strlen(trim($message_member))>0) || (strlen(trim($message_account))>0)) { ?>
		<tr>
			<td colspan="2" style="background:none;">
				<p class="errorMessage">
				<? if (strlen(trim($message_member))>0) { ?>
					<?=$message_member?>
				<? } ?>
				<? if ((strlen(trim($message_member))>0) && (strlen(trim($message_account))>0)) { ?>
					<br>
				<? } ?>
				<? if (strlen(trim($message_account))>0) { ?>
					<?=$message_account?>
				<? } ?>
				</p>
			</td>
		</tr>
	<?}?>

	<tr>
		<th width="130px">* <?=system_showText(LANG_LABEL_USERNAME)?>:</th>
		<td >
			<? if ($noteditusername) { ?>
				<input type="hidden" name="username" value="<?=$username?>" />
				<?=system_showAccountUserName($username);?>
			<? } else { ?>
				<input type="text" name="username" value="<?=$username?>" maxlength="<?=USERNAME_MAX_LEN?>" class="input-form-account" />
				<span><?=system_showText(LANG_MSG_USERNAME_MUST_BE_BETWEEN)?> <?=USERNAME_MIN_LEN?> <?=system_showText(LANG_AND)?> <?=USERNAME_MAX_LEN?> <?=system_showText(LANG_MSG_CHARACTERS_WITH_NO_SPACES)?></span>
			<? } ?>
		</td>
	</tr>

	<? if ($foreignaccount != "y") { ?>

		<? if (eregi("^".EDIRECTORY_FOLDER."/membros/account", $_SERVER["PHP_SELF"])) { ?>
			<tr>
				<th valign="top"><?=system_showText(LANG_LABEL_CURRENT_PASSWORD)?>:<br><br></br></th>
				<td valign="top">
					<input type="password" autocomplete="off" name="current_password" class="input-form-account" <?=$readonly?> />
					<span><?=system_showText(LANG_MSG_TIPE_YOUR_PASSWORD_HERE_IF_YOU_WANT_TO_CHANGE_IT)?></span>
				</td>
			</tr>
		<? } ?>

		<tr>
			<th valign="bottom"><?=system_showText(LANG_LABEL_PASSWORD)?>:<br><br></th>
			<td valign="top">
				<? if ($noteditpassword) { ?>
					<input type="text" name="password" class="input-form-account" <?=$readonly?> value="<?=($autopw) ? system_generatePassword() : "";?>" />
				<? } else { ?>
					<input type="password" autocomplete="off" name="password" maxlength="<?=PASSWORD_MAX_LEN?>" class="input-form-account" <?=$readonly?> onkeyup="checkPasswordStrength(this.value, '<?=EDIRECTORY_FOLDER;?>')" />
					<div class="checkPasswordStrength">
						<span><?=system_showText(LANG_LABEL_PASSWORDSTRENGTH);?>:</span>
						<div id="checkPasswordStrength" class="strengthNoPassword">&nbsp;</div>
					</div>
				<? } ?>
				<span><?=system_showText(LANG_MSG_PASSWORD_MUST_BE_BETWEEN)?> <?=PASSWORD_MIN_LEN?> <?=system_showText(LANG_AND)?> <?=PASSWORD_MAX_LEN?> <?=system_showText(LANG_MSG_CHARACTERS_WITH_NO_SPACES)?></span>
			</td>
		</tr>

		<? if ($noteditpassword) { ?>
			<? if ($notification) {?>
				<tr>
					<th><input type="checkbox" name="sendmail" <?=($sendmail=='on' ? "checked" : "")?> class="inputCheck" /></th>
					<td><?=system_showText(LANG_MSG_PASSWORD_SENT_TO_MEMBER_EMAIL)?></td>
				</tr>
			<? } ?>
		<? } else { ?>
			<tr>
				<th><?=system_showText(LANG_LABEL_RETYPE_PASSWORD)?>:</th>
				<td><input type="password" autocomplete="off" name="retype_password" class="input-form-account" <?=$readonly?> /></td>
			</tr>
		<? } ?>



		<? if (!$noteditagree) { ?>
			<tr>
				<th>*<input type="checkbox" name="agree_tou" value="1" <?=($agree_tou) ? "checked" : ""?> class="standard-table-putradio" /></th>
				<td><a href="javascript: void(0);" onclick='javascript:window.open("<?=DEFAULT_URL?>/terms.php", "popup", "toolbar=0, location=0, directories=0, status=0, width=650, height=500, screenX=0, screenY=0, menubar=0, no-resizable, scrollbars=yes")'><?=system_showText(LANG_MSG_AGREE_WITH_TERMS_OF_USE)?></a></td>
			</tr>
		<? } ?>

	<? } ?>

</table>
