<?
	include("./conf/loadconfig.inc.php");
	session_start();

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	$listLevelObj = new ListingLevel();
	$listLevelValue = $listLevelObj->getValues();
	if (!in_array($level, $listLevelValue)) {
		//header("Location: ".DEFAULT_URL."/advertise.php?listing");
		//exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if (($_SERVER['REQUEST_METHOD'] == "POST")) {
		$_POST["friendly_url"] = str_replace(".htm", "", $_POST["friendly_url"]);
		$_POST["friendly_url"] = str_replace(".html", "", $_POST["friendly_url"]);
		$_POST["friendly_url"] = trim($_POST["friendly_url"]);
		$_POST["friendly_url"] = system_denyInjections($_POST["friendly_url"]);
		$_POST["friendly_url"] = $_POST["friendly_url"].FRIENDLYURL_SEPARATOR.uniqid();
		$friendly_url = $_POST["friendly_url"];

		$request_method_seckey = "post";
		include(EDIRECTORY_ROOT."/includes/code/seckey.php");
		$validate_account = validate_addAccount($_POST, $message_account);
		$validate_contact = validate_form("contact", $_POST, $message_contact);
		$tmpEMAIL = $_POST["email"];
		unset($_POST["email"]);
		$validate_listing = validate_form("listing", $_POST, $message_listing);
		$_POST["email"] = $tmpEMAIL;
		$validate_discount = is_valid_discount_code($_POST["discount_id"], "listing", $_POST["id"], $message_discount, $discount_error_num);

		if ($boolean_seckey && $validate_account && $validate_contact && $validate_listing && $validate_discount) {
			
			$account = new Account($_POST);
			$account->save();
			
			$contact = new Contact($_POST);
			$contact->setNumber("account_id", $account->getNumber("id"));
			$contact->save();
			
			unset($_POST["email"]);
			unset($_POST["phone"]);
			unset($_POST["address"]);
			unset($_POST["address2"]);
			$listing = new Listing($_POST);
			$listing->setNumber("account_id", $account->getNumber("id"));
			$status = new ItemStatus();
			$listing->setString("status", $status->getDefaultStatus());
			$listing->setDate("renewal_date", "00/00/0000");
			$listing->Save();
			
			$return_categories_array = explode(",", $return_categories);
			$listing->setCategories($return_categories_array);
		
			/**************************************************************************************************/
			/*                                                                                                */
			/* E-mail notify                                                                                  */
			/*                                                                                                */
			/**************************************************************************************************/
			setting_get("sitemgr_send_email",$sitemgr_send_email);
			setting_get("sitemgr_email",$sitemgr_email);
			$sitemgr_emails = split(",",$sitemgr_email);
			if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];
			setting_get("sitemgr_account_email",$sitemgr_account_email);
			$sitemgr_account_emails = split(",",$sitemgr_account_email);
			setting_get("sitemgr_listing_email",$sitemgr_listing_email);
			$sitemgr_listing_emails = split(",",$sitemgr_listing_email);
			
			// sending e-mail to user //////////////////////////////////////////////////////////////////////////
			if ($emailNotificationObj = system_checkEmail(SYSTEM_LISTING_SIGNUP, $contact->getString("lang"))) {
				$subject = $emailNotificationObj->getString("subject");
				$body = $emailNotificationObj->getString("body");
				$body = str_replace("ACCOUNT_USERNAME",$_POST["username"],$body);
				$body = str_replace("ACCOUNT_PASSWORD",$_POST["password"],$body);
				$body = system_replaceEmailVariables($body, $listing->getNumber('id'), 'listing');
				$subject = system_replaceEmailVariables($subject, $listing->getNumber('id'), 'listing');
				$body = html_entity_decode($body);
				$subject = html_entity_decode($subject);
				//system_mail($contact->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error);
			} 

			////////////////////////////////////////////////////////////////////////////////////////////////////
			
			// site manager warning message ////////////////////////////////////////////////////////////////////
			
			$sitemgr_msg = "
				<html>
					<head>
						<style>
							.email_style_settings{
								font-size:12px;
								font-family:Verdana, Arial, Sans-Serif;
								color:#000;
							}
						</style>
					</head>
					<body>
						<div class=\"email_style_settings\">

							Site Manager,<br /><br />
							New signup in ".EDIRECTORY_TITLE.".<br /><br />
							Account:<br /><br />";
							$sitemgr_msg .= "<b>Username: </b>".$account->getString("username")."<br />";
							$sitemgr_msg .= "<b>First name: </b>".$contact->getString("first_name")."<br />";
							$sitemgr_msg .= "<b>Last name: </b>".$contact->getString("last_name")."<br />";
							$sitemgr_msg .= "<b>Company: </b>".$contact->getString("company")."<br />";
							$sitemgr_msg .= "<b>Address: </b>".$contact->getString("address")." ".$contact->getString("address2")."<br />";
							$sitemgr_msg .= "<b>City: </b>".$contact->getString("city")."<br />";
							$sitemgr_msg .= "<b>State: </b>".$contact->getString("state")."<br />";
							$sitemgr_msg .= "<b>".ucwords(ZIPCODE_LABEL).": </b>".$contact->getString("zip")."<br />";
							$sitemgr_msg .= "<b>Country: </b>".$contact->getString("country")."<br />";
							$sitemgr_msg .= "<b>Phone: </b>".$contact->getString("phone")."<br />";
							$sitemgr_msg .= "<b>E-mail: </b>".$contact->getString("email")."<br />";
							$sitemgr_msg .= "<br /><a href=\"".DEFAULT_URL."/gerenciamento/account/view.php?id=".$account->getNumber("id")."\" target=\"_blank\">".DEFAULT_URL."/gerenciamento/account/view.php?id=".$account->getNumber("id")."</a><br /><br />";
							$sitemgr_msg .= ucwords(LISTING_FEATURE_NAME).":<br /><br />";
							$sitemgr_msg .= "<b>Title: </b>".$listing->getString("title")."<br />";
							$sitemgr_msg .= "<br /><a href=\"".DEFAULT_URL."/gerenciamento/estabelecimentos/view.php?id=".$listing->getNumber("id")."\" target=\"_blank\">".DEFAULT_URL."/gerenciamento/estabelecimentos/view.php?id=".$listing->getNumber("id")."</a><br /><br />
						</div>
					</body>
				</html>";
			if ($sitemgr_send_email == "on") {
				if ($sitemgr_emails[0]) {
					foreach ($sitemgr_emails as $sitemgr_email) {
					//system_mail($sitemgr_email, "[".EDIRECTORY_TITLE."] Signup Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_email>", "text/html", '', '', $error);
					}
				}
			}
			if ($sitemgr_account_emails[0]) {
				foreach ($sitemgr_account_emails as $sitemgr_account_email) {
					//system_mail($sitemgr_account_email, "[".EDIRECTORY_TITLE."] Signup Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_account_email>", "text/html", '', '', $error);
				}
			}
			if ($sitemgr_listing_emails[0]) {
				foreach ($sitemgr_listing_emails as $sitemgr_listing_email) {
				//system_mail($sitemgr_listing_email, "[".EDIRECTORY_TITLE."] Signup Notification", $sitemgr_msg, EDIRECTORY_TITLE." <".$sitemgr_listing_email.">", "text/html", '', '', $error);
				}
			} 
			////////////////////////////////////////////////////////////////////////////////////////////////////

			if ($checkout) $payment_method = "checkout";

			sess_registerAccountInSession($account->getString("username"));
			setcookie("username", $account->getString("username"), time()+60*60*24*30, "".EDIRECTORY_FOLDER."/membros");

			$payment_method == "checkout";
			
			//if ($payment_method == "checkout") {
				//header("Location: ".DEFAULT_URL."/membros/listing/listing.php?id=".$listing->getNumber("id")."&process=signup");
				header("Location: ".DEFAULT_URL."/membros/listing");
				exit();
			//} elseif ($payment_method == "invoice") {
			//	header("Location: ".DEFAULT_URL."/membros/signup/invoice.php");
			//} else {
			//	header("Location: ".DEFAULT_URL."/membros/signup/payment.php?payment_method=".$payment_method);
			//}
			

		} else {

			if (($pos = strrpos($_POST["friendly_url"], FRIENDLYURL_SEPARATOR)) !== false) {
				$_POST["friendly_url"] = substr($_POST["friendly_url"], 0, $pos);
			}

			// removing slashes added if required
			$_POST = format_magicQuotes($_POST);
			$_GET  = format_magicQuotes($_GET);
			extract($_POST);
			extract($_GET);

		}

	}

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	if ($return_categories){
		$return_categories_array = explode(",", $return_categories);
		if ($return_categories_array){
			foreach ($return_categories_array as $each_category){
				$categories[] = new ListingCategory($each_category);
			}
		}
	}
	$feedDropDown = "<select name=\"feed\" multiple size=\"5\">";
	$catSelected = 0;
	if ($categories) {
		foreach ($categories as $category) {
			$name = $category->getString("title");
			$feedDropDown .= "<option value='".$category->getNumber("id")."'>$name</option>";
			$catSelected++;
		}
	}
	$feedDropDown .= "</select>";

	$listingLevelObj = new ListingLevel();
	$levelValue = $listingLevelObj->getValues();

	$formloginaction = ((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : NON_SECURE_URL)."/membros/login.php?destiny=".EDIRECTORY_FOLDER."/membros/listing/listinglevel.php";

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	$extrastyle = array(DEFAULT_URL."/layout/general_order.css");
	include(EDIRECTORY_ROOT."/layout/header_results.php");

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	$template_title_field = false;

?>

	<script language="javascript" type="text/javascript">
		<!--

		function orderCalculate() {
			
			var xmlhttp;
			
			try {
				xmlhttp = new XMLHttpRequest();
			} catch (e) {
				try {
					xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try {
						xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e) {
						xmlhttp = false;
					}
				}
			}
			
			if (document.getElementById("check_out_payment")) document.getElementById("check_out_payment").className = "isHidden";
			if (document.getElementById("check_out_free")) document.getElementById("check_out_free").className = "isHidden";
			if (document.getElementById("loadingOrderCalculate")) document.getElementById("loadingOrderCalculate").style.display = "";
			if (document.getElementById("loadingOrderCalculate")) document.getElementById("loadingOrderCalculate").innerHTML = "<?=system_showText(LANG_WAITLOADING)?>";
			if (xmlhttp) {
				xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4) {
						if (xmlhttp.status == 200) {
							var price = xmlhttp.responseText;
							<? if ((PAYMENT_FEATURE == "on") && ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on"))) { ?>
								if (price > 0) {
									if (document.getElementById("check_out_payment")) document.getElementById("check_out_payment").className = "isVisible";
									if (document.getElementById("checkoutpayment_total")) document.getElementById("checkoutpayment_total").innerHTML = "<strong><?=system_showText(LANG_TOTALPRICEAMOUNT)?>: </strong><?=CURRENCY_SYMBOL?>"+price.substring(0, price.length-2)+"."+price.substring(price.length-2, price.length);
								} else {
									if (document.getElementById("check_out_free")) document.getElementById("check_out_free").className = "isVisible";
									if (document.getElementById("checkoutfree_total")) document.getElementById("checkoutfree_total").innerHTML = "<strong><?=system_showText(LANG_TOTALPRICEAMOUNT)?>: </strong><?=CURRENCY_SYMBOL?><?=system_showText(LANG_FREE)?>";
								}
							<? } else { ?>
								if (document.getElementById("check_out_free")) document.getElementById("check_out_free").className = "isVisible";
								if (price > 0) {
									if (document.getElementById("checkoutfree_total")) document.getElementById("checkoutfree_total").innerHTML = "<strong><?=system_showText(LANG_TOTALPRICEAMOUNT)?>: </strong><?=CURRENCY_SYMBOL?>"+price.substring(0, price.length-2)+"."+price.substring(price.length-2, price.length);
								} else {
									if (document.getElementById("checkoutfree_total")) document.getElementById("checkoutfree_total").innerHTML = "<strong><?=system_showText(LANG_TOTALPRICEAMOUNT)?>: </strong><?=CURRENCY_SYMBOL?><?=system_showText(LANG_FREE)?>";
								}
							<? } ?>
							if (document.getElementById("loadingOrderCalculate")) document.getElementById("loadingOrderCalculate").style.display = "none";
							if (document.getElementById("loadingOrderCalculate")) document.getElementById("loadingOrderCalculate").innerHTML = "";
						}
					}
				}
				var get_level = 0;
				if (document.order_listing.level) get_level = document.order_listing.level.value;
				var get_categories = 0;
				if (document.order_listing.feed) get_categories = document.order_listing.feed.length;
				var get_listingtemplate_id = 0;
				if (document.order_listing.listingtemplate_id) get_listingtemplate_id = document.order_listing.listingtemplate_id.value;
				var get_discount_id = "";
				if (document.order_listing.discount_id) get_discount_id = document.order_listing.discount_id.value;
				xmlhttp.open("GET", "<?=DEFAULT_URL;?>/ordercalculateprice.php?item=listing&level="+get_level+"&categories="+get_categories+"&listingtemplate_id="+get_listingtemplate_id+"&discount_id="+get_discount_id, true);
				xmlhttp.send(null);
			}
		}

		function switchFormUserDisplay(user) {
			if (user == "newuser") {
				document.getElementById("formFacebookUser").className = "isHidden";
				document.getElementById("formOpenIDUser").className = "isHidden";
				document.getElementById("formDirectoryUser").className = "isHidden";
				document.getElementById("formNewUser").className = "isVisible";
			}
			if (user == "directoryuser") {
				document.getElementById("formFacebookUser").className = "isHidden";
				document.getElementById("formOpenIDUser").className = "isHidden";
				document.getElementById("formDirectoryUser").className = "isVisible";
				document.getElementById("formNewUser").className = "isHidden";
			}
			if (user == "openiduser") {
				document.getElementById("formFacebookUser").className = "isHidden";
				document.getElementById("formOpenIDUser").className = "isVisible";
				document.getElementById("formDirectoryUser").className = "isHidden";
				document.getElementById("formNewUser").className = "isHidden";
			}
			if (user == "facebookuser") {
				document.getElementById("formFacebookUser").className = "isVisible";
				document.getElementById("formOpenIDUser").className = "isHidden";
				document.getElementById("formDirectoryUser").className = "isHidden";
				document.getElementById("formNewUser").className = "isHidden";
			}
		}

		<? if (LISTINGTEMPLATE_FEATURE == "on") { ?>
			function templateSwitch(template) {
				if (!template) template = 0;
				<?
				$dbObjLT = db_getDBObJect();
				$sqlLT = "SELECT id FROM ListingTemplate WHERE status = 'enabled' ORDER BY title";
				$resultLT = $dbObjLT->query($sqlLT);
				echo "var title_template_0 = '".system_showText(LANG_LABEL_TITLE).":';";
				while ($rowLT = mysql_fetch_assoc($resultLT)) {
					$listingtemplate = new ListingTemplate($rowLT["id"]);
					$template_title_field = $listingtemplate->getListingTemplateFields("title");
					echo "var title_template_".$listingtemplate->getNumber("id")." = '".addslashes(($template_title_field!==false) ? $template_title_field[0]["label"] : system_showText(LANG_LABEL_TITLE)).":';";
				}
				?>
				document.order_listing.listingtemplate_id.value = template;
				if (document.getElementById("title_label")) document.getElementById("title_label").innerHTML = eval("title_template_" + template);
				orderCalculate();
				loadCategoryTree('template', 'listing_', 'ListingCategory', 0, template, '<?=EDIRECTORY_FOLDER?>');
				document.formDirectory.action = "<?=$formloginaction?>&query=level=" + document.order_listing.level.value + "&listingtemplate_id=" + document.order_listing.listingtemplate_id.value;
				document.formOpenID.action = "<?=$formloginaction?>&query=level=" + document.order_listing.level.value + "&listingtemplate_id=" + document.order_listing.listingtemplate_id.value;
			}
		<? } ?>

		function levelSwitch(level) {
			<?
			foreach ($levelValue as $value) {
				echo "var extracat_note_".$value." = '".system_showText(($listingLevelObj->getFreeCategory($value) > 1) ? LANG_CATEGORY_PLURAL : LANG_CATEGORY)." <strong>".system_showText(LANG_FREE).": ".$listingLevelObj->getFreeCategory($value)."</strong>. ".system_showText(LANG_CATEGORIES_PRICEDESC1)." <strong>".system_showText(LANG_CATEGORIES_PRICEDESC2)." ".CURRENCY_SYMBOL." ".$listingLevelObj->getCategoryPrice($value)."</strong> ".system_showText(LANG_CATEGORIES_PRICEDESC3)."';";
			}
			?>
			document.order_listing.level.value = level;
			if (document.getElementById("extracategory_note")) document.getElementById("extracategory_note").innerHTML = eval("extracat_note_" + level);
			orderCalculate();
			document.formDirectory.action = "<?=$formloginaction?>&query=level=" + document.order_listing.level.value + "&listingtemplate_id=" + document.order_listing.listingtemplate_id.value;
			document.formOpenID.action = "<?=$formloginaction?>&query=level=" + document.order_listing.level.value + "&listingtemplate_id=" + document.order_listing.listingtemplate_id.value;
		}

		function JS_addCategory(text, id) {
			seed = document.order_listing.seed;
			feed = document.order_listing.feed;
			var flag=true;
			for (i=0;i<feed.length;i++) if (feed.options[i].value==id) flag=false;
			if (text && id && flag) {
				feed.options[feed.length] = new Option(text, id);
				orderCalculate();
				alert('<?=ucwords(system_showText(LANG_CATEGORY))?> "'+text+'" <?=system_showText(LANG_MSG_CATEGORY_SUCCESSFULLY_ADDED)?>!');
			} else {
				if (!flag) alert("<?=system_showText(LANG_MSG_CATEGORY_ALREADY_INSERTED)?>");
				else alert("<?=system_showText(LANG_CATEGORY_INVALIDERROR)?>");
			}
		}

		function JS_removeCategory() {
			feed = document.order_listing.feed;
			if (feed.selectedIndex >= 0) {
				feed.remove(feed.selectedIndex);
				orderCalculate();
			}
		}

		function JS_displayCategoryPath() {
			feed = document.order_listing.feed;
			if (feed.selectedIndex == -1) {
				alert("<?=system_showText(LANG_CATEGORY_SELECTFIRSTERROR)?>");
			} else {
				var winl = (((screen.width) / 2) - 350);
				var wint = (((screen.height) / 2) - 150);
				var winprop = 'titlebar=no, toolbar=no, location=no, directories=no, status=no, width=700, height=150, left='+winl+', top='+wint+', menubar=no, scrollbars=yes, resizable=yes';
				window.open("<?=DEFAULT_URL?>/membros/listing/category_detail.php?id="+feed.options[feed.selectedIndex].value, "popup", winprop);
			}
			return;
		}

		function JS_submit() {
			feed = document.order_listing.feed;
			return_categories = document.order_listing.return_categories;
			if(return_categories.value.length > 0) return_categories.value = "";
			for (i=0;i<feed.length;i++) {
				if (!isNaN(feed.options[i].value)) {
					if (return_categories.value.length > 0) return_categories.value = return_categories.value + "," + feed.options[i].value;
					else return_categories.value = return_categories.value + feed.options[i].value;
				}
			}
		}

		//-->
	</script>

	<?
	$checkoutpayment_class = "isHidden";
	$checkoutfree_class = "isHidden";
	?>
	<div id="consulta"><h5></h5></div>
	<div id="registro_position">

