<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/export/emailgenerate.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);

	include(INCLUDES_DIR."/code/email_generate.php");

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------

	/**
	*
	* Categories Drop Down
	*
	**********************************************************/
	$langIndex = language_getIndex(EDIR_LANGUAGE);
	$categories = db_getFromDB("listingcategory", "category_id", 0, "all", "title");
	if ($categories) {
		foreach ($categories as $category) {
			$valueArray[] = "";
			$nameArray[] = "---------------------------";
			$valueArray[] = $category->getNumber("id");
			if ($category->getString("title".$langIndex)) $nameArray[] = $category->getString("title".$langIndex);
			else $nameArray[] = $category->getString("title");
			$subcategories = db_getFromDB("listingcategory", "category_id", $category->getNumber("id"), "all", "title");
			if ($subcategories) {
				foreach ($subcategories as $subcategory) {
					$valueArray[] = $subcategory->getNumber("id");
					if ($subcategory->getString("title".$langIndex)) $nameArray[] = "&nbsp;&nbsp;&nbsp;".$subcategory->getString("title".$langIndex);
					else $nameArray[] = "&nbsp;&nbsp;&nbsp;".$subcategory->getString("title");
				}
			}
		}
	}
	$valueArray[] = "";
	$nameArray[] = "---------------------------";
	$categoryDropDown = html_selectBox("category_id", $nameArray, $valueArray, $category_id, "", "class='input-dd-form-emailgenerate'", system_showText(LANG_LABEL_SELECT_CATEGORY));
	unset($valueArray);
	unset($nameArray);

	/**
	*
	* Location Drop Down
	*
	**********************************************************/
	$countryObj = new LocationCountry();
	$stateObj   = new LocationState();
	$regionObj  = new LocationRegion();
	$cityObj    = new LocationCity();
	$areaObj    = new LocationArea();

	$countries = $countryObj->retrieveAllCountries();
	if ($countries) {
		$valueArray[] = "";
		$nameArray[] = "---------------------------";
		foreach ($countries as $each_country) {
			$valueArray[] = "estado_id:{$each_country["id"]}";
			$nameArray[] = "&nbsp;".$each_country["name"];
			$stateObj->setString("estado_id",$each_country["id"]);
			$states = $stateObj->retrieveStatesByCountry();
			if ($states) {
				foreach ($states as $each_state) {
					$valueArray[] = "";
					$nameArray[] = "---------------------------";
					$valueArray[] = "cidade_id:{$each_state["id"]}";
					$nameArray[] = "&nbsp;&nbsp;&nbsp;".$each_state["name"];
					$regionObj->setString("cidade_id",$each_state["id"]);
					$regions = $regionObj->retrieveRegionsByState();
					if ($regions) {
						foreach ($regions as $each_region) {
							$valueArray[] = "bairro_id:{$each_region["id"]}";
							$nameArray[] = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$each_region["name"];
							$cityObj->setString("bairro_id",$each_region["id"]);
							$cities = $cityObj->retrieveCitiesByRegion();
							if ($cities) {
								foreach ($cities as $each_city) {
									$valueArray[] = "city_id:{$each_city["id"]}";
									$nameArray[] = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$each_city["name"];
									$areaObj->setString("city_id",$each_city["id"]);
									$areas = $areaObj->retrieveAreasByCity();
									if ($areas) {
										foreach ($areas as $each_area) {
											$valueArray[] = "area_id:{$each_area["id"]}";
											$nameArray[] = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$each_area["name"];
										}
									}
								}
							}
						}
					}
				}
			}
			$valueArray[] = "";
			$nameArray[] = "---------------------------";
		}
	}
	$locationDropDown = html_selectBox("location", $nameArray, $valueArray, $location, "", "class='input-dd-form-emailgenerate'", system_showText(LANG_LABEL_SELECT_LOCATION));

		# ----------------------------------------------------------------------------------------------------
		# HEADER
		# ----------------------------------------------------------------------------------------------------
		include(SM_EDIRECTORY_ROOT."/layout/header_manager.php");

	?>

		<div id="page-wrapper">

			<div id="main-wrapper">

			<?php 	include(SM_EDIRECTORY_ROOT."/menu.php"); ?>

				<div id="main-content"> 

					<div class="page-title ui-widget-content ui-corner-all">

						<div class="other_content">

			<? require(EDIRECTORY_ROOT."/gerenciamento/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<? include(INCLUDES_DIR."/tables/table_export_submenu.php"); ?>

			<? if ($error) { ?>
				<div class="errorMessage"><?=$error?></div>
			<? } ?>

			<br />
			
			<div class="tip-base">
				<br />
				<p style="text-align: justify;">
				<?=system_showText(LANG_SITEMGR_EXPORT_EMAILLIST_TIP)?>
                </p>
				<br />
			</div>
			
			<br />

			<form name="emailgenerate" method="post" action="emailgenerate.php">

				<? include(INCLUDES_DIR."/forms/form_emailgenerate.php"); ?>

				<table style="margin: 0 auto 0 auto;">
					<tr>
						<td>
							<button type="submit" name="emailgenerate" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
						</td>
					</tr>
				</table>

			</form>

							</div>
						</div>
					</div>
				</div>
			</div>
		<div class="clearfix"></div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
