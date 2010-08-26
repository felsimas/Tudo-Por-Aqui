<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/code/faq.php
	# ----------------------------------------------------------------------------------------------------

	##########################################################################################################################
	# RESULTS
	##########################################################################################################################
	$where = "";
	$where .= " (question LIKE ".db_formatString("%".$keyword."%")." OR answer LIKE ".db_formatString("%".$keyword."%").") ";
	if ((strpos($_SERVER["PHP_SELF"], "membros"))) {
		if (isset($keyword)) {
			$paging_url = DEFAULT_URL."/membros/faq.php";
			$where .= " AND member='y' ";
		}
	} else {
		if ((strpos($_SERVER["PHP_SELF"], "sitemgr"))){
			if (isset($keyword)) {
				$paging_url = DEFAULT_URL."/gerenciamento/faq.php";
				$where .= " AND sitemgr='y' ";
			}
		} else {
			if (isset($keyword)) {
				$paging_url = DEFAULT_URL."/faq.php";
				$where .= " AND frontend='y' ";
			}
		}
	}

	#############################################################################################################################
	#Page Browsing
	#############################################################################################################################
	$pageObj = new pageBrowsing("FAQ", $screen, 10, false, false, false, $where);
	$faqs = $pageObj->retrievePage("array");
	$array_search_params = array();
	foreach ($_GET as $name => $value) {
		if ($name != "screen" && $name != "letra"){
			$array_search_params[] = $name."=".$value;
		}
	}
	$url_search_params = implode("&amp;", $array_search_params);
	$pagesDropDown = $pageObj->getPagesDropDown($_GET, $paging_url, $screen, system_showText(LANG_PAGING_GOTOPAGE)." ", "this.form.submit();");

?>
