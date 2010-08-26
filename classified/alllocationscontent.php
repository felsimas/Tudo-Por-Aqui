<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classified/alllocationscontent.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

?>

	<h2 class="standardTitle"><?=system_highlightLastWord(system_showText(LANG_BROWSEBYLOCATION))?></h2>
	<?
	$countryObj = new LocationCountry();
	$countries = $countryObj->retrieveAllCountries();
	if ($countries) {
		foreach ($countries as $each_country) {
			if (MODREWRITE_FEATURE != "on") {
				echo "<h2 class=\"standardSubTitle\"><a href=\"".CLASSIFIED_DEFAULT_URL."/results.php?estado_id=".$each_country["id"]."\">".$each_country["name"]."</a></h2>";
			} else {
				echo "<h2 class=\"standardSubTitle\"><a href=\"".CLASSIFIED_DEFAULT_URL."/location/".$each_country["friendly_url"]."\">".$each_country["name"]."</a></h2>";
			}
			$stateObj = new LocationState();
			$stateObj->setNumber("estado_id", $each_country["id"]);
			$states = $stateObj->retrieveStatesByCountry();
			if ($states) {
				foreach ($states as $each_state) {
					echo "<div class=\"allLocations\">";
					if (MODREWRITE_FEATURE != "on") {
						echo "<h3><a href=\"".CLASSIFIED_DEFAULT_URL."/results.php?estado_id=".$each_country["id"]."&amp;cidade_id=".$each_state["id"]."\">".$each_state["name"]."</a></h3>";
					} else {
						echo "<h3><a href=\"".CLASSIFIED_DEFAULT_URL."/location/".$each_country["friendly_url"]."/".$each_state["friendly_url"]."\">".$each_state["name"]."</a></h3>";
					}	
					$regionObj = new LocationRegion();
					$regionObj->setNumber("cidade_id", $each_state["id"]);
					$regions = $regionObj->retrieveRegionsByState();
					if ($regions) {
						unset($regionsString);
						foreach ($regions as $each_region) {
							if (MODREWRITE_FEATURE != "on") {
								$regionsString[] = "<a href=\"".CLASSIFIED_DEFAULT_URL."/results.php?estado_id=".$each_country["id"]."&amp;cidade_id=".$each_state["id"]."&amp;bairro_id=".$each_region["id"]."\">".$each_region["name"]."</a>";
							} else {
								$regionsString[] = "<a href=\"".CLASSIFIED_DEFAULT_URL."/location/".$each_country["friendly_url"]."/".$each_state["friendly_url"]."/".$each_region["friendly_url"]."\">".$each_region["name"]."</a>";
							}
						}
						if ($regionsString) echo "<p class=\"complementaryInfo\">".(implode(", ", $regionsString))."</p>";
					}
					echo "</div>";
				}
			}
		}
	}
	?>