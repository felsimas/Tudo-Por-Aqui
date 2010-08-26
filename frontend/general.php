<?

	$generalPageItemPath = "";
	if (strpos($_SERVER["PHP_SELF"], str_replace(NON_SECURE_URL, "", LISTING_DEFAULT_URL)) !== false) {
		$generalPageItemPath = str_replace(NON_SECURE_URL, "", LISTING_DEFAULT_URL)."/";
	} elseif (strpos($_SERVER["PHP_SELF"], str_replace(NON_SECURE_URL, "", PROMOTION_DEFAULT_URL)) !== false) {
		$generalPageItemPath = str_replace(NON_SECURE_URL, "", PROMOTION_DEFAULT_URL)."/";
	} elseif (strpos($_SERVER["PHP_SELF"], str_replace(NON_SECURE_URL, "", EVENT_DEFAULT_URL)) !== false) {
		$generalPageItemPath = str_replace(NON_SECURE_URL, "", EVENT_DEFAULT_URL)."/";
	} elseif (strpos($_SERVER["PHP_SELF"], str_replace(NON_SECURE_URL, "", CLASSIFIED_DEFAULT_URL)) !== false) {
		$generalPageItemPath = str_replace(NON_SECURE_URL, "", CLASSIFIED_DEFAULT_URL)."/";
	} elseif (strpos($_SERVER["PHP_SELF"], str_replace(NON_SECURE_URL, "", ARTICLE_DEFAULT_URL)) !== false) {
		$generalPageItemPath = str_replace(NON_SECURE_URL, "", ARTICLE_DEFAULT_URL)."/";
	}

	$page = $_SERVER["PHP_SELF"];
	$page = substr($page, strrpos($page, "/")+1);
	$page = substr($page, 0, strrpos($page, "."));
	include(EDIRECTORY_ROOT."/".$generalPageItemPath.$page."content.php");

?>
