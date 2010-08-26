<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_editorchoice.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# DEFAULT
	# ----------------------------------------------------------------------------------------------------
	$default_max_choice = 3;

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------

	/**
	* Field values
	****************************************************************************/
	if ($default_max_choice == 1) $editorChoices[] = db_getFromDB("editor_choice", "", "", $default_max_choice, "id", "object");
	else $editorChoices = db_getFromDB("editor_choice", "", "", $default_max_choice, "id", "object");
	$indice = 0;

	if ($editorChoices) {
		foreach ($editorChoices as $editor) { 
			$default_editor_id[$indice] = $editor->getNumber("id");
			$default_name[$indice]      = $editor->getString("name");
			$default_available[$indice] = ($editor->available) ? "checked" : "";
			$default_images[$indice++]  = $editor->getNumber("image_id");
		}
	}

?>

<div id="header-form">
	<?=ucwords(system_showText(LANG_SITEMGR_LISTING));?> <?=system_showText(LANG_SITEMGR_SETTINGS_EDITORCHOICE_DESIGNATIONS)?>
	<font class="subheader-form">(<?=IMAGE_DESIGNATION_WIDTH?>px x <?=IMAGE_DESIGNATION_HEIGHT?>px) (<?=system_showText(LANG_SITEMGR_JPGORGIF)?>)</font>
</div>

<? if ($message_editorchoice) { ?>
	<div id="warning" class="successMessage">
		<?=$message_editorchoice?>
	</div>
<? } ?>

<? if ($message_error_editorchoice) { ?>
	<div id="warning" class="errorMessage">
		<?=$message_error_editorchoice?>
	</div>
<? } ?>

<div class="tip-base">
	<p style="text-align: justify;"><a href="<?=DEFAULT_URL;?>/gerenciamento/faq.php?keyword=<?=urlencode("designations");?>" target="_blank"><?=system_showText(LANG_SITEMGR_SETTINGS_EDITORCHOICE_TIP)?></a></p>
</div>

<table cellpadding="2" cellspacing="0" border="0" class="table-form">

	<? for($i=0; $i < $default_max_choice; $i++) { ?>

		<tr class="tr-form">
			<td rowspan="4" align="center" class="td-form">
			<?
				$imageObj = new Image($default_images[$i]);
				if($imageObj->imageExists()) {
					echo $imageObj->getTag(true, IMAGE_DESIGNATION_WIDTH, IMAGE_DESIGNATION_HEIGHT, $default_name[$i]);
					$hasImage = true;
				} else {
					$hasImage = false;
				}
			?>
			</td>
		</tr>
		<tr class="tr-form">
			<td align="right" class="td-form">
				<div class="label-form">
					<input type="hidden" name="choice[]" value="<?=$default_editor_id[$i]?>" />
					<input type="hidden" name="image[]"  value="<?=$default_images[$i]?>" />
					<?=system_showText(LANG_SITEMGR_LABEL_NAME)?> <?=$i+1?>:
				</div>
			</td>
			<td align="left" class="td-form">
				<input type="text" name="name[]" value="<?=$_POST['name'][$i] ? htmlspecialchars(stripslashes($_POST['name'][$i])) : $default_name[$i]?>" class="input-form-adminemail" />
			</td>
		</tr>
		<tr class="tr-form">
			<td align="right" class="td-form">
				<div class="label-form">
					<?=system_showText(LANG_SITEMGR_SETTINGS_EDITORCHOICE_FILE)?> <?=$i+1?>:<br /><br />
				</div>
			</td>
			<td align="left" class="td-form">
				<input type="file" class="input-form-listing" name="file[]" /><br />
				<span style="float:left"><?=system_showText(LANG_SITEMGR_MSGMAXFILESIZE)?> <?=UPLOAD_MAX_SIZE;?> MB.</span>
				<? if($hasImage) { ?>
				
					<table border="0" cellpadding="0" cellspacing="0" style=" width: auto;">
						<tr>
							<td style="padding: 2px;"><a href="<?=DEFAULT_URL?>/gerenciamento/prefs/editorchoice.php?delete=y&id=<?=$default_editor_id[$i]?>" title="<?=system_showText(LANG_SITEMGR_SETTINGS_EDITORCHOICE_CLICKHERETODELETECHOICE)?> <?=$i+1?>" style="line-height: 13px; color: #CC0000; font-weight: bold;"><img src="<?=DEFAULT_URL?>/images/bt_delete.gif" alt="delete" title="delete" border="0" /></a></td>
							<td style="padding: 2px;"><a href="<?=DEFAULT_URL?>/gerenciamento/prefs/editorchoice.php?delete=y&id=<?=$default_editor_id[$i]?>" title="<?=system_showText(LANG_SITEMGR_SETTINGS_EDITORCHOICE_CLICKHERETODELETECHOICE)?> <?=$i+1?>" style="line-height: 13px; color: #CC0000; font-weight: bold;"> <?=strtolower(system_showText(LANG_SITEMGR_DELETE))?></a></td>
						</tr>
					</table>
				<? } ?>
			</td>
		</tr>
		<tr class="tr-form">
			<td align="right" class="td-form">
				<input type="checkbox" name="available_<?=$i?>" value="1" <?=$default_available[$i]?> class="inputCheck" />
			</td>
			<td align="left" class="td-form">
				<div class="label-form">
					<?=system_showText(LANG_SITEMGR_SETTINGS_EDITORCHOICE_LISTINGACCOUNTSCANSELECT)?>
				</div>
			</td>
		</tr>

	<? } ?>

</table>
<br /><br />