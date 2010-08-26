<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_changelogin.php
	# ----------------------------------------------------------------------------------------------------

	$readonly = "";
	if (DEMO_LIVE_MODE) { $readonly = "readonly"; }

?>

<div id="header-form">
	<?=ucwords(system_showText(LANG_SITEMGR_MANAGEACCOUNT_SITEMGRACCOUNT))?>
</div>

<? if ($error_currentpassword) { ?>
	<div id="warning" class="errorMessage"><?=$error_currentpassword?></div>
<? } ?>

<? if ($message_changelogin) { ?>
	<? if ($success) { ?>
		<div id="warning" class="successMessage"><?=$message_changelogin?></div>
	<? } else { ?>
		<div id="warning" class="errorMessage"><?=$message_changelogin?></div>
	<? } ?>
<? } ?>

<script language="javascript" type="text/javascript" src="<?=DEFAULT_URL?>/scripts/checkpasswordstrength.js"></script>

<table cellpadding="2" cellspacing="0" border="0" class="standard-table">
	<tr>
		<th><?=system_showText(LANG_SITEMGR_LABEL_USERNAME)?>:</th>
		<td>
			<input type="text" name="username" value="<?=$username?>" class="input-form-changelogin" <?=$readonly?> />
		</td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_SITEMGR_LABEL_CURRENTPASSWORD)?>:</th>
		<td>
			<input type="password" autocomplete="off" name="current_password" class="input-form-changelogin" <?=$readonly?> />
		</td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_SITEMGR_NEW)?> <?=system_showText(LANG_SITEMGR_LABEL_PASSWORD)?>:</th>
		<td>
			<input type="password" autocomplete="off" name="password" class="input-form-changelogin" <?=$readonly?> onkeyup="checkPasswordStrength(this.value, '<?=EDIRECTORY_FOLDER;?>')" />
			<div class="checkPasswordStrength">
				<span><?=system_showText(LANG_LABEL_PASSWORDSTRENGTH);?>:</span>
				<div id="checkPasswordStrength" class="strengthNoPassword">&nbsp;</div>
			</div>
		</td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_SITEMGR_LABEL_RETYPENEWPASSWORD)?>:</th>
		<td>
			<input type="password" autocomplete="off" name="retype_password" class="input-form-changelogin" <?=$readonly?> />
		</td>
	</tr>
</table>
