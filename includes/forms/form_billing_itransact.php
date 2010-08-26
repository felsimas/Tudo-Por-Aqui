<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_billing_itransact.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# INCLUDE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/conf/payment_itransact.inc.php");

	if (ITRANSACTPAYMENT_FEATURE == "on") {

		if (!ITRANSACT_VENDORID) {
			echo "<p class=\"errorMessage\">".system_showText(LANG_ITRANSACT_NO_AVAILABLE)." <a href=\"".DEFAULT_URL."/membros/help.php\" class=\"billing-contact\">".system_showText(LANG_LABEL_ADMINISTRATOR)."</a>.</p>";
		} else {

			$itemCount = 1;

			if ($bill_info["listings"]) foreach ($bill_info["listings"] as $id => $info) {

				$listing_ids[] = $id;
				$listing_amounts[] = $info["total_fee"];

				$cart_items .= "
					<input type=\"hidden\" name=\"".$itemCount."_desc\" value=\"".$info["title"]."\" />
					<input type=\"hidden\" name=\"".$itemCount."_id\" value=\"listing:$id\" />
					<input type=\"hidden\" name=\"".$itemCount."_cost\" value=\"".$info["total_fee"]."\" />
					<input type=\"hidden\" name=\"".$itemCount."_qty\" value=\"1\" />";

				$itemCount++;

			}

			if ($bill_info["events"]) foreach ($bill_info["events"] as $id => $info) {

				$event_ids[] = $id;
				$event_amounts[] = $info["total_fee"];

				$cart_items .= "
					<input type=\"hidden\" name=\"".$itemCount."_desc\" value=\"".$info["title"]."\" />
					<input type=\"hidden\" name=\"".$itemCount."_id\" value=\"event:$id\" />
					<input type=\"hidden\" name=\"".$itemCount."_cost\" value=\"".$info["total_fee"]."\" />
					<input type=\"hidden\" name=\"".$itemCount."_qty\" value=\"1\" />";

				$itemCount++;

			}

			if ($bill_info["banners"]) foreach ($bill_info["banners"] as $id => $info) {

				$banner_ids[] = $id;
				$banner_amounts[] = $info["total_fee"];

				$cart_items .= "
					<input type=\"hidden\" name=\"".$itemCount."_desc\" value=\"".$info["caption"]."\" />
					<input type=\"hidden\" name=\"".$itemCount."_id\" value=\"banner:$id\" />
					<input type=\"hidden\" name=\"".$itemCount."_cost\" value=\"".$info["total_fee"]."\" />
					<input type=\"hidden\" name=\"".$itemCount."_qty\" value=\"1\" />";

				$itemCount++;

			}

			if ($bill_info["classifieds"]) foreach ($bill_info["classifieds"] as $id => $info) {

				$classified_ids[] = $id;
				$classified_amounts[] = $info["total_fee"];

				$cart_items .= "
					<input type=\"hidden\" name=\"".$itemCount."_desc\" value=\"".$info["title"]."\" />
					<input type=\"hidden\" name=\"".$itemCount."_id\" value=\"classified:$id\" />
					<input type=\"hidden\" name=\"".$itemCount."_cost\" value=\"".$info["total_fee"]."\" />
					<input type=\"hidden\" name=\"".$itemCount."_qty\" value=\"1\" />";

				$itemCount++;

			}

			if ($bill_info["articles"]) foreach ($bill_info["articles"] as $id => $info) {

				$article_ids[] = $id;
				$article_amounts[] = $info["total_fee"];

				$cart_items .= "
					<input type=\"hidden\" name=\"".$itemCount."_desc\" value=\"".$info["title"]."\" />
					<input type=\"hidden\" name=\"".$itemCount."_id\" value=\"article:$id\" />
					<input type=\"hidden\" name=\"".$itemCount."_cost\" value=\"".$info["total_fee"]."\" />
					<input type=\"hidden\" name=\"".$itemCount."_qty\" value=\"1\" />";

				$itemCount++;

			}

			if ($bill_info["custominvoices"]) foreach($bill_info["custominvoices"] as $id => $info) {

				$custominvoice_ids[] = $id;
				$custominvoice_amounts[] = $info["amount"];

				$customInvoiceTitle = $info["title"];
				if (strlen($customInvoiceTitle) > 25) $customInvoiceTitle = substr($info["title"], 0, 22)."...";

				$cart_items .= "
					<input type=\"hidden\" name=\"".$itemCount."_desc\" value=\"".$customInvoiceTitle."\" />
					<input type=\"hidden\" name=\"".$itemCount."_id\" value=\"custominvoice:$id\" />
					<input type=\"hidden\" name=\"".$itemCount."_cost\" value=\"".$info["amount"]."\" />
					<input type=\"hidden\" name=\"".$itemCount."_qty\" value=\"1\" />";
					

				$itemCount++;

			}

			$contactObj = new Contact(sess_getAccountIdFromSession());
			$amount = str_replace(",", ".", $bill_info["total_bill"]);
			if ($listing_ids) $listing_ids = implode(":", $listing_ids);
			if ($listing_amounts) $listing_amounts = implode(":", $listing_amounts);
			if ($event_ids) $event_ids = implode(":", $event_ids);
			if ($event_amounts) $event_amounts = implode(":", $event_amounts);
			if ($banner_ids) $banner_ids = implode(":", $banner_ids);
			if ($banner_amounts) $banner_amounts = implode(":", $banner_amounts);
			if ($classified_ids) $classified_ids = implode(":", $classified_ids);
			if ($classified_amounts) $classified_amounts = implode(":", $classified_amounts);
			if ($article_ids) $article_ids = implode(":", $article_ids);
			if ($article_amounts) $article_amounts = implode(":", $article_amounts);
			if ($custominvoice_ids) $custominvoice_ids = implode(":", $custominvoice_ids);
			if ($custominvoice_amounts) $custominvoice_amounts = implode(":", $custominvoice_amounts);
			$itransact_return_address = DEFAULT_URL."/membros/".$payment_process."/processpayment.php";
			$itransact_first_name = $contactObj->getString("first_name");
			$itransact_last_name = $contactObj->getString("last_name");
			$itransact_address = $contactObj->getString("address");
			$itransact_city = $contactObj->getString("city");
			$itransact_state = $contactObj->getString("state");
			$itransact_zip = $contactObj->getString("zip");
			$itransact_country = $contactObj->getString("country");
			$itransact_phone = $contactObj->getString("phone");
			$itransact_email = $contactObj->getString("email");

			?>

			<script language="javascript" type="text/javascript">
				<!--
				function submitOrder() {
					document.getElementById("itransactbutton").disabled = true;
					document.itransactform.submit();
				}
				//-->
			</script>

			<div class="response-msg inf ui-corner-all">* <?=system_showText(LANG_MSG_ALL_FIELDS_REQUIRED)?></div>

			<form name="itransactform" target="_self" action="<?=ITRANSACT_HOST?>" method="post">

				<div style="display: none;">

					<input type="hidden" name="vendor_id" value="<?=ITRANSACT_VENDORID?>" />
					<input type="hidden" name="home_page" value="<?=DEFAULT_URL?>" />
					<input type="hidden" name="ret_addr"  value="<?=$itransact_return_address?>" />

					<input type="hidden" name="mername"     value="<?=EDIRECTORY_TITLE?>" />
					<input type="hidden" name="formtype"    value="2" />
					<input type="hidden" name="acceptcards" value="1" />

					<input type="hidden" name="items" value="<?=($itemCount-1)?>" />

					<?=$cart_items;?>

					<input type="hidden" name="lookup" value="authcode" />
					<input type="hidden" name="lookup" value="cc_last_four" />
					<input type="hidden" name="lookup" value="ck_last_four" />
					<input type="hidden" name="lookup" value="cc_name" />
					<input type="hidden" name="lookup" value="total" />
					<input type="hidden" name="lookup" value="test_mode" />
					<input type="hidden" name="lookup" value="when" />
					<input type="hidden" name="lookup" value="xid" />
					<input type="hidden" name="lookup" value="avs_response" />
					<input type="hidden" name="lookup" value="cvv2_response" />
					<input type="hidden" name="lookup" value="confemail" />

					<input type="hidden" name="passback"       value="payment_method" />
					<input type="hidden" name="payment_method" value="<?=$payment_method?>" />

					<input type="hidden" name="passback" value="ordernum" />
					<input type="hidden" name="ordernum" value="<?=uniqid(0);?>" />

					<input type="hidden" name="passback"        value="listing_ids" />
					<input type="hidden" name="listing_ids"     value="<?=$listing_ids?>" />
					<input type="hidden" name="passback"        value="listing_amounts" />
					<input type="hidden" name="listing_amounts" value="<?=$listing_amounts?>" />

					<input type="hidden" name="passback"      value="event_ids" />
					<input type="hidden" name="event_ids"     value="<?=$event_ids?>" />
					<input type="hidden" name="passback"      value="event_amounts" />
					<input type="hidden" name="event_amounts" value="<?=$event_amounts?>">

					<input type="hidden" name="passback"       value="banner_ids" />
					<input type="hidden" name="banner_ids"     value="<?=$banner_ids?>" />
					<input type="hidden" name="passback"       value="banner_amounts" />
					<input type="hidden" name="banner_amounts" value="<?=$banner_amounts?>" />

					<input type="hidden" name="passback"           value="classified_ids" />
					<input type="hidden" name="classified_ids"     value="<?=$classified_ids?>" />
					<input type="hidden" name="passback"           value="classified_amounts" />
					<input type="hidden" name="classified_amounts" value="<?=$classified_amounts?>" />

					<input type="hidden" name="passback"        value="article_ids" />
					<input type="hidden" name="article_ids"     value="<?=$article_ids?>" />
					<input type="hidden" name="passback"        value="article_amounts" />
					<input type="hidden" name="article_amounts" value="<?=$article_amounts?>" />

					<input type="hidden" name="passback"              value="custominvoice_ids" />
					<input type="hidden" name="custominvoice_ids"     value="<?=$custominvoice_ids?>" />
					<input type="hidden" name="passback"              value="custominvoice_amounts" />
					<input type="hidden" name="custominvoice_amounts" value="<?=$custominvoice_amounts?>" />

				</div>

				<table align="center" width="95%" cellpadding="2" cellspacing="2" class="standard-table">
					<tr>
						<th colspan="2" class="standard-tabletitle"><?=ucwords(system_showText(LANG_LABEL_GENERAL_INFORMATION));?></td>
					</tr>
					<tr>
						<th><?=system_showText(LANG_LABEL_FIRST_NAME);?>:</th>
						<td><input type="text" name="first_name" value="<?=$itransact_first_name?>" /></td>
					</tr>
					<tr>
						<th><?=system_showText(LANG_LABEL_LAST_NAME);?>:</th>
						<td><input type="text" name="last_name" value="<?=$itransact_last_name?>" /></td>
					</tr>
					<tr>
						<th><?=system_showText(LANG_LABEL_ADDRESS);?>:</th>
						<td><input type="text" name="address" value="<?=$itransact_address?>" /></td>
					</tr>
					<tr>
						<th><?=system_showText(LANG_LABEL_CITY)?>:</th>
						<td><input  type="text" name="city" value="<?=$itransact_city?>" /></td>
					</tr>
					<tr>
						<th><?=system_showText(LANG_LABEL_STATE)?>:</th>
						<td><input type="text" name="state" value="<?=$itransact_state?>" /></td>
					</tr>
					<tr>
						<th><?=ucwords(system_showText(LANG_LABEL_ZIP))?>:</th>
						<td><input type="text" name="zip" value="<?=$itransact_zip?>" /></td>
					</tr>
					<tr>
						<th><?=system_showText(LANG_LABEL_COUNTRY)?>:</th>
						<td><input type="text" name="country" value="<?=(($itransact_country) ? ($itransact_country) : ("USA"))?>" /></td>
					</tr>
					<tr>
						<th><?=system_showText(LANG_LABEL_PHONE_NUMBER)?>:</th>
						<td><input type="text" name="phone" value="<?=$itransact_phone?>" /></td>
					</tr>
					<tr>
						<th><?=system_showText(LANG_LABEL_EMAIL_ADDRESS)?>:</th>
						<td><input type="text" name="email" value="<?=$itransact_email?>" /></td>
					</tr>
					<tr>
						<th colspan="2" class="standard-tabletitle"><?=ucwords(system_showText(LANG_LABEL_CREDIT_CARD_INFORMATION))?></th>
					</tr>
					<tr>
						<th><?=system_showText(LANG_LABEL_CARD_NUMBER);?>:</th>
						<td><input type="text" name="ccnum" value="" /></td>
					</tr>
					<tr>
						<th><?=system_showText(LANG_LABEL_EXP_DATE);?>:</th>
						<? $all_months = explode(",", LANG_DATE_MONTHS); ?>
						<td>
							<select NAME="ccmo" style="width: 95px;">
								<option value=""></option>
								<option value="January"><?=$all_months[0];?></option>
								<option value="February"><?=$all_months[1];?></option>
								<option value="March"><?=$all_months[2];?></option>
								<option value="April"><?=$all_months[3];?></option>
								<option value="May"><?=$all_months[4];?></option>
								<option value="June"><?=$all_months[5];?></option>
								<option value="July"><?=$all_months[6];?></option>
								<option value="August"><?=$all_months[7];?></option>
								<option value="September"><?=$all_months[8];?></option>
								<option value="October"><?=$all_months[9];?></option>
								<option value="November"><?=$all_months[10];?></option>
								<option value="December"><?=$all_months[11];?></option>
							</select>
							<select name="ccyr" style="width: 60px;">
								<option value=""></option>
								<?
								$todayyear = date("Y");
								for ($i=0; $i<15; $i++) {
									echo "<option value=\"".($todayyear+$i)."\">".($todayyear+$i)."</option>";
								}
								?>
							</select>
						</td>
					</tr>
				</table>

				<? if ($payment_process == "signup") { ?>
					<table width="100%" border="0" cellpadding="2" cellspacing="2">
						<tr>
							<td><p class="standardButton paymentButton"><a href="javascript:void(0);" id="itransactbutton" onclick="submitOrder();"><?=system_highlightLastWord(system_showText(LANG_LABEL_PLACE_ORDER_CONTINUE))?></a></p></td>
						</tr>
					</table>
				<? } else { ?>
					<p class="standardButton paymentButton">
						<button type="button" id="itransactbutton" onclick="submitOrder();"><?=system_showText(LANG_BUTTON_PAY_BY_CREDIT_CARD);?></button>
					</p>
				<? } ?>

			</form>

			<?

		}

	}

?>
