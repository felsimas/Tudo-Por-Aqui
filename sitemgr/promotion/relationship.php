<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /gerenciamento/promotion/relationship.php
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

	$url_redirect = "".DEFAULT_URL."/gerenciamento/promotion";
	$url_base = "".DEFAULT_URL."/gerenciamento";
	$sitemgr = 1;

	extract($_GET);
	extract($_POST);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$promotion = new Promotion($id);
		$db = db_getDBObject();
		$sql = "UPDATE Listing SET promotion_id = 0 WHERE promotion_id = ".db_formatNumber($id);
		$db->query($sql);
		header("Location: ".DEFAULT_URL."/gerenciamento/promotion/view.php?id=".$promotion->getNumber("id")."&screen=".$screen."&letra=".$letra.(($url_search_params) ? "&$url_search_params" : ""));
		exit;
	} else {
		header("Location: ".DEFAULT_URL."/gerenciamento/promotion/".(($search_page) ? "search.php" : "index.php")."?screen=$screen&letra=$letra".(($url_search_params) ? "&$url_search_params" : "")."");
		exit;
	}

?>
