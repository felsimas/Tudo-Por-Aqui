<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_billing_twocheckout.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# INCLUDE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/conf/payment_twocheckout.inc.php");

	if (TWOCHECKOUTPAYMENT_FEATURE == "on") {

		if (!TWOCHECKOUT_LOGIN) {
			echo "<p class=\"errorMessage\">".system_showText(LANG_TWOCHECKOUT_NO_AVAILABLE)." <a href=\"".DEFAULT_URL."/membros/help.php\" class=\"billing-contact\">".system_showText(LANG_LABEL_ADMINISTRATOR)."</a>.</p>";
		} else {

			if ($bill_info["listings"]) foreach ($bill_info["listings"] as $id => $info) {
				$listing_ids[] = $id;
				$listing_amounts[] = $info["total_fee"];
			}

			if ($bill_info["events"]) foreach ($bill_info["events"] as $id => $info) {
				$event_ids[] = $id;
				$event_amounts[] = $info["total_fee"];
			}

			if ($bill_info["banners"]) foreach ($bill_info["banners"] as $id => $info) {
				$banner_ids[] = $id;
				$banner_amounts[] = $info["total_fee"];
			}

			if ($bill_info["classifieds"]) foreach ($bill_info["classifieds"] as $id => $info) {
				$classified_ids[] = $id;
				$classified_amounts[] = $info["total_fee"];
			}

			if ($bill_info["articles"]) foreach ($bill_info["articles"] as $id => $info) {
				$article_ids[] = $id;
				$article_amounts[] = $info["total_fee"];
			}

			if ($bill_info["custominvoices"]) foreach($bill_info["custominvoices"] as $id => $info) {
				$custominvoice_ids[] = $id;
				$custominvoice_amounts[] = $info["amount"];
			}

			$contactObj = new Contact(sess_getAccountIdFromSession());
			$amount = str_replace(",", ".", $bill_info["total_bill"]);
			if ($listing_ids) $listing_ids = implode("::",$listing_ids);
			if ($listing_amounts) $listing_amounts = implode("::",$listing_amounts);
			if ($event_ids) $event_ids = implode("::",$event_ids);
			if ($event_amounts) $event_amounts = implode("::",$event_amounts);
			if ($banner_ids) $banner_ids = implode("::",$banner_ids);
			if ($banner_amounts) $banner_amounts = implode("::",$banner_amounts);
			if ($classified_ids) $classified_ids = implode("::",$classified_ids);
			if ($classified_amounts) $classified_amounts = implode("::",$classified_amounts);
			if ($article_ids) $article_ids = implode("::",$article_ids);
			if ($article_amounts) $article_amounts = implode("::",$article_amounts);
			if ($custominvoice_ids) $custominvoice_ids = implode("::",$custominvoice_ids);
			if ($custominvoice_amounts) $custominvoice_amounts = implode("::",$custominvoice_amounts);
			$twocheckout_x_first_name = $contactObj->getString("first_name");
			$twocheckout_x_last_name = $contactObj->getString("last_name");
			$twocheckout_x_phone = $contactObj->getString("phone");
			$twocheckout_x_email = $contactObj->getString("email");
			$twocheckout_x_address = $contactObj->getString("address");
			$twocheckout_x_city = $contactObj->getString("city");
			$twocheckout_x_state = $contactObj->getString("state");
			$twocheckout_x_zip = $contactObj->getString("zip");
			$twocheckout_x_country = $contactObj->getString("country");

			?>

			<script language="javascript" type="text/javascript">
				<!--
				function submitOrder() {
					document.getElementById("twocheckoutbutton").disabled = true;
					document.twocheckoutform.submit();
				}
				//-->
			</script>

			<form name="twocheckoutform" target="_self" action="<?=TWOCHECKOUT_POST_URL?>" method="post">

				<div style="display: none;">

					<input type="hidden" name="x_login"            value="<?=TWOCHECKOUT_LOGIN?>" />
					<input type="hidden" name="x_amount"           value="<?=$amount?>" />
					<input type="hidden" name="x_invoice_num"      value="<?=uniqid(0);?>" />
					<input type="hidden" name="demo"               value="<?=TWOCHECKOUT_DEMO?>" />
					<input type="hidden" name="fixed"              value="Y" />
					<input type="hidden" name="lang"               value="<?=TWOCHECKOUT_LANG?>" />
					<input type="hidden" name="pay_method"         value="CC" />
					<input type="hidden" name="x_Receipt_Link_URL" value="<?=DEFAULT_URL?>/membros/<?=$payment_process?>/processpayment.php?payment_method=<?=$payment_method?>" />

					<input type="hidden" name="x_listing_ids"           value="<?=$listing_ids?>" />
					<input type="hidden" name="x_listing_amounts"       value="<?=$listing_amounts?>" />
					<input type="hidden" name="x_event_ids"             value="<?=$event_ids?>" />
					<input type="hidden" name="x_event_amounts"         value="<?=$event_amounts?>" />
					<input type="hidden" name="x_banner_ids"            value="<?=$banner_ids?>" />
					<input type="hidden" name="x_banner_amounts"        value="<?=$banner_amounts?>" />
					<input type="hidden" name="x_classified_ids"        value="<?=$classified_ids?>" />
					<input type="hidden" name="x_classified_amounts"    value="<?=$classified_amounts?>" />
					<input type="hidden" name="x_article_ids"           value="<?=$article_ids?>" />
					<input type="hidden" name="x_article_amounts"       value="<?=$article_amounts?>" />
					<input type="hidden" name="x_custominvoice_ids"     value="<?=$custominvoice_ids?>" />
					<input type="hidden" name="x_custominvoice_amounts" value="<?=$custominvoice_amounts?>" />

				</div>

				<table align="center" width="95%" cellpadding="2" cellspacing="2" class="standard-table">
					<tr>
						<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_LABEL_CUSTOMER_INFO)?></td>
					</tr>
					<tr>
						<th><?=system_showText(LANG_LABEL_FIRST_NAME)?>:</th>
						<td><input type="text" name="x_first_name" value="<?=$twocheckout_x_first_name?>" /></td>
					</tr>
					<tr>
						<th><?=system_showText(LANG_LABEL_LAST_NAME)?>:</th>
						<td><input type="text" name="x_last_name" value="<?=$twocheckout_x_last_name?>" /></td>
					</tr>
					<tr>
						<th><?=system_showText(LANG_LABEL_PHONE)?>:</th>
						<td><input type="text" name="x_phone" value="<?=$twocheckout_x_phone?>" /></td>
					</tr>
					<tr>
						<th><?=system_showText(LANG_LABEL_EMAIL)?>:</th>
						<td><input type="text" name="x_email" value="<?=$twocheckout_x_email?>" /></td>
					</tr>
					<tr>
						<th><?=system_showText(LANG_LABEL_ADDRESS);?>:</th>
						<td><input type="text" name="x_address" value="<?=$twocheckout_x_address?>" /></td>
					</tr>
					<tr>
						<th><?=system_showText(LANG_LABEL_CITY)?>:</th>
						<td><input  type="text" name="x_city" value="<?=$twocheckout_x_city?>" /></td>
					</tr>
					<tr>
						<th><?=system_showText(LANG_LABEL_STATE)?>:</th>
						<td><input type="text" name="x_state" value="<?=$twocheckout_x_state?>" /></td>
					</tr>
					<tr>
						<th><?=ucwords(system_showText(LANG_LABEL_ZIP))?>:</th>
						<td><input type="text" name="x_zip" value="<?=$twocheckout_x_zip?>" /></td>
					</tr>
					<tr>
						<th><?=system_showText(LANG_LABEL_COUNTRY)?>:</th>
						<td><input type="text" name="x_country" value="<?=$twocheckout_x_country?>"/ ></td>
					</tr>
				</table>

				<? if ($payment_process == "signup") { ?>
					<table width="100%" border="0" cellpadding="2" cellspacing="2">
						<tr>
							<td><p class="standardButton paymentButton"><a href="javascript:void(0);" id="twocheckoutbutton" onclick="submitOrder();"><?=system_highlightLastWord(system_showText(LANG_LABEL_PLACE_ORDER_CONTINUE))?></a></p></td>
						</tr>
					</table>
				<? } else { ?>
					<p class="standardButton paymentButton">
						<button type="button" id="twocheckoutbutton" onclick="submitOrder();"><?=system_showText(LANG_BUTTON_PAY_BY_CREDIT_CARD)?></button>
					</p>
				<? } ?>

			</form>

			<?

		}

	}

?>