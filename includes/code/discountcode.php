<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/code/discountcode.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);
	
	// Check if the code already exists
	function is_repeated_code(&$message_discountcode){

		$db = db_getDBObject();
		
		$sql = "SELECT * FROM Discount_Code WHERE id = '".$_POST["id"]."'";
		if($_POST["x_id"]) $sql .= "AND id != '".$_POST["x_id"]."'";

		$rs = $db->query($sql);
		if($rs){
			if(mysql_num_rows($rs) > 0){
				$message_discountcode .= "&#149;&nbsp;".system_showText(LANG_SITEMGR_PROMOTIONALCODE_MSGERROR_IDINUSE)."<br />";
				return true;
			} else {
				return false;
			}
		} else {
			$message_discountcode .= "&#149;&nbsp;".system_showText(LANG_SITEMGR_PROMOTIONALCODE_MSGERROR_FAILUREVALIDATION)."<br />";
			return true;
		}
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER["REQUEST_METHOD"] == "GET") {

		// Loading object from a existent discount
		if($_GET["x_id"]) {
			$discountCodeObj = new DiscountCode($_GET["x_id"]);
			$discountCodeObj->setString("x_id",$_GET["x_id"]); // Existent discount code, this variable must be forced into the object because it is extracted to compose the form.
		}

	}elseif ($_SERVER["REQUEST_METHOD"] == "POST") {

		$_POST["amount"] = (is_numeric($_POST["amount"])) ? format_money($_POST["amount"]) : $_POST["amount"]; // formating monetary values

		if ((validate_form("discountcode", $_POST, $message_discountcode)) && (!is_repeated_code($message_discountcode))) {

			if($_POST["x_id"]){ // update
				$discountCodeObj = new DiscountCode($_POST["x_id"]);
				$discountCodeObj->makeFromRow($_POST);
				$message = ucwords(LANG_LABEL_DISCOUNTCODE)." &quot;".$_POST["x_id"]."&quot; ".system_showText(LANG_SITEMGR_SUCCESSUPDATED);
			} else { // insert
				$discountCodeObj = new DiscountCode($_POST);
				$message = ucwords(LANG_LABEL_DISCOUNTCODE)." &quot;".$_POST["id"]."&quot; ".system_showText(LANG_SITEMGR_SUCCESSADDED);
			}
			$discountCodeObj->setDate("expire_date", $_POST['expire_date']);
			$discountCodeObj->Save(); // saving object

			header("Location: ".DEFAULT_URL."/gerenciamento/discountcode/index.php?screen=$screen&letra=$letra&message=".urlencode($message));
			exit;

		} else { // the form has missing or invalid information

			if($_POST["x_id"]) { // existent discount with invalid info
				$discountCodeObj = new DiscountCode($_POST["x_id"]);
				$discountCodeObj->setString("x_id",$_POST["x_id"]);
				$_POST = format_magicQuotes($_POST);
				$discountCodeObj->makeFromRow($_POST);
			} else { // new discount with invalid info]
				$_POST = format_magicQuotes($_POST);
				$discountCodeObj = new DiscountCode($_POST);
			}

		}

	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------

	// Retrieving object information
	if (is_object($discountCodeObj)) $discountCodeObj->extract();

	// Discount Code Status Drop Down
	$discountCodeStatusObj = new DiscountCodeStatus();
	unset($arrayValue);
	unset($arrayName);
	$arrayValue = $discountCodeStatusObj->getValues();
	$arrayName = $discountCodeStatusObj->getNames();
	unset($arrayValueDD);
	unset($arrayNameDD);
	for ($i=0; $i<count($arrayValue); $i++) {
		if ($arrayValue[$i] != "E") {
			$arrayValueDD[] = $arrayValue[$i];
			$arrayNameDD[] = $arrayName[$i];
		}
	}
	$discountCodeStatusDropDown = html_selectBox("status", $arrayNameDD, $arrayValueDD, $status, "", "class='input-dd-form-discountcode'", "-- ".system_showText(LANG_SITEMGR_SELECTASTATUS)." --");

