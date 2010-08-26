<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /functions/validate_funct.php
	# ----------------------------------------------------------------------------------------------------

	function validate_email($email) {
		//e-mail injection
		if(eregi('\\\r',$email) == true || eregi('\\\n',$email) == true){
			return false;
		}
		$regex = '/.*@.*\..*/';
		if(preg_match($regex, $email) > 0) {
			return true;
		} else {
			return false;
		}
	}

	function validate_emails($emails) {
		if (strpos($emails, ";") !== false) return false;
		$emails = explode(",", $emails);
		foreach ($emails as $email) {
			if (!validate_email($email)) {
				return false;
			}
		}
		return true;
	}

	function validate_date($date) {

		$aux = explode("/", $date);

		if (count($aux) == 3 ) {

			if (is_numeric($aux[0]) && is_numeric($aux[1]) && is_numeric($aux[2])) {

				if (DEFAULT_DATE_FORMAT == "m/d/Y") {
					$month = $aux[0];
					$day   = $aux[1];
					$year  = $aux[2];
				} elseif (DEFAULT_DATE_FORMAT == "d/m/Y") {
					$month = $aux[1];
					$day   = $aux[0];
					$year  = $aux[2];
				}

				if (checkdate((int)$month, (int)$day, (int)$year)) {
					return true;
				}

				return false;

			}

			return false;

		}

		return false;

	}

	function validate_date_future($date) {
		$aux = explode("/", $date);
		if (count($aux) == 3 ) {
			if (is_numeric($aux[0]) && is_numeric($aux[1]) && is_numeric($aux[2])) {
				
				if (DEFAULT_DATE_FORMAT == "m/d/Y") {
					$month = $aux[0];
					$day   = $aux[1];
					$year  = $aux[2];
				} elseif (DEFAULT_DATE_FORMAT == "d/m/Y") {
					$month = $aux[1];
					$day   = $aux[0];
					$year  = $aux[2];
				}
				
				if (!checkdate((int)$month, (int)$day, (int)$year)) {
					return false;
				}
				
				$dateNow  = mktime(0,0,0, date("m"), date("d"), date("Y"));
				$dateTest = mktime(0,0,0, $month, $day, $year);
				
				if ($dateNow > $dateTest) {
					return false;
				}
				
				return true;
			}
		}
		return false;
	}

	function validate_pastDate($date) {

		$aux = explode("/", $date);

		if (count($aux) == 3 ) {

			if (is_numeric($aux[0]) && is_numeric($aux[1]) && is_numeric($aux[2])) {

				if (DEFAULT_DATE_FORMAT == "m/d/Y") {
					$month = $aux[0];
					$day = $aux[1];
					$year = $aux[2];
				} elseif (DEFAULT_DATE_FORMAT == "d/m/Y") {
					$month = $aux[1];
					$day = $aux[0];
					$year = $aux[2];
				}

				if (checkdate((int)$month, (int)$day, (int)$year)) {
					strlen($month)==1?$month="0".$month:$month=$month;
					strlen($day)==1?$day="0".$day:$day=$day;
					if ($year.$month.$day >= date("Ymd")) {
						return true;
					}
					return false;
				}

				return false;

			}

			return false;

		}

		return false;

	}

	function validate_url($url) {
		$space = strpos($url, " ");
		if ($space !== false) {
			return false;
		}
		return true;
	}

	/*
	* @name:   function validate_date_interval
	* @since:  11/26/2004
	* @param:  date $start_date
	* @param:  date $end_date
	* @return: boolean (true/false)
	*
	* This function was made to validate if a begin date is older than a end date.
	* The date delimiter must be a slash.
	* It uses timestamp to compare the dates.
	* The range of valid years includes only 1970 through 2038.
	*/
	function validate_date_interval($start_date,$end_date){

		// no require entry.
		if(!$start_date || !$end_date) return false;

		// separating date into day, month and year.
		if (DEFAULT_DATE_FORMAT == "m/d/Y") {
			list($end_month,$end_day,$end_year)       = split ("/",$end_date);
			list($start_month,$start_day,$start_year) = split ("/",$start_date);
		} elseif (DEFAULT_DATE_FORMAT == "d/m/Y") {
			list($end_day,$end_month,$end_year)       = split ("/",$end_date);
			list($start_day,$start_month,$start_year) = split ("/",$start_date);
		}

		// entry is not a valid date.
		if(!checkdate($end_month,$end_day,$end_year))		return false;
		if(!checkdate($start_month,$start_day,$start_year))	return false;

		// validating today mktime restrictions
		if($start_year < 1970 || $start_day > 31 || $start_month > 12 || $start_year > 2038) return false;
		if($end_year   < 1970 || $end_day   > 31 || $end_month   > 12 || $end_year   > 2038) return false;

		// converting date to timestamp.
		$tm_end_date   = mktime(0, 0, 0, (int)$end_month, (int)$end_day, (int)$end_year); 
		$tm_start_date = mktime(0, 0, 0, (int)$start_month, (int)$start_day, (int)$start_year);

		// comparing the start and end date to validate the interval.
		if($tm_end_date > $tm_start_date) return true; else return false;

	}

	function is_valid_discount_code($discount_id, $item_type, $item_id, &$message, &$error_num) {

		if (!$discount_id) return true;

		$item_type_name = ucwords($item_type);
		$itemObj = new $item_type_name($item_id);

		$discountCodeObj = new DiscountCode($discount_id);

		if ((!$discountCodeObj->getString("id")) || $discountCodeObj->getString("id") == "0") {

			$error_num = 1;
			$message .= "&#149;&nbsp;".system_showText(LANG_MSG_INEXISTENT_DISCOUNT_CODE)." \"<b>".htmlentities($discount_id)."</b>\".";
			return false;

		} else {

			if ($discountCodeObj->getString("status") != "A") {

				$error_num = 2;
				$message .= "&#149;&nbsp;".system_showText(LANG_LABEL_DISCOUNTCODE)." \"<b>".htmlentities($discount_id)."</b>\" ".system_showText(LANG_MSG_IS_NOT_AVAILABLE);
				return false;

			} elseif ($discountCodeObj->getString($item_type) != "on") {

				$error_num = 3;
				$message .= "&#149;&nbsp;".system_showText(LANG_LABEL_DISCOUNTCODE)." \"<b>".htmlentities($discount_id)."</b>\" ".system_showText(LANG_MSG_IS_NOT_AVAILABLE_FOR);
				return false;

			} elseif (($discountCodeObj->getString("recurring") != "yes") && ($itemObj->getString("id") > 0)) {

				$dbObj = db_getDBObject();

				$sql = "SELECT * FROM Payment_".$item_type_name."_Log WHERE discount_id = '".$discountCodeObj->getString("id")."' AND ".$item_type."_id = '".$itemObj->getString("id")."' ORDER BY renewal_date DESC LIMIT 1";
				$result = $dbObj->query($sql);

				if (mysql_num_rows($result) >= 1) {

					$error_num = 4;
					$message .= "&#149;&nbsp;".system_showText(LANG_LABEL_DISCOUNTCODE)." <strong>".htmlentities($discount_id)."</strong> ".system_showText(LANG_MSG_CANNOT_BE_USED_TWICE);
					return false;

				}

				$sql = "SELECT * FROM Invoice_".$item_type_name." WHERE discount_id = '".$discountCodeObj->getString("id")."' AND ".$item_type."_id = '".$itemObj->getString("id")."' ORDER BY renewal_date DESC LIMIT 1";
				$result = $dbObj->query($sql);

				if (mysql_num_rows($result) >= 1) {

					$error_num = 4;
					$message .= "&#149;&nbsp;".system_showText(LANG_LABEL_DISCOUNTCODE)." <strong>".htmlentities($discount_id)."</strong> ".system_showText(LANG_MSG_CANNOT_BE_USED_TWICE);
					return false;

				}

			}

		}

		return true;

	}

	function validate_form($form, $array, &$error) {

		extract($array);

		if ($form == "gallery") {
			if (!$title) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_TITLE_IS_REQUIRED);
		}

		elseif ($form == "item_gallery") {
			if ($item_type == "listing") {
				if (count($gallery_ids) > LISTING_MAX_GALLERY) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_YOU_CAN_SELECT_ITEM_GALLERY_UP)." ".LISTING_MAX_GALLERY." ".(LISTING_MAX_GALLERY == 1 ? system_showText(LANG_MSG_YOU_CAN_SELECT_ITEM_GALLERY) : system_showText(LANG_MSG_YOU_CAN_SELECT_ITEM_GALLERIES));
			} elseif ($item_type == "event") {
				if (count($gallery_ids) > EVENT_MAX_GALLERY) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_YOU_CAN_SELECT_ITEM_GALLERY_UP)." ".EVENT_MAX_GALLERY." ".(EVENT_MAX_GALLERY == 1 ? system_showText(LANG_MSG_YOU_CAN_SELECT_ITEM_GALLERY) : system_showText(LANG_MSG_YOU_CAN_SELECT_ITEM_GALLERIES));
			} elseif ($item_type == "classified") {
				if (count($gallery_ids) > CLASSIFIED_MAX_GALLERY) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_YOU_CAN_SELECT_ITEM_GALLERY_UP)." ".CLASSIFIED_MAX_GALLERY." ".(CLASSIFIED_MAX_GALLERY == 1 ? system_showText(LANG_MSG_YOU_CAN_SELECT_ITEM_GALLERY) : system_showText(LANG_MSG_YOU_CAN_SELECT_ITEM_GALLERIES));
			} elseif ($item_type == "article") {
				if (count($gallery_ids) > ARTICLE_MAX_GALLERY) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_YOU_CAN_SELECT_ITEM_GALLERY_UP)." ".ARTICLE_MAX_GALLERY." ".(ARTICLE_MAX_GALLERY == 1 ? system_showText(LANG_MSG_YOU_CAN_SELECT_ITEM_GALLERY) : system_showText(LANG_MSG_YOU_CAN_SELECT_ITEM_GALLERIES));
			}
		}

		elseif ($form == "discountcodesettings") {
			if (!$status)								$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_STATUSISREQUIRED)."";
			if (strtolower($status) == "e")				$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_STATUSCANNOTUSEDTOEXPIRE)."";
			if (!validate_date($expire_date))			$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_EXPIRATIONDATEFORMATISREQUIRED1)." \"".format_printDateStandard()."\" ".system_showText(LANG_SITEMGR_MSGERROR_EXPIRATIONDATEFORMATISREQUIRED2)."";
			elseif (!validate_pastDate($expire_date))	$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_EXPIRATIONMUSTBEINFUTURE)."";
		}

		elseif ($form == "discountcode") {
			if (!$id)									$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_CODEISREQUIRED)."";
			if (!ereg("^([0-9a-zA-Z_]{1,10})$", $id))	$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_CODENEEDSTOBEANALPHANUMERIC)."";
			if (!$type)									$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_TYPEISREQUIRED)."";
			if (!$amount || !is_numeric($amount))		$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_AMOUNTMUSTBEANUMERICVALUE)."";
			if ($type == "percentage" && $amount > 100)	$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_AMOUNTCANNNOTBE100PERCENT)."";
			if ($amount <= 0)							$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_AMOUNTMUSTBEGREATERTHAN)."";
			if (!$recurring)							$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_RECURRINGISREQUIRED)."";
			if (!validate_date($expire_date))			$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_EXPIRATIONDATEFORMATISREQUIRED1)." \"".format_printDateStandard()."\" ".system_showText(LANG_SITEMGR_MSGERROR_EXPIRATIONDATEFORMATISREQUIRED2)."";
			elseif (!validate_pastDate($expire_date))	$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_EXPIRATIONMUSTBEINFUTURE)."";
		}

		elseif ($form == "contact") {
			if (!$first_name) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_FIRST_NAME_IS_REQUIRED);
			if (!$last_name)  $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_LAST_NAME_IS_REQUIRED);
			if (!$email)      $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_EMAIL_IS_REQUIRED);
		}

		elseif ($form == "listing") {

			if ((!$signup) && (!$sitemgr)) $elems[] = array('name'=>'account_id', 'label'=>system_showText(LANG_LABEL_ACCOUNT), 'type'=>'text', 'required'=>true, 'cont'=>'digit' );

			$ctr_url = ($_POST["display_url"]) ? true : false;

			if (!$signup) {
				if ($_POST["listingtemplate_id"]) {
					$listingTemplateObj = new ListingTemplate($_POST["listingtemplate_id"]);
					$templateFields = $listingTemplateObj->getListingTemplateFields();
					if ($templateFields) {
						foreach ($templateFields as $each_field) {
							if ($each_field["required"]=="y") {
								$elems[] = array('name'=>$each_field["field"], 'label'=>$each_field["label"], 'type'=>'text', 'required'=>true, 'len_max'=>'65535');
							}
						}
					}
				}
			}

			$elems[] = array('name'=>'title',             'label'=>system_showText(LANG_LABEL_NAME_OR_TITLE),       'type'=>'text',   'required'=>true,     'len_max'=>'100'                   );
			$elems[] = array('name'=>'friendly_url',      'label'=>system_showText(LANG_LABEL_PAGE_NAME),           'type'=>'text',   'required'=>true,     'len_max'=>'255'                   );
			$elems[] = array('name'=>'description',       'label'=>system_showText(LANG_LABEL_SUMMARY_DESCRIPTION), 'type'=>'text',   'required'=>false,    'len_max'=>'255'                   );
			$elems[] = array('name'=>'return_categories', 'label'=>system_showText(LANG_LABEL_CATEGORY_PLURAL),     'type'=>'text',   'required'=>true,                                        );
			$elems[] = array('name'=>'estado_id',        'label'=>system_showText(LANG_LABEL_COUNTRY),             'type'=>'select', 'required'=>false,                       'cont'=>'digit' );
			$elems[] = array('name'=>'cidade_id',          'label'=>system_showText(LANG_LABEL_STATE),               'type'=>'select', 'required'=>false,                       'cont'=>'digit' );
			$elems[] = array('name'=>'renewal_date',      'label'=>system_showText(LANG_LABEL_RENEWAL_DATE),        'type'=>'text',   'required'=>false,    'len_max'=>'10',    'cont'=>'date' );
			$elems[] = array('name'=>'address',           'label'=>system_showText(LANG_LABEL_STREET_ADDRESS),      'type'=>'text',   'required'=>false,    'len_max'=>'255'                   );
			$elems[] = array('name'=>'url',               'label'=>system_showText(LANG_LABEL_WEB_ADDRESS),         'type'=>'text',   'required'=>$crt_url, 'len_max'=>'255'                   );
			$elems[] = array('name'=>'phone',             'label'=>system_showText(LANG_LABEL_PHONE),               'type'=>'text',   'required'=>false,    'len_max'=>'255'                   );
			$elems[] = array('name'=>'fax',               'label'=>system_showText(LANG_LABEL_FAX),                 'type'=>'text',   'required'=>false,    'len_max'=>'255'                   );
			$elems[] = array('name'=>'long_description',  'label'=>system_showText(LANG_LABEL_LONG_DESCRIPTION),    'type'=>'text',   'required'=>false,    'len_max'=>'65535'                 );
			$elems[] = array('name'=>'status',            'label'=>system_showText(LANG_LABEL_STATUS),              'type'=>'text',   'required'=>false,    'len_max'=>'1'                     );
			$elems[] = array('name'=>'level',             'label'=>system_showText(LANG_LABEL_LEVEL),               'type'=>'select', 'required'=>false,    'len_max'=>'2',    'cont'=>'digit' );

			$f = new FormValidator($elems);
			$err = $f->validate($_POST);

			if ($err) {
				$errors[] = "<b>".system_showText(LANG_MSG_FIELDS_CONTAIN_ERRORS)."</b>";
				$valid = $f->getValidElems();
				foreach ($valid as $field_title => $field_array) {
					foreach ($field_array as $field) if (!$field['validation']) $errors[] = "&#149;&nbsp;".$field['label'];
				}
			}

			$return_categories_array = explode(",", $return_categories);
			$return_categories_array = array_unique($return_categories_array);
			if(count($return_categories_array) > MAX_CATEGORY_ALLOWED) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_MAX_OF_CATEGORIES_1)." ".MAX_CATEGORY_ALLOWED." ".system_showText(LANG_MSG_MAX_OF_CATEGORIES_2);

			if (ZIPCODE_PROXIMITY == "on") {
				if ($zip_code) {
					if (!zipproximity_validate($zip_code)) { /*$errors[] = "&#149;&nbsp;Invalid ".ucwords(ZIPCODE_LABEL)."!";*/ }
				}
			}

			if ($friendly_url) {
				$dbObj = db_getDBObject();
				$sql = "SELECT friendly_url FROM Listing WHERE friendly_url = ".db_formatString($friendly_url)."";
				if($id) $sql .= " AND id != $id ";
				$sql .= " LIMIT 1";
				$rs = $dbObj->query($sql);
				if(mysql_num_rows($rs) > 0) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_FRIENDLY_URL_IN_USE);
				if(!ereg(FRIENDLYURL_REGULAREXPRESSION, $friendly_url)) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_PAGE_NAME_INVALID_CHARS);
			}

			$array_edir_languagenames = explode(",", EDIR_LANGUAGENAMES);
			for ($i=0; $i<count(explode(",", EDIR_LANGUAGES)); $i++) {
				$labelsuffix = "";
				if ($i) $labelsuffix = $i;
				if (${"array_keywords".$labelsuffix}) {
					if (count(${"array_keywords".$labelsuffix}) > MAX_KEYWORDS) {
						$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_1)." ".MAX_KEYWORDS." ".system_showText(LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_2)." (".$array_edir_languagenames[$i].")";
					}
					$kwlarge = false;
					foreach (${"array_keywords".$labelsuffix} as $kw) {
						if (strlen($kw) > 50) {
							$kwlarge = true;
						}
					}
					if ($kwlarge) {
						$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_PLEASE_INCLUDE_KEYWORDS)." (".$array_edir_languagenames[$i].")";
					}
				}
			}

		}

		elseif ($form == "classified") {

			if ((!$signup) && (!$sitemgr)) if (!$account_id) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_ACCOUNT_IS_REQUIRED);

			if (!$title) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_TITLE_IS_REQUIRED);
			if (!$friendly_url) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_PAGE_NAME_IS_REQUIRED);

			if (ZIPCODE_PROXIMITY == "on") {
				if ($zip_code) {
					if (!zipproximity_validate($zip_code)) { /*$errors[] = "&#149;&nbsp;Invalid ".ucwords(ZIPCODE_LABEL)."!";*/ }
				}
			}

			if ($friendly_url) {
				$dbObj = db_getDBObject();
				$sql = "SELECT friendly_url FROM Classified WHERE friendly_url = ".db_formatString($friendly_url)."";
				if($id) $sql .= " AND id != $id ";
				$sql .= " LIMIT 1";
				$rs = $dbObj->query($sql);
				if(mysql_num_rows($rs) > 0) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_FRIENDLY_URL_IN_USE);
				if(!ereg(FRIENDLYURL_REGULAREXPRESSION, $friendly_url)) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_PAGE_NAME_INVALID_CHARS);
			}

			if (!$cat_1_id) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_CATEGORY_IS_REQUIRED);

			$array_edir_languagenames = explode(",", EDIR_LANGUAGENAMES);
			for ($i=0; $i<count(explode(",", EDIR_LANGUAGES)); $i++) {
				$labelsuffix = "";
				if ($i) $labelsuffix = $i;
				if (${"array_keywords".$labelsuffix}) {
					if (count(${"array_keywords".$labelsuffix}) > MAX_KEYWORDS) {
						$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_1)." ".MAX_KEYWORDS." ".system_showText(LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_2)." (".$array_edir_languagenames[$i].")";
					}
					$kwlarge = false;
					foreach (${"array_keywords".$labelsuffix} as $kw) {
						if (strlen($kw) > 50) {
							$kwlarge = true;
						}
					}
					if ($kwlarge) {
						$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_PLEASE_INCLUDE_KEYWORDS)." (".$array_edir_languagenames[$i].")";
					}
				}
			}

		}

		elseif ($form == "article") {

			if ((!$signup) && (!$sitemgr)) if (!$account_id) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_ACCOUNT_IS_REQUIRED);

			if (!$title) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_TITLE_IS_REQUIRED);
			if (!$friendly_url) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_PAGE_NAME_IS_REQUIRED);

			if ($publication_date && !validate_date($publication_date)) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_ENTER_VALID_PUBLICATION_DATE);

			if (!$signup) if (!$abstract) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_ABSTRACT_IS_REQUIRED);

			if ($friendly_url) {
				$dbObj = db_getDBObject();
				$sql = "SELECT friendly_url FROM Article WHERE friendly_url = ".db_formatString($friendly_url)."";
				if($id) $sql .= " AND id != $id ";
				$sql .= " LIMIT 1";
				$rs = $dbObj->query($sql);
				if(mysql_num_rows($rs) > 0) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_FRIENDLY_URL_IN_USE);
				if(!ereg(FRIENDLYURL_REGULAREXPRESSION, $friendly_url)) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_PAGE_NAME_INVALID_CHARS);
			}

			$return_categories_array = explode(",", $return_categories);
			$return_categories_array = array_unique($return_categories_array);
			if(count($return_categories_array) > MAX_CATEGORY_ALLOWED) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_MAX_OF_CATEGORIES_1)." ".MAX_CATEGORY_ALLOWED." ".system_showText(LANG_MSG_MAX_OF_CATEGORIES_2);

			$array_edir_languagenames = explode(",", EDIR_LANGUAGENAMES);
			for ($i=0; $i<count(explode(",", EDIR_LANGUAGES)); $i++) {
				$labelsuffix = "";
				if ($i) $labelsuffix = $i;
				if (${"array_keywords".$labelsuffix}) {
					if (count(${"array_keywords".$labelsuffix}) > MAX_KEYWORDS) {
						$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_1)." ".MAX_KEYWORDS." ".system_showText(LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_2)." (".$array_edir_languagenames[$i].")";
					}
					$kwlarge = false;
					foreach (${"array_keywords".$labelsuffix} as $kw) {
						if (strlen($kw) > 50) {
							$kwlarge = true;
						}
					}
					if ($kwlarge) {
						$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_PLEASE_INCLUDE_KEYWORDS)." (".$array_edir_languagenames[$i].")";
					}
				}
			}

		}

		else if ($form == "listingsettings") {

			if ($hasrenewaldate != "no") if (!$renewal_date) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_RENEWALDATEISREQUIRED)."";

			if (!$status) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_STATUSISREQUIRED)."";
			if ($status == 'E') $errors[] = "&#149;&nbsp;".ucwords(system_showText(LANG_SITEMGR_LISTING))." ".system_showText(LANG_SITEMGR_MSGERROR_CANNOTBEEXPIRED)."";

			if ($add_transaction == "1"){
				if(!$account_id) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_ACCOUNTISREQUIRED)."";
				if (!$amount) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_AMOUNTISREQUIRED)."";
				elseif ($amount <= 0) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_AMOUNTMORETHANZERO)."";
			}

		}

		else if ($form == "eventsettings") {

			if ($hasrenewaldate != "no") if (!$renewal_date) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_RENEWALDATEISREQUIRED)."";

			if (!$status) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_STATUSISREQUIRED)."";
			if ($status == 'E') $errors[] = "&#149;&nbsp;".ucwords(system_showText(LANG_SITEMGR_EVENT))." ".system_showText(LANG_SITEMGR_MSGERROR_CANNOTBEEXPIRED)."";

			if ($add_transaction == "1"){
				if(!$account_id) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_ACCOUNTISREQUIRED)."";
				if (!$amount) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_AMOUNTISREQUIRED)."";
				elseif ($amount <= 0) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_AMOUNTMORETHANZERO)."";
			}

		}

		else if ($form == "classifiedsettings") {

			if ($hasrenewaldate != "no") if (!$renewal_date) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_RENEWALDATEISREQUIRED)."";

			if (!$status) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_STATUSISREQUIRED)."";
			if ($status == 'E') $errors[] = "&#149;&nbsp;".ucwords(system_showText(LANG_SITEMGR_CLASSIFIED))." ".system_showText(LANG_SITEMGR_MSGERROR_CANNOTBEEXPIRED)."";

			if ($add_transaction == "1"){
				if(!$account_id) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_ACCOUNTISREQUIRED)."";
				if (!$amount) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_AMOUNTISREQUIRED)."";
				elseif ($amount <= 0) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_AMOUNTMORETHANZERO)."";
			}

		}

		else if ($form == "articlesettings") {

			if ($hasrenewaldate != "no") if (!$renewal_date) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_RENEWALDATEISREQUIRED)."";

			if (!$status) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_STATUSISREQUIRED)."";
			if ($status == 'E') $errors[] = "&#149;&nbsp;".ucwords(system_showText(LANG_SITEMGR_ARTICLE))." ".system_showText(LANG_SITEMGR_MSGERROR_CANNOTBEEXPIRED)."";

			if ($add_transaction == "1"){
				if(!$account_id) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_ACCOUNTISREQUIRED)."";
				if (!$amount) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_AMOUNTISREQUIRED)."";
				elseif ($amount <= 0) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_AMOUNTMORETHANZERO)."";
			}

		}

		else if ($form == "bannersettings") {

			if (!$expiration_setting) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_EXPIRATIONTYPEISREQUIRED)."";

			if ($hasrenewaldate != "no") if ($expiration_setting == BANNER_EXPIRATION_RENEWAL_DATE && !$renewal_date) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_RENEWALDATEISREQUIRED)."";

			if ($hasimpressions != "no") if ($expiration_setting == BANNER_EXPIRATION_IMPRESSION && (!$impressions || $impressions ==0)) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_IMPRESSIONSAREREQUIRED)."";

			if (!$status) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_STATUSISREQUIRED)."";
			if ($status == 'E') $errors[] = "&#149;&nbsp;".ucwords(system_showText(LANG_SITEMGR_BANNER))." ".system_showText(LANG_SITEMGR_MSGERROR_CANNOTBEEXPIRED)."";

			if ($add_transaction == "1"){
				if(!$account_id) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_ACCOUNTISREQUIRED)."";
				if (!$amount) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_AMOUNTISREQUIRED)."";
				elseif ($amount <= 0) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_AMOUNTMORETHANZERO)."";
			}

		}

		elseif ($form == "listingseocenter") {

			if (!$friendly_url) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_PAGE_NAME_IS_REQUIRED);

			if ($friendly_url) {
				$dbObj = db_getDBObject();
				$sql = "SELECT friendly_url FROM Listing WHERE friendly_url = ".db_formatString($friendly_url)."";
				if ($id) $sql .= " AND id != $id ";
				$sql .= " LIMIT 1";
				$rs = $dbObj->query($sql);
				if (mysql_num_rows($rs) > 0) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_FRIENDLY_URL_IN_USE);
				if (!ereg(FRIENDLYURL_REGULAREXPRESSION, $friendly_url)) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_PAGE_NAME_INVALID_CHARS);
			}

		}

		elseif ($form == "promotionseocenter") {

			

		}

		elseif ($form == "eventseocenter") {

			if (!$friendly_url) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_PAGE_NAME_IS_REQUIRED);

			if ($friendly_url) {
				$dbObj = db_getDBObject();
				$sql = "SELECT friendly_url FROM Event WHERE friendly_url = ".db_formatString($friendly_url)."";
				if ($id) $sql .= " AND id != $id ";
				$sql .= " LIMIT 1";
				$rs = $dbObj->query($sql);
				if (mysql_num_rows($rs) > 0) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_FRIENDLY_URL_IN_USE);
				if (!ereg(FRIENDLYURL_REGULAREXPRESSION, $friendly_url)) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_PAGE_NAME_INVALID_CHARS);
			}

		}

		elseif ($form == "classifiedseocenter") {

			if (!$friendly_url) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_PAGE_NAME_IS_REQUIRED);

			if ($friendly_url) {
				$dbObj = db_getDBObject();
				$sql = "SELECT friendly_url FROM Classified WHERE friendly_url = ".db_formatString($friendly_url)."";
				if ($id) $sql .= " AND id != $id ";
				$sql .= " LIMIT 1";
				$rs = $dbObj->query($sql);
				if (mysql_num_rows($rs) > 0) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_FRIENDLY_URL_IN_USE);
				if (!ereg(FRIENDLYURL_REGULAREXPRESSION, $friendly_url)) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_PAGE_NAME_INVALID_CHARS);
			}

		}

		elseif ($form == "articleseocenter") {

			if (!$friendly_url) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_PAGE_NAME_IS_REQUIRED);

			if ($friendly_url) {
				$dbObj = db_getDBObject();
				$sql = "SELECT friendly_url FROM Article WHERE friendly_url = ".db_formatString($friendly_url)."";
				if ($id) $sql .= " AND id != $id ";
				$sql .= " LIMIT 1";
				$rs = $dbObj->query($sql);
				if (mysql_num_rows($rs) > 0) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_FRIENDLY_URL_IN_USE);
				if (!ereg(FRIENDLYURL_REGULAREXPRESSION, $friendly_url)) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_PAGE_NAME_INVALID_CHARS);
			}

		}

		else if ($form == "banner") {

			if ((!$signup) && (!$sitemgr)) if (!$account_id) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_ACCOUNT_IS_REQUIRED);

			if (!$expiration_setting) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_EXPIRATION_TYPE_IS_REQUIRED);

			if (!$signup) if ($sitemgr) {
				if ($expiration_setting == BANNER_EXPIRATION_RENEWAL_DATE && !$renewal_date) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_RENEWAL_DATE_IS_REQUIRED);
			}

			if ($expiration_setting == BANNER_EXPIRATION_IMPRESSION && (!$unpaid_impressions || $unpaid_impressions == 0) && !$id && !strpos($_SERVER["PHP_SELF"], "sitemgr")) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_IMPRESSIONS_ARE_REQUIRED);
			if ($expiration_setting == BANNER_EXPIRATION_IMPRESSION && (!$impressions || $impressions == 0) && !$id && strpos($_SERVER["PHP_SELF"], "sitemgr")) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_IMPRESSIONS_ARE_REQUIRED);

			if (!$signup && $show_type!=1) {
				if (!$file && $type < 50 && !$id) {
					$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_FILE_IS_REQUIRED);
				} elseif (!$file && $type < 50 && $id) { // required because of the different type approachs (image banner and text banner)
					$bannerObj = new Banner($id);
					if(!$bannerObj->getNumber("image_id")) { $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_FILE_IS_REQUIRED); }
					unset($bannerObj);
				}
			}

			if (!$type && !$id) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_TYPE_IS_REQUIRED);

			if (!$caption) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_CAPTION_IS_REQUIRED);

			if($show_type==1 && !$signup) {
				if (!$script) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_SCRIPT_CODE_IS_REQUIRED);
			} elseif (!$signup) {
				if (!$content_line1 && $type >= 50)	$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_DESCRIPTION1_IS_REQUIRED);
				if (!$content_line2 && $type >= 50)	$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_DESCRIPTION2_IS_REQUIRED);
			}

		}

		else if ($form == "invoicesettings") {
			if ($status == 'E') $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_INVOICE)." ".system_showText(LANG_SITEMGR_MSGERROR_CANNOTBEEXPIRED)."";
		}

		else if ($form == "adminemail") {

			if ($sitemgr_email) {
				if (!validate_emails($sitemgr_email)) {
					$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDGENERALEMAILADDRESS);
				}
			} else {
				$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_GENERALEMAILREQUIRED);
			}

			if ($sitemgr_listing_email) {
				if (!validate_emails($sitemgr_listing_email)) {
					$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS1).system_showText(LANG_SITEMGR_LISTING).system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS2);
				}
			 }

			if ($sitemgr_event_email) {
				if (!validate_emails($sitemgr_event_email)) {
					$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS1).system_showText(LANG_SITEMGR_EVENT).system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS2);
				}
			}

			if ($sitemgr_banner_email) {
				if (!validate_emails($sitemgr_banner_email)) {
					$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS1).system_showText(LANG_SITEMGR_BANNER).system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS2);
				}
			}

			if ($sitemgr_classified_email) {
				if (!validate_emails($sitemgr_classified_email)) {
					$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS1).system_showText(LANG_SITEMGR_CLASSIFIED).system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS2);
				}
			}

			if ($sitemgr_article_email) {
				if (!validate_emails($sitemgr_article_email)) {
					$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS1).system_showText(LANG_SITEMGR_ARTICLE).system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS2);
				}
			}

			if ($sitemgr_account_email) {
				if (!validate_emails($sitemgr_account_email)) {
					$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS1).strtolower(system_showText(LANG_SITEMGR_LABEL_ACCOUNT)).system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS2);
				}
			}

			if ($sitemgr_contactus_email) {
				if (!validate_emails($sitemgr_contactus_email)) {
					$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS1).strtolower(system_showText(LANG_SITEMGR_CONTACT)).system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS2);
				}
			}

			if ($sitemgr_support_email) {
				if (!validate_emails($sitemgr_support_email)) {
					$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS1).system_showText(LANG_SITEMGR_SUPPORT).system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS2);
				}
			}

			if ($sitemgr_payment_email) {
				if (!validate_emails($sitemgr_payment_email)) {
					$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS1).system_showText(LANG_SITEMGR_PAYMENT).system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS2);
				}
			}

			if ($sitemgr_rate_email) {
				if (!validate_emails($sitemgr_rate_email)) {
					$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS1).system_showText(LANG_SITEMGR_RATE).system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDSPECIFICEMAILADDRESS2);
				}
			}

		}

		else if ($form == "gallery") {
			if (!$name) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_NAME_IS_REQUIRED);
		}

		else if ($form == "listingcategory") {

			$dbObj = db_getDBObject();

			if (!$title) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_TITLEISREQUIRED);
			if (!$friendly_url) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_FRIENDLYTITLEISREQUIRED);

			if ($title) {
				$sql = "SELECT title FROM ListingCategory WHERE title = ".db_formatString(trim($title))."";
				$sql .= ($category_id) ? " AND category_id = $category_id " : " AND category_id = 0 ";
				if ($id) $sql .= " AND id != $id ";
				$sql .= " LIMIT 1";
				$rs = $dbObj->query($sql);
				if (mysql_num_rows($rs) > 0) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_TITLEALREADYINUSE);
			}

			if ($friendly_url) {
				$sql = "SELECT friendly_url FROM ListingCategory WHERE friendly_url = ".db_formatString(trim($friendly_url))."";
				$sql .= ($category_id) ? " AND category_id = $category_id " : " AND category_id = 0 ";
				if ($id) $sql .= " AND id != $id ";
				$sql .= " LIMIT 1";
				$rs = $dbObj->query($sql);
				if (mysql_num_rows($rs) > 0) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_FRIENDLYURLPAGENAMEALREADYINUSE);
				if (!ereg(FRIENDLYURL_REGULAREXPRESSION, trim($friendly_url))) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_FRIENDLYURLCONTAININVALIDCHARS);
			}

			$array_edir_languages = explode(",", EDIR_LANGUAGES);
			$array_edir_languagenames = explode(",", EDIR_LANGUAGENAMES);
			if ($lang) $array_lang = explode(",", $lang);
			for ($i=1; $i<count(explode(",", EDIR_LANGUAGES)); $i++) {
				if ($array_lang) {
					if (in_array($array_edir_languages[$i], $array_lang)) {
						if (!${"title".$i}) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_LANG_TITLEISREQUIRED1)." (".$array_edir_languagenames[$i].") ".system_showText(LANG_SITEMGR_MSGERROR_LANG_TITLEISREQUIRED2)."";
						if (!${"friendly_url".$i}) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_LANG_FRIENDLYTITLEISREQUIRED1)." (".$array_edir_languagenames[$i].") ".system_showText(LANG_SITEMGR_MSGERROR_LANG_FRIENDLYTITLEISREQUIRED2)."";
					}
				}
				if (${"title".$i}) {
					$sql = "SELECT title".$i." FROM ListingCategory WHERE title".$i." = ".db_formatString(trim(${"title".$i}))."";
					$sql .= ($category_id) ? " AND category_id = $category_id " : " AND category_id = 0 ";
					if ($id) $sql .= " AND id != $id ";
					$sql .= " LIMIT 1";
					$rs = $dbObj->query($sql);
					if (mysql_num_rows($rs) > 0) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_LANG_TITLEALREADYINUSE1)." (".$array_edir_languagenames[$i].") ".system_showText(LANG_SITEMGR_MSGERROR_LANG_TITLEALREADYINUSE2)."";
				}
				if (${"friendly_url".$i}) {
					$sql = "SELECT friendly_url".$i." FROM ListingCategory WHERE friendly_url".$i." = ".db_formatString(trim(${"friendly_url".$i}))."";
					$sql .= ($category_id) ? " AND category_id = $category_id " : " AND category_id = 0 ";
					if ($id) $sql .= " AND id != $id ";
					$sql .= " LIMIT 1";
					$rs = $dbObj->query($sql);
					if (mysql_num_rows($rs) > 0) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_LANG_FRIENDLYURLPAGENAMEALREADYINUSE1)." (".$array_edir_languagenames[$i].") ".system_showText(LANG_SITEMGR_MSGERROR_LANG_FRIENDLYURLPAGENAMEALREADYINUSE2)."";
					if (!ereg(FRIENDLYURL_REGULAREXPRESSION, trim(${"friendly_url".$i}))) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_LANG_FRIENDLYURLCONTAININVALIDCHARS1)." (".$array_edir_languagenames[$i].") ".system_showText(LANG_SITEMGR_MSGERROR_LANG_FRIENDLYURLCONTAININVALIDCHARS2)."";
				}
			}

		}

		else if ($form == "eventcategory") {

			$dbObj = db_getDBObject();

			if (!$title) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_TITLEISREQUIRED);
			if (!$friendly_url) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_FRIENDLYTITLEISREQUIRED);

			if ($title) {
				$sql = "SELECT title FROM EventCategory WHERE title = ".db_formatString(trim($title))."";
				$sql .= ($category_id) ? " AND category_id = $category_id " : " AND category_id = 0 ";
				if ($id) $sql .= " AND id != $id ";
				$sql .= " LIMIT 1";
				$rs = $dbObj->query($sql);
				if (mysql_num_rows($rs) > 0) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_TITLEALREADYINUSE);
			}

			if ($friendly_url) {
				$sql = "SELECT friendly_url FROM EventCategory WHERE friendly_url = ".db_formatString(trim($friendly_url))."";
				$sql .= ($category_id) ? " AND category_id = $category_id " : " AND category_id = 0 ";
				if ($id) $sql .= " AND id != $id ";
				$sql .= " LIMIT 1";
				$rs = $dbObj->query($sql);
				if (mysql_num_rows($rs) > 0) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_FRIENDLYURLPAGENAMEALREADYINUSE);
				if (!ereg(FRIENDLYURL_REGULAREXPRESSION, trim($friendly_url))) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_FRIENDLYURLCONTAININVALIDCHARS);
			}

			$array_edir_languages = explode(",", EDIR_LANGUAGES);
			$array_edir_languagenames = explode(",", EDIR_LANGUAGENAMES);
			if ($lang) $array_lang = explode(",", $lang);
			for ($i=1; $i<count(explode(",", EDIR_LANGUAGES)); $i++) {
				if ($array_lang) {
					if (in_array($array_edir_languages[$i], $array_lang)) {
						if (!${"title".$i}) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_LANG_TITLEISREQUIRED1)." (".$array_edir_languagenames[$i].") ".system_showText(LANG_SITEMGR_MSGERROR_LANG_TITLEISREQUIRED2)."";
						if (!${"friendly_url".$i}) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_LANG_FRIENDLYTITLEISREQUIRED1)." (".$array_edir_languagenames[$i].") ".system_showText(LANG_SITEMGR_MSGERROR_LANG_FRIENDLYTITLEISREQUIRED2)."";
					}
				}
				if (${"title".$i}) {
					$sql = "SELECT title".$i." FROM EventCategory WHERE title".$i." = ".db_formatString(trim(${"title".$i}))."";
					$sql .= ($category_id) ? " AND category_id = $category_id " : " AND category_id = 0 ";
					if ($id) $sql .= " AND id != $id ";
					$sql .= " LIMIT 1";
					$rs = $dbObj->query($sql);
					if (mysql_num_rows($rs) > 0) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_LANG_TITLEALREADYINUSE1)." (".$array_edir_languagenames[$i].") ".system_showText(LANG_SITEMGR_MSGERROR_LANG_TITLEALREADYINUSE2)."";
				}
				if (${"friendly_url".$i}) {
					$sql = "SELECT friendly_url".$i." FROM EventCategory WHERE friendly_url".$i." = ".db_formatString(trim(${"friendly_url".$i}))."";
					$sql .= ($category_id) ? " AND category_id = $category_id " : " AND category_id = 0 ";
					if ($id) $sql .= " AND id != $id ";
					$sql .= " LIMIT 1";
					$rs = $dbObj->query($sql);
					if (mysql_num_rows($rs) > 0) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_LANG_FRIENDLYURLPAGENAMEALREADYINUSE1)." (".$array_edir_languagenames[$i].") ".system_showText(LANG_SITEMGR_MSGERROR_LANG_FRIENDLYURLPAGENAMEALREADYINUSE2)."";
					if (!ereg(FRIENDLYURL_REGULAREXPRESSION, trim(${"friendly_url".$i}))) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_LANG_FRIENDLYURLCONTAININVALIDCHARS1)." (".$array_edir_languagenames[$i].") ".system_showText(LANG_SITEMGR_MSGERROR_LANG_FRIENDLYURLCONTAININVALIDCHARS2)."";
				}
			}

		}

		else if ($form == "classifiedcategory") {

			$dbObj = db_getDBObject();

			if (!$title) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_TITLEISREQUIRED);
			if (!$friendly_url) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_FRIENDLYTITLEISREQUIRED);

			if ($title) {
				$sql = "SELECT title FROM ClassifiedCategory WHERE title = ".db_formatString(trim($title))."";
				$sql .= ($category_id) ? " AND category_id = $category_id " : " AND category_id = 0 ";
				if ($id) $sql .= " AND id != $id ";
				$sql .= " LIMIT 1";
				$rs = $dbObj->query($sql);
				if (mysql_num_rows($rs) > 0) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_TITLEALREADYINUSE);
			}

			if ($friendly_url) {
				$sql = "SELECT friendly_url FROM ClassifiedCategory WHERE friendly_url = ".db_formatString(trim($friendly_url))."";
				$sql .= ($category_id) ? " AND category_id = $category_id " : " AND category_id = 0 ";
				if ($id) $sql .= " AND id != $id ";
				$sql .= " LIMIT 1";
				$rs = $dbObj->query($sql);
				if (mysql_num_rows($rs) > 0) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_FRIENDLYURLPAGENAMEALREADYINUSE);
				if (!ereg(FRIENDLYURL_REGULAREXPRESSION, trim($friendly_url))) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_FRIENDLYURLCONTAININVALIDCHARS);
			}

			$array_edir_languages = explode(",", EDIR_LANGUAGES);
			$array_edir_languagenames = explode(",", EDIR_LANGUAGENAMES);
			if ($lang) $array_lang = explode(",", $lang);
			for ($i=1; $i<count(explode(",", EDIR_LANGUAGES)); $i++) {
				if ($array_lang) {
					if (in_array($array_edir_languages[$i], $array_lang)) {
						if (!${"title".$i}) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_LANG_TITLEISREQUIRED1)." (".$array_edir_languagenames[$i].") ".system_showText(LANG_SITEMGR_MSGERROR_LANG_TITLEISREQUIRED2)."";
						if (!${"friendly_url".$i}) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_LANG_FRIENDLYTITLEISREQUIRED1)." (".$array_edir_languagenames[$i].") ".system_showText(LANG_SITEMGR_MSGERROR_LANG_FRIENDLYTITLEISREQUIRED2)."";
					}
				}
				if (${"title".$i}) {
					$sql = "SELECT title".$i." FROM ClassifiedCategory WHERE title".$i." = ".db_formatString(trim(${"title".$i}))."";
					$sql .= ($category_id) ? " AND category_id = $category_id " : " AND category_id = 0 ";
					if ($id) $sql .= " AND id != $id ";
					$sql .= " LIMIT 1";
					$rs = $dbObj->query($sql);
					if (mysql_num_rows($rs) > 0) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_LANG_TITLEALREADYINUSE1)." (".$array_edir_languagenames[$i].") ".system_showText(LANG_SITEMGR_MSGERROR_LANG_TITLEALREADYINUSE2)."";
				}
				if (${"friendly_url".$i}) {
					$sql = "SELECT friendly_url".$i." FROM ClassifiedCategory WHERE friendly_url".$i." = ".db_formatString(trim(${"friendly_url".$i}))."";
					$sql .= ($category_id) ? " AND category_id = $category_id " : " AND category_id = 0 ";
					if ($id) $sql .= " AND id != $id ";
					$sql .= " LIMIT 1";
					$rs = $dbObj->query($sql);
					if (mysql_num_rows($rs) > 0) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_LANG_FRIENDLYURLPAGENAMEALREADYINUSE1)." (".$array_edir_languagenames[$i].") ".system_showText(LANG_SITEMGR_MSGERROR_LANG_FRIENDLYURLPAGENAMEALREADYINUSE2)."";
					if (!ereg(FRIENDLYURL_REGULAREXPRESSION, trim(${"friendly_url".$i}))) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_LANG_FRIENDLYURLCONTAININVALIDCHARS1)." (".$array_edir_languagenames[$i].") ".system_showText(LANG_SITEMGR_MSGERROR_LANG_FRIENDLYURLCONTAININVALIDCHARS2)."";
				}
			}

		}

		else if ($form == "articlecategory") {

			$dbObj = db_getDBObject();

			if (!$title) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_TITLEISREQUIRED);
			if (!$friendly_url) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_FRIENDLYTITLEISREQUIRED);

			if ($title) {
				$sql = "SELECT title FROM ArticleCategory WHERE title = ".db_formatString(trim($title))."";
				$sql .= ($category_id) ? " AND category_id = $category_id " : " AND category_id = 0 ";
				if ($id) $sql .= " AND id != $id ";
				$sql .= " LIMIT 1";
				$rs = $dbObj->query($sql);
				if (mysql_num_rows($rs) > 0) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_TITLEALREADYINUSE);
			}

			if ($friendly_url) {
				$sql = "SELECT friendly_url FROM ArticleCategory WHERE friendly_url = ".db_formatString(trim($friendly_url))."";
				$sql .= ($category_id) ? " AND category_id = $category_id " : " AND category_id = 0 ";
				if ($id) $sql .= " AND id != $id ";
				$sql .= " LIMIT 1";
				$rs = $dbObj->query($sql);
				if (mysql_num_rows($rs) > 0) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_FRIENDLYURLPAGENAMEALREADYINUSE);
				if (!ereg(FRIENDLYURL_REGULAREXPRESSION, trim($friendly_url))) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_FRIENDLYURLCONTAININVALIDCHARS);
			}

			$array_edir_languages = explode(",", EDIR_LANGUAGES);
			$array_edir_languagenames = explode(",", EDIR_LANGUAGENAMES);
			if ($lang) $array_lang = explode(",", $lang);
			for ($i=1; $i<count(explode(",", EDIR_LANGUAGES)); $i++) {
				if ($array_lang) {
					if (in_array($array_edir_languages[$i], $array_lang)) {
						if (!${"title".$i}) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_LANG_TITLEISREQUIRED1)." (".$array_edir_languagenames[$i].") ".system_showText(LANG_SITEMGR_MSGERROR_LANG_TITLEISREQUIRED2)."";
						if (!${"friendly_url".$i}) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_LANG_FRIENDLYTITLEISREQUIRED1)." (".$array_edir_languagenames[$i].") ".system_showText(LANG_SITEMGR_MSGERROR_LANG_FRIENDLYTITLEISREQUIRED2)."";
					}
				}
				if (${"title".$i}) {
					$sql = "SELECT title".$i." FROM ArticleCategory WHERE title".$i." = ".db_formatString(trim(${"title".$i}))."";
					$sql .= ($category_id) ? " AND category_id = $category_id " : " AND category_id = 0 ";
					if ($id) $sql .= " AND id != $id ";
					$sql .= " LIMIT 1";
					$rs = $dbObj->query($sql);
					if (mysql_num_rows($rs) > 0) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_LANG_TITLEALREADYINUSE1)." (".$array_edir_languagenames[$i].") ".system_showText(LANG_SITEMGR_MSGERROR_LANG_TITLEALREADYINUSE2)."";
				}
				if (${"friendly_url".$i}) {
					$sql = "SELECT friendly_url".$i." FROM ArticleCategory WHERE friendly_url".$i." = ".db_formatString(trim(${"friendly_url".$i}))."";
					$sql .= ($category_id) ? " AND category_id = $category_id " : " AND category_id = 0 ";
					if ($id) $sql .= " AND id != $id ";
					$sql .= " LIMIT 1";
					$rs = $dbObj->query($sql);
					if (mysql_num_rows($rs) > 0) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_LANG_FRIENDLYURLPAGENAMEALREADYINUSE1)." (".$array_edir_languagenames[$i].") ".system_showText(LANG_SITEMGR_MSGERROR_LANG_FRIENDLYURLPAGENAMEALREADYINUSE2)."";
					if (!ereg(FRIENDLYURL_REGULAREXPRESSION, trim(${"friendly_url".$i}))) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_LANG_FRIENDLYURLCONTAININVALIDCHARS1)." (".$array_edir_languagenames[$i].") ".system_showText(LANG_SITEMGR_MSGERROR_LANG_FRIENDLYURLCONTAININVALIDCHARS2)."";
				}
			}

		}

		else if ($form == "promotion") {

			if (!$sitemgr) if (!$account_id) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_ACCOUNT_IS_REQUIRED);

			if (!$name)  $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_HEADLINE_IS_REQUIRED);
			if (!$offer) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_OFFER_IS_REQUIRED);

			$dateError = false;

			if (!$start_date) {
				$dateError = true;
				$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_START_DATE_IS_REQUIRED);
			} elseif (!validate_date($start_date)) {
				$dateError = true;
				$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_ENTER_VALID_START_DATE);
			}

			if (!$end_date) {
				$dateError = true;
				$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_END_DATE_IS_REQUIRED);
			} elseif (!validate_date($end_date)) {
				$dateError = true;
				$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_ENTER_VALID_END_DATE);
			}

			if (!$dateError) {

				$startDateStr = explode("/", $start_date);
				$endDateStr = explode("/", $end_date);

				if (DEFAULT_DATE_FORMAT == "m/d/Y") {
					$startDateStr = $startDateStr[2].$startDateStr[0].$startDateStr[1];
					$endDateStr = $endDateStr[2].$endDateStr[0].$endDateStr[1];
				} elseif (DEFAULT_DATE_FORMAT == "d/m/Y") {
					$startDateStr = $startDateStr[2].$startDateStr[1].$startDateStr[0];
					$endDateStr = $endDateStr[2].$endDateStr[1].$endDateStr[0];
				}

				if ($startDateStr > $endDateStr) {
					$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_END_DATE_GREATER_THAN_START_DATE);
				} elseif ($endDateStr < date("Ymd")) {
					$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_END_DATE_CANNOT_IN_PAST);
				}

			}

			$array_edir_languagenames = explode(",", EDIR_LANGUAGENAMES);
			for ($i=0; $i<count(explode(",", EDIR_LANGUAGES)); $i++) {
				$labelsuffix = "";
				if ($i) $labelsuffix = $i;
				if (${"array_keywords".$labelsuffix}) {
					if (count(${"array_keywords".$labelsuffix}) > MAX_KEYWORDS) {
						$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_1)." ".MAX_KEYWORDS." ".system_showText(LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_2)." (".$array_edir_languagenames[$i].")";
					}
					$kwlarge = false;
					foreach (${"array_keywords".$labelsuffix} as $kw) {
						if (strlen($kw) > 50) {
							$kwlarge = true;
						}
					}
					if ($kwlarge) {
						$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_PLEASE_INCLUDE_KEYWORDS)." (".$array_edir_languagenames[$i].")";
					}
				}
			}

		}

		else if ($form == "help") {
			if (!$name)  $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_NAME_IS_REQUIRED);
			if (!$email) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_EMAIL_IS_REQUIRED);
			if (!$text)  $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_TEXT_IS_REQUIRED);
		}

		elseif ($form == "listingdefaultprice") {

			$money_regex = "^([0-9]{1,5})(\.[0-9]{1,2})?$";

			$levelObj = new ListingLevel();

			foreach ($price as $priceLevel=>$priceValue) {
				if ($priceValue && !eregi($money_regex, $priceValue)) {
					$errors[] = "&#149;&nbsp;".$levelObj->showLevel($priceLevel)." ".system_showText(LANG_SITEMGR_MSGERROR_LEVELPRICEISINCORRECT);
					$flag = true;
				}
			}

			foreach ($free_category as $freeCategoryLevel=>$freeCategoryValue) {
				if ($freeCategoryValue && ($freeCategoryValue > MAX_CATEGORY_ALLOWED)) {
					$errors[] = "&#149;&nbsp;".$levelObj->showLevel($freeCategoryLevel)." ".system_showText(LANG_SITEMGR_MSGERROR_CATEGORIESINCLUDED1)." (".$freeCategoryValue.") ".system_showText(LANG_SITEMGR_MSGERROR_CATEGORIESINCLUDED2)." (".MAX_CATEGORY_ALLOWED.").";
				}
			}

			foreach ($category_price as $categoryPriceLevel=>$categoryPriceValue) {
				if ($categoryPriceValue && !eregi($money_regex, $categoryPriceValue)) {
					$errors[] = "&#149;&nbsp;".$levelObj->showLevel($categoryPriceLevel)." ".system_showText(LANG_SITEMGR_MSGERROR_CATEGORYPRICEINCORRECT);
					$flag = true;
				}
			}

			if ($flag) $errors[] = system_showText(LANG_SITEMGR_MSGERROR_PRICEFIELDSMUSTFILLEDMONETARYVALUES);

		}

		elseif ($form == "eventdefaultprice") {

			$money_regex = "^([0-9]{1,5})(\.[0-9]{1,2})?$";

			$levelObj = new EventLevel();

			foreach ($price as $priceLevel=>$priceValue) {
				if ($priceValue && !eregi($money_regex, $priceValue)) {
					$errors[] = "&#149;&nbsp;".$levelObj->showLevel($priceLevel)." ".system_showText(LANG_SITEMGR_MSGERROR_LEVELPRICEISINCORRECT);
					$flag = true;
				}
			}

			if($flag) $errors[] = system_showText(LANG_SITEMGR_MSGERROR_PRICEFIELDSMUSTFILLEDMONETARYVALUES);

		}

		elseif ($form == "bannerdefaultprice") {

			$money_regex = "^([0-9]{1,5})(\.[0-9]{1,2})?$";

			$levelObj = new BannerLevel();

			foreach ($price as $priceLevel=>$priceValue) {
				if ($priceValue && !eregi($money_regex, $priceValue)) {
					$errors[] = "&#149;&nbsp;".$levelObj->showLevel($priceLevel)." ".system_showText(LANG_SITEMGR_MSGERROR_LEVELPRICEISINCORRECT);
					$flag = true;
				}
			}

			foreach ($impression_block as $blockLevel=>$blockValue) {
				if ($blockValue <= 0) {
					$errors[] = "&#149;&nbsp;".$levelObj->showLevel($blockLevel)." ".system_showText(LANG_SITEMGR_MSGERROR_IMPRESSIONSMUSTBEMORETHANZERO);
					$flag = true;
				}
			}

			if($flag) $errors[] = system_showText(LANG_SITEMGR_MSGERROR_PRICEFIELDSMUSTFILLEDMONETARYVALUES);

		}

		elseif ($form == "classifieddefaultprice") {

			$money_regex = "^([0-9]{1,5})(\.[0-9]{1,2})?$";

			$levelObj = new ClassifiedLevel();

			foreach ($price as $priceLevel=>$priceValue) {
				if ($priceValue && !eregi($money_regex, $priceValue)) {
					$errors[] = "&#149;&nbsp;".$levelObj->showLevel($priceLevel)." ".system_showText(LANG_SITEMGR_MSGERROR_LEVELPRICEISINCORRECT);
					$flag = true;
				}
			}

			if($flag) $errors[] = system_showText(LANG_SITEMGR_MSGERROR_PRICEFIELDSMUSTFILLEDMONETARYVALUES);

		}

		elseif ($form == "articledefaultprice") {

			$money_regex = "^([0-9]{1,5})(\.[0-9]{1,2})?$";

			$levelObj = new ArticleLevel();

			foreach ($price as $priceLevel=>$priceValue) {
				if ($priceValue && !eregi($money_regex, $priceValue)) {
					$errors[] = "&#149;&nbsp;".$levelObj->showLevel($priceLevel)." ".system_showText(LANG_SITEMGR_MSGERROR_LEVELPRICEISINCORRECT);
					$flag = true;
				}
			}

			if($flag) $errors[] = system_showText(LANG_SITEMGR_MSGERROR_PRICEFIELDSMUSTFILLEDMONETARYVALUES);

		}

		elseif ($form == "event") {

			$err = array();

			if ((!$signup) && (!$sitemgr)) if (!$account_id) $err[] = system_showText(LANG_MSG_ACCOUNT_IS_REQUIRED);

			if (!$title) {
				$err[] = system_showText(LANG_MSG_TITLE_PLEASE_FILL_OUT);
			}
			if (!$friendly_url) {
				$err[] = system_showText(LANG_MSG_PAGE_NAME_PLEASE_FILL_OUT);
			}

			if (ZIPCODE_PROXIMITY == "on") {
				if ($zip_code) {
					if (!zipproximity_validate($zip_code)) { /*$err[] = "Invalid ".ucwords(ZIPCODE_LABEL)."";*/ }
				}
			}

			if ($friendly_url) {
				$dbObj = db_getDBObject();
				$sql = "SELECT friendly_url FROM Event WHERE friendly_url = ".db_formatString($friendly_url)."";
				if($id) $sql .= " AND id != $id ";
				$sql .= " LIMIT 1";
				$rs = $dbObj->query($sql);
				if(mysql_num_rows($rs) > 0) $err[] = "".system_showText(LANG_MSG_FRIENDLY_URL_IN_USE);
				if(!ereg(FRIENDLYURL_REGULAREXPRESSION, $friendly_url)) $err[] = system_showText(LANG_MSG_PAGE_NAME_INVALID_CHARS);
			}

			$dateTimeError = false;

			if (!$start_date) {
				$dateTimeError = true;
				$err[] = system_showText(LANG_LABEL_START_DATE)." (".system_showText(LANG_LABEL_EMPTY).")";
			} elseif (!validate_date($start_date)) {
				$dateTimeError = true;
				$err[] = system_showText(LANG_LABEL_START_DATE)." (".system_showText(LANG_LABEL_INVALID_DATE).": $start_date)";
			}

			if (!$end_date) {
				$dateTimeError = true;
				$err[] = system_showText(LANG_LABEL_END_DATE)." (".system_showText(LANG_LABEL_EMPTY).")";
			} elseif (!validate_date($end_date)) {
				$dateTimeError = true;
				$err[] = system_showText(LANG_LABEL_END_DATE)." (".system_showText(LANG_LABEL_INVALID_DATE).": $end_date)";
			}

			if ($start_time_hour || $start_time_min) {
				if (!$start_time_hour) {
					$dateTimeError = true;
					$err[] = system_showText(LANG_LABEL_START_TIME)." (".system_showText(LANG_LABEL_HOUR).")";
				}
				if (!$start_time_min) {
					$dateTimeError = true;
					$err[] = system_showText(LANG_LABEL_START_TIME)." (".system_showText(LANG_LABEL_MINUTE).")";
				}
				if (!$start_time_am_pm) {
					$dateTimeError = true;
					$err[] = system_showText(LANG_LABEL_START_TIME)." (AM/PM)";
				}
			} else {
				$start_time_hour = "12";
				$start_time_min = "00";
				$start_time_am_pm = "am";
			}

			if ($end_time_hour || $end_time_min) {
				if (!$end_time_hour) {
					$dateTimeError = true;
					$err[] = system_showText(LANG_LABEL_END_TIME)." (".system_showText(LANG_LABEL_HOUR).")";
				}
				if (!$end_time_min) {
					$dateTimeError = true;
					$err[] = system_showText(LANG_LABEL_END_TIME)." (".system_showText(LANG_LABEL_MINUTE).")";
				}
				if (!$end_time_am_pm) {
					$dateTimeError = true;
					$err[] = system_showText(LANG_LABEL_END_TIME)." (AM/PM)";
				}
			} else {
				$end_time_hour = "11";
				$end_time_min = "59";
				$end_time_am_pm = "pm";
			}

			if (!$dateTimeError) {

				$startDateStr = explode("/", $start_date);
				$endDateStr = explode("/", $end_date);

				if (DEFAULT_DATE_FORMAT == "m/d/Y") {
					$startDateStr = $startDateStr[2].$startDateStr[0].$startDateStr[1];
					$endDateStr = $endDateStr[2].$endDateStr[0].$endDateStr[1];
				} elseif (DEFAULT_DATE_FORMAT == "d/m/Y") {
					$startDateStr = $startDateStr[2].$startDateStr[1].$startDateStr[0];
					$endDateStr = $endDateStr[2].$endDateStr[1].$endDateStr[0];
				}

				if ($startDateStr > $endDateStr) {

					$err[] = system_showText(LANG_MSG_END_DATE_GREATER_THAN_START_DATE);

				} elseif ($endDateStr < date("Ymd")) {

					$err[] = system_showText(LANG_MSG_END_DATE_CANNOT_IN_PAST);

				} elseif ($startDateStr == $endDateStr) {

					$startTimeStr = "";
					if (($start_time_am_pm == "pm") && ($start_time_hour < 12)) $startTimeStr = 12 + $start_time_hour;
					elseif (($start_time_am_pm == "am") && ($start_time_hour == "12")) $startTimeStr = "00";
					else $startTimeStr = $start_time_hour;
					$startTimeStr .= $start_time_min."00";

					$endTimeStr = "";
					if (($end_time_am_pm == "pm") && ($end_time_hour < 12)) $endTimeStr = 12 + $end_time_hour;
					elseif (($end_time_am_pm == "am") && ($end_time_hour == "12")) $endTimeStr = "00";
					else $endTimeStr = $end_time_hour;
					$endTimeStr .= $end_time_min."00";

					if ($startTimeStr >= $endTimeStr) {
						$err[] = system_showText(LANG_MSG_END_DATE_GREATER_THAN_START_DATE);
					}

				}

			}

			$return_categories_array = explode(",", $return_categories);
			$return_categories_array = array_unique($return_categories_array);
			if(count($return_categories_array) > MAX_CATEGORY_ALLOWED) $err[] = system_showText(LANG_MSG_MAX_OF_CATEGORIES_1)." ".MAX_CATEGORY_ALLOWED." ".system_showText(LANG_MSG_MAX_OF_CATEGORIES_2);

			// explode all error messages to show
			if($err) {
				$errors[] = "<b>".system_showText(LANG_MSG_FIELDS_CONTAIN_ERRORS)."</b>";
				foreach ($err as $label) {
					$errors[] = "&#149;&nbsp;".$label;
				}
			}

			$array_edir_languagenames = explode(",", EDIR_LANGUAGENAMES);
			for ($i=0; $i<count(explode(",", EDIR_LANGUAGES)); $i++) {
				$labelsuffix = "";
				if ($i) $labelsuffix = $i;
				if (${"array_keywords".$labelsuffix}) {
					if (count(${"array_keywords".$labelsuffix}) > MAX_KEYWORDS) {
						$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_1)." ".MAX_KEYWORDS." ".system_showText(LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_2)." (".$array_edir_languagenames[$i].")";
					}
					$kwlarge = false;
					foreach (${"array_keywords".$labelsuffix} as $kw) {
						if (strlen($kw) > 50) {
							$kwlarge = true;
						}
					}
					if ($kwlarge) {
						$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_PLEASE_INCLUDE_KEYWORDS)." (".$array_edir_languagenames[$i].")";
					}
				}
			}

		} elseif ($form == "custominvoice") {

			$money_regex = "^([0-9]{1,5})(\.[0-9]{1,2})?$";
			$item_counter = 1;

			//account validation
			if (!$account_id) {
				$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_PLEASESELECTANACCOUNT).".";
			}

			//title validation
			if (!$title) {
				$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_PLEASETYPEATITLE).".";
			}

			if ($title && strlen($title) > 100) {
				$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_MAXCHARSALLOWEDFOR1)."100".system_showText(LANG_SITEMGR_MSGERROR_MAXCHARSALLOWEDFOR2)." ".system_showText(LANG_SITEMGR_MSGERROR_LANG_TITLEISREQUIRED1);
			}

			// if item description
			if ($item_desc) {
				foreach ($item_desc as $key => $each_item_desc) {
					// spaces
					$each_item_desc = trim($each_item_desc);
					// if item desc and not item price
					if (!empty($each_item_desc) && empty($item_price[$key])) {
						// default price 0.00
						$item_prices[$key] = format_money("0.00");
					// if item desc and item price
					} elseif (!empty($each_item_desc) && !empty($item_price[$key])) {
						// price validation
						if(!eregi($money_regex, $item_price[$key])) {
							$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_LABEL_ITEM)." ".$item_counter." ".system_showText(LANG_SITEMGR_MSGERROR_LEVELPRICEISINCORRECT).".";
						}
					// if price and not description
					} elseif (empty($each_item_desc) && !empty($item_price[$key])) {
						$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_LABEL_ITEM)." ".$item_counter." ".system_showText(LANG_SITEMGR_MSGERROR_DESCRIPTIONISEMPTY).".";
					}
					
					$item_counter++;
				}
			}

			// amount validation
			if ($amount <= 0) {
				$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_CUSTOMINVOICEAMOUNTCANNOTZERO);
			}

        } elseif ($form == "listinglevelnames") {

            $levelObj = new ListingLevel(EDIR_DEFAULT_LANGUAGE, true);
            $levelsArray = $levelObj->getLevelValues();
            $selected = false;
            foreach ($levelsArray as $levelValue) {
                if (!$nameLevel[$levelValue] && $activeLevel[$levelValue]) {
                    $errors[] = "&#149;&nbsp;".system_showText(LANG_LABEL_LEVEL)." ".$levelValue.": ".system_showText(LANG_SITEMGR_SETTINGS_LEVELS_NAMEREQUIRED);
                    $flag = true;
                }
                if($activeLevel[$levelValue]) { $selected = true; }
            }
            
            if(!$selected) {
                $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_SETTINGS_LEVELS_LEVELMUSTBEACTIVATED);
                $flag = true;
            }

        } elseif ($form == "eventlevelnames") {

            $levelObj = new EventLevel(EDIR_DEFAULT_LANGUAGE, true);
            $levelsArray = $levelObj->getLevelValues();
            $selected = false;
            foreach ($levelsArray as $levelValue) {
                if (!$nameLevel[$levelValue] && $activeLevel[$levelValue]) {
                    $errors[] = "&#149;&nbsp;".system_showText(LANG_LABEL_LEVEL)." ". $levelValue . ": ".system_showText(LANG_SITEMGR_SETTINGS_LEVELS_NAMEREQUIRED);
                    $flag = true;
                }
                if($activeLevel[$levelValue]) { $selected = true; }
            }
            
            if(!$selected) {
                $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_SETTINGS_LEVELS_LEVELMUSTBEACTIVATED);
                $flag = true;
            }
            

        } elseif ($form == "bannerlevelnames") {

            $levelObj = new BannerLevel(EDIR_DEFAULT_LANGUAGE, true);
            $levelsArray = $levelObj->getLevelValues();
            $selected = false;
            foreach ($levelsArray as $levelValue) {
                if (!$nameLevel[$levelValue] && $activeLevel[$levelValue]) {
                    $errors[] = "&#149;&nbsp;".system_showText(LANG_LABEL_LEVEL)." ". $levelValue . ": ".system_showText(LANG_SITEMGR_SETTINGS_LEVELS_NAMEREQUIRED);
                    $flag = true;
                }
                if($activeLevel[$levelValue]) { $selected = true; }
            }
            
            if(!$selected) {
                $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_SETTINGS_LEVELS_LEVELMUSTBEACTIVATED);
                $flag = true;
            }

        } elseif ($form == "classifiedlevelnames") {

            $levelObj = new ClassifiedLevel(EDIR_DEFAULT_LANGUAGE, true);
            $levelsArray = $levelObj->getLevelValues();
            $selected = false;
            foreach ($levelsArray as $levelValue) {
                if (!$nameLevel[$levelValue] && $activeLevel[$levelValue]) {
                    $errors[] = "&#149;&nbsp;".system_showText(LANG_LABEL_LEVEL)." ". $levelValue . ": ".system_showText(LANG_SITEMGR_SETTINGS_LEVELS_NAMEREQUIRED);
                    $flag = true;
                }
                if($activeLevel[$levelValue]) { $selected = true; }
            }
            
            if(!$selected) {
                $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_SETTINGS_LEVELS_LEVELMUSTBEACTIVATED);
                $flag = true;
            }

        } elseif ($form == "articlelevelnames") {

            $levelObj = new ArticleLevel(EDIR_DEFAULT_LANGUAGE, true);
            $levelsArray = $levelObj->getLevelValues();
            $selected = false;
            foreach ($levelsArray as $levelValue) {
                if (!$nameLevel[$levelValue] && $activeLevel[$levelValue]) {
                    $errors[] = "&#149;&nbsp;".system_showText(LANG_LABEL_LEVEL)." ". $levelValue . ": ".system_showText(LANG_SITEMGR_SETTINGS_LEVELS_NAMEREQUIRED);
                    $flag = true;
                }
                if($activeLevel[$levelValue]) { $selected = true; }
            }
            
            if(!$selected) {
                $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_SETTINGS_LEVELS_LEVELMUSTBEACTIVATED);
                $flag = true;
            }

        } 
        
        elseif ($form == "search_metatag") {
        
            if ($google_tag) {
                if ( strpos($google_tag, '<meta') === false || strpos($google_tag, '>') === false) {
                    $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY_MSGERRORGOOGLE);
                }
            }
            
            if ($yahoo_tag) {
                if ( strpos($yahoo_tag, '<meta') === false || strpos($yahoo_tag, '>') === false) {
                    $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY_MSGERRORYAHOO);
                } 
            }
            
            if ($live_tag) {
                if ( strpos($live_tag, '<meta') === false || strpos($live_tag, '>') === false) {
                    $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY_MSGERRORLIVE);
                }
            }
        
        }

		$error = "";

		if ($email) {
			if (!validate_email($email)) {
				$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_ENTER_VALID_EMAIL_ADDRESS);
			}
		}

		if ($emails) {
			if (!validate_emails($emails)) {
				$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_ENTER_VALID_EMAIL_ADDRESS);
			}
		}

		if ($url) {
			if (!validate_url($url)) {
				$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_ENTER_VALID_URL);
			}
		}

		if ($description) {
			if (strlen($description) > 255) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_PROVIDE_DESCRIPTION_WITH_255_CHARS);
		}

		if ($conditions) {
			if (strlen($conditions) > 255) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_PROVIDE_CONDITIONS_WITH_255_CHARS);
		}

		if ($renewal_date) {
			if (!validate_date($renewal_date)) {
				$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_ENTER_VALID_RENEWAL_DATE);
			} elseif (!validate_pastDate($renewal_date)) {
				$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_RENEWAL_DATE_IN_FUTURE);
			}
		}

		if ($expiration_date) {
			if (!validate_date($expiration_date)) {
				$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_ENTER_VALID_EXPIRATION_DATE);
			} elseif (!validate_pastDate($expiration_date)) {
				$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_EXPIRATION_DATE_IN_FUTURE);
			}
		}

		if ($errors) {
			$error .= implode("<br />", $errors);
			return false;
		}

		return true;

	}

	function validate_listingtemplate($array, &$error) {

		extract($array);

		if (!$title) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_TITLEISREQUIRED);
		if (!$friendly_url) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_PAGE_NAME_IS_REQUIRED);
		if (!$status) $errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_STATUSISREQUIRED);

		if ($friendly_url) {
			$dbObj = db_getDBObject();
			$sql = "SELECT friendly_url FROM ListingTemplate WHERE friendly_url = ".db_formatString($friendly_url)."";
			if ($id) $sql .= " AND id != $id ";
			$sql .= " LIMIT 1";
			$rs = $dbObj->query($sql);
			if (mysql_num_rows($rs) > 0) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_FRIENDLY_URL_IN_USE);
			if (!ereg(FRIENDLYURL_REGULAREXPRESSION, $friendly_url)) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_PAGE_NAME_INVALID_CHARS);
		}

		$money_regex = "^([0-9]{1,5})(\.[0-9]{1,2})?$";
		if ($price && !eregi($money_regex, $price)) {
			$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_LEVELPRICEISINCORRECT);
		}

		if ($errors) {
			$error .= implode("<br />", $errors);
			return false;
		}

		return true;

	}

	function validate_SM_changelogin($array, &$error) {
		extract($array);
		$error = "";
		if ($username) {
			if (eregi("[^a-zA-Z0-9@_.-]", $username)) {
				$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_SPECIALCHARSNOTALLOWEDFORUSERNAME);
			}
			$smaccount_exists = db_getFromDB('smaccount', 'username', db_formatString($username));
			if ($smaccount_exists->getNumber("id")){
				$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_CHOOSEDIFFERENTUSERNAME);
			}
		}
		if ($password) {
			$passwordError = validate_password($password);
			if (!empty($passwordError)) {
				$errors[] = $passwordError;
			} elseif ($retype_password) {
				if ($password != $retype_password) {
					$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_PASSWORDSDONOTMATCH);
				}
			} else {
				$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_FIELDRETYPEPASSWORDISREQUIRED);
			}
		} else {
			if ($retype_password) {
				$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_PLEASEENTERAPASSWORD);
			} elseif ($setlogin) {
				$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_PLEASEENTERAPASSWORD);
			}
		}
		if ($errors) {
			$error .= implode("<br />", $errors);
			return false;
		}
		return true;
	}

	function validate_MEMBERS_account($array, &$error) {
		extract($array);
		$error = "";
		if (($password) || ($retype_password)) $error = validate_password($password, $retype_password, true);
		if ($error) {
			return false;
		}
		return true;
	}

	function validate_password($password, $retype_password="", $required=false) {

		$error = "";

		if (eregi("[ ]", $password)) {

			$error = "&#149;&nbsp;".system_showText(LANG_MSG_BLANK_SPACE_NOT_ALLOWED_FOR_PASSWORD);

		} elseif (strlen($password) > PASSWORD_MAX_LEN) {

			$error = "&#149;&nbsp;".system_showText(LANG_MSG_ENTER_PASSWORD_WITH_MAX_CHARS)." ".PASSWORD_MAX_LEN." ".system_showText(LANG_LABEL_CHARACTERES).".";

		} elseif (strlen($password) < PASSWORD_MIN_LEN) {

			$error = "&#149;&nbsp;".system_showText(LANG_MSG_ENTER_PASSWORD_WITH_MIN_CHARS)." ".PASSWORD_MIN_LEN." ".system_showText(LANG_LABEL_CHARACTERES).".";

		} elseif ($password == "abc123") {

			$error = "&#149;&nbsp;".system_showText(LANG_MSG_ABC123_NOT_ALLOWED);

		} elseif ($retype_password) {

			if ($password != $retype_password) {

				$error = "&#149;&nbsp;".system_showText(LANG_MSG_PASSWORDS_DO_NOT_MATCH);

			}

		} elseif ($required) {

			$error = "&#149;&nbsp;".system_showText(LANG_MSG_PASSWORDS_DO_NOT_MATCH);

		}

		return $error;

	}

	function validate_username($username) {

		$error = "";

		if (!$username) {

			$error = "&#149;&nbsp;".system_showText(LANG_MSG_USERNAME_IS_REQUIRED);

		} elseif ($username) {

			if (eregi("[ ]", $username)) {

				$error = "&#149;&nbsp;".system_showText(LANG_MSG_SPACES_NOT_ALLOWED_FOR_USERNAME);;

			} elseif (eregi("[^a-zA-Z0-9@_.-]", $username)) {

				$error = "&#149;&nbsp;".system_showText(LANG_MSG_SPECIAL_CHARS_NOT_ALLOWED_FOR_USERNAME);

			} elseif (strlen($username) > USERNAME_MAX_LEN) {

				$error = "&#149;&nbsp;".system_showText(LANG_MSG_CHOOSE_USERNAME_WITH_MAX_CHARS)." ".USERNAME_MAX_LEN." ".system_showText(LANG_LABEL_CHARACTERES).".";

			} elseif (strlen($username) < USERNAME_MIN_LEN) {

				$error = "&#149;&nbsp;".system_showText(LANG_MSG_CHOOSE_USERNAME_WITH_MIN_CHARS)." ".USERNAME_MIN_LEN." ".system_showText(LANG_LABEL_CHARACTERES).".";

			}

		}

		return $error;

	}

	function validate_SM_account($array, &$error) {

		extract($array);

		$error = "";

		$usernameError = validate_username($username);
		if (!empty($usernameError)) $errors[] = $usernameError;

		$account_exists = db_getFromDB('account', 'username', db_formatString($username));
		if ($account_exists->getNumber("id")){
			$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_CHOOSEDIFFERENTUSERNAME);
		}

		$passwordError = validate_password($password);
		if (!empty($passwordError)) $errors[] = $passwordError;

		if ($errors) {
			$error .= implode("<br />", $errors);
			return false;
		}

		return true;

	}

	function validate_smaccount($array, &$error) {

		extract($array);

		$error = "";

		if (!$id) {
			$usernameError = validate_username($username);
			if (!empty($usernameError)) $errors[] = $usernameError;
		}

		if (!$id) {
			$smaccount_exists = db_getFromDB('smaccount', 'username', db_formatString($username));
			if ($smaccount_exists->getNumber("id")){
				$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_CHOOSEDIFFERENTUSERNAME);
			} else {
				setting_get("sitemgr_username", $sm_username);
				if ($username == $sm_username) {
					$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_CHOOSEDIFFERENTUSERNAME);
				}
			}
		}

		if ((!$id) || ($id && $password)) {
			$passwordError = validate_password($password, $retype_password, true);
			if (!empty($passwordError)) $errors[] = $passwordError;
		}

		if (!$name) {
			$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_NAMEISREQUIRED);
		}

		if (!$phone) {
			$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_PHONEISREQUIRED);
		}

		if (!$email) {
			$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_EMAILISREQUIRED);
		} elseif ($email) {
			if (!validate_email($email)) {
				$errors[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_ENTERVALIDEMAILADDRESS);
			}
		}

		if ($errors) {
			$error .= implode("<br />", $errors);
			return false;
		}

		return true;

	}

	function validate_addAccount($array, &$error) {

		extract($array);

		$error = "";

		$usernameError = validate_username($username);
		if ($usernameError) $errors[] = $usernameError;

		$account_exists = db_getFromDB('account', 'username', db_formatString($username));
		if ($account_exists->getNumber("id")){
			$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_CHOOSE_DIFFERENT_USERNAME);
		}

		if (!$password) {
			$errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_PASSWORD_IS_REQUIRED);
		} else {
			$pass_error = validate_password($password, $retype_password, true);
			if($pass_error) $errors[] = $pass_error;
		}

		if (!$agree_tou) $errors[] = "&#149;&nbsp;".system_showText(LANG_MSG_IGREETERMS_IS_REQUIRED);

		if ($errors) {
			$error .= implode("<br />", $errors);
			return false;
		}

		return true;

	}

	function validate_memberCurrentPassword($array, $account_id, &$error) {
		extract($array);
		$error = "";
		$sql = "SELECT * FROM Account WHERE id = ".db_formatString($account_id)." AND password = ".db_formatString(((strtolower(PASSWORD_ENCRYPTION) == "on") ? md5($array["current_password"]) : $array["current_password"]));
		$user = db_getFromDBBySQL("account", $sql);
		if (count($user)) {
			return true;
		} else {
			$error = "&#149;&nbsp;".system_showText(LANG_MSG_CURRENT_PASSWORD_IS_INCORRECT);
			return false;
		}
	}

	function validate_sitemgrCurrentPassword($array, $sm_id, &$error) {
		extract($array);
		$error = "";
		$sql = "SELECT * FROM SMAccount WHERE id = ".db_formatString($sm_id)." AND password = ".db_formatString(md5($array["current_password"])); 
		$user = db_getFromDBBySQL("smaccount", $sql);
		if (count($user)) {
			return true;
		} else {
			$error = system_showText(LANG_SITEMGR_MSGERROR_CURRENTPASSWORDINCORRECT);
			return false;
		}
	}
    
    function validateActive($var) {
        return (($var == y) ? $var : false);
    }
?>
