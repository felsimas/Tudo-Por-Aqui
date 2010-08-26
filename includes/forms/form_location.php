

<script type="text/javascript">
<!--
function doSubmitLocation(formName, operationName) {
    if (!document.forms[formName].elements['operation']) {
        alert('doSubmitLocation: Error !');
        return false;
    }
    document.forms[formName].elements['operation'].value = operationName;
    document.forms[formName].submit();
    return true;
}
-->
</script>

<script language="javascript" type="text/javascript" src="<?=DEFAULT_URL?>/scripts/common.js"></script>


<table  border="0" width="95%" cellpadding="2" cellspacing="2" class="table-form">

	<? if (($location_message == "" && (strtolower($_POST["operation"]) == "add" || strtolower($_POST["operation"]) == "edit" || strtolower($_POST["operation"]) == "delete")) || (strtolower($_POST["operation"]) == "insert" && !$success) || (strtolower($_POST["operation"]) == "update" && !$success)) { ?>
		<tr class="tr-form">
			<td class="td-form">

			</td>
		</tr>
	<? } ?>

	<? if ($location_message) { ?>
		<div class="response-msg error ui-corner-all"><?=$location_message?></div>
	<? } ?>

	<?
	if (($location_message == "" && strtolower($_POST["operation"]) == "add") || (strtolower($_POST["operation"]) == "insert" && !$success) || (strtolower($_POST["operation"]) == "update" && !$success) || (strtolower($_POST["operation"]) == "edit" && $_POST["location_id"])) {
        $btn_label  = system_showText(LANG_SITEMGR_UPDATE);
        $btn_action = 'update';
        if ((strtolower($_POST["operation"]) == "add") || (strtolower($_POST["operation"]) == "insert")) {
              $btn_label  = system_showText(LANG_SITEMGR_INSERT);
              $btn_action = 'insert';
        }
		?>
		<form name="location_data_in" id="location_data_in" method="post">
			<tr class="tr-form">
				<td class="td-form" colspan="2" style="padding: 0 20px 20px 20px;">
					<input type="hidden" name="estado_id"  id="estado_id"  value="<?=$estado_id?>" />
					<input type="hidden" name="cidade_id"    id="cidade_id"    value="<?=$cidade_id?>" />
					<input type="hidden" name="bairro_id"   id="bairro_id"   value="<?=$bairro_id?>" />
					<input type="hidden" name="city_id"     id="city_id"     value="<?=$city_id?>" />
					<input type="hidden" name="area_id"     id="area_id"     value="<?=$area_id?>" />
					<input type="hidden" name="location_id" id="location_id" value="<?=$location_id?>" />
					<?=LOCATION_TITLE?>: <input type="text" name="location_name" value="<?=htmlspecialchars($location_name)?>" OnBlur="easyFriendlyUrl(this.value, 'friendly_url', '<?=FRIENDLYURL_VALIDCHARS?>', '<?=FRIENDLYURL_SEPARATOR?>');" style="width: 75%;" /><br /><br /><?=system_showText(LANG_SITEMGR_LOCATION_NAMEMSG1)?> <?=$btn_label?> <?=system_showText(LANG_SITEMGR_LOCATION_NAMEMSG2)?>
				</td>
			</tr>
		   <!--	<tr class="tr-form">
				<td class="td-form" colspan="2" style="padding: 0 20px 20px 20px;">
					<?=LOCATION_TITLE?> - <?=ucwords(system_showText(LANG_SITEMGR_ABBREVIATION))?>: <input type="text" name="location_abbreviation" value="<?=htmlspecialchars($location_abbreviation);?>" /><br /><br /><?=system_showText(LANG_SITEMGR_LOCATION_ABBMSG)?>
				</td>
			</tr>
			<tr>
				<td>
					<div id="header-form"><?=system_showText(LANG_SITEMGR_SEOCENTER)?></div>
				  	<table border="0" cellpadding="2" cellspacing="0" width="100%" class="table-form">
						<tr>
							<td valign="top" colspan="2">
								<span class="label-login">
									<p style="text-align: justify;"><?=system_showText(LANG_SITEMGR_LOCATION_FRIENDLY_URL1)?> <br /><br /><strong><?=system_showText(LANG_SITEMGR_FOREXAMPLE)?>:</strong><br /><br /><?=system_showText(LANG_SITEMGR_LOCATION_FRIENDLY_URL2)?><br />"<?=LISTING_DEFAULT_URL?>/location/united-states"<br /><br /><?=system_showText(LANG_SITEMGR_LOCATION_FRIENDLY_URL3)?><br />"<?=LISTING_DEFAULT_URL?>/location/united-states/california"<br /><br /><?=system_showText(LANG_SITEMGR_LOCATION_FRIENDLY_URL4)?><br /><br /><?=system_showText(LANG_SITEMGR_LOCATION_FRIENDLY_URL5)?></p>
								</span>
							</td>
						</tr>
						<tr class="tr-form">
							<td align="right" class="td-form">
								<?=ucwords(system_showText(LANG_SITEMGR_LABEL_FRIENDLYTITLE))?>:
							</td>
							<td align="left" class="td-form">
								<input type="text" id="friendly_url" name="friendly_url" value="<?=$friendly_url?>" OnBlur="easyFriendlyUrl(this.value, 'friendly_url', '<?=FRIENDLYURL_VALIDCHARS?>', '<?=FRIENDLYURL_SEPARATOR?>');" style="width: 75%" />
							</td>
						</tr>
						<tr class="tr-form">
							<td align="right" class="td-form">
								<?=ucwords(system_showText(LANG_SITEMGR_LABEL_METADESCRIPTION))?>:
							</td>
							<td align="left" class="td-form">
								<textarea name="seo_description" rows="5"><?=$seo_description;?></textarea>
							</td>
						</tr>
						<tr class="tr-form">
							<td align="right" class="td-form">
								<?=ucwords(system_showText(LANG_SITEMGR_LABEL_METAKEYWORDS))?>:
							</td>
							<td align="left" class="td-form">
								<textarea name="seo_keywords" rows="5"><?=$seo_keywords;?></textarea>
							</td>
						</tr>
					</table>
				</td>
			</tr>   -->
			<tr>
				<td align="center" class="td-form">
					<button type="button" name="bt_operation_submit" id="bt_operation_submit" value="<?=$btn_label?>" onclick="doSubmitLocation('location_data_in', '<?=$btn_action?>')" class="ui-state-default ui-corner-all2"><?=$btn_label?></button>
                <input type="hidden" id="friendly_url" name="friendly_url" value="<?=$friendly_url?>" OnBlur="easyFriendlyUrl(this.value, 'friendly_url', '<?=FRIENDLYURL_VALIDCHARS?>', '<?=FRIENDLYURL_SEPARATOR?>');" style="width: 75%" />
                </td>
			</tr>
            <input type="hidden" name="operation"  id="operation"  value="" />
		</form>
		<?
	} elseif (strtolower($_POST["operation"]) == "delete" && $_POST["location_id"]) {
		?>
		<form name="location_data_out" id="location_data_out" method="post">
			<tr class="tr-form">
				<td class="td-form" colspan=2>
					<table border="0" cellpadding="2" cellspacing="2" class="table-form">
						<input type="hidden" name="estado_id"  id="estado_id"  value="<?=$estado_id?>" />
						<input type="hidden" name="cidade_id"    id="cidade_id"    value="<?=$cidade_id?>" />
						<input type="hidden" name="bairro_id"   id="bairro_id"   value="<?=$bairro_id?>" />
						<input type="hidden" name="city_id"     id="city_id"     value="<?=$city_id?>" />
						<input type="hidden" name="area_id"     id="area_id"     value="<?=$area_id?>" />
						<input type="hidden" name="location_id" id="location_id" value="<?=$location_id?>" />
						<tr class="tr-form">
							<td align="right" class="td-form" colspan="2">
								<div class="response-msg inf ui-corner-all"><?=system_showText(LANG_SITEMGR_LOCATION_DELETEQUESTION)?> <?=strtolower(LOCATION_TITLE)?> <?=htmlspecialchars($location_name)?>?</div>
							</td>
						</tr>
						<tr>
							<td align="center" class="td-form" colspan="2">
								<input type="button" name="bt_confirm" id="bt_confirm" onclick="doSubmitLocation('location_data_out', 'confirm')" value="<?=system_showText(LANG_SITEMGR_CONFIRM)?>" class="ui-state-default ui-corner-all2 button-space" />
								<input type="button" name="bt_cancel" id="bt_cancel" onclick="doSubmitLocation('location_data_out', 'cancel')" value="<?=system_showText(LANG_SITEMGR_CANCEL)?>" class="ui-state-default ui-corner-all2 button-space" />
							</td>
						</tr>
					</table>
				</td>
			</tr>
            <input type="hidden" name="operation"  id="operation"  value="" /> 
		</form>
		<?
	}
	?>
