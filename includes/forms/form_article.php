<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_article.php
	# ----------------------------------------------------------------------------------------------------

?>

<script language="javascript" type="text/javascript" src="<?=DEFAULT_URL?>/scripts/common.js"></script>

<script language="javascript" type="text/javascript">

	function JS_addCategory(text, id) {

		seed = document.article.seed;
		feed = document.article.feed;
		
		var flag=true;
		for (i=0;i<feed.length;i++) if (feed.options[i].value==id) flag=false;

		if(text && id && flag){
			feed.options[feed.length] = new Option(text, id);
			alert("<?=system_showText(LANG_LABEL_CATEGORY)?> '"+text+"' <?=system_showText(LANG_MSG_CATEGORY_SUCCESSFULLY_ADDED)?>");
		} else {
			if (!flag) alert("<?=system_showText(LANG_MSG_CATEGORY_ALREADY_INSERTED)?>");
			else alert("<?=system_showText(LANG_MSG_SELECT_VALID_CATEGORY)?>");
		}

	}

	// ---------------------------------- //

	function JS_removeCategory() {
		feed = document.article.feed;
		if (feed.selectedIndex >= 0) feed.remove(feed.selectedIndex);
	}

	// ---------------------------------- //

	function JS_displayCategoryPath() {

		feed = document.article.feed;

		if (feed.selectedIndex == -1) {
			alert("<?=system_showText(LANG_MSG_SELECT_CATEGORY_FIRST);?>");
		} else {
			var winl = (((screen.width) / 2) - 350);
			var wint = (((screen.height) / 2) - 150);
			var winprop = 'titlebar=no, toolbar=no, location=no, directories=no, status=no, width=700, height=150, left='+winl+', top='+wint+', menubar=no, scrollbars=yes, resizable=yes';
			window.open("../article/category_detail.php?id="+feed.options[feed.selectedIndex].value, "popup", winprop);
		}

		return;

	}

	// ---------------------------------- //

	function JS_submit() {

		feed = document.article.feed;
		return_categories = document.article.return_categories;
		if(return_categories.value.length > 0) return_categories.value="";

		for (i=0;i<feed.length;i++) {
			if (!isNaN(feed.options[i].value)) {
				if(return_categories.value.length > 0)
				return_categories.value = return_categories.value + "," + feed.options[i].value;
				else
			return_categories.value = return_categories.value + feed.options[i].value;
			}
		}

		document.article.submit();
	}

</script>

<? // Account Search Javascript /////////////////////////////////////////////////////// ?>
<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/accountsearch.js"></script>
<? //////////////////////////////////////////////////////////////////////////////////// ?>


<div class="response-msg inf ui-corner-all">* <?=system_showText(LANG_LABEL_REQUIRED_FIELD)?> </div>

<?
if ($message_article) {
	echo "<p class=\"errorMessage\">";
		echo $message_article;
	echo "</p>";
}
?>
<? // Account Search ////////////////////////////////////////////////////////////////// ?>
<? if (!$membros) { ?>

	<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
		<tr>
			<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_LABEL_ACCOUNT)?> <span><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_TOACCOUNT_SPAN)?></span></th>
		</tr>
	</table>

	<?
	$acct_search_table_title = system_showText(LANG_SITEMGR_ACCOUNTSEARCH_SELECT)." ".system_showText(LANG_SITEMGR_ARTICLE);
	$acct_search_field_name = "account_id";
	$acct_search_field_value = $account_id;
	$acct_search_required_mark = false;
	$acct_search_form_width = "95%";
	$acct_search_cell_width = "";
	$return = system_generateAjaxAccountSearch($acct_search_table_title, $acct_search_field_name, $acct_search_field_value, $acct_search_required_mark, $acct_search_form_width, $acct_search_cell_width, $acct_search_cell_width);
	echo $return;
	?>

<? } ?>
<? //////////////////////////////////////////////////////////////////////////////////// ?>

