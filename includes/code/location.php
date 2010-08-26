<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/code/location.php
	# ----------------------------------------------------------------------------------------------------

/**
* Default CSS class for Location messages
**/
$message_style = "errorMessage";

/**
*
* Country operations
*
*************************************************************************/
if(LOCATION_AREA == "COUNTRY"){

	$countryObj = new LocationCountry();

	/**
	* Add operation for Location-Country Area
	**/
	if(strtolower($_POST["operation"]) == "add"){
		// nothing to be done here.
	}

	/**
	* Edit operation for Location-Country Area
	**/  
	if(strtolower($_POST["operation"]) == "edit"){
		if(!$_POST["location_id"]){
			$location_message = ucfirst(system_showText(LANG_SITEMGR_LOCATION_MSGERROR_PLEASESELECT1))." ".strtolower(LOCATION_TITLE)." ".system_showText(LANG_SITEMGR_LOCATION_MSGERROR_PLEASESELECT2);
		} else {
			$countryObj->SetString("id",$_POST["location_id"]);
			$country_data = $countryObj->retrieveCountryById();
			$location_id = $country_data["id"];
			$location_name = $country_data["name"];
			$location_abbreviation = $country_data["abbreviation"];
			$friendly_url = $country_data["friendly_url"];
			$seo_description = $country_data["seo_description"];
			$seo_keywords = $country_data["seo_keywords"];
		}
	}

	/**
	* Delete operation for Location-Country Area
	**/
	if(strtolower($_POST["operation"]) == "delete"){
		if(!$_POST["location_id"]){
			$location_message = ucfirst(system_showText(LANG_SITEMGR_LOCATION_MSGERROR_PLEASESELECT1))." ".strtolower(LOCATION_TITLE)." ".system_showText(LANG_SITEMGR_LOCATION_MSGERROR_PLEASESELECT2);
		} else {
			$countryObj->SetString("id",$_POST["location_id"]);
			$country_data = $countryObj->retrieveCountryById();
			$location_id = $country_data["id"];
			$location_name = $country_data["name"];
			$location_abbreviation = $country_data["abbreviation"];
			$friendly_url = $country_data["friendly_url"];
			$seo_description = $country_data["seo_description"];
			$seo_keywords = $country_data["seo_keywords"];
		}
	}

	/**
	* Delete operation for Location-Country Area
	**/
	if(strtolower($_POST["operation"]) == "confirm"){  
		$countryObj->SetString("id",$_POST["location_id"]);
		$country_data = $countryObj->retrieveCountryById();
		$countryObj->Delete();
		$location_message = ucwords(LOCATION_TITLE)." ".$country_data["name"]." ".system_showText(LANG_SITEMGR_WASSUCCESSDELETED);
		$message_style = "successMessage";
		$success = true;
	}

	/**
	* Insert operation for Location-Country Area
	**/
	if(strtolower($_POST["operation"]) == "insert"){

		if (!trim($_POST["location_name"])) $error_message[] = ucfirst(system_showText(LANG_SITEMGR_MSGERROR_FIELD))." \"".ucwords(LOCATION_TITLE)."\" ".system_showText(LANG_SITEMGR_LOCATION_MSGERROR_ISREQUIRED);
		if (!trim($_POST["friendly_url"]))  $error_message[] = ucfirst(system_showText(LANG_SITEMGR_MSGERROR_FIELD))." \"".system_showText(LANG_SITEMGR_LABEL_FRIENDLYTITLE)."\" ".system_showText(LANG_SITEMGR_LOCATION_MSGERROR_ISREQUIRED);

		if ($error_message) $location_message = implode("<br />", $error_message);

		if(!$error_message){
			$countryObj->setString("name",ucwords($_POST["location_name"]));
			$countryObj->setString("abbreviation",ucwords($_POST["location_abbreviation"]));
			$countryObj->setString("friendly_url",$_POST["friendly_url"]);
			$countryObj->setString("seo_description",$_POST["seo_description"]);
			$countryObj->setString("seo_keywords",$_POST["seo_keywords"]);
			if(!$countryObj->isRepeated()){
				if($countryObj->isValidFriendlyUrl($location_message)){
					$countryObj->Save();
					$location_message =  ucwords(LOCATION_TITLE)." ".$countryObj->getString("name")." ".system_showText(LANG_SITEMGR_LOCATION_WASSUCCESSADDED);
					$message_style = "successMessage";
					$success = true;
				}
			} else {
				$location_message =  ucwords(LOCATION_TITLE)." ".$countryObj->getString("name")." ".system_showText(LANG_SITEMGR_LOCATION_ALREADYEXISTS);
			}
		}

	}

	/**
	* Update operation for Location-Country Area
	**/
	if(strtolower($_POST["operation"]) == "update"){

		if(!trim($_POST["location_id"])) $error_message[] = system_showText(LANG_SITEMGR_LOCATION_IDMISSING);
		if(!trim($_POST["location_name"])) $error_message[] = ucfirst(system_showText(LANG_SITEMGR_LABEL_FIELD))." \"".ucwords(LOCATION_TITLE)."\" ".system_showText(LANG_SITEMGR_LOCATION_MSGERROR_ISREQUIRED);
		if(!trim($_POST["friendly_url"])) $error_message[] = ucfirst(system_showText(LANG_SITEMGR_LABEL_FIELD))." \"".system_showText(LANG_SITEMGR_LABEL_FRIENDLYTITLE)."\" ".system_showText(LANG_SITEMGR_LOCATION_MSGERROR_ISREQUIRED);

		if($error_message) $location_message = implode("<br />", $error_message);

		if(!$error_message){
			$countryObj->setString("id",$_POST["location_id"]);
			$countryObj->setString("name",ucwords($_POST["location_name"]));
			$countryObj->setString("abbreviation",ucwords($_POST["location_abbreviation"]));
			$countryObj->setString("friendly_url",$_POST["friendly_url"]);
			$countryObj->setString("seo_description",$_POST["seo_description"]);
			$countryObj->setString("seo_keywords",$_POST["seo_keywords"]);
			if(!$countryObj->isRepeated()){
				if($countryObj->isValidFriendlyUrl($location_message)){
					$countryObj->Save();
					$location_message = ucwords(LOCATION_TITLE)." ".$countryObj->getString("name")." ".system_showText(LANG_SITEMGR_LOCATION_WASSUCCESSUPDATED);
					$message_style = "successMessage";
					$success = true;
				}
			} else {
				$location_message = ucwords(LOCATION_TITLE)." ".$countryObj->getString("name")." ".system_showText(LANG_SITEMGR_LOCATION_ALREADYEXISTS);
			}
		}

	}

	$locations = $countryObj->retrieveAllCountries();

}

