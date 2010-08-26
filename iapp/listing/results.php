<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /iapp/listing/results.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# DEFINE
	# ----------------------------------------------------------------------------------------------------
	define(MAX_ITEM_PER_PAGE, 10);
	define(MAX_DESC_LEN, 50);

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	# ----------------------------------------------------------------------------------------------------
	# QUERY STRING
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/iapp/query_string.php");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	$section = "listing";
	$backButton = false;
	$headerTitle = ucwords(LISTING_FEATURE_NAME)." Results";
	$homeButton = false;
	$contactButton = false;
	$searchButton = true;
	$searchButtonLink = DEFAULT_URL."/iapp/listing/main.php";
	include(EDIRECTORY_ROOT."/iapp/layout/header.php");

?>
	<div class="results">
	<?

	$search_lock = false;
	if (LISTING_SCALABILITY_OPTIMIZATION == "on") {
		if (!$_GET["keyword"] && !$_GET["category_id"]) {
			$_GET["id"] = 0;
			$search_lock = true;
		}
	}

	if (!$page) $page = 1;

	if ($_GET["keyword"]) {
		$message_searchresults = "<p class=\"searchResults\">Search results for <strong>".$_GET["keyword"]."</strong></p>";
	} elseif ($_GET["category_id"]) {
		$listingCategoryObj = new ListingCategory($_GET["category_id"]);
		$message_searchresults = "<p class=\"searchResults\">Search results in category <strong>".$listingCategoryObj->getString("title")."</strong></p>";
	}

	$dbObj = db_getDBObject();

	unset($searchReturn);
	$searchReturn = search_frontListingSearch($_GET, "mobile");
	$sql = "SELECT SQL_CALC_FOUND_ROWS ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." ".(($searchReturn["where_clause"])?("WHERE ".$searchReturn["where_clause"]):(""))." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))." LIMIT ".(($page-1)*MAX_ITEM_PER_PAGE).",".MAX_ITEM_PER_PAGE."";
	$result = $dbObj->query($sql);

	if ($result) {

		if ($message_searchresults) echo $message_searchresults;

		$sqlFoundRows = "SELECT FOUND_ROWS()";
		$resultFoundRows = $dbObj->query($sqlFoundRows);
		$foundRows = mysql_fetch_row($resultFoundRows);
		$item_total_amount = $foundRows[0];

		$item_amount = mysql_num_rows($result);

		if ($item_amount > 0) {

			include(EDIRECTORY_ROOT."/iapp/searchstatistics.php");

			$level = new ListingLevel();

			while ($listing = mysql_fetch_assoc($result)) {
				include(EDIRECTORY_ROOT."/iapp/listing/view.php");
			}

			include(EDIRECTORY_ROOT."/iapp/paging.php");

		} else {
			if ($search_lock) {
				echo "<p class=\"warning\">Please search by at least one parameter!</p>";
			} else {
				echo "<p class=\"warning\">No results were found for the search criteria you requested.</p>";
			}
		}

	} else {
		echo "<p class=\"warning\">No results were found!</p>";
	}

	?>
	</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/iapp/layout/footer.php");
?>
