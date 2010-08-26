<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_google_analytics.php
	# ----------------------------------------------------------------------------------------------------

?>

<div id="header-form"><?=ucwords(system_showText(LANG_SITEMGR_GOOGLEANALYTICS))?></div>

<? if ($message_googleanalytics) { ?>
	<div class="response-msg error ui-corner-all"><?=$message_googleanalytics?></div>
<? } ?>

<table cellpadding="2" cellspacing="0" class="table-form">

	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=ucwords(system_showText(LANG_SITEMGR_GOOGLEANALYTICS_ACCOUNT))?>
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="google_analytics_account" value="<?=$google_analytics_account?>" maxlength="255" <?=((DEMO_LIVE_MODE) ? "readonly": "")?> /><br /><span><?=system_showText(LANG_SITEMGR_EXAMPLE)?> UA-2623236-1</span>
		</td>
	</tr>

	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=ucwords(system_showText(LANG_SITEMGR_GOOGLEANALYTICS_OPTIONS))?>
			</div>
		</td>
		<td class="td-form">
			<table cellpadding="2" cellspacing="0">
				<tr class="tr-form">
					<td align="left" class="td-form"><input type="checkbox" name="google_analytics_front" value="on" <?=(($google_analytics_front == "on") ? "checked" : "")?> class="inputCheck" /></td>
					<td align="left" class="td-form"><div class="label-form"><?=ucwords(system_showText(LANG_SITEMGR_FRONT))?></div></td>
					<td align="left" class="td-form"><input type="checkbox" name="google_analytics_membros" value="on" <?=(($google_analytics_membros == "on") ? "checked" : "")?> class="inputCheck" /></td>
					<td align="left" class="td-form"><div class="label-form"><?=ucwords(system_showText(LANG_SITEMGR_MEMBERS))?></div></td>
					<td align="left" class="td-form"><input type="checkbox" name="google_analytics_sitemgr" value="on" <?=(($google_analytics_sitemgr == "on") ? "checked" : "")?> class="inputCheck" /></td>
					<td align="left" class="td-form"><div class="label-form"><?=ucwords(system_showText(LANG_SITEMGR_SITEMGR))?></div></td>
				</tr>
			</table>
		</td>
	</tr>

</table>