/**
*
* State operations
*
*************************************************************************/
if(LOCATION_AREA == "STATE"){

	$countryObj = new LocationCountry();
	$stateObj   = new LocationState();

	/**
	* Add operation for Location-State Area
	**/
	if(strtolower($_POST["operation"]) == "add"){
		$estado_id = $_POST["estado_id"];
		if (!$estado_id ) {
			$location_message = ucfirst(system_showText(LANG_SITEMGR_LOCATION_MSGERROR_PLEASESELECT1))." ".system_showText(LANG_SITEMGR_LABEL_COUNTRY);
		}
	}

	/**
	* Edit operation for Location-State Area
	**/
	if(strtolower($_POST["operation"]) == "edit"){
		if(!$_POST["location_id"]){
			$location_message = ucfirst(system_showText(LANG_SITEMGR_LOCATION_MSGERROR_PLEASESELECT1))." ".strtolower(LOCATION_TITLE)." ".system_showText(LANG_SITEMGR_LOCATION_MSGERROR_PLEASESELECT2);
		} else {
			$stateObj->SetString("id",$_POST["location_id"]);
			$state_data = $stateObj->retrieveStateById();
			$location_id = $state_data["id"];
			$estado_id = $state_data["estado_id"];
			$location_name = $state_data["name"];
			$location_abbreviation = $state_data["abbreviation"];
			$friendly_url = $state_data["friendly_url"];
			$seo_description = $state_data["seo_description"];
			$seo_keywords = $state_data["seo_keywords"];
		}
	}

	/**
	* Delete operation for Location-State Area
	**/
	if(strtolower($_POST["operation"]) == "delete"){
		if(!$_POST["location_id"]){
			$location_message = ucfirst(system_showText(LANG_SITEMGR_LOCATION_MSGERROR_PLEASESELECT1))." ".strtolower(LOCATION_TITLE)." ".system_showText(LANG_SITEMGR_LOCATION_MSGERROR_PLEASESELECT2);
		} else {
			$stateObj->SetString("id",$_POST["location_id"]);
			$state_data = $stateObj->retrieveStateById();
			$location_id = $state_data["id"];
			$estado_id = $state_data["estado_id"];
			$location_name = $state_data["name"];
			$location_abbreviation = $state_data["abbreviation"];
			$friendly_url = $state_data["friendly_url"];
			$seo_description = $state_data["seo_description"];
			$seo_keywords = $state_data["seo_keywords"];
		}
	}

	/**
	* Delete operation for Location-State Area
	**/  
	if(strtolower($_POST["operation"]) == "confirm"){  
		$stateObj->SetString("id",$_POST["location_id"]);
		$state_data = $stateObj->retrieveStateById();
		$stateObj->Delete();
		$location_message = ucfirst(LOCATION_TITLE)." ".$state_data["name"]." ".system_showText(LANG_SITEMGR_WASSUCCESSDELETED);
		$message_style = "successMessage";
		$success = true;
	}

	/**
	* Insert operation for Location-State Area
	**/
	if(strtolower($_POST["operation"]) == "insert") {

        if(!trim($_POST["location_name"])) ucfirst(system_showText(LANG_SITEMGR_MSGERROR_FIELD))." \"".ucwords(LOCATION_TITLE)."\" ".system_showText(LANG_SITEMGR_LOCATION_MSGERROR_ISREQUIRED);
		if(!trim($_POST["friendly_url"])) $error_message[] = ucfirst(system_showText(LANG_SITEMGR_MSGERROR_FIELD))." \"".system_showText(LANG_SITEMGR_LABEL_FRIENDLYTITLE)."\" ".system_showText(LANG_SITEMGR_LOCATION_MSGERROR_ISREQUIRED);
		if(!trim($_POST["estado_id"])) $error_message[] = ucfirst(system_showText(LANG_SITEMGR_LOCATION_MSGERROR_CHOOSEA))." \"".system_showText(LANG_SITEMGR_LABEL_COUNTRY)."\" ".system_showText(LANG_SITEMGR_LOCATION_MSGERROR_ISREQUIRED);

		if($error_message) $location_message = implode("<br />", $error_message);

		if(!$error_message){
			$stateObj->setString("estado_id",$_POST["estado_id"]);
			$stateObj->setString("name",ucwords($_POST["location_name"]));
			$stateObj->setString("abbreviation",ucwords($_POST["location_abbreviation"]));
			$stateObj->setString("friendly_url",$_POST["friendly_url"]);
			$stateObj->setString("seo_description",$_POST["seo_description"]);
			$stateObj->setString("seo_keywords",$_POST["seo_keywords"]);
			if(!$stateObj->isRepeated()){
				if($stateObj->isValidFriendlyUrl($location_message)){
					$stateObj->Save();
					$location_message = ucwords(LOCATION_TITLE)." ".$stateObj->getString("name")." ".system_showText(LANG_SITEMGR_LOCATION_WASSUCCESSADDED);
					$message_style = "successMessage";
					$success = true;
				}
			} else {
				$location_message = ucwords(LOCATION_TITLE)." ".$stateObj->getString("name")." ".system_showText(LANG_SITEMGR_LOCATION_ALREADYEXISTS);
			}
		}
	}

	/**
	* Update operation for Location-State Area
	**/
	if(strtolower($_POST["operation"]) == "update"){

		if(!trim($_POST["location_name"])) ucfirst(system_showText(LANG_SITEMGR_MSGERROR_FIELD))." \"".ucwords(LOCATION_TITLE)."\" ".system_showText(LANG_SITEMGR_LOCATION_MSGERROR_ISREQUIRED);
        if(!trim($_POST["friendly_url"])) $error_message[] = ucfirst(system_showText(LANG_SITEMGR_MSGERROR_FIELD))." \"".system_showText(LANG_SITEMGR_LABEL_FRIENDLYTITLE)."\" ".system_showText(LANG_SITEMGR_LOCATION_MSGERROR_ISREQUIRED);
        if(!trim($_POST["estado_id"])) $error_message[] = ucfirst(system_showText(LANG_SITEMGR_LOCATION_MSGERROR_CHOOSEA))." \"".system_showText(LANG_SITEMGR_LABEL_COUNTRY)."\" ".system_showText(LANG_SITEMGR_LOCATION_MSGERROR_ISREQUIRED);

		if($error_message) $location_message = implode("<br />", $error_message);

		if(!$error_message){
			$stateObj->setString("id",$_POST["location_id"]);
			$stateObj->setString("estado_id",$_POST["estado_id"]);
			$stateObj->setString("name",ucwords($_POST["location_name"]));
			$stateObj->setString("abbreviation",ucwords($_POST["location_abbreviation"]));
			$stateObj->setString("friendly_url",$_POST["friendly_url"]);
			$stateObj->setString("seo_description",$_POST["seo_description"]);
			$stateObj->setString("seo_keywords",$_POST["seo_keywords"]);
			if(!$stateObj->isRepeated()){
				if($stateObj->isValidFriendlyUrl($location_message)){
					$stateObj->Save();
					$location_message = ucwords(LOCATION_TITLE)." ".$stateObj->getString("name")." ".system_showText(LANG_SITEMGR_LOCATION_WASSUCCESSADDED);
					$message_style = "successMessage";
					$success = true;
				}
			} else {
				$location_message = ucwords(LOCATION_TITLE)." ".$stateObj->getString("name")." ".system_showText(LANG_SITEMGR_LOCATION_ALREADYEXISTS);
			}
		}
	}

	$countries = $countryObj->retrieveAllCountries();  
	$stateObj->SetString("estado_id",$_POST["estado_id"]);
	$locations = $stateObj->retrieveStatesByCountry();  

}