<table border="0" cellpadding="0" cellspacing="0" class="standard-table">
	<tr>
		<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_LABEL_INFORMATION);?></th>
	</tr>
	<tr>
		<th class="tableOption" colspan="2"><a href="<?=NON_SECURE_URL?>/advertise.php?article" target="_blank"><?=system_showText(LANG_ARTICLE_OPTIONS);?></a></th>
	</tr>
	<tr>
		<th>* <?=system_showText(LANG_ARTICLE_TITLE);?>:</th>
		<td>
			<input type="text" name="title" value="<?=$title?>" maxlength="100" onBlur="easyFriendlyUrl(this.value, 'friendly_url', '<?=FRIENDLYURL_VALIDCHARS?>', '<?=FRIENDLYURL_SEPARATOR?>');" />
			<input type="hidden" name="friendly_url" id="friendly_url" value="<?=$friendly_url?>" maxlength="150" />
		</td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_ARTICLE_AUTHOR);?>:</th>
		<td><input type="text" name="author" value="<?=$author?>" maxlength="100" /></td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_ARTICLE_AUTHOR_URL);?>:</th>
		<td>
		<select name="author_url_protocol" class="httpSelect">
			<?
			$url_protocols 	= explode(",", URL_PROTOCOL);
			$sufix   			= "://";
			$protocol_replace 	= "" ;
			for ($i=0; $i<count($url_protocols); $i++) {
				$selected = false;
				$protocol = $url_protocols[$i];
				if (isset($author_url) || isset($author_url_protocol)) {
					if ($author_url && !$author_url_protocol) {
						$_protocol = explode($sufix, $author_url);
						$_protocol = $_protocol[0];
					} else if ($author_url_protocol) {
						$_protocol = str_replace($sufix, "", $author_url_protocol);
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
		<input type="text" style="width:425px" name="author_url" value="<?=str_replace($protocol_replace, "", $author_url)?>" maxlength="255" />
		</td>
	</tr>
	<tr>
		<th class="alignTop"><?=system_showText(LANG_LABEL_PUBLICATION_DATE);?>:</th>
		<td><input type="text" name="publication_date" value="<?=$publication_date?>" style="width:80px;" /><a href="javascript:cal_start.popup();" title="Click here to select start date"><img src="<?=DEFAULT_URL?>/images/calendar/cal.gif" alt="<?=system_showText(LANG_LABEL_CALENDAR);?>" title="<?=system_showText(LANG_LABEL_CALENDAR);?>" border="0" class="iconAlign" /></a> <span>(<?=format_printDateStandard()?>)</span></td>
	</tr>
</table>

<table border="0" cellpadding="0" cellspacing="0" class="standard-table">

	<tr>
		<th colspan="3" class="standard-tabletitle"><?=system_showText(LANG_LABEL_IMAGE)?> <span>(<?=IMAGE_ARTICLE_FULL_WIDTH?>px x <?=IMAGE_ARTICLE_FULL_HEIGHT?>px) (JPG <?=system_showText(LANG_OR);?> GIF)</span></th>
	</tr>
	
	<tr>
		<td colspan="3" class="standard-tabletitle"><span><?=system_showText(LANG_MSG_ADDITIONAL_IMAGES_MAY_BE_ADDED);?> <img src="<?=DEFAULT_URL?>/images/icon_gallery.gif" border="0" alt="gallery" title="gallery" /> <?=system_showText(LANG_MSG_ADDITIONAL_IMAGES_IF_ENABLED);?><span></td>
	</tr>
	
	<tr>
		<?
		if ($thumb_id) {
			$imageObj = new Image($thumb_id);
			if ($imageObj->imageExists()) {
				echo "<th class=\"imageSpace\">";
				echo $imageObj->getTag(true, IMAGE_ARTICLE_THUMB_WIDTH, IMAGE_ARTICLE_THUMB_HEIGHT, $title);
				echo "</th>";
			} else {
				echo "<th class=\"imageSpace\" style=\"width: ".IMAGE_ARTICLE_THUMB_WIDTH."px;\">";
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
	
	<tr>
		<th><?=system_showText(LANG_LABEL_IMAGE_ATTRIBUTE);?>:</th>
		<td colspan="3"><input type="text" name="image_attribute" value="<?=$image_attribute?>" maxlength="100" /></td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_LABEL_IMAGE_CAPTION);?>:</th>
		<td colspan="3"><input type="text" name="image_caption" value="<?=$image_caption?>" maxlength="255" /></td>
	</tr>
	<? if ($thumb_id) { ?>
		<tr>
			<th><input type="checkbox" name="remove_image" value="1" class="inputCheck" /></th>
			<td colspan="2" align="center"><?=system_showText(LANG_MSG_CHECK_TO_REMOVE_IMAGE)?></td>
		</tr>
	<? } ?>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
	<tr>
		<th colspan="2" class="standard-tabletitle">
			* <?=system_showText(LANG_LABEL_ABSTRACT)?> <span>(<?=strtolower(system_showText(LANG_MSG_MAX_250_CHARS))?>)</span>
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
				<textarea name="abstract<?=$labelsuffix;?>" rows="5" onKeyDown="textCounter(this.form.abstract<?=$labelsuffix;?>,this.form.remLen<?=$labelsuffix;?>,250);" onKeyUp="textCounter(this.form.abstract<?=$labelsuffix;?>,this.form.remLen<?=$labelsuffix;?>,250);"><?=${"abstract".$labelsuffix};?></textarea>
				<? $total = strlen(html_entity_decode(${"abstract".$labelsuffix})); ?>
				<span><input readonly type="text" name="remLen<?=$labelsuffix;?>" size="3" maxlength="3" value="<?=250-$total?>" class="textcounter" /> <?=system_showText(LANG_MSG_CHARS_LEFT)?> <?=system_showText(LANG_MSG_INCLUDING_SPACES_LINE_BREAKS)?></span>
			</td>
		</tr>
		<?
	}
	?>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
	<tr>
		<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_LABEL_CONTENT)?></th>
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
				<textarea name="content<?=$labelsuffix;?>" rows="5"><?=${"content".$labelsuffix}?></textarea>
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
			<?=system_showText(LANG_CATEGORIES_SUBCATEGS)?>
		</th>
	</tr>
	<tr>
		<td colspan="2">
			<p class="warningBOXtext" style="background-position: 10px 0;"><?=system_showText(LANG_MSG_ONLY_SELECT_SUBCATEGS)?><br /><?=system_showText(LANG_MSG_ARTICLE_AUTOMATICALLY_APPEAR);?></p>
		</td>
	</tr>
	<input type="hidden" name="return_categories" value="" />
	<tr>
		<td colspan="2" class="treeView">
			<ul id="article_categorytree_id_0" class="categoryTreeview">&nbsp;</ul>
			<table width="100%" border="0" cellpadding="2" class="tableCategoriesADDED" cellspacing="0">
				<tr>
					<th colspan="2" class="tableCategoriesTITLE alignLeft"><strong><?=system_showText(LANG_ARTICLE_CATEGORIES);?>:</strong></th>
				</tr>
				<tr>
					<td colspan="2" class="tableCategoriesCONTENT"><?=$feedDropDown?></td>
				</tr>
				<tr>
					<td class="tableCategoriesBUTTONS" colspan="2">
						<center>
							<!-- <button type="button" value="<?=system_showText(LANG_BUTTON_VIEWCATEGORYPATH)?>" onclick="JS_displayCategoryPath();"><?=system_showText(LANG_BUTTON_VIEWCATEGORYPATH)?></button>&nbsp; -->
							<button type="button" value="<?=system_showText(LANG_BUTTON_REMOVESELECTEDCATEGORY)?>" onclick="JS_removeCategory();"><?=system_showText(LANG_BUTTON_REMOVESELECTEDCATEGORY)?></button>
						</center>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<? if (PAYMENT_FEATURE == "on") { ?>
	<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
		<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
			<tr>
				<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
			</tr>
			<? if (((!$article->getNumber("id")) || (($article) && ($article->needToCheckOut())) || (strpos($url_base, "/gerenciamento")) || (($article) && ($article->getPrice() <= 0))) && ($process != "signup")) { ?>
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

<script language="javascript" type="text/javascript" src="<?=DEFAULT_URL?>/scripts/categorytree.js"></script>
<script language="javascript" type="text/javascript">
	loadCategoryTree('all', 'article_', 'ArticleCategory', 0, 0, '<?=EDIRECTORY_FOLDER?>');
</script>