<table border="0" cellpadding="0" cellspacing="0" class="orderTable">
		<tr>
			<!--<th class="standardSubTitle"><?=system_showText(LANG_SELECTPACKAGE)?></th>
			 <td class="standardSubTitle"><?=system_showText(LANG_ALREADYHAVEACCOUNT)?></td> -->
		</tr>
		<tr>
			<td>

				<table align="center" cellspacing="2" cellpadding="2" border="0" class="standardChooseLevel">
					<? if (LISTINGTEMPLATE_FEATURE == "on") { ?>
						<!-- <tr>
							  <th><?=system_showText(LANG_LISTING_LABELTEMPLATE)?>:</th>
							<td colspan="2">
								<select name="listingtemplate_id" onchange="templateSwitch(this.value);">
									<option value="">Default</option>
									<?
									$dbObjLT = db_getDBObJect();
									$sqlLT = "SELECT id FROM ListingTemplate WHERE status = 'enabled' ORDER BY title";
									$resultLT = $dbObjLT->query($sqlLT);
									while ($rowLT = mysql_fetch_assoc($resultLT)) {
										$listingtemplate = new ListingTemplate($rowLT["id"]);
										echo "<option value=\"".$listingtemplate->getNumber("id")."\"";
										if ($listingtemplate_id == $listingtemplate->getNumber("id")) {
											echo " selected";
										}
										echo ">".$listingtemplate->getString("title");
										if ($listingtemplate->getString("price") > 0) echo " (+".CURRENCY_SYMBOL.$listingtemplate->getString("price").")";
										else echo " (".system_showText(LANG_FREE).")";
										echo "</option>";
									}
									?>
								</select>
								<?
								if ($listingtemplate_id) {
									$templateObj = new ListingTemplate($listingtemplate_id);
									if ($templateObj && $templateObj->getString("status")=="enabled") {
										$template_title_field = $templateObj->getListingTemplateFields("title");
									}
								} else {
									$template_title_field = false;
								}
								?>
							</td>
						</tr> -->
					<? } ?>
				<!--	<? foreach ($levelValue as $value) { ?>
						<tr>
							<th><?=$listingLevelObj->showLevel($value)?></th>
							<td>
								<?
								if ($listingLevelObj->getPrice($value) > 0) {
									echo CURRENCY_SYMBOL.$listingLevelObj->getPrice($value)." ".system_showText(LANG_PER)." ";
									if (payment_getRenewalCycle("listing") > 1) {
										echo payment_getRenewalCycle("listing")." ";
										echo payment_getRenewalUnitName("listing")."s";
									}else {
										echo payment_getRenewalUnitName("listing");
									}
								} else {
									echo CURRENCY_SYMBOL.system_showText(LANG_FREE);
								}
								?>
							</td>
							<th class="radioChooseLevel">
								<input type="radio" name="level" value="<?=$value?>" <? if ($value == $level) { echo "checked=\"checked\""; } ?> onclick="levelSwitch('<?=$value?>');" />
							</th>
						</tr>
					<? } ?> -->
				</table>

			</td>
		<!-- 	<td class="orderUserTable">

				<table align="center" border="0" cellpadding="0" cellspacing="0">

					<tr>
						<th class="radioChooseLevel"><input type="radio" name="usertype" value="newuser" checked="checked" onclick="javascript:switchFormUserDisplay('newuser');" /></th>
						<td class="warning"><?=system_showText(LANG_ACCOUNTNEWUSER)?></td>
					</tr>

					<tr>
						<th class="radioChooseLevel"><input type="radio" name="usertype" value="directoryuser" <? if ($usertype == "directoryuser") echo "checked=\"checked\""; ?> onclick="javascript:switchFormUserDisplay('directoryuser');" /></th>
						<td><?=system_showText(LANG_ACCOUNTDIRECTORYUSER)?></td>
					</tr>

					<?
					setting_get("foreignaccount_openid", $foreignaccount_openid);
					if ($foreignaccount_openid == "on") {
						?>
						<tr>
							<th class="radioChooseLevel"><input type="radio" name="usertype" value="openiduser" <? if ($usertype == "openiduser") echo "checked=\"checked\""; ?> onclick="javascript:switchFormUserDisplay('openiduser');" /></th>
							<td><?=system_showText(LANG_ACCOUNTOPENIDUSER)?></td>
						</tr>
						<?
					}
					?>

					<?
					setting_get("foreignaccount_facebook", $foreignaccount_facebook);
					setting_get("foreignaccount_facebook_apikey", $foreignaccount_facebook_apikey);
					//if (($foreignaccount_facebook == "on") && ($foreignaccount_facebook_apikey)) {
					if ($foreignaccount_facebook == "on") {	
					
					?>
						<tr>
							<th class="radioChooseLevel"><input type="radio" name="usertype" value="facebookuser" <? if ($usertype == "facebookuser") echo "checked=\"checked\""; ?> onclick="javascript:switchFormUserDisplay('facebookuser');" /></th>
							<td><?=system_showText(LANG_ACCOUNTFACEBOOKUSER)?></td>
						</tr>
						<?
					}
					?>

					<tr>
						<td colspan="2">

							<div id="formDirectoryUser" class="<? if ($usertype == "directoryuser") echo "isVisible"; else echo "isHidden"; ?>">

								<form name="formDirectory" method="post" action="<?=$formloginaction;?>&query=level=<?=($_POST["level"]?$_POST["level"]:$_GET["level"])?>&listingtemplate_id=<?=($_POST["listingtemplate_id"]?$_POST["listingtemplate_id"]:$_GET["listingtemplate_id"])?>">

									<input type="hidden" name="userform" value="directory" />

									<?
									$membros_section = true;
									$automatically = false;
									include(INCLUDES_DIR."/forms/form_login.php");
									?>

								</form>

							</div>

						</td>
					</tr>

					<tr>
						<td colspan="2">

							<div id="formOpenIDUser" class="<? if ($usertype == "openiduser") echo "isVisible"; else echo "isHidden"; ?>">

								<form name="formOpenID" method="post" action="<?=$formloginaction;?>&query=level=<?=($_POST["level"]?$_POST["level"]:$_GET["level"])?>&listingtemplate_id=<?=($_POST["listingtemplate_id"]?$_POST["listingtemplate_id"]:$_GET["listingtemplate_id"])?>">

									<input type="hidden" name="userform" value="openid" />

									<? include(INCLUDES_DIR."/forms/form_openidlogin.php"); ?>

								</form>

							</div>

						</td>
					</tr>

					<tr>
						<td colspan="2">

							<div id="formFacebookUser" class="<? if ($usertype == "facebookuser") echo "isVisible"; else echo "isHidden"; ?>">

								<? include(INCLUDES_DIR."/forms/form_facebooklogin.php"); ?>

							</div>

						</td>
					</tr>

				</table>

			</td>-->
		</tr>
	</table>  

	<div id="formNewUser" class="<? if ((!$usertype) || ($usertype == "newuser")) echo "isVisible"; else echo "isHidden"; ?>">

		<? if ($message_account || $message_listing || $message_discount || $message_contact) { ?>
			<table align="center" border="0" cellpadding="2" cellspacing="2" class="standardMessage">
				<? if ($message_account) { ?>
					<tr>
						<th colspan="2" class="SIGNUPTable-title errorTitle"><?=system_showText(LANG_ACCOUNTINFO_ERROR)?></th>
					</tr>
					<tr>
						<td colspan="2" class="errorMessage"><?=$message_account?></td>
					</tr>
				<? } ?>
				<? if ($message_listing || $message_discount) { ?>
					<tr>
						<th colspan="2" class="SIGNUPTable-title errorTitle"><?=system_showText(LANG_LISTINGINFO_ERROR)?></th>
					</tr>
					<? if ($message_listing) { ?>
						<tr>
							<td colspan="2" class="errorMessage"><?=$message_listing?></td>
						</tr>
					<? } ?>
					<? if ($message_discount) { ?>
						<tr>
							<td colspan="2" class="errorMessage"><?=$message_discount?></td>
						</tr>
					<? } ?>
				<? } ?>
				<? if ($message_contact) { ?>
					<tr>
						<th colspan="2" class="SIGNUPTable-title errorTitle"><?=system_showText(LANG_BILLINGINFO_ERROR)?></th>
					</tr>
					<tr>
						<td colspan="2" class="errorMessage"><?=$message_contact?></td>
					</tr>
				<? } ?>
			</table>
		<? } ?>

		<form name="order_listing" action="<?=$_SERVER["PHP_SELF"]?>" method="post" class="standardForm" onSubmit="JS_submit();">

			<input type="hidden" name="ieBugFix" value="1" />
			<input type="hidden" name="signup" value="true" />
			<input type="hidden" name="listingtemplate_id" id="listingtemplate_id" value="<?=$listingtemplate_id?>" />
			<input type="hidden" name="level" id="level" value="<?=$level?>" />

			<script language="javascript" type="text/javascript" src="<?=DEFAULT_URL?>/scripts/checkpasswordstrength.js"></script>

			<table align="center" border="0" cellpadding="2" cellspacing="2" class="standardSIGNUPTable">
				<tr>
					<th colspan="2" class="SIGNUPTable-title"><h2><?=system_showText(LANG_ACCOUNTINFO)?> </h2></th>
				</tr>
				<tr>
					<th><?=system_showText(LANG_LABEL_USERNAME)?>:</th>
					<td>
						<input type="text" name="username" value="<?=$username?>" maxlength="<?=USERNAME_MAX_LEN?>" />
						<span><?=system_showText(LANG_USERNAME_MSG1)." ".USERNAME_MIN_LEN." ".system_showText(LANG_USERNAME_MSG2)." ".USERNAME_MAX_LEN." ".system_showText(LANG_USERNAME_MSG3)?></span>
					</td>
				</tr>
				<tr>
					<th><?=system_showText(LANG_LABEL_FIRSTNAME)?>:</th>
					<td><input type="text" name="first_name" value="<?=$first_name?>" /></td>
				</tr>
				<tr>
					<th><?=system_showText(LANG_LABEL_LASTNAME)?>:</th>
					<td><input type="text" name="last_name" value="<?=$last_name?>" /></td>
				</tr>
				<tr>
					<th><?=system_showText(LANG_LABEL_EMAIL)?>:</th>
					<td><input type="text" name="email" value="<?=$email?>" /></td>
				</tr>
				<tr>
					<th><?=system_showText(LANG_LABEL_PASSWORD)?>:</th>
					<td>
						<input type="password" autocomplete="off" name="password" maxlength="<?=PASSWORD_MAX_LEN?>" class="input-form-account" onkeyup="checkPasswordStrength(this.value, '<?=EDIRECTORY_FOLDER;?>')" />
						<div class="checkPasswordStrength">
							<span><?=system_showText(LANG_LABEL_PASSWORDSTRENGTH);?>:</span>
							<div id="checkPasswordStrength" class="strengthNoPassword">&nbsp;</div>
						</div>
						<span><?=system_showText(LANG_PASSWORD_MSG1)." ".PASSWORD_MIN_LEN." ".system_showText(LANG_PASSWORD_MSG2)." ".PASSWORD_MAX_LEN." ".system_showText(LANG_PASSWORD_MSG3)?></span>
					</td>
				</tr>
				<tr>
					<th><?=system_showText(LANG_LABEL_RETYPEPASSWORD)?>:</th>
					<td><input type="password" autocomplete="off" name="retype_password"  class="input-form-account" class="password"></td>
				</tr>
				<tr>
					<th><input type="checkbox" name="agree_tou" value="1" <?=($agree_tou) ? "checked=\"checked\"" : ""?> class="inputRadio" /></th>
					<td><a id="" class="thickbox" href="<?=DEFAULT_URL?>/terms.php?height=440&width=500"><?=system_showText(LANG_IGREETERMS)?></a></td>
				</tr>
				<tr>
					<th colspan="2" class="SIGNUPTable-title"><h2><?=system_showText(LANG_LISTINGINFO)?></h2></th>
				</tr>
				<tr>
					<th id="title_label"><?=($template_title_field!==false) ? $template_title_field[0]["label"] : system_showText(LANG_LABEL_TITLE)?>:</th>
					<td>
						<input type="text" name="title" value="<?=$title?>" class="input-form-listing" maxlength="100" onblur="easyFriendlyUrl(this.value, 'friendly_url', '<?=FRIENDLYURL_VALIDCHARS?>', '<?=FRIENDLYURL_SEPARATOR?>');" />
						<input type="hidden" name="friendly_url" id="friendly_url" value="<?=$friendly_url?>" maxlength="150" />
					</td>
					
				</tr>
				<tr>
				<th id="title_label">CNPJ ou CPF:</th>
					<td>
						<input type="text" name="cnpj" value="<?=$title?>" class="input-form-listing" maxlength="100" onblur="easyFriendlyUrl(this.value, 'friendly_url', '<?=FRIENDLYURL_VALIDCHARS?>', '<?=FRIENDLYURL_SEPARATOR?>');" />
						<input type="hidden" name="friendly_url" id="friendly_url" value="<?=$friendly_url?>" maxlength="80" />
					</td>
				</tr>
				<!--   <? if (PAYMENT_FEATURE == "on") { ?>
					<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
						<tr>
							<th><?=ucwords(system_showText(LANG_LABEL_DISCOUNTCODE))?>:</th>
							<td><input type="text" name="discount_id" value="<?=$discount_id?>" class="input-form-listing" maxlength="10" onblur="orderCalculate();" /></td>
						</tr>
					<? } ?>
				<? } ?> -->
				<tr>
					<th colspan="2" class="SIGNUPTable-title">
						<h2>
							<?=system_showText(LANG_CATEGORIES_TITLE)?>
							</h2>
					</th>
				</tr>
				<tr>
					<td colspan="2" class="autoWidth">
						<p class="warningBOXtext"><?=system_showText(LANG_CATEGORIES_MSG1)?><br /><?=system_showText(LANG_CATEGORIES_MSG2)?></p>
					</td>
				</tr>
				<tr>
					<td colspan="2" class="treeView">

						<input type="hidden" name="return_categories" value="" />

						<ul id="listing_categorytree_id_0" class="categoryTreeview">&nbsp;</ul>
	
						<table width="100%" border="0" cellpadding="2" class="tableCategoriesADDED" cellspacing="0">
							<tr>
								<th colspan="2" class="tableCategoriesTITLE alignLeft"><strong><?=system_showText(LANG_LISTING_CATEGORIES)?>:</strong></th>
							</tr>
							<tr>
								<td colspan="2" class="tableCategoriesCONTENT"><?=$feedDropDown?></td>
							</tr>
							<tr>
								<td class="tableCategoriesBUTTONS" colspan="2">
									<!-- <button type="button" onclick="JS_displayCategoryPath();"><?=system_showText(LANG_CATEGORY_VIEWPATH)?></button>&nbsp; -->
									<button type="button" onclick="JS_removeCategory();"><?=system_showText(LANG_CATEGORY_REMOVESELECTED)?></button>
								</td>
							</tr>
						</table>

					</td>
				</tr>
			</table>

			<table align="center" border="0" cellpadding="2" cellspacing="2" class="standardSIGNUPTable">
			<!--	<tr>
					<th class="SIGNUPTable-title" colspan="2">
						<h2><?=system_showText(LANG_BILLINGINFO)?></h2>
					</th>
				</tr>
				<tr style="display:none">
					<th class="textTop">* <?=system_showText(LANG_LABEL_LANGUAGE);?>:</th>
					<td>
						<?=language_langOptions($lang);?>
						<span><?=system_showText(LANG_LABEL_LANGUAGETIP)?></span>
					</td>
				</tr>
			 	<tr>
					<th>* <?=system_showText(LANG_LABEL_FIRSTNAME)?>:</th>
					<td><input type="text" name="first_name" value="<?=$first_name?>" /></td>
				</tr>
				<tr>
					<th>* <?=system_showText(LANG_LABEL_LASTNAME)?>:</th>
					<td><input type="text" name="last_name" value="<?=$last_name?>" /></td>
				</tr>
				 <tr>
					<th><?=system_showText(LANG_LABEL_COMPANY)?>:</th>
					<td><input type="text" name="company" value="<?=$company?>" /></td>
				</tr>
				<tr>
					<th valign="top"><?=system_showText(LANG_LABEL_ADDRESS)?>:</th>
					<td><input type="text" name="address" value="<?=$address?>" maxlength="50" /></td>
				</tr>
				<tr>
					<th><?=system_showText(LANG_LABEL_ADDRESSOPTIONAL)?>:</th>
					<td><input type="text" name="address2" value="<?=$address2?>" maxlength="50" /></td>
				</tr>
				<tr>
					<th><?=system_showText(LANG_LABEL_CITY)?>:</th>
					<td><input type="text" name="city" value="<?=$city?>" /></td>
				</tr>
				<tr>
					<th><?=system_showText(LANG_LABEL_STATE)?>:</th>
					<td><input type="text" name="state" value="<?=$state?>" /></td>
				</tr>
				<tr>
					<th><?=ucwords(ZIPCODE_LABEL)?>:</th>
					<td><input type="text" name="zip" value="<?=$zip?>" /></td>
				</tr>
				<tr>
					<th><?=system_showText(LANG_LABEL_COUNTRY)?>:</th>
					<td><input type="text" name="country" value="<?=$country?>" /></td>
				</tr>
				<tr>
					<th><?=system_showText(LANG_LABEL_PHONE)?>:</th>
					<td><input type="text" name="phone" value="<?=$phone?>" /></td>
				</tr> 
				<tr>
					<th>* <?=system_showText(LANG_LABEL_EMAIL)?>:</th>
					<td><input type="text" name="email" value="<?=$email?>" /></td>
				</tr>-->
			</table>

			<? include(EDIRECTORY_ROOT."/includes/code/seckey.php"); ?>

			<input type="hidden" name="ieBugFix" value="1" />

			<div id="loadingOrderCalculate" class="loadingOrderCalculate"><?=system_showText(LANG_WAITLOADING)?></div>

			<? if (PAYMENT_FEATURE == "on") { ?>
				<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
					<div id="check_out_payment" class="<?=$checkoutpayment_class?>">
					<!--  	<div id="checkoutpayment_total" class="orderTotalAmount"></div>
						<? include(INCLUDES_DIR."/forms/form_paymentmethod.php"); ?>-->
						<p class="standardButton">
							<button type="submit" name="continue" value=""><?=system_showText(LANG_BUTTON_CONTINUE)?></button>
						</p>
					</div>
				<? } ?>
			<? } ?>

			<div id="check_out_free" class="<?=$checkoutfree_class?>">
				<div id="checkoutfree_total" class="orderTotalAmount"></div>
					<p class="standardButton">
						<button type="submit" name="checkout" value="<?=system_showText(LANG_BUTTON_CONTINUE)?>"><?=system_showText(LANG_BUTTON_CONTINUE)?></button>
					</p>
			</div>

		</form>

	</div>

	<script language="javascript" type="text/javascript" src="<?=DEFAULT_URL?>/scripts/categorytree.js"></script>
	<script language="javascript" type="text/javascript">
		<? if ($listingtemplate_id) { ?>
			loadCategoryTree('template', 'listing_', 'ListingCategory', 0, <?=$listingtemplate_id?>, '<?=EDIRECTORY_FOLDER?>');
		<? } else { ?>
			loadCategoryTree('all', 'listing_', 'ListingCategory', 0, 0, '<?=EDIRECTORY_FOLDER?>');
		<? } ?>
	</script>

	<script language="javascript" type="text/javascript">
		orderCalculate();
	</script>
</div>
<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/layout/footer.php");
?>
