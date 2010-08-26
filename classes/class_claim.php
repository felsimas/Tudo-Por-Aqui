<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classes/class_claim.php
	# ----------------------------------------------------------------------------------------------------

	class Claim extends Handle {

		var $id;
		var $account_id;
		var $username;
		var $listing_id;
		var $listing_title;
		var $date_time;
		var $step;
		var $status;

		var $old_estado_id;
		var $new_estado_id;
		var $old_cidade_id;
		var $new_cidade_id;
		var $old_bairro_id;
		var $new_bairro_id;
		var $old_city_id;
		var $new_city_id;
		var $old_area_id;
		var $new_area_id;
		var $old_title;
		var $new_title;
		var $old_friendly_url;
		var $new_friendly_url;
		var $old_email;
		var $new_email;
		var $old_url;
		var $new_url;
		var $old_phone;
		var $new_phone;
		var $old_fax;
		var $new_fax;
		var $old_address;
		var $new_address;
		var $old_address2;
		var $new_address2;
		var $old_zip_code;
		var $new_zip_code;
		var $old_level;
		var $new_level;
		var $old_listingtemplate_id;
		var $new_listingtemplate_id;

		function Claim($var="") {
			if (is_numeric($var) && ($var)) {
				$db = db_getDBObject();
				$sql = "SELECT * FROM Claim WHERE id = $var";
				$row = mysql_fetch_array($db->query($sql));
				$this->makeFromRow($row);
			} else {
				$this->makeFromRow($var);
			}
		}

		function makeFromRow($row="") {

			$this->id						= ($row["id"])						? $row["id"]						: ($this->id						? $this->id						: 0);
			$this->account_id				= ($row["account_id"])				? $row["account_id"]				: ($this->account_id				? $this->account_id				: 0);
			$this->username					= ($row["username"])				? $row["username"]					: ($this->username					? $this->username				: "");
			$this->listing_id				= ($row["listing_id"])				? $row["listing_id"]				: ($this->listing_id				? $this->listing_id				: 0);
			$this->listing_title			= ($row["listing_title"])			? $row["listing_title"]				: ($this->listing_title				? $this->listing_title			: "");
			$this->date_time				= ($row["date_time"])				? $row["date_time"]					: "";
			$this->step						= ($row["step"])					? $row["step"]						: "";
			$this->status					= ($row["status"])					? $row["status"]					: "";

			$this->old_estado_id			= ($row["old_estado_id"])			? $row["old_estado_id"]			: ($this->old_estado_id			? $this->old_estado_id			: 0);
			$this->new_estado_id			= ($row["new_estado_id"])			? $row["new_estado_id"]			: 0;
			$this->old_cidade_id				= ($row["old_cidade_id"])			? $row["old_cidade_id"]				: ($this->old_cidade_id				? $this->old_cidade_id			: 0);
			$this->new_cidade_id				= ($row["new_cidade_id"])			? $row["new_cidade_id"]				: 0;
			$this->old_bairro_id			= ($row["old_bairro_id"])			? $row["old_bairro_id"]				: ($this->old_bairro_id				? $this->old_bairro_id			: 0);
			$this->new_bairro_id			= ($row["new_bairro_id"])			? $row["new_bairro_id"]				: 0;
			$this->old_city_id				= ($row["old_city_id"])				? $row["old_city_id"]				: ($this->old_city_id				? $this->old_city_id			: 0);
			$this->new_city_id				= ($row["new_city_id"])				? $row["new_city_id"]				: 0;
			$this->old_area_id				= ($row["old_area_id"])				? $row["old_area_id"]				: ($this->old_area_id				? $this->old_area_id			: 0);
			$this->new_area_id				= ($row["new_area_id"])				? $row["new_area_id"]				: 0;
			$this->old_title				= ($row["old_title"])				? $row["old_title"]					: ($this->old_title					? $this->old_title				: "");
			$this->new_title				= ($row["new_title"])				? $row["new_title"]					: "";
			$this->old_friendly_url			= ($row["old_friendly_url"])		? $row["old_friendly_url"]			: ($this->old_friendly_url			? $this->old_friendly_url		: "");
			$this->new_friendly_url			= ($row["new_friendly_url"])		? $row["new_friendly_url"]			: "";
			$this->old_email				= ($row["old_email"])				? $row["old_email"]					: ($this->old_email					? $this->old_email				: "");
			$this->new_email				= ($row["new_email"])				? $row["new_email"]					: "";
			$this->old_url					= ($row["old_url"])					? $row["old_url"]					: ($this->old_url					? $this->old_url				: "");
			$this->new_url					= ($row["new_url"])					? $row["new_url"]					: "";
			$this->old_phone				= ($row["old_phone"])				? $row["old_phone"]					: ($this->old_phone					? $this->old_phone				: "");
			$this->new_phone				= ($row["new_phone"])				? $row["new_phone"]					: "";
			$this->old_fax					= ($row["old_fax"])					? $row["old_fax"]					: ($this->old_fax					? $this->old_fax				: "");
			$this->new_fax					= ($row["new_fax"])					? $row["new_fax"]					: "";
			$this->old_address				= ($row["old_address"])				? $row["old_address"]				: ($this->old_address				? $this->old_address			: "");
			$this->new_address				= ($row["new_address"])				? $row["new_address"]				: "";
			$this->old_address2				= ($row["old_address2"])			? $row["old_address2"]				: ($this->old_address2				? $this->old_address2			: "");
			$this->new_address2				= ($row["new_address2"])			? $row["new_address2"]				: "";
			$this->old_zip_code				= ($row["old_zip_code"])			? $row["old_zip_code"]				: ($this->old_zip_code				? $this->old_zip_code			: "");
			$this->new_zip_code				= ($row["new_zip_code"])			? $row["new_zip_code"]				: "";
			$this->old_level				= ($row["old_level"])				? $row["old_level"]					: ($this->old_level					? $this->old_level				: 0);
			$this->new_level				= ($row["new_level"])				? $row["new_level"]					: 0;
			$this->old_listingtemplate_id	= ($row["old_listingtemplate_id"])	? $row["old_listingtemplate_id"]	: ($this->old_listingtemplate_id	? $this->old_listingtemplate_id	: 0);
			$this->new_listingtemplate_id	= ($row["new_listingtemplate_id"])	? $row["new_listingtemplate_id"]	: 0;

		}

		function Save() {

			$this->prepareToSave();

			$dbObj = db_getDBObject();

			if ($this->id) {

				$sql = "UPDATE Claim SET"
					. " account_id             = $this->account_id,"
					. " username               = $this->username,"
					. " listing_id             = $this->listing_id,"
					. " listing_title          = $this->listing_title,"

					. " old_estado_id         = $this->old_estado_id,"
					. " new_estado_id         = $this->new_estado_id,"
					. " old_cidade_id           = $this->old_cidade_id,"
					. " new_cidade_id           = $this->new_cidade_id,"
					. " old_bairro_id          = $this->old_bairro_id,"
					. " new_bairro_id          = $this->new_bairro_id,"
					. " old_city_id            = $this->old_city_id,"
					. " new_city_id            = $this->new_city_id,"
					. " old_area_id            = $this->old_area_id,"
					. " new_area_id            = $this->new_area_id,"
					. " old_title              = $this->old_title,"
					. " new_title              = $this->new_title,"
					. " old_friendly_url       = $this->old_friendly_url,"
					. " new_friendly_url       = $this->new_friendly_url,"
					. " old_email              = $this->old_email,"
					. " new_email              = $this->new_email,"
					. " old_url                = $this->old_url,"
					. " new_url                = $this->new_url,"
					. " old_phone              = $this->old_phone,"
					. " new_phone              = $this->new_phone,"
					. " old_fax                = $this->old_fax,"
					. " new_fax                = $this->new_fax,"
					. " old_address            = $this->old_address,"
					. " new_address            = $this->new_address,"
					. " old_address2           = $this->old_address2,"
					. " new_address2           = $this->new_address2,"
					. " old_zip_code           = $this->old_zip_code,"
					. " new_zip_code           = $this->new_zip_code,"
					. " old_level              = $this->old_level,"
					. " new_level              = $this->new_level,"
					. " old_listingtemplate_id = $this->old_listingtemplate_id,"
					. " new_listingtemplate_id = $this->new_listingtemplate_id,"

					. " step                   = $this->step,"
					. " status                 = $this->status"
					. " WHERE id               = $this->id";

				$dbObj->query($sql);

			} else {

				$sql = "INSERT INTO Claim"
					. " (account_id,"
					. " username,"
					. " listing_id,"
					. " listing_title,"
					. " date_time,"

					. " old_estado_id,"
					. " new_estado_id,"
					. " old_cidade_id,"
					. " new_cidade_id,"
					. " old_bairro_id,"
					. " new_bairro_id,"
					. " old_city_id,"
					. " new_city_id,"
					. " old_area_id,"
					. " new_area_id,"
					. " old_title,"
					. " new_title,"
					. " old_friendly_url,"
					. " new_friendly_url,"
					. " old_email,"
					. " new_email,"
					. " old_url,"
					. " new_url,"
					. " old_phone,"
					. " new_phone,"
					. " old_fax,"
					. " new_fax,"
					. " old_address,"
					. " new_address,"
					. " old_address2,"
					. " new_address2,"
					. " old_zip_code,"
					. " new_zip_code,"
					. " old_level,"
					. " new_level,"
					. " old_listingtemplate_id,"
					. " new_listingtemplate_id,"

					. " step,"
					. " status)"
					. " VALUES"
					. " ($this->account_id,"
					. " $this->username,"
					. " $this->listing_id,"
					. " $this->listing_title,"
					. " NOW(),"

					. " $this->old_estado_id,"
					. " $this->new_estado_id,"
					. " $this->old_cidade_id,"
					. " $this->new_cidade_id,"
					. " $this->old_bairro_id,"
					. " $this->new_bairro_id,"
					. " $this->old_city_id,"
					. " $this->new_city_id,"
					. " $this->old_area_id,"
					. " $this->new_area_id,"
					. " $this->old_title,"
					. " $this->new_title,"
					. " $this->old_friendly_url,"
					. " $this->new_friendly_url,"
					. " $this->old_email,"
					. " $this->new_email,"
					. " $this->old_url,"
					. " $this->new_url,"
					. " $this->old_phone,"
					. " $this->new_phone,"
					. " $this->old_fax,"
					. " $this->new_fax,"
					. " $this->old_address,"
					. " $this->new_address,"
					. " $this->old_address2,"
					. " $this->new_address2,"
					. " $this->old_zip_code,"
					. " $this->new_zip_code,"
					. " $this->old_level,"
					. " $this->new_level,"
					. " $this->old_listingtemplate_id,"
					. " $this->new_listingtemplate_id,"

					. " $this->step,"
					. " $this->status)";

				$dbObj->query($sql);

				$this->id = mysql_insert_id($dbObj->link_id);

			}

			$this->prepareToUse();

		}

		function Delete() {
			$dbObj = db_getDBObJect();
			$sql = "DELETE FROM Claim WHERE id = $this->id";
			$dbObj->query($sql);
		}

		function canApprove() {
			if (($this->status == "complete") && ($this->account_id) && ($this->listing_id)) return true;
			else return false;
		}

		function canDeny() {
			if ((($this->status == "progress") || ($this->status == "incomplete") || ($this->status == "complete")) && ($this->account_id) && ($this->listing_id)) return true;
			else return false;
		}

	}

?>
