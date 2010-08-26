<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_billing_paypal.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# INCLUDE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/conf/payment_paypal.inc.php");

	if (PAYPALPAYMENT_FEATURE == "on") {

		if (!PAYPAL_ACCOUNT) {
			echo "<p class=\"errorMessage\">".system_showText(LANG_PAYPAL_NO_AVAILABLE)." <a href=\"".DEFAULT_URL."/membros/help.php\" class=\"billing-contact\">".system_showText(LANG_LABEL_ADMINISTRATOR)."</a>.</p>";
		} elseif ((PAYPALRECURRING_FEATURE == "on") && (!PAYPAL_RECURRINGCYCLE || !PAYPAL_RECURRINGUNIT)) {
			echo "<p class=\"errorMessage\">".system_showText(LANG_PAYPAL_NO_AVAILABLE)." <a href=\"".DEFAULT_URL."/membros/help.php\" class=\"billing-contact\">".system_showText(LANG_LABEL_ADMINISTRATOR)."</a>.</p>";
		} else {

			$block_bannerbyimpression = false;
			$block_custominvoice = false;

			$itemCount = 1;

			if ($bill_info["listings"]) foreach ($bill_info["listings"] as $id => $info) {

				if (PAYPALRECURRING_FEATURE == "on") {
					$itemspaid_id[] = "l:".$id;
				} else {
					$cart_items .= "
						<input type=\"hidden\" name=\"item_name_".$itemCount."\" value=\"".$info["title"]."\" />
						<input type=\"hidden\" name=\"item_number_".$itemCount."\" value=\"listing:$id\" />
						<input type=\"hidden\" name=\"amount_".$itemCount."\" value=\"".$info["total_fee"]."\" />";
				}

				$itemCount++;

			}

			if ($bill_info["events"]) foreach ($bill_info["events"] as $id => $info) {

				if (PAYPALRECURRING_FEATURE == "on") {
					$itemspaid_id[] = "e:".$id;
				} else {
					$cart_items .= "
						<input type=\"hidden\" name=\"item_name_".$itemCount."\" value=\"".$info["title"]."\" />
						<input type=\"hidden\" name=\"item_number_".$itemCount."\" value=\"event:$id\" />
						<input type=\"hidden\" name=\"amount_".$itemCount."\" value=\"".$info["total_fee"]."\" />";
				}

				$itemCount++;

			}

			if ($bill_info["banners"]) foreach ($bill_info["banners"] as $id => $info) {

				if ($info["expiration_setting"] == BANNER_EXPIRATION_IMPRESSION) {
					$block_bannerbyimpression = true;
				}

				if (PAYPALRECURRING_FEATURE == "on") {
					$itemspaid_id[] = "b:".$id;
				} else {
					$cart_items .= "
						<input type=\"hidden\" name=\"item_name_".$itemCount."\" value=\"".$info["caption"]."\" />
						<input type=\"hidden\" name=\"item_number_".$itemCount."\" value=\"banner:$id\" />
						<input type=\"hidden\" name=\"amount_".$itemCount."\" value=\"".$info["total_fee"]."\" />";
				}

				$itemCount++;

			}

			if ($bill_info["classifieds"]) foreach ($bill_info["classifieds"] as $id => $info) {

				if (PAYPALRECURRING_FEATURE == "on") {
					$itemspaid_id[] = "c:".$id;
				} else {
					$cart_items .= "
						<input type=\"hidden\" name=\"item_name_".$itemCount."\" value=\"".$info["title"]."\" />
						<input type=\"hidden\" name=\"item_number_".$itemCount."\" value=\"classified:$id\" />
						<input type=\"hidden\" name=\"amount_".$itemCount."\" value=\"".$info["total_fee"]."\" />";
				}

				$itemCount++;

			}

			if ($bill_info["articles"]) foreach ($bill_info["articles"] as $id => $info) {

				if (PAYPALRECURRING_FEATURE == "on") {
					$itemspaid_id[] = "a:".$id;
				} else {
					$cart_items .= "
						<input type=\"hidden\" name=\"item_name_".$itemCount."\" value=\"".$info["title"]."\" />
						<input type=\"hidden\" name=\"item_number_".$itemCount."\" value=\"article:$id\" />
						<input type=\"hidden\" name=\"amount_".$itemCount."\" value=\"".$info["total_fee"]."\" />";
				}

				$itemCount++;

			}

			if ($bill_info["custominvoices"]) foreach($bill_info["custominvoices"] as $id => $info) {

				$block_custominvoice = true;

				if (PAYPALRECURRING_FEATURE == "on") {
					$itemspaid_id[] = "i:".$id;
				} else {
					$customInvoiceTitle = $info["title"];
					if (strlen($customInvoiceTitle) > 25) $customInvoiceTitle = substr($info["title"], 0, 22)."...";
					$cart_items .= "
						<input type=\"hidden\" name=\"item_name_".$itemCount."\" value=\"".$customInvoiceTitle."\" />
						<input type=\"hidden\" name=\"item_number_".$itemCount."\" value=\"custominvoice:$id\" />
						<input type=\"hidden\" name=\"amount_".$itemCount."\" value=\"".$info["amount"]."\" />";
				}

				$itemCount++;

			}

			$stoppayment = false;

			if ((PAYPALRECURRING_FEATURE == "on") && (($block_bannerbyimpression) || ($block_custominvoice))) {
				echo "<p class=\"errorMessage\">";
					if (($block_bannerbyimpression) && ($block_custominvoice)) echo system_showText(LANG_MSG_BANNER_CUSTOM_INVOICE_PAID_ONCE);
					elseif ($block_bannerbyimpression) echo system_showText(LANG_MSG_BANNER_PAID_ONCE);
					elseif ($block_custominvoice) echo system_showText(LANG_MSG_CUSTOM_INVOICE_PAID_ONCE);
					echo "&nbsp;".system_showText(LANG_MSG_PLEASE_DO_NOT_USE_RECURRING_PAYMENT_SYSTEM);
					echo "<br /><a href=\"".DEFAULT_URL."/membros/billing/\">".system_showText(LANG_MSG_TRY_AGAIN)."</a>";
				echo "</p>";
				$stoppayment = true;
			} elseif (PAYPALRECURRING_FEATURE == "on") {
				$itemspaid_string = implode("|", $itemspaid_id);
				if (strlen($itemspaid_string) > 200) {
					echo "<p class=\"errorMessage\">Too many items to pay, the payment gateway does not allow. Please pay less items per time!</p>";
					$stoppayment = true;
				}
			}

			if (!$stoppayment) {

				$contactObj = new Contact(sess_getAccountIdFromSession());
				$amount = str_replace(",", ".", $bill_info["total_bill"]);
				$paypal_return = DEFAULT_URL."/membros/".$payment_process."/processpayment.php?payment_method=".$payment_method."";
				$paypal_cancel_return = DEFAULT_URL."/membros/".$payment_process."/processpayment.php?payment_method=".$payment_method."";
				$paypal_notify_url = DEFAULT_URL."/membros/billing/receipt.php";
				$paypal_account_id = sess_getAccountIdFromSession();
				$paypal_first_name = $contactObj->getString("first_name");
				$paypal_last_name = $contactObj->getString("last_name");
				$paypal_email = $contactObj->getString("email");
				$paypal_address = $contactObj->getString("address");
				$paypal_city = $contactObj->getString("city");
				$paypal_state = $contactObj->getString("state");
				$paypal_zip = $contactObj->getString("zip");
				$phone = str_replace(".", "", $contactObj->getString("phone"));
				$phone = str_replace("-", "", $phone);
				$phone = str_replace(" ", "", $phone);
				$paypal_night_phone_a = substr($phone, 0, 3);
				$paypal_night_phone_b = substr($phone, 3, 3);
				$paypal_night_phone_c = substr($phone, 6);

				?>

				<script language="javascript" type="text/javascript">
					<!--
					function submitOrder() {
						document.getElementById("paypalbutton").disabled = true;
						document.paypalform.submit();
					}
					//-->
				</script>

				<form name="paypalform" target="_self" action="https://<?=PAYPAL_URL?><?=PAYPAL_URL_FOLDER?>" method="post">

					<div style="display: none;">

						<input type="hidden" name="cmd" value="_ext-enter" />

						<? if (PAYPALRECURRING_FEATURE == "on") { ?>
							<input type="hidden" name="redirect_cmd" value="_xclick-subscriptions" />
						<? } else { ?>
							<input type="hidden" name="redirect_cmd" value="_cart" />
							<input type="hidden" name="upload"       value="1" />
						<? } ?>

						<input type="hidden" name="business"      value="<?=PAYPAL_ACCOUNT?>" />
						<input type="hidden" name="no_note"       value="1" />
						<input type="hidden" name="no_shipping"   value="1" />
						<input type="hidden" name="currency_code" value="<?=PAYPAL_CURRENCY?>" />
						<input type="hidden" name="lc"            value="<?=PAYPAL_LC?>" />
						<input type="hidden" name="cbt"           value="Finish" />
						<input type="hidden" name="rm"            value="2" />
						<input type="hidden" name="return"        value="<?=$paypal_return?>" />
						<input type="hidden" name="cancel_return" value="<?=$paypal_cancel_return?>" />
						<input type="hidden" name="notify_url"    value="<?=$paypal_notify_url?>" />
						<input type="hidden" name="page_style"    value="PayPal" />
						<input type="hidden" name="custom"        value="account_id:<?=$paypal_account_id?>::ip:<?=$_SERVER["REMOTE_ADDR"]?>" />

						<? if (PAYPALRECURRING_FEATURE == "on") { ?>
							<input type="hidden" name="a3"  value="<?=$amount?>" />
							<input type="hidden" name="p3"  value="<?=PAYPAL_RECURRINGCYCLE?>" />
							<input type="hidden" name="t3"  value="<?=PAYPAL_RECURRINGUNIT?>" />
							<input type="hidden" name="src" value="1" />
							<input type="hidden" name="sra" value="1" />
							<? if (PAYPAL_RECURRINGTIMES > 0) { ?>
								<input type="hidden" name="srt" value="<?=PAYPAL_RECURRINGTIMES?>" />
							<? } ?>
							<input type="hidden" name="item_name" value="<?=EDIRECTORY_TITLE?> Subscription (Recurring)" />
						<? } ?>

						<?
						if (PAYPALRECURRING_FEATURE == "on") {
							if ($itemspaid_id) {
								echo "<input type=\"hidden\" name=\"on0\" value=\"itemsPaid\" />";
								echo "<input type=\"hidden\" name=\"os0\" value=\"".$itemspaid_string."\" />";
							}
						} else {
							echo $cart_items;
						}
						?>

						<input type="hidden" name="first_name" value="<?=$paypal_first_name?>" />
						<input type="hidden" name="last_name"  value="<?=$paypal_last_name?>" />
						<input type="hidden" name="email"      value="<?=$paypal_email?>" />
						<input type="hidden" name="address1"   value="<?=$paypal_address?>" />
						<input type="hidden" name="city"       value="<?=$paypal_city?>" />
						<input type="hidden" name="state"      value="<?=$paypal_state?>" />
						<input type="hidden" name="zip"        value="<?=$paypal_zip?>" />

						<input type="hidden" name="night_phone_a" value="<?=$paypal_night_phone_a?>" />
						<input type="hidden" name="night_phone_b" value="<?=$paypal_night_phone_b?>" />
						<input type="hidden" name="night_phone_c" value="<?=$paypal_night_phone_c?>" />

					</div>

					<? if ($payment_process == "signup") { ?>
						<table width="100%" border="0" cellpadding="2" cellspacing="2">
							<tr>
								<td><p class="standardButton paymentButton"><a href="javascript:void(0);" id="paypalbutton" onclick="submitOrder();"><?=system_highlightLastWord(system_showText(LANG_LABEL_PLACE_ORDER_CONTINUE))?></a></p></td>
							</tr>
						</table>
					<? } else { ?>
						<p class="standardButton paymentButton">
							<button type="button" id="paypalbutton" onclick="submitOrder();"><?=system_showText(LANG_BUTTON_PAY_BY_PAYPAL);?></button>
						</p>
					<? } ?>

				</form>

				<?

			}

		}

	}

?>
