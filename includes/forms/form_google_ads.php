<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_google_ads.php
	# ----------------------------------------------------------------------------------------------------

?>

<div id="header-form"><?=ucwords(system_showText(LANG_SITEMGR_GOOGLEADS))?></div>

<? if ($message_googleads) { ?>
	<div class="response-msg error ui-corner-all"><?=$message_googleads?></div>
<? } ?>

<table cellpadding="2" cellspacing="0" class="table-form">

	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=ucwords(system_showText(LANG_SITEMGR_GOOGLEADS_CLIENT))?>
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="google_ad_client" value="<?=$google_ad_client?>" maxlength="255" <?=((DEMO_LIVE_MODE) ? "readonly": "")?> /><br /><span><?=system_showText(LANG_SITEMGR_EXAMPLE)?> pub-0107044813308700</span>
		</td>
	</tr>

	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=ucwords(system_showText(LANG_SITEMGR_GOOGLEADS_CLIENTOPTION))?>
			</div>
		</td>
		<td align="left" class="td-form">
			
		<table border="0" cellpadding="0" cellspacing="0" style="width: auto; margin: 0;">
			<tr>
				<td><input type="radio" name="google_ad_status" value="on" <?=($google_ad_status=="on") ? "checked" : ""?> class="inputRadio" <?=((DEMO_LIVE_MODE) ? "readonly": "")?> /></td>
				<td><?=ucwords(system_showText(LANG_SITEMGR_ON))?></td>
				<td><input type="radio" name="google_ad_status" value="off" <?=($google_ad_status=="off") ? "checked" : ""?> class="inputRadio" <?=((DEMO_LIVE_MODE) ? "readonly": "")?> /></td>
				<td><?=ucwords(system_showText(LANG_SITEMGR_OFF))?></td>
			</tr>			
		</table>
			
		</td>
	</tr>
</table>