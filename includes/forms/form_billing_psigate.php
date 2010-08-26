<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form_billing_psigate.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# INCLUDE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/conf/payment_psigate.inc.php");

	if (PSIGATEPAYMENT_FEATURE == "on") {

		if (!PSIGATE_STOREID || !PSIGATE_PASSPHRASE) {
			echo "<p class=\"errorMessage\">".system_showText(LANG_PSIGATE_NO_AVAILABLE)." <a href=\"".DEFAULT_URL."/membros/help.php\" class=\"billing-contact\">".system_showText(LANG_LABEL_ADMINISTRATOR)."</a>.</p>";
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
			$psigate_x_subtotal = str_replace(",", ".", $bill_info["total_bill"]);
			$psigate_x_bname = $contactObj->getString("first_name")." ".$contactObj->getString("last_name");
			$psigate_x_bcompany = $contactObj->getString("company");
			$psigate_x_baddress1 = $contactObj->getString("address");
			$psigate_x_baddress2 = $contactObj->getString("address2");
			$psigate_x_bcity = $contactObj->getString("city");
			$psigate_x_bprovince = $contactObj->getString("state");
			$psigate_x_bpostalcode = $contactObj->getString("zip");
			$psigate_x_bcountry = $contactObj->getString("country");
			$psigate_x_phone = $contactObj->getString("phone");
			$psigate_x_fax = $contactObj->getString("fax");
			$psigate_x_email = $contactObj->getString("email");

			?>

			<script language="javascript" type="text/javascript">
				<!--
				function submitOrder() {
					document.getElementById("psigatebutton").disabled = true;
					document.psigateform.submit();
				}
				//-->
			</script>

			<form name="psigateform" target="_self" action="<?=DEFAULT_URL?>/membros/<?=$payment_process?>/processpayment.php?payment_method=<?=$payment_method?>" method="post">

				<div style="display: none;">

					<input type="hidden" name="pay" value="1" />

					<input type="hidden" name="x_listing_ids" value="<?=$listing_ids?>" />
					<input type="hidden" name="x_listing_amounts" value="<?=$listing_amounts?>" />
					<input type="hidden" name="x_event_ids" value="<?=$event_ids?>" />
					<input type="hidden" name="x_event_amounts" value="<?=$event_amounts?>" />
					<input type="hidden" name="x_banner_ids" value="<?=$banner_ids?>" />
					<input type="hidden" name="x_banner_amounts" value="<?=$banner_amounts?>" />
					<input type="hidden" name="x_classified_ids" value="<?=$classified_ids?>" />
					<input type="hidden" name="x_classified_amounts" value="<?=$classified_amounts?>" />
					<input type="hidden" name="x_article_ids" value="<?=$article_ids?>" />
					<input type="hidden" name="x_article_amounts" value="<?=$article_amounts?>" />
					<input type="hidden" name="x_custominvoice_ids" value="<?=$custominvoice_ids?>" />
					<input type="hidden" name="x_custominvoice_amounts" value="<?=$custominvoice_amounts?>" />

					<input type="hidden" name="x_subtotal" value="<?=$psigate_x_subtotal?>" />

				</div>

				<table align="center" width="95%" cellpadding="2" cellspacing="2" class="standard-table">
					<tr>
						<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_LABEL_BILLING_INFO);?></th>
					</tr>
					<tr>
						<th>* <?=system_showText(LANG_LABEL_CARD_NUMBER);?>:</th>
						<td>
							<input type="text" name="x_card_number" value="" />
						</td>
					</tr>
					<tr>
						<th>* <?=system_showText(LANG_LABEL_CARD_EXPIRE_DATE);?>:</th>
						<td>
							<select name="x_card_exp_month" style="width: 50px;">
								<option value=""></option>
								<?
								for ($i=1; $i<=12; $i++) {
									if (strlen($i) < 2) echo "<option value=\"0".$i."\">0".$i."</option>";
									else echo "<option value=\"".$i."\">".$i."</option>";
								}
								?>
							</select>
							/
							<select name="x_card_exp_year" style="width: 50px;">
								<option value=""></option>
								<?
								for ($i=date("y"); $i<=date("y")+10; $i++) {
									if (strlen($i) < 2) echo "<option value=\"0".$i."\">0".$i."</option>";
									else echo "<option value=\"".$i."\">".$i."</option>";
								}
								?>
							</select>
							<span><?=system_showText(LANG_LETTER_MONTH).system_showText(LANG_LETTER_MONTH)."/".system_showText(LANG_LETTER_YEAR).system_showText(LANG_LETTER_YEAR);?></span>
						</td>
					</tr>
					<tr>
						<th>* <?=system_showText(LANG_LABEL_CARD_CODE);?>:</th>
						<td>
							<input type="text" name="x_card_id_number" value="" />
						</td>
					</tr>
					<tr>
						<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_LABEL_CUSTOMER_INFO);?></td>
					</tr>
					<tr>
						<th><?=system_showText(LANG_LABEL_NAME);?>:</th>
						<td><input type="text" name="x_bname" value="<?=$psigate_x_bname?>" /></td>
					</tr>
					<tr>
						<th><?=system_showText(LANG_LABEL_COMPANY);?>:</th>
						<td><input type="text" name="x_bcompany" value="<?=$psigate_x_bcompany?>" /></td>
					</tr>
					<tr>
						<th><?=system_showText(LANG_LABEL_ADDRESS1);?>:</th>
						<td><input type="text" name="x_baddress1" value="<?=$psigate_x_baddress1?>" /></td>
					</tr>
					<tr>
						<th><?=system_showText(LANG_LABEL_ADDRESS2);?>:</th>
						<td><input type="text" name="x_baddress2" value="<?=$psigate_x_baddress2?>" /></td>
					</tr>
					<tr>
						<th><?=system_showText(LANG_LABEL_CITY)?>:</th>
						<td><input  type="text" name="x_bcity" value="<?=$psigate_x_bcity?>" /></td>
					</tr>
					<tr>
						<th><?=system_showText(LANG_LABEL_PROVINCE);?>:</th>
						<td><input type="text" name="x_bprovince" value="<?=$psigate_x_bprovince?>" /></td>
					</tr>
					<tr>
						<th><?=system_showText(LANG_LABEL_POSTAL_CODE);?>:</th>
						<td><input type="text" name="x_bpostalcode" value="<?=$psigate_x_bpostalcode?>" /></td>
					</tr>
					<tr>
						<th><?=system_showText(LANG_LABEL_COUNTRY)?>:</th>
						<td>
							<?
							$countries = array(
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
							<select name="x_bcountry" style="width: 300px;">
								<option value=""></option>
								<?
								foreach ($countries as $country_code => $country_name) {
									if (($psigate_x_bcountry == $country_code) || ($psigate_x_bcountry == $country_name)) $selected = "selected";
									else $selected = "";
									echo "<option ".$selected." value=\"".$country_code."\">".$country_name."</option>";
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<th><?=system_showText(LANG_LABEL_PHONE)?>:</th>
						<td><input type="text" name="x_phone" value="<?=$psigate_x_phone?>" /></td>
					</tr>
					<tr>
						<th><?=system_showText(LANG_LABEL_FAX)?>:</th>
						<td><input type="text" name="x_fax" value="<?=$psigate_x_fax?>" /></td>
					</tr>
					<tr>
						<th><?=system_showText(LANG_LABEL_EMAIL);?>:</th>
						<td><input type="text" name="x_email" value="<?=$psigate_x_email?>" /></td>
					</tr>
				</table>

				<? if ($payment_process == "signup") { ?>
					<table width="100%" border="0" cellpadding="2" cellspacing="2">
						<tr>
							<td><p class="standardButton paymentButton"><a href="javascript:void(0);" id="psigatebutton" onclick="submitOrder();"><?=system_highlightLastWord(system_showText(LANG_LABEL_PLACE_ORDER_CONTINUE))?></a></p></td>
						</tr>
					</table>
				<? } else { ?>
					<p class="standardButton paymentButton">
						<button type="button" id="psigatebutton" onclick="submitOrder();"><?=system_showText(LANG_BUTTON_PAY_BY_CREDIT_CARD);?></button>
					</p>
				<? } ?>

			</form>

			<?

		}

	}

?>