</table>	

<div id="header-form">
		<?
		echo LOCATION_TITLE;
		?>
</div>
<? if (LOCATION_TITLE == "Estado") { ?>

<div style="margin-top:-15px">
	
<? }?>
	
<table>
	<tr class="tr-form">
		<td class="td-form">

		</td>
	</tr>

	<tr class="tr-form">
		<td class="td-form">
			<table border="0" cellpadding="2" cellspacing="2"  class="table-form">

				<tr class="tr-form">
					<td class="td-form">
						<table border="0" cellpadding="2" cellspacing="2" class="table-form" style="width: 100%;">

							<form name="location_operation" id="location_operation" method="post">
						
						<? if (LOCATION_TITLE == "Estado") { ?>
								<tr class="tr-form" style="height:1px">
									<td align="left" style="height:1px; font: 0pt Verdana, Arial, Helvetica, sans-serif; text-align: right; width: 110px;">&nbsp;</td>
									<td align="left" style="height:1px">
			
									</td>
								</tr>
						<? }?>
								<?
								if (LOCATION_AREA == "STATE" || LOCATION_AREA == "REGION" || LOCATION_AREA == "CITY" || LOCATION_AREA == "AREA") {
									?>
									<tr class="tr-form">
										<td align="left" class="td-form" style="font: 8pt/18px Verdana, Arial, Helvetica, sans-serif; text-align: right; width: 110px;"><?=ucwords(system_showText(LANG_SITEMGR_LABEL_COUNTRY))?>:</td>
										<td align="left" class="td-form">
											<input type="hidden" name="current_country" id="current_country" value="<?=$_POST["estado_id"]?>" />
											<input type="hidden" name="current_state" id="current_state" value="<?=$_POST["cidade_id"]?>" />
											<input type="hidden" name="current_region" id="current_region" value="<?=$_POST["bairro_id"]?>" />
											<select style="font: 8pt/18px Verdana, Arial, Helvetica, sans-serif" name="estado_id" id="estado_id" class="" onchange="this.form.submit()">
												<option value=""> -- <?=system_showText(LANG_LABEL_SELECT_COUNTRY)?> -- </option>
												<?
												if ($countries) foreach ($countries as $each_country) {
													$selected = ($estado_id == $each_country["id"]) ? "selected" : "";
													?><option <?=$selected?> value="<?=$each_country["id"]?>"><?=$each_country["name"]?></option><?
													unset($selected); 
												}
												?>
											</select>
										</td>
									</tr>
									<?
								}
								?>

								<?
								if (LOCATION_AREA == "REGION" || LOCATION_AREA == "CITY" || LOCATION_AREA == "AREA") {
									?>
									<tr class="tr-form">
										<td align="left" class="td-form" style="font: 8pt/18px Verdana, Arial, Helvetica, sans-serif; text-align: right;"><?=ucwords(system_showText(LANG_SITEMGR_LABEL_STATE))?>:</td>
										<td align="left" class="td-form">
											<select style="font: 8pt/18px Verdana, Arial, Helvetica, sans-serif" name="cidade_id" id="cidade_id" class="" onchange="this.form.submit()">
												<option value=""> -- <?=system_showText(LANG_LABEL_SELECT_STATE)?> -- </option>
												<?
												if ($states) foreach ($states as $each_state) {
													$selected = ($cidade_id == $each_state["id"]) ? "selected" : "";
													?><option <?=$selected?> value="<?=$each_state["id"]?>"><?=$each_state["name"]?></option><?
													unset($selected); 
												}
												?>
											</select>
										</td>
									</tr>
									<?
								}
								?>

								<?
								if (LOCATION_AREA == "CITY" || LOCATION_AREA == "AREA") {
									?>
									<tr class="tr-form">
										<td align="left" class="td-form" style="font: 8pt/18px Verdana, Arial, Helvetica, sans-serif; text-align: right;"><?=ucwords(system_showText(LANG_SITEMGR_LABEL_REGION))?>:</td>
										<td align="left" class="td-form">
											<select style="font: 8pt/18px Verdana, Arial, Helvetica, sans-serif" name="bairro_id" id="bairro_id" class="" onchange="this.form.submit()">
												<option value=""> -- <?=system_showText(LANG_LABEL_SELECT_REGION)?> -- </option>
												<?
												if ($regions) foreach($regions as $each_region) {
													$selected = ($bairro_id == $each_region["id"]) ? "selected" : "";
													?><option <?=$selected?> value="<?=$each_region["id"]?>"><?=$each_region["name"]?></option><?
													unset($selected); 
												}
												?>
											</select>
										</td>
									</tr>
									<?
								}
								?>

								<?
								if (LOCATION_AREA == "AREA") {
									?>
									<tr class="tr-form">
										<td align="left" class="td-form" style="font: 8pt/18px Verdana, Arial, Helvetica, sans-serif; text-align: right;"><?=ucwords(system_showText(LANG_SITEMGR_LABEL_CITY))?>:</td>
										<td align="left" class="td-form">
											<select style="font: 8pt/18px Verdana, Arial, Helvetica, sans-serif" name="city_id" id="city_id" class="" onchange="this.form.submit()">
												<option value=""> -- <?=system_showText(LANG_LABEL_SELECT_CITY)?> -- </option>
												<?
												if ($cities) foreach($cities as $each_city) {
													$selected = ($city_id == $each_city["id"]) ? "selected" : "";
													?><option <?=$selected?> value="<?=$each_city["id"]?>"><?=$each_city["name"]?></option><?
													unset($selected); 
												}
												?>
											</select>
										</td>
									</tr>
									<?
								}
								?>

								<tr class="tr-form">
									<td align="left" class="td-form" valign="top" style="font: 8pt/18px Verdana, Arial, Helvetica, sans-serif; text-align: right;">&nbsp;</td>
									<td align="center" class="td-form" colspan="2">
										<select style="font: 8pt/18px Verdana, Arial, Helvetica, sans-serif" name="location_id" id="location_id" class="" size=5>
											<?
											if ($locations) foreach ($locations as $each_location) {
												?><option value="<?=$each_location["id"]?>"><?=$each_location["name"]?></option><?
											}
											?>
										</select>
									</td>
								</tr>

								<tr class="tr-form">
									<td align="center" class="td-form" colspan="2">
										<button type="button" name="bt_add" value="<?=system_showText(LANG_SITEMGR_ADD)?>"  onclick="doSubmitLocation('location_operation', 'add')" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_ADD)?></button>
										<button type="button" name="bt_edit" value="<?=system_showText(LANG_SITEMGR_EDIT)?>"  onclick="doSubmitLocation('location_operation', 'edit')" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_EDIT)?></button>
										<button type="button" name="bt_delete" value="<?=system_showText(LANG_SITEMGR_DELETE)?>"  onclick="doSubmitLocation('location_operation', 'delete')" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_DELETE)?></button>
									</td>
								</tr>
                                <input type="hidden" name="operation"  id="operation"  value="" />
							</form>

						</table>
					</td>
				</tr>

			</table>
		</td>
	</tr>
    
</table>
<? if (LOCATION_TITLE == "Estado") { ?>

</div>
<? }?>