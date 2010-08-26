<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /iapp/classified/main.php
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
	$section = "classified";
	$backButton = false;
	$headerTitle = ucwords(CLASSIFIED_FEATURE_NAME)." Home";
	$homeButton = true;
	$contactButton = false;
	$searchButton = false;
	$searchButtonLink = "";
	include(EDIRECTORY_ROOT."/iapp/layout/header.php");

?>

	<? include(EDIRECTORY_ROOT."/iapp/search.php"); ?>

	<div class="front">
	<?
	if (CLASSIFIEDCATEGORY_SCALABILITY_OPTIMIZATION == "on") {
		$sql = "SELECT * FROM ClassifiedCategory WHERE category_id = '0' ORDER BY active_classified DESC LIMIT 20";
		$categories = db_getFromDBBySQL("classifiedcategory", $sql);
	} else {
		$categories = db_getFromDB("classifiedcategory", "category_id", 0, "all", "title");
	}
	echo "<h1>Browse by <span>Category</span></h1>";
	if ($categories) {
		echo "<ul>";
		foreach ($categories as $category) {
			echo "<li><span rel=\"".DEFAULT_URL."/iapp/classified/results.php?category_id=".$category->getNumber("id")."\">".$category->getString("title")."</span></li>";
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
