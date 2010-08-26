<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/prefs/pricing.php
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
	extract($_GET);
	
	// Default CSS class for message
	$message_style = "successMessage";

	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		// Listing Default Prices
		if($listingdefaultprice) {

			foreach ($price as $priceLevel=>$priceValue) {
				$price[$priceLevel] = format_money($priceValue);
			}

			foreach ($free_category as $freeCategoryLevel=>$freeCategoryValue) {
				if ($freeCategoryValue > 0) $free_category[$freeCategoryLevel] = $freeCategoryValue;
				else $free_category[$freeCategoryLevel] = 0;
			}

			foreach ($category_price as $categoryPriceLevel=>$categoryPriceValue) {
				$category_price[$categoryPriceLevel] = format_money($categoryPriceValue);
			}

			if (validate_form("listingdefaultprice", $_POST, $message_listingdefaultprice)) {

				$dbObj = db_getDBObject();
				foreach ($price as $priceLevel=>$priceValue) {
					$sql = "UPDATE ListingLevel SET price = ".$priceValue." WHERE value = ".$priceLevel."";
					$dbObj->query($sql);
				}

				foreach ($free_category as $freeCategoryLevel=>$freeCategoryValue) {
					$sql = "UPDATE ListingLevel SET free_category = '".$freeCategoryValue."' WHERE value = ".$freeCategoryLevel."";
					$dbObj->query($sql);
				}

				foreach ($category_price as $categoryPriceLevel=>$categoryPriceValue) {
					$sql = "UPDATE ListingLevel SET category_price = ".$categoryPriceValue." WHERE value = ".$categoryPriceLevel."";
					$dbObj->query($sql);
				}

				if (!$error) {
					$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_SETTINGS_PRICING_PRICESWERECHANGED);
				} else {
					$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
					$message_style = "errorMessage";
				}

				if($actions) {
					$message_listingdefaultprice .= implode("<br />", $actions);
				}

			} else {
				$message_style = "errorMessage";
			}

		}

		// Event Default Prices
		else if($eventdefaultprice) {

			foreach ($price as $priceLevel=>$priceValue) {
				$price[$priceLevel] = format_money($priceValue);
			}

			if (validate_form("eventdefaultprice", $_POST, $message_eventdefaultprice)) {

				$dbObj = db_getDBObject();
				foreach ($price as $priceLevel=>$priceValue) {
					$sql = "UPDATE EventLevel SET price = ".$priceValue." WHERE value = ".$priceLevel."";
					$dbObj->query($sql);
				}

				if (!$error) {
					$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_SETTINGS_PRICING_PRICESWERECHANGED);
				} else {
					$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
					$message_style = "errorMessage";
				}

				if($actions) {
					$message_eventdefaultprice .= implode("<br />", $actions);
				}

			} else {
				$message_style = "errorMessage";
			}

		}

		// Banner Default Prices
		else if($bannerdefaultprice) {

			foreach ($price as $priceLevel=>$priceValue) {
				$price[$priceLevel] = format_money($priceValue);
			}
			
			foreach($impression_price as $impression_price_level => $impression_price_value){
				$impression_price[$impression_price_level] = format_money($impression_price_value);
			}
				
			if (validate_form("bannerdefaultprice", $_POST, $message_bannerdefaultprice)) {

				$dbObj = db_getDBObject();

				foreach ($price as $priceLevel=>$priceValue) {
					$sql = "UPDATE BannerLevel SET price = ".$priceValue." WHERE value = ".$priceLevel."";
					$dbObj->query($sql);
				}

				foreach ($impression_block as $impression_block_level => $impression_block_value) {
					$sql = "UPDATE BannerLevel SET impression_block = '".$impression_block_value."' WHERE value = ".$impression_block_level."";
					$dbObj->query($sql);
				}

				foreach ($impression_price as $impression_price_level => $impression_price_value) {
					$sql = "UPDATE BannerLevel SET impression_price = ".$impression_price_value." WHERE value = ".$impression_price_level."";
					$dbObj->query($sql);
				}

				if (!$error) {
					$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_SETTINGS_PRICING_PRICESWERECHANGED);
				} else {
					$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
					$message_style = "errorMessage";
				}

				if($actions) {
					$message_bannerdefaultprice .= implode("<br />", $actions);
				}

			} else {
				$message_style = "errorMessage";
			}

		}

		// Classified Default Prices
		else if($classifieddefaultprice) {

			foreach ($price as $priceLevel=>$priceValue) {
				$price[$priceLevel] = format_money($priceValue);
			}

			if (validate_form("classifieddefaultprice", $_POST, $message_classifieddefaultprice)) {

				$dbObj = db_getDBObject();
				foreach ($price as $priceLevel=>$priceValue) {
					$sql = "UPDATE ClassifiedLevel SET price = ".$priceValue." WHERE value = ".$priceLevel."";
					$dbObj->query($sql);
				}

				if (!$error) {
					$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_SETTINGS_PRICING_PRICESWERECHANGED);
				} else {
					$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
					$message_style = "errorMessage";
				}

				if($actions) {
					$message_classifieddefaultprice .= implode("<br />", $actions);
				}

			} else {
				$message_style = "errorMessage";
			}

		}

		// Article Default Prices
		else if($articledefaultprice) {

			foreach ($price as $priceLevel=>$priceValue) {
				$price[$priceLevel] = format_money($priceValue);
			}

			if (validate_form("articledefaultprice", $_POST, $message_articledefaultprice)) {

				$dbObj = db_getDBObject();
				foreach ($price as $priceLevel=>$priceValue) {
					$sql = "UPDATE ArticleLevel SET price = ".$priceValue." WHERE value = ".$priceLevel."";
					$dbObj->query($sql);
				}

				if (!$error) {
					$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_SETTINGS_PRICING_PRICESWERECHANGED);
				} else {
					$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
					$message_style = "errorMessage";
				}

				if($actions) {
					$message_articledefaultprice .= implode("<br />", $actions);
				}

			} else {
				$message_style = "errorMessage";
			}

		}

	}

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

			<? include(INCLUDES_DIR."/tables/table_prefs_submenu.php"); ?>

			<br />

			<form name="listingdefaultprice" action="<?=$_SERVER["PHP_SELF"]?>" method="post">
				<? include(INCLUDES_DIR."/forms/form_listingdefaultprice.php"); ?>
				<table>
					<tr>
						<td class="spacingButton">
							<button type="submit" name="listingdefaultprice" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
						</td>
					</tr>
				</table>
			</form>

			<? if (EVENT_FEATURE == "on") { ?>
				<form name="eventdefaultprice" action="<?=$_SERVER["PHP_SELF"]?>" method="post">
					<? include(INCLUDES_DIR."/forms/form_eventdefaultprice.php"); ?>
					<table>
						<tr>
							<td class="spacingButton">
								<button type="submit" name="eventdefaultprice" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
							</td>
						</tr>
					</table>
				</form>
			<? } ?>

			<? if (BANNER_FEATURE == "on") { ?>
				<form name="bannerdefaultprice" action="<?=$_SERVER["PHP_SELF"]?>" method="post">
					<? include(INCLUDES_DIR."/forms/form_bannerdefaultprice.php"); ?>
					<table>
						<tr>
							<td class="spacingButton">
								<button type="submit" name="bannerdefaultprice" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
							</td>
						</tr>
					</table>
				</form>
			<? } ?>

			<? if (CLASSIFIED_FEATURE == "on") { ?>
				<form name="classifieddefaultprice" action="<?=$_SERVER["PHP_SELF"]?>" method="post">
					<? include(INCLUDES_DIR."/forms/form_classifieddefaultprice.php"); ?>
					<table>
						<tr>
							<td class="spacingButton">
								<button type="submit" name="classifieddefaultprice" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
							</td>
						</tr>
					</table>
				</form>
			<? } ?>

			<? if (ARTICLE_FEATURE == "on") { ?>
				<form name="articledefaultprice" action="<?=$_SERVER["PHP_SELF"]?>" method="post">
					<? include(INCLUDES_DIR."/forms/form_articledefaultprice.php"); ?>
					<table>
						<tr>
							<td class="spacingButton">
								<button type="submit" name="articledefaultprice" value="Submit" class="ui-state-default ui-corner-all"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
							</td>
						</tr>
					</table>
				</form>
			<? } ?>

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
