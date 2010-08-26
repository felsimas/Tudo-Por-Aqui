<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classes/class_article.php
	# ----------------------------------------------------------------------------------------------------

	class Article extends Handle {

		var $id;
		var $account_id;
		var $image_id;
		var $thumb_id;
		var $updated;
		var $entered;
		var $renewal_date;
		var $discount_id;
		var $title;
		var $seo_title;
		var $friendly_url;
		var $author;
		var $author_url;
		var $publication_date;
		var $image_attribute;
		var $image_caption;
		var $abstract;
		var $abstract1;
		var $abstract2;
		var $abstract3;
		var $abstract4;
		var $seo_abstract;
		var $seo_abstract1;
		var $seo_abstract2;
		var $seo_abstract3;
		var $seo_abstract4;
		var $content;
		var $content1;
		var $content2;
		var $content3;
		var $content4;
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
		var $status;
		var $level;

		function Article($var="") {
			if (is_numeric($var) && ($var)) {
				$db = db_getDBObject();
				$sql = "SELECT * FROM Article WHERE id = $var";
				$row = mysql_fetch_array($db->query($sql));
				$this->makeFromRow($row);
			} else {
				$this->makeFromRow($var);
			}
		}

		function makeFromRow($row="") {

			$status = new ItemStatus();
			$level = new ArticleLevel();

			$this->id				= ($row["id"])					? $row["id"]				: ($this->id					? $this->id				: 0);
			$this->account_id		= ($row["account_id"])			? $row["account_id"]		: 0;
			$this->image_id			= ($row["image_id"])			? $row["image_id"]			: ($this->image_id				? $this->image_id		: 0);
			$this->thumb_id			= ($row["thumb_id"])			? $row["thumb_id"]			: ($this->thumb_id				? $this->thumb_id		: 0);
			$this->updated			= ($row["updated"])				? $row["updated"]			: ($this->updated				? $this->updated		: "");
			$this->entered			= ($row["entered"])				? $row["entered"]			: ($this->entered				? $this->entered		: "");
			$this->renewal_date		= ($row["renewal_date"])		? $row["renewal_date"]		: ($this->renewal_date			? $this->renewal_date	: 0);
			$this->discount_id		= ($row["discount_id"])			? $row["discount_id"]		: "";
			$this->title			= ($row["title"])				? $row["title"]				: ($this->title					? $this->title			: "");
			$this->seo_title		= ($row["seo_title"])			? $row["seo_title"]			: ($this->seo_title				? $this->seo_title		: "");
			$this->friendly_url		= ($row["friendly_url"])		? $row["friendly_url"]		: "";
			$this->author			= ($row["author"])				? $row["author"]			: "";
			$this->author_url		= ($row["author_url"])			? $row["author_url"]		: "";
			$this->publication_date	= ($row["publication_date"])	? $row["publication_date"]	: 0;
			$this->image_attribute	= ($row["image_attribute"])		? $row["image_attribute"]	: "";
			$this->image_caption	= ($row["image_caption"])		? $row["image_caption"]		: "";
			$this->abstract			= ($row["abstract"])			? $row["abstract"]			: "";
			$this->abstract1		= ($row["abstract1"])			? $row["abstract1"]			: "";
			$this->abstract2		= ($row["abstract2"])			? $row["abstract2"]			: "";
			$this->abstract3		= ($row["abstract3"])			? $row["abstract3"]			: "";
			$this->abstract4		= ($row["abstract4"])			? $row["abstract4"]			: "";
			$this->seo_abstract		= ($row["seo_abstract"])		? $row["seo_abstract"]		: ($this->seo_abstract	? $this->seo_abstract	: "");
			$this->seo_abstract1	= ($row["seo_abstract1"])		? $row["seo_abstract1"]		: ($this->seo_abstract1	? $this->seo_abstract1	: "");
			$this->seo_abstract2	= ($row["seo_abstract2"])		? $row["seo_abstract2"]		: ($this->seo_abstract2	? $this->seo_abstract2	: "");
			$this->seo_abstract3	= ($row["seo_abstract3"])		? $row["seo_abstract3"]		: ($this->seo_abstract3	? $this->seo_abstract3	: "");
			$this->seo_abstract4	= ($row["seo_abstract4"])		? $row["seo_abstract4"]		: ($this->seo_abstract4	? $this->seo_abstract4	: "");
			$this->content			= ($row["content"])				? $row["content"]			: "";
			$this->content1			= ($row["content1"])			? $row["content1"]			: "";
			$this->content2			= ($row["content2"])			? $row["content2"]			: "";
			$this->content3			= ($row["content3"])			? $row["content3"]			: "";
			$this->content4			= ($row["content4"])			? $row["content4"]			: "";
			$this->keywords			= ($row["keywords"])			? $row["keywords"]			: "";
			$this->keywords1		= ($row["keywords1"])			? $row["keywords1"]			: "";
			$this->keywords2		= ($row["keywords2"])			? $row["keywords2"]			: "";
			$this->keywords3		= ($row["keywords3"])			? $row["keywords3"]			: "";
			$this->keywords4		= ($row["keywords4"])			? $row["keywords4"]			: "";
			$this->seo_keywords		= ($row["seo_keywords"])		? $row["seo_keywords"]		: ($this->seo_keywords			? $this->seo_keywords		: "");
			$this->seo_keywords1	= ($row["seo_keywords1"])		? $row["seo_keywords1"]		: ($this->seo_keywords1			? $this->seo_keywords1		: "");
			$this->seo_keywords2	= ($row["seo_keywords2"])		? $row["seo_keywords2"]		: ($this->seo_keywords2			? $this->seo_keywords2		: "");
			$this->seo_keywords3	= ($row["seo_keywords3"])		? $row["seo_keywords3"]		: ($this->seo_keywords3			? $this->seo_keywords3		: "");
			$this->seo_keywords4	= ($row["seo_keywords4"])		? $row["seo_keywords4"]		: ($this->seo_keywords4			? $this->seo_keywords4		: "");
			$this->status			= ($row["status"])				? $row["status"]			: $status->getDefaultStatus();
			$this->level			= ($row["level"])				? $row["level"]				: ($this->level					? $this->level			: $level->getDefaultLevel());

		}

		function Save() {

			$this->prepareToSave();

			$dbObj = db_getDBObject();

			$this->friendly_url = strtolower($this->friendly_url);

			if ($this->id) {

				$sql = "UPDATE Article SET"
					. " account_id       = $this->account_id,"
					. " image_id         = $this->image_id,"
					. " thumb_id         = $this->thumb_id,"
					. " updated          = NOW(),"
					. " renewal_date     = $this->renewal_date,"
					. " discount_id      = $this->discount_id,"
					. " title            = $this->title,"
					. " seo_title        = $this->seo_title,"
					. " friendly_url     = $this->friendly_url,"
					. " author           = $this->author,"
					. " author_url       = $this->author_url,"
					. " publication_date = $this->publication_date,"
					. " image_attribute  = $this->image_attribute,"
					. " image_caption    = $this->image_caption,"
					. " abstract         = $this->abstract,"
					. " abstract1        = $this->abstract1,"
					. " abstract2        = $this->abstract2,"
					. " abstract3        = $this->abstract3,"
					. " abstract4        = $this->abstract4,"
					. " seo_abstract     = $this->seo_abstract,"
					. " seo_abstract1    = $this->seo_abstract1,"
					. " seo_abstract2    = $this->seo_abstract2,"
					. " seo_abstract3    = $this->seo_abstract3,"
					. " seo_abstract4    = $this->seo_abstract4,"
					. " content          = $this->content,"
					. " content1         = $this->content1,"
					. " content2         = $this->content2,"
					. " content3         = $this->content3,"
					. " content4         = $this->content4,"
					. " keywords         = $this->keywords,"
					. " keywords1        = $this->keywords1,"
					. " keywords2        = $this->keywords2,"
					. " keywords3        = $this->keywords3,"
					. " keywords4        = $this->keywords4,"
					. " seo_keywords     = $this->seo_keywords,"
					. " seo_keywords1    = $this->seo_keywords1,"
					. " seo_keywords2    = $this->seo_keywords2,"
					. " seo_keywords3    = $this->seo_keywords3,"
					. " seo_keywords4    = $this->seo_keywords4,"
					. " status           = $this->status,"
					. " level            = $this->level"
					. " WHERE id         = $this->id";

				$dbObj->query($sql);

			} else {

				$sql = "INSERT INTO Article"
					. " (account_id,"
					. " image_id,"
					. " thumb_id,"
					. " updated,"
					. " entered,"
					. " renewal_date,"
					. " discount_id,"
					. " title,"
					. " seo_title,"
					. " friendly_url,"
					. " author,"
					. " author_url,"
					. " publication_date,"
					. " image_attribute,"
					. " image_caption,"
					. " abstract,"
					. " abstract1,"
					. " abstract2,"
					. " abstract3,"
					. " abstract4,"
					. " seo_abstract,"
					. " seo_abstract1,"
					. " seo_abstract2,"
					. " seo_abstract3,"
					. " seo_abstract4,"
					. " content,"
					. " content1,"
					. " content2,"
					. " content3,"
					. " content4,"
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
					. " status,"
					. " level)"
					. " VALUES"
					. " ($this->account_id,"
					. " $this->image_id,"
					. " $this->thumb_id,"
					. " NOW(),"
					. " NOW(),"
					. " $this->renewal_date,"
					. " $this->discount_id,"
					. " $this->title,"
					. " $this->title,"
					. " $this->friendly_url,"
					. " $this->author,"
					. " $this->author_url,"
					. " $this->publication_date,"
					. " $this->image_attribute,"
					. " $this->image_caption,"
					. " $this->abstract,"
					. " $this->abstract1,"
					. " $this->abstract2,"
					. " $this->abstract3,"
					. " $this->abstract4,"
					. " $this->abstract,"
					. " $this->abstract1,"
					. " $this->abstract2,"
					. " $this->abstract3,"
					. " $this->abstract4,"
					. " $this->content,"
					. " $this->content1,"
					. " $this->content2,"
					. " $this->content3,"
					. " $this->content4,"
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
					. " $this->status,"
					. " $this->level)";

				$dbObj->query($sql);

				$this->id = mysql_insert_id($dbObj->link_id);

			}

			$this->prepareToUse();

			$this->setFullTextSearch();

		}

		function Delete() {

			$dbObj = db_getDBObJect();
			
			### REVIEWS
			$sql = "SELECT id FROM Review WHERE item_type='article' AND item_id= $this->id";
			$result = $dbObj->query($sql);
			while ($row = mysql_fetch_assoc($result)) {
				$reviewObj = new Review($row["id"]);
				$reviewObj->Delete();
			}

			### GALERY
			$sql = "DELETE FROM Gallery_Item WHERE item_type = 'article' AND item_id = $this->id";
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
			$sql = "UPDATE Invoice_Article SET article_id = '0' WHERE article_id = $this->id";
			$dbObj->query($sql);

			### PAYMENT
			$sql = "UPDATE Payment_Article_Log SET article_id = '0' WHERE article_id = $this->id";
			$dbObj->query($sql);

			### ARTICLE
			$sql = "DELETE FROM Article WHERE id = $this->id";
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
			$sql = "SELECT cat_1_id, cat_2_id, cat_3_id, cat_4_id, cat_5_id FROM Article WHERE id = $this->id";
			$r = $dbObj->query($sql);
			while ($row = mysql_fetch_array($r)) {
				if ($row["cat_1_id"]) $categories[] = new ArticleCategory($row["cat_1_id"]);
				if ($row["cat_2_id"]) $categories[] = new ArticleCategory($row["cat_2_id"]);
				if ($row["cat_3_id"]) $categories[] = new ArticleCategory($row["cat_3_id"]);
				if ($row["cat_4_id"]) $categories[] = new ArticleCategory($row["cat_4_id"]);
				if ($row["cat_5_id"]) $categories[] = new ArticleCategory($row["cat_5_id"]);
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
							$sql = "SELECT * FROM ArticleCategory WHERE id = $cat_id";
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
			$sql = "UPDATE Article SET cat_1_id = ".$cat_1_id.", parcat_1_level1_id = ".$parcat_1_level1_id.", cat_2_id = ".$cat_2_id.", parcat_2_level1_id = ".$parcat_2_level1_id.", cat_3_id = ".$cat_3_id.", parcat_3_level1_id = ".$parcat_3_level1_id.", cat_4_id = ".$cat_4_id.", parcat_4_level1_id = ".$parcat_4_level1_id.", cat_5_id = ".$cat_5_id.", parcat_5_level1_id = ".$parcat_5_level1_id." WHERE id = $this->id";
			$dbObj->query($sql);
			$this->setFullTextSearch();
		}

		function getPrice() {

			$price = 0;

			$levelObj = new ArticleLevel();
			$price = $price + $levelObj->getPrice($this->level);

			if ($this->discount_id) {

				if (is_valid_discount_code($this->discount_id, "article", $this->id, $discount_message, $discount_error)) {

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
					$sql = "UPDATE Article SET discount_id = '' WHERE id = ".$this->id;
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

				$renewalcycle = payment_getRenewalCycle("article");
				$renewalunit = payment_getRenewalUnit("article");

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

			if ($this->author) {
				$fulltextsearch_keyword[] = $this->author;
			}

			$categories = $this->getCategories();
			if ($categories) {
				foreach ($categories as $category) {
					unset($parents);
					$category_id = $category->getNumber("id");
					while ($category_id != 0) {
						$sql = "SELECT * FROM ArticleCategory WHERE id = $category_id";
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

			if ($this->abstract) {
				$fulltextsearch_keyword[] = substr($this->abstract, 0, 100);
			}
			if ($this->abstract1) {
				$fulltextsearch_keyword[] = substr($this->abstract1, 0, 100);
			}
			if ($this->abstract2) {
				$fulltextsearch_keyword[] = substr($this->abstract2, 0, 100);
			}
			if ($this->abstract3) {
				$fulltextsearch_keyword[] = substr($this->abstract3, 0, 100);
			}
			if ($this->abstract4) {
				$fulltextsearch_keyword[] = substr($this->abstract4, 0, 100);
			}

			if (is_array($fulltextsearch_keyword)) {
				$fulltextsearch_keyword_sql = db_formatString(implode(" ", $fulltextsearch_keyword));
				$sql = "UPDATE Article SET fulltextsearch_keyword = $fulltextsearch_keyword_sql WHERE id = $this->id";
				$result = $dbObj->query($sql);
			}
			if (is_array($fulltextsearch_where)) {
				$fulltextsearch_where_sql = db_formatString(implode(" ", $fulltextsearch_where));
				$sql = "UPDATE Article SET fulltextsearch_where = $fulltextsearch_where_sql WHERE id = $this->id";
				$result = $dbObj->query($sql);
			}

		}

		function getGalleries() {
			$dbObj = db_getDBObject();
			$sql = "SELECT * FROM Gallery_Item WHERE item_type='article' AND item_id = $this->id ORDER BY gallery_id";
			$r = $dbObj->query($sql);
			if ($this->id > 0) while ($row = mysql_fetch_array($r)) $galleries[] = $row["gallery_id"];
			return $galleries;
		}

		function setGalleries($array = false) {
			$dbObj = db_getDBObject();
			$sql = "DELETE FROM Gallery_Item WHERE item_type='article' AND item_id = $this->id";
			$dbObj->query($sql);
			if ($array) {
				foreach ($array as $gallery) {
					if ($gallery) {
						$sql = "INSERT INTO Gallery_Item (item_id, gallery_id, item_type) VALUES ($this->id, $gallery, 'article')";
						$rs3 = $dbObj->query($sql);
					}
				}
			}
		}

	}

?>
