<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_billing_payflow.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# INCLUDE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/conf/payment_payflow.inc.php");

	if (PAYFLOWPAYMENT_FEATURE == "on") {

		if (!PAYFLOW_LOGIN || !PAYFLOW_PARTNER) {
			echo "<p class=\"errorMessage\">".system_showText(LANG_PAYFLOW_NO_AVAILABLE)." <a href=\"".DEFAULT_URL."/membros/help.php\" class=\"billing-contact\">".system_showText(LANG_LABEL_ADMINISTRATOR)."</a>.</p>";
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
			$payflow_account_id = sess_getAccountIdFromSession();

			?>

			<script language="javascript" type="text/javascript">
				<!--
				function submitOrder() {
					document.getElementById("payflowbutton").disabled = true;
					document.payflowform.submit();
				}
				//-->
			</script>

			<form name="payflowform" target="_self" action="<?=PAYFLOW_POST_URL?>" method="post">

				<div style="display: none;">

					<input type="hidden" name="LOGIN"   value="<?=PAYFLOW_LOGIN?>" />
					<input type="hidden" name="PARTNER" value="<?=PAYFLOW_PARTNER?>" />
					<input type="hidden" name="AMOUNT"  value="<?=$amount?>" />
					<input type="hidden" name="TYPE"    value="S" />
					<input type="hidden" name="INVOICE" value="<?=uniqid(0);?>" />
					<input type="hidden" name="CUSTID"  value="<?=$payflow_account_id?>" />

					<input type="hidden" name="USER1" value="1" />
					<input type="hidden" name="USER2" value="<?=$listing_ids."||".$listing_amounts?>" />
					<input type="hidden" name="USER3" value="<?=$event_ids."||".$event_amounts?>" />
					<input type="hidden" name="USER4" value="<?=$banner_ids."||".$banner_amounts?>" />
					<input type="hidden" name="USER5" value="<?=$classified_ids."||".$classified_amounts?>" />
					<input type="hidden" name="USER6" value="<?=$article_ids."||".$article_amounts?>" />
					<input type="hidden" name="USER7" value="<?=$custominvoice_ids."||".$custominvoice_amounts?>" />

				</div>

				<? if ($payment_process == "signup") { ?>
					<table width="100%" border="0" cellpadding="2" cellspacing="2">
						<tr>
							<td><p class="standardButton paymentButton"><a href="javascript:void(0);" id="payflowbutton" onclick="submitOrder();"><?=system_highlightLastWord(system_showText(LANG_LABEL_PLACE_ORDER_CONTINUE))?></a></p></td>
						</tr>
					</table>
				<? } else { ?>
					<p class="standardButton paymentButton">
						<button type="button" id="payflowbutton" onclick="submitOrder();"><?=system_showText(LANG_BUTTON_PAY_BY_CREDIT_CARD);?></button>
					</p>
				<? } ?>

			</form>

			<?

		}

	}

?>
