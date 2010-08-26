<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_banner.php
	# ----------------------------------------------------------------------------------------------------

	// Price description ---------------------------------------------
	$levelObj = new BannerLevel(EDIR_DEFAULT_LANGUAGE, true);
	$levelValue = $levelObj->getValues();
	unset($strArray);
	foreach ($levelValue as $value) {
		$strAux = $levelObj->showLevel($value).": <b>";
		if ($levelObj->getPrice($value) > 0) {
			$strAux .= $levelObj->getPrice($value);
		} else { 
			$strAux .= system_showText(LANG_LABEL_FREE);
		}
		$strAux .= "</b> ".system_showText(LANG_PER)." ";
		if (payment_getRenewalCycle("banner") > 1) {
			$strAux .= payment_getRenewalCycle("banner")." ";
			$strAux .= payment_getRenewalUnitName("banner")."s";
		}else {
			$strAux .= payment_getRenewalUnitName("banner");
		}
		$strAux2 = $levelObj->showLevel($value).": <b>";
		if ($levelObj->getImpressionPrice($value) > 0) {
			$strAux2 .= $levelObj->getImpressionPrice($value);
		} else { 
			$strAux2 .= system_showText(LANG_LABEL_FREE);
		}
		$strAux2 .= "</b> ".system_showText(LANG_EACH)." ".$levelObj->getImpressionBlock($value)." ".system_showText(LANG_IMPRESSIONSBLOCK);
		$strArray[] = $strAux;
		$strArray2[] = $strAux2;
	}
	// ---------------------------------------------------------------
?>

<?  // Account Search Javascript /////////////////////////////////////////////////////// ?>

<script type="text/javascript"
	src="<?=DEFAULT_URL?>/scripts/accountsearch.js"></script>

<?  //////////////////////////////////////////////////////////////////////////////////// ?>

<?  // Banner Javascript /////////////////////////////////////////////////////////////// ?>

<script language="javascript" src="<?=DEFAULT_URL?>/scripts/banner.js"></script>

<?  //////////////////////////////////////////////////////////////////////////////////// ?>

<script>
	function toogleTrans(obj) {
		if (obj.checked == true) {
			document.getElementById("trans_form").style.display = 'block';
		} else {
			document.getElementById("trans_form").style.display = 'none';
		}
	}
	function emptyDate(obj) {
		if (obj.value == "00/00/0000") {
			return true;
		} else {
			return false;
		}
	}
</script>

<? 
	echo "<div class=\"response-msg notice ui-corner-all\"><span>* ".system_showText(LANG_LABEL_REQUIRED_FIELD)." </div>";
	if($message) { ?>
<div class="response-msg success ui-corner-all"><span><?=$message?></span></div>
<? } ?>
	<? if($error_message) { ?>
<div class="response-msg error ui-corner-all"><span><?=$error_message?></span></div>
<? } ?>

<? // Account Search ////////////////////////////////////////////////////////////////// ?>
<? if (!$membros) { ?>
<?

	$acct_search_table_title = system_showText(LANG_SITEMGR_ACCOUNTSEARCH_SELECT)." ".system_showText(LANG_SITEMGR_BANNER);
	$acct_search_field_name = "account_id";
	$acct_search_field_value = $account_id;
	$acct_search_required_mark = false;
	$acct_search_form_width = "95%";
	$acct_search_cell_width = "";
	$return = system_generateAjaxAccountSearch($acct_search_table_title, $acct_search_field_name, $acct_search_field_value, $acct_search_required_mark, $acct_search_form_width, $acct_search_cell_width);
	echo $return;
	?>

<? } ?>

