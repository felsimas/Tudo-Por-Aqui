<?


	# ----------------------------------------------------------------------------------------------------
	# * FILE: /membros/promotion/relationship.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();

	extract($_GET);
	extract($_POST);

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$promotion = new Promotion($id);
		if (sess_getAccountIdFromSession() != $promotion->getNumber("account_id")) {
			header("Location: ".DEFAULT_URL."/membros/promotion/index.php?screen=$screen&letra=$letra");
			exit;
		}
		$db = db_getDBObject();
		$sql = "UPDATE Listing SET promotion_id = 0 WHERE promotion_id = ".db_formatNumber($id);
		$db->query($sql);
		header("Location: ".DEFAULT_URL."/membros/promotion/view.php?id=".$promotion->getNumber("id")."&screen=$screen&letra=$letra");
		exit;
	}
	else {
		header("Location: ".DEFAULT_URL."/membros/promotion/index.php?screen=$screen&letra=$letra");
		exit;
	}

?>
