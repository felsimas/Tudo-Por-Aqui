<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /functions/payment_funct.php
	# ----------------------------------------------------------------------------------------------------

	function payment_getRenewalPeriod($item) {
		return constant(strtoupper($item)."_RENEWAL_PERIOD");
	}

	function payment_getRenewalCycle($item) {
		return substr(constant(strtoupper($item)."_RENEWAL_PERIOD"), 0, strlen(constant(strtoupper($item)."_RENEWAL_PERIOD"))-1);
	}

	function payment_getRenewalUnit($item) {
		return substr(constant(strtoupper($item)."_RENEWAL_PERIOD"), strlen(constant(strtoupper($item)."_RENEWAL_PERIOD"))-1);
	}

	function payment_getRenewalUnitName($item) {
		$unit = payment_getRenewalUnit($item);
		if ($unit == "Y") $unitname = system_showText(LANG_YEAR);
		elseif ($unit == "M") $unitname = system_showText(LANG_MONTH);
		elseif ($unit == "D") $unitname = system_showText(LANG_DAY);
		return $unitname;
	}

?>