<? //////////////////////////////////////////////////////////////////////////////////// ?>
<table cellpadding="0" cellspacing="0" border="0" >
	<!-- <tr>
		<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_BANNER_TYPE);?></th>
	</tr> -->

		<? // ================== TYPE ==========================?>
		<tr>
		<!-- 	<th>* <?=system_showText(LANG_LABEL_TYPE);?>:</th> -->
			<?
        //    if(!isset($id) || ($id == null) || ($process == "signup")) {
                ?>
                 <td style="visibility:hidden"><?=$bannerTypeDropDown?></td>  
                <?
          //  } else {
                ?>
                <td>
                <!--     <?=$levelObj->showLevel($type)." (".$levelObj->getWidth($type)."px x ".$levelObj->getHeight($type)."px)"?> -->
                    <input type="hidden" name="type" value="<?=$type?>" />
		</td>
                <?
         //   }
            /*
			if (
				(
					(!$thisBannerObject) ||
					(($expiration_setting == BANNER_EXPIRATION_IMPRESSION) && ($impressions <= 0)) ||
					(($expiration_setting == BANNER_EXPIRATION_RENEWAL_DATE) && ($thisBannerObject) && ($thisBannerObject->needToCheckOut())) ||
                    ($url_base == DEFAULT_URL."/gerenciamento") ||
					(($thisBannerObject) && ($thisBannerObject->getPrice() <= 0)) ||
					(isset($type) && $levelObj->getPrice($type, $expiration_setting) == 0)
				)
				&&
				($process != "signup")
				) {
					?><td><?=$bannerTypeDropDown?></td><?
				}
			else
				{
					?>
					<td>
						<?=$levelObj->showLevel($type)." (".$levelObj->getWidth($type)."px x ".$levelObj->getHeight($type)."px)"?>
						<input type="hidden" name="type" value="<?=$type?>" />
					</td>
					<?
				}
            */
			?>
		</tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
	<tr>
		<th colspan="2" class="standard-tabletitle">Publica&#231;&#227;o</th>
	</tr>
	 <tr>
		<input type="hidden" name="expiration_setting" id="expiration_setting" value="<?=BANNER_EXPIRATION_RENEWAL_DATE?>" <?=((!$expiration_setting || $expiration_setting == BANNER_EXPIRATION_RENEWAL_DATE) ? "checked" : "" )?> onclick="bannerDisableImpressions()" class="inputRadio" />
		<td>In&#237;cio: <input type="text"
			name="start_date" id="start_date" value="<?=$start_date?>"
			<?=(($expiration_setting && $expiration_setting != BANNER_EXPIRATION_RENEWAL_DATE) ? "disabled=true" : "" )?>
			maxlength="10" style="width: 100px" />&nbsp;<a
			href="javascript:void(0);"
			onclick="if (emptyDate(document.getElementById('start_date'))) { document.getElementById('start_date').value=''; } cal_start_date.popup()"
			title="<?=system_showText("Clique aqui para selecionar a data da publica&#231;&#227;o do banner")?>"><img
			src="<?=DEFAULT_URL?>/images/calendar/cal.gif"
			alt="<?=system_showText(LANG_LABEL_CALENDAR);?>"
			title="<?=system_showText("Clique aqui para selecionar a data da publica&#231;&#227;o do banner")?>"
			border="0" class="iconAlign" /></a>&nbsp;<span class="warning"
			style="display: inline;"><?=format_printDateStandard()?></span>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fim:
		<input type="text" name="renewal_date" id="renewal_date"
			value="<?=$renewal_date?>"
			<?=(($expiration_setting && $expiration_setting != BANNER_EXPIRATION_RENEWAL_DATE) ? "disabled=true" : "" )?>
			maxlength="10" style="width: 100px" />&nbsp;<a
			href="javascript:void(0);"
			onclick="if (emptyDate(document.getElementById('renewal_date'))) { document.getElementById('renewal_date').value=''; } cal_renewal_date.popup()"
			title="<?=system_showText(LANG_SITEMGR_CLICKHERETOSELECTRENEWALDATE)?>"><img
			src="<?=DEFAULT_URL?>/images/calendar/cal.gif"
			alt="<?=system_showText(LANG_LABEL_CALENDAR);?>"
			title="<?=system_showText(LANG_SITEMGR_CLICKHERETOSELECTRENEWALDATE)?>"
			border="0" class="iconAlign" /></a>&nbsp;<span class="warning"
			style="display: inline;"><?=format_printDateStandard()?></span></td>
	</tr>



	</table>

