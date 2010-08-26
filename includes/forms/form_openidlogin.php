<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_openidlogin.php
	# ----------------------------------------------------------------------------------------------------

?>

<input type="hidden" name="destiny" value="<?=$destiny?>" />
<input type="hidden" name="query" value="<?=urlencode($query)?>" />

<? if ($message_login) { ?><p class="errorMessage"><?=$message_login?></p><? } ?>

<? $defaultopenidurl = $openidurl; ?>

	<div class="formFieldsLogin">
		<label for="username"><?=system_showText(LANG_LABEL_OPENIDURL);?>:</label>
		<input type="text" name="openidurl" id="openidurl" value="<?=$defaultopenidurl?>" />
		<span class="clear"></span>
		<p class="standardButton">
			<button type="submit"><?=system_showText(LANG_BUTTON_LOGIN);?></button>
		</p>
	</div>