/**
*
* Region operations
*
*************************************************************************/
if(LOCATION_AREA == "REGION") {

	$countryObj = new LocationCountry();
	$stateObj   = new LocationState();
	$regionObj  = new LocationRegion();

	/**
	* Add operation for Location-Region Area
	**/
	if(strtolower($_POST["operation"]) == "add"){
		$estado_id = $_POST["estado_id"];
		$cidade_id = $_POST["cidade_id"];
		if (!$estado_id ) {
			$location_message = ucfirst(system_showText(LANG_SITEMGR_LOCATION_MSGERROR_PLEASESELECT1))." ".system_showText(LANG_SITEMGR_LABEL_COUNTRY);
		} else if (!$cidade_id) {
			$location_message = system_showText(LANG_SITEMGR_LOCATION_MSGERROR_PLEASESELECT1)." ".system_showText(LANG_SITEMGR_LABEL_STATE).".";
		}
	}

	/**
	* Edit operation for Location-Region Area
	**/
	if(strtolower($_POST["operation"]) == "edit"){
		if(!$_POST["location_id"]){
			$location_message = system_showText(LANG_SITEMGR_LOCATION_MSGERROR_PLEASESELECT1)." ".strtolower(LOCATION_TITLE)." ".system_showText(LANG_SITEMGR_LOCATION_MSGERROR_PLEASESELECT2);
		} else {
			$regionObj->SetString("id",$_POST["location_id"]);
			$region_data = $regionObj->retrieveRegionById();
			$location_id = $region_data["id"];
			$cidade_id = $region_data["cidade_id"];
			$location_name = $region_data["name"];
			$location_abbreviation = $region_data["abbreviation"];
			$friendly_url = $region_data["friendly_url"];
			$seo_description = $region_data["seo_description"];
			$seo_keywords = $region_data["seo_keywords"];
		}
	}

	/**
	* Delete operation for Location-region Area
	**/
	if(strtolower($_POST["operation"]) == "delete"){
		if(!$_POST["location_id"]){
			$location_message = system_showText(LANG_SITEMGR_LOCATION_MSGERROR_PLEASESELECT1)." ".strtolower(LOCATION_TITLE)." ".system_showText(LANG_SITEMGR_LOCATION_MSGERROR_PLEASESELECT2);
		} else {
			$regionObj->SetString("id",$_POST["location_id"]);
			$region_data = $regionObj->retrieveRegionById();
			$location_id = $region_data["id"];
			$cidade_id = $region_data["cidade_id"];
			$location_name = $region_data["name"];
			$location_abbreviation = $region_data["abbreviation"];
			$friendly_url = $region_data["friendly_url"];
			$seo_description = $region_data["seo_description"];
			$seo_keywords = $region_data["seo_keywords"];
		}
	}

	/**
	* Delete operation for Location-Region Area
	**/
	if(strtolower($_POST["operation"]) == "confirm"){
		$regionObj->SetString("id",$_POST["location_id"]);
		$region_data = $regionObj->retrieveRegionById();
		$regionObj->Delete();
		$location_message = ucfirst(LOCATION_TITLE)." ".$region_data["name"]." ".system_showText(LANG_SITEMGR_WASSUCCESSDELETED);
		$message_style = "successMessage";
		$success = true;
	}

	/**
	* Insert operation for Location-Region Area
	**/
	if(strtolower($_POST["operation"]) == "insert"){

		if(!trim($_POST["location_name"])) $error_message[] = ucfirst(system_showText(LANG_SITEMGR_MSGERROR_FIELD))." \"".ucwords(LOCATION_TITLE)."\" ".system_showText(LANG_SITEMGR_LOCATION_MSGERROR_ISREQUIRED);
		if(!trim($_POST["friendly_url"])) $error_message[] = ucfirst(system_showText(LANG_SITEMGR_LABEL_FIELD))." \"".system_showText(LANG_SITEMGR_LABEL_FRIENDLYTITLE)."\" ".system_showText(LANG_SITEMGR_LOCATION_MSGERROR_ISREQUIRED);
		if(!trim($_POST["cidade_id"])) $error_message[] = system_showText(LANG_SITEMGR_LOCATION_MSGERROR_CHOOSEA)." \"".system_showText(LANG_SITEMGR_LABEL_STATE)."\" ".system_showText(LANG_SITEMGR_LOCATION_MSGERROR_ISREQUIRED);

		if($error_message) $location_message = implode("<br />", $error_message);

		if(!$error_message){
			$regionObj->setString("cidade_id",$_POST["cidade_id"]);
			$regionObj->setString("name",ucwords($_POST["location_name"]));
			$regionObj->setString("abbreviation",ucwords($_POST["location_abbreviation"]));
			$regionObj->setString("friendly_url",$_POST["friendly_url"]);
			$regionObj->setString("seo_description",$_POST["seo_description"]);
			$regionObj->setString("seo_keywords",$_POST["seo_keywords"]);
			if(!$regionObj->isRepeated()){
				if($regionObj->isValidFriendlyUrl($location_message)){
					$regionObj->Save();
					$location_message = ucwords(LOCATION_TITLE)." ".$regionObj->getString("name")." ".system_showText(LANG_SITEMGR_LOCATION_WASSUCCESSADDED);
					$message_style = "successMessage";
					$success = true;
				}
			} else {
				$location_message = ucwords(LOCATION_TITLE)." ".$regionObj->getString("name")." ".system_showText(LANG_SITEMGR_LOCATION_ALREADYEXISTS);
			}
		}
	}

	/**
	* Update operation for Location-Region Area
	**/
	if(strtolower($_POST["operation"]) == "update"){

		if(!trim($_POST["location_id"])) $error_message[] = system_showText(LANG_SITEMGR_LOCATION_IDMISSING);
        if(!trim($_POST["location_name"])) $error_message[] = ucfirst(system_showText(LANG_SITEMGR_LABEL_FIELD))." \"".ucwords(LOCATION_TITLE)."\" ".system_showText(LANG_SITEMGR_LOCATION_MSGERROR_ISREQUIRED);
        if(!trim($_POST["friendly_url"])) $error_message[] = ucfirst(system_showText(LANG_SITEMGR_LABEL_FIELD))." \"".system_showText(LANG_SITEMGR_LABEL_FRIENDLYTITLE)."\" ".system_showText(LANG_SITEMGR_LOCATION_MSGERROR_ISREQUIRED);
        if(!trim($_POST["cidade_id"])) $error_message[] = system_showText(LANG_SITEMGR_LOCATION_MSGERROR_CHOOSEA)." \"".system_showText(LANG_SITEMGR_LABEL_STATE)."\" ".system_showText(LANG_SITEMGR_LOCATION_MSGERROR_ISREQUIRED);

		if($error_message) $location_message = implode("<br />", $error_message);

		if(!$error_message){
			$regionObj->setString("id",$_POST["location_id"]);
			$regionObj->setString("cidade_id",$_POST["cidade_id"]);
			$regionObj->setString("name",ucwords($_POST["location_name"]));
			$regionObj->setString("abbreviation",ucwords($_POST["location_abbreviation"]));
			$regionObj->setString("friendly_url",$_POST["friendly_url"]);
			$regionObj->setString("seo_description",$_POST["seo_description"]);
			$regionObj->setString("seo_keywords",$_POST["seo_keywords"]);
			if(!$regionObj->isRepeated()){
				if($regionObj->isValidFriendlyUrl($location_message)){
					$regionObj->Save();
					$location_message = ucwords(LOCATION_TITLE)." ".$regionObj->getString("name")." ".system_showText(LANG_SITEMGR_LOCATION_WASSUCCESSUPDATED);
					$message_style = "successMessage";
					$success = true;
				}
			} else {
				$location_message = ucwords(LOCATION_TITLE)." ".$regionObj->getString("name")." ".system_showText(LANG_SITEMGR_LOCATION_ALREADYEXISTS);
			}
		}
	}

	// if the country were changed flush the state.
	if($current_country && $current_country != $_POST["estado_id"])
		unset($_POST["cidade_id"]);

	$countries = $countryObj->retrieveAllCountries();  
	$stateObj->SetString("estado_id",$_POST["estado_id"]);
	$states = $stateObj->retrieveStatesByCountry();  
	$regionObj->SetString("cidade_id",$_POST["cidade_id"]);
	$locations = $regionObj->retrieveRegionsByState();
}

