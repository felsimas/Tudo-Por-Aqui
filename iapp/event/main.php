<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /iapp/event/main.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	$section = "event";
	$backButton = false;
	$headerTitle = ucwords(EVENT_FEATURE_NAME)." Home";
	$homeButton = true;
	$contactButton = false;
	$searchButton = false;
	$searchButtonLink = "";
	include(EDIRECTORY_ROOT."/iapp/layout/header.php");

?>

	<? include(EDIRECTORY_ROOT."/iapp/search.php"); ?>

	<div class="front">
	<?
	if (EVENTCATEGORY_SCALABILITY_OPTIMIZATION == "on") {
		$sql = "SELECT * FROM EventCategory WHERE category_id = '0' ORDER BY active_event DESC LIMIT 20";
		$categories = db_getFromDBBySQL("eventcategory", $sql);
	} else {
		$categories = db_getFromDB("eventcategory", "category_id", 0, "all", "title");
	}
	echo "<h1>Browse by <span>Category</span></h1>";
	if ($categories) {
		echo "<ul>";
		foreach ($categories as $category) {
			echo "<li><span rel=\"".DEFAULT_URL."/iapp/event/results.php?category_id=".$category->getNumber("id")."\">".$category->getString("title")."</span></li>";
		}
		echo "</ul>";
	} else {
		echo "<p class=\"warning\">No categories!</p>";
	}
	?>
	</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/iapp/layout/footer.php");
?>
