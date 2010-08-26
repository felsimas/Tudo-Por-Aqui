<?
	$template_title_field = false;
	$template_address_field = false;
	$template_address2_field = false;
	if ($templateObj && $templateObj->getString("status")=="enabled") {
		$template_title_field = $templateObj->getListingTemplateFields("title");
		$template_address_field = $templateObj->getListingTemplateFields("address");
		$template_address2_field = $templateObj->getListingTemplateFields("address2");
	}

?>

<? // Other Listing Javascript without AJAX /////////////////////////////////////////// ?>
<script language="javascript" type="text/javascript" src="<?=DEFAULT_URL?>/scripts/common.js"></script>
<script language="javascript" type="text/javascript">

	function isInt(elm) {
		if (elm.value == "") {
			return false;
		}
		for (var i = 0; i < elm.value.length; i++) {
			if (elm.value.charAt(i) < "0" || elm.value.charAt(i) > "9") {
				return false;
			}
		}
		return true;
	}

	// ---------------------------------- //

	function verifyNewcity(id){
		if(document.listing.cidade_id.selectedIndex == 0)
			hideNewcity(id);
	}
	
	// ---------------------------------- //

	function showNewcity(id){
		document.listing.bairro_id.options[0].selected = true;
		obj = document.getElementById(id);
		if (document.listing.cidade_id.value != "")	obj.style.display = '';
		else alert("<?=system_showText(LANG_MSG_SELECT_STATE_FIRST);?>");
	}

	// ---------------------------------- //

	function hideNewcity(id){
		obj = document.getElementById(id); 
		document.listing.newcity.value = "";
		obj.style.display = 'none';
	}

	// ---------------------------------- //

		function JS_addCategory(text, id) {
			
		seed = document.listing.seed;
		feed = document.listing.feed;
		
		var flag=true;
		for (i=0;i<feed.length;i++)
			if (feed.options[i].value==id)
				flag=false;
		
		
		if(text && id && flag){
			feed.options[feed.length] = new Option(text, id);
			alert("<?=system_showText(LANG_LABEL_CATEGORY);?> '"+text+"' <?=system_showText(LANG_MSG_CATEGORY_SUCCESSFULLY_ADDED)?>");
		} else {
			if (!flag) alert("<?=system_showText(LANG_MSG_CATEGORY_ALREADY_INSERTED)?>");
			else alert("<?=system_showText(LANG_MSG_SELECT_VALID_CATEGORY)?>");
		}
	}

	// ---------------------------------- //
	
	function JS_removeCategory() {
		feed = document.listing.feed;
		if (feed.selectedIndex >= 0) feed.remove(feed.selectedIndex);
	}
	
	// ---------------------------------- //

	function JS_displayCategoryPath() {
		feed = document.listing.feed;

		if(feed.selectedIndex == -1) {
			alert("<?=system_showText(LANG_MSG_SELECT_CATEGORY_FIRST);?>");
		} else {
			var winl = (((screen.width) / 2) - 350);
			var wint = (((screen.height) / 2) - 150);
			var winprop = 'titlebar=no, toolbar=no, location=no, directories=no, status=no, width=700, height=150, left='+winl+', top='+wint+', menubar=no, scrollbars=yes, resizable=yes';
			window.open("../listing/category_detail.php?id="+feed.options[feed.selectedIndex].value, "popup", winprop);
		}

		return;

	}

	// ---------------------------------- //

	function JS_submit() {

		feed = document.listing.feed;
		return_categories = document.listing.return_categories;
		if(return_categories.value.length > 0) return_categories.value="";

		for (i=0;i<feed.length;i++) {
			if (!isNaN(feed.options[i].value)) {
				if(return_categories.value.length > 0)
				return_categories.value = return_categories.value + "," + feed.options[i].value;
				else
			return_categories.value = return_categories.value + feed.options[i].value;
			}
		}

		document.listing.submit();
	}
</script>
<? //////////////////////////////////////////////////////////////////////////////////// ?>

<? // Account Search Javascript /////////////////////////////////////////////////////// ?>

<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/accountsearch.js"></script>