/**
*
* City operations
*
*************************************************************************/
if(LOCATION_AREA == "CITY"){

	$countryObj = new LocationCountry();
	$stateObj   = new LocationState();
	$regionObj  = new LocationRegion();
	$cityObj    = new LocationCity();

	/**
	* Add operation for Location-City Area
	**/
	if(strtolower($_POST["operation"]) == "add"){
		$estado_id = $_POST["estado_id"];
		$cidade_id   = $_POST["cidade_id"];
		$bairro_id  = $_POST["bairro_id"];
	}

	/**
	* Edit operation for Location-City Area
	**/
	if(strtolower($_POST["operation"]) == "edit"){
		if(!$_POST["location_id"]){
			$location_message = system_showText(LANG_SITEMGR_LOCATION_MSGERROR_PLEASESELECT1)." ".strtolower(LOCATION_TITLE)." ".system_showText(LANG_SITEMGR_LOCATION_MSGERROR_PLEASESELECT2);
		} else {
			$cityObj->SetString("id",$_POST["location_id"]);
			$city_data = $cityObj->retrieveCityById();
			$location_id = $city_data["id"];
			$bairro_id = $city_data["bairro_id"];
			$location_name = $city_data["name"];
			$location_abbreviation = $city_data["abbreviation"];
			$friendly_url = $city_data["friendly_url"];
			$seo_description = $city_data["seo_description"];
			$seo_keywords = $city_data["seo_keywords"];
		}
	}

	/**
	* Delete operation for Location-City Area
	**/
	if(strtolower($_POST["operation"]) == "delete"){
		if(!$_POST["location_id"]){
			$location_message = system_showText(LANG_SITEMGR_LOCATION_MSGERROR_PLEASESELECT1)." ".strtolower(LOCATION_TITLE)." ".system_showText(LANG_SITEMGR_LOCATION_MSGERROR_PLEASESELECT2);
		} else {
			$cityObj->SetString("id",$_POST["location_id"]);
			$city_data = $cityObj->retrieveCityById();
			$location_id = $city_data["id"];
			$bairro_id = $city_data["bairro_id"];
			$location_name = $city_data["name"];
			$location_abbreviation = $city_data["abbreviation"];
			$friendly_url = $city_data["friendly_url"];
			$seo_description = $city_data["seo_description"];
			$seo_keywords = $city_data["seo_keywords"];
		}
	}

	/**
	* Delete operation for Location-City Area
	**/
	if(strtolower($_POST["operation"]) == "confirm"){  
		$cityObj->SetString("id",$_POST["location_id"]);
		$city_data = $cityObj->retrieveCityById();
		$cityObj->Delete();
		$location_message = ucfirst(LOCATION_TITLE)." ".$city_data["name"]." ".system_showText(LANG_SITEMGR_WASSUCCESSDELETED);
		$message_style = "successMessage";
		$success = true;
	}

	/**
	* Insert operation for Location-City Area
	**/
	if(strtolower($_POST["operation"]) == "insert"){

		if(!trim($_POST["location_name"])) $error_message[] = ucfirst(system_showText(LANG_SITEMGR_MSGERROR_FIELD))." \"".ucwords(LOCATION_TITLE)."\" ".system_showText(LANG_SITEMGR_LOCATION_MSGERROR_ISREQUIRED);
		if(!trim($_POST["friendly_url"])) $error_message[] = ucfirst(system_showText(LANG_SITEMGR_LABEL_FIELD))." \"".system_showText(LANG_SITEMGR_LABEL_FRIENDLYTITLE)."\" ".system_showText(LANG_SITEMGR_LOCATION_MSGERROR_ISREQUIRED);
		if(!trim($_POST["bairro_id"])) $error_message[] = system_showText(LANG_SITEMGR_LOCATION_MSGERROR_CHOOSEA)." \"".system_showText(LANG_SITEMGR_LABEL_REGION)."\" ".system_showText(LANG_SITEMGR_LOCATION_MSGERROR_ISREQUIRED);

		if($error_message) $location_message = implode("<br />", $error_message);

		if(!$error_message){
			$cityObj->setString("bairro_id",$_POST["bairro_id"]);
			$cityObj->setString("name",ucwords($_POST["location_name"]));
			$cityObj->setString("abbreviation",ucwords($_POST["location_abbreviation"]));
			$cityObj->setString("friendly_url",$_POST["friendly_url"]);
			$cityObj->setString("seo_description",$_POST["seo_description"]);
			$cityObj->setString("seo_keywords",$_POST["seo_keywords"]);
			if(!$cityObj->isRepeated()){
				$cityObj->Save();
				$location_message = ucwords(LOCATION_TITLE)." ".$cityObj->getString("name")." ".system_showText(LANG_SITEMGR_LOCATION_WASSUCCESSADDED);
				$message_style = "successMessage";
				$success = true;
			} else {
				$location_message = ucwords(LOCATION_TITLE)." ".$cityObj->getString("name")." ".system_showText(LANG_SITEMGR_LOCATION_ALREADYEXISTS);
			}
		}
	}

	/**
	* Update operation for Location-City Area
	**/
	if(strtolower($_POST["operation"]) == "update"){

		if(!trim($_POST["location_name"])) $error_message[] = ucfirst(system_showText(LANG_SITEMGR_MSGERROR_FIELD))." \"".ucwords(LOCATION_TITLE)."\" ".system_showText(LANG_SITEMGR_LOCATION_MSGERROR_ISREQUIRED);
		if(!trim($_POST["friendly_url"])) $error_message[] = ucfirst(system_showText(LANG_SITEMGR_LABEL_FIELD))." \"".system_showText(LANG_SITEMGR_LABEL_FRIENDLYTITLE)."\" ".system_showText(LANG_SITEMGR_LOCATION_MSGERROR_ISREQUIRED);
		if(!trim($_POST["bairro_id"])) $error_message[] = system_showText(LANG_SITEMGR_LOCATION_MSGERROR_CHOOSEA)." \"".system_showText(LANG_SITEMGR_LABEL_REGION)."\" ".system_showText(LANG_SITEMGR_LOCATION_MSGERROR_ISREQUIRED);
		if(!trim($_POST["location_id"])) $error_message[] = system_showText(LANG_SITEMGR_LOCATION_IDMISSING);

		if($error_message) $location_message = implode("<br />", $error_message);

		if(!$error_message){
			$cityObj->setString("id",$_POST["location_id"]);
			$cityObj->setString("bairro_id",$_POST["bairro_id"]);
			$cityObj->setString("name",ucwords($_POST["location_name"]));
			$cityObj->setString("abbreviation",ucwords($_POST["location_abbreviation"]));
			$cityObj->setString("friendly_url",$_POST["friendly_url"]);
			$cityObj->setString("seo_description",$_POST["seo_description"]);
			$cityObj->setString("seo_keywords",$_POST["seo_keywords"]);
			if(!$cityObj->isRepeated()){
				$cityObj->Save();
				$location_message = ucwords(LOCATION_TITLE)." ".$cityObj->getString("name")." ".system_showText(LANG_SITEMGR_LOCATION_WASSUCCESSUPDATED);
				$message_style = "successMessage";
				$success = true;
			} else {
				$location_message = ucwords(LOCATION_TITLE)." ".$cityObj->getString("name")." ".system_showText(LANG_SITEMGR_LOCATION_ALREADYEXISTS);
			}
		}
	}

	// if the country were changed reset the state.
	if($current_country && $current_country != $_POST["estado_id"]){
		unset($_POST["cidade_id"]);
		unset($_POST["bairro_id"]);
	}

	// if the state were changed reset the region.
	if($current_state && $current_state != $_POST["cidade_id"]){
		unset($_POST["bairro_id"]);
	}

	$countries = $countryObj->retrieveAllCountries();

	$stateObj->SetString("estado_id",$_POST["estado_id"]);
	$states    = $stateObj->retrieveStatesByCountry();

	$regionObj->SetString("cidade_id",$_POST["cidade_id"]);
	$regions   = $regionObj->retrieveRegionsByState();

	$cityObj->SetString("bairro_id",$_POST["bairro_id"]);
	$locations = $cityObj->retrieveCitiesByRegion();

}

