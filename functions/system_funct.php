<?php
function system_showPre($array, $label="") {
		echo "<pre>$label: ";
		var_dump($array);
		echo "</pre>";
	}

	function system_mail($to, $subject, $message, $from, $content_type="text/plain", $cc="", $bcc="", &$error) {
		$eDirMailerObj = new EDirMailer($to, $subject, $message, $from);
		$eDirMailerObj->SMTPKeepAlive = true;
		if ($content_type) $eDirMailerObj->setContentType($content_type);
		if ($cc) $eDirMailerObj->setCC($cc);
		if ($bcc) $eDirMailerObj->setBCC($bcc);
		if (!$eDirMailerObj->send()) {
			$error = $eDirMailerObj->msgerror;
			return false;
		}
		return true;
	}

	function system_generatePassword() {
		$string = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
		srand((double)microtime()*1000000);
		for ($i=0; $i < 8; $i++) {
			$num   = rand() % strlen($string);
			$tmp   = substr($string, $num, 1);
			$pass .= $tmp;
		}
		return $pass;
	}

	function system_generateFileName() {
		$string = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
		srand((double)microtime()*1000000);
		for ($i=0; $i < 20; $i++) {
			$num = rand() % strlen($string);
			$tmp = substr($string, $num, 1);
			$name .= $tmp;
		}
		return $name;
	}

	function system_sendPassword($id, $emailTO, $username, $password, $name, $lang) {

		if ($emailNotificationObj = system_checkEmail($id, $lang)) {

			setting_get("sitemgr_email", $sitemgr_email);
			$sitemgr_emails = split(",", $sitemgr_email);

			if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];

			$subject = $emailNotificationObj->getString("subject");
			$body    = $emailNotificationObj->getString("body");

			$subject = str_replace("ACCOUNT_NAME",     $name,            $subject);
			$subject = str_replace("ACCOUNT_USERNAME", $username,        $subject);
			$subject = str_replace("ACCOUNT_PASSWORD", $password,        $subject);
			$subject = str_replace("DEFAULT_URL",      DEFAULT_URL,      $subject);
			$subject = str_replace("SITEMGR_EMAIL",    $sitemgr_email,   $subject);
			$subject = str_replace("EDIRECTORY_TITLE", EDIRECTORY_TITLE, $subject);

			$body    = str_replace("ACCOUNT_NAME",     $name,            $body);
			$body    = str_replace("ACCOUNT_USERNAME", $username,        $body);
			$body    = str_replace("ACCOUNT_PASSWORD", $password,        $body);
			$body    = str_replace("DEFAULT_URL",      DEFAULT_URL,      $body);
			$body    = str_replace("SITEMGR_EMAIL",    $sitemgr_email,   $body);
			$body    = str_replace("EDIRECTORY_TITLE", EDIRECTORY_TITLE, $body);

			$body = html_entity_decode($body);
			$subject = html_entity_decode($subject);

			$error = false;
			//system_mail($emailTO, $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error);

		}

	}

	/**
	* Verify if email is Enabled or Disabled
	********************************************************************/
	function system_checkEmail($id, $lang) {
		if ($lang) $email = new EmailNotification($id, $lang);
		else $email = new EmailNotification($id);
		if ($email->getString("deactivate")) {
			return false;
		} else {
			return $email;
		}
	}

	/**
	* Replace the variables in the email body
	********************************************************************/
	function system_replaceEmailVariables($body,$id,$item="listing") {

		switch ($item) {
			case 'banner': $obj = new Banner($id); break;
			case 'classified': $obj = new Classified($id); break;
			case 'article': $obj = new Article($id); break;
			case 'event': $obj = new Event($id); break;
			case 'listing': $obj = new Listing($id); break;
			case 'promotion': $obj = new Promotion($id); break;
			case 'account': $acc = new Account($id);
		}

		if (!isset($acc)) $acc = new Account($obj->getNumber('account_id'));
		$acc_cont = new Contact($acc->getNumber('id'));

		setting_get("sitemgr_email", $sitemgr_email);
		$sitemgr_emails = split(",", $sitemgr_email);

		if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];

		$body = str_replace("ACCOUNT_NAME",$acc_cont->getString('first_name').' '.$acc_cont->getString('last_name'),$body);
		$body = str_replace("ACCOUNT_USERNAME",$acc->getString('username'),$body);
		$body = str_replace("ACCOUNT_PASSWORD",$acc->getString('username'),$body);

		switch ($item) {
			case 'banner':
				$body = str_replace(array("ITEM_TITLE", "BANNER_TITLE"), $obj->getString('caption'), $body);
			break;
			case 'classified':
				if (MODREWRITE_FEATURE == "on") { $detailLink = "".CLASSIFIED_DEFAULT_URL."/".$obj->getString("friendly_url").".html"; } else { $detailLink = "".CLASSIFIED_DEFAULT_URL."/detail.php?id=".$obj->getNumber("id"); }
				$body = str_replace(array("ITEM_TITLE", "CLASSIFIED_TITLE"), $obj->getString('title'), $body);
			break;
			case 'article':
				if (MODREWRITE_FEATURE == "on") { $detailLink = "".ARTICLE_DEFAULT_URL."/".$obj->getString("friendly_url").".html"; } else { $detailLink = "".ARTICLE_DEFAULT_URL."/detail.php?id=".$obj->getNumber("id"); }
				$body = str_replace(array("ITEM_TITLE", "ARTICLE_TITLE"), $obj->getString('title'), $body);
			break;
			case 'event':
				if (MODREWRITE_FEATURE == "on") { $detailLink = "".EVENT_DEFAULT_URL."/".$obj->getString("friendly_url").".html"; } else { $detailLink = "".EVENT_DEFAULT_URL."/detail.php?id=".$obj->getNumber("id"); }
				$body = str_replace(array("ITEM_TITLE", "EVENT_TITLE"), $obj->getString('title'), $body);
			break;
			case 'listing':
				if (MODREWRITE_FEATURE == "on") { $detailLink = "".LISTING_DEFAULT_URL."/".$obj->getString("friendly_url").".html"; } else { $detailLink = "".LISTING_DEFAULT_URL."/detail.php?id=".$obj->getNumber("id"); }
				$body = str_replace(array("ITEM_TITLE", "LISTING_TITLE"), $obj->getString('title'), $body);
			break;
			case 'promotion':
				$detailLink = "".PROMOTION_DEFAULT_URL."/results.php?id=".$obj->getNumber("id");
				$body = str_replace(array("ITEM_TITLE"), $obj->getString('name'), $body);
			break;
		}

		if (isset($detailLink)) $body = str_replace("ITEM_URL", $detailLink, $body);

		$body = str_replace("ITEM_TYPE", $item, $body);

		$body = str_replace("EDIRECTORY_TITLE",EDIRECTORY_TITLE,$body);
		$body = str_replace("SITEMGR_EMAIL",$sitemgr_email,$body);
		$body = str_replace("DEFAULT_URL",DEFAULT_URL,$body);

		return $body;

	}

	function endKey($array){
		end($array);
		return key($array);
	}

	/**
	* This function is used by system_generateCategoryTreeRecursiveSort to help on the category ordering.
	********************************************************************/
	function system_generateCategoryTreeRecursiveSort($dad_id, $item, &$new_arr, &$ordered){
		for($j=0; $j < count($new_arr); $j++){
			if($new_arr[$j]["dad"] == $dad_id){
				$x = count($ordered);
				$ordered[$x]["id"] = $new_arr[$j]["id"];
				$ordered[$x]["dad"] = $new_arr[$j]["dad"];
				$ordered[$x]["title"] = $new_arr[$j]["title"];
				$ordered[$x]["title1"] = $new_arr[$j]["title1"];
				$ordered[$x]["title2"] = $new_arr[$j]["title2"];
				$ordered[$x]["title3"] = $new_arr[$j]["title3"];
				$ordered[$x]["title4"] = $new_arr[$j]["title4"];
				$ordered[$x]["active_".$item] = $new_arr[$j]["active_".$item];
				$ordered[$x++]["level"] = $new_arr[$j]["level"];
				system_generateCategoryTreeRecursiveSort($new_arr[$j]["id"], $item, $new_arr, $ordered);
			}
		}
	}

	/**
	* This function is used to generate a category tree based on 2 terms which are arrays.
	* It is also using styles from this project.
	* The first array contains the selected categories
	* The second array is generated by method getFullPath in Category class
	********************************************************************/
	function system_generateCategoryTree($categories_obj_arr, $arr_full_path, $item, $user=false, $lang=EDIR_LANGUAGE) {

		$item_aux = "";
		if ($item == "promotion") {
			$item_aux = $item;
			$item = "listing";
		}

		$x=0; $y=0;

		for ($i=0; $i < count($arr_full_path); $i++) {

			for ($j=0; $j < count($arr_full_path[$i]); $j++) {

				if ($arr_full_path[$i][$j]["dad"] == 0) {

					$repeated = false;

					if ($dad_arr) {
						foreach ($dad_arr as $each_dad) {
							if ($each_dad["id"] == $arr_full_path[$i][$j]["id"]) {
								$repeated = true;
							}
						}
					}

					if (!$repeated) {
						$dad_arr[$y]["id"] = $arr_full_path[$i][$j]["id"];
						$dad_arr[$y]["dad"] = $arr_full_path[$i][$j]["dad"];
						$dad_arr[$y]["title"] = $arr_full_path[$i][$j]["title"];
						$dad_arr[$y]["title1"] = $arr_full_path[$i][$j]["title1"];
						$dad_arr[$y]["title2"] = $arr_full_path[$i][$j]["title2"];
						$dad_arr[$y]["title3"] = $arr_full_path[$i][$j]["title3"];
						$dad_arr[$y]["title4"] = $arr_full_path[$i][$j]["title4"];
						$dad_arr[$y]["active_".$item] = $arr_full_path[$i][$j]["active_".$item];
						$dad_arr[$y++]["level"] = $arr_full_path[$i][$j]["level"];
					}

				} else {

					$repeated = false;

					if ($new_arr) {
						foreach ($new_arr as $each_cat) {
							if ($each_cat["id"] == $arr_full_path[$i][$j]["id"]) {
								$repeated = true;
							}
						}
					}

					if (!$repeated) {
						$new_arr[$x]["id"] = $arr_full_path[$i][$j]["id"];
						$new_arr[$x]["dad"] = $arr_full_path[$i][$j]["dad"];
						$new_arr[$x]["title"] = $arr_full_path[$i][$j]["title"];
						$new_arr[$x]["title1"] = $arr_full_path[$i][$j]["title1"];
						$new_arr[$x]["title2"] = $arr_full_path[$i][$j]["title2"];
						$new_arr[$x]["title3"] = $arr_full_path[$i][$j]["title3"];
						$new_arr[$x]["title4"] = $arr_full_path[$i][$j]["title4"];
						$new_arr[$x]["active_".$item] = $arr_full_path[$i][$j]["active_".$item];
						$new_arr[$x++]["level"] = $arr_full_path[$i][$j]["level"];
					}

				}

			}

		}

		for ($i=0; $i < count($dad_arr); $i++) {

			$x = count($ordered);

			$ordered[$x]["id"] = $dad_arr[$i]["id"];
			$ordered[$x]["dad"] = $dad_arr[$i]["dad"];
			$ordered[$x]["title"] = $dad_arr[$i]["title"];
			$ordered[$x]["title1"] = $dad_arr[$i]["title1"];
			$ordered[$x]["title2"] = $dad_arr[$i]["title2"];
			$ordered[$x]["title3"] = $dad_arr[$i]["title3"];
			$ordered[$x]["title4"] = $dad_arr[$i]["title4"];
			$ordered[$x]["active_".$item] = $dad_arr[$i]["active_".$item];
			$ordered[$x++]["level"] = $dad_arr[$i]["level"];

			$dad_id = $dad_arr[$i]["id"];

			system_generateCategoryTreeRecursiveSort($dad_id, $item, $new_arr, $ordered);

		}

		$langIndex = language_getIndex(EDIR_LANGUAGE);

		for ($i=0; $i < count($ordered); $i++) {

			if ($item == "listing") $catObj = new ListingCategory($ordered[$i]["id"]);
			elseif ($item == "event") $catObj = new EventCategory($ordered[$i]["id"]);
			elseif ($item == "classified") $catObj = new ClassifiedCategory($ordered[$i]["id"]);
			elseif ($item == "article") $catObj = new ArticleCategory($ordered[$i]["id"]);
			$path_elem_arr = $catObj->getFullPath();

			if (MODREWRITE_FEATURE == "on") {
				if ($item_aux) $href = "".constant(strtoupper($item_aux)."_DEFAULT_URL")."/guide";
				else $href = "".constant(strtoupper($item)."_DEFAULT_URL")."/guide";
			} else {
				if ($item_aux) $href = "".constant(strtoupper($item_aux)."_DEFAULT_URL")."/results.php?category_id=";
				else $href = "".constant(strtoupper($item)."_DEFAULT_URL")."/results.php?category_id=";
			}

			if (MODREWRITE_FEATURE == "on") {
				if ($path_elem_arr) {
					foreach ($path_elem_arr as $each_category_node) {
						$href .= "/".$each_category_node["friendly_url".$langIndex];
					}
				}
			} else {
				if ($path_elem_arr) {
					foreach ($path_elem_arr as $each_category_node) {
						$thiscategoryid = $each_category_node["id"];
					}
					$href .= $thiscategoryid;
				}
			}

			if ($user) {
				$linked_titles[] = str_repeat("<strong class=\"base-categoriesRESULTSdetail\">&raquo;</strong>", $ordered[$i]["level"])."&nbsp;<a href=\"".$href."\">".$ordered[$i]["title".$langIndex].((($item == "listing") && (!$item_aux) && (SHOW_CATEGORY_COUNT=="on"))?(" (".$ordered[$i]["active_".$item].")"):(""))."</a>";
			} else {
				$linked_titles[] = str_repeat("<strong class=\"base-categoriesRESULTSdetail\">&raquo;</strong>", $ordered[$i]["level"])."&nbsp;<a href=\"javascript: void(0);\">".$ordered[$i]["title".$langIndex].((($item == "listing") && (!$item_aux) && (SHOW_CATEGORY_COUNT=="on"))?(" (".$ordered[$i]["active_".$item].")"):(""))."</a>";
			}

		}

		$category_tree = implode("<br />", $linked_titles);

		return($category_tree);

	}

	function system_generateAjaxAccountSearch($acct_search_table_title = LANG_SITEMGR_ACCOUNTSEARCH_SELECT_DEFAULT, $acct_search_field_name = "account_id", $acct_search_field_value = false, $acct_search_required_mark = false, $acct_search_form_width = "100%", $acct_search_cell_width = "105px"){

		$form_html = "
				<div id=\"table_accounts_search\" style=\"display: none; width: ".$acct_search_form_width."\">

					<input type=\"hidden\" name=\"acct_search_field_name\" id=\"acct_search_field_name\" value=\"".$acct_search_field_name."\" />

					<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"searchAccount\">
						<tr>
							<th colspan=\"2\" class=\"searchAccountTitleAccount\">".$acct_search_table_title."</span></th>
						</tr>
						<tr>
							<th>".system_showText(LANG_SITEMGR_LABEL_COMPANY).": </th>
							<td>
								<input type=\"text\" id=\"acct_search_company\" style=\"width:250px\" name=\"acct_search_company\" value=\"\" OnKeyPress=\"if(event.keyCode == 13) { searchAccount(this.form, '".DEFAULT_URL."'); }\" />
							</td>
						</tr>
						<tr>
							<th class=\"first_line\" style=\"padding-top: 10px\">".system_showText(LANG_SITEMGR_LABEL_USERNAME).": </th>
							<td style=\"padding-top: 10px\">
								<input type=\"text\" id=\"acct_search_username\" style=\"width:250px\" name=\"acct_search_username\" value=\"\" OnKeyPress=\"if(event.keyCode == 13) { searchAccount(this.form, '".DEFAULT_URL."'); }\" />
							</td>
						</tr>
						<tr>
							<td colspan=\"2\" style=\"text-align: center; padding-bottom: 5px;\">
								<input style=\"width:80px\" class=\"ui-state-default ui-corner-all\" type=\"button\" name=\"acct_search_btn\" id=\"acct_search_btn\" value=\"".system_showText(LANG_SITEMGR_SEARCH)."\" onclick=\"searchAccount(this.form, '".DEFAULT_URL."');\" />
								<input style=\"width:80px\" class=\"ui-state-default ui-corner-all\" type=\"button\" name=\"acct_reset_btn\" id=\"acct_reset_btn\" value=\"".system_showText(LANG_SITEMGR_RESET)."\" onclick=\"resetSearchAccount();\" />
								<input style=\"width:80px\" class=\"ui-state-default ui-corner-all\" type=\"button\" name=\"acct_cancel_btn\" id=\"acct_reset_btn\" value=\"".system_showText(LANG_SITEMGR_CANCEL)."\" onclick=\"cancelSearchAccount();\" />
								<input style=\"width:80px\" class=\"ui-state-default ui-corner-all\" type=\"button\" name=\"acct_empty_btn\" id=\"acct_empty_btn\" value=\"".system_showText(LANG_SITEMGR_ACCOUNTSEARCH_EMPTY)."\" onclick=\"emptySearchAccount();\" />
							</td>
						</tr>
						<tr>
							<td colspan=\"2\" style=\"padding: 0 10px 10px 10px;\">
								<div id=\"accounts_search\" class=\"div-accounts_search-form-listing\"></div>
								<div id=\"accounts_search_loading\" class=\"div-accounts_search_loading-form-listing\">".system_showText(LANG_SITEMGR_WAITLOADING)."</div>
							</td>
						</tr>
					</table>

				</div>

				<div id=\"table_accounts\">
							<table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"standard-table\">
							<tr>
									<td id=\"selected_account\"></td></tr></table>";
		if($acct_search_field_value) {
			$accountObj = new Account($acct_search_field_value);
			$contactObj = new Contact($acct_search_field_value);
			$form_html .= "			<a class=\"btn ui-state-default ui-corner-all\" href='javascript:changeAccount()'><span class=\"ui-icon ui-icon-circle-plus\"></span>".system_showAccountUserName($accountObj->getString("username"))."</a>";
			$form_html .= "			<input type=\"hidden\" id=\"".$acct_search_field_name."\" name=\"".$acct_search_field_name."\" value=\"".$acct_search_field_value."\" />";
		} else {
			$form_html .= "			<a class=\"btn ui-state-default ui-corner-all\" href='javascript:changeAccount()'><span class=\"ui-icon ui-icon-circle-plus\"></span>".system_showText("Clique aqui para selecionar um Respons&#225;vel")."</a>";
		}
		$form_html .= "

				<div class=\"clearfix\"></div>
				</div>";

		return $form_html;
	}

	function getTreePath($catID, $section) {
		$strRet = "";
		$dbObj = db_getDBObject();
		if ($section == "listing") $sql = "SELECT category_id FROM ListingCategory WHERE id = ".$catID."";
		else $sql = "SELECT category_id FROM ".ucwords($section)."Category WHERE id = ".$catID."";
		$result = $dbObj->query($sql);
		if (mysql_num_rows($result) > 0) {
			while ($row = mysql_fetch_assoc($result)) {
				$strRet .= getTreePath($row["category_id"], $section);
			}
		}
		if ($catID) $strRet .= ",".$catID;
		return $strRet;
	}

	function getSubTree($catID, $section) {
		$strRet = "";
		$dbObj = db_getDBObject();
		if ($section == "listing") $sql = "SELECT id FROM ListingCategory WHERE category_id = ".db_formatNumber($catID)."";
		else $sql = "SELECT id FROM ".ucwords($section)."Category WHERE category_id = ".db_formatNumber($catID)."";
		$result = $dbObj->query($sql);
		if (mysql_num_rows($result) > 0) {
			while ($row = mysql_fetch_assoc($result)) {
				$strRet .= getSubTree($row["id"], $section);
			}
		}
		$strRet .= ",".$catID;
		return $strRet;
	}

	function system_getListingStatus() {

		$status = array();

		$dbObj = db_getDBObJect();

		if (LISTING_SCALABILITY_OPTIMIZATION == "on") {

			$sql = "SELECT * FROM ItemStatistic WHERE name LIKE 'l_%'";
			$r = $dbObj->query($sql);
			if ($r) {
				while ($row = mysql_fetch_assoc($r)) {
					$status[$row["name"]] = $row["value"];
				}
			}

		} else {

			$sql = "SELECT COUNT(*) AS total FROM Listing WHERE status = ".db_formatString("P")."";
			$r = $dbObj->query($sql); $row = mysql_fetch_assoc($r);
			$status["l_pending"] = (int)$row["total"];

			$sql = "SELECT COUNT(*) AS total FROM Listing WHERE renewal_date > NOW() AND renewal_date <= DATE_ADD(NOW(), INTERVAL ".DEFAULT_LISTING_DAYS_TO_EXPIRE." DAY)";
			$r = $dbObj->query($sql); $row = mysql_fetch_assoc($r);
			$status["l_expiring"] = (int)$row["total"];

			$sql = "SELECT COUNT(*) AS total FROM Listing WHERE status = ".db_formatString("E")."";
			$r = $dbObj->query($sql); $row = mysql_fetch_assoc($r);
			$status["l_expired"] = (int)$row["total"];

			$sql = "SELECT COUNT(*) AS total FROM Listing WHERE status = ".db_formatString("A")."";
			$r = $dbObj->query($sql); $row = mysql_fetch_assoc($r);
			$status["l_active"] = (int)$row["total"];

			$sql = "SELECT COUNT(*) AS total FROM Listing WHERE status = ".db_formatString("S")."";
			$r = $dbObj->query($sql); $row = mysql_fetch_assoc($r);
			$status["l_suspended"] = (int)$row["total"];

			$sql = "SELECT COUNT(*) AS total from Listing WHERE entered >= '".date("Y-m-d", mktime(0, 0, 0, date("m")-1 , date("d"), date("Y")))."'";
			$r = $dbObj->query($sql); $row = mysql_fetch_assoc($r);
			$status["l_added30"] = (int)$row["total"];

		}

		unset($dbObj);

		return $status;

	}

	function system_getEventStatus() {

		$status = array();

		$dbObj = db_getDBObJect();

		if (EVENT_SCALABILITY_OPTIMIZATION == "on") {

			$sql = "SELECT * FROM ItemStatistic WHERE name LIKE 'e_%'";
			$r = $dbObj->query($sql);
			if ($r) {
				while ($row = mysql_fetch_assoc($r)) {
					$status[$row["name"]] = $row["value"];
				}
			}

		} else {

			$sql = "SELECT COUNT(*) AS total FROM Event WHERE status = ".db_formatString("P")."";
			$r = $dbObj->query($sql); $row = mysql_fetch_assoc($r);
			$status["e_pending"] = (int)$row["total"];

			$sql = "SELECT COUNT(*) AS total FROM Event WHERE renewal_date > NOW() AND renewal_date <= DATE_ADD(NOW(), INTERVAL ".DEFAULT_EVENT_DAYS_TO_EXPIRE." DAY)";
			$r = $dbObj->query($sql); $row = mysql_fetch_assoc($r);
			$status["e_expiring"] = (int)$row["total"];

			$sql = "SELECT COUNT(*) AS total FROM Event WHERE status = ".db_formatString("E")."";
			$r = $dbObj->query($sql); $row = mysql_fetch_assoc($r);
			$status["e_expired"] = (int)$row["total"];

			$sql = "SELECT COUNT(*) AS total FROM Event WHERE status = ".db_formatString("A")."";
			$r = $dbObj->query($sql); $row = mysql_fetch_assoc($r);
			$status["e_active"] = (int)$row["total"];

			$sql = "SELECT COUNT(*) AS total FROM Event WHERE status = ".db_formatString("S")."";
			$r = $dbObj->query($sql); $row = mysql_fetch_assoc($r);
			$status["e_suspended"] = (int)$row["total"];

			$sql = "SELECT COUNT(*) AS total from Event WHERE entered >= '".date("Y-m-d", mktime(0, 0, 0, date("m")-1 , date("d"), date("Y")))."'";
			$r = $dbObj->query($sql); $row = mysql_fetch_assoc($r);
			$status["e_added30"] = (int)$row["total"];

		}

		unset($dbObj);

		return $status;

	}

	function system_getBannerStatus() {

		$status = array();

		$dbObj = db_getDBObJect();

		if (BANNER_SCALABILITY_OPTIMIZATION == "on") {

			$sql = "SELECT * FROM ItemStatistic WHERE name LIKE 'b_%'";
			$r = $dbObj->query($sql);
			if ($r) {
				while ($row = mysql_fetch_assoc($r)) {
					$status[$row["name"]] = $row["value"];
				}
			}

		} else {

			$sql = "SELECT COUNT(*) AS total FROM Banner WHERE status = ".db_formatString("P")."";
			$r = $dbObj->query($sql); $row = mysql_fetch_assoc($r);
			$status["b_pending"] = (int)$row["total"];

			$sql = "SELECT COUNT(*) AS total FROM Banner WHERE status = ".db_formatString("E")."";
			$r = $dbObj->query($sql); $row = mysql_fetch_assoc($r);
			$status["b_expired"] = (int)$row["total"];

			$sql = "SELECT COUNT(*) AS total FROM Banner WHERE status = ".db_formatString("A")."";
			$r = $dbObj->query($sql); $row = mysql_fetch_assoc($r);
			$status["b_active"] = (int)$row["total"];

			$sql = "SELECT COUNT(*) AS total FROM Banner WHERE status = ".db_formatString("S")."";
			$r = $dbObj->query($sql); $row = mysql_fetch_assoc($r);
			$status["b_suspended"] = (int)$row["total"];

			$sql = "SELECT COUNT(*) AS total from Banner WHERE entered >= '".date("Y-m-d", mktime(0, 0, 0, date("m")-1 , date("d"), date("Y")))."'";
			$r = $dbObj->query($sql); $row = mysql_fetch_assoc($r);
			$status["b_added30"] = (int)$row["total"];

		}

		unset($dbObj);

		return $status;

	}

	function system_getClassifiedStatus() {

		$status = array();

		$dbObj = db_getDBObJect();

		if (CLASSIFIED_SCALABILITY_OPTIMIZATION == "on") {

			$sql = "SELECT * FROM ItemStatistic WHERE name LIKE 'c_%'";
			$r = $dbObj->query($sql);
			if ($r) {
				while ($row = mysql_fetch_assoc($r)) {
					$status[$row["name"]] = $row["value"];
				}
			}

		} else {

			$sql = "SELECT COUNT(*) AS total FROM Classified WHERE status = ".db_formatString("P")."";
			$r = $dbObj->query($sql); $row = mysql_fetch_assoc($r);
			$status["c_pending"] = (int)$row["total"];

			$sql = "SELECT COUNT(*) AS total FROM Classified WHERE renewal_date > NOW() AND renewal_date <= DATE_ADD(NOW(), INTERVAL ".DEFAULT_CLASSIFIED_DAYS_TO_EXPIRE." DAY)";
			$r = $dbObj->query($sql); $row = mysql_fetch_assoc($r);
			$status["c_expiring"] = (int)$row["total"];

			$sql = "SELECT COUNT(*) AS total FROM Classified WHERE status = ".db_formatString("E")."";
			$r = $dbObj->query($sql); $row = mysql_fetch_assoc($r);
			$status["c_expired"] = (int)$row["total"];

			$sql = "SELECT COUNT(*) AS total FROM Classified WHERE status = ".db_formatString("A")."";
			$r = $dbObj->query($sql); $row = mysql_fetch_assoc($r);
			$status["c_active"] = (int)$row["total"];

			$sql = "SELECT COUNT(*) AS total FROM Classified WHERE status = ".db_formatString("S")."";
			$r = $dbObj->query($sql); $row = mysql_fetch_assoc($r);
			$status["c_suspended"] = (int)$row["total"];

			$sql = "SELECT COUNT(*) AS total from Classified WHERE entered >= '".date("Y-m-d", mktime(0, 0, 0, date("m")-1 , date("d"), date("Y")))."'";
			$r = $dbObj->query($sql); $row = mysql_fetch_assoc($r);
			$status["c_added30"] = (int)$row["total"];

		}

		unset($dbObj);

		return $status;

	}

	function system_getArticleStatus() {

		$status = array();

		$dbObj = db_getDBObJect();

		if (ARTICLE_SCALABILITY_OPTIMIZATION == "on") {

			$sql = "SELECT * FROM ItemStatistic WHERE name LIKE 'a_%'";
			$r = $dbObj->query($sql);
			if ($r) {
				while ($row = mysql_fetch_assoc($r)) {
					$status[$row["name"]] = $row["value"];
				}
			}

		} else {

			$sql = "SELECT COUNT(*) AS total FROM Article WHERE status = ".db_formatString("P")."";
			$r = $dbObj->query($sql); $row = mysql_fetch_assoc($r);
			$status["a_pending"] = (int)$row["total"];

			$sql = "SELECT COUNT(*) AS total FROM Article WHERE renewal_date > NOW() AND renewal_date <= DATE_ADD(NOW(), INTERVAL ".DEFAULT_ARTICLE_DAYS_TO_EXPIRE." DAY)";
			$r = $dbObj->query($sql); $row = mysql_fetch_assoc($r);
			$status["a_expiring"] = (int)$row["total"];

			$sql = "SELECT COUNT(*) AS total FROM Article WHERE status = ".db_formatString("E")."";
			$r = $dbObj->query($sql); $row = mysql_fetch_assoc($r);
			$status["a_expired"] = (int)$row["total"];

			$sql = "SELECT COUNT(*) AS total FROM Article WHERE status = ".db_formatString("A")."";
			$r = $dbObj->query($sql); $row = mysql_fetch_assoc($r);
			$status["a_active"] = (int)$row["total"];

			$sql = "SELECT COUNT(*) AS total FROM Article WHERE status = ".db_formatString("S")."";
			$r = $dbObj->query($sql); $row = mysql_fetch_assoc($r);
			$status["a_suspended"] = (int)$row["total"];

			$sql = "SELECT COUNT(*) AS total from Article WHERE entered >= '".date("Y-m-d", mktime(0, 0, 0, date("m")-1 , date("d"), date("Y")))."'";
			$r = $dbObj->query($sql); $row = mysql_fetch_assoc($r);
			$status["a_added30"] = (int)$row["total"];

		}

		unset($dbObj);

		return $status;

	}

	function system_getStatus() {

		$status = array();

		$dbObj = db_getDBObJect();

		// LISTING
		unset($status_aux);
		$status_aux = system_getListingStatus();
		foreach ($status_aux as $name=>$value) {
			$status[$name] = $value;
		}

		// EVENT
		unset($status_aux);
		$status_aux = system_getEventStatus();
		foreach ($status_aux as $name=>$value) {
			$status[$name] = $value;
		}

		// BANNER
		unset($status_aux);
		$status_aux = system_getBannerStatus();
		foreach ($status_aux as $name=>$value) {
			$status[$name] = $value;
		}

		// CLASSIFIED
		unset($status_aux);
		$status_aux = system_getClassifiedStatus();
		foreach ($status_aux as $name=>$value) {
			$status[$name] = $value;
		}

		// ARTICLE
		unset($status_aux);
		$status_aux = system_getArticleStatus();
		foreach ($status_aux as $name=>$value) {
			$status[$name] = $value;
		}

		// REVIEW
		$sql = "SELECT COUNT(*) AS total FROM Review WHERE approved = '0'";
		$r = $dbObj->query($sql); $row = mysql_fetch_assoc($r);
		$status["r_pending"] = (int)$row["total"];

		// MONEY
		$sql = "SELECT COUNT(*) AS total, SUM(transaction_amount) AS amount from Payment_Log WHERE transaction_datetime >= '".date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")-30, date("Y")))."'";
		$r = $dbObj->query($sql); $row = mysql_fetch_assoc($r);
		$status["payment_amount"] = (float)$row["amount"];

		$sql = "SELECT COUNT(*) AS total, SUM(amount) AS amount from Invoice WHERE status = 'R' AND payment_date >= '".date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")-30, date("Y")))."'";
		$r = $dbObj->query($sql); $row = mysql_fetch_assoc($r);
		$status["invoice_amount"] = (float)$row["amount"];

		// INVOICE
		$sql = "SELECT COUNT(*) AS total from Invoice WHERE status = ".db_formatString("P")."";
		$r = $dbObj->query($sql); $row = mysql_fetch_assoc($r);
		$status["i_pending"] = (int)$row["total"];

		$sql = "SELECT COUNT(*) AS total FROM Invoice WHERE expire_date > NOW() AND expire_date <= DATE_ADD(NOW(), INTERVAL 5 DAY) AND status = 'P'";
		$r = $dbObj->query($sql); $row = mysql_fetch_assoc($r);
		$status["i_expiring"] = (int)$row["total"];

		$sql = "SELECT COUNT(*) AS total from Invoice WHERE status = ".db_formatString("E")."";
		$r = $dbObj->query($sql); $row = mysql_fetch_assoc($r);
		$status["i_expired"] = (int)$row["total"];

		$sql = "SELECT COUNT(*) AS total from Invoice WHERE status = ".db_formatString("R")."";
		$r = $dbObj->query($sql); $row = mysql_fetch_assoc($r);
		$status["i_received"] = (int)$row["total"];

		$sql = "SELECT COUNT(*) AS total from Invoice WHERE status = ".db_formatString("S")."";
		$r = $dbObj->query($sql); $row = mysql_fetch_assoc($r);
		$status["i_suspended"] = (int)$row["total"];

		// CUSTOM INVOICE
		$sql = "SELECT COUNT(*) AS total From CustomInvoice WHERE paid ='y'";
		$r = $dbObj->query($sql); $row = mysql_fetch_assoc($r);
		$status["custominvoice_paid"] = (int)$row["total"];

		$sql = "SELECT COUNT(*) AS total From CustomInvoice WHERE paid !='y' AND sent!='y' AND completed='y'";
		$r = $dbObj->query($sql); $row = mysql_fetch_assoc($r);
		$status["custominvoice_pending"] = (int)$row["total"];

		$sql = "SELECT COUNT(*) AS total From CustomInvoice WHERE paid !='y' AND sent='y' AND completed='y'";
		$r = $dbObj->query($sql); $row = mysql_fetch_assoc($r);
		$status["custominvoice_sent"] = (int)$row["total"];

		// CLAIM
		$sql = "SELECT COUNT(*) AS total FROM Claim WHERE status = ".db_formatString("complete")." AND account_id > 0 AND listing_id > 0";
		$r = $dbObj->query($sql); $row = mysql_fetch_assoc($r);
		$status["claim_complete"] = (int)$row["total"];

		unset($dbObj);

		return $status;

	}

	function system_countActiveListingByCategory($listingID = "", $update = "") {

		$dbObj = db_getDBObJect();

		if (($listingID) && (is_numeric($listingID)) && ($listingID > 0)) {
			$sql = "SELECT cat_1_id, parcat_1_level1_id, parcat_1_level2_id, parcat_1_level3_id, parcat_1_level4_id, cat_2_id, parcat_2_level1_id, parcat_2_level2_id, parcat_2_level3_id, parcat_2_level4_id, cat_3_id, parcat_3_level1_id, parcat_3_level2_id, parcat_3_level3_id, parcat_3_level4_id, cat_4_id, parcat_4_level1_id, parcat_4_level2_id, parcat_4_level3_id, parcat_4_level4_id, cat_5_id, parcat_5_level1_id, parcat_5_level2_id, parcat_5_level3_id, parcat_5_level4_id FROM Listing WHERE id = ".$listingID;
			$result = $dbObj->query($sql);
			if (mysql_num_rows($result) > 0) {
				$row = mysql_fetch_assoc($result);
				$category_id[] = $row["cat_1_id"];
				$category_id[] = $row["parcat_1_level1_id"];
				$category_id[] = $row["parcat_1_level2_id"];
				$category_id[] = $row["parcat_1_level3_id"];
				$category_id[] = $row["parcat_1_level4_id"];
				$category_id[] = $row["cat_2_id"];
				$category_id[] = $row["parcat_2_level1_id"];
				$category_id[] = $row["parcat_2_level2_id"];
				$category_id[] = $row["parcat_2_level3_id"];
				$category_id[] = $row["parcat_2_level4_id"];
				$category_id[] = $row["cat_3_id"];
				$category_id[] = $row["parcat_3_level1_id"];
				$category_id[] = $row["parcat_3_level2_id"];
				$category_id[] = $row["parcat_3_level3_id"];
				$category_id[] = $row["parcat_3_level4_id"];
				$category_id[] = $row["cat_4_id"];
				$category_id[] = $row["parcat_4_level1_id"];
				$category_id[] = $row["parcat_4_level2_id"];
				$category_id[] = $row["parcat_4_level3_id"];
				$category_id[] = $row["parcat_4_level4_id"];
				$category_id[] = $row["cat_5_id"];
				$category_id[] = $row["parcat_5_level1_id"];
				$category_id[] = $row["parcat_5_level2_id"];
				$category_id[] = $row["parcat_5_level3_id"];
				$category_id[] = $row["parcat_5_level4_id"];
				$category_id = array_unique($category_id);
			}
		} else {
			$sql = "SELECT id FROM ListingCategory ORDER BY id";
			$result = $dbObj->query($sql);
			if (mysql_num_rows($result) > 0) {
				while ($row = mysql_fetch_assoc($result)) {
					$category_id[] = $row["id"];
				}
			}
		}

		if ($category_id) {

			foreach ($category_id as $categoryid) {

				if ($categoryid > 0) {

					$sql = "";
					$sql .= " SELECT ";
					$sql .= " COUNT(DISTINCT(id)) AS activelisting ";
					$sql .= " FROM ";
					$sql .= " Listing ";
					$sql .= " WHERE ";

					$sql .= " (cat_1_id = '".$categoryid."' OR parcat_1_level1_id = '".$categoryid."' OR parcat_1_level2_id = '".$categoryid."' OR parcat_1_level3_id = '".$categoryid."' OR parcat_1_level4_id = '".$categoryid."' OR cat_2_id = '".$categoryid."' OR parcat_2_level1_id = '".$categoryid."' OR parcat_2_level2_id = '".$categoryid."' OR parcat_2_level3_id = '".$categoryid."' OR parcat_2_level4_id = '".$categoryid."' OR cat_3_id = '".$categoryid."' OR parcat_3_level1_id = '".$categoryid."' OR parcat_3_level2_id = '".$categoryid."' OR parcat_3_level3_id = '".$categoryid."' OR parcat_3_level4_id = '".$categoryid."' OR cat_4_id = '".$categoryid."' OR parcat_4_level1_id = '".$categoryid."' OR parcat_4_level2_id = '".$categoryid."' OR parcat_4_level3_id = '".$categoryid."' OR parcat_4_level4_id = '".$categoryid."' OR cat_5_id = '".$categoryid."' OR parcat_5_level1_id = '".$categoryid."' OR parcat_5_level2_id = '".$categoryid."' OR parcat_5_level3_id = '".$categoryid."' OR parcat_5_level4_id = '".$categoryid."') ";

					if (($listingID) && (is_numeric($listingID)) && ($listingID > 0)) $sql .= " AND id = ".$listingID." ";
					else $sql .= " AND status = 'A' ";

					$result = $dbObj->query($sql);
					if (mysql_num_rows($result) > 0) {
						if ($row = mysql_fetch_assoc($result)) {
							$active_listing = $row["activelisting"];
						}
					}

					if ($update == "inc") $sql = "UPDATE ListingCategory SET active_listing = (active_listing + ".$active_listing.") WHERE id = ".$categoryid;
					elseif ($update == "dec") $sql = "UPDATE ListingCategory SET active_listing = (active_listing - ".$active_listing.") WHERE id = ".$categoryid;
					else $sql = "UPDATE ListingCategory SET active_listing = ".$active_listing." WHERE id = ".$categoryid;

					$dbObj->query($sql);

				}

			}

		}

	}

	function system_showBanner($banner_type = false, $banner_category_id = false, $banner_section = "general", $banner_amount = "1") {

		if (BANNER_FEATURE == "on") {

			$dbObj = db_getDBObject();
			$sql = "SELECT value FROM BannerLevel WHERE name = ".db_formatString(str_replace("_", " ", strtolower($banner_type)))." LIMIT 1";

			$result = $dbObj->query($sql);
			if ($result) $row = mysql_fetch_assoc($result);
			if ($row["value"]) $banner_type = $row["value"];
			else $banner_type = false;

			$bannerObj = new Banner();

			$info = $bannerObj->randomRetrieve($banner_type, $banner_category_id, $banner_section, $banner_amount);

			$banner = $bannerObj->makeBanner($info);
			for ($i=0; $i < count($info); $i++) {
				if ($info[$i]["expiration_setting"] == BANNER_EXPIRATION_IMPRESSION && $info[$i]["impressions"] > 0) {
					$sql = "UPDATE Banner SET impressions = impressions - 1 WHERE id = '".$info[$i]["id"]."'";
					$result = $dbObj->query($sql);

				}

			}
            report_newRecord("banner", $info[0]["id"], BANNER_REPORT_VIEW);

		}

		return $banner;

	}

	function system_getHeaderLogo() {
		$headerlogo = "";
		if (file_exists(EDIRECTORY_ROOT.IMAGE_HEADER_PATH)) {
			$headerlogo = "style=\"background: url('".DEFAULT_URL.IMAGE_HEADER_PATH."') 0 0 no-repeat;\"";
		} else {
			if (!EDIR_THEME || (strpos($_SERVER["PHP_SELF"], "/membros") !== false)) {
				$headerlogo = "style=\"background: url('".DEFAULT_URL."/images/content/logo.png') 0 0 no-repeat;\"";
			}
		}
		return $headerlogo;
	}

	function system_getHeaderMobileLogo() {
		$headerlogo = "";
		if (file_exists(EDIRECTORY_ROOT.MOBILE_LOGO_PATH)) {
			$headerlogo_path = MOBILE_LOGO_PATH;
		} else {
			$headerlogo_path = "/images/content/img_logo_mobile.gif";
		}
		$headerlogo = $headerlogo_path;
		return $headerlogo;
	}

	function system_getNoImageStyle($cssfile = false) {
		$noimagestyle = "";
		if ($cssfile) {
			if (file_exists(EDIRECTORY_ROOT.NOIMAGE_PATH."/".NOIMAGE_NAME.".".NOIMAGE_CSSEXT)) {
				$noimagestyle = "<link href=\"".DEFAULT_URL.NOIMAGE_PATH."/".NOIMAGE_NAME.".".NOIMAGE_CSSEXT."\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />";
			} else {
				$noimagestyle = "<link href=\"".DEFAULT_URL."/layout/general_noimage.css\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />";
			}
		} else {
			if (file_exists(EDIRECTORY_ROOT.NOIMAGE_PATH."/".NOIMAGE_NAME.".".NOIMAGE_IMGEXT)) {
				$noimagestyle = "background: #FFF url('".DEFAULT_URL.NOIMAGE_PATH."/".NOIMAGE_NAME.".".NOIMAGE_IMGEXT."') 50% 50% no-repeat;";
			} else {
				$noimagestyle = "background: #FFF url('".DEFAULT_URL."/images/design/bg_noimage.gif') 45% 50% no-repeat;";
			}
		}
		return $noimagestyle;
	}

	// ARRAY TO NAME-VALUE PAIRS
	function system_array2nvp($array, $separator = "&") {
		foreach ($array as $name=>$value) {
			$arrayNVP[] = $name."=".$value;
		}
		$nvpString = implode($separator, $arrayNVP);
		return $nvpString;
	}

	function system_getVideoSnippetCode($video_snippet, $video_snippet_width, $video_snippet_height) {

		$video_resize = false;

		$prefix_video_snippet = "";
		$suffix_video_snippet = $video_snippet;

		while (($pos = strpos($suffix_video_snippet, "width")) !== false) {

			$prefix_video_snippet .= substr($suffix_video_snippet, 0, $pos);
			$suffix_video_snippet = substr($suffix_video_snippet, $pos);

			if (($pos = strpos($suffix_video_snippet, ">")) !== false) {

				$lookingfornumber = $suffix_video_snippet;
				while (!is_numeric($lookingfornumber[0])) {
					$lookingfornumber = substr($lookingfornumber, 1);
				}

				$widthnumber = "";
				while (is_numeric($lookingfornumber[0])) {
					$widthnumber .= $lookingfornumber[0];
					$lookingfornumber = substr($lookingfornumber, 1);
				}

				if ($widthnumber > $video_snippet_width) {
					$video_resize = true;
				}

				$prefix_video_snippet .= substr($suffix_video_snippet, 0, $pos);
				$suffix_video_snippet = substr($suffix_video_snippet, $pos);

			}

		}

		$prefix_video_snippet = "";
		$suffix_video_snippet = $video_snippet;

		while (($pos = strpos($suffix_video_snippet, "height")) !== false) {

			$prefix_video_snippet .= substr($suffix_video_snippet, 0, $pos);
			$suffix_video_snippet = substr($suffix_video_snippet, $pos);

			if (($pos = strpos($suffix_video_snippet, ">")) !== false) {

				$lookingfornumber = $suffix_video_snippet;
				while (!is_numeric($lookingfornumber[0])) {
					$lookingfornumber = substr($lookingfornumber, 1);
				}

				$heightnumber = "";
				while (is_numeric($lookingfornumber[0])) {
					$heightnumber .= $lookingfornumber[0];
					$lookingfornumber = substr($lookingfornumber, 1);
				}

				if ($heightnumber > $video_snippet_height) {
					$video_resize = true;
				}

				$prefix_video_snippet .= substr($suffix_video_snippet, 0, $pos);
				$suffix_video_snippet = substr($suffix_video_snippet, $pos);

			}

		}

		$prefix_video_snippet = "";
		$suffix_video_snippet = $video_snippet;

		if ($video_resize) {
			while ((($pos = strpos($suffix_video_snippet, "width")) !== false) || (($pos = strpos($suffix_video_snippet, "height")) !== false)) {
				$prefix_video_snippet .= substr($suffix_video_snippet, 0, $pos);
				$prefix_video_snippet .= " style=\"width: ".$video_snippet_width."px; height: ".$video_snippet_height."px;\" ";
				$suffix_video_snippet = substr($suffix_video_snippet, $pos);
				if (($pos = strpos($suffix_video_snippet, ">")) !== false) {
					$prefix_video_snippet .= substr($suffix_video_snippet, 0, $pos);
					$suffix_video_snippet = substr($suffix_video_snippet, $pos);
				}
			}
		}

		$video_snippet_code = $prefix_video_snippet.$suffix_video_snippet;

		return $video_snippet_code;

	}

	function system_getURLSearchParams($array) {
		$url_search_params = "";
		$array_search_params = array();
		if ($array) {
			if (count($array) > 0) {
				foreach ($array as $name=>$value) {
					$pos = strpos($name, "search_");
					if (($pos !== false) && ($pos == 0)) {
						if ($value) {
							$array_search_params[] = $name."=".$value;
						}
					}
				}
			}
		}
		if ($array_search_params) {
			if (count($array_search_params) > 0) {
				$url_search_params = implode("&", $array_search_params);
			}
		}
		return $url_search_params;
	}

	function system_getFormInputSearchParams($array) {
		$url_search_params = "";
		$array_search_params = array();
		if ($array) {
			if (count($array) > 0) {
				foreach ($array as $name=>$value) {
					$pos = strpos($name, "search_");
					if (($pos !== false) && ($pos == 0)) {
						if ($value) {
							$array_search_params[] = "<input type=\"hidden\" name=\"".$name."\" value=\"".$value."\" />";
						}
					}
				}
			}
		}
		if ($array_search_params) {
			if (count($array_search_params) > 0) {
				$url_search_params = implode("\n", $array_search_params);
			}
		}
		return $url_search_params;
	}

	function system_denyInjections($var) {
		$var = strip_tags($var);
		$var_aux = urlencode($var);
		if ((strpos($var_aux, "%0") !== false) || (strpos($var_aux, "%1") !== false)){
			//$var = "";
		}
		return $var;
	}

	function system_showFrontGallery($galleries = 0, $level = 0, $user = false, $imagesToShow = 4, $type = "listing", $lang=EDIR_LANGUAGE) {

		$langIndex = language_getIndex($lang);

		$gallery_code_final = "";

		if (count($galleries)>0) {

			if ($type=="listing") $item_max_gallery = LISTING_MAX_GALLERY;
			elseif ($type=="event") $item_max_gallery = EVENT_MAX_GALLERY;
			elseif ($type=="classified") $item_max_gallery = CLASSIFIED_MAX_GALLERY;
			elseif ($type=="article") $item_max_gallery = ARTICLE_MAX_GALLERY;
			else return "";

			while (count($galleries) > $item_max_gallery) {
				array_pop($galleries);
			}

			foreach ($galleries as $each_gallery) {

				$gallery_code = "";

				$slideshowpopup = "javascript:void(0);";
				if ($user) $slideshowpopup = "window.open('".DEFAULT_URL."/slideshow.php?gallery_id=".$each_gallery."&amp;".$type."_level=".$level.URLVAR."', 'popup', 'toolbar=0, width=".(IMAGE_GALLERY_FULL_WIDTH+100).", height=".(IMAGE_GALLERY_FULL_HEIGHT+200).", scrollbars=yes, screenX=0, screenY=0');";

				$galleryObj = new Gallery($each_gallery);

				if ($galleryObj->getNumber("id") && $galleryObj->image && count($galleryObj->image) > 0) {

					if ($type=="listing") $galleryLevel = new ListingLevel();
					elseif ($type=="event") $galleryLevel = new EventLevel();
					elseif ($type=="classified") $galleryLevel = new ClassifiedLevel();
					elseif ($type=="article") $galleryLevel = new ArticleLevel();
					else return "";

					$maxImages = $galleryLevel->getImages($level);

					if (($maxImages) && (($maxImages > 0) || ($maxImages == -1))) {

						$totalImages = ($maxImages >= count($galleryObj->image)) ? count($galleryObj->image) : $maxImages;
						if ($maxImages == -1) $totalImages = count($galleryObj->image);

						$gallery_code .= "<ul>";

						$number_of_images = 0;

						$i = 0;
						for ($imgInd = 0; $imgInd < $totalImages; $imgInd++) {

							$presentImg = $galleryObj->image[$imgInd];

							$imageObj = new Image($presentImg["image_id"]);
							$imageThumbObj = new Image($presentImg["thumb_id"]);

							if ($imageObj->imageExists() && $imageThumbObj->imageExists()) {

								if ($number_of_images < $imagesToShow) {

									$gallery_code .= "<li>";
								//		$gallery_code .= "<a href=\"javascript:void(0)\" onclick=\"".str_replace(URLVAR, "&amp;gallery_image={$presentImg["image_id"]}&amp;i=$i", $slideshowpopup)."\" style=\"cursor: pointer;\">";
										$gallery_code .= "<a class=\"thickbox\" href=\"".DEFAULT_URL."/slideshow.php?gallery_id=".$each_gallery."&amp;".$type."_level=".$level.URLVAR."&amp;gallery_image={$presentImg["image_id"]}&ampKeepThis=true&TB_iframe=true&width=600&height=500\" \">";
											$gallery_code .= "<span style=\"width:".IMAGE_GALLERY_THUMB_WIDTH."px; height:".IMAGE_GALLERY_THUMB_HEIGHT."px;\">".$imageThumbObj->getTag(true, IMAGE_GALLERY_THUMB_WIDTH, IMAGE_GALLERY_THUMB_HEIGHT, $presentImg["thumb_caption".$langIndex])."</span>";
											$wrapWidth = (IMAGE_GALLERY_THUMB_WIDTH/5); // each character have a width of 5px
										$gallery_code .= "</a>";
									$gallery_code .= "</li>";

								}

								$number_of_images++;

								$i++;

							}

						}

						$gallery_code .= "</ul>";

						if (!strpos($_SERVER["PHP_SELF"], "print.php")) {
							$gallery_code .= "<p class=\"complementaryInfo\"><a class=\"thickbox\" href=\"".DEFAULT_URL."/slideshow.php?gallery_id=".$each_gallery."&amp;".$type."_level=".$level.URLVAR."&amp;KeepThis=true&TB_iframe=true&width=600&height=500\" \">".system_showText(LANG_GALLERYCLICKHERE)."</a> ".system_showText(LANG_GALLERYSLIDESHOWTEXT)."</p>";
						} else {
							$gallery_code .= "<p class=\"complementaryInfo\"><a href=\"javascript:void(0)\">".system_showText(LANG_GALLERYCLICKHERE)."</a> ".system_showText(LANG_GALLERYSLIDESHOWTEXT)."</p>";
						}

						if ($totalImages > $imagesToShow) {

							$gallery_code .= "<p class=\"viewMore\">";
							$gallery_code .= "	<a href=\"javascript:void(0)\" onclick=\"".str_replace(URLVAR, "", $slideshowpopup)."\"><strong>".system_showText(LANG_GALLERYMOREPHOTOS)." &raquo;</strong></a>";
							$gallery_code .= "</p>";

						}

					}

					unset($galleryLevel);
					unset($galleryObj);

					if ($number_of_images==0) $gallery_code = "";

				}

				$gallery_code_final .= $gallery_code;

			}

		}

		return $gallery_code_final;

	}

    function system_showFrontClient($clientes = 0, $level = 0, $user = false, $imagesToShow = 4, $type = "listing", $lang=EDIR_LANGUAGE) {

		$langIndex = language_getIndex($lang);

		$client_code_final = "";

		if (count($clientes)>0) {

		    $item_max_client = LISTING_MAX_GALLERY;

			while (count($clientes) > $item_max_client) {
				array_pop($clientes);
			}

			foreach ($clientes as $each_client) {

				$client_code = "";

				$slideshowpopup = "javascript:void(0);";
				if ($user) $slideshowpopup = "window.open('".DEFAULT_URL."/slideshow.php?client_id=".$each_client."&amp;".$type."_level=".$level.URLVAR."', 'popup', 'toolbar=0, width=".(IMAGE_GALLERY_FULL_WIDTH+100).", height=".(IMAGE_GALLERY_FULL_HEIGHT+200).", scrollbars=yes, screenX=0, screenY=0');";

				$clientObj = new Client($each_client);

				if ($clientObj->getNumber("id") && $clientObj->image && count($clientObj->image) > 0) {

				    $clientLevel = new ListingLevel();

					$maxImages = $clientLevel->getImages($level);

					if (($maxImages) && (($maxImages > 0) || ($maxImages == -1))) {

						$totalImages = ($maxImages >= count($clientObj->image)) ? count($clientObj->image) : $maxImages;
						if ($maxImages == -1) $totalImages = count($clientObj->image);

						$client_code .= "<ul>";

						$number_of_images = 0;

						$i = 0;
						for ($imgInd = 0; $imgInd < $totalImages; $imgInd++) {

							$presentImg = $clientObj->image[$imgInd];

							$imageObj = new Image($presentImg["image_id"]);
							$imageThumbObj = new Image($presentImg["thumb_id"]);

							if ($imageObj->imageExists() && $imageThumbObj->imageExists()) {

								if ($number_of_images < $imagesToShow) {

									$client_code .= "<li>";
								//		$client_code .= "<a href=\"javascript:void(0)\" onclick=\"".str_replace(URLVAR, "&amp;client_image={$presentImg["image_id"]}&amp;i=$i", $slideshowpopup)."\" style=\"cursor: pointer;\">";
										$client_code .= "<a href=\"".$presentImg["image_caption"]."\"  target=\"_blank\">";
  										$client_code .= "<span style=\"width:".IMAGE_GALLERY_THUMB_WIDTH."px; height:".IMAGE_GALLERY_THUMB_HEIGHT."px;\">".$imageThumbObj->getTag(false, IMAGE_GALLERY_THUMB_WIDTH, IMAGE_GALLERY_THUMB_HEIGHT, $presentImg["thumb_caption".$langIndex])."</span>";
										$wrapWidth = (IMAGE_GALLERY_THUMB_WIDTH/5); // each character have a width of 5px
										$client_code .= "</a>";
									$client_code .= "</li>";

								}

								$number_of_images++;

								$i++;

							}

						}

						$client_code .= "</ul>";

						//if (!strpos($_SERVER["PHP_SELF"], "print.php")) {
						//	$client_code .= "<p class=\"complementaryInfo\"><a class=\"thickbox\" href=\"".DEFAULT_URL."/slideshow.php?client_id=".$each_client."&amp;".$type."_level=".$level.URLVAR."&amp;KeepThis=true&TB_iframe=true&width=600&height=500\" \">".system_showText(LANG_GALLERYCLICKHERE)."</a> ".system_showText(LANG_GALLERYSLIDESHOWTEXT)."</p>";
						//} else {
						//	$client_code .= "<p class=\"complementaryInfo\"><a href=\"javascript:void(0)\">".system_showText(LANG_GALLERYCLICKHERE)."</a> ".system_showText(LANG_GALLERYSLIDESHOWTEXT)."</p>";
						//}

						if ($totalImages > $imagesToShow) {

							$client_code .= "<p class=\"viewMore\">";
							$client_code .= "	<a href=\"javascript:void(0)\" onclick=\"".str_replace(URLVAR, "", $slideshowpopup)."\"><strong>".system_showText(LANG_GALLERYMOREPHOTOS)." &raquo;</strong></a>";
							$client_code .= "</p>";

						}

					}

					unset($clientLevel);
					unset($clientObj);

					if ($number_of_images==0) $client_code = "";

				}

				$client_code_final .= $client_code;

			}

		}

		return $client_code_final;

	}

	function system_highlightFirstWord($word, $amount=1) {
		if ($amount <= 1) {
			if (($pos = strpos($word, " ")) !== false) {
				return "<span>".substr($word, 0, $pos)."</span>".substr($word, $pos);
			} else {
				return $word;
			}
		} else {
			$words = explode(" ", $word);
			if (count($words) >= 2) {
				if ($amount <= count($words)) {
					$words[$amount-1] = $words[$amount-1]."</span>";
				} else {
					$words[count($words)-1] = $words[count($words)-1]."</span>";
				}
				return "<span>".implode(" ", $words);
			} else {
				return $word;
			}
		}
	}

	function system_highlightLastWord($word, $amount=1) {
		if ($amount <= 1) {
			if (($pos = strrpos($word, " ")) !== false) {
				return substr($word, 0, $pos+1)."<span>".substr($word, $pos+1)."</span>";
			} else {
				return $word;
			}
		} else {
			$words = explode(" ", $word);
			if (count($words) >= 2) {
				if ($amount <= count($words)) {
					$words[count($words)-$amount] = "<span>".$words[count($words)-$amount];
				} else {
					$words[0] = "<span>".$words[0];
				}
				return implode(" ", $words)."</span>";
			} else {
				return $word;
			}
		}
	}

	function system_showText($text) {
		return $text;
	}

	function system_showDate($format_str, $time=false) {
		if (!strlen(trim($format_str))) return false;
		if (!$time) $time = mktime(date('H'),date('i'),date('s'),date('n'),date('j'),date('Y'));
		$allow_datechars = array('d','D','j','l','N','S','w','z','W','F','m','M','n','t','L','o','Y','y','a','A','B','g','G','h','H','i','s','u','e','I','O','P','T','Z','c','r','U','\\');
		$month_names = explode(",", LANG_DATE_MONTHS);
		$weekday_names = explode(",", LANG_DATE_WEEKDAYS);
		$aux_format_str = $format_str;
		$buffer = "";
		for ($i=0; $i<strlen($aux_format_str); $i++) {
			if (in_array($aux_format_str[$i], $allow_datechars)) {
				//d -> Day of the month, 2 digits with leading zeros.
				if ($aux_format_str[$i] == "d") { $buffer .= date("d", $time); }
				//D -> A textual representation of a day, three letras.
				if ($aux_format_str[$i] == "D") { $buffer .= substr($weekday_names[date("j", $time)-1], 0, 3); }
				//j -> Day of the month without leading zeros.
				if ($aux_format_str[$i] == "j") { $buffer .= date("j", $time); }
				//l -> A full textual representation of the day of the week.
				if ($aux_format_str[$i] == "l") { $buffer .= $weekday_names[date("j", $time)-1]; }
				//N -> ISO-8601 numeric representation of the day of the week.
				if ($aux_format_str[$i] == "N") { $buffer .= date("N", $time); }
				//S -> English ordinal suffix for the day of the month, 2 characters.
				if ($aux_format_str[$i] == "S") { $buffer .= date("S", $time); }
				//w -> Numeric representation of the day of the week.
				if ($aux_format_str[$i] == "w") { $buffer .= date("w", $time); }
				//z -> The day of the year (starting from 0).
				if ($aux_format_str[$i] == "z") { $buffer .= date("z", $time); }
				//W -> ISO-8601 week number of year, weeks starting on Monday.
				if ($aux_format_str[$i] == "W") { $buffer .= date("W", $time); }
				//F -> A full textual representation of a month, such as January or March.
				if ($aux_format_str[$i] == "F") { $buffer .= ucwords($month_names[date("n", $time)-1]); }
				//m -> Numeric representation of a month, with leading zeros.
				if ($aux_format_str[$i] == "m") { $buffer .= date("m", $time); }
				//M -> A short textual representation of a month, three letras.
				if ($aux_format_str[$i] == "M") { $buffer .= date("M", $time); }
				//n -> Numeric representation of a month, without leading zeros.
				if ($aux_format_str[$i] == "n") { $buffer .= date("n", $time); }
				//t -> Number of days in the given month.
				if ($aux_format_str[$i] == "t") { $buffer .= date("t", $time); }
				//L -> Whether it's a leap year.
				if ($aux_format_str[$i] == "L") { $buffer .= date("L", $time); }
				//o -> ISO-8601 year number. This has the same value as Y, except that if the ISO week number (W) belongs to the previous or next year, that year is used instead.
				if ($aux_format_str[$i] == "o") { $buffer .= date("o", $time); }
				//Y -> A full numeric representation of a year, 4 digits.
				if ($aux_format_str[$i] == "Y") { $buffer .= date("Y", $time); }
				//y -> A two digit representation of a year.
				if ($aux_format_str[$i] == "y") { $buffer .= date("y", $time); }
				//a -> Lowercase Ante meridiem and Post meridiem.
				if ($aux_format_str[$i] == "a") { $buffer .= date("a", $time); }
				//A -> Uppercase Ante meridiem and Post meridiem.
				if ($aux_format_str[$i] == "A") { $buffer .= date("A", $time); }
				//B -> Swatch Internet time.
				if ($aux_format_str[$i] == "B") { $buffer .= date("B", $time); }
				//g -> 12-hour format of an hour without leading zeros.
				if ($aux_format_str[$i] == "g") { $buffer .= date("g", $time); }
				//G -> 24-hour format of an hour without leading zeros.
				if ($aux_format_str[$i] == "G") { $buffer .= date("G", $time); }
				//h -> 12-hour format of an hour with leading zeros.
				if ($aux_format_str[$i] == "h") { $buffer .= date("h", $time); }
				//H -> 24-hour format of an hour with leading zeros.
				if ($aux_format_str[$i] == "H") { $buffer .= date("H", $time); }
				//i -> Minutes with leading zeros.
				if ($aux_format_str[$i] == "i") { $buffer .= date("i", $time); }
				//s -> Seconds, with leading zeros.
				if ($aux_format_str[$i] == "s") { $buffer .= date("s", $time); }
				//u -> Microseconds.
				if ($aux_format_str[$i] == "u") { $buffer .= date("u", $time); }
				//e -> Timezone identifier.
				if ($aux_format_str[$i] == "e") { $buffer .= date("e", $time); }
				//I -> Whether or not the date is in daylight saving time.
				if ($aux_format_str[$i] == "I") { $buffer .= date("I", $time); }
				//O -> Difference to Greenwich time (GMT) in hours.
				if ($aux_format_str[$i] == "O") { $buffer .= date("O", $time); }
				//P -> Difference to Greenwich time (GMT) with colon between hours and minutes.
				if ($aux_format_str[$i] == "P") { $buffer .= date("P", $time); }
				//T -> Timezone abbreviation.
				if ($aux_format_str[$i] == "T") { $buffer .= date("T", $time); }
				//Z -> Timezone offset in seconds. The offset for timezones west of UTC is always negative, and for those east of UTC is always positive.
				if ($aux_format_str[$i] == "Z") { $buffer .= date("Z", $time); }
				//c -> ISO 8601 date.
				if ($aux_format_str[$i] == "c") { $buffer .= date("c", $time); }
				//r -> RFC 2822 formatted date.
				if ($aux_format_str[$i] == "r") { $buffer .= date("r", $time); }
				//U -> Seconds since the Unix Epoch (January 1 1970 00:00:00 GMT).
				if ($aux_format_str[$i] == "U") { $buffer .= date("U", $time); }
				//\ -> escape.
				if ($aux_format_str[$i] == "\\") {
					$i++;
					$buffer .= $aux_format_str[$i];
				}
			} else {
				$buffer .= $aux_format_str[$i];
			}
		}
		return $buffer;
	}

	function system_itemRelatedCategories($item_id, $item_type, $user) {
		$return = "";
		$langIndex = language_getIndex(EDIR_LANGUAGE);
		if ($item_type == "listing") $itemObj = new Listing($item_id);
		elseif ($item_type == "event") $itemObj = new Event($item_id);
		elseif ($item_type == "classified") $itemObj = new Classified($item_id);
		elseif ($item_type == "article") $itemObj = new Article($item_id);
		if ($itemObj && $itemObj->getNumber("id") && ($itemObj->getNumber("id")>0)) {
			$categories = $itemObj->getCategories();
			if ($categories) {
				foreach ($categories as $category) {
					$treePath = getTreePath($category->getNumber("id"), $item_type);
					$treePath = substr($treePath, 1);
					if (strpos($treePath, ",") !== false) $mainCategoryID = substr($treePath, 0, strpos($treePath, ","));
					else $mainCategoryID = $treePath;
					$mainCategoriesID[] = $mainCategoryID;
				}
				if ($mainCategoriesID) {
					$mainCategoriesID = array_unique($mainCategoriesID);
					foreach ($mainCategoriesID as $mainCategoryID) {
						if ($item_type == "listing") {
							$mainCategoryObj = new ListingCategory($mainCategoryID);
							if ($mainCategoryObj->getString("title".$langIndex)) {
								if ($user) {
									if (MODREWRITE_FEATURE != "on") {
										$categoriesString[] = "<a href=\"".LISTING_DEFAULT_URL."/results.php?category_id=".$mainCategoryObj->getNumber("id")."\">".$mainCategoryObj->getString("title".$langIndex)."</a>";
									} else {
										$categoriesString[] = "<a href=\"".LISTING_DEFAULT_URL."/guide/".$mainCategoryObj->getString("friendly_url".$langIndex)."\">".$mainCategoryObj->getString("title".$langIndex)."</a>";
									}
								} else {
									$categoriesString[] = "<a href=\"javascript:void(0);\">".$mainCategoryObj->getString("title".$langIndex)."</a>";
								}
							}
						} elseif ($item_type == "event") {
							$mainCategoryObj = new EventCategory($mainCategoryID);
							if ($mainCategoryObj->getString("title".$langIndex)) {
								if ($user) {
									if (MODREWRITE_FEATURE != "on") {
										$categoriesString[] = "<a href=\"".EVENT_DEFAULT_URL."/results.php?category_id=".$mainCategoryObj->getNumber("id")."\">".$mainCategoryObj->getString("title".$langIndex)."</a>";
									} else {
										$categoriesString[] = "<a href=\"".EVENT_DEFAULT_URL."/guide/".$mainCategoryObj->getString("friendly_url".$langIndex)."\">".$mainCategoryObj->getString("title".$langIndex)."</a>";
									}
								} else {
									$categoriesString[] = "<a href=\"javascript:void(0);\">".$mainCategoryObj->getString("title".$langIndex)."</a>";
								}
							}
						} elseif ($item_type == "classified") {
							$mainCategoryObj = new ClassifiedCategory($mainCategoryID);
							if ($mainCategoryObj->getString("title".$langIndex)) {
								if ($user) {
									if (MODREWRITE_FEATURE != "on") {
										$categoriesString[] = "<a href=\"".CLASSIFIED_DEFAULT_URL."/results.php?category_id=".$mainCategoryObj->getNumber("id")."\">".$mainCategoryObj->getString("title".$langIndex)."</a>";
									} else {
										$categoriesString[] = "<a href=\"".CLASSIFIED_DEFAULT_URL."/guide/".$mainCategoryObj->getString("friendly_url".$langIndex)."\">".$mainCategoryObj->getString("title".$langIndex)."</a>";
									}
								} else {
									$categoriesString[] = "<a href=\"javascript:void(0);\">".$mainCategoryObj->getString("title".$langIndex)."</a>";
								}
							}
						} elseif ($item_type == "article") {
							$mainCategoryObj = new ArticleCategory($mainCategoryID);
							if ($mainCategoryObj->getString("title".$langIndex)) {
								if ($user) {
									if (MODREWRITE_FEATURE != "on") {
										$categoriesString[] = "<a href=\"".ARTICLE_DEFAULT_URL."/results.php?category_id=".$mainCategoryObj->getNumber("id")."\">".$mainCategoryObj->getString("title".$langIndex)."</a>";
									} else {
										$categoriesString[] = "<a href=\"".ARTICLE_DEFAULT_URL."/guide/".$mainCategoryObj->getString("friendly_url".$langIndex)."\">".$mainCategoryObj->getString("title".$langIndex)."</a>";
									}
								} else {
									$categoriesString[] = "<a href=\"javascript:void(0);\">".$mainCategoryObj->getString("title".$langIndex)."</a>";
								}
							}
						}
					}
					if ($categoriesString) {
						$return = system_showText(LANG_SEARCHRESULTS_CATEGORY)." ".implode(", ", $categoriesString);
					}
				}
			}
		}
		return $return;
	}

    function system_accentOff($str) {

        $accents = array(
                        "A" => "/&Agrave;|&Aacute;|&Acirc;|&Atilde;|&Auml;|&Aring;/",
                        "a" => "/&agrave;|&aacute;|&acirc;|&atilde;|&auml;|&aring;/",
                        "C" => "/&Ccedil;/",
                        "c" => "/&ccedil;/",
                        "E" => "/&Egrave;|&Eacute;|&Ecirc;|&Euml;/",
                        "e" => "/&egrave;|&eacute;|&ecirc;|&euml;/",
                        "I" => "/&Igrave;|&Iacute;|&Icirc;|&Iuml;/",
                        "i" => "/&igrave;|&iacute;|&icirc;|&iuml;/",
                        "N" => "/&Ntilde;/",
                        "n" => "/&ntilde;/",
                        "O" => "/&Ograve;|&Oacute;|&Ocirc;|&Otilde;|&Ouml;/",
                        "o" => "/&ograve;|&oacute;|&ocirc;|&otilde;|&ouml;/",
                        "U" => "/&Ugrave;|&Uacute;|&Ucirc;|&Uuml;/",
                        "u" => "/&ugrave;|&uacute;|&ucirc;|&uuml;/",
                        "Y" => "/&Yacute;/",
                        "y" => "/&yacute;|&yuml;/",
                        "a." => "/&ordf;/",
                        "o." => "/&ordm;/"
                        );

        return preg_replace(array_values($accents), array_keys($accents), htmlentities($str));
    }

	function system_showAccountUserName($username) {
		if (($pos = strpos($username, "::")) !== false) {
			$username = substr($username, $pos+2);
		}
		return $username;
	}

	function system_registerForeignAccount($authArray, $accountType) {

		unset($foreignAccount);

		if (!$authArray) return false;
		if (!is_array($authArray)) return false;
		if (!$accountType) return false;

		unset($auth);

		if ($accountType == "openid") {
			if (!$authArray["openid_identity"]) return false;
			if (strpos($authArray["openid_identity"], "http://") === false) return false;
			$foreignAccount["username"] = $accountType."::".$authArray["openid_identity"];
			foreach($authArray as $key=>$value) {
				$auth[] = $key."=".$value;
				if ($key == "openid_sreg_email") {
					if ($value) {
						$foreignAccount["email"] = $value;
					}
				} elseif ($key == "openid_sreg_fullname") {
					if ($value) {
						if (strpos($value, " ") !== false) {
							$foreignAccount["first_name"] = substr($value, 0, strpos($value, " "));
							$foreignAccount["last_name"] = substr($value, strrpos($value, " ")+1);
						} else {
							$foreignAccount["last_name"] = $value;
						}
					}
				}
			}
		} elseif ($accountType == "facebook") {
			$thisusername = $authArray["first_name"].$authArray["last_name"];
			$thisusername = ereg_replace("[^a-zA-Z0-9]", "", $thisusername);
			$thisusername = strtolower($thisusername);
			$foreignAccount["username"] = $accountType."::".$thisusername."_".$authArray["uid"];
			$foreignAccount["first_name"] = $authArray["first_name"];
			$foreignAccount["last_name"] = $authArray["last_name"];
			foreach($authArray as $key=>$value) {
				$auth[] = $key."=".$value;
			}
		}

		$foreignAccount["foreignaccount"] = "y";
		$foreignAccount["foreignaccount_auth"] = implode(" || ", $auth);

		$account = db_getFromDB("account", "username", db_formatString($foreignAccount["username"]));
		if (!($account->getNumber("id"))) {

			$account = new Account($foreignAccount);
			$account->save();
			$account->setForeignAccountAuth($foreignAccount["foreignaccount_auth"]);
			$contact = new Contact($foreignAccount);
			$contact->setNumber("account_id", $account->getNumber("id"));
			$contact->save();

			####################################################################################################
			####################################################################################################
			####################################################################################################
			# E-mail notify
			setting_get("sitemgr_send_email",$sitemgr_send_email);
			setting_get("sitemgr_email",$sitemgr_email);
			$sitemgr_emails = split(",",$sitemgr_email);
			setting_get("sitemgr_account_email",$sitemgr_account_email);
			$sitemgr_account_emails = split(",",$sitemgr_account_email);
			// sending e-mail to user //////////////////////////////////////////////////////////////////////////
			$error = false;
			$body = system_showText(LANG_DEAR)." ".system_showAccountUserName($account->getString("username")).",\n".system_showText(LANG_MSG_THANK_YOU_FOR_SIGNING_UP)." ".EDIRECTORY_TITLE." (".DEFAULT_URL.").\n".system_showText(LANG_MSG_LOGIN_TO_MANAGE_YOUR_ACCOUNT)."\n\n".system_showText(LANG_LABEL_USERNAME).": ".system_showAccountUserName($account->getString("username"))."\n\n".system_showText(LANG_MSG_YOU_CAN_SEE).":\n".system_showText(LANG_MSG_YOUR_ACCOUNT_IN)." ".DEFAULT_URL."/membros/account/account.php?id=".$account->getNumber("id")."\n";
			//system_mail($contact->getString("email"), "[".EDIRECTORY_TITLE."] ".system_showText(LANG_LABEL_SIGNUP_NOTIFICATION), $body, EDIRECTORY_TITLE." <$sitemgr_email>", 'text/plain', '', '', $error);
			////////////////////////////////////////////////////////////////////////////////////////////////////
			// site manager warning message /////////////////////////////////////
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
							A new account was created in ".EDIRECTORY_TITLE.".<br />
							Please review the account information below:<br /><br />";
							$sitemgr_msg .= "<b>Username: </b>".system_showAccountUserName($account->getString("username"))."<br />";
							$sitemgr_msg .= "<b>First Name: </b>".$contact->getString("first_name")."<br />";
							$sitemgr_msg .= "<b>Last Name: </b>".$contact->getString("last_name")."<br />";
							$sitemgr_msg .= "<b>Company: </b>".$contact->getString("company")."<br />";
							$sitemgr_msg .= "<b>Address: </b>".$contact->getString("address")." ".$contact->getString("address2")."<br />";
							$sitemgr_msg .= "<b>City: </b>".$contact->getString("city")."<br />";
							$sitemgr_msg .= "<b>State: </b>".$contact->getString("state")."<br />";
							$sitemgr_msg .= "<b>".ucwords(ZIPCODE_LABEL).": </b>".$contact->getString("zip")."<br />";
							$sitemgr_msg .= "<b>Phone: </b>".$contact->getString("phone")."<br />";
							$sitemgr_msg .= "<b>Fax: </b>".$contact->getString("fax")."<br />";
							$sitemgr_msg .= "<b>Email: </b>".$contact->getString("email")."<br />";
							$sitemgr_msg .= "<b>URL: </b>".$contact->getString("url")."<br />";
							$sitemgr_msg .="<br /><a href=\"".DEFAULT_URL."/gerenciamento/account/view.php?id=".$account->getNumber("id")."\" target=\"_blank\">".DEFAULT_URL."/gerenciamento/account/view.php?id=".$account->getNumber("id")."</a><br /><br />
						</div>
					</body>
				</html>";
			if ($sitemgr_send_email == "on") {
				if ($sitemgr_emails[0]) {
					foreach ($sitemgr_emails as $sitemgr_email) {
						//system_mail($sitemgr_email, "[".EDIRECTORY_TITLE."] Account Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_email>", "text/html", '', '', $error);
					}
				}
			}
			if ($sitemgr_account_emails[0]) {
				foreach ($sitemgr_account_emails as $sitemgr_account_email) {
					//system_mail($sitemgr_account_email, "[".EDIRECTORY_TITLE."] Account Notification", $sitemgr_msg, EDIRECTORY_TITLE." <$sitemgr_account_email>", "text/html", '', '', $error);
				}
			}
			////////////////////////////////////////////////////////////////////
			####################################################################################################
			####################################################################################################
			####################################################################################################

		}

		if ($account->getNumber("id")) {
			sess_registerAccountInSession($account->getString("username"));
			return true;
		}

		return false;

	}

?>