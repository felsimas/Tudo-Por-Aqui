<?
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /ordercalculateprice.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("./conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", FALSE);
	header("Pragma: no-cache");

	$return = 0;

	$item = $_GET["item"];

	if ($item) {

		switch ($item) {
			case "listing":
				$itemObj = new Listing();
			break;
			case "event":
				$itemObj = new Event();
			break;
			case "banner":
				$itemObj = new Banner();
			break;
			case "classified":
				$itemObj = new Classified();
			break;
			case "article":
				$itemObj = new Article();
			break;
		}

		if ($itemObj) {

			if ($item == "banner") {
				$itemObj->setString("type", $_GET["type"]);
				$itemObj->setString("expiration_setting", $_GET["expiration_setting"]);
				$itemObj->setString("unpaid_impressions", $_GET["unpaid_impressions"]);
			} else {
				$itemObj->setString("level", $_GET["level"]);
			}

			if ($item == "listing") {

				if (strpos($_GET["categories"], "x") === false) {
					if ($_GET["categories"] <= MAX_CATEGORY_ALLOWED) {
						for ($count=0; $count<$_GET["categories"]; $count++) {
							$itemObj->setString("cat_".($count+1)."_id", "x");
						}
					}
				}

				$itemObj->setString("listingtemplate_id", $_GET["listingtemplate_id"]);

			}

			$itemObj->setString("discount_id", $_GET["discount_id"]);

			$return = format_money($itemObj->getPrice()) * 100;

			if ($return < 1) $return = "0";
			elseif ($return < 10) $return = "00".$return;
			elseif ($return < 100) $return = "0".$return;

		}

	}

	echo $return;

?>
