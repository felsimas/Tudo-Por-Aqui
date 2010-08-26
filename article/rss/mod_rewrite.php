<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /rss/mod_rewrite.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	if ($_GET["qs"]) {

		$qs = explode("_", $_GET["qs"]);

		if (!in_array("guide", $qs) && !in_array("location", $qs) && (count($qs) == 1)) {

			$_GET["article"] = $qs[0];

		} elseif ((in_array("guide", $qs) || in_array("location", $qs)) && (count($qs) > 1)) {

			$guidepos = array_search("guide", $qs);
			if ($guidepos !== false) $guideposbegin = guidepos+1;
			$locationpos = array_search("location", $qs);
			if ($locationpos !== false) $locationposbegin = $locationpos+1;

			if ($guidepos === false) {
				$locationposend = count($qs)-1;
			} elseif ($locationpos === false) {
				$guideposend = count($qs)-1;
			} else {
				if ($guideposbegin > $locationposbegin) {
					$guideposend = count($qs)-1;
					$locationposend = $guidepos-1;
				} elseif ($locationposbegin > $guideposbegin) {
					$locationposend = count($qs)-1;
					$guideposend = $locationpos-1;
				}
			}

			if ($guidepos !== false) {
				for ($i=$guideposbegin; $i<=$guideposend; $i++) {
					if ($i == ($guideposbegin))   $_GET["category1"] = $qs[$i];
					if ($i == ($guideposbegin+1)) $_GET["category2"] = $qs[$i];
					if ($i == ($guideposbegin+2)) $_GET["category3"] = $qs[$i];
					if ($i == ($guideposbegin+3)) $_GET["category4"] = $qs[$i];
					if ($i == ($guideposbegin+4)) $_GET["category5"] = $qs[$i];
				}
			}

			if ($locationpos !== false) {
				for ($i=$locationposbegin; $i<=$locationposend; $i++) {
					if ($i == ($locationposbegin))   $_GET["country"] = $qs[$i];
					if ($i == ($locationposbegin+1)) $_GET["state"]   = $qs[$i];
					if ($i == ($locationposbegin+2)) $_GET["region"]  = $qs[$i];
					if ($i == ($locationposbegin+3)) $_GET["city"]    = $qs[$i];
					if ($i == ($locationposbegin+4)) $_GET["area"]    = $qs[$i];
				}
			}

		}

		unset($_GET["qs"], $qs);

	}

	# ----------------------------------------------------------------------------------------------------
	# MOD-REWRITE
	# ----------------------------------------------------------------------------------------------------
	include(ARTICLE_EDIRECTORY_ROOT."/mod_rewrite.php");

?>