<? //////////////////////////////////////////////////////////////////////////////////// ?>

<div class="response-msg notice ui-corner-all">* <?=system_showText(LANG_LABEL_REQUIRED_FIELD)?></div>
<?
if ($message_listing) { 
	echo "<div class='response-msg error ui-corner-all'>";
	echo $message_listing;
	echo "</div>";
}
?>
<? // Display Level ////////////////////////////////////////////////////////////////// ?>
<?php

$template_name = "Default";
$level_name = "";
if ($listingtemplate_id) {
	$templateObj = new ListingTemplate($listingtemplate_id);
	if ($templateObj->getString("title") != "") {
		$template_name = $templateObj->getString("title");
	}
}

if ($level) {
	$levelObjTMP = new ListingLevel();
	$level_name = $levelObjTMP->getName($level);
}

?>
<table class="levelTable">
	<tr>
		<th class="levelTitle"><?=system_showText(LANG_LISTING_LEVEL)?></th>
		<? if (LISTINGTEMPLATE_FEATURE == "on") { ?>
			<!--<td class="levelTopdetail" width="50%">&nbsp;<?=system_showText(LANG_LISTING_TEMPLATE)?></td> -->
		<? } ?>
	</tr>
	<tr>
		<th class="tableSelectedOption"><?=ucfirst($level_name); ?></th>
		<? if (LISTINGTEMPLATE_FEATURE == "on") { ?>
			<!-- <th class="tableSelectedOption"><?=$template_name;?></th> -->
		<? } ?>
	</tr>
</table>

