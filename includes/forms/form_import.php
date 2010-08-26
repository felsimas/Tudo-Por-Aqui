<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_import.php
	# ----------------------------------------------------------------------------------------------------

?>

<br />

<div id="header-form"><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_IMPORTSETTINGS)?></div>

<? if ($message_imports) { ?>
	<div class="response-msg error ui-corner-all"><?=$message_imports?></div>
<? } ?>

<?  // Account Search Javascript /////////////////////////////////////////////////////// ?>
<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/accountsearch.js"></script>
<script type="text/javascript">
	function JS_ShowHideAccount() {
		if (document.getElementById('import_sameaccount').checked) document.getElementById('import_account_id').style.display = "";
		else document.getElementById('import_account_id').style.display = "none";
	}
</script>
<table cellpadding="2" cellspacing="0" class="table-form table-form-settings table-form-margin">
	<tr>
			<td align="right" class="td-form"><div class="label-form"><?=system_showText(LANG_SITEMGR_IMPORT_FROMEXPORT)?></div></td>
			<td align="left" class="td-form">
				<input type="checkbox" id="import_from_export" name="import_from_export" value="1" align="absmiddle" <?=$import_from_export?> style="width: auto; border: 0;" class="inputCheck" />  
			</td>
		</tr>
		<tr>
			<td align="right" class="td-form"><div class="label-form"><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_ALLASACTIVE)?></div></td>
			<td align="left" class="td-form">
				<input type="checkbox" id="import_enable_listing_active" name="import_enable_listing_active" value="1" align="absmiddle" <?=$import_enable_listing_active?> style="width: auto; border: 0;" class="inputCheck" />  
			</td> 
		</tr>
		<tr>
			<td align="right" class="td-form"><div class="label-form"><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_DEFAULTLEVEL)?></div></td>
			<td align="left" class="td-form">
				<select name="import_defaultlevel" style="width: 150px;">
				<?
				$levelObj = new ListingLevel();
				$levelvalues = $levelObj->getLevelValues();
				foreach ($levelvalues as $levelvalue) {
					if ($import_defaultlevel==$levelvalue)
						$selected=" selected=\"selected\"";
					else $selected="";
					echo "<option value=\"".$levelvalue."\" $selected>".$levelObj->showLevel($levelvalue)."</option> "; 
				}
				?>
				</select>
			</td> 
		</tr>
		<tr>
			<td align="right" class="td-form"><div class="label-form"><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_SAMEACCOUNT)?></div></td>
			<td align="left" class="td-form"><input type="checkbox" id="import_sameaccount"  name="import_sameaccount" value="1"  align="absmiddle" <?=$import_sameaccount?> style="width: auto; border: 0;" class="inputCheck" onclick="JS_ShowHideAccount();"/></td> 
		</tr>
	</table>
			
	<div id="import_account_id" class="base-table-form-account" <?=($import_sameaccount!="checked") ? "style=\"display:none;\"" : ""?>>
		<? // Account Search ////////////////////////////////////////////////////////////////// ?>
			<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
				<tr>
					<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_TOACCOUNT)?> <span><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_TOACCOUNT_SPAN)?></span></th>
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
		<? //////////////////////////////////////////////////////////////////////////////////// ?>
	</div>
