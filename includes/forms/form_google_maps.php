<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_google_maps.php
	# ----------------------------------------------------------------------------------------------------

?>

<div id="header-form"><?=ucwords(system_showText(LANG_SITEMGR_NAVBAR_GOOGLEMAPS))?></div>

<? if ($message_googlemaps) { ?>
	<div class="response-msg error ui-corner-all"><?=$message_googlemaps?></div>
<? } ?>

<table cellpadding="2" cellspacing="0" class="table-form">

	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=ucwords(system_showText(LANG_SITEMGR_GOOGLEMAPS_KEY))?>
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="google_maps_key" value="<?=$google_maps_key?>" style="width: 400px;" maxlength="255" <?=((DEMO_LIVE_MODE) ? "readonly": "")?> /><br /><span><?=system_showText(LANG_SITEMGR_EXAMPLE)?> ABQIAAAApsu_yVy ... PoWjn3yp6vDxlSg</span>
		</td>
	</tr>
</table>