<? // Account Search ////////////////////////////////////////////////////////////////// ?>
<? if (!$membros) { ?>

	<table cellpadding="0" cellspacing="0" border="0" class="standard-table" style="margin-bottom: 0;">
		<tr>
			<th colspan="2" class="standard-tabletitle"><?=system_showText("Respons&#225;vel")?> <span><?=system_showText("Para alterar o respons&#225;vel clique em seu nome")?></span></th>
		</tr>
	</table>

	<?
    $acct_search_table_title = system_showText(LANG_SITEMGR_ACCOUNTSEARCH_SELECT)." ".system_showText(LANG_SITEMGR_LISTING);
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
<!--
<? if ((!$membros) && (CLAIM_FEATURE == "on")) { ?>
	<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
		<tr>
			<th><input type="checkbox" name="claim_disable" value="y" <? if ($claim_disable == "y") { echo "checked"; } ?> class="inputCheck" /></th>
			<td><?=system_showText(LANG_SITEMGR_ACCOUNTSEARCH_DISABLECLAIM)?></td>
		</tr>
	</table>
<? } ?> !-->

<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
	<tr>
		<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_LABEL_INFORMATION)?></th>
	</tr>
	<tr>
		<th style="width:200px" class="wrap">
			<?
			if (LISTINGTEMPLATE_FEATURE == "on") {
				echo "* ".(($template_title_field!==false) ? $template_title_field[0]["label"] : "".system_showText("Nome da empresa")).":";
			} else {
				echo "* ".system_showText("Nome&nbsp;da&nbsp;Empresa").":";
			}
			?>
		</th>
		<td>
			<input type="text" style="width:400px" name="title" value="<?=$title?>" maxlength="100" onBlur="easyFriendlyUrl(this.value, 'friendly_url', '<?=FRIENDLYURL_VALIDCHARS?>', '<?=FRIENDLYURL_SEPARATOR?>');" />
			<input type="hidden" name="friendly_url" id="friendly_url" value="<?=$friendly_url?>" maxlength="150" />
			<?
			if (LISTINGTEMPLATE_FEATURE == "on") {
				echo (($template_title_field!==false) ? "<span>".$template_title_field[0]["instructions"]."</span>" : "");
			}
			?>
		</td>
	</tr>
	<? if ($level > "10") { ?>
        <tr>
			<th style="width:200px">CPF ou CNPJ :</th>
			<td><input style="width:400px" type="text" name="cnpj" value="<?=$cnpj?>" maxlength="50" /></td>
		</tr>
		<tr>
			<th style="width:200px"><?=system_showText(LANG_LABEL_EMAIL)?>:</th>
			<td><input style="width:400px" type="text" name="email" value="<?=$email?>" maxlength="50" /></td>
		</tr>
		<tr>
			<th style="width:2000px">Website:</th>
			<td>
		<!-- 	<select name="url_protocol" class="httpSelect">
			<?
			$url_protocols = explode(",", URL_PROTOCOL);
			$sufix = "://";
			$protocol_replace = "" ;
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
			</select> -->
			<input type="text" style="width:400px" name="url" value="<?=str_replace($protocol_replace, "", $url)?>" maxlength="255" />
			</td>
		</tr>
	<!-- <tr>
			<th><?=system_showText(LANG_LABEL_DISPLAY_URL)?>:</th>
			<td><input type="text" name="display_url" value="<?=$display_url?>" maxlength="255" /></td>
		</tr>  -->	
	<? } ?>
	<tr>
		<th style="width:200px"><?=system_showText("Telefone")?>:</th>
		<td><input style="width:200px" type="text" name="phone" value="<?=$phone?>" /></td>
	</tr>
    <tr>
		<th style="width:2000px"><?=system_showText("Telefone 2")?>:</th>
		<td><input style="width:200px" type="text" name="phone2" value="<?=$phone2?>" /></td>
	</tr>
	<tr>
		<th style="width:200px"><?=system_showText("Celular")?>:</th>
		<td><input style="width:200px" type="text" name="celular" value="<?=$celular?>" /></td>
	</tr>

		<tr>
			<th style="width:200px"><?=system_showText(LANG_LABEL_FAX)?>:</th>
			<td><input style="width:200px" type="text" name="fax" value="<?=$fax?>" /></td>
		</tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
	<tr>
		<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_LABEL_LOCATIONS)?></th>
	</tr>
	<tr>
		<th style="width:200px" class="wrap">
			<?
			if (LISTINGTEMPLATE_FEATURE == "on") {
				echo (($template_address_field!==false) ? $template_address_field[0]["label"] : system_showText(LANG_LABEL_ADDRESS1)).":";
			} else {
				echo system_showText(LANG_LABEL_ADDRESS1).":";
			}
			?>
			<br /><br />
		</th>
		<td>
			<input style="width:400px" type="text" name="address" value="<?=$address?>" maxlength="50" />
			<span>
				<?
				if (LISTINGTEMPLATE_FEATURE == "on") {
					echo (($template_address_field!==false) ? $template_address_field[0]["instructions"] : system_showText(LANG_ADDRESS_EXAMPLE));
				} else {
					echo system_showText(LANG_ADDRESS_EXAMPLE);
				}
				?>
			</span>
		</td>
	</tr>
	<tr>
		<th style="width:2000px" class="wrap">
			<?
			if (LISTINGTEMPLATE_FEATURE == "on") {
				echo (($template_address2_field!==false) ? $template_address2_field[0]["label"] : system_showText(LANG_LABEL_ADDRESS2)).":";
			} else {
				echo system_showText(LANG_LABEL_ADDRESS2).":";
			}
			?>
			<br /><br />
		</th>
		<td>
			<input  type="text" name="address2" value="<?=$address2?>" maxlength="50" />
			<span>
				<?
				if (LISTINGTEMPLATE_FEATURE == "on") {
					echo (($template_address2_field!==false) ? "<span>".$template_address2_field[0]["instructions"]."</span>" : system_showText(LANG_ADDRESS2_EXAMPLE));
				} else {
					echo system_showText(LANG_ADDRESS2_EXAMPLE);
				}
				?>
			</span>
		</td>
	</tr>
	<tr>
		<th style="width:200px">Estado:</th>
		<td>
			<select name="estado_id" id="estado_id" OnChange="fillSelect('<?=DEFAULT_URL?>', this.form.cidade_id, this.value, this.form);" onblur="verifyNewcity('newcity');">
				<option value="">Selecione um Estado</option>
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
		<th style="width:200px">Cidade:</th>
		<td>
			<select name="cidade_id" id="cidade_id" OnChange="fillSelect('<?=DEFAULT_URL?>', this.form.bairro_id, this.value, this.form);" onblur="verifyNewcity('newcity');">
				<option value="">Selecione uma Cidade</option>
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
		<th style="width:200px">Bairro:</th>
		<td>
			<select name="bairro_id" id="bairro_id" onclick="hideNewcity('newcity');">
				<option value="">Selecione um bairro</option>
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
<!--  	<tr>
		<th colspan="2" align="center" style="padding-left:90px; width:auto; text-align:center;">
			<a href="javascript:void(0);" onclick="showNewcity('newcity');" style=" cursor: pointer"><?=system_showText("Clique aqui se voce não encontrou seu bairro.")?></a>
		</th>
	</tr>
	<tr>
		<td colspan="2" style="width:auto; margin: 0px; padding: 0px;">
			<div style="display:none" id="newcity">
			<table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin: 0; padding: 0">
				<tr>
					<th style="width:200px">Novo bairro:</th>
					<td class="innerCell">
						<input style="width:400px" type="text" name="newcity" onBlur="easyFriendlyUrl(this.value, 'newcity_friendly_url', '<?=FRIENDLYURL_VALIDCHARS?>', '<?=FRIENDLYURL_SEPARATOR?>');" />
						<input type="hidden" name="newcity_friendly_url" id="newcity_friendly_url" value="<?=$newcity_friendly_url?>" />
					</td>
				</tr>
			</table>
			</div>
		</td>
	</tr>-->
	<tr>
		<th style="width:200px"><?=ucwords(ZIPCODE_LABEL)?>:</th>
		<td><input  style="width:200px" type="text" name="zip_code" value="<?=$zip_code?>" maxlength="10" /></td>
	</tr>
