<?php



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/code/headertaglocation.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	unset($getMetaTag);
	$getMetaTag = true;
	if ($estado_id) {
		if ($cidade_id) {
			if ($bairro_id) {
				if ($city_id) {
					if ($area_id) {
						if ($getMetaTag) {
							$areaObjHeaderTag = new LocationArea($area_id);
							if ($areaObjHeaderTag->getString("seo_description")) $headertag_description = $areaObjHeaderTag->getString("seo_description");
							if ($areaObjHeaderTag->getString("seo_keywords")) $headertag_keywords = $areaObjHeaderTag->getString("seo_keywords");
							unset($areaObjHeaderTag);
							$getMetaTag = false;
						}
					}
					if ($getMetaTag) {
						$cityObjHeaderTag = new LocationCity($city_id);
						if ($cityObjHeaderTag->getString("seo_description")) $headertag_description = $cityObjHeaderTag->getString("seo_description");
						if ($cityObjHeaderTag->getString("seo_keywords")) $headertag_keywords = $cityObjHeaderTag->getString("seo_keywords");
						unset($cityObjHeaderTag);
						$getMetaTag = false;
					}
				}
				if ($getMetaTag) {
					$regionObjHeaderTag = new LocationRegion($bairro_id);
					if ($regionObjHeaderTag->getString("seo_description")) $headertag_description = $regionObjHeaderTag->getString("seo_description");
					if ($regionObjHeaderTag->getString("seo_keywords")) $headertag_keywords = $regionObjHeaderTag->getString("seo_keywords");
					unset($regionObjHeaderTag);
					$getMetaTag = false;
				}
			}
			if ($getMetaTag) {
				$stateObjHeaderTag = new LocationState($cidade_id);
				if ($stateObjHeaderTag->getString("seo_description")) $headertag_description = $stateObjHeaderTag->getString("seo_description");
				if ($stateObjHeaderTag->getString("seo_keywords")) $headertag_keywords = $stateObjHeaderTag->getString("seo_keywords");
				unset($stateObjHeaderTag);
				$getMetaTag = false;
			}
		}
		if ($getMetaTag) {
			$countryObjHeaderTag = new LocationCountry($estado_id);
			if ($countryObjHeaderTag->getString("seo_description")) $headertag_description = $countryObjHeaderTag->getString("seo_description");
			if ($countryObjHeaderTag->getString("seo_keywords")) $headertag_keywords = $countryObjHeaderTag->getString("seo_keywords");
			unset($countryObjHeaderTag);
			$getMetaTag = false;
		}
	}
	unset($getMetaTag);

?>
