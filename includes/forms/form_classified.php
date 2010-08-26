<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_classified.php
	# ----------------------------------------------------------------------------------------------------

?>

<script language="javascript" type="text/javascript" src="<?=DEFAULT_URL?>/scripts/common.js"></script>

<script language="javascript" type="text/javascript">

	function JS_submit() {
		document.classified.submit();
	}

</script>

<?  // Account Search Javascript /////////////////////////////////////////////////////// ?>

<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/accountsearch.js"></script>

<?  //////////////////////////////////////////////////////////////////////////////////// ?>

<?
echo "<p class=\"informationMessage\">* ".system_showText(LANG_LABEL_REQUIRED_FIELD)." </p>";
	
	if ($message_classified) {
		echo "<p class=\"errorMessage\">";
		echo $message_classified ;
		echo "</p>";
	}
?>

<? // Display Level ////////////////////////////////////////////////////////////////// ?>
<?php
$level_name = "";
if ($level) {
	$levelObjTMP = new ClassifiedLevel();
	$level_name = $levelObjTMP->getName($level);
}
?>
<table class="levelTable">
	<tr>
		<th class="levelTitle"><?=system_showText(LANG_CLASSIFIED_LEVEL);?></th>
	</tr>
	<tr>
		<th class="tableSelectedOption"><?=ucfirst($level_name); ?></th>
	</tr>
</table>

<? // Account Search ////////////////////////////////////////////////////////////////// ?>
<? if (!$membros) { ?>

	<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
		<tr>
			<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_LABEL_ACCOUNT)?> <span><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_TOACCOUNT_SPAN)?></span></th>
		</tr>
	</table>

	<?
	$acct_search_table_title = system_showText(LANG_SITEMGR_ACCOUNTSEARCH_SELECT)." ".system_showText(LANG_SITEMGR_CLASSIFIED);
	$acct_search_field_name = "account_id";
	$acct_search_field_value = $account_id;
	$acct_search_required_mark = false;
	$acct_search_form_width = "95%";
	$acct_search_cell_width = "";
	$return = system_generateAjaxAccountSearch($acct_search_table_title, $acct_search_field_name, $acct_search_field_value, $acct_search_required_mark, $acct_search_form_width, $acct_search_cell_width);
	echo $return;
	?>