</table>



	<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
		<tr>
			<th colspan="3" class="standard-tabletitle"><?=system_showText("Logo")?> <span>(<?="140"?>px x <?="140"?>px) (JPG <?=system_showText(LANG_OR);?> GIF)</span></th>
		</tr>
		<tr>
			<td colspan="3" class="standard-tabletitle"><span><?=system_showText(LANG_MSG_ADDITIONAL_IMAGES_MAY_BE_ADDED);?> <img src="<?=DEFAULT_URL?>/images/icon_gallery.gif" border="0" alt="<?=system_showText(LANG_LABEL_GALLERY);?>" title="<?=system_showText(LANG_LABEL_GALLERY);?>" /> <?=system_showText(LANG_MSG_ADDITIONAL_IMAGES_IF_ENABLED);?><span></td>
		</tr>
		<tr>
		<?
			if ($thumb_id) {
				$imageObj = new Image($thumb_id);
				if ($imageObj->imageExists()) {
					echo "<th class=\"imageSpace\">";
					echo $imageObj->getTag(true, 140, 140, $title);
					echo "</th>";
				} else {
					echo "<th class=\"imageSpace\" style=\"width: 140px;\">";
					echo "&nbsp;";
					echo "</th>";
				}
			}
			?>
			<th class="alignTop"><?=system_showText(LANG_LABEL_IMAGE_SOURCE)?>:</th>
			<td>
				<input type="file" name="image" size="50" /><span><?=system_showText(LANG_MSG_MAX_FILE_SIZE)?> <?=UPLOAD_MAX_SIZE;?> MB. <?=system_showText(LANG_MSG_TRANSPARENTGIF_NOT_SUPPORTED)?></span>
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
				<?=system_showText(LANG_LABEL_VIDEO_SNIPPET_CODE)?>
				<span style="display: block; white-space: normal;">(<?=system_showText(LANG_MSG_VIDEO_SNIPPET_CODE)?>)</span>
			</th>
		</tr>
		<tr>
			<th class="alignTop"><?=system_showText(LANG_LABEL_CODE)?>:</th>
			<td>
				<input type="text" name="video_snippet" value="<?=$video_snippet?>" class="inputExplode" />
				<span><?=system_showText(LANG_MSG_MAX_VIDEO_CODE_SIZE);?>: <?=IMAGE_LISTING_FULL_WIDTH?>px x <?=IMAGE_LISTING_FULL_HEIGHT?>px.<br /><?=system_showText(LANG_MSG_VIDEO_MODIFIED);?></span><br>
			</td>
		</tr>
	</table> 



	<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
		<tr>
			<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_LABEL_ATTACH_ADDITIONAL_FILE)?> <span>(PDF, DOC, TXT, JPG <?=system_showText(LANG_OR);?> GIF)</span></th>
		</tr>
		<?
		if ($listing->getString("attachment_file")) {
			if (file_exists(EXTRAFILE_DIR."/".$listing->getString("attachment_file"))) {
				?>
				<tr>
					<td colspan="2">
		
						<a href="<?=EXTRAFILE_URL?>/<?=$listing->getString("attachment_file")?>" style="text-decoration: underline;" target="_blank">
							<?
							if ($listing->getString("attachment_caption")) {
								echo $listing->getString("attachment_caption");
							} else {
								echo system_showText(LANG_MSG_ATTACHMENT_HAS_NO_CAPTION);
							}
							?>
						</a>
						<br /><input type="checkbox" name="remove_attachment" value="1" class="inputCheck"/> <?=system_showText(LANG_MSG_CLICK_TO_REMOVE_ATTACHMENT);?>
					</td>
				</tr>
				<?
			}
		}
		?>
		<tr>
			<th class="alignTop"><?=system_showText(LANG_LABEL_SOURCE)?>:</th>
			<td>
				<input type="file" name="attachment_file" size="50" /><span><?=system_showText(LANG_MSG_MAX_FILE_SIZE)?> <?=UPLOAD_MAX_SIZE;?> MB</span>
			</td>
		</tr>
		<tr>
			<th><?=system_showText(LANG_LABEL_CAPTION)?>:</th>
			<td>
				<input type="text" maxlength="250" name="attachment_caption" value="<?=$attachment_caption?>" />
			</td>
		</tr>
	</table>


