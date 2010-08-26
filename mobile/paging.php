<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /mobile/paging.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (MOBILE_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	if (($pos = strrpos($_SERVER["PHP_SELF"], "/")) !== false) {
		$selfpage = substr($_SERVER["PHP_SELF"], ($pos+1));
	} else {
		$selfpage = $_SERVER["PHP_SELF"];
	}

	if ($item_total_amount > MAX_ITEM_PER_PAGE) {
		?><p class="paging"><?
			if ($page > 1) {
				?><span><a href="<?=MOBILE_DEFAULT_URL?>/<?=$selfpage?>?<?=(($query_string_mobile) ? ($query_string_mobile."&") : (""))?>page=<?=($page-1)?>">&laquo; <?=system_showText(LANG_PAGING_PREVIOUSPAGEMOBILE);?></a></span><?
			}
			if (($page*MAX_ITEM_PER_PAGE) < $item_total_amount) {
				?><span><a href="<?=MOBILE_DEFAULT_URL?>/<?=$selfpage?>?<?=(($query_string_mobile) ? ($query_string_mobile."&") : (""))?>page=<?=($page+1)?>"><?=system_showText(LANG_PAGING_NEXTPAGEMOBILE);?> &raquo;</a></span><?
			}
		?></p><?
	}

?>