/**
*
* Area operations
*
*************************************************************************/
if(LOCATION_AREA == "AREA"){

	$countryObj = new LocationCountry();
	$stateObj   = new LocationState();
	$regionObj  = new LocationRegion();
	$cityObj    = new LocationCity();
	$areaObj    = new LocationArea();

	/**
	* Add operation for Location-Area Area
	**/
	if(strtolower($_POST["operation"]) == "add"){
		$estado_id = $_POST["estado_id"];
		$cidade_id   = $_POST["cidade_id"];
		$bairro_id  = $_POST["bairro_id"];
		$city_id    = $_POST["city_id"];
	}

	/**
	* Edit operation for Location-Area Area
	**/
	if(strtolower($_POST["operation"]) == "edit"){
		if(!$_POST["location_id"]){
			$location_message = system_showText(LANG_SITEMGR_LOCATION_MSGERROR_PLEASESELECT1)." ".strtolower(LOCATION_TITLE)." ".system_showText(LANG_SITEMGR_LOCATION_MSGERROR_PLEASESELECT2);
		} else {
			$areaObj->SetString("id",$_POST["location_id"]);
			$area_data = $areaObj->retrieveAreaById();
			$location_id = $area_data["id"];
			$city_id = $area_data["city_id"];
			$location_name = $area_data["name"];
			$location_abbreviation = $area_data["abbreviation"];
			$friendly_url = $area_data["friendly_url"];
			$seo_description = $area_data["seo_description"];
			$seo_keywords = $area_data["seo_keywords"];
		}
	}

	/**
	* Delete operation for Location-Area Area
	**/
	if(strtolower($_POST["operation"]) == "delete"){
		if(!$_POST["location_id"]){
			$location_message = system_showText(LANG_SITEMGR_LOCATION_MSGERROR_PLEASESELECT1)." ".strtolower(LOCATION_TITLE)." ".system_showText(LANG_SITEMGR_LOCATION_MSGERROR_PLEASESELECT2);
		} else {
			$areaObj->SetString("id",$_POST["location_id"]);
			$area_data = $areaObj->retrieveAreaById();
			$location_id = $area_data["id"];
			$city_id = $area_data["city_id"];
			$location_name = $area_data["name"];
			$location_abbreviation = $area_data["abbreviation"];
			$friendly_url = $area_data["friendly_url"];
			$seo_description = $area_data["seo_description"];
			$seo_keywords = $area_data["seo_keywords"];
		}
	}

	/**
	* Delete operation for Location-City Area
	**/
	if(strtolower($_POST["operation"]) == "confirm"){  
		$areaObj->SetString("id",$_POST["location_id"]);
		$area_data = $areaObj->retrieveAreaById();
		$areaObj->Delete();
		$location_message = ucfirst(LOCATION_TITLE)." ".$area_data["name"]." ".system_showText(LANG_SITEMGR_WASSUCCESSDELETED);
		$message_style = "successMessage";
		$success = true;
	}

	/**
	* Insert operation for Location-City Area
	**/
	if(strtolower($_POST["operation"]) == "insert"){

		if(!trim($_POST["location_name"])) $error_message[] = ucfirst(system_showText(LANG_SITEMGR_MSGERROR_FIELD))." \"".ucwords(LOCATION_TITLE)."\" ".system_showText(LANG_SITEMGR_LOCATION_MSGERROR_ISREQUIRED);
		if(!trim($_POST["friendly_url"])) $error_message[] = ucfirst(system_showText(LANG_SITEMGR_LABEL_FIELD))." \"".system_showText(LANG_SITEMGR_LABEL_FRIENDLYTITLE)."\" ".system_showText(LANG_SITEMGR_LOCATION_MSGERROR_ISREQUIRED);
		if(!trim($_POST["city_id"])) $error_message[] = system_showText(LANG_SITEMGR_LOCATION_MSGERROR_CHOOSEA)." \"".system_showText(LANG_SITEMGR_LABEL_CITY)."\" ".system_showText(LANG_SITEMGR_LOCATION_MSGERROR_ISREQUIRED);

		if($error_message) $location_message = implode("<br />", $error_message);

		if(!$error_message){
			$areaObj->setString("city_id",$_POST["city_id"]);
			$areaObj->setString("name",ucwords($_POST["location_name"]));
			$areaObj->setString("abbreviation",ucwords($_POST["location_abbreviation"]));
			$areaObj->setString("friendly_url",$_POST["friendly_url"]);
			$areaObj->setString("seo_description",$_POST["seo_description"]);
			$areaObj->setString("seo_keywords",$_POST["seo_keywords"]);
			if(!$areaObj->isRepeated()){
				$areaObj->Save();
				$location_message = ucwords(LOCATION_TITLE)." ".$areaObj->getString("name")." ".system_showText(LANG_SITEMGR_LOCATION_WASSUCCESSADDED);
				$message_style = "successMessage";
				$success = true;
			} else {
				$location_message = ucwords(LOCATION_TITLE)." ".$areaObj->getString("name")." ".system_showText(LANG_SITEMGR_LOCATION_ALREADYEXISTS);
			}
		}
	}

	/**
	* Update operation for Location-City Area
	**/
	if(strtolower($_POST["operation"]) == "update"){

		if(!trim($_POST["location_name"])) $error_message[] = ucfirst(system_showText(LANG_SITEMGR_MSGERROR_FIELD))." \"".ucwords(LOCATION_TITLE)."\" ".system_showText(LANG_SITEMGR_LOCATION_MSGERROR_ISREQUIRED);
		if(!trim($_POST["friendly_url"])) $error_message[] = ucfirst(system_showText(LANG_SITEMGR_LABEL_FIELD))." \"".system_showText(LANG_SITEMGR_LABEL_FRIENDLYTITLE)."\" ".system_showText(LANG_SITEMGR_LOCATION_MSGERROR_ISREQUIRED);
		if(!trim($_POST["city_id"])) $error_message[] = system_showText(LANG_SITEMGR_LOCATION_MSGERROR_CHOOSEA)." \"".system_showText(LANG_SITEMGR_LABEL_CITY)."\" ".system_showText(LANG_SITEMGR_LOCATION_MSGERROR_ISREQUIRED);
		if(!trim($_POST["location_id"])) $error_message[] = system_showText(LANG_SITEMGR_LOCATION_IDMISSING);

		if($error_message) $location_message = implode("<br />", $error_message);

		if(!$error_message){
			$areaObj->setString("id",$_POST["location_id"]);
			$areaObj->setString("city_id",$_POST["city_id"]);
			$areaObj->setString("name",ucwords($_POST["location_name"]));
			$areaObj->setString("abbreviation",ucwords($_POST["location_abbreviation"]));
			$areaObj->setString("friendly_url",$_POST["friendly_url"]);
			$areaObj->setString("seo_description",$_POST["seo_description"]);
			$areaObj->setString("seo_keywords",$_POST["seo_keywords"]);
			if(!$areaObj->isRepeated()){
				$areaObj->Save();
				$location_message = ucwords(LOCATION_TITLE)." ".$areaObj->getString("name")." ".system_showText(LANG_SITEMGR_LOCATION_WASSUCCESSUPDATED);
				$message_style = "successMessage";
				$success = true;
			} else {
				$location_message = ucwords(LOCATION_TITLE)." ".$areaObj->getString("name")." ".system_showText(LANG_SITEMGR_LOCATION_ALREADYEXISTS);
			}
		}
	}

	// if the country were changed reset the state.
	if($current_country && $current_country != $_POST["estado_id"]){
		unset($_POST["cidade_id"]);
		unset($_POST["bairro_id"]);
		unset($_POST["city_id"]);
	}

	// if the state were changed reset the region.
	if($current_state && $current_state != $_POST["cidade_id"]){
		unset($_POST["bairro_id"]);
		unset($_POST["city_id"]);
	}

	// if the region were changed reset the city.
	if($current_region && $current_region != $_POST["bairro_id"]){
		unset($_POST["city_id"]);
	}

	$countries = $countryObj->retrieveAllCountries();  

	$stateObj->SetString("estado_id",$_POST["estado_id"]);
	$states = $stateObj->retrieveStatesByCountry();  

	$regionObj->SetString("cidade_id",$_POST["cidade_id"]);
	$regions = $regionObj->retrieveRegionsByState();  

	$cityObj->SetString("bairro_id",$_POST["bairro_id"]);
	$cities = $cityObj->retrieveCitiesByRegion();  

	$areaObj->SetString("city_id",$_POST["city_id"]);
	$locations = $areaObj->retrieveAreasByCity();
}

?>