<!-- <table cellpadding="0" cellspacing="0" border="0" class="standard-table">
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
				<textarea name="description<?=$labelsuffix;?>" rows="5" onKeyDown="textCounter(this.form.description<?=$labelsuffix;?>,this.form.remLen<?=$labelsuffix;?>,250);" onKeyUp="textCounter(this.form.description<?=$labelsuffix;?>,this.form.remLen<?=$labelsuffix;?>,250);"><?=${"description".$labelsuffix};?></textarea>
				<? $total = strlen(html_entity_decode(${"description".$labelsuffix})); ?>
				<span><input readonly type="text" name="remLen<?=$labelsuffix;?>" size="3" maxlength="3" value="<?=250-$total?>" class="textcounter" /> <?=system_showText(LANG_MSG_CHARS_LEFT)?> <?=system_showText(LANG_MSG_INCLUDING_SPACES_LINE_BREAKS)?></span>
			</td>
		</tr>
		<?
	}
	?>
</table> -->


<table cellpadding="0" cellspacing="0" border="0"  style="margin-left:16px" width="610px">
		<tr>
			<th colspan="3" style="width: auto; font: bold 12px Verdana, Arial, Verdana, Helvetica, sans-serif Arial, Helvetica, sans-serif; color: #235; text-align: left; padding-top: 20px; padding-left: 8px; background: url(../../images/design/bullet_orderTitle.gif) 0 24px no-repeat; border: 0; border-bottom: 1px solid #EEE;"><?=system_showText(LANG_LABEL_DESCRIPTION)?></th>
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
				<textarea class="ckeditor" cols="80" name="long_description<?=$labelsuffix;?>" rows="150"><?=$long_description;?></textarea>
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

