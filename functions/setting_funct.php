<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /functions/setting_funct.php
	# ----------------------------------------------------------------------------------------------------

	function setting_new($name, $value) {
		if ($name) {
			$settingObj = new Setting($name);
			if (!$settingObj->getString("name")) {
				$settingObj->setString("name", $name);
				$settingObj->setString("value", $value);
				$settingObj->Save($update = false);
				return true;
			}
		}
		return false;
	}

	function setting_get($name, &$value) {
		if ($name) {
			$settingObj = new Setting($name);
			if ($settingObj->getString("name")) {
				$value = $settingObj->getString("value");
				return true;
			}
		}
		$value = "";
		return false;
	}

	function setting_set($name, $value) {
		if ($name) {
			$settingObj = new Setting($name);
			if ($settingObj->getString("name")) {
				$settingObj->setString("value", $value);
				$settingObj->Save();
				return true;
			}
		}
		return false;
	}

	function setting_delete($name) {
		if ($name) {
			$settingObj = new Setting($name);
			return $settingObj->Delete();
		}
		return false;
	}

?>
