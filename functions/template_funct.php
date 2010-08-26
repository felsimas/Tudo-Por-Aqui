<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /functions/template_funct.php
	# ----------------------------------------------------------------------------------------------------

	function template_CreateDynamicField($fieldvalues) {
		$fieldType = ereg_replace("[0-9]", "",$fieldvalues["field"]);
		switch ($fieldType) {
			case "custom_text":
				?>
				<tr>
					<th class="wrap"><?=($fieldvalues["required"]=="y") ? "* " : ""?><?=$fieldvalues["label"]?>:</th>
					<td><input type="text" name="<?=$fieldvalues["field"]?>" value="<?=$fieldvalues["form_value"]?>" maxlength="250" /><?=($fieldvalues["instructions"]) ? "<span>".$fieldvalues["instructions"]."</span>" : ""?></td>
				</tr>
				<?
			break;
			case "custom_short_desc":
				?>
				<tr>
					<th class="wrap"><?=($fieldvalues["required"]=="y") ? "* " : ""?><?=$fieldvalues["label"]?>:</th>
					<td>
						<textarea name="<?=$fieldvalues["field"]?>" rows="5" onKeyDown="textCounter(this.form.<?=$fieldvalues["field"]?>,this.form.remLen_<?=$fieldvalues["field"]?>,250);" onKeyUp="textCounter(this.form.<?=$fieldvalues["field"]?>,this.form.remLen_<?=$fieldvalues["field"]?>,250);"><?=$fieldvalues["form_value"]?></textarea>
						<? $total = strlen(html_entity_decode($fieldvalues["form_value"])); ?>
						<span><input readonly type="text" name="remLen_<?=$fieldvalues["field"]?>" size="3" maxlength="3" value="<?=250-$total?>" class="textcounter" /> <?=system_showText(LANG_MSG_CHARS_LEFT);?> <?=system_showText(LANG_MSG_INCLUDING_SPACES_LINE_BREAKS);?><br /><?=$fieldvalues["instructions"]?></span>
					</td>
				</tr>
				<?
			break;
			case "custom_long_desc":
				?>
				<tr>
					<th class="wrap"><?=($fieldvalues["required"]=="y") ? "* " : ""?><?=$fieldvalues["label"]?>:</th>
					<td><textarea name="<?=$fieldvalues["field"]?>" rows="5"><?=$fieldvalues["form_value"]?></textarea><?=($fieldvalues["instructions"]) ? "<span>".$fieldvalues["instructions"]."</span>" : ""?></td>
				</tr>
				<?
			break;
			case "custom_checkbox":
				?>
				<tr>
					<th class="wrap"><input type="checkbox" name="<?=$fieldvalues["field"]?>" value="y" <?=($fieldvalues["form_value"] == "y") ? "checked" : ""?> class="inputCheck" /></th>
					<td><?=($fieldvalues["required"]=="y") ? "* " : ""?><?=$fieldvalues["label"]?><?=($fieldvalues["instructions"]) ? "<span>".$fieldvalues["instructions"]."</span>" : ""?></td>
				</tr>
				<?
			break;
			case "custom_dropdown":
				?>
				<tr>
					<th class="wrap"><?=($fieldvalues["required"]=="y") ? "* " : ""?><?=$fieldvalues["label"]?>:</th>
					<td>
						<select name="<?=$fieldvalues["field"]?>">
							<option value=""><?=$fieldvalues["label"];?></option>
							<?
							$auxfieldvalues = explode(",", $fieldvalues["fieldvalues"]);
							foreach ($auxfieldvalues as $fieldvalue) {
								?><option value="<?=$fieldvalue;?>" <? if ($fieldvalue == $fieldvalues["form_value"]) { echo "selected"; } ?>><?=$fieldvalue;?></option><?
							}
							?>
						</select>
						<?=($fieldvalues["instructions"]) ? "<span>".$fieldvalues["instructions"]."</span>" : "";?>
					</td>
				</tr>
				<?
			break;
		}
	}

	function template_ShowDynamicField($fieldvalues) {
		$fieldType = ereg_replace("[0-9]", "",$fieldvalues["field"]);
		switch ($fieldType) {
			case "custom_text":
				?>
				<p class="contentTitle spacingTitle"><?=$fieldvalues["label"]?>: <span><?=nl2br($fieldvalues["form_value"])?></span></p>
				<?
			break;
			case "custom_short_desc":
				?>
				<p class="contentTitle spacingTitle"><?=$fieldvalues["label"]?></p>
				<p><?=nl2br($fieldvalues["form_value"])?></p>
				<?
			break;
			case "custom_long_desc":
				?>
				<p class="contentTitle spacingTitle"><?=$fieldvalues["label"]?></p>
				<p><?=nl2br($fieldvalues["form_value"])?></p>
				<?
			break;
			case "custom_checkbox":
				?>
				<p class="contentTitle spacingTitle"><?=$fieldvalues["label"]?>: <span><?=($fieldvalues["form_value"]=="y") ? system_showText(LANG_YES) : system_showText(LANG_NO);?></span></p>
				<?
			break;
		}
	}

?>