<? if($level==70) { ?>
	<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
		<tr>
			<th class="standard-tabletitle">
				<?=system_showText(LANG_LABEL_HOURS_OF_WORK)?>
			</th>
		</tr>
		<tr>
			<td class="standard-tableContent">
				<table border="0" cellpadding="0" cellspacing="0" align="center">
					<tr>
						<th><?=system_showText(LANG_MSG_PHRASE_PER_LINE)?>:</th>
						<td>
							<?=system_showText(LANG_HOURWORK_SAMPLE_1);?><br />
							<?=system_showText(LANG_HOURWORK_SAMPLE_2);?><br />
							<?=system_showText(LANG_HOURWORK_SAMPLE_3);?><br />
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td style="width: auto;">
				<textarea name="hours_work" rows="5"><?=$hours_work?></textarea>
			</td>
		</tr>
	</table>
	<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
			<tr>
				<th class="standard-tabletitle">
					<?=system_showText(LANG_LABEL_LOCATIONS)?>
				</th>
			</tr>
			<tr>
				<td style="width: auto;">
					<textarea name="locations" rows="5"><?=$locations?></textarea>
				</td>
			</tr>
	</table>
<? } ?>

<?
if (LISTINGTEMPLATE_FEATURE == "on") {
	include(INCLUDES_DIR."/forms/form_listing_extra_fields.php");
}
?>

<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
	<tr>
		<th colspan="2" class="standard-tabletitle">
			<?=system_showText(LANG_CATEGORIES_SUBCATEGS)?>
			<?
			if (((!$listing->getNumber("id")) || (($listing) && ($listing->needToCheckOut())) || (strpos($url_base, "/gerenciamento")) || (($listing) && ($listing->getPrice() <= 0))) && ($process != "signup")) {
				$listingLevelObj = new ListingLevel();
				?><span><br>Seu plano mensal tem direito a escolher <?=$listingLevelObj->getFreeCategory($level)?> categoria. <br>Categorias extras ter&#227;o um custo adicional de <?=CURRENCY_SYMBOL?> <?=$listingLevelObj->getCategoryPrice($level)?></strong>.<br>
				Quanto mais categorias adicionadas, maior a chance da empresa aparecer nas pesquisas.</span> <?
			}
			?>
		</th>
	</tr>
	<tr>
		<td colspan="2" class="standard-tableContent">
			<p class="warningBOXtext"><?=system_showText(LANG_MSG_ONLY_SELECT_SUBCATEGS)?><br /><?=system_showText(LANG_MSG_LISTING_AUTOMATICALLY_APPEAR)?></p>
		</td>
	</tr>
	<? if (((!$listing->getNumber("id")) || (($listing) && ($listing->needToCheckOut())) || (strpos($url_base, "/gerenciamento")) || (($listing) && ($listing->getPrice() <= 0))) && ($process != "signup")) { ?>
		<input type="hidden" name="return_categories" value="">
		<tr>
			<td colspan="2" class="treeView">
				<ul id="listing_categorytree_id_0" class="categoryTreeview">&nbsp;</ul>
				<table width="100%" border="0" cellpadding="2" class="tableCategoriesADDED" cellspacing="0">
					<tr>
						<th colspan="2" class="tableCategoriesTITLE alignLeft"><strong><?=system_showText(LANG_LISTING_CATEGORIES);?>:</strong></th>
					</tr>
					<tr>
						<td colspan="2" class="tableCategoriesCONTENT"><?=$feedDropDown?></td>
					</tr>
					
				</table>
				<table>
				<tr>
						<td class="tableCategoriesBUTTONS" colspan="2">	
							
					<!-- <button class="ui-state-default ui-corner-all" type="button" value="<?=system_showText(LANG_BUTTON_VIEWCATEGORYPATH)?>" onclick="JS_displayCategoryPath();"><?=system_showText(LANG_BUTTON_VIEWCATEGORYPATH)?></button> -->
								<button class="ui-state-default ui-corner-all" type="button" value="<?=system_showText(LANG_BUTTON_REMOVESELECTEDCATEGORY)?>" onclick="JS_removeCategory();"><?=system_showText(LANG_BUTTON_REMOVESELECTEDCATEGORY)?></button>
							
						</td>
					</tr>
				</table>
			</td>
		</tr>
	<? } else { ?>
		<input type="hidden" name="return_categories" value="" />
		<tr>
			<td colspan="2" class="treeView">
				<table width="100%" border="0" cellpadding="2" class="tableCategoriesADDED" cellspacing="0">
					<tr>
						<th colspan="2" class="tableCategoriesTITLE alignLeft" style="text-align:left;"><strong><?=system_showText(LANG_LISTING_CATEGORIES);?>:</strong></th>
					</tr>
					<tr>
						<td colspan="2" class="tableCategoriesCONTENT"><?=$feedDropDown?></td>
					</tr>
					<!-- <tr>
						<td class="tableCategoriesBUTTONS" colspan="2">
							<center>
									<button type="button" class="ui-state-default ui-corner-all"  value="<?=system_showText(LANG_BUTTON_VIEWCATEGORYPATH)?>" onclick="JS_displayCategoryPath();"><?=system_showText(LANG_BUTTON_VIEWCATEGORYPATH)?></button>
							</center>
						</td>
					</tr> -->
				</table>
			</td>
		</tr>
	<? } ?>
