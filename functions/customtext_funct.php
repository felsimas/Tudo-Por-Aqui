<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /functions/customtext_funct.php
	# ----------------------------------------------------------------------------------------------------

	function customtext_new($name, $value, $lang=EDIR_DEFAULT_LANGUAGE) {
		if ($name) {
			$customtextObj = new CustomText($name, $lang);
			if (!$customtextObj->getString("name")) {
				$customtextObj->setString("name", $name);
				$customtextObj->setString("value", $value);
				if ($lang != EDIR_DEFAULT_LANGUAGE) {
					$customtextObj->Save();
				} else {
					$customtextObj->Save($update = false);
				}
				return true;
			}
		}
		return false;
	}

	function customtext_get($name, &$value, $lang=EDIR_DEFAULT_LANGUAGE) {
		if ($name) {
			$customtextObj = new CustomText($name, $lang);
			if ($customtextObj->getString("name")) {
				$value = $customtextObj->getString("value");
				return true;
			}
		}
		$value = "";
		return false;
	}

	function customtext_set($name, $value, $lang=EDIR_DEFAULT_LANGUAGE) {
		if ($name) {
			$customtextObj = new CustomText($name, $lang);
			if ($customtextObj->getString("name")) {
				$customtextObj->setString("value", $value);
				$customtextObj->Save();
				return true;
			}
		}
		return false;
	}

	function customtext_delete($name, $lang=EDIR_DEFAULT_LANGUAGE) {
		if ($name) {
			$customtextObj = new CustomText($name, $lang);
			return $customtextObj->Delete();
		}
		return false;
	}

?>
