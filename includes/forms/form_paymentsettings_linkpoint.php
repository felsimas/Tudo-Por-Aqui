<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_linkpointsettings.php
	# ----------------------------------------------------------------------------------------------------
	
	$dbObjPayment = db_getDBObject();
	
	$error   = false;
	$success = false;
	
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		
	 	if ($_POST['itemedit'] == "linkpoint") {
	 		
	 		reset($_POST);
	 		while (list($name, $value) = each($_POST)) {
	 			
	 			if (substr($name,0,strlen($_POST['itemedit'])) == $_POST['itemedit']) {
	 				
	 				$sql = "UPDATE Setting_Payment SET value='".crypt_encrypt(trim($value))."' WHERE name='".$name."' LIMIT 1";
	 				
	 				if (!$dbObjPayment->query($sql)) {
	 					$error   = true;
	 				} else {
	 					$success = true;
	 				}
			    }
			    
			}
	 	}		
	}
	
	$sql = "SELECT * FROM Setting_Payment WHERE name LIKE 'LINKPOINT_%'";
	$result = $dbObjPayment->query($sql);
	while ($row = mysql_fetch_assoc($result)) {
		if ($row["name"] == "LINKPOINT_CONFIGFILE")  $linkpoint_configfile  = crypt_decrypt($row["value"]);
		if ($row["name"] == "LINKPOINT_KEYFILE")     $linkpoint_keyfile     = crypt_decrypt($row["value"]);
	}
	
	unset($dbObjPayment);
	
?>
	
	<div id="header-form">
		<?=ucwords(system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_LINKPOINTINFORMATION))?>
	</div>
	
	<?
	if ($error) 
		echo "<p class=\"errorMessage\">&#149;&nbsp;".$msg_error."</p>";
	else if ($success)
		echo "<p class=\"successMessage\">&#149;&nbsp;".$msg_success."</p>";
	unset($error);
	?>
	
	<br />
	
	<table cellpadding="2" cellspacing="0" border="0" class="table-form">

	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_LABEL_CONFIGFILE)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="linkpoint_configfile" value="<?=$linkpoint_configfile?>" class="input-form-adminemail" />
		</td>
	</tr>
	
	<tr class="tr-form">
		<td align="right" class="td-form">
			<div class="label-form">
				<?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENT_LABEL_KEYFILE)?>:
			</div>
		</td>
		<td align="left" class="td-form">
			<input type="text" name="linkpoint_keyfile" value="<?=$linkpoint_keyfile?>" class="input-form-adminemail" />
		</td>
	</tr>
	
	</table>
	
	<br />
	
	<table style="margin: 0 auto 0 auto;">
		<tr>
			<td>
				<button type="button" name="bt_submit_linkpoint" value="Submit" class="ui-state-default ui-corner-all" onClick="formSubmit('linkpoint')"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
			</td>
		</tr>
	</table>
	
	<br />
	