</table>

<? if (($level == "50") || ($level == "70")) { ?>
	<? if($editorChoices) { ?>
		<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
			<tr>
				<th colspan="4" class="standard-tabletitle"><?=system_showText(LANG_LISTING_DESIGNATION_PLURAL);?></th>
			</tr>
			<tr>
				<td colspan="4" class="standard-tableContent">
					<?=system_showText(LANG_MSG_REQUEST_YOUR_LISTING);?><br/>
					<?=system_showText(LANG_LISTING_SUBJECTTOAPPROVAL);?>
				</td>
			</tr>
			<tr>
				<td colspan="4" style="width: auto;">
				
					<table align="center" cellpadding="0" cellspacing="0" style="margin: 0 auto 0 auto;">
						<?
						foreach($editorChoices as $editor) { 
							$listingChoiceObj = new ListingChoice($editor->getNumber("id"), $id);
						?>
							<tr>
								<th style="font-weight: bold; background: none;"><?=$editor->getString("name")?></th>
								<td style="width: auto;">
									<?
									$imageObj = new Image($editor->getNumber("image_id"));
									if ($imageObj->imageExists()) {
										echo $imageObj->getTag(true, IMAGE_DESIGNATION_WIDTH, IMAGE_DESIGNATION_HEIGHT, $editor->getString("name"));
									}
									?>
								</td>
								<?
								$checkedStr = "";
								if ($_SERVER['REQUEST_METHOD'] == "POST") {
									if ($_POST["choice"]) {
										if (in_array($editor->getNumber("id"), $_POST["choice"])) {
											$checkedStr = "checked";
										}
									}
								} elseif ($listingChoiceObj->getNumber("listing_id")) {
									$checkedStr = "checked";
								}
								?>
								<td style="width: auto"><input type="checkbox" name="choice[]" <?=$checkedStr?> class="inputCheck" value="<?=$editor->getNumber("id")?>" /></td>
								<td style="width: auto"><?=system_showText(LANG_LISTING_SELECT_THIS_CHOICE);?></td>
							</tr>
						<? } ?>
					</table>
				
				</td>
			</tr>
		</table>
	<? } ?>
<? } ?>

<? if (PAYMENT_FEATURE == "on") { ?>
	<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
	<!--  	<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
			<tr>
				<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
			</tr>
			<? if (((!$listing->getNumber("id")) || (($listing) && ($listing->needToCheckOut())) || (strpos($url_base, "/gerenciamento")) || (($listing) && ($listing->getPrice() <= 0))) && ($process != "signup")) { ?>
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

<? if (((!$listing->getNumber("id")) || (($listing) && ($listing->needToCheckOut())) || (strpos($url_base, "/gerenciamento")) || (($listing) && ($listing->getPrice() <= 0))) && ($process != "signup")) { ?>
	<script language="javascript" type="text/javascript" src="<?=DEFAULT_URL?>/scripts/categorytree.js"></script>
	<script language="javascript" type="text/javascript">
		<? if ($listingtemplate_id) { ?>
			loadCategoryTree('template', 'listing_', 'ListingCategory', 0, <?=$listingtemplate_id?>, '<?=EDIRECTORY_FOLDER?>');
		<? } else { ?>
			loadCategoryTree('all', 'listing_', 'ListingCategory', 0, 0, '<?=EDIRECTORY_FOLDER?>');
		<? } ?>
	</script>
<? } ?>
