<?php

	class Banner extends Handle {

		var $id;
		var $image_id;
		var $image_id1;
		var $image_id2;
		var $image_id3;
		var $image_id4;
		var $category_id;
		var $renewal_date;
		var $start_date;
		var $discount_id;
		var $updated;
		var $entered;
		var $destination_protocol;
		var $destination_url;
		var $display_url;
		var $caption;
		var $caption1;
		var $caption2;
		var $caption3;
		var $caption4;
		var $account_id;
		var $status; // see status class
		var $type;
		var $section;
		var $banner_types;
		var $target_window; // 1 = _SELF ; 2 = _BLANK
		var $content_line1;
		var $content_line11;
		var $content_line12;
		var $content_line13;
		var $content_line14;
		var $content_line2;
		var $content_line21;
		var $content_line22;
		var $content_line23;
		var $content_line24;
		var $unpaid_impressions;
		var $impressions;
		var $unlimited_impressions;
		var $expiration_setting;
		var $show_type;
		var $script;

		/**
		* Banner
		******************************************************/
		function Banner($var="") {

			$bannerLevelObj = new BannerLevel(EDIR_DEFAULT_LANGUAGE, true);
			$bannerLevelValue = $bannerLevelObj->getValues();
			foreach ($bannerLevelValue as $value) {
				$this->banner_types[$bannerLevelObj->showLevel($value)] = $value;
			}

			if (is_numeric($var) && ($var)) {
				$dbObj = db_getDBObject();
				$sql = "SELECT * FROM Banner WHERE id = $var";
				$row = mysql_fetch_array($dbObj->query($sql));
				$this->makeFromRow($row);
			} else {
				$this->makeFromRow($var);
			}

		}

		/**
		* makeFromRow
		******************************************************/
		function makeFromRow($row="") {

			$status = new ItemStatus();

			$this->discount_id				= ($row["discount_id"])				? $row["discount_id"]			: "";

			$this->entered					= ($row["entered"])					? $row["entered"]				: ($this->entered				? $this->entered				: "");
			$this->updated					= ($row["updated"])					? $row["updated"]				: ($this->updated				? $this->updated				: "");

			$this->id						= ($row["id"])						? $row["id"]					: ($this->id					? $this->id						: 0);
			$this->account_id				= ($row["account_id"])				? $row["account_id"]			: 0;
			$this->image_id					= ($row["image_id"])				? $row["image_id"]				: ($this->image_id				? $this->image_id				: 0);
			$this->image_id1				= ($row["image_id1"])				? $row["image_id1"]				: ($this->image_id1				? $this->image_id1				: 0);
			$this->image_id2				= ($row["image_id2"])				? $row["image_id2"]				: ($this->image_id2				? $this->image_id2				: 0);
			$this->image_id3				= ($row["image_id3"])				? $row["image_id3"]				: ($this->image_id3				? $this->image_id3				: 0);
			$this->image_id4				= ($row["image_id4"])				? $row["image_id4"]				: ($this->image_id4				? $this->image_id4				: 0);
			$this->category_id				= ($row["category_id"])				? $row["category_id"]			: 0;
			$this->renewal_date				= ($row["renewal_date"])			? $row["renewal_date"]			: ($this->renewal_date			? $this->renewal_date			: 0);
			$this->start_date				= ($row["start_date"])				? $row["start_date"]			: ($this->start_date			? $this->start_date			: 0);
			$this->destination_url			= ($row["destination_url"])			? $row["destination_url"]		: "";
			$this->display_url				= ($row["display_url"])				? $row["display_url"]			: "";
			$this->destination_protocol		= ($row["destination_protocol"])	? $row["destination_protocol"]	: "";
			$this->caption					= ($row["caption"])					? $row["caption"]				: "";
			$this->caption1					= ($row["caption1"])				? $row["caption1"]				: "";
			$this->caption2					= ($row["caption2"])				? $row["caption2"]				: "";
			$this->caption3					= ($row["caption3"])				? $row["caption3"]				: "";
			$this->caption4					= ($row["caption4"])				? $row["caption4"]				: "";
			$this->status					= ($row["status"])					? $row["status"]				: ($this->status				? $this->status					: $status->getDefaultStatus());
			$this->type						= ($row["type"])					? $row["type"]					: ($this->type					? $this->type					: 0);
			$this->section					= ($row["section"])					? $row["section"]				: ($this->section				? $this->section				: "general");
			$this->target_window			= ($row["target_window"])			? $row["target_window"]			: 2;
			$this->content_line1			= ($row["content_line1"])			? $row["content_line1"]			: "";
			$this->content_line11			= ($row["content_line11"])			? $row["content_line11"]		: "";
			$this->content_line12			= ($row["content_line12"])			? $row["content_line12"]		: "";
			$this->content_line13			= ($row["content_line13"])			? $row["content_line13"]		: "";
			$this->content_line14			= ($row["content_line14"])			? $row["content_line14"]		: "";
			$this->content_line2			= ($row["content_line2"])			? $row["content_line2"]			: "";
			$this->content_line21			= ($row["content_line21"])			? $row["content_line21"]		: "";
			$this->content_line22			= ($row["content_line22"])			? $row["content_line22"]		: "";
			$this->content_line23			= ($row["content_line23"])			? $row["content_line23"]		: "";
			$this->content_line24			= ($row["content_line24"])			? $row["content_line24"]		: "";
			$this->unpaid_impressions		= ($row["unpaid_impressions"])		? $row["unpaid_impressions"]	: ($this->unpaid_impressions	? $this->unpaid_impressions		: 0);
			$this->impressions				= ($row["impressions"])				? $row["impressions"]			: ($this->impressions			? $this->impressions			: 0);
			$this->unlimited_impressions	= ($row["unlimited_impressions"])	? $row["unlimited_impressions"]	: ($this->unlimited_impressions	? $this->unlimited_impressions	: "n");
			$this->expiration_setting		= ($row["expiration_setting"])		? $row["expiration_setting"]	: 0;
			$this->show_type				= ($row["show_type"])				? $row["show_type"]				: 0;
			$this->script					= ($row["script"])					? $row["script"]				: "";

		}

		/**
		* Save
		******************************************************/
		function Save() {
			$this->prepareToSave();
			if ($this->id) {
				$dbObj = db_getDBObject();
				$sql  = "UPDATE Banner SET"
					. " account_id				= $this->account_id,"
					. " image_id				= $this->image_id,"
					. " image_id1				= $this->image_id1,"
					. " image_id2				= $this->image_id2,"
					. " image_id3				= $this->image_id3,"
					. " image_id4				= $this->image_id4,"
					. " category_id				= $this->category_id,"
					. " renewal_date			= $this->renewal_date,"
					. " start_date				= $this->start_date,"
					. " discount_id				= $this->discount_id,"
					. " updated					= $this->updated,"
					. " destination_url			= $this->destination_url,"
					. " display_url				= $this->display_url,"
					. " destination_protocol	= $this->destination_protocol,"
					. " caption					= $this->caption,"
					. " caption1				= $this->caption1,"
					. " caption2				= $this->caption2,"
					. " caption3				= $this->caption3,"
					. " caption4				= $this->caption4,"
					. " status					= $this->status,"
					. " type					= $this->type,"
					. " section					= $this->section,"
					. " target_window			= $this->target_window,"
					. " content_line1			= $this->content_line1,"
					. " content_line11			= $this->content_line11,"
					. " content_line12			= $this->content_line12,"
					. " content_line13			= $this->content_line13,"
					. " content_line14			= $this->content_line14,"
					. " content_line2			= $this->content_line2,"
					. " content_line21			= $this->content_line21,"
					. " content_line22			= $this->content_line22,"
					. " content_line23			= $this->content_line23,"
					. " content_line24			= $this->content_line24,"
					. " unpaid_impressions		= $this->unpaid_impressions,"
					. " impressions				= $this->impressions,"
					. " unlimited_impressions	= $this->unlimited_impressions,"
					. " show_type				= $this->show_type,"
					. " script					= $this->script,"
					. " expiration_setting		= $this->expiration_setting"
					. " WHERE id				= $this->id";
				$dbObj->query($sql);
			} else {
				$dbObj = db_getDBObject();
				$sql = "INSERT INTO Banner"
					. " (account_id,"
					. " image_id,"
					. " image_id1,"
					. " image_id2,"
					. " image_id3,"
					. " image_id4,"
					. " category_id,"
					. " renewal_date,"
					. " start_date,"
					. " discount_id,"
					. " updated,"
					. " entered,"
					. " destination_url, "
					. " display_url, "
					. " destination_protocol, "
					. " caption,"
					. " caption1,"
					. " caption2,"
					. " caption3,"
					. " caption4,"
					. " status,"
					. " target_window,"
					. " content_line1,"
					. " content_line11,"
					. " content_line12,"
					. " content_line13,"
					. " content_line14,"
					. " content_line2,"
					. " content_line21,"
					. " content_line22,"
					. " content_line23,"
					. " content_line24,"
					. " unpaid_impressions,"
					. " impressions,"
					. " unlimited_impressions,"
					. " expiration_setting,"
					. " section,"
					. " show_type,"
					. " script,"
					. " type)"
					. " VALUES"
					. " ($this->account_id,"
					. " $this->image_id,"
					. " $this->image_id1,"
					. " $this->image_id2,"
					. " $this->image_id3,"
					. " $this->image_id4,"
					. " $this->category_id,"
					. " $this->renewal_date,"
					. " $this->start_date,"
					. " $this->discount_id,"
					. " NOW(),"
					. " NOW(),"
					. " $this->destination_url,"
					. " $this->display_url,"
					. " $this->destination_protocol,"
					. " $this->caption,"
					. " $this->caption1,"
					. " $this->caption2,"
					. " $this->caption3,"
					. " $this->caption4,"
					. " $this->status,"
					. " $this->target_window,"
					. " $this->content_line1,"
					. " $this->content_line11,"
					. " $this->content_line12,"
					. " $this->content_line13,"
					. " $this->content_line14,"
					. " $this->content_line2,"
					. " $this->content_line21,"
					. " $this->content_line22,"
					. " $this->content_line23,"
					. " $this->content_line24,"
					. " $this->unpaid_impressions,"
					. " $this->impressions,"
					. " $this->unlimited_impressions,"
					. " $this->expiration_setting,"
					. " $this->section,"
					. " $this->show_type,"
					. " $this->script,"
					. " $this->type)";
				$dbObj->query($sql);
				$this->id = mysql_insert_id($dbObj->link_id);
			}
			$this->prepareToUse();
		}

		/**
		* Delete
		******************************************************/
		function Delete() {

			$dbObj = db_getDBObject();

			### IMAGE
			$imageObj = new Image($this->image_id);
			$imageObj->Delete();
			$imageObj = new Image($this->image_id1);
			$imageObj->Delete();
			$imageObj = new Image($this->image_id2);
			$imageObj->Delete();
			$imageObj = new Image($this->image_id3);
			$imageObj->Delete();
			$imageObj = new Image($this->image_id4);
			$imageObj->Delete();

			### INVOICE
			$sql = "UPDATE Invoice_Banner SET banner_id = '0' WHERE banner_id = $this->id";
			$dbObj->query($sql);

			### PAYMENT
			$sql = "UPDATE Payment_Banner_Log SET banner_id = '0' WHERE banner_id = $this->id";
			$dbObj->query($sql);

			### BANNER
			$sql = "DELETE FROM Banner WHERE id = $this->id";
			$dbObj->query($sql);

		}

		/**
		* retrieveHumanReadableType
		******************************************************/
		function retrieveHumanReadableType($type){
            $levelObj = new BannerLevel(EDIR_DEFAULT_LANGUAGE, true);
			foreach($this->banner_types as $key => $value){
				if($value == $type)
				    $hrtype = ucwords($levelObj->getDisplayName($value));
			}
            unset($levelObj);            
			return $hrtype;
		}

		/**
		* retrieveType
		******************************************************/
		function retrieveType($type){
			foreach($this->banner_types as $key => $value){
				if($value == $type) return $key;
			}
		}

		/**
		* retrieve
		******************************************************/
		function retrieve($id){
			$sql = "SELECT * FROM Banner WHERE id = $id";
			$dbObj = db_getDBObject();
			$result = $dbObj->query($sql);
			$data = mysql_fetch_assoc($result);
			return $data;
		}

		/**
		* randomRetrieve
		******************************************************/
		function randomRetrieve($type = false, $category_id = false, $banner_section = "general", $amount = 1) {

			if (!$banner_section) $banner_section = "general";

			if (!$type) return false;

			$sql = "SELECT * FROM Banner WHERE status = 'A' and start_date < NOW()";

			$sql .= "AND (expiration_setting = '".BANNER_EXPIRATION_RENEWAL_DATE."' OR (expiration_setting = '".BANNER_EXPIRATION_IMPRESSION."' AND impressions > 0) OR (expiration_setting = '".BANNER_EXPIRATION_IMPRESSION."' AND unlimited_impressions = 'y'))";

			if ($type && is_numeric($type)) $sql .= " AND type = $type";

			$sql .= " AND section = ".db_formatString($banner_section)."";

			if ($banner_section != "general") {
				if ((strpos($category_id, "x") === false) && (strpos($category_id, ".") === false)) {
					if ($category_id && is_numeric($category_id)) {
						$catList = substr(getTreePath($category_id, $banner_section), 1);
						$catList .= $catList.",".substr(getSubTree($category_id, $banner_section), 1);
						$sql .= " AND (category_id IN (".$catList."))";
					} elseif ($category_id && is_array($category_id)) {
						$sql .= " AND (category_id IN (".implode(",", $category_id)."))";
					} else {
						$sql .= " AND (category_id = 0 OR category_id IS NULL)";
					}
				}
			}

			$sql.= " ORDER BY ".((BANNER_SCALABILITY_OPTIMIZATION == "on")?("random_number DESC"):("RAND()"))." LIMIT $amount";

			$dbObj = db_getDBObject();
			$result = $dbObj->query($sql);
		
			while ($row = mysql_fetch_assoc($result)) {
				$data[] = $row;
					
			}

			return $data;

		}

		/**
		* makeBanner
		******************************************************/
		function makeBanner($banner, $lang=EDIR_LANGUAGE) {

			$langIndex = language_getIndex($lang);

			if (!$banner) return "";

			// if calling only one banner by id it needs to be a multidimensional array.
			if (array_key_exists("type", $banner)) {
				$aux = $banner;
				unset($banner);
				$banner[0] = $aux;
			}

			foreach ($banner as $each_banner) {

				$bannerLevelObj = new BannerLevel();
				$each_banner["width"] = $bannerLevelObj->getWidth($each_banner["type"]);
				$each_banner["height"] = $bannerLevelObj->getHeight($each_banner["type"]);

				if ($each_banner["show_type"] == 1) {

					$banner_content .= "<div style=\"width: {$each_banner["width"]}px; height: {$each_banner["height"]}px; overflow: auto;\">".$each_banner["script"]."</div>";

				} else {

					if ($each_banner["image_id".$langIndex]) $imageObj = new Image($each_banner["image_id".$langIndex]);
					else $imageObj = new Image($each_banner["image_id"]);
					$image_name = "photo_".$imageObj->GetString("id").".".strtolower($imageObj->GetString("type"));

					$full_destination_url = (!$each_banner["destination_url"] || (sess_isAccountLogged(true) || sess_isSitemgrLogged(true))) ? "javascript:void(0);" : NON_SECURE_URL."/banner_reports.php?id=".$each_banner["id"];

					if ($each_banner["target_window"] == 1 || !$each_banner["destination_url"] || (sess_isAccountLogged() || sess_isSitemgrLogged())) {
						$target_window = "_self";
					} else if ($each_banner["target_window"] == 2) {
						$target_window = "_blank";
					}

					if ($each_banner["type"] >= 50) { // text ads
                                                       echo "1";
						$banner_content .= "<a href=\"".$each_banner["destination_url"]."\" target=\"$target_window\" class=\"sponsoredLink\" style=\"width: ".$each_banner["width"]."px; height: ".$each_banner["height"]."; ".((eregi("banner_reports.php",$full_destination_url)) ? "cursor: pointer;" : "cursor: default;")."\">"
								."<span class=\"sponsoredLinkTitle\">".$each_banner["caption".$langIndex]."</span>\n"
								."<span class=\"sponsoredLinkContent\">".$each_banner["content_line1".$langIndex]."</span>\n"
								."<span class=\"sponsoredLinkContent\">".$each_banner["content_line2".$langIndex]."</span>\n";

						if ((strlen($each_banner["destination_url"]) > 1) && (strlen($each_banner["display_url"]) > 1)){
							$banner_content .= "<span class=\"sponsoredLinkURL\">".((strlen($each_banner["display_url"]) > 27) ? substr($each_banner["display_url"], 0 ,27)."..." : $each_banner["display_url"])."</span>\n";
						} elseif (strlen($each_banner["destination_url"]) > 1) {
							$banner_content .= "<span class=\"sponsoredLinkURL\">".((strlen($each_banner["destination_url"]) > 27) ? substr($each_banner["destination_url"], 0, 27)."..." : $each_banner["destination_url"])."</span>\n";
						}

						$banner_content .= "</a>";

					} else if ($each_banner["type"] < 50) { // image ads

						if(strtolower($imageObj->getString("type")) != "swf") { // jpg or gif ad

							if ($imageObj->imageExists()) {

								$banner_content .= "<a href=\"http://".$each_banner["destination_url"]."\" target=\"$target_window\" style=\"".((eregi("banner_reports.php",$full_destination_url)) ? "cursor: pointer;" : "cursor: default;")."\"><img src=\"".DEFAULT_URL."/custom/image_files/$image_name\" border=\"0\" width=\"{$each_banner["width"]}\" height=\"{$each_banner["height"]}\" title=\"{$each_banner["caption".$langIndex]}\" alt=\"{$each_banner["caption".$langIndex]}\" /></a>";

							} else {
                                $banner_content .= "<a href=\"http://".$each_banner["destination_url"]."\" target=\"$target_window\" class=\"noimage\" style=\"text-decoration: none; display: block; width: {$each_banner["width"]}px; height: {$each_banner["height"]}px; ".((eregi("banner_reports.php",$full_destination_url)) ? "cursor: pointer;" : "cursor: default;")."\" title=\"{$each_banner["caption".$langIndex]}\">&nbsp;</a>";

							}

						} else { // flash ad

							if ($imageObj->imageExists()) {

								$banner_content .= "<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\""
										."codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0\""
										."width=\"{$each_banner["width"]}\" height=\"{$each_banner["height"]}\">\n"
										."<param name=Flashvars value=\"selection=0\">\n"
										."<param name=\"menu\" value=\"false\">\n"
										."<param name=\"movie\" value=\"".IMAGE_URL."/$image_name\">\n"
										."<param name=\"quality\" value=\"high\">\n"
										."<embed src=\"".IMAGE_URL."/$image_name\" menu=\"false\" value=\"selection=0\" quality=\"high\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" type=\"application/x-shockwave-flash\" width=\"{$each_banner["width"]}\" height=\"{$each_banner["height"]}\"></embed>\n"
										."</object>\n";

							} else {
								$banner_content .= "<a href=\"http://".$each_banner["destination_url"]."\" target=\"$target_window\" class=\"noimage\" style=\"text-decoration: none; display: block; width: {$each_banner["width"]}px; height: {$each_banner["height"]}px; ".((eregi("banner_reports.php",$full_destination_url)) ? "cursor: pointer;" : "cursor: default;")."\" title=\"{$each_banner["caption".$langIndex]}\">&nbsp;</a>";
							}

						}

					}

				}

			}

			$html = "";
			if ($banner_content) {
				$html = $banner_content;
			}

			return $html;

		}

		function getPrice($disable_unpaid = false) {

			$price = 0;

			$levelObj = new BannerLevel();
			$price += $levelObj->getPrice($this->type, $this->expiration_setting);

			if (!$disable_unpaid) {
				if ($this->expiration_setting == BANNER_EXPIRATION_IMPRESSION) {
					$price *= $this->unpaid_impressions / $levelObj->getImpressionBlock($this->type);
				}
			}

			if ($this->discount_id) {

				if (is_valid_discount_code($this->discount_id, "banner", $this->id, $discount_message, $discount_error)) {

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
					$sql = "UPDATE Banner SET discount_id = '' WHERE id = ".$this->id;
					$result = $dbObj->query($sql);

				}

			}

			if ($price <= 0) $price = 0;

			return $price;

		}

		function hasRenewalDate() {
			if (PAYMENT_FEATURE != "on") return false;
			if ((CREDITCARDPAYMENT_FEATURE != "on") && (INVOICEPAYMENT_FEATURE != "on") && (MANUALPAYMENT_FEATURE != "on")) return false;
			if ($this->expiration_setting != BANNER_EXPIRATION_RENEWAL_DATE) return false;
			if ($this->getPrice() <= 0) return false;
			return true;
		}

		function hasImpressions() {
			if (PAYMENT_FEATURE != "on") return false;
			if ((CREDITCARDPAYMENT_FEATURE != "on") && (INVOICEPAYMENT_FEATURE != "on") && (MANUALPAYMENT_FEATURE != "on")) return false;
			if ($this->expiration_setting != BANNER_EXPIRATION_IMPRESSION) return false;
			if ($this->getPrice($disable_unpaid = true) <= 0) return false;
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

			if ($this->hasImpressions()) {

				if ($this->unpaid_impressions > 0) {
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

				$renewalcycle = payment_getRenewalCycle("banner");
				$renewalunit = payment_getRenewalUnit("banner");

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

	}

?>
