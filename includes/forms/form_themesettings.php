<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_themesettings.php
	# ----------------------------------------------------------------------------------------------------

?>

<div id="header-form">
	<?=ucwords(system_showText(LANG_SITEMGR_SETTINGS_THEME_SELECTANTHEME))?>
</div>

<? if ($message) { ?>
	<div id="warning" class="<?=$message_style?>">
		<?=$message?>
	</div>
<? } ?>

<table cellpadding="2" cellspacing="0" border="0" class="table-form">
	<tr class="tr-form">
		<th><?=system_showText(LANG_SITEMGR_SETTINGS_THEME_SELECTANTHEME)?></th>
		<td align="left" class="td-form">
			<?=$selectThemes?>
		</td>
	</tr>
</table>