<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
	<tr>
		<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_BANNER_DETAIL_PLURAL)?></th>
	</tr>
		<?
		$array_edir_languagenames = explode(",", EDIR_LANGUAGENAMES);
		for ($i=0; $i<count(explode(",", EDIR_LANGUAGES)); $i++) {
			$labelsuffix = "";
			if ($i) $labelsuffix = $i;
			?>
			<tr>
		<th style="vertical-align: top"><? if (!$i) echo "*"; ?> <?=system_showText(LANG_LABEL_CAPTION)?><?=((count(explode(",", EDIR_LANGUAGES))>1)?(" (".$array_edir_languagenames[$i]."):"):(":"));?></th>
		<td><input type="text" name="caption<?=$labelsuffix;?>"
			value="<?=${"caption".$labelsuffix}?>" class="input-form-banner"
			maxlength="25" /><span><?=system_showText(LANG_MSG_MAX_25_CHARS)?></span>
		</td>
	</tr>
			<?
		}
		?>
		<tr>
		<th><?=system_showText(LANG_SECTION);?>:</th><? /* SECTION */ ?>
			<td nowrap><input type="radio" name="section" value="general" checked="checked" 
			onclick="fillBannerCategorySelect('<?=DEFAULT_URL?>', this.form.category_id, this.value, this.form);"
			class="inputAlign" /> <?=system_showText("Home page");?>
				
				<input type="radio" name="section" value="all" disabled
			onclick="fillBannerCategorySelect('<?=DEFAULT_URL?>', this.form.category_id, this.value, this.form);"
			class="inputAlign" /> <?=system_showText("Resultado das pesquisas");?>
				 
				<input type="radio" name="section" value="listing" disabled
			<? if ($section == "listing") echo "checked=\"checked\""; ?>
			onclick="fillBannerCategorySelect('<?=DEFAULT_URL?>', this.form.category_id, this.value, this.form);"
			class="inputAlign" /> <?=system_showText("Estabelecimento");?>
			
			</td>
	</tr>
	<!-- <tr>
			<th><?=system_showText(LANG_LABEL_CATEGORY)?>:</th>
			<td>
				<?=$categoryDropDown?>
			</td>
		</tr> -->
	<tr>
		<th class="wrap">Abrir em uma nova janela?</th>
		<td>
		<div class="label-form"><input type="radio" name="target_window"
			value="1" <? if ($target_window == "1") echo "checked";?>
			class="inputAlign" /> <?=system_showText(LANG_NO);?>
					<input type="radio" name="target_window" value="2"
			<? if (($target_window == "2") || (!$target_window)) echo "checked";?>
			class="inputAlign" /> <?=system_showText(LANG_YES);?>
				</div>
		</td>
	</tr>
	<tr>
		<th style="vertical-align: top">URL Link:</th>
		<td><!-- <select name="destination_protocol" class="httpSelect">
					<?
					$url_protocols 	= explode(",", URL_PROTOCOL);
					$sufix = "://";
					for ($i=0; $i<count($url_protocols); $i++) {
						$selected = false;
						$protocol = $url_protocols[$i].$sufix;
						if ($destination_protocol) {
							if (trim($protocol) == trim($destination_protocol)) {
								$selected = true;
							}
						}
						?><option value="<?=$protocol?>"  <?=($selected==true  ? "selected=\"selected\"" : "")?> ><?=$protocol?></option><?
					}
					?>
				</select> --> <input style="width: 400px" type="text"
			name="destination_url" value="<?=$destination_url?>"
			class="input-form-banner" maxlength="500" /> <span><?=system_showText(LANG_MSG_MAX_500_CHARS)?></span>
		</td>
	</tr>
</table>

<!-- <table cellpadding="0" cellspacing="0" border="0" class="standard-table">
		<tr>
			<th style="vertical-align:top"><?=system_showText(LANG_SCRIPT_BANNER)?>:</th>
			<td><input type="checkbox" name="show_type" value="1" <?=($show_type=="1") ? "checked" : "";?> class="inputAlign" /><?=system_showText(LANG_SHOWSCRIPTCODE);?><span style="text-align: justify;"><?=system_showText(LANG_SCRIPTCODEHELP);?></span></td>
		</tr>
		<tr id="show_type_banner">
			<th style="vertical-align:top"><?=system_showText(LANG_LABEL_SCRIPT)?>:</th>
			<td>
				<textarea rows="4" cols="50" name="script" class="input-form-banner"><?=$script?></textarea> 
				<span></span>
			</td>
		</tr>
	</table> -->