<? } ?>
<?  //////////////////////////////////////////////////////////////////////////////////// ?>

	<table border="0" cellpadding="0" cellspacing="0" class="standard-table">
		<tr>
			<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_LABEL_INFORMATION);?></th>
		</tr>
		<tr>
			<th>* <?=system_showText(LANG_CLASSIFIED_TITLE);?>:</th>
			<td>
				<input type="text" name="title" value="<?=$title?>" maxlength="100" onBlur="easyFriendlyUrl(this.value, 'friendly_url', '<?=FRIENDLYURL_VALIDCHARS?>', '<?=FRIENDLYURL_SEPARATOR?>');" />
				<input type="hidden" name="friendly_url" id="friendly_url" value="<?=$friendly_url?>" maxlength="150" />
			</td>
		</tr>
		<? if ($level >= 30) { ?>
		<tr>
			<th><?=system_showText(LANG_LABEL_CONTACT_NAME);?>:</th>
			<td><input type="text" name="contactname" value="<?=$contactname?>" /></td>
		</tr>
		<? } ?>
		<tr>
			<th><?=system_showText(LANG_LABEL_CONTACT_PHONE);?>:</th>
			<td><input type="text" name="phone" value="<?=$phone?>" /></td>
		</tr>
		<? if ($level == 50) { ?>
		<tr>
			<th><?=system_showText(LANG_LABEL_CONTACT_FAX);?>:</th>
			<td><input type="text" name="fax" value="<?=$fax?>" /></td>
		</tr>
		<? } ?>
		<tr>
			<th><?=system_showText(LANG_LABEL_CONTACT_EMAIL);?>:</th>
			<td><input type="text" name="email" value="<?=$email?>" /></td>
		</tr>
		<? if ($level == 50) { ?>
		<tr>
			<th><?=system_showText(LANG_LABEL_URL)?>:</th>
			<td>
			<select name="url_protocol" class="httpSelect">
			<?
			$url_protocols 	= explode(",", URL_PROTOCOL);
			$sufix   			= "://";
			$protocol_replace 	= "" ;
			for ($i=0; $i<count($url_protocols); $i++) {
				$selected = false;
				$protocol = $url_protocols[$i];
				if (isset($url) || isset($url_protocol)) {
					if ($url && !$url_protocol) {
						$_protocol = explode($sufix, $url);
						$_protocol = $_protocol[0];
					} else if ($url_protocol) {
						$_protocol = str_replace($sufix, "", $url_protocol);
					}
					if ($_protocol == $protocol) {
						$selected = true;
						$protocol_replace = $_protocol.$sufix;
					}
				} else if (!isset($id) && !$i) {
					$selected = true;
					$protocol_replace = $url_protocols[$i];
					$protocol_replace = $protocol_replace.$sufix;
				}
				$protocol .= $sufix;
			?>
			<option value="<?=$protocol?>"  <?=($selected==true  ? "selected=\"selected\"" : "")?> ><?=$protocol?></option>
			<?
			}
			?>
			</select>
			<input type="text" style="width:425px" name="url" value="<?=str_replace($protocol_replace, "", $url)?>" maxlength="255" />
			</td>
		</tr>
		<? } ?>
	</table>

	<table border="0" cellpadding="0" cellspacing="0" class="standard-table">
		<tr>
			<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_LABEL_LOCATIONS)?></th>
		</tr>
		<tr>
			<th><?=system_showText(LANG_LABEL_ADDRESS);?>:</th>
			<td><input type="text" name="address" value="<?=$address?>" /></td>
		</tr>
		<tr>
			<th><?=system_showText(LANG_LABEL_ADDRESS_OPTIONAL);?>:</th>
			<td><input type="text" name="address2" value="<?=$address2?>" /></td>
		</tr>
		<tr>
			<th><?=system_showText(LANG_LABEL_COUNTRY)?>:</th>
			<td>
				<select name="estado_id" id="estado_id" OnChange="fillSelect('<?=DEFAULT_URL?>', this.form.cidade_id, this.value, this.form);">
					<option value=""><?=system_showText(LANG_MSG_SELECT_A_COUNTRY);?></option>
					<?
					if($countries) foreach($countries as $each_country){
						$selected = ($estado_id == $each_country["id"]) ? "selected" : "";
						?><option <?=$selected?> value="<?=$each_country["id"]?>"><?=$each_country["name"]?></option><?
						unset($selected);
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<th><?=system_showText(LANG_LABEL_STATE)?>:</th>
			<td>
				<select name="cidade_id" id="cidade_id" OnChange="fillSelect('<?=DEFAULT_URL?>', this.form.bairro_id, this.value, this.form);">
					<option value=""><?=system_showText(LANG_MSG_SELECT_A_STATE);?></option>
					<?
					if($selected_states) foreach($selected_states as $each_state){
						if($selected_state) $selected = ($selected_state->getString("id") == $each_state["id"]) ? "selected" : "";
						?><option <?=$selected?> value="<?=$each_state["id"];?>"><?=$each_state["name"];?></option><?
						unset($selected);
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<th><?=system_showText(LANG_LABEL_CITY)?>:</th>
			<td>
				<select name="bairro_id" id="bairro_id">
					<option value=""><?=system_showText(LANG_MSG_SELECT_A_CITY);?></option>
					<?
					if($selected_regions) foreach($selected_regions as $each_region){
						if($selected_region) $selected = ($selected_region->getString("id") == $each_region["id"]) ? "selected" : "" ;
						?><option <?=$selected?> value="<?=$each_region["id"];?>"><?=$each_region["name"];?></option><?
						unset($selected);
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<th><?=ucwords(ZIPCODE_LABEL)?>:</th>
			<td><input type="text" name="zip_code" value="<?=$zip_code?>" maxlength="10" /></td>
		</tr>
	</table>

	<table border="0" cellpadding="0" cellspacing="0" class="standard-table">
		<tr>
			<th colspan="3" class="standard-tabletitle"><?=system_showText(LANG_LABEL_IMAGE)?> <span>(<?=IMAGE_CLASSIFIED_FULL_WIDTH?>px x <?=IMAGE_CLASSIFIED_FULL_HEIGHT?>px) (JPG <?=system_showText(LANG_OR);?> GIF)</span></th>
		</tr>
		<tr>
			<td colspan="3" class="standard-tabletitle"><span><?=system_showText(LANG_MSG_ADDITIONAL_IMAGES_MAY_BE_ADDED);?> <img src="<?=DEFAULT_URL?>/images/icon_gallery.gif" border="0" alt="<?=strtolower(system_showText(LANG_SITEMGR_GALLERY))?>" title="<?=strtolower(system_showText(LANG_SITEMGR_GALLERY))?>" /> <?=system_showText(LANG_MSG_ADDITIONAL_IMAGES_IF_ENABLED);?><span></td>
		</tr>
		<tr>
			<?
			if ($thumb_id) {
				$imageObj = new Image($thumb_id);
				if ($imageObj->imageExists()) {
					echo "<th class=\"imageSpace\">";
					echo $imageObj->getTag(true, IMAGE_CLASSIFIED_THUMB_WIDTH, IMAGE_CLASSIFIED_THUMB_HEIGHT, $title);
					echo "</th>";
				} else {
					echo "<th class=\"imageSpace\" style=\"width: ".IMAGE_CLASSIFIED_THUMB_WIDTH."px;\">";
					echo "&nbsp;";
					echo "</th>";
				}
			}
			?>
			<th><?=system_showText(LANG_LABEL_IMAGE_SOURCE)?>:</th>
			<td>
				<input type="file" name="image" size="50" /><span><?=system_showText(LANG_MSG_MAX_FILE_SIZE)?> <?=UPLOAD_MAX_SIZE;?> MB. <?=system_showText(LANG_MSG_TRANSPARENTGIF_NOT_SUPPORTED);?>.</span>
				<input type="hidden" name="image_id" value="<?=$image_id?>" />
			</td>
		</tr>
		<? if ($thumb_id) { ?>
			<tr>
				<th colspan="2"><input type="checkbox" name="remove_image" value="1" class="inputCheck" /></th>
				<td><?=system_showText(LANG_MSG_CHECK_TO_REMOVE_IMAGE)?></td>
			</tr>
		<? } ?>
	</table>

<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
	<tr>
		<th colspan="2" class="standard-tabletitle">
			<?=system_showText(LANG_LABEL_SUMMARY_DESCRIPTION)?> <span>(<?=strtolower(system_showText(LANG_MSG_MAX_250_CHARS))?>)</span>
		</th>
	</tr>
	<?
	$array_edir_languagenames = explode(",", EDIR_LANGUAGENAMES);
	for ($i=0; $i<count(explode(",", EDIR_LANGUAGES)); $i++) {
		$labelsuffix = "";
		if ($i) $labelsuffix = $i;
		?>
		<tr>
			<th><?=((count(explode(",", EDIR_LANGUAGES))>1)?($array_edir_languagenames[$i].":"):("&nbsp;"));?></th>
			<td>
				<textarea name="summarydesc<?=$labelsuffix;?>" rows="5" onKeyDown="textCounter(this.form.summarydesc<?=$labelsuffix;?>,this.form.remLen<?=$labelsuffix;?>,250);" onKeyUp="textCounter(this.form.summarydesc<?=$labelsuffix;?>,this.form.remLen<?=$labelsuffix;?>,250);"><?=${"summarydesc".$labelsuffix};?></textarea>
				<? $total = strlen(html_entity_decode(${"summarydesc".$labelsuffix})); ?>
				<span><input readonly type="text" name="remLen<?=$labelsuffix;?>" size="3" maxlength="3" value="<?=250-$total?>" class="textcounter" /> <?=system_showText(LANG_MSG_CHARS_LEFT)?> <?=system_showText(LANG_MSG_INCLUDING_SPACES_LINE_BREAKS)?></span>
			</td>
		</tr>
		<?
	}
	?>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
	<tr>
		<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_LABEL_DETAIL_DESCRIPTION)?></th>
	</tr>
	<?
	$array_edir_languagenames = explode(",", EDIR_LANGUAGENAMES);
	for ($i=0; $i<count(explode(",", EDIR_LANGUAGES)); $i++) {
		$labelsuffix = "";
		if ($i) $labelsuffix = $i;
		?>
		<tr>
			<th><?=((count(explode(",", EDIR_LANGUAGES))>1)?($array_edir_languagenames[$i].":"):("&nbsp;"));?></th>
			<td>
				<textarea name="detaildesc<?=$labelsuffix;?>" rows="5"><?=${"detaildesc".$labelsuffix}?></textarea>
			</td>
		</tr>
		<?
	}
	?>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
	<tr>
		<th colspan="2" class="standard-tabletitle">
			<?=system_showText(LANG_LABEL_KEYWORDS_FOR_SEARCH)?> <span>(<?=system_showText(LANG_LABEL_MAX);?> <?=MAX_KEYWORDS?> <?=system_showText(LANG_LABEL_KEYWORDS);?>)</span>
			<img src="<?=DEFAULT_URL?>/images/icon_interrogation.gif" alt="?" title="<?=system_showText(LANG_MSG_INCLUDE_UP_TO_KEYWORDS)?> <?=MAX_KEYWORDS?> <?=system_showText(LANG_MSG_KEYWORDS_WITH_MAXIMUM_50)?>" border="0" />
		</th>
	</tr>
	<tr>
		<td colspan="2" class="standard-tableContent">
			<table border="0" cellpadding="0" cellspacing="0" align="center">
				<tr>
					<th><?=system_showText(LANG_MSG_KEYWORD_PER_LINE)?></th>
					<td>
						<?=system_showText(LANG_KEYWORD_SAMPLE_1);?><br />
						<?=system_showText(LANG_KEYWORD_SAMPLE_2);?><br />
						<?=system_showText(LANG_KEYWORD_SAMPLE_3);?><br />
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<?
	$array_edir_languagenames = explode(",", EDIR_LANGUAGENAMES);
	for ($i=0; $i<count(explode(",", EDIR_LANGUAGES)); $i++) {
		$labelsuffix = "";
		if ($i) $labelsuffix = $i;
		?>
		<tr>
			<th><?=((count(explode(",", EDIR_LANGUAGES))>1)?($array_edir_languagenames[$i].":"):("&nbsp;"));?></th>
			<td>
				<textarea name="keywords<?=$labelsuffix;?>" rows="5"><?=${"keywords".$labelsuffix}?></textarea>
			</td>
		</tr>
		<?
	}
	?>
</table>

	<table border="0" cellpadding="0" cellspacing="0" class="standard-table">
		<tr>
			<th colspan="2" class="standard-tabletitle">
				<?=system_showText(LANG_LABEL_CATEGORY);?>
			</th>
		</tr>
		<tr>
			<th>* <?=system_showText(LANG_CLASSIFIED_CATEGORY);?>:</th>
			<td><?=$categoryDropDown?></td>
		</tr>
	</table>

<? if (PAYMENT_FEATURE == "on") { ?>
	<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
		<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
			<tr>
				<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
			</tr>
			<? if (((!$classified->getNumber("id")) || (($classified) && ($classified->needToCheckOut())) || (strpos($url_base, "/gerenciamento")) || (($classified) && ($classified->getPrice() <= 0))) && ($process != "signup")) { ?>
				<tr>
					<th><?=system_showText(LANG_LABEL_CODE)?>:</th>
					<td><input type="text" name="discount_id" value="<?=$discount_id?>" maxlength="10" /></td>
				</tr>
			<? } else { ?>
				<tr>
					<th><?=system_showText(LANG_LABEL_CODE)?>:</th>
					<td><?=(($discount_id) ? $discount_id : system_showText(LANG_NA) )?></td>
				</tr>
			<? } ?>
		</table>
	<? } ?>
<? } ?>