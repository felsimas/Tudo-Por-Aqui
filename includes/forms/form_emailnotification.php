<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_emailnotification.php
	# ----------------------------------------------------------------------------------------------------

?>

<? if($message){ ?>
	<div class="<?=$message_style?>">
		<?=$message?>
	</div>
<? } ?>

<div id="box-warning" class="informationMessage" style="display: none;">
	<?=system_showText(LANG_SITEMGR_EMAILNOTIFICATION_EMAILHASBEENDISABLED)?>
</div>

<table width="500" cellpadding="2" cellspacing="0" border="0" class="table-form">
	<? if ($emailNotificationObj->getNumber("id") != 19) { ?>
		<tr class="tr-form">
			<td align="right" class="td-form" nowrap="nowrap">
				<?=system_showText(LANG_SITEMGR_LABEL_DISABLEEMAIL)?>:
			</td>
			<td align="left" class="td-form">
				<?
				$disable_str  = "";
				$disable_name = "";
				if ($lang != EDIR_DEFAULT_LANGUAGE) {
					$disable_str = "disabled=\"disabled\"";
					$disable_name = "_disabled";
					if ($deactivate) {
						echo "<input type=\"hidden\" name=\"deactivate\" value=\"1\" >\n";
					} else {
						echo "<input type=\"hidden\" name=\"deactivate\" value=\"\" >\n";
					}
				}
				?>
				<input type="checkbox" <?=$disable_str?> name="deactivate<?=$disable_name?>" value="1" <?=$deactivate?> onclick="javascript: showWarning();" style="width: auto; border: 0;"  class="inputCheck" />
			</td>
		</tr>
	<? } ?>
	
	<tr>
		<th><?=system_showText(LANG_SITEMGR_LANGUAGE)?>:</th>
		<td>
		<?=language_writeComboLang('lang', $lang, 'changeComboLang (this.value)')?>	
		</td>
	</tr>
	
	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_LABEL_CONTENTTYPE)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<?
			$disable_str  = "";
			$disable_name = "";
			if ($lang != EDIR_DEFAULT_LANGUAGE) {
				$disable_str = "disabled=\"disabled\"";
				$disable_name = "_disabled";
				echo "<input type=\"hidden\" name=\"content_type\" value=\"".$content_type."\">\n";
			}
			?>
			<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td style="width:20px;"><input <?=$disable_str?> type="radio" name="content_type<?=$disable_name?>" value="text/plain" <?=(($content_type == "text/plain") ? "checked": "")?> style="width: auto; border: 0;" class="inputCheck" /></td>
					<td  style="width:40px;"><?=system_showText(LANG_SITEMGR_LABEL_TEXT)?></td>
					<td style="width:20px;"><input <?=$disable_str?> type="radio" name="content_type<?=$disable_name?>" value="text/html" <?=(($content_type == "text/html") ? "checked": "")?> style="width: auto; border: 0;" /></td>
					<td><?=system_showText(LANG_SITEMGR_LABEL_HTML)?></td>
				</tr>
			</table>
			
		</td>
	</tr>
	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_LABEL_BCC)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="bcc" maxlength="255" size="35" value="<?=$bcc?>" <? if ($lang != EDIR_DEFAULT_LANGUAGE) { ?>readonly="readonly" class="inputReadOnly"<? } ?> />
		</td>
	</tr>	
	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_LABEL_SUBJECT)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="subject" maxlength="255" size="35" value="<?=$subject?>" /> <a style="cursor:pointer; color:#000000" onclick="window.open('help.php?id=<?=$id?>',null,'height=400,width=650,status=yes,scrollbars=yes,toolbar=no,menubar=no,location=no');"><span style="font:11px Arial"><?=system_showText(LANG_SITEMGR_EMAILNOTIFICATION_CLICKHERETOUSEVARS)?></span></a>
		</td>
	</tr>
	<?
	if ($lang == EDIR_DEFAULT_LANGUAGE) {
	?>
	<tr>
		<td align="center" class="label-form" colspan="2">
			<?=system_showText(LANG_SITEMGR_LABEL_RESTOREDEFAULTMESSAGE)?>:
			<input type="submit" name="reset_html" value="<?=system_showText(LANG_SITEMGR_LABEL_HTML)?>" onclick="return confirm('<?=system_showText(LANG_SITEMGR_EMAILNOTIFICATION_OVERWRITEDEFAULTQUESTION)?>');" class="ui-state-default ui-corner-all2 button-space" />
			<input type="submit" name="reset_text" value="<?=system_showText(LANG_SITEMGR_LABEL_TEXT)?>" onclick="return confirm('<?=system_showText(LANG_SITEMGR_EMAILNOTIFICATION_OVERWRITEDEFAULTQUESTION)?>');" class="ui-state-default ui-corner-all2 button-space" />
	</td>
	</tr>
	<? } ?>
	<tr class="tr-form">
		<td align="right" class="td-form" valign="top">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_LABEL_BODY)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<textarea name="body" style="height:200px; width:400px;"><?=$body?></textarea>
		</td>
	</tr>
</table>