<div id="banner_with_images">
		<?
		$array_edir_languagenames = explode(",", EDIR_LANGUAGENAMES);
		$array_edir_languages = explode(",", EDIR_LANGUAGES);
		for ($i=0; $i<count($array_edir_languages); $i++) {
			$labelsuffix = "";
			if ($i) $labelsuffix = $i;
			?>
			<table cellpadding="0" cellspacing="0" border="0"
	class="standard-table">
	<tr>
		<th style="vertical-align: top"><? if (!$i) echo "*"; ?> <?=system_showText(LANG_LABEL_FILE)?><?=((count(explode(",", EDIR_LANGUAGES))>1)?(" (".$array_edir_languagenames[$i]."):"):(":"));?></th>
		<td><input type="file" name="file<?=$labelsuffix;?>"
			class="input-form-banner" /> 
			<span>A imagem deve ter a dimensao 468 X 60.</span>
			<span><?=system_showText(LANG_MSG_MAX_FILE_SIZE)?> <?=UPLOAD_MAX_SIZE;?> MB.</span>
		<span><?=system_showText(LANG_MSG_ALLOWED_FILE_TYPES)?>: SWF, GIF, JPEG</span>
		<span><b><?=system_showText(LANG_LABEL_WARNING)?>:</b></span> <span><?=system_showText(LANG_BANNERFILEHELP);?></span>
		</td>
	</tr>
</table>
				<? if (${"image_id".$labelsuffix} > 0) { ?>
					<center>
<div style="margin-left: 170px"><a
	class="btn ui-state-default ui-corner-all" href="javascript:void(0);"
	onclick="javascript:window.open('<?=$url_base?>/banner/preview.php?id=<?=$id?>&lang=<?=$array_edir_languages[$i]?>', '', 'toolbar=0, location=0, directories=0, status=0, scrollbars=yes, width=800, height=400, screenX=0, screenY=0, menubar=0');"
	class="standardLINK"><?=system_showText(LANG_MSG_CLICK_TO_PREVIEW_THIS_BANNER);?>
					<span class="ui-icon ui-icon-circle-zoomin" /></span></a></div>
</center>
			
				<? } ?>
			
			<?
		}
		?>
	</div>

<div id="banner_with_text">
<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
	<tr>
		<th><?=system_showText(LANG_LABEL_DISPLAY_URL)?>:</th>
		<td><input type="text" name="display_url" value="<?=$display_url?>"
			class="input-form-banner" maxlength="30" /><span><?=system_showText(LANG_MSG_MAX_30_CHARS)?></span></td>
	</tr>
			<?
			$array_edir_languagenames = explode(",", EDIR_LANGUAGENAMES);
			for ($i=0; $i<count(explode(",", EDIR_LANGUAGES)); $i++) {
				$labelsuffix = "";
				if ($i) $labelsuffix = $i;
				?>
				<tr>
		<th><? if (!$i) echo "*"; ?> <?=system_showText(LANG_LABEL_DESCRIPTION_LINE1)?><?=((count(explode(",", EDIR_LANGUAGES))>1)?(" (".$array_edir_languagenames[$i]."):"):(":"));?></th>
		<td><input type="text" name="content_line1<?=$labelsuffix;?>"
			value="<?=${"content_line1".$labelsuffix}?>"
			class="input-form-banner" maxlength="30" /><span><?=system_showText(LANG_MSG_MAX_30_CHARS)?></span>
		</td>
	</tr>
	<tr>
		<th><? if (!$i) echo "*"; ?> <?=system_showText(LANG_LABEL_DESCRIPTION_LINE2)?><?=((count(explode(",", EDIR_LANGUAGES))>1)?(" (".$array_edir_languagenames[$i]."):"):(":"));?></th>
		<td><input type="text" name="content_line2<?=$labelsuffix;?>"
			value="<?=${"content_line2".$labelsuffix}?>"
			class="input-form-banner" maxlength="30" /><span><?=system_showText(LANG_MSG_MAX_30_CHARS)?></span></td>
	</tr>
				<?
			}
			?>
		</table>
</div>

<? if (PAYMENT_FEATURE == "on") { ?>
	<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
<!--  <table cellpadding="0" cellspacing="0" border="0" class="standard-table">
			<tr>
				<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
			</tr>
			<? if (
					(
						(!$thisBannerObject) ||
						(($expiration_setting == BANNER_EXPIRATION_IMPRESSION) && ($impressions <= 0)) ||
						(($expiration_setting == BANNER_EXPIRATION_RENEWAL_DATE) && ($thisBannerObject) && ($thisBannerObject->needToCheckOut())) ||
						($url_base == DEFAULT_URL."/gerenciamento") ||
						(($thisBannerObject) && ($thisBannerObject->getPrice() <= 0))
					)
					&&
					($process != "signup")
				) {
			?>
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
		</table> -->
<? } ?>
<? } ?>

<script language="javascript">
	var banner_tmp_form_images_content = document.getElementById("banner_with_images").innerHTML;
	var banner_tmp_form_text_content = document.getElementById("banner_with_text").innerHTML;
</script>

<script language="javascript">
	<?
	if ($type < 50)       echo "bannerDisableTextForm();";
	else if ($type >= 50) echo "bannerDisableImagesForm();";
	?>
</script>