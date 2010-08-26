<?


	class Listing extends Handle {

		var $id;
		var $account_id;
		var $image_id;
		var $thumb_id;
		var $promotion_id;
		var $estado_id;
		var $cidade_id;
		var $bairro_id;
		var $city_id;
		var $area_id;
		var $renewal_date;
		var $discount_id;
		var $reminder;
		var $updated;
		var $entered;
		var $title;
		var $razaosocial;
        	var $cnpj;
		var $seo_title;
		var $claim_disable;
		var $friendly_url;
		var $email;
		var $url;
		var $display_url;
		var $address;
		var $address2;
		var $zip_code;
		var $phone;
        var $phone2;
        var $celular;
		var $fax;
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
		var $video_snippet;
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
		var $attachment_file;
		var $attachment_caption;
		var $status;
		var $level;
		var $locations;
		var $hours_work;
		var $listingtemplate_id;
		var $custom_text0;
		var $custom_text1;
		var $custom_text2;
		var $custom_text3;
		var $custom_text4;
		var $custom_text5;
		var $custom_text6;
		var $custom_text7;
		var $custom_text8;
		var $custom_text9;
		var $custom_short_desc0;
		var $custom_short_desc1;
		var $custom_short_desc2;
		var $custom_short_desc3;
		var $custom_short_desc4;
		var $custom_short_desc5;
		var $custom_short_desc6;
		var $custom_short_desc7;
		var $custom_short_desc8;
		var $custom_short_desc9;
		var $custom_long_desc0;
		var $custom_long_desc1;
		var $custom_long_desc2;
		var $custom_long_desc3;
		var $custom_long_desc4;
		var $custom_long_desc5;
		var $custom_long_desc6;
		var $custom_long_desc7;
		var $custom_long_desc8;
		var $custom_long_desc9;
		var $custom_checkbox0;
		var $custom_checkbox1;
		var $custom_checkbox2;
		var $custom_checkbox3;
		var $custom_checkbox4;
		var $custom_checkbox5;
		var $custom_checkbox6;
		var $custom_checkbox7;
		var $custom_checkbox8;
		var $custom_checkbox9;
		var $custom_dropdown0;
		var $custom_dropdown1;
		var $custom_dropdown2;
		var $custom_dropdown3;
		var $custom_dropdown4;
		var $custom_dropdown5;
		var $custom_dropdown6;
		var $custom_dropdown7;
		var $custom_dropdown8;
		var $custom_dropdown9;

		var $maptuning;

		var $locationManager;

		##################################################
		### USED ONLY FOR GETPRICE CALCULATE
		##################################################
		var $cat_1_id;
		var $cat_2_id;
		var $cat_3_id;
		var $cat_4_id;
		var $cat_5_id;
		##################################################

		function Listing($var='') {
			if (is_numeric($var) && ($var)) {
				$db = db_getDBObject();
				$sql = "SELECT * FROM Listing WHERE id = $var";
				$row = mysql_fetch_array($db->query($sql));
				$this->makeFromRow($row);
			} else {
				$this->makeFromRow($var);
			}
		}

		function makeFromRow($row='') {

			$status = new ItemStatus();
			$level = new ListingLevel();

			$this->id					= ($row["id"])					? $row["id"]					: ($this->id				? $this->id					: 0);
			$this->account_id			= ($row["account_id"])			? $row["account_id"]			: 0;
			$this->image_id				= ($row["image_id"])			? $row["image_id"]				: ($this->image_id			? $this->image_id			: 0);
			$this->thumb_id				= ($row["thumb_id"])			? $row["thumb_id"]				: ($this->thumb_id			? $this->thumb_id			: 0);
			$this->promotion_id			= ($row["promotion_id"])		? $row["promotion_id"]			: ($this->promotion_id		? $this->promotion_id		: 0);
			$this->estado_id			= ($row["estado_id"])			? $row["estado_id"]			: 0;
			$this->cidade_id				= ($row["cidade_id"])			? $row["cidade_id"]				: 0;
			$this->bairro_id			= ($row["bairro_id"])			? $row["bairro_id"]				: 0;
			$this->city_id				= ($row["city_id"])				? $row["city_id"]				: 0;
			$this->area_id				= ($row["area_id"])				? $row["area_id"]				: 0;
			$this->renewal_date			= ($row["renewal_date"])		? $row["renewal_date"]			: ($this->renewal_date		? $this->renewal_date		: 0);
			$this->discount_id			= ($row["discount_id"])			? $row["discount_id"]			: "";
			$this->reminder				= ($row["reminder"])			? $row["reminder"]				: ($this->reminder			? $this->reminder			: 0);
			$this->entered				= ($row["entered"])				? $row["entered"]				: ($this->entered			? $this->entered			: "");
			$this->updated				= ($row["updated"])				? $row["updated"]				: ($this->updated			? $this->updated			: "");
			$this->title				= ($row["title"])				? $row["title"]					: ($this->title				? $this->title				: "");
			$this->razaosocial			= ($row["razaosocial"])				? $row["razaosocial"]					: ($this->razaosocial				? $this->razaosocial				: "");
			$this->seo_title			= ($row["seo_title"])			? $row["seo_title"]				: ($this->seo_title			? $this->seo_title			: "");
			$this->claim_disable		= ($row["claim_disable"])		? $row["claim_disable"]			: "n";
			$this->friendly_url			= ($row["friendly_url"])		? $row["friendly_url"]			: "";
			$this->email				= ($row["email"])				? $row["email"]					: "";
			$this->url					= ($row["url"])					? $row["url"]					: "";
			$this->display_url			= ($row["display_url"])			? $row["display_url"]			: "";
			$this->address				= ($row["address"])				? $row["address"]				: "";
			$this->address2				= ($row["address2"])			? $row["address2"]				: "";
			$this->zip_code				= ($row["zip_code"])			? $row["zip_code"]				: "";
			$this->phone				= ($row["phone"])				? $row["phone"]					: "";
            $this->phone2				= ($row["phone2"])				? $row["phone2"]				: "";
            $this->celular				= ($row["celular"])				? $row["celular"]				: "";
            $this->cnpj			    	= ($row["cnpj"])				? $row["cnpj"]				: "";
			$this->fax					= ($row["fax"])					? $row["fax"]					: "";
			$this->description			= ($row["description"])			? $row["description"]			: "";
			$this->description1			= ($row["description1"])		? $row["description1"]			: "";
			$this->description2			= ($row["description2"])		? $row["description2"]			: "";
			$this->description3			= ($row["description3"])		? $row["description3"]			: "";
			$this->description4			= ($row["description4"])		? $row["description4"]			: "";
			$this->seo_description		= ($row["seo_description"])		? $row["seo_description"]		: ($this->seo_description	? $this->seo_description	: "");
			$this->seo_description1		= ($row["seo_description1"])	? $row["seo_description1"]		: ($this->seo_description1	? $this->seo_description1	: "");
			$this->seo_description2		= ($row["seo_description2"])	? $row["seo_description2"]		: ($this->seo_description2	? $this->seo_description2	: "");
			$this->seo_description3		= ($row["seo_description3"])	? $row["seo_description3"]		: ($this->seo_description3	? $this->seo_description3	: "");
			$this->seo_description4		= ($row["seo_description4"])	? $row["seo_description4"]		: ($this->seo_description4	? $this->seo_description4	: "");
			$this->long_description		= ($row["long_description"])	? $row["long_description"]		: "";
			$this->long_description1	= ($row["long_description1"])	? $row["long_description1"]		: "";
			$this->long_description2	= ($row["long_description2"])	? $row["long_description2"]		: "";
			$this->long_description3	= ($row["long_description3"])	? $row["long_description3"]		: "";
			$this->long_description4	= ($row["long_description4"])	? $row["long_description4"]		: "";
			$this->video_snippet		= ($row["video_snippet"])		? $row["video_snippet"]			: "";
			$this->keywords				= ($row["keywords"])			? $row["keywords"]				: "";
			$this->keywords1			= ($row["keywords1"])			? $row["keywords1"]				: "";
			$this->keywords2			= ($row["keywords2"])			? $row["keywords2"]				: "";
			$this->keywords3			= ($row["keywords3"])			? $row["keywords3"]				: "";
			$this->keywords4			= ($row["keywords4"])			? $row["keywords4"]				: "";
			$this->seo_keywords			= ($row["seo_keywords"])		? $row["seo_keywords"]			: ($this->seo_keywords		? $this->seo_keywords		: "");
			$this->seo_keywords1		= ($row["seo_keywords1"])		? $row["seo_keywords1"]			: ($this->seo_keywords1		? $this->seo_keywords1		: "");
			$this->seo_keywords2		= ($row["seo_keywords2"])		? $row["seo_keywords2"]			: ($this->seo_keywords2		? $this->seo_keywords2		: "");
			$this->seo_keywords3		= ($row["seo_keywords3"])		? $row["seo_keywords3"]			: ($this->seo_keywords3		? $this->seo_keywords3		: "");
			$this->seo_keywords4		= ($row["seo_keywords4"])		? $row["seo_keywords4"]			: ($this->seo_keywords4		? $this->seo_keywords4		: "");
			$this->attachment_file		= ($row["attachment_file"])		? $row["attachment_file"]		: ($this->attachment_file	? $this->attachment_file	: "");
			$this->attachment_caption	= ($row["attachment_caption"])	? $row["attachment_caption"]	: "";
			$this->status				= ($row["status"])				? $row["status"]				: $status->getDefaultStatus();
			$this->level				= ($row["level"])				? $row["level"]					: ($this->level				? $this->level				: $level->getDefaultLevel());
			$this->hours_work			= ($row["hours_work"])			? $row["hours_work"]			: "";
			$this->locations			= ($row["locations"])			? $row["locations"]				: "";

			$this->maptuning			= ($row["maptuning"])			? $row["maptuning"]				: "";

			$this->listingtemplate_id	= ($row["listingtemplate_id"])	? $row["listingtemplate_id"]	: 0;

			$this->custom_text0			= ($row["custom_text0"])		? $row["custom_text0"]			: "";
			$this->custom_text1			= ($row["custom_text1"])		? $row["custom_text1"]			: "";
			$this->custom_text2			= ($row["custom_text2"])		? $row["custom_text2"]			: "";
			$this->custom_text3			= ($row["custom_text3"])		? $row["custom_text3"]			: "";
			$this->custom_text4			= ($row["custom_text4"])		? $row["custom_text4"]			: "";
			$this->custom_text5			= ($row["custom_text5"])		? $row["custom_text5"]			: "";
			$this->custom_text6			= ($row["custom_text6"])		? $row["custom_text6"]			: "";
			$this->custom_text7			= ($row["custom_text7"])		? $row["custom_text7"]			: "";
			$this->custom_text8			= ($row["custom_text8"])		? $row["custom_text8"]			: "";
			$this->custom_text9			= ($row["custom_text9"])		? $row["custom_text9"]			: "";
			$this->custom_short_desc0	= ($row["custom_short_desc0"])	? $row["custom_short_desc0"]	: "";
			$this->custom_short_desc1	= ($row["custom_short_desc1"])	? $row["custom_short_desc1"]	: "";
			$this->custom_short_desc2	= ($row["custom_short_desc2"])	? $row["custom_short_desc2"]	: "";
			$this->custom_short_desc3	= ($row["custom_short_desc3"])	? $row["custom_short_desc3"]	: "";
			$this->custom_short_desc4	= ($row["custom_short_desc4"])	? $row["custom_short_desc4"]	: "";
			$this->custom_short_desc5	= ($row["custom_short_desc5"])	? $row["custom_short_desc5"]	: "";
			$this->custom_short_desc6	= ($row["custom_short_desc6"])	? $row["custom_short_desc6"]	: "";
			$this->custom_short_desc7	= ($row["custom_short_desc7"])	? $row["custom_short_desc7"]	: "";
			$this->custom_short_desc8	= ($row["custom_short_desc8"])	? $row["custom_short_desc8"]	: "";
			$this->custom_short_desc9	= ($row["custom_short_desc9"])	? $row["custom_short_desc9"]	: "";
			$this->custom_long_desc0	= ($row["custom_long_desc0"])	? $row["custom_long_desc0"]		: "";
			$this->custom_long_desc1	= ($row["custom_long_desc1"])	? $row["custom_long_desc1"]		: "";
			$this->custom_long_desc2	= ($row["custom_long_desc2"])	? $row["custom_long_desc2"]		: "";
			$this->custom_long_desc3	= ($row["custom_long_desc3"])	? $row["custom_long_desc3"]		: "";
			$this->custom_long_desc4	= ($row["custom_long_desc4"])	? $row["custom_long_desc4"]		: "";
			$this->custom_long_desc5	= ($row["custom_long_desc5"])	? $row["custom_long_desc5"]		: "";
			$this->custom_long_desc6	= ($row["custom_long_desc6"])	? $row["custom_long_desc6"]		: "";
			$this->custom_long_desc7	= ($row["custom_long_desc7"])	? $row["custom_long_desc7"]		: "";
			$this->custom_long_desc8	= ($row["custom_long_desc8"])	? $row["custom_long_desc8"]		: "";
			$this->custom_long_desc9	= ($row["custom_long_desc9"])	? $row["custom_long_desc9"]		: "";
			$this->custom_checkbox0		= ($row["custom_checkbox0"])	? $row["custom_checkbox0"]		: "n";
			$this->custom_checkbox1		= ($row["custom_checkbox1"])	? $row["custom_checkbox1"]		: "n";
			$this->custom_checkbox2		= ($row["custom_checkbox2"])	? $row["custom_checkbox2"]		: "n";
			$this->custom_checkbox3		= ($row["custom_checkbox3"])	? $row["custom_checkbox3"]		: "n";
			$this->custom_checkbox4		= ($row["custom_checkbox4"])	? $row["custom_checkbox4"]		: "n";
			$this->custom_checkbox5		= ($row["custom_checkbox5"])	? $row["custom_checkbox5"]		: "n";
			$this->custom_checkbox6		= ($row["custom_checkbox6"])	? $row["custom_checkbox6"]		: "n";
			$this->custom_checkbox7		= ($row["custom_checkbox7"])	? $row["custom_checkbox7"]		: "n";
			$this->custom_checkbox8		= ($row["custom_checkbox8"])	? $row["custom_checkbox8"]		: "n";
			$this->custom_checkbox9		= ($row["custom_checkbox9"])	? $row["custom_checkbox9"]		: "n";
			$this->custom_dropdown0		= ($row["custom_dropdown0"])	? $row["custom_dropdown0"]		: "";
			$this->custom_dropdown1		= ($row["custom_dropdown1"])	? $row["custom_dropdown1"]		: "";
			$this->custom_dropdown2		= ($row["custom_dropdown2"])	? $row["custom_dropdown2"]		: "";
			$this->custom_dropdown3		= ($row["custom_dropdown3"])	? $row["custom_dropdown3"]		: "";
			$this->custom_dropdown4		= ($row["custom_dropdown4"])	? $row["custom_dropdown4"]		: "";
			$this->custom_dropdown5		= ($row["custom_dropdown5"])	? $row["custom_dropdown5"]		: "";
			$this->custom_dropdown6		= ($row["custom_dropdown6"])	? $row["custom_dropdown6"]		: "";
			$this->custom_dropdown7		= ($row["custom_dropdown7"])	? $row["custom_dropdown7"]		: "";
			$this->custom_dropdown8		= ($row["custom_dropdown8"])	? $row["custom_dropdown8"]		: "";
			$this->custom_dropdown9		= ($row["custom_dropdown9"])	? $row["custom_dropdown9"]		: "";

		}

		function Save() {

			$this->prepareToSave();

			$dbObj = db_getDBObject();

			$this->friendly_url = strtolower($this->friendly_url);

			if ($this->id) {

				$sql = "SELECT status FROM Listing WHERE id = $this->id";
				$result = $dbObj->query($sql);
				if ($row = mysql_fetch_assoc($result)) $last_status = $row["status"];
				$this_status = $this->status;
				$this_id = $this->id;

				$sql = "UPDATE Listing SET"
					. " account_id         = $this->account_id,"
					. " image_id           = $this->image_id,"
					. " thumb_id           = $this->thumb_id,"
					. " promotion_id       = $this->promotion_id,"
					. " estado_id         = $this->estado_id,"
					. " cidade_id           = $this->cidade_id,"
					. " bairro_id          = $this->bairro_id,"
					. " city_id            = $this->city_id,"
					. " area_id            = $this->area_id,"
					. " renewal_date       = $this->renewal_date,"
					. " discount_id        = $this->discount_id,"
					. " reminder           = $this->reminder,"
					. " updated            = NOW(),"
					. " title              = $this->title,"
					. " razaosocial	       = $this->razaosocial,"
                    			. " cnpj               = $this->cnpj,"
					. " seo_title          = $this->seo_title,"
					. " claim_disable      = $this->claim_disable,"
					. " friendly_url       = $this->friendly_url,"
					. " email              = $this->email,"
					. " url                = $this->url,"
					. " display_url        = $this->display_url,"
					. " address            = $this->address,"
					. " address2           = $this->address2,"
					. " zip_code           = $this->zip_code,"
					. " phone              = $this->phone,"
                    . " phone2             = $this->phone2,"
                    . " celular            = $this->celular,"
					. " fax                = $this->fax,"
					. " description        = $this->description,"
					. " description1       = $this->description1,"
					. " description2       = $this->description2,"
					. " description3       = $this->description3,"
					. " description4       = $this->description4,"
					. " seo_description    = $this->seo_description,"
					. " seo_description1   = $this->seo_description1,"
					. " seo_description2   = $this->seo_description2,"
					. " seo_description3   = $this->seo_description3,"
					. " seo_description4   = $this->seo_description4,"
					. " long_description   = $this->long_description,"
					. " long_description1  = $this->long_description1,"
					. " long_description2  = $this->long_description2,"
					. " long_description3  = $this->long_description3,"
					. " long_description4  = $this->long_description4,"
					. " video_snippet      = $this->video_snippet,"
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
					. " attachment_file    = $this->attachment_file,"
					. " attachment_caption = $this->attachment_caption,"
					. " status             = $this->status,"
					. " level              = $this->level,"
					. " hours_work         = $this->hours_work,"
					. " locations          = $this->locations,"
					. " listingtemplate_id = $this->listingtemplate_id,"
					. " custom_text0       = $this->custom_text0,"
					. " custom_text1       = $this->custom_text1,"
					. " custom_text2       = $this->custom_text2,"
					. " custom_text3       = $this->custom_text3,"
					. " custom_text4       = $this->custom_text4,"
					. " custom_text5       = $this->custom_text5,"
					. " custom_text6       = $this->custom_text6,"
					. " custom_text7       = $this->custom_text7,"
					. " custom_text8       = $this->custom_text8,"
					. " custom_text9       = $this->custom_text9,"
					. " custom_short_desc0 = $this->custom_short_desc0,"
					. " custom_short_desc1 = $this->custom_short_desc1,"
					. " custom_short_desc2 = $this->custom_short_desc2,"
					. " custom_short_desc3 = $this->custom_short_desc3,"
					. " custom_short_desc4 = $this->custom_short_desc4,"
					. " custom_short_desc5 = $this->custom_short_desc5,"
					. " custom_short_desc6 = $this->custom_short_desc6,"
					. " custom_short_desc7 = $this->custom_short_desc7,"
					. " custom_short_desc8 = $this->custom_short_desc8,"
					. " custom_short_desc9 = $this->custom_short_desc9,"
					. " custom_long_desc0  = $this->custom_long_desc0,"
					. " custom_long_desc1  = $this->custom_long_desc1,"
					. " custom_long_desc2  = $this->custom_long_desc2,"
					. " custom_long_desc3  = $this->custom_long_desc3,"
					. " custom_long_desc4  = $this->custom_long_desc4,"
					. " custom_long_desc5  = $this->custom_long_desc5,"
					. " custom_long_desc6  = $this->custom_long_desc6,"
					. " custom_long_desc7  = $this->custom_long_desc7,"
					. " custom_long_desc8  = $this->custom_long_desc8,"
					. " custom_long_desc9  = $this->custom_long_desc9,"
					. " custom_checkbox0   = $this->custom_checkbox0,"
					. " custom_checkbox1   = $this->custom_checkbox1,"
					. " custom_checkbox2   = $this->custom_checkbox2,"
					. " custom_checkbox3   = $this->custom_checkbox3,"
					. " custom_checkbox4   = $this->custom_checkbox4,"
					. " custom_checkbox5   = $this->custom_checkbox5,"
					. " custom_checkbox6   = $this->custom_checkbox6,"
					. " custom_checkbox7   = $this->custom_checkbox7,"
					. " custom_checkbox8   = $this->custom_checkbox8,"
					. " custom_checkbox9   = $this->custom_checkbox9,"
					. " custom_dropdown0   = $this->custom_dropdown0,"
					. " custom_dropdown1   = $this->custom_dropdown1,"
					. " custom_dropdown2   = $this->custom_dropdown2,"
					. " custom_dropdown3   = $this->custom_dropdown3,"
					. " custom_dropdown4   = $this->custom_dropdown4,"
					. " custom_dropdown5   = $this->custom_dropdown5,"
					. " custom_dropdown6   = $this->custom_dropdown6,"
					. " custom_dropdown7   = $this->custom_dropdown7,"
					. " custom_dropdown8   = $this->custom_dropdown8,"
					. " custom_dropdown9   = $this->custom_dropdown9"
					. " WHERE id           = $this->id";

				$dbObj->query($sql);

				$last_status = str_replace("\"", "", $last_status);
				$last_status = str_replace("'", "", $last_status);
				$this_status = str_replace("\"", "", $this_status);
				$this_status = str_replace("'", "", $this_status);
				$this_id = str_replace("\"", "", $this_id);
				$this_id = str_replace("'", "", $this_id);
				if (($this_status == "A") && ($last_status != "A")) system_countActiveListingByCategory($this_id, "inc");
				elseif (($last_status == "A") && ($this_status != "A")) system_countActiveListingByCategory($this_id, "dec");

			} else {

				$sql = "INSERT INTO Listing"
					. " (account_id,"
					. " image_id,"
					. " thumb_id,"
					. " promotion_id,"
					. " estado_id,"
					. " cidade_id,"
					. " bairro_id,"
					. " city_id,"
					. " area_id,"
					. " renewal_date,"
					. " discount_id,"
					. " reminder,"
					. " fulltextsearch_keyword,"
					. " fulltextsearch_where,"
					. " updated,"
					. " entered,"
					. " title,"
					. " razaosocial,"
                    			. " cnpj,"
					. " seo_title,"
					. " claim_disable,"
					. " friendly_url,"
					. " email,"
					. " url,"
					. " display_url,"
					. " address,"
					. " address2,"
					. " zip_code,"
					. " phone,"
                    . " phone2,"
                    . " celular,"
					. " fax,"
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
					. " video_snippet,"
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
					. " attachment_file,"
					. " attachment_caption,"
					. " status,"
					. " level,"
					. " hours_work,"
					. " locations,"
					. " listingtemplate_id,"
					. " custom_text0,"
					. " custom_text1,"
					. " custom_text2,"
					. " custom_text3,"
					. " custom_text4,"
					. " custom_text5,"
					. " custom_text6,"
					. " custom_text7,"
					. " custom_text8,"
					. " custom_text9,"
					. " custom_short_desc0,"
					. " custom_short_desc1,"
					. " custom_short_desc2,"
					. " custom_short_desc3,"
					. " custom_short_desc4,"
					. " custom_short_desc5,"
					. " custom_short_desc6,"
					. " custom_short_desc7,"
					. " custom_short_desc8,"
					. " custom_short_desc9,"
					. " custom_long_desc0,"
					. " custom_long_desc1,"
					. " custom_long_desc2,"
					. " custom_long_desc3,"
					. " custom_long_desc4,"
					. " custom_long_desc5,"
					. " custom_long_desc6,"
					. " custom_long_desc7,"
					. " custom_long_desc8,"
					. " custom_long_desc9,"
					. " custom_checkbox0,"
					. " custom_checkbox1,"
					. " custom_checkbox2,"
					. " custom_checkbox3,"
					. " custom_checkbox4,"
					. " custom_checkbox5,"
					. " custom_checkbox6,"
					. " custom_checkbox7,"
					. " custom_checkbox8,"
					. " custom_checkbox9,"
					. " custom_dropdown0,"
					. " custom_dropdown1,"
					. " custom_dropdown2,"
					. " custom_dropdown3,"
					. " custom_dropdown4,"
					. " custom_dropdown5,"
					. " custom_dropdown6,"
					. " custom_dropdown7,"
					. " custom_dropdown8,"
					. " custom_dropdown9,"
					. " maptuning)"
					. " VALUES"
					. " ($this->account_id,"
					. " $this->image_id,"
					. " $this->thumb_id,"
					. " $this->promotion_id,"
					. " $this->estado_id,"
					. " $this->cidade_id,"
					. " $this->bairro_id,"
					. " $this->city_id,"
					. " $this->area_id,"
					. " $this->renewal_date,"
					. " $this->discount_id,"
					. " $this->reminder,"
					. " '',"
					. " '',"
					. " NOW(),"
					. " NOW(),"
					. " $this->title,"
					. " $this->razaosocial,"
                    			. " $this->cnpj,"
					. " $this->title,"
					. " $this->claim_disable,"
					. " $this->friendly_url,"
					. " $this->email,"
					. " $this->url,"
					. " $this->display_url,"
					. " $this->address,"
					. " $this->address2,"
					. " $this->zip_code,"
					. " $this->phone,"
                   	. " $this->phone2,"
                    . " $this->celular," 
					. " $this->fax,"
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
					. " $this->video_snippet,"
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
					. " $this->attachment_file,"
					. " $this->attachment_caption,"
					. " $this->status,"
					. " $this->level,"
					. " $this->hours_work,"
					. " $this->locations,"
					. " $this->listingtemplate_id,"
					. " $this->custom_text0,"
					. " $this->custom_text1,"
					. " $this->custom_text2,"
					. " $this->custom_text3,"
					. " $this->custom_text4,"
					. " $this->custom_text5,"
					. " $this->custom_text6,"
					. " $this->custom_text7,"
					. " $this->custom_text8,"
					. " $this->custom_text9,"
					. " $this->custom_short_desc0,"
					. " $this->custom_short_desc1,"
					. " $this->custom_short_desc2,"
					. " $this->custom_short_desc3,"
					. " $this->custom_short_desc4,"
					. " $this->custom_short_desc5,"
					. " $this->custom_short_desc6,"
					. " $this->custom_short_desc7,"
					. " $this->custom_short_desc8,"
					. " $this->custom_short_desc9,"
					. " $this->custom_long_desc0,"
					. " $this->custom_long_desc1,"
					. " $this->custom_long_desc2,"
					. " $this->custom_long_desc3,"
					. " $this->custom_long_desc4,"
					. " $this->custom_long_desc5,"
					. " $this->custom_long_desc6,"
					. " $this->custom_long_desc7,"
					. " $this->custom_long_desc8,"
					. " $this->custom_long_desc9,"
					. " $this->custom_checkbox0,"
					. " $this->custom_checkbox1,"
					. " $this->custom_checkbox2,"
					. " $this->custom_checkbox3,"
					. " $this->custom_checkbox4,"
					. " $this->custom_checkbox5,"
					. " $this->custom_checkbox6,"
					. " $this->custom_checkbox7,"
					. " $this->custom_checkbox8,"
					. " $this->custom_checkbox9,"
					. " $this->custom_dropdown0,"
					. " $this->custom_dropdown1,"
					. " $this->custom_dropdown2,"
					. " $this->custom_dropdown3,"
					. " $this->custom_dropdown4,"
					. " $this->custom_dropdown5,"
					. " $this->custom_dropdown6,"
					. " $this->custom_dropdown7,"
					. " $this->custom_dropdown8,"
					. " $this->custom_dropdown9,"
					. " '')";

				$dbObj->query($sql);
				$this->id = mysql_insert_id($dbObj->link_id);
				
				//Reload the Listing object variables
				$this->prepareToUse(); //prevent some fields to be saved with empty quotes
				$sql = "SELECT * FROM Listing WHERE id = $this->id";
				$row = mysql_fetch_array($dbObj->query($sql));
				$this->makeFromRow($row);
				$this->prepareToSave();

				$this_status = $this->status;
				$this_id = $this->id;
				$this_status = str_replace("\"", "", $this_status);
				$this_status = str_replace("'", "", $this_status);
				$this_id = str_replace("\"", "", $this_id);
				$this_id = str_replace("'", "", $this_id);
				if ($this_status == "A") system_countActiveListingByCategory($this_id, "inc");

			}

			$this->prepareToUse();

			$this->setFullTextSearch();

		}

		function Delete() {

			$dbObj = db_getDBObject();

			### LISTING CATEGORY
			if ($this->status == "A") system_countActiveListingByCategory($this->id, "dec");

			### REVIEWS
			$sql = "SELECT id FROM Review WHERE item_type='listing' AND item_id= $this->id";
			$result = $dbObj->query($sql);
			while ($row = mysql_fetch_assoc($result)) {
				$reviewObj = new Review($row["id"]);
				$reviewObj->Delete();
			}

			### CHOICES
			$sql = "DELETE FROM Listing_Choice WHERE listing_id = $this->id";
			$dbObj->query($sql);

			### GALERY
			$sql = "DELETE FROM Gallery_Item WHERE item_type = 'listing' AND item_id = $this->id";
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

			### ATTACHMENT
			if ($this->attachment_file) {
				if (file_exists(EXTRAFILE_DIR."/".$this->attachment_file)) {
					@unlink(EXTRAFILE_DIR."/".$this->attachment_file);
				}
			}

			### INVOICE
			$sql = "UPDATE Invoice_Listing SET listing_id = '0' WHERE listing_id = $this->id";
			$dbObj->query($sql);

			### PAYMENT
			$sql = "UPDATE Payment_Listing_Log SET listing_id = '0' WHERE listing_id = $this->id";
			$dbObj->query($sql);

			### CLAIM
			$sql = "UPDATE Claim SET status = 'incomplete' WHERE listing_id = $this->id AND status = 'progress'";
			$dbObj->query($sql);
			$sql = "UPDATE Claim SET listing_id = '0' WHERE listing_id = $this->id";
			$dbObj->query($sql);

			### LISTING
			$sql = "DELETE FROM Listing WHERE id = $this->id";
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
			$sql = "SELECT cat_1_id, cat_2_id, cat_3_id, cat_4_id, cat_5_id FROM Listing WHERE id = $this->id";
			$r = $dbObj->query($sql);
			while ($row = mysql_fetch_array($r)) {
				if ($row["cat_1_id"]) $categories[] = new ListingCategory($row["cat_1_id"]);
				if ($row["cat_2_id"]) $categories[] = new ListingCategory($row["cat_2_id"]);
				if ($row["cat_3_id"]) $categories[] = new ListingCategory($row["cat_3_id"]);
				if ($row["cat_4_id"]) $categories[] = new ListingCategory($row["cat_4_id"]);
				if ($row["cat_5_id"]) $categories[] = new ListingCategory($row["cat_5_id"]);
			}
			return $categories;
		}

		function setCategories($array) {
			$dbObj = db_getDBObject();
			if ($this->status == "A") system_countActiveListingByCategory($this->id, "dec");
			$cat_1_id = 0;
			$parcat_1_level1_id = 0;
			$parcat_1_level2_id = 0;
			$parcat_1_level3_id = 0;
			$parcat_1_level4_id = 0;
			$cat_2_id = 0;
			$parcat_2_level1_id = 0;
			$parcat_2_level2_id = 0;
			$parcat_2_level3_id = 0;
			$parcat_2_level4_id = 0;
			$cat_3_id = 0;
			$parcat_3_level1_id = 0;
			$parcat_3_level2_id = 0;
			$parcat_3_level3_id = 0;
			$parcat_3_level4_id = 0;
			$cat_4_id = 0;
			$parcat_4_level1_id = 0;
			$parcat_4_level2_id = 0;
			$parcat_4_level3_id = 0;
			$parcat_4_level4_id = 0;
			$cat_5_id = 0;
			$parcat_5_level1_id = 0;
			$parcat_5_level2_id = 0;
			$parcat_5_level3_id = 0;
			$parcat_5_level4_id = 0;
			if ($array) {
				$count_category_aux = 1;
				foreach ($array as $category) {
					if ($category) {
						unset($parents);
						$cat_id = $category;
						$i = 0;
						while ($cat_id != 0) {
							$sql = "SELECT * FROM ListingCategory WHERE id = $cat_id";
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
						${"parcat_".$count_category_aux."_level2_id"} = $parents[1];
						${"parcat_".$count_category_aux."_level3_id"} = $parents[2];
						${"parcat_".$count_category_aux."_level4_id"} = $parents[3];
						$count_category_aux++;
					}
				}
			}
			$sql = "UPDATE Listing SET cat_1_id = ".$cat_1_id.", parcat_1_level1_id = ".$parcat_1_level1_id.", parcat_1_level2_id = ".$parcat_1_level2_id.", parcat_1_level3_id = ".$parcat_1_level3_id.", parcat_1_level4_id = ".$parcat_1_level4_id.", cat_2_id = ".$cat_2_id.", parcat_2_level1_id = ".$parcat_2_level1_id.", parcat_2_level2_id = ".$parcat_2_level2_id.", parcat_2_level3_id = ".$parcat_2_level3_id.", parcat_2_level4_id = ".$parcat_2_level4_id.", cat_3_id = ".$cat_3_id.", parcat_3_level1_id = ".$parcat_3_level1_id.", parcat_3_level2_id = ".$parcat_3_level2_id.", parcat_3_level3_id = ".$parcat_3_level3_id.", parcat_3_level4_id = ".$parcat_3_level4_id.", cat_4_id = ".$cat_4_id.", parcat_4_level1_id = ".$parcat_4_level1_id.", parcat_4_level2_id = ".$parcat_4_level2_id.", parcat_4_level3_id = ".$parcat_4_level3_id.", parcat_4_level4_id = ".$parcat_4_level4_id.", cat_5_id = ".$cat_5_id.", parcat_5_level1_id = ".$parcat_5_level1_id.", parcat_5_level2_id = ".$parcat_5_level2_id.", parcat_5_level3_id = ".$parcat_5_level3_id.", parcat_5_level4_id = ".$parcat_5_level4_id." WHERE id = $this->id";
			$dbObj->query($sql);
			$this->setFullTextSearch();
			if ($this->status == "A") system_countActiveListingByCategory($this->id, "inc");
		}

		function retrieveListingsbyPromotion_id($promotion_id) {
			$dbObj = db_getDBObJect();
			$sql = "SELECT * FROM Listing WHERE promotion_id = $promotion_id";
			$r = $dbObj->query($sql);
			while ($row = mysql_fetch_assoc($r)) {
				$listings[] = new Listing($row["id"]);
			}
			return $listings;
		}

		function getPrice() {

			$price = 0;

			$levelObj = new ListingLevel();
			$price = $price + $levelObj->getPrice($this->level);

			$dbObj = db_getDBObject();
			$sql = "SELECT cat_1_id, cat_2_id, cat_3_id, cat_4_id, cat_5_id FROM Listing WHERE id = ".$this->id."";
			$r = $dbObj->query($sql);
			$row = mysql_fetch_assoc($r);
			$category_amount = 0;
			if ($row["cat_1_id"] || $this->cat_1_id) $category_amount++;
			if ($row["cat_2_id"] || $this->cat_2_id) $category_amount++;
			if ($row["cat_3_id"] || $this->cat_3_id) $category_amount++;
			if ($row["cat_4_id"] || $this->cat_4_id) $category_amount++;
			if ($row["cat_5_id"] || $this->cat_5_id) $category_amount++;

			if (($category_amount > 0) && (($category_amount - $levelObj->getFreeCategory($this->level)) > 0)) {
				$extra_category_amount = $category_amount - $levelObj->getFreeCategory($this->level);
			} else {
				$extra_category_amount = 0;
			}

			if ($extra_category_amount > 0) $price = $price + ($levelObj->getCategoryPrice($this->level) * $extra_category_amount);

			if (LISTINGTEMPLATE_FEATURE == "on") {
				if ($this->listingtemplate_id) {
					$listingTemplateObj = new ListingTemplate($this->listingtemplate_id);
					if ($listingTemplateObj->getString("status") == "enabled") {
						$price = $price + $listingTemplateObj->getString("price");
					} else {
						$dbObj = db_getDBObject();
						$sql = "UPDATE Listing SET listingtemplate_id = 0 WHERE id = ".$this->id;
						$result = $dbObj->query($sql);
					}
				}
			}

			if ($this->discount_id) {

				if (is_valid_discount_code($this->discount_id, "listing", $this->id, $discount_message, $discount_error)) {

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
					$sql = "UPDATE Listing SET discount_id = '' WHERE id = ".$this->id;
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

				$renewalcycle = payment_getRenewalCycle("listing");
				$renewalunit = payment_getRenewalUnit("listing");

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

		function getMapReviews() {

			if (!$this->id) return false;

			setting_get("review_listing_enabled", $review_enabled);

			if ($review_enabled == "on") {

				$rateObj = new Review();
				$rate_avg = $rateObj->getRateAvgByListing("listing", $this->id);

				if ($rate_avg) {

					$db = db_getDBObject();
					$sql ="SELECT * FROM Review WHERE listing_id = '".$this->id."' and approved=1 ";
					$r = $db->query($sql);
					$review_amount = mysql_affected_rows();

					for ($x=0 ; $x < 5 ;$x++) {
						if($rate_avg > $x) $rate_stars .= "<img border='0' src='".DEFAULT_URL."/images/design/img_rateSmallStarOn.gif' alt=\"Star On\" /></li>";
						else $rate_stars .= "<img src='".DEFAULT_URL."/images/design/img_rateSmallStarOff.gif' border='0' alt=\"Star Off\" /></li>";
					}

					$rate_stars .= " (".$review_amount." review".(($review_amount > 1 || $review_amount == 0) ? "s" : "").")";

					if ($rate_stars) return $rate_stars;
					else return false;

				}

			}

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
						$sql = "SELECT * FROM ListingCategory WHERE id = $category_id";
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
				$sql = "UPDATE Listing SET fulltextsearch_keyword = $fulltextsearch_keyword_sql WHERE id = $this->id";
				$result = $dbObj->query($sql);
			}
			if (is_array($fulltextsearch_where)) {
				$fulltextsearch_where_sql = db_formatString(implode(" ", $fulltextsearch_where));
				$sql = "UPDATE Listing SET fulltextsearch_where = $fulltextsearch_where_sql WHERE id = $this->id";
				$result = $dbObj->query($sql);
			}

		}

		function getGalleries() {
			$dbObj = db_getDBObject();
			$sql = "SELECT * FROM Gallery_Item WHERE item_type='listing' AND item_id = $this->id ORDER BY gallery_id";
			$r = $dbObj->query($sql);
			if ($this->id > 0) while ($row = mysql_fetch_array($r)) $galleries[] = $row["gallery_id"];
			return $galleries;
		}

		function setGalleries($array = false) {
			$dbObj = db_getDBObject();
			$sql = "DELETE FROM Gallery_Item WHERE item_type='listing' AND item_id = $this->id";
			$dbObj->query($sql);
			if ($array) {
				foreach ($array as $gallery) {
					if ($gallery) {
						$sql = "INSERT INTO Gallery_Item (item_id, gallery_id, item_type) VALUES ($this->id, $gallery, 'listing')";
						$rs3 = $dbObj->query($sql);
					}
				}
			}
		}

        function getClientes() {
			$dbObj = db_getDBObject();
			$sql = "SELECT * FROM Client_Item WHERE item_type='listing' AND item_id = $this->id ORDER BY client_id";
           	$r = $dbObj->query($sql);
			if ($this->id > 0) while ($row = mysql_fetch_array($r)) $clientes[] = $row["client_id"];
			return $clientes;
		}

		function setClientes($array = false) {
			$dbObj = db_getDBObject();
			$sql = "DELETE FROM Client_Item WHERE item_type='listing' AND item_id = $this->id";
			$dbObj->query($sql);
			if ($array) {
				foreach ($array as $client) {
					if ($client) {
						$sql = "INSERT INTO Client_Item (item_id, client_id, item_type) VALUES ($this->id, $client, 'listing')";
						$rs3 = $dbObj->query($sql);
					}
				}
			}
		}



		function setMapTuning($latitude_longitude="") {
			$dbObj = db_getDBObject();
			$sql = "UPDATE Listing SET maptuning = ".db_formatString($latitude_longitude)." WHERE id = ".$this->id."";
			$dbObj->query($sql);
		}
        
        function hasDetail() {
            $listingLevel = new ListingLevel();
            $detail = $listingLevel->getDetail($this->level);
            unset($listingLevel);
            return $detail;
        }

	}

?>
