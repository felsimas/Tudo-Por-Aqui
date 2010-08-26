<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classes/class_classified.php
	# ----------------------------------------------------------------------------------------------------

	class Classified extends Handle {

		var $id;
		var $account_id;
		var $estado_id;
		var $cidade_id;
		var $bairro_id;
		var $city_id;
		var $area_id;
		var $entered;
		var $updated;
		var $renewal_date;
		var $discount_id;
		var $title;
		var $seo_title;
		var $friendly_url;
		var $email;
		var $url;
		var $contactname;
		var $address;
		var $address3;
		var $phone;
		var $fax;
		var $summarydesc;
		var $summarydesc1;
		var $summarydesc2;
		var $summarydesc3;
		var $summarydesc4;
		var $seo_summarydesc;
		var $seo_summarydesc1;
		var $seo_summarydesc2;
		var $seo_summarydesc3;
		var $seo_summarydesc4;
		var $detaildesc;
		var $detaildesc1;
		var $detaildesc2;
		var $detaildesc3;
		var $detaildesc4;
		var $keywords;
		var $keywords1;
		var $keywords2;
		var $keywords3;
		var $keywords4;
		var $seo_keywords;
		var $seo_keywords1;
		var $seo_keywords2;
		var $seo_keywords3;
		var $seo_keywords4;
		var $image_id;
		var $thumb_id;
		var $zip_code;
		var $level;
		var $status;

		var $maptuning;

		var $locationManager;

		function Classified($var='') {
			if (is_numeric($var) && ($var)) {
				$db = db_getDBObject();
				$sql = "SELECT * FROM Classified WHERE id = $var";
				$row = mysql_fetch_array($db->query($sql));
				$this->makeFromRow($row);
			} else {
				$this->makeFromRow($var);
			}
		}

		function makeFromRow($row='') {

			$status = new ItemStatus();
			$level = new ClassifiedLevel();

			$this->id					= ($row["id"])					? $row["id"]					: ($this->id					? $this->id					: 0);
			$this->account_id			= ($row["account_id"])			? $row["account_id"]			: 0;
			$this->estado_id			= ($row["estado_id"])			? $row["estado_id"]			: 0;
			$this->cidade_id				= ($row["cidade_id"])			? $row["cidade_id"]				: 0;
			$this->bairro_id			= ($row["bairro_id"])			? $row["bairro_id"]				: 0;
			$this->city_id				= ($row["city_id"])				? $row["city_id"]				: 0;
			$this->area_id				= ($row["area_id"])				? $row["area_id"]				: 0;
			$this->entered				= ($row["entered"])				? $row["entered"]				: ($this->entered				? $this->entered			: "");
			$this->updated				= ($row["updated"])				? $row["updated"]				: ($this->updated				? $this->updated			: "");
			$this->renewal_date			= ($row["renewal_date"])		? $row["renewal_date"]			: ($this->renewal_date			? $this->renewal_date		: 0);
			$this->discount_id			= ($row["discount_id"])			? $row["discount_id"]			: "";
			$this->title				= ($row["title"])				? $row["title"]					: ($this->title					? $this->title				: "");
			$this->seo_title			= ($row["seo_title"])			? $row["seo_title"]				: ($this->seo_title				? $this->seo_title			: "");
			$this->friendly_url			= ($row["friendly_url"])		? $row["friendly_url"]			: "";
			$this->email				= ($row["email"])				? $row["email"]					: "";
			$this->url					= ($row["url"])					? $row["url"]					: "";
			$this->contactname			= ($row["contactname"])			? $row["contactname"]			: "";
			$this->address				= ($row["address"])				? $row["address"]				: "";
			$this->address2				= ($row["address2"])			? $row["address2"]				: "";
			$this->phone				= ($row["phone"])				? $row["phone"]					: "";
			$this->fax					= ($row["fax"])					? $row["fax"]					: "";
			$this->summarydesc			= ($row["summarydesc"])			? $row["summarydesc"]			: "";
			$this->summarydesc1			= ($row["summarydesc1"])		? $row["summarydesc1"]			: "";
			$this->summarydesc2			= ($row["summarydesc2"])		? $row["summarydesc2"]			: "";
			$this->summarydesc3			= ($row["summarydesc3"])		? $row["summarydesc3"]			: "";
			$this->summarydesc4			= ($row["summarydesc4"])		? $row["summarydesc4"]			: "";
			$this->seo_summarydesc		= ($row["seo_summarydesc"])		? $row["seo_summarydesc"]		: ($this->seo_summarydesc		? $this->seo_summarydesc	: "");
			$this->seo_summarydesc1		= ($row["seo_summarydesc1"])	? $row["seo_summarydesc1"]		: ($this->seo_summarydesc1		? $this->seo_summarydesc1	: "");
			$this->seo_summarydesc2		= ($row["seo_summarydesc2"])	? $row["seo_summarydesc2"]		: ($this->seo_summarydesc2		? $this->seo_summarydesc2	: "");
			$this->seo_summarydesc3		= ($row["seo_summarydesc3"])	? $row["seo_summarydesc3"]		: ($this->seo_summarydesc3		? $this->seo_summarydesc3	: "");
			$this->seo_summarydesc4		= ($row["seo_summarydesc4"])	? $row["seo_summarydesc4"]		: ($this->seo_summarydesc4		? $this->seo_summarydesc4	: "");
			$this->detaildesc			= ($row["detaildesc"])			? $row["detaildesc"]			: "";
			$this->detaildesc1			= ($row["detaildesc1"])			? $row["detaildesc1"]			: "";
			$this->detaildesc2			= ($row["detaildesc2"])			? $row["detaildesc2"]			: "";
			$this->detaildesc3			= ($row["detaildesc3"])			? $row["detaildesc3"]			: "";
			$this->detaildesc4			= ($row["detaildesc4"])			? $row["detaildesc4"]			: "";
			$this->keywords				= ($row["keywords"])			? $row["keywords"]				: "";
			$this->keywords1			= ($row["keywords1"])			? $row["keywords1"]				: "";
			$this->keywords2			= ($row["keywords2"])			? $row["keywords2"]				: "";
			$this->keywords3			= ($row["keywords3"])			? $row["keywords3"]				: "";
			$this->keywords4			= ($row["keywords4"])			? $row["keywords4"]				: "";
			$this->seo_keywords			= ($row["seo_keywords"])		? $row["seo_keywords"]			: ($this->seo_keywords			? $this->seo_keywords		: "");
			$this->seo_keywords1		= ($row["seo_keywords1"])		? $row["seo_keywords1"]			: ($this->seo_keywords1			? $this->seo_keywords1		: "");
			$this->seo_keywords2		= ($row["seo_keywords2"])		? $row["seo_keywords2"]			: ($this->seo_keywords2			? $this->seo_keywords2		: "");
			$this->seo_keywords3		= ($row["seo_keywords3"])		? $row["seo_keywords3"]			: ($this->seo_keywords3			? $this->seo_keywords3		: "");
			$this->seo_keywords4		= ($row["seo_keywords4"])		? $row["seo_keywords4"]			: ($this->seo_keywords4			? $this->seo_keywords4		: "");
			$this->image_id				= ($row["image_id"])			? $row["image_id"]				: ($this->image_id				? $this->image_id			: 0);
			$this->thumb_id				= ($row["thumb_id"])			? $row["thumb_id"]				: ($this->thumb_id				? $this->thumb_id			: 0);
			$this->zip_code				= ($row["zip_code"])			? $row["zip_code"]				: "";
			$this->level				= ($row["level"])				? $row["level"]					: ($this->level					? $this->level				: $level->getDefaultLevel());
			$this->status				= ($row["status"])				? $row["status"]				: $status->getDefaultStatus();

			$this->maptuning			= ($row["maptuning"])			? $row["maptuning"]				: "";

		}

		function Save() {

			$this->prepareToSave();

			$dbObj = db_getDBObject();

			$this->friendly_url = strtolower($this->friendly_url);

			if ($this->id) {

				$sql = "UPDATE Classified SET"
					. " account_id         = $this->account_id,"
					. " estado_id         = $this->estado_id,"
					. " cidade_id           = $this->cidade_id,"
					. " bairro_id          = $this->bairro_id,"
					. " city_id            = $this->city_id,"
					. " area_id            = $this->area_id,"
					. " updated            = NOW(),"
					. " renewal_date       = $this->renewal_date,"
					. " discount_id        = $this->discount_id,"
					. " title              = $this->title,"
					. " seo_title          = $this->seo_title,"
					. " friendly_url       = $this->friendly_url,"
					. " email              = $this->email,"
					. " url                = $this->url,"
					. " contactname        = $this->contactname,"
					. " address            = $this->address,"
					. " address2           = $this->address2,"
					. " phone              = $this->phone,"
					. " fax                = $this->fax,"
					. " summarydesc        = $this->summarydesc,"
					. " summarydesc1       = $this->summarydesc1,"
					. " summarydesc2       = $this->summarydesc2,"
					. " summarydesc3       = $this->summarydesc3,"
					. " summarydesc4       = $this->summarydesc4,"
					. " seo_summarydesc    = $this->seo_summarydesc,"
					. " seo_summarydesc1   = $this->seo_summarydesc1,"
					. " seo_summarydesc2   = $this->seo_summarydesc2,"
					. " seo_summarydesc3   = $this->seo_summarydesc3,"
					. " seo_summarydesc4   = $this->seo_summarydesc4,"
					. " detaildesc         = $this->detaildesc,"
					. " detaildesc1        = $this->detaildesc1,"
					. " detaildesc2        = $this->detaildesc2,"
					. " detaildesc3        = $this->detaildesc3,"
					. " detaildesc4        = $this->detaildesc4,"
					. " keywords           = $this->keywords,"
					. " keywords1          = $this->keywords1,"
					. " keywords2          = $this->keywords2,"
					. " keywords3          = $this->keywords3,"
					. " keywords4          = $this->keywords4,"
					. " seo_keywords       = $this->seo_keywords,"
					. " seo_keywords1      = $this->seo_keywords1,"
					. " seo_keywords2      = $this->seo_keywords2,"
					. " seo_keywords3      = $this->seo_keywords3,"
					. " seo_keywords4      = $this->seo_keywords4,"
					. " image_id           = $this->image_id,"
					. " thumb_id           = $this->thumb_id,"
					. " zip_code           = $this->zip_code,"
					. " level              = $this->level,"
					. " status             = $this->status"
					. " WHERE id           = $this->id";
				$dbObj->query($sql);

			} else {

				$sql = "INSERT INTO Classified"
					. " (account_id,"
					. " estado_id,"
					. " cidade_id,"
					. " bairro_id,"
					. " city_id,"
					. " area_id,"
					. " updated,"
					. " entered,"
					. " renewal_date,"
					. " discount_id,"
					. " title,"
					. " seo_title,"
					. " friendly_url,"
					. " email,"
					. " url,"
					. " contactname,"
					. " address,"
					. " address2,"
					. " phone,"
					. " fax,"
					. " summarydesc,"
					. " summarydesc1,"
					. " summarydesc2,"
					. " summarydesc3,"
					. " summarydesc4,"
					. " seo_summarydesc,"
					. " seo_summarydesc1,"
					. " seo_summarydesc2,"
					. " seo_summarydesc3,"
					. " seo_summarydesc4,"
					. " detaildesc,"
					. " detaildesc1,"
					. " detaildesc2,"
					. " detaildesc3,"
					. " detaildesc4,"
					. " keywords,"
					. " keywords1,"
					. " keywords2,"
					. " keywords3,"
					. " keywords4,"
					. " seo_keywords,"
					. " seo_keywords1,"
					. " seo_keywords2,"
					. " seo_keywords3,"
					. " seo_keywords4,"
					. " fulltextsearch_keyword,"
					. " fulltextsearch_where,"
					. " image_id,"
					. " thumb_id,"
					. " zip_code,"
					. " level,"
					. " status,"
					. " maptuning)"
					. " VALUES"
					. " ($this->account_id,"
					. " $this->estado_id,"
					. " $this->cidade_id,"
					. " $this->bairro_id,"
					. " $this->city_id,"
					. " $this->area_id,"
					. " NOW(),"
					. " NOW(),"
					. " $this->renewal_date,"
					. " $this->discount_id,"
					. " $this->title,"
					. " $this->title,"
					. " $this->friendly_url,"
					. " $this->email,"
					. " $this->url,"
					. " $this->contactname,"
					. " $this->address,"
					. " $this->address2,"
					. " $this->phone,"
					. " $this->fax,"
					. " $this->summarydesc,"
					. " $this->summarydesc1,"
					. " $this->summarydesc2,"
					. " $this->summarydesc3,"
					. " $this->summarydesc4,"
					. " $this->summarydesc,"
					. " $this->summarydesc1,"
					. " $this->summarydesc2,"
					. " $this->summarydesc3,"
					. " $this->summarydesc4,"
					. " $this->detaildesc,"
					. " $this->detaildesc1,"
					. " $this->detaildesc2,"
					. " $this->detaildesc3,"
					. " $this->detaildesc4,"
					. " $this->keywords,"
					. " $this->keywords1,"
					. " $this->keywords2,"
					. " $this->keywords3,"
					. " $this->keywords4,"
					. " ".str_replace(" || ", ", ", $this->keywords).","
					. " ".str_replace(" || ", ", ", $this->keywords1).","
					. " ".str_replace(" || ", ", ", $this->keywords2).","
					. " ".str_replace(" || ", ", ", $this->keywords3).","
					. " ".str_replace(" || ", ", ", $this->keywords4).","
					. " '',"
					. " '',"
					. " $this->image_id,"
					. " $this->thumb_id,"
					. " $this->zip_code,"
					. " $this->level,"
					. " $this->status,"
					. " '')";
				$dbObj->query($sql);
				$this->id = mysql_insert_id($dbObj->link_id);

			}

			$this->prepareToUse();

			$this->setFullTextSearch();

		}

		function Delete() {

			$dbObj = db_getDBObJect();

			### GALERY
			$sql = "DELETE FROM Gallery_Item WHERE item_type = 'classified' AND item_id = $this->id";
			$dbObj->query($sql);

			### IMAGES
			if ($this->image_id) {
				$image = new Image($this->image_id);
				if ($image) $image->Delete();
			}
			if ($this->thumb_id) {
				$image = new Image($this->thumb_id);
				if ($image) $image->Delete();
			}

			### INVOICE
			$sql = "UPDATE Invoice_Classified SET classified_id = '0' WHERE classified_id = $this->id";
			$dbObj->query($sql);

			### PAYMENT
			$sql = "UPDATE Payment_Classified_Log SET classified_id = '0' WHERE classified_id = $this->id";
			$dbObj->query($sql);

			### CLASSIFIED
			$sql = "DELETE FROM Classified WHERE id = $this->id";
			$dbObj->query($sql);

		}

		function updateImage($imageArray) {
			unset($imageObj);
			if ($this->image_id) {
				$imageobj = new Image($this->image_id);
				if ($imageobj) $imageobj->delete();
			}
			$this->image_id = $imageArray["image_id"];
			unset($imageObj);
			if ($this->thumb_id) {
				$imageObj = new Image($this->thumb_id);
				if ($imageObj) $imageObj->delete();
			}
			$this->thumb_id = $imageArray["thumb_id"];
			unset($imageObj);
		}

		function getCategories() {
			$dbObj = db_getDBObject();
			$sql = "SELECT cat_1_id FROM Classified WHERE id = $this->id";
			$r = $dbObj->query($sql);
			while ($row = mysql_fetch_array($r)) {
				if ($row["cat_1_id"]) $categories[] = new ClassifiedCategory($row["cat_1_id"]);
			}
			return $categories;
		}

		function setCategories($array) {
			$dbObj = db_getDBObject();
			$cat_1_id = 0;
			$parcat_1_level1_id = 0;
			if ($array) {
				$count_category_aux = 1;
				foreach ($array as $category) {
					if ($category) {
						unset($parents);
						$cat_id = $category;
						$i = 0;
						while ($cat_id != 0) {
							$sql = "SELECT * FROM ClassifiedCategory WHERE id = $cat_id";
							$rs1 = $dbObj->query($sql);
							if (mysql_num_rows($rs1) > 0) {
								$cat_info = mysql_fetch_assoc($rs1);
								$cat_id = $cat_info["category_id"];
								$parents[$i++] = $cat_id;
							} else {
								$cat_id = 0;
							}
						}
						for ($j=count($parents)-1; $j < 4; $j++) { $parents[$j] = 0; }
						${"cat_".$count_category_aux."_id"} = $category;
						${"parcat_".$count_category_aux."_level1_id"} = $parents[0];
						$count_category_aux++;
					}
				}
			}
			$sql = "UPDATE Classified SET cat_1_id = ".$cat_1_id.", parcat_1_level1_id = ".$parcat_1_level1_id." WHERE id = $this->id";
			$dbObj->query($sql);
			$this->setFullTextSearch();
		}

		function getPrice() {

			$price = 0;

			$levelObj = new ClassifiedLevel();
			$price = $price + $levelObj->getPrice($this->level);

			if ($this->discount_id) {

				if (is_valid_discount_code($this->discount_id, "classified", $this->id, $discount_message, $discount_error)) {

					$discountCodeObj = new DiscountCode($this->discount_id);

					if ($discountCodeObj->getString("id")) {

						if ($discountCodeObj->getString("type") == "percentage") {
							$price = $price * (1 - $discountCodeObj->getString("amount")/100);
						} elseif ($discountCodeObj->getString("type") == "monetary value") {
							$price = $price - $discountCodeObj->getString("amount");
						}

					}

				} else {

					$dbObj = db_getDBObject();
					$sql = "UPDATE Classified SET discount_id = '' WHERE id = ".$this->id;
					$result = $dbObj->query($sql);

				}

			}

			if ($price <= 0) $price = 0;

			return $price;

		}

		function hasRenewalDate() {
			if (PAYMENT_FEATURE != "on") return false;
			if ((CREDITCARDPAYMENT_FEATURE != "on") && (INVOICEPAYMENT_FEATURE != "on") && (MANUALPAYMENT_FEATURE != "on")) return false;
			if ($this->getPrice() <= 0) return false;
			return true;
		}

		function needToCheckOut() {

			if ($this->hasRenewalDate()) {

				$today = date("Y-m-d");
				$today = explode("-", $today);
				$today_year = $today[0];
				$today_month = $today[1];
				$today_day = $today[2];
				$timestamp_today = mktime(0, 0, 0, $today_month, $today_day, $today_year);

				$this_renewaldate = $this->renewal_date;
				$renewaldate = explode("-", $this_renewaldate);
				$renewaldate_year = $renewaldate[0];
				$renewaldate_month = $renewaldate[1];
				$renewaldate_day = $renewaldate[2];
				$timestamp_renewaldate = mktime(0, 0, 0, $renewaldate_month, $renewaldate_day, $renewaldate_year);

				if (($this->status == "E") || ($this_renewaldate == "0000-00-00") || ($timestamp_today > $timestamp_renewaldate)) {
					return true;
				}

			}

			return false;

		}

		function getNextRenewalDate($times = 1) {

			$nextrenewaldate = "0000-00-00";

			if ($this->hasRenewalDate()) {

				if ($this->needToCheckOut()) {

					$today = date("Y-m-d");
					$today = explode("-", $today);
					$start_year = $today[0];
					$start_month = $today[1];
					$start_day = $today[2];

				} else {

					$this_renewaldate = $this->renewal_date;
					$renewaldate = explode("-", $this_renewaldate);
					$start_year = $renewaldate[0];
					$start_month = $renewaldate[1];
					$start_day = $renewaldate[2];

				}

				$renewalcycle = payment_getRenewalCycle("classified");
				$renewalunit = payment_getRenewalUnit("classified");

				if ($renewalunit == "Y") {
					$nextrenewaldate = date("Y-m-d", mktime(0, 0, 0, (int)$start_month, (int)$start_day, (int)$start_year+($renewalcycle*$times)));
				} elseif ($renewalunit == "M") {
					$nextrenewaldate = date("Y-m-d", mktime(0, 0, 0, (int)$start_month+($renewalcycle*$times), (int)$start_day, (int)$start_year));
				} elseif ($renewalunit == "D") {
					$nextrenewaldate = date("Y-m-d", mktime(0, 0, 0, (int)$start_month, (int)$start_day+($renewalcycle*$times), (int)$start_year));
				}

			}

			return $nextrenewaldate;

		}

		function setLocationManager(&$locationManager){
			$this->locationManager =& $locationManager;
		}

		function &getLocationManager(){
			return $this->locationManager; /* NEVER auto-instantiate this*/
		}

		function getLocationString($format, $forceManagerCreation = false){
			if($forceManagerCreation && !$this->locationManager) $this->locationManager = new LocationManager();
			return db_getLocationString($this, $format);
		}

		function setFullTextSearch() {

			$dbObj = db_getDBObject();

			if ($this->title) {
				$fulltextsearch_keyword[] = $this->title;
			}

			if ($this->keywords) {
				$fulltextsearch_keyword[] = str_replace(" || ", " ", $this->keywords);
			}
			if ($this->keywords1) {
				$fulltextsearch_keyword[] = str_replace(" || ", " ", $this->keywords1);
			}
			if ($this->keywords2) {
				$fulltextsearch_keyword[] = str_replace(" || ", " ", $this->keywords2);
			}
			if ($this->keywords3) {
				$fulltextsearch_keyword[] = str_replace(" || ", " ", $this->keywords3);
			}
			if ($this->keywords4) {
				$fulltextsearch_keyword[] = str_replace(" || ", " ", $this->keywords4);
			}

			if ($this->address) {
				$fulltextsearch_where[] = $this->address;
			}

			if ($this->zip_code) {
				$fulltextsearch_where[] = $this->zip_code;
			}

			$countryObj = new LocationCountry($this->estado_id);
			if ($countryObj->getNumber("id")) {
				$fulltextsearch_where[] = $countryObj->getString("name", false);
				if ($countryObj->getString("abbreviation")) {
					$fulltextsearch_where[] = $countryObj->getString("abbreviation", false);
				}
			}

			$stateObj = new LocationState($this->cidade_id);
			if ($stateObj->getNumber("id")) {
				$fulltextsearch_where[] = $stateObj->getString("name", false);
				if ($stateObj->getString("abbreviation")) {
					$fulltextsearch_where[] = $stateObj->getString("abbreviation", false);
				}
			}

			$regionObj = new LocationRegion($this->bairro_id);
			if ($regionObj->getNumber("id")) {
				$fulltextsearch_where[] = $regionObj->getString("name", false);
				if ($regionObj->getString("abbreviation")) {
					$fulltextsearch_where[] = $regionObj->getString("abbreviation", false);
				}
			}

			$cityObj = new LocationCity($this->city_id);
			if ($cityObj->getNumber("id")) {
				$fulltextsearch_where[] = $cityObj->getString("name", false);
				if ($cityObj->getString("abbreviation")) {
					$fulltextsearch_where[] = $cityObj->getString("abbreviation", false);
				}
			}

			$areaObj = new LocationArea($this->area_id);
			if ($areaObj->getNumber("id")) {
				$fulltextsearch_where[] = $areaObj->getString("name", false);
				if ($areaObj->getString("abbreviation")) {
					$fulltextsearch_where[] = $areaObj->getString("abbreviation", false);
				}
			}

			$categories = $this->getCategories();
			if ($categories) {
				foreach ($categories as $category) {
					unset($parents);
					$category_id = $category->getNumber("id");
					while ($category_id != 0) {
						$sql = "SELECT * FROM ClassifiedCategory WHERE id = $category_id";
						$result = $dbObj->query($sql);
						if (mysql_num_rows($result) > 0) {
							$category_info = mysql_fetch_assoc($result);
							if ($category_info["title"]) {
								$fulltextsearch_keyword[] = $category_info["title"];
							}
							if ($category_info["title1"]) {
								$fulltextsearch_keyword[] = $category_info["title1"];
							}
							if ($category_info["title2"]) {
								$fulltextsearch_keyword[] = $category_info["title2"];
							}
							if ($category_info["title3"]) {
								$fulltextsearch_keyword[] = $category_info["title3"];
							}
							if ($category_info["title4"]) {
								$fulltextsearch_keyword[] = $category_info["title4"];
							}
							if ($category_info["keywords"]) {
								$fulltextsearch_keyword[] = $category_info["keywords"];
							}
							if ($category_info["keywords1"]) {
								$fulltextsearch_keyword[] = $category_info["keywords1"];
							}
							if ($category_info["keywords2"]) {
								$fulltextsearch_keyword[] = $category_info["keywords2"];
							}
							if ($category_info["keywords3"]) {
								$fulltextsearch_keyword[] = $category_info["keywords3"];
							}
							if ($category_info["keywords4"]) {
								$fulltextsearch_keyword[] = $category_info["keywords4"];
							}
							$category_id = $category_info["category_id"];
						} else {
							$category_id = 0;
						}
					}
				}
			}

			if ($this->summarydesc) {
				$fulltextsearch_keyword[] = substr($this->summarydesc, 0, 100);
			}
			if ($this->summarydesc1) {
				$fulltextsearch_keyword[] = substr($this->summarydesc1, 0, 100);
			}
			if ($this->summarydesc2) {
				$fulltextsearch_keyword[] = substr($this->summarydesc2, 0, 100);
			}
			if ($this->summarydesc3) {
				$fulltextsearch_keyword[] = substr($this->summarydesc3, 0, 100);
			}
			if ($this->summarydesc4) {
				$fulltextsearch_keyword[] = substr($this->summarydesc4, 0, 100);
			}

			if (is_array($fulltextsearch_keyword)) {
				$fulltextsearch_keyword_sql = db_formatString(implode(" ", $fulltextsearch_keyword));
				$sql = "UPDATE Classified SET fulltextsearch_keyword = $fulltextsearch_keyword_sql WHERE id = $this->id";
				$result = $dbObj->query($sql);
			}
			if (is_array($fulltextsearch_where)) {
				$fulltextsearch_where_sql = db_formatString(implode(" ", $fulltextsearch_where));
				$sql = "UPDATE Classified SET fulltextsearch_where = $fulltextsearch_where_sql WHERE id = $this->id";
				$result = $dbObj->query($sql);
			}

		}

		function getGalleries() {
			$dbObj = db_getDBObject();
			$sql = "SELECT * FROM Gallery_Item WHERE item_type='classified' AND item_id = $this->id ORDER BY gallery_id";
			$r = $dbObj->query($sql);
			if ($this->id > 0) while ($row = mysql_fetch_array($r)) $galleries[] = $row["gallery_id"];
			return $galleries;
		}

		function setGalleries($array = false) {
			$dbObj = db_getDBObject();
			$sql = "DELETE FROM Gallery_Item WHERE item_type='classified' AND item_id = $this->id";
			$dbObj->query($sql);
			if ($array) {
				foreach ($array as $gallery) {
					if ($gallery) {
						$sql = "INSERT INTO Gallery_Item (item_id, gallery_id, item_type) VALUES ($this->id, $gallery, 'classified')";
						$rs3 = $dbObj->query($sql);
					}
				}
			}
		}

		function setMapTuning($latitude_longitude="") {
			$dbObj = db_getDBObject();
			$sql = "UPDATE Classified SET maptuning = ".db_formatString($latitude_longitude)." WHERE id = ".$this->id."";
			$dbObj->query($sql);
		}
        
        function hasDetail() {
            $classifiedLevel = new ClassifiedLevel();
            $detail = $classifiedLevel->getDetail($this->level);
            unset($classifiedLevel);
            return $detail;
        }

	}

?>
