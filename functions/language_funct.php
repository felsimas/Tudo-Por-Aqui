<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /functions/language_funct.php
	# ----------------------------------------------------------------------------------------------------

	function language_writeComboLang($name = 'lang', $default_value = EDIR_DEFAULT_LANGUAGE, $onChange = '', $block = false) {

		$languages = explode(',', EDIR_LANGUAGES);
		$languagenames = explode(',', EDIR_LANGUAGENAMES);

		if (count($languages) > 1) {

			$onChange_value = ($onChange != '') ? ("onchange=\"$onChange\"") : '';
			$block_value    = ($block) ? ("disabled=\"disabled\"") : ('');
			$name_value     = ($block) ? ($name.'_disabled') : ($name);

			$buffer_comboLang = "<select name=\"$name_value\" id=\"$name_value\" $onChange_value $block_value >\n";
			for ($i=0;$i<count($languages);$i++) {
				$language = $languages[$i];
				$languagename = $languagenames[$i];
				$selected = "";
				if ($default_value == $language) {
					$selected = " selected=\"selected\"";
				}
				$buffer_comboLang .= "\t<option value=\"$language\"$selected>$languagename</option>\n";
			}
			$buffer_comboLang .= "</select>\n";

			if ($block) {
				$buffer_comboLang .= "<input type=\"hidden\" name=\"$name\" value=\"$default_value\" />\n";
			}

		} else {

			$buffer_comboLang = "<input type=\"hidden\" name=\"lang\" value=\"$languages[0]\" />\n";
			$buffer_comboLang .= "<span style=\"text-align:left;font-weight:bold;font-size:12px;\">$languagenames[0]</span>\n";

		}

		return $buffer_comboLang;

	}

	function language_langOptions($lang) {
		$languages = explode(',', EDIR_LANGUAGES);
		$languagenames = explode(',', EDIR_LANGUAGENAMES);
		$return = "";
		if (count($languages) > 1) {
			$return .= "<select name=\"lang\">";
			for ($i=0; $i<count($languages); $i++) {
				$language = $languages[$i];
				$languagename = $languagenames[$i];
				$selected = "";
				if ($language == $lang) $selected = "selected=\"selected\"";
				$return .= "<option value=\"$language\" $selected>$languagename</option>";
			}
			$return .= "</select>";
		} else {
			$return .= "<input type=\"hidden\" name=\"lang\" value=\"".$languages[0]."\" />\n";
			$return .= "<span style=\"font-weight: bold; font-size: 12px;\">".$languagenames[0]."</span>\n";
		}
		return $return;
	}

	function language_getIndex($lang) {
		$return = "";
		$languages = explode(',', EDIR_LANGUAGES);
		for ($i=1; $i<count($languages); $i++) {
			if ($languages[$i] == $lang) {
				$return = $i;
			}
		}
		return $return;
	}

?>
