<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classes/class_event.php
	# ----------------------------------------------------------------------------------------------------

	class Event extends Handle {

		var $id;
		var $account_id;
		var $title;
		var $seo_title;
		var $friendly_url;
		var $image_id;
		var $thumb_id;
		var $description;
		var $description1;
		var $description2;
		var $description3;
		var $description4;
		var $seo_description;
		var $seo_description1;
		var $seo_description2;
		var $seo_description3;
		var $seo_description4;
		var $long_description;
		var $long_description1;
		var $long_description2;
		var $long_description3;
		var $long_description4;
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
		var $updated;
		var $entered;
		var $start_date;
		var $has_start_time;
		var $start_time;
		var $end_date;
		var $has_end_time;
		var $end_time;
		var $location;
		var $address;
		var $zip_code;
		var $estado_id;
		var $cidade_id;
		var $bairro_id;
		var $city_id;
		var $area_id;
		var $url;
		var $contact_name;
		var $phone;
		var $email;
		var $renewal_date;
		var $discount_id;
		var $status;
		var $level;
		var $recurring;

		var $maptuning;

		var $locationManager;

		function Event($var='') {
		
			if (is_numeric($var) && ($var)) {
				$db = db_getDBObject();
				$sql = "SELECT * FROM Event WHERE id = $var";
				$row = mysql_fetch_array($db->query($sql));
				$this->makeFromRow($row);
			}
			else {
				$this->makeFromRow($var);
			}

		}

		function makeFromRow($row='') {

			$statusObj = new ItemStatus();
			$level = new EventLevel();

			$this->id					= ($row["id"])					? $row["id"]				: ($this->id					? $this->id				: 0);
			$this->account_id			= ($row["account_id"])			? $row["account_id"]		: 0;
			$this->title				= ($row["title"])				? $row["title"]				: ($this->title					? $this->title			: "");
			$this->seo_title			= ($row["seo_title"])			? $row["seo_title"]			: ($this->seo_title				? $this->seo_title		: "");
			$this->friendly_url			= ($row["friendly_url"])		? $row["friendly_url"]		: "";
			$this->image_id				= ($row["image_id"])			? $row["image_id"]			: ($this->image_id				? $this->image_id		: 0);
			$this->thumb_id				= ($row["thumb_id"])			? $row["thumb_id"]			: ($this->thumb_id				? $this->thumb_id		: 0);
			$this->description			= ($row["description"])			? $row["description"]		: "";
			$this->description1			= ($row["description1"])		? $row["description1"]		: "";
			$this->description2			= ($row["description2"])		? $row["description2"]		: "";
			$this->description3			= ($row["description3"])		? $row["description3"]		: "";
			$this->description4			= ($row["description4"])		? $row["description4"]		: "";
			$this->seo_description		= ($row["seo_description"])		? $row["seo_description"]	: ($this->seo_description	? $this->seo_description	: "");
			$this->seo_description1		= ($row["seo_description1"])	? $row["seo_description1"]	: ($this->seo_description1	? $this->seo_description1	: "");
			$this->seo_description2		= ($row["seo_description2"])	? $row["seo_description2"]	: ($this->seo_description2	? $this->seo_description2	: "");
			$this->seo_description3		= ($row["seo_description3"])	? $row["seo_description3"]	: ($this->seo_description3	? $this->seo_description3	: "");
			$this->seo_description4		= ($row["seo_description4"])	? $row["seo_description4"]	: ($this->seo_description4	? $this->seo_description4	: "");
			$this->long_description		= ($row["long_description"])	? $row["long_description"]	: "";
			$this->long_description1	= ($row["long_description1"])	? $row["long_description1"]	: "";
			$this->long_description2	= ($row["long_description2"])	? $row["long_description2"]	: "";
			$this->long_description3	= ($row["long_description3"])	? $row["long_description3"]	: "";
			$this->long_description4	= ($row["long_description4"])	? $row["long_description4"]	: "";
			$this->keywords				= ($row["keywords"])			? $row["keywords"]			: "";
			$this->keywords1			= ($row["keywords1"])			? $row["keywords1"]			: "";
			$this->keywords2			= ($row["keywords2"])			? $row["keywords2"]			: "";
			$this->keywords3			= ($row["keywords3"])			? $row["keywords3"]			: "";
			$this->keywords4			= ($row["keywords4"])			? $row["keywords4"]			: "";
			$this->seo_keywords			= ($row["seo_keywords"])		? $row["seo_keywords"]		: ($this->seo_keywords			? $this->seo_keywords	: "");
			$this->seo_keywords1		= ($row["seo_keywords1"])		? $row["seo_keywords1"]		: ($this->seo_keywords1			? $this->seo_keywords1	: "");
			$this->seo_keywords2		= ($row["seo_keywords2"])		? $row["seo_keywords2"]		: ($this->seo_keywords2			? $this->seo_keywords2	: "");
			$this->seo_keywords3		= ($row["seo_keywords3"])		? $row["seo_keywords3"]		: ($this->seo_keywords3			? $this->seo_keywords3	: "");
			$this->seo_keywords4		= ($row["seo_keywords4"])		? $row["seo_keywords4"]		: ($this->seo_keywords4			? $this->seo_keywords4	: "");
			$this->updated				= ($row["updated"])				? $row["updated"]			: ($this->updated				? $this->updated		: "");
			$this->entered				= ($row["entered"])				? $row["entered"]			: ($this->entered				? $this->entered		: "");

			$this->setDate("start_date", $row["start_date"]);
			$this->has_start_time	= ($row["has_start_time"])		? $row["has_start_time"]	: "n";
			$this->start_time		= ($row["start_time"])			? $row["start_time"]		: 0;

			$this->setDate("end_date", $row["end_date"]);
			$this->has_end_time		= ($row["has_end_time"])		? $row["has_end_time"]		: "n";
			$this->end_time			= ($row["end_time"])			? $row["end_time"]			: 0;

			$this->location			= ($row["location"])			? $row["location"]			: "";
			$this->address			= ($row["address"])				? $row["address"]			: "";
			$this->zip_code			= ($row["zip_code"])			? $row["zip_code"]			: "";
			$this->estado_id		= ($row["estado_id"])			? $row["estado_id"]		: 0;
			$this->cidade_id			= ($row["cidade_id"])			? $row["cidade_id"]			: 0;
			$this->bairro_id		= ($row["bairro_id"])			? $row["bairro_id"]			: 0;
			$this->city_id			= ($row["city_id"])				? $row["city_id"]			: 0;
			$this->area_id			= ($row["area_id"])				? $row["area_id"]			: 0;
			$this->url				= ($row["url"])					? $row["url"]				: "";
			$this->contact_name		= ($row["contact_name"])		? $row["contact_name"]		: "";
			$this->phone			= ($row["phone"])				? $row["phone"]				: "";
			$this->email			= ($row["email"])				? $row["email"]				: "";
			$this->renewal_date		= ($row["renewal_date"])		? $row["renewal_date"]		: ($this->renewal_date			? $this->renewal_date	: 0);
			$this->discount_id		= ($row["discount_id"])			? $row["discount_id"]		: "";
			$this->status			= ($row["status"])				? $row["status"]			: $statusObj->getDefaultStatus();
			$this->level			= ($row["level"])				? $row["level"]				: ($this->level					? $this->level			: $level->getDefaultLevel());
			$this->recurring		= ($row["recurring"])			? $row["recurring"]			: "";

			$this->maptuning			= ($row["maptuning"])			? $row["maptuning"]				: "";

		}

		function Save() {

			$this->prepareToSave();

			$dbObj = db_getDBObject();

			$this->friendly_url = strtolower($this->friendly_url);

			if ($this->id) {

				$sql  = "UPDATE Event SET"
					. " account_id        = $this->account_id,"
					. " title             = $this->title,"
					. " seo_title         = $this->seo_title,"
					. " friendly_url      = $this->friendly_url,"
					. " image_id          = $this->image_id,"
					. " thumb_id          = $this->thumb_id,"
					. " description       = $this->description,"
					. " description1      = $this->description1,"
					. " description2      = $this->description2,"
					. " description3      = $this->description3,"
					. " description4      = $this->description4,"
					. " seo_description   = $this->seo_description,"
					. " seo_description1  = $this->seo_description1,"
					. " seo_description2  = $this->seo_description2,"
					. " seo_description3  = $this->seo_description3,"
					. " seo_description4  = $this->seo_description4,"
					. " long_description  = $this->long_description,"
					. " long_description1 = $this->long_description1,"
					. " long_description2 = $this->long_description2,"
					. " long_description3 = $this->long_description3,"
					. " long_description4 = $this->long_description4,"
					. " keywords          = $this->keywords,"
					. " keywords1         = $this->keywords1,"
					. " keywords2         = $this->keywords2,"
					. " keywords3         = $this->keywords3,"
					. " keywords4         = $this->keywords4,"
					. " seo_keywords      = $this->seo_keywords,"
					. " seo_keywords1     = $this->seo_keywords1,"
					. " seo_keywords2     = $this->seo_keywords2,"
					. " seo_keywords3     = $this->seo_keywords3,"
					. " seo_keywords4     = $this->seo_keywords4,"
					. " updated           = NOW(),"
					. " start_date        = $this->start_date,"
					. " has_start_time    = $this->has_start_time,"
					. " start_time        = $this->start_time,"
					. " end_date          = $this->end_date,"
					. " has_end_time      = $this->has_end_time,"
					. " end_time          = $this->end_time,"
					. " location          = $this->location,"
					. " address           = $this->address,"
					. " zip_code          = $this->zip_code,"
					. " estado_id        = $this->estado_id,"
					. " cidade_id          = $this->cidade_id,"
					. " bairro_id         = $this->bairro_id,"
					. " city_id           = $this->city_id,"
					. " area_id           = $this->area_id,"
					. " url               = $this->url,"
					. " contact_name      = $this->contact_name,"
					. " phone             = $this->phone,"
					. " email             = $this->email,"
					. " renewal_date      = $this->renewal_date,"
					. " discount_id       = $this->discount_id,"
					. " status            = $this->status,"
					. " level             = $this->level,"
					. " recurring         = $this->recurring"
					. " WHERE id          = $this->id";

				$dbObj->query($sql);

			} else {

				$sql = "INSERT INTO Event"
					. " (account_id,"
					. " title,"
					. " seo_title,"
					. " friendly_url,"
					. " image_id,"
					. " thumb_id,"
					. " description,"
					. " description1,"
					. " description2,"
					. " description3,"
					. " description4,"
					. " seo_description,"
					. " seo_description1,"
					. " seo_description2,"
					. " seo_description3,"
					. " seo_description4,"
					. " long_description,"
					. " long_description1,"
					. " long_description2,"
					. " long_description3,"
					. " long_description4,"
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
					. " updated,"
					. " entered,"
					. " start_date,"
					. " has_start_time,"
					. " start_time,"
					. " end_date,"
					. " has_end_time,"
					. " end_time,"
					. " location,"
					. " address,"
					. " zip_code,"
					. " estado_id,"
					. " cidade_id,"
					. " bairro_id,"
					. " city_id,"
					. " area_id,"
					. " url,"
					. " contact_name,"
					. " phone,"
					. " email,"
					. " renewal_date,"
					. " discount_id,"
					. " status,"
					. " level,"
					. " fulltextsearch_keyword,"
					. " fulltextsearch_where,"
					. " recurring,"
					. " maptuning)"
					. " VALUES"
					. " ($this->account_id,"
					. " $this->title,"
					. " $this->title,"
					. " $this->friendly_url,"
					. " $this->image_id,"
					. " $this->thumb_id,"
					. " $this->description,"
					. " $this->description1,"
					. " $this->description2,"
					. " $this->description3,"
					. " $this->description4,"
					. " $this->description,"
					. " $this->description1,"
					. " $this->description2,"
					. " $this->description3,"
					. " $this->description4,"
					. " $this->long_description,"
					. " $this->long_description1,"
					. " $this->long_description2,"
					. " $this->long_description3,"
					. " $this->long_description4,"
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
					. " NOW(),"
					. " NOW(),"
					. " $this->start_date,"
					. " $this->has_start_time,"
					. " $this->start_time,"
					. " $this->end_date,"
					. " $this->has_end_time,"
					. " $this->end_time,"
					. " $this->location,"
					. " $this->address,"
					. " $this->zip_code,"
					. " $this->estado_id,"
					. " $this->cidade_id,"
					. " $this->bairro_id,"
					. " $this->city_id,"
					. " $this->area_id,"
					. " $this->url,"
					. " $this->contact_name,"
					. " $this->phone,"
					. " $this->email,"
					. " $this->renewal_date,"
					. " $this->discount_id,"
					. " $this->status,"
					. " $this->level,"
					. " '',"
					. " '',"
					. " $this->recurring,"
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
			$sql = "DELETE FROM Gallery_Item WHERE item_type = 'event' AND item_id = $this->id";
			$dbObj->query($sql);

			### IMAGE
			if ($this->image_id) {
				$image = new Image($this->image_id);
				if ($image) $image->Delete();
			}
			if ($this->thumb_id) {
				$image = new Image($this->thumb_id);
				if ($image) $image->Delete();
			}

			### INVOICE
			$sql = "UPDATE Invoice_Event SET event_id = '0' WHERE event_id = $this->id";
			$dbObj->query($sql);

			### PAYMENT
			$sql = "UPDATE Payment_Event_Log SET event_id = '0' WHERE event_id = $this->id";
			$dbObj->query($sql);

			### EVENT
			$sql = "DELETE FROM Event WHERE id = $this->id";
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
			$sql = "SELECT cat_1_id, cat_2_id, cat_3_id, cat_4_id, cat_5_id FROM Event WHERE id = $this->id";
			$r = $dbObj->query($sql);
			while ($row = mysql_fetch_array($r)) {
				if ($row["cat_1_id"]) $categories[] = new EventCategory($row["cat_1_id"]);
				if ($row["cat_2_id"]) $categories[] = new EventCategory($row["cat_2_id"]);
				if ($row["cat_3_id"]) $categories[] = new EventCategory($row["cat_3_id"]);
				if ($row["cat_4_id"]) $categories[] = new EventCategory($row["cat_4_id"]);
				if ($row["cat_5_id"]) $categories[] = new EventCategory($row["cat_5_id"]);
			}
			return $categories;
		}

		function setCategories($array) {
			$dbObj = db_getDBObject();
			$cat_1_id = 0;
			$parcat_1_level1_id = 0;
			$cat_2_id = 0;
			$parcat_2_level1_id = 0;
			$cat_3_id = 0;
			$parcat_3_level1_id = 0;
			$cat_4_id = 0;
			$parcat_4_level1_id = 0;
			$cat_5_id = 0;
			$parcat_5_level1_id = 0;
			if ($array) {
				$count_category_aux = 1;
				foreach ($array as $category) {
					if ($category) {
						unset($parents);
						$cat_id = $category;
						$i = 0;
						while ($cat_id != 0) {
							$sql = "SELECT * FROM EventCategory WHERE id = $cat_id";
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
			$sql = "UPDATE Event SET cat_1_id = ".$cat_1_id.", parcat_1_level1_id = ".$parcat_1_level1_id.", cat_2_id = ".$cat_2_id.", parcat_2_level1_id = ".$parcat_2_level1_id.", cat_3_id = ".$cat_3_id.", parcat_3_level1_id = ".$parcat_3_level1_id.", cat_4_id = ".$cat_4_id.", parcat_4_level1_id = ".$parcat_4_level1_id.", cat_5_id = ".$cat_5_id.", parcat_5_level1_id = ".$parcat_5_level1_id." WHERE id = $this->id";
			$dbObj->query($sql);
			$this->setFullTextSearch();
		}

		function getPrice() {

			$price = 0;

			$levelObj = new EventLevel();
			$price = $price + $levelObj->getPrice($this->level);

			if ($this->discount_id) {

				if (is_valid_discount_code($this->discount_id, "event", $this->id, $discount_message, $discount_error)) {

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
					$sql = "UPDATE Event SET discount_id = '' WHERE id = ".$this->id;
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

				$renewalcycle = payment_getRenewalCycle("event");
				$renewalunit = payment_getRenewalUnit("event");

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

		function getDateString() {
			$str_date = "";
			if ($this->getDate("start_date") == $this->getDate("end_date")) $str_date = $this->getDate("start_date");
			else $str_date = $this->getDate("start_date")." - ".$this->getDate("end_date");
			return $str_date;
		}

		function getTimeString() {
			$str_time = "";
			if ($this->getString("has_start_time") == "y") {
				$startTimeStr = explode(":", $this->getString("start_time"));
				if ($startTimeStr[0] > "12") {
					$start_time_hour = $startTimeStr[0] - 12;
					$start_time_am_pm = "pm";
				} elseif ($startTimeStr[0] == "12") {
					$start_time_hour = 12;
					$start_time_am_pm = "pm";
				} elseif ($startTimeStr[0] == "00") {
					$start_time_hour = 12;
					$start_time_am_pm = "am";
				} else {
					$start_time_hour = $startTimeStr[0];
					$start_time_am_pm = "am";
				}
				if ($start_time_hour < 10) $start_time_hour = "0".($start_time_hour+0);
				$start_time_min = $startTimeStr[1];
				$str_time .= $start_time_hour.":".$start_time_min." ".$start_time_am_pm;
			} else {
				$str_time .= "No Info";
			}
			$str_time .= " - ";
			if ($this->getString("has_end_time") == "y") {
				$endTimeStr = explode(":", $this->getString("end_time"));
				if ($endTimeStr[0] > "12") {
					$end_time_hour = $endTimeStr[0] - 12;
					$end_time_am_pm = "pm";
				} elseif ($endTimeStr[0] == "12") {
					$end_time_hour = 12;
					$end_time_am_pm = "pm";
				} elseif ($endTimeStr[0] == "00") {
					$end_time_hour = 12;
					$end_time_am_pm = "am";
				} else {
					$end_time_hour = $endTimeStr[0];
					$end_time_am_pm = "am";
				}
				if ($end_time_hour < 10) $end_time_hour = "0".($end_time_hour+0);
				$end_time_min = $endTimeStr[1];
				$str_time .= $end_time_hour.":".$end_time_min." ".$end_time_am_pm;
			} else {
				$str_time .= "No Info";
			}
			if (($this->getString("has_start_time") == "n") && ($this->getString("has_end_time") == "n")) {
				$str_time = "";
			}
			return $str_time;
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

			if ($this->location) {
				$fulltextsearch_where[] = $this->location;
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
						$sql = "SELECT * FROM EventCategory WHERE id = $category_id";
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

			if ($this->description) {
				$fulltextsearch_keyword[] = substr($this->description, 0, 100);
			}
			if ($this->description1) {
				$fulltextsearch_keyword[] = substr($this->description1, 0, 100);
			}
			if ($this->description2) {
				$fulltextsearch_keyword[] = substr($this->description2, 0, 100);
			}
			if ($this->description3) {
				$fulltextsearch_keyword[] = substr($this->description3, 0, 100);
			}
			if ($this->description4) {
				$fulltextsearch_keyword[] = substr($this->description4, 0, 100);
			}

			if (is_array($fulltextsearch_keyword)) {
				$fulltextsearch_keyword_sql = db_formatString(implode(" ", $fulltextsearch_keyword));
				$sql = "UPDATE Event SET fulltextsearch_keyword = $fulltextsearch_keyword_sql WHERE id = $this->id";
				$result = $dbObj->query($sql);
			}
			if (is_array($fulltextsearch_where)) {
				$fulltextsearch_where_sql = db_formatString(implode(" ", $fulltextsearch_where));
				$sql = "UPDATE Event SET fulltextsearch_where = $fulltextsearch_where_sql WHERE id = $this->id";
				$result = $dbObj->query($sql);
			}

		}

		function getGalleries() {
			$dbObj = db_getDBObject();
			$sql = "SELECT * FROM Gallery_Item WHERE item_type='event' AND item_id = $this->id ORDER BY gallery_id";
			$r = $dbObj->query($sql);
			if ($this->id > 0) while ($row = mysql_fetch_array($r)) $galleries[] = $row["gallery_id"];
			return $galleries;
		}

		function setGalleries($array = false) {
			$dbObj = db_getDBObject();
			$sql = "DELETE FROM Gallery_Item WHERE item_type='event' AND item_id = $this->id";
			$dbObj->query($sql);
			if ($array) {
				foreach ($array as $gallery) {
					if ($gallery) {
						$sql = "INSERT INTO Gallery_Item (item_id, gallery_id, item_type) VALUES ($this->id, $gallery, 'event')";
						$rs3 = $dbObj->query($sql);
					}
				}
			}
		}

		function setMapTuning($latitude_longitude="") {
			$dbObj = db_getDBObject();
			$sql = "UPDATE Event SET maptuning = ".db_formatString($latitude_longitude)." WHERE id = ".$this->id."";
			$dbObj->query($sql);
		}
        
        function hasDetail() {
            $eventLevel = new EventLevel();
            $detail = $eventLevel->getDetail($this->level);
            unset($eventLevel);
            return $detail;
        }

	}

?>
