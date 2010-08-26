<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_billing_linkpoint.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# INCLUDE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/conf/payment_linkpoint.inc.php");

	if (LINKPOINTPAYMENT_FEATURE == "on") {

		if (!LINKPOINT_CONFIGFILE || !LINKPOINT_KEYFILE) {
			echo "<p class=\"errorMessage\">".system_showText(LANG_LINKPOINT_NO_AVAILABLE)." <a href=\"".DEFAULT_URL."/membros/help.php\" class=\"billing-contact\">".system_showText(LANG_LABEL_ADMINISTRATOR)."</a>.</p>";
		} else {

			$block_bannerbyimpression = false;
			$block_custominvoice = false;

			if ($bill_info["listings"]) foreach ($bill_info["listings"] as $id => $info) {
				$cart_items .= "
					<input type=\"hidden\" name=\"item_id[]\" value=\"$id\" />
					<input type=\"hidden\" name=\"item_name[]\" value=\"".strtolower(ereg_replace("_{2,}","_",ereg_replace("[^a-zA-Z0-9]","_",htmlspecialchars_decode($info["title"]))))."\" />
					<input type=\"hidden\" name=\"item_price[]\" value=\"".$info["total_fee"]."\" />
					<input type=\"hidden\" name=\"item_description[]\" value=\"".strtolower(ereg_replace("_{2,}","_",ereg_replace("[^a-zA-Z0-9]","_",htmlspecialchars_decode($info["title"]))))."\" />
					<input type=\"hidden\" name=\"listing_id[]\" value=\"$id\" />
					<input type=\"hidden\" name=\"listing_price[]\" value=\"".$info["total_fee"]."\" />";
			}

			if ($bill_info["events"]) foreach ($bill_info["events"] as $id => $info) {
				$cart_items .= "
					<input type=\"hidden\" name=\"item_id[]\" value=\"$id\" />
					<input type=\"hidden\" name=\"item_name[]\" value=\"".strtolower(ereg_replace("_{2,}","_",ereg_replace("[^a-zA-Z0-9]","_",htmlspecialchars_decode($info["title"]))))."\" />
					<input type=\"hidden\" name=\"item_price[]\" value=\"".$info["total_fee"]."\" />
					<input type=\"hidden\" name=\"item_description[]\" value=\"".strtolower(ereg_replace("_{2,}","_",ereg_replace("[^a-zA-Z0-9]","_",htmlspecialchars_decode($info["title"]))))."\" />
					<input type=\"hidden\" name=\"event_id[]\" value=\"$id\" />
					<input type=\"hidden\" name=\"event_price[]\" value=\"".$info["total_fee"]."\" />";
			}

			if ($bill_info["banners"]) foreach ($bill_info["banners"] as $id => $info) {
				if ($info["expiration_setting"] == BANNER_EXPIRATION_IMPRESSION) {
					$block_bannerbyimpression = true;
				}
				$cart_items .= "
					<input type=\"hidden\" name=\"item_id[]\" value=\"$id\" />
					<input type=\"hidden\" name=\"item_name[]\" value=\"".strtolower(ereg_replace("_{2,}","_",ereg_replace("[^a-zA-Z0-9]","_",htmlspecialchars_decode($info["caption"]))))."\" />
					<input type=\"hidden\" name=\"item_price[]\" value=\"".$info["total_fee"]."\" />
					<input type=\"hidden\" name=\"item_description[]\" value=\"".strtolower(ereg_replace("_{2,}","_",ereg_replace("[^a-zA-Z0-9]","_",htmlspecialchars_decode($info["caption"]))))."\" />
					<input type=\"hidden\" name=\"banner_id[]\" value=\"$id\" />
					<input type=\"hidden\" name=\"banner_price[]\" value=\"".$info["total_fee"]."\" />";
			}

			if ($bill_info["classifieds"]) foreach ($bill_info["classifieds"] as $id => $info) {
				$cart_items .= "
					<input type=\"hidden\" name=\"item_id[]\" value=\"$id\" />
					<input type=\"hidden\" name=\"item_name[]\" value=\"".strtolower(ereg_replace("_{2,}","_",ereg_replace("[^a-zA-Z0-9]","_",htmlspecialchars_decode($info["title"]))))."\" />
					<input type=\"hidden\" name=\"item_price[]\" value=\"".$info["total_fee"]."\" />
					<input type=\"hidden\" name=\"item_description[]\" value=\"".strtolower(ereg_replace("_{2,}","_",ereg_replace("[^a-zA-Z0-9]","_",htmlspecialchars_decode($info["title"]))))."\" />
					<input type=\"hidden\" name=\"classified_id[]\" value=\"$id\" />
					<input type=\"hidden\" name=\"classified_price[]\" value=\"".$info["total_fee"]."\" />";
			}

			if ($bill_info["articles"]) foreach ($bill_info["articles"] as $id => $info) {
				$cart_items .= "
					<input type=\"hidden\" name=\"item_id[]\" value=\"$id\" />
					<input type=\"hidden\" name=\"item_name[]\" value=\"".strtolower(ereg_replace("_{2,}","_",ereg_replace("[^a-zA-Z0-9]","_",htmlspecialchars_decode($info["title"]))))."\" />
					<input type=\"hidden\" name=\"item_price[]\" value=\"".$info["total_fee"]."\" />
					<input type=\"hidden\" name=\"item_description[]\" value=\"".strtolower(ereg_replace("_{2,}","_",ereg_replace("[^a-zA-Z0-9]","_",htmlspecialchars_decode($info["title"]))))."\" />
					<input type=\"hidden\" name=\"article_id[]\" value=\"$id\" />
					<input type=\"hidden\" name=\"article_price[]\" value=\"".$info["total_fee"]."\" />";
			}

			if ($bill_info["custominvoices"]) foreach($bill_info["custominvoices"] as $id => $info) {
				$block_custominvoice = true;
				$customInvoiceTitle = $info["title"];
				if (strlen($customInvoiceTitle) > 25) $customInvoiceTitle = substr($info["title"], 0, 22)."...";
				$cart_items .= "
					<input type=\"hidden\" name=\"item_id[]\" value=\"$id\" />
					<input type=\"hidden\" name=\"item_name[]\" value=\"".strtolower(ereg_replace("_{2,}","_",ereg_replace("[^a-zA-Z0-9]","_",htmlspecialchars_decode($customInvoiceTitle))))."\" />
					<input type=\"hidden\" name=\"item_price[]\" value=\"".$info["amount"]."\" />
					<input type=\"hidden\" name=\"item_description[]\" value=\"".strtolower(ereg_replace("_{2,}","_",ereg_replace("[^a-zA-Z0-9]","_",htmlspecialchars_decode($customInvoiceTitle))))."\" />
					<input type=\"hidden\" name=\"custominvoice_id[]\" value=\"$id\" />
					<input type=\"hidden\" name=\"custominvoice_price[]\" value=\"".$info["amount"]."\" />";
			}

			$stoppayment = false;

			if ((LINKPOINTRECURRING_FEATURE == "on") && (($block_bannerbyimpression) || ($block_custominvoice))) {
				echo "<p class=\"errorMessage\">";
					if (($block_bannerbyimpression) && ($block_custominvoice)) echo system_showText(LANG_MSG_BANNER_CUSTOM_INVOICE_PAID_ONCE);
					elseif ($block_bannerbyimpression) echo system_showText(LANG_MSG_BANNER_PAID_ONCE);
					elseif ($block_custominvoice) echo system_showText(LANG_MSG_CUSTOM_INVOICE_PAID_ONCE);
					echo "&nbsp;".system_showText(LANG_MSG_PLEASE_DO_NOT_USE_RECURRING_PAYMENT_SYSTEM);
					echo "<br /><a href=\"".DEFAULT_URL."/membros/billing/\">".system_showText(LANG_MSG_TRY_AGAIN)."</a>";
				echo "</p>";
				$stoppayment = true;
			}

			if (!$stoppayment) {

				$contactObj = new Contact(sess_getAccountIdFromSession());
				$linkpoint_name = $contactObj->getString("first_name")." ".$contactObj->getString("last_name");
				$linkpoint_address = $contactObj->getString("address");
				$linkpoint_city = $contactObj->getString("city");
				$linkpoint_state = $contactObj->getString("state");
				$linkpoint_zip = $contactObj->getString("zip");
				$linkpoint_phone = $contactObj->getString("phone");
				$linkpoint_email = $contactObj->getString("email");

				?>

				<script language="javascript" type="text/javascript">
					<!--
					function submitOrder() {
						document.getElementById("linkpointbutton").disabled = true;
						document.linkpointform.submit();
					}
					//-->
				</script>

				<form name="linkpointform" target="_self" action="<?=DEFAULT_URL?>/membros/<?=$payment_process?>/processpayment.php?payment_method=<?=$payment_method?>" method="post">

					<div style="display: none;">

						<?=$cart_items?>

						<input type="hidden" name="pay" id="pay" value="1" />

						<input type="hidden" name="recurring_type" id="recurring_type" value="<?=LINKPOINT_RECURRINGTYPE?>" />

					</div>

					<table align="center" width="95%" cellpadding="2" cellspacing="2" class="standard-table" >
						<tr>
							<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_LABEL_CUSTOMER_INFORMATION)?></th>
						</tr>
						<tr>
							<th>* <?=system_showText(LANG_LABEL_CARD_NUMBER)?>: </th>
							<td><input name="cardnumber" title="<?=system_showText(LANG_LABEL_CARD_NUMBER);?>" value="<?=$cardnumber?>" maxlength="16" /></td>
						</tr>
						<tr>
							<th>* <?=system_showText(LANG_LABEL_CARD_EXPIRATION)?>: </th>
							<td><input name="cardexpmonth" title="Card expiration month" value="<?=$cardexpmonth?>" size="2" maxlength="2" style="width: 25px;" /> / <input name="cardexpyear" title="Card expiration year" value="<?=$cardexpyear?>" size="2" maxlength="2" style="width: 25px;" /> <span><?=system_showText(LANG_LETTER_MONTH).system_showText(LANG_LETTER_MONTH)."/".system_showText(LANG_LETTER_YEAR).system_showText(LANG_LETTER_YEAR);?></span></td>
						</tr>
						<tr>
							<th>* <?=system_showText(LANG_LABEL_NAME_ON_CARD)?>: </th>
							<td><input name="name" title="Name" value="<?=$linkpoint_name?>" size="25" maxlength="100" /></td>
						</tr>
						<tr>
							<th>* <?=system_showText(LANG_LABEL_ADDRESS)?>: </th>
							<td><input name="address1" title="Address" value="<?=$linkpoint_address?>" size="25" maxlength="60" /></td>
						</tr>
						<tr>
							<th>* <?=system_showText(LANG_LABEL_CITY)?>: </th>
							<td><input name="city" title="City" value="<?=$linkpoint_city?>" size="25" maxlength="60" /></td>
						</tr>
						<tr>
							<th>* <?=system_showText(LANG_LABEL_STATE)?>: </th>
							<td>
								<?
								$states = array	(
											"AK" => "AlasKa",
											"AL" => "Alabama",
											"AR" => "Arkansas",
											"AZ" => "Arizona",
											"CA" => "California",
											"CO" => "Colorado",
											"CT" => "Connecticut",
											"DC" => "District of Columbia",
											"DE" => "Delaware",
											"FL" => "Florida",
											"GA" => "Georgia",
											"HI" => "Hawaii",
											"IA" => "Iowa",
											"ID" => "Idaho",
											"IL" => "Illinois",
											"IN" => "Indiana",
											"KS" => "Kansas",
											"KY" => "Kentucky",
											"LA" => "Louisiana",
											"MA" => "Massachusetts",
											"MD" => "Maryland",
											"ME" => "Maine",
											"MI" => "Michigan",
											"MN" => "Minnesota",
											"MO" => "Missouri",
											"MS" => "Mississippi",
											"MT" => "Montana",
											"NC" => "North Carolina",
											"ND" => "North Dakota",
											"NE" => "Nebraska",
											"NH" => "New Hampshire",
											"NJ" => "New Jersey",
											"NM" => "New Mexico",
											"NV" => "Nevada",
											"NY" => "New York",
											"OH" => "Ohio",
											"OK" => "Oklahoma",
											"OR" => "Oregon",
											"PA" => "Pennsylvania",
											"RI" => "Rhode Island",
											"SC" => "South Carolina",
											"SD" => "South Dakota",
											"TN" => "Tenessee",
											"TX" => "Texas",
											"UT" => "Utah",
											"VA" => "Virgina",
											"VT" => "Vermont",
											"WA" => "Washington",
											"WI" => "Wisconsin",
											"WV" => "West Virginia",
											"WY" => "Wyoming"
										);
								?>
								<select name="state" title="State" onchange="this.form.state2.value='';">
									<option value=""><?=system_showText(LANG_MSG_SELECT_A_STATE);?></option>
									<?
									foreach ($states as $state_code => $state_name) {
										$selected = ($linkpoint_state == $state_code || $linkpoint_state == $state_name) ? "selected" : "";
										echo "<option $selected value=\"$state_code\">$state_name</option>\n";
									}
									?>
								</select>
								<input type="text" name="state2" title="Other State code" size="2" maxlength="2" value="" OnChange="if(this.value != '')this.form.state.options[0].selected = true;" />
							</td>
						</tr>
						<tr>
							<th>* <?=ucwords(system_showText(LANG_LABEL_ZIP))?>: </th>
							<td><input name="zip" title="Zip" value="<?=$linkpoint_zip?>" size="25" maxlength="20" /></td>
						</tr>
						<tr>
							<th>* <?=system_showText(LANG_LABEL_COUNTRY)?>: </th>
							<td>
								<?
								$countries = array	(
												"AF" => "Afghanistan",
												"AL" => "Albania",
												"DZ" => "Algeria",
												"AS" => "American Samoa",
												"AD" => "Andorra",
												"AO" => "Angola",
												"AI" => "Anguilla",
												"AQ" => "Antarctica",
												"AG" => "Antigua And Barbuda",
												"AR" => "Argentina",
												"AM" => "Armenia",
												"AW" => "Aruba",
												"AU" => "Australia",
												"AT" => "Austria",
												"AZ" => "Azerbaijan",
												"BS" => "Bahamas",
												"BH" => "Bahrain",
												"BD" => "Bangladesh",
												"BB" => "Barbados",
												"BY" => "Belarus",
												"BE" => "Belgium",
												"BZ" => "Belize",
												"BJ" => "Benin",
												"BM" => "Bermuda",
												"BT" => "Bhutan",
												"BO" => "Bolivia",
												"BA" => "Bosnia And Herzegowina",
												"BW" => "Botswana",
												"BV" => "Bouvet Island",
												"BR" => "Brazil",
												"IO" => "British Indian Ocean Territory",
												"BN" => "Brunei Darussalam",
												"BG" => "Bulgaria",
												"BF" => "Burkina Faso",
												"BI" => "Burundi",
												"KH" => "Cambodia",
												"CM" => "Cameroon",
												"CA" => "Canada",
												"CV" => "Cape Verde",
												"KY" => "Cayman Islands",
												"CF" => "Central African Republic",
												"TD" => "Chad",
												"CL" => "Chile",
												"CN" => "China",
												"CX" => "Christmas Island",
												"CC" => "Cocos (Keeling) Islands",
												"CO" => "Colombia",
												"KM" => "Comoros",
												"CG" => "Congo",
												"CK" => "Cook Islands",
												"CR" => "Costa Rica",
												"CI" => "Cote D'Ivoire",
												"HR" => "Croatia",
												"CU" => "Cuba",
												"CY" => "Cyprus",
												"CZ" => "Czech Republic",
												"DK" => "Denmark",
												"DJ" => "Djibouti",
												"DM" => "Dominica",
												"DO" => "Dominican Republic",
												"TP" => "East Timor",
												"EC" => "Ecuador",
												"EG" => "Egypt",
												"SV" => "El Salvador",
												"GQ" => "Equatorial Guinea",
												"ER" => "Eritrea",
												"EE" => "Estonia",
												"ET" => "Ethiopia",
												"FK" => "Falkland Islands",
												"FO" => "Faroe Islands",
												"FJ" => "Fiji",
												"FI" => "Finland",
												"FR" => "France",
												"FX" => "France, Metropolitan",
												"GF" => "French Guiana",
												"PF" => "French Polynesia",
												"TF" => "French Southern Territories",
												"GA" => "Gabon",
												"GM" => "Gambia",
												"GE" => "Georgia",
												"DE" => "Germany",
												"GH" => "Ghana",
												"GI" => "Gibraltar",
												"GR" => "Greece",
												"GL" => "Greenland",
												"GD" => "Grenada",
												"GP" => "Guadeloupe",
												"GU" => "Guam",
												"GT" => "Guatemala",
												"GN" => "Guinea",
												"GW" => "Guinea-Bissau",
												"GY" => "Guyana",
												"HT" => "Haiti",
												"HM" => "Heard And Mc Donald Islands",
												"HN" => "Honduras",
												"HK" => "Hong Kong",
												"HU" => "Hungary",
												"IS" => "Iceland",
												"IN" => "India",
												"ID" => "Indonesia",
												"IR" => "Iran",
												"IQ" => "Iraq",
												"IE" => "Ireland",
												"IL" => "Israel",
												"IT" => "Italy",
												"JM" => "Jamaica",
												"JP" => "Japan",
												"JO" => "Jordan",
												"KZ" => "Kazakhstan",
												"KE" => "Kenya",
												"KI" => "Kiribati",
												"KP" => "North Korea",
												"KR" => "South Korea",
												"KW" => "Kuwait",
												"KG" => "Kyrgyzstan",
												"LA" => "Lao People's Republic",
												"LV" => "Latvia",
												"LB" => "Lebanon",
												"LS" => "Lesotho",
												"LR" => "Liberia",
												"LY" => "Libyan Arab Jamahiriya",
												"LI" => "Liechtenstein",
												"LT" => "Lithuania",
												"LU" => "Luxembourg",
												"MO" => "Macau",
												"MK" => "Macedonia",
												"MG" => "Madagascar",
												"MW" => "Malawi",
												"MY" => "Malaysia",
												"MV" => "Maldives",
												"ML" => "Mali",
												"MT" => "Malta",
												"MH" => "Marshall Islands",
												"MQ" => "Martinique",
												"MR" => "Mauritania",
												"MU" => "Mauritius",
												"YT" => "Mayotte",
												"MX" => "Mexico",
												"FM" => "Micronesia",
												"MD" => "Moldova",
												"MC" => "Monaco",
												"MN" => "Mongolia",
												"MS" => "Montserrat",
												"MA" => "Morocco",
												"MZ" => "Mozambique",
												"MM" => "Myanmar",
												"NA" => "Namibia",
												"NR" => "Nauru",
												"NP" => "Nepal",
												"NL" => "Netherlands",
												"AN" => "Netherlands Antilles",
												"NC" => "New Caledonia",
												"NZ" => "New Zealand",
												"NI" => "Nicaragua",
												"NE" => "Niger",
												"NG" => "Nigeria",
												"NU" => "Niue",
												"NF" => "Norfolk Island",
												"MP" => "Northern Mariana Islands",
												"NO" => "Norway",
												"OM" => "Oman",
												"PK" => "Pakistan",
												"PW" => "Palau",
												"PA" => "Panama",
												"PG" => "Papua New Guinea",
												"PY" => "Paraguay",
												"PE" => "Peru",
												"PH" => "Philippines",
												"PN" => "Pitcairn",
												"PL" => "Poland",
												"PT" => "Portugal",
												"PR" => "Puerto Rico",
												"QA" => "Qatar",
												"RE" => "Reunion",
												"RO" => "Romania",
												"RU" => "Russian Federation",
												"RW" => "Rwanda",
												"KN" => "Saint Kitts And Nevis",
												"LC" => "Saint Lucia",
												"VC" => "Saint Vincent And The Grenadines",
												"WS" => "Samoa",
												"SM" => "San Marino",
												"ST" => "Sao Tome And Principe",
												"SA" => "Saudi Arabia",
												"SN" => "Senegal",
												"SC" => "Seychelles",
												"SL" => "Sierra Leone",
												"SG" => "Singapore",
												"SK" => "Slovakia",
												"SI" => "Slovenia",
												"SB" => "Solomon Islands",
												"SO" => "Somalia",
												"ZA" => "South Africa",
												"GS" => "South Georgia &amp; South Sandwich Islands",
												"ES" => "Spain",
												"LK" => "Sri Lanka",
												"SH" => "St Helena",
												"PM" => "St Pierre and Miquelon",
												"SD" => "Sudan",
												"SR" => "Suriname",
												"SJ" => "Svalbard And Jan Mayen Islands",
												"SZ" => "Swaziland",
												"SE" => "Sweden",
												"CH" => "Switzerland",
												"SY" => "Syrian Arab Republic",
												"TW" => "Taiwan",
												"TJ" => "Tajikistan",
												"TZ" => "Tanzania",
												"TH" => "Thailand",
												"TG" => "Togo",
												"TK" => "Tokelau",
												"TO" => "Tonga",
												"TT" => "Trinidad And Tobago",
												"TN" => "Tunisia",
												"TR" => "Turkey",
												"TM" => "Turkmenistan",
												"TC" => "Turks And Caicos Islands",
												"TV" => "Tuvalu",
												"UG" => "Uganda",
												"UA" => "Ukraine",
												"AE" => "United Arab Emirates",
												"GB" => "United Kingdom/Great Britain",
												"US" => "United States",
												"UM" => "United States Minor Outlying Islands",
												"UY" => "Uruguay",
												"UZ" => "Uzbekistan",
												"VU" => "Vanuatu",
												"VA" => "Vatican City State",
												"VE" => "Venezuela",
												"VN" => "Viet Nam",
												"VG" => "Virgin Islands (British)",
												"VI" => "Virgin Islands (U.S.)",
												"WF" => "Wallis And Futuna Islands",
												"EH" => "Western Sahara",
												"YE" => "Yemen",
												"ZR" => "Zaire",
												"ZM" => "Zambia",
												"ZW" => "Zimbabwe",
												"ZZ" => "Other-Not Shown"
											);
								?>
								<select name="country" title="Country" OnChange="this.form.state.options[0].selected = true; this.form.state2.value='';">
									<option value=""><?=system_showText(LANG_MSG_SELECT_A_COUNTRY);?></option>
									<?
									foreach ($countries as $country_code => $country_name) {
										$selected = ($country_code == "US") ? "selected" : "";
										echo "<option $selected value=\"$country_code\">$country_name</option>";
									}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<th>* <?=system_showText(LANG_LABEL_PHONE)?>: </th>
							<td><input name="phone" title="<?=system_showText(LANG_LABEL_PHONE)?>" value="<?=$linkpoint_phone?>" size="25" maxlength="25" /></td>
						</tr>
						<tr>
							<th>* <?=system_showText(LANG_LABEL_EMAIL)?>: </th>
							<td><input name="email" title="E-mail" value="<?=$linkpoint_email?>" size="25" maxlength="60" /></td>
						</tr>
					</table>

					<?
					if (LINKPOINTRECURRING_FEATURE == "on") {
						echo "<div class=\"response-msg notice ui-corner-all\">";
						echo system_showText(LANG_MSG_RECURRINGUNTILCARDEXPIRATION).".";
						echo "</div>";
					}
					?>

					<? if ($payment_process == "signup") { ?>
						<table width="100%" border="0" cellpadding="2" cellspacing="2">
							<tr>
								<td><p class="standardButton paymentButton"><a href="javascript:void(0);" id="linkpointbutton" onclick="submitOrder();"><?=system_highlightLastWord(system_showText(LANG_LABEL_PLACE_ORDER_CONTINUE))?></a></p></td>
							</tr>
						</table>
					<? } else { ?>
						<p class="standardButton paymentButton">
							<button type="button" id="linkpointbutton" onclick="submitOrder();"><?=system_showText(LANG_BUTTON_PAY_BY_CREDIT_CARD);?></button>
						</p>
					<? } ?>

				</form>

				<?

			}

		}

	}

?>
