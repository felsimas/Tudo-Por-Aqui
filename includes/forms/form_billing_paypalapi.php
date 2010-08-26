<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_billing_paypalapi.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# INCLUDE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/conf/payment_paypalapi.inc.php");

	if (PAYPALAPIPAYMENT_FEATURE == "on") {

		if (!PAYPALAPI_USERNAME || !PAYPALAPI_PASSWORD || !PAYPALAPI_SIGNATURE) {
			echo "<p class=\"errorMessage\">".system_showText(LANG_PAYPALAPI_NO_AVAILABLE)." <a href=\"".DEFAULT_URL."/membros/help.php\" class=\"billing-contact\">".system_showText(LANG_LABEL_ADMINISTRATOR)."</a>.</p>";
		} else {

			if ($bill_info["listings"]) foreach ($bill_info["listings"] as $id => $info) {
				$cart_items .= "
					<input type=\"hidden\" name=\"listing_id[]\" value=\"$id\" />
					<input type=\"hidden\" name=\"listing_price[]\" value=\"".$info["total_fee"]."\" />";
			}

			if ($bill_info["events"]) foreach ($bill_info["events"] as $id => $info) {
				$cart_items .= "
					<input type=\"hidden\" name=\"event_id[]\" value=\"$id\" />
					<input type=\"hidden\" name=\"event_price[]\" value=\"".$info["total_fee"]."\" />";
			}

			if ($bill_info["banners"]) foreach ($bill_info["banners"] as $id => $info) {
				$cart_items .= "
					<input type=\"hidden\" name=\"banner_id[]\" value=\"$id\" />
					<input type=\"hidden\" name=\"banner_price[]\" value=\"".$info["total_fee"]."\" />";
			}

			if ($bill_info["classifieds"]) foreach ($bill_info["classifieds"] as $id => $info) {
				$cart_items .= "
					<input type=\"hidden\" name=\"classified_id[]\" value=\"$id\" />
					<input type=\"hidden\" name=\"classified_price[]\" value=\"".$info["total_fee"]."\" />";
			}

			if ($bill_info["articles"]) foreach ($bill_info["articles"] as $id => $info) {
				$cart_items .= "
					<input type=\"hidden\" name=\"article_id[]\" value=\"$id\" />
					<input type=\"hidden\" name=\"article_price[]\" value=\"".$info["total_fee"]."\" />";
			}

			if ($bill_info["custominvoices"]) foreach($bill_info["custominvoices"] as $id => $info) {
				$customInvoiceTitle = $info["title"];
				if (strlen($customInvoiceTitle) > 25) $customInvoiceTitle = substr($info["title"], 0, 22)."...";
				$cart_items .= "
					<input type=\"hidden\" name=\"custominvoice_id[]\" value=\"$id\" />
					<input type=\"hidden\" name=\"custominvoice_price[]\" value=\"".$info["amount"]."\" />";
			}

			$paypalapi_amount = str_replace(",", ".", $bill_info["total_bill"]);
			$contactObj = new Contact(sess_getAccountIdFromSession());
			$paypalapi_first_name = $contactObj->getString("first_name");
			$paypalapi_last_name = $contactObj->getString("last_name");

			?>

			<script language="javascript" type="text/javascript">
				<!--
				function submitOrder() {
					document.getElementById("paypalapibutton").disabled = true;
					document.paypalapiform.submit();
				}
				//-->
			</script>

			<form name="paypalapiform" target="_self" action="<?=DEFAULT_URL?>/membros/<?=$payment_process?>/processpayment.php?payment_method=<?=$payment_method?>" method="post">

				<div style="display: none;">

					<input type="hidden" name="amount" value="<?=$paypalapi_amount?>" />
					<input type="hidden" name="currency" value="<?=PAYPALAPI_CURRENCY?>" />
					<input type="hidden" name="paymentType" value="Sale" />

					<?=$cart_items?>

					<input type="hidden" name="pay" value="1" />

				</div>

				<table align="center" width="95%" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">
					<tr>
						<th colspan="2" style="text-align:center"><?=system_showText(LANG_LABEL_BILLING_INFO);?></th>
					</tr>
					<tr>
						<td>* <?=system_showText(LANG_LABEL_CARD_TYPE);?>:</td>
						<td>
							<select name="creditCardType">
								<option></option>
								<option value="Visa">Visa</option>
								<option value="MasterCard">MasterCard</option>
								<option value="Discover">Discover</option>
								<option value="Amex">American Express</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>* <?=system_showText(LANG_LABEL_CARD_NUMBER);?>:</td>
						<td><input type="text" name="creditCardNumber" value="" style="width: 300px;" /></td>
					</tr>
					<tr>
						<td>* <?=system_showText(LANG_LABEL_CARD_EXPIRE_DATE);?>:</td>
						<td>
							<select name="expdate_month">
								<option></option>
								<option value="1">01</option>
								<option value="2">02</option>
								<option value="3">03</option>
								<option value="4">04</option>
								<option value="5">05</option>
								<option value="6">06</option>
								<option value="7">07</option>
								<option value="8">08</option>
								<option value="9">09</option>
								<option value="10">10</option>
								<option value="11">11</option>
								<option value="12">12</option>
								</select>
							<select name="expdate_year">
								<option></option>
								<?
								for ($i=date("Y"); $i<date("Y")+10; $i++) {
									echo "<option value=\"".$i."\">".$i."</option>";
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>* <?=system_showText(LANG_LABEL_CARD_VERIFICATION_NUMBER);?>:</td>
						<td><input type="text" name="cvv2Number" value="" style="width: 300px;" /></td>
					</tr>
					<tr>
						<th colspan="2" style="text-align:center"><?=system_showText(LANG_LABEL_CUSTOMER_INFO);?></td>
					</tr>
					<tr>
						<td>* <?=system_showText(LANG_LABEL_FIRST_NAME);?>:</td>
						<td><input type="text" name="firstName" value="<?=$paypalapi_first_name?>" style="width: 300px;" /></td>
					</tr>
					<tr>
						<td>* <?=system_showText(LANG_LABEL_LAST_NAME);?>:</td>
						<td><input type="text" name="lastName" value="<?=$paypalapi_last_name?>" style="width: 300px;" /></td>
					</tr>
					<tr>
						<td>* <?=system_showText(LANG_LABEL_ADDRESS);?>:</td>
						<td><input type="text" name="address1" value="" style="width: 300px;" /></td>
					</tr>
					<tr>
						<td>* <?=system_showText(LANG_LABEL_CITY)?>:</td>
						<td><input  type="text" name="city" value="" style="width: 300px;" /></td>
					</tr>
					<tr>
						<td>* <?=system_showText(LANG_LABEL_STATE)?>:</td>
						<td>
							<select name="state">
								<option></option>
								<option value="AK">AK</option>
								<option value="AL">AL</option>
								<option value="AR">AR</option>
								<option value="AZ">AZ</option>
								<option value="CA">CA</option>
								<option value="CO">CO</option>
								<option value="CT">CT</option>
								<option value="DC">DC</option>
								<option value="DE">DE</option>
								<option value="FL">FL</option>
								<option value="GA">GA</option>
								<option value="HI">HI</option>
								<option value="IA">IA</option>
								<option value="ID">ID</option>
								<option value="IL">IL</option>
								<option value="IN">IN</option>
								<option value="KS">KS</option>
								<option value="KY">KY</option>
								<option value="LA">LA</option>
								<option value="MA">MA</option>
								<option value="MD">MD</option>
								<option value="ME">ME</option>
								<option value="MI">MI</option>
								<option value="MN">MN</option>
								<option value="MO">MO</option>
								<option value="MS">MS</option>
								<option value="MT">MT</option>
								<option value="NC">NC</option>
								<option value="ND">ND</option>
								<option value="NE">NE</option>
								<option value="NH">NH</option>
								<option value="NJ">NJ</option>
								<option value="NM">NM</option>
								<option value="NV">NV</option>
								<option value="NY">NY</option>
								<option value="OH">OH</option>
								<option value="OK">OK</option>
								<option value="OR">OR</option>
								<option value="PA">PA</option>
								<option value="RI">RI</option>
								<option value="SC">SC</option>
								<option value="SD">SD</option>
								<option value="TN">TN</option>
								<option value="TX">TX</option>
								<option value="UT">UT</option>
								<option value="VA">VA</option>
								<option value="VT">VT</option>
								<option value="WA">WA</option>
								<option value="WI">WI</option>
								<option value="WV">WV</option>
								<option value="WY">WY</option>
								<option value="AA">AA</option>
								<option value="AE">AE</option>
								<option value="AP">AP</option>
								<option value="AS">AS</option>
								<option value="FM">FM</option>
								<option value="GU">GU</option>
								<option value="MH">MH</option>
								<option value="MP">MP</option>
								<option value="PR">PR</option>
								<option value="PW">PW</option>
								<option value="VI">VI</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>* <?=ucwords(system_showText(LANG_LABEL_ZIP));?>:</td>
						<td><input type="text" name="zip" value="" style="width: 300px;" /></td>
					</tr>
					<tr>
						<td>* <?=system_showText(LANG_LABEL_COUNTRY)?>:</td>
						<td><input type="text" value="United States" style="border: 0;" disabled /></td>
					</tr>
				</table>

				<? if ($payment_process == "signup") { ?>
					<table width="100%" border="0" cellpadding="2" cellspacing="2">
						<tr>
							<td><p class="standardButton paymentButton"><a href="javascript:void(0);" id="paypalapibutton" onclick="submitOrder();"><?=system_highlightLastWord(system_showText(LANG_LABEL_PLACE_ORDER_CONTINUE))?></a></p></td>
						</tr>
					</table>
				<? } else { ?>
					<p class="standardButton paymentButton" style="margin-top:10px;">
						<button type="button" id="paypalapibutton" onclick="submitOrder();"><?=system_showText(LANG_BUTTON_PAY_BY_CREDIT_CARD);?></button>
					</p>
				<? } ?>

			</form>

			<?

		}

	